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
use Bundle\OrderBundle\Entity\Order;

//https://symfony.com/doc/current/components/yaml.html
//https://symfony.com/doc/current/doctrine/reverse_engineering.html

class OrderAndReturnCommand extends ContainerAwareCommand
{

    const DUMMY_UPPER = 'DUMMY_UPPER';

    protected function configure()
    {
        $this
            ->setName('tianos:order-and-return')
            ->setDescription('Pedido y Devolución de periódicos por los Canillitas')
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
            '<comment>=========== <question>Pedido Y Devolución de periódicos por los Canillitas</question> ===========</comment>',
            '--',
        ]);

        $em = $this->getContainer()->get('doctrine')->getManager();

        $this->deleteTables($delete, $output, $em);

        // GET OBJECTS
        $pointOfSales = $this->getContainer()->get('tianos.repository.pointofsale')->findAll();
        $productos = $this->getContainer()->get('tianos.repository.product')->findAll();


        for ($i = $dateStart; $i <= $dateEnd; $i->modify('+1 day')) {

            $output->writeln('<comment>===<question>Fecha:</question> ' . $i->format("Y-m-d") . ' ===</comment>');

            foreach ($pointOfSales as $key => $pointOfSale) {

                foreach ($pointOfSale->getUser2() as $key => $user) {

                    foreach ($productos as $key => $product) {

                        // ORDER-OUT
                        $randHour = rand(7, 12);
                        $randMin = rand(0, 59);
                        $randSec = rand(0, 59);
                        $i->setTime($randHour, $randMin, $randSec);

                        $order = new Order();
                        $order->setPointOfSale($pointOfSale);
                        $order->setUser($user);
                        $order->setOrderDate($i);
                        $order->setProduct($product);
                        $order->setQuantity(rand(10, 100));
                        $order->setType(Order::OUT);
                        $em->persist($order);
                        $em->flush();

                        // ORDER-IN
                        $randHour = rand(4, 5);
                        $randMin = rand(0, 59);
                        $randSec = rand(0, 59);
                        $i->setTime($randHour, $randMin, $randSec);

                        $order = new Order();
                        $order->setPointOfSale($pointOfSale);
                        $order->setUser($user);
                        $order->setOrderDate($i);
                        $order->setProduct($product);
                        $order->setQuantity(rand(4, 10));
                        $order->setType(Order::IN);
                        $em->persist($order);
                        $em->flush();
                    }

                    usleep(200);

//                    $em->clear();
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
        $output->writeln('<comment>===<question>Delete table:</question> order_ ===</comment>');
        $sql = "DELETE FROM order_;";
        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute();
        $output->writeln('--');
        usleep(500);
    }
}


