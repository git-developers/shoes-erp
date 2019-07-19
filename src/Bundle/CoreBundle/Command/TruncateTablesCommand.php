<?php

declare(strict_types=1);

namespace Bundle\CoreBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Output\OutputInterface;


class TruncateTablesCommand extends ContainerAwareCommand
{

    protected function configure()
    {
        $this
            ->setName('tianos:truncate:tables')
            ->setDescription('TruncateTables mysql')
            ->addOption('baz', 'tn', InputOption::VALUE_NONE, 'Test option')
            ->addArgument('status', InputArgument::OPTIONAL, 'El status: e.g. TRUE - FALSE', false)
        ;
    }

    /**
     * Execute the command
     * The environment option is automatically handled.
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $status = $input->getArgument('status');

        $output->writeln([
            '<comment>=========== <question>TruncateTables:</question> proceso ... ===========</comment>',
        ]);

        $em = $this->getContainer()->get('doctrine')->getManager();
        $dbName = $this->getContainer()->getParameter('database_name');

        $sql = "SELECT CONCAT('truncate table ',table_schema,'.',table_name,';') AS table_name FROM information_schema.tables WHERE table_schema IN ('" . $dbName . "');";
        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();

        foreach ($result as $key => $value){

            $sql = 'SET foreign_key_checks=0; ' . array_shift($value) . ' SET foreign_key_checks=1;';

            $stmt = $em->getConnection()->prepare($sql);
            $stmt->execute();
        }

        $output->writeln('<info>* Se termino de truncar todas las tablas</info>');
        $output->writeln('');

    }
}




