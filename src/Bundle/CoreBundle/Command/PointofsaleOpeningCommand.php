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
use Bundle\PointofsaleBundle\Entity\PointofsaleOpening;
use Bundle\ReportBundle\Entity\ReportPdv;
use Bundle\ReportBundle\Entity\IncomeAndExpenses;
use Bundle\PointofsaleBundle\Entity\Pointofsale;

//https://symfony.com/doc/current/components/yaml.html
//https://symfony.com/doc/current/doctrine/reverse_engineering.html

class PointofsaleOpeningCommand extends ContainerAwareCommand
{

    const DUMMY_UPPER = 'DUMMY_UPPER';

    protected function configure()
    {
        $this
            ->setName('tianos:pointofsale:opening')
            ->setDescription('Apertura de Punto de Venta')
            ->addOption('baz', 'tn', InputOption::VALUE_NONE, 'Test option')
            ->addArgument('pdvId', InputArgument::OPTIONAL, 'Punto de venta', null)
        ;
    }

    /**
     * Execute the command
     * The environment option is automatically handled.
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
    	$uniqid = uniqid();
    	$now = new \DateTime("NOW");
        $pdvId = $input->getArgument('pdvId');

        $output->writeln([
            '<comment>=========== <question>Punto de venta Opening</question> ===========</comment>',
            '--',
        ]);

        $em = $this->getContainer()->get('doctrine')->getManager();
	
	    $pdv = $this->getContainer()->get('tianos.repository.pointofsale')->find($pdvId);
        
        if ($pdv->getStatus() == Pointofsale::STATUS_OPEN) {
	        $output->writeln('--');
	        $output->writeln('<question>=== El pdv ya fue APERTURADO:: ' . $pdv->getName() . ' ===</question>');
	        $output->writeln('--');
	        
	        return false;
        }
	
	    /**
	     * OPENING PDV
	     */
	    $o = new PointofsaleOpening();
	    $o->setOpeningDate($now);
	    $o->setPdvHash($uniqid);
	    $o->setPointOfSale($pdv);
	    $em->persist($o);
	    $em->flush();
	
	
	    /**
	     * POINT OF SALE HAS PRODUCT
	     */
	    $pointOfSaleHasProduct = $this->getContainer()->get('tianos.repository.pointofsale.has.product')->findByPdv($pdvId);
	    foreach ($pointOfSaleHasProduct as $key => $pdvOpen) {
		    $r = new ReportPdv();
		    $r->setStockOrders(0);
		    $r->setStockSales(0);
		    $r->setPdvHash($uniqid);
		    $r->setPointofsaleOpening($o);
		    $r->setProduct($pdvOpen->getProduct());
		    $r->setStockInitial($pdvOpen->getStock());
		    $em->persist($r);
		    $em->flush();
	    }
	    
	    
	    /**
	     * UPDATE PDV
	     */
	    $pdv->setStatus(Pointofsale::STATUS_OPEN);
	    $pdv->setPdvHash($uniqid);
	    $em->persist($pdv);
	    $em->flush();
	
	
	    /**
	     * INCOME AND EXPENSES
	     */
	    $this->createIncomeAndExpenses($o, $pdv);

	    
        //=============================================
        $output->writeln('--');
        $output->writeln('<question>=== Se termino el proceso ' . $now->format("Y-m-d") . ' ===</question>');
        $output->writeln('--');
    }
	
    
	private function createIncomeAndExpenses(PointofsaleOpening $o, Pointofsale $pdv)
	{
		$em = $this->getContainer()->get('doctrine')->getManager();
		
		$this->getContainer()->get('tianos.repository.income.and.expenses')->deleteAllByPdvAndNow($pdv->getId());
		
		
		$i = new IncomeAndExpenses();
		$i->setAmount(0);
		$i->setName("Caja chica");
		$i->setPointofsaleOpening($o);
		$i->setPdvHash($pdv->getPdvHash());
		$i->setOpeningDate(new \DateTime("NOW"));
		$i->setContents(IncomeAndExpenses::CONTENTS_IN);
		$em->persist($i);
		$em->flush();
		
		$i = new IncomeAndExpenses();
		$i->setAmount(0);
		$i->setName("Cargueros");
		$i->setPointofsaleOpening($o);
		$i->setPdvHash($pdv->getPdvHash());
		$i->setOpeningDate(new \DateTime("NOW"));
		$i->setContents(IncomeAndExpenses::CONTENTS_OUT);
		$em->persist($i);
		$em->flush();
		
		$i = new IncomeAndExpenses();
		$i->setAmount(0);
		$i->setName("Desayuno");
		$i->setPointofsaleOpening($o);
		$i->setPdvHash($pdv->getPdvHash());
		$i->setOpeningDate(new \DateTime("NOW"));
		$i->setContents(IncomeAndExpenses::CONTENTS_OUT);
		$em->persist($i);
		$em->flush();
		
		$i = new IncomeAndExpenses();
		$i->setAmount(0);
		$i->setName("Taxi");
		$i->setPointofsaleOpening($o);
		$i->setPdvHash($pdv->getPdvHash());
		$i->setOpeningDate(new \DateTime("NOW"));
		$i->setContents(IncomeAndExpenses::CONTENTS_OUT);
		$em->persist($i);
		$em->flush();
		
		$i = new IncomeAndExpenses();
		$i->setAmount(0);
		$i->setName("Servicios");
		$i->setPointofsaleOpening($o);
		$i->setPdvHash($pdv->getPdvHash());
		$i->setOpeningDate(new \DateTime("NOW"));
		$i->setContents(IncomeAndExpenses::CONTENTS_OUT);
		$em->persist($i);
		$em->flush();
		
		$i = new IncomeAndExpenses();
		$i->setAmount(0);
		$i->setName("Pago a personal");
		$i->setPointofsaleOpening($o);
		$i->setPdvHash($pdv->getPdvHash());
		$i->setOpeningDate(new \DateTime("NOW"));
		$i->setContents(IncomeAndExpenses::CONTENTS_OUT);
		$em->persist($i);
		$em->flush();
		
	}
}


