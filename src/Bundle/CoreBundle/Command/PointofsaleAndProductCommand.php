<?php

declare(strict_types=1);

namespace Bundle\CoreBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Yaml\Yaml;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Bundle\PdvhasproductBundle\Entity\Pdvhasproduct;
use Bundle\VisitBundle\Entity\Visit;
use Bundle\SessionBundle\Entity\Session;

//https://symfony.com/doc/current/components/yaml.html
//https://symfony.com/doc/current/doctrine/reverse_engineering.html

class PointofsaleAndProductCommand extends ContainerAwareCommand
{

    const DUMMY_UPPER = 'DUMMY_UPPER';

    protected function configure()
    {
        $this
            ->setName('tianos:pointofsale:and:product')
            ->setDescription('Productos distribuidos por Transportistas a los Puntos de venta')
            ->addOption('baz', 'tn', InputOption::VALUE_NONE, 'Test option')
//            ->addArgument('status', InputArgument::OPTIONAL, 'El status: e.g. TRUE - FALSE', false)
            ->addArgument('date-start', InputArgument::OPTIONAL, 'Fecha inicio', false)
            ->addArgument('date-end', InputArgument::OPTIONAL, 'Fecha fin', false)
            ->addArgument('delete', InputArgument::OPTIONAL, 'Delete', null)
        ;
    }

    /**
     * Execute the command
     * The environment option is automatically handled.
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $delete = $input->getArgument('delete');

        $dateStartStr = $input->getArgument('date-start');
        $dateStart = new \DateTime($dateStartStr);

        $dateEndStr = $input->getArgument('date-end');
        $dateEnd   = new \DateTime($dateEndStr);

        $output->writeln([
            '<comment>=========== <question>Productos distribuidos por Transportistas a los Puntos de venta</question> ===========</comment>',
            '--',
        ]);

        $em = $this->getContainer()->get('doctrine')->getManager();

        $this->deleteTables($delete, $output, $em);

        $output->writeln('--');

        // GET OBJECTS
        $transportistas = $this->getContainer()->get('tianos.repository.user')->findAllOffsetLimitTransportista();
        $productos = $this->getContainer()->get('tianos.repository.product')->findAll();


        for ($i = $dateStart; $i <= $dateEnd; $i->modify('+1 day')) {

            $output->writeln('<comment>===<question>Fecha:</question> ' . $i->format("Y-m-d") . ' ===</comment>');

            foreach ($transportistas as $key => $transportista) {

                foreach ($transportista->getRoute() as $key => $route) {

                    foreach ($route->getPointOfSale() as $key => $pointOfSale) {

                        foreach ($productos as $key => $product) {

                            /**
                             * PDV HAS PRODUCT
                             */
                            $randHour = rand(4, 5); // HORAS DE ENTREGA
                            $randMin = rand(0, 20);
                            $randSec = rand(0, 59);
                            $i->setTime($randHour, $randMin, $randSec);

                            //PRODUCTOS ENTREGAS
                            $min = 10;
                            $max = 150;
                            $entity = new Pdvhasproduct();
                            $entity->setUser($transportista);
                            $entity->setPointOfSale($pointOfSale);
                            $entity->setProduct($product);
                            $entity->setQuantity(rand($min, $max));
                            $entity->setUuid(uniqid("", true));
                            $entity->setCreatedAt($i);
                            $em->persist($entity);
                            $em->flush();
                        }


                        /**
                         * SAVE SESSION - LOGIN END-USER
                         */
                        $session = new Session();
                        $session->setToken(uniqid("token-", true));
                        $session->setUser($transportista);
                        $session->setCreatedAt($i);
                        $em->persist($session);
                        $em->flush();


                        /**
                         * VISIT
                         */
                        $visitEnd = clone $i;
                        $visitEnd = $visitEnd->add(new \DateInterval('PT' . rand(10, 15) . 'M'));

                        $visit = new Visit();
                        $visit->setUser($transportista);
                        $visit->setPointOfSale($pointOfSale);
                        $visit->setVisitStart($i);
                        $visit->setVisitEnd($visitEnd);
                        $visit->setUuid(uniqid("", true));
                        $visit->setCreatedAt($i);
                        $em->persist($visit);
                        $em->flush();
                    }
                }
            }

            usleep(500);
        }

//        $em->flush();

        //=============================================
        $output->writeln('--');
        $output->writeln('<question>=== Se termino el proceso ===</question>');
        $output->writeln('<comment>Fecha inicio: ' . $dateStartStr . ' -- Fecha fin: ' . $dateEndStr . '</comment>');
        $output->writeln('--');
    }

    public function deleteTables($delete, $output, $em)
    {

        if(is_null($delete)) {
            return;
        }


        //DELETE OBJECTS
        $output->writeln('<comment>===<question>Delete table:</question> point_of_sale_has_product ===</comment>');
        $sql = "DELETE FROM point_of_sale_has_product;";
        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute();
        usleep(500);

        $output->writeln('<comment>===<question>Delete table:</question> visit ===</comment>');
        $sql = "DELETE FROM visit;";
        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute();
        usleep(500);

        $output->writeln('<comment>===<question>Delete table:</question> session ===</comment>');
        $sql = "DELETE FROM session;";
        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute();
        usleep(500);
    }
}


