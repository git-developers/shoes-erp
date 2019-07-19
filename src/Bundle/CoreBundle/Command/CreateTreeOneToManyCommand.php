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

//https://symfony.com/doc/current/components/yaml.html
//https://symfony.com/doc/current/doctrine/reverse_engineering.html
//doctrine:mapping:import

class CreateTreeOneToManyCommand extends ContainerAwareCommand
{

    const DUMMY_LEFT_LOWER = 'DUMMY_LEFT_LOWER';
    const DUMMY_LEFT_UPPER = 'DUMMY_LEFT_UPPER';

    const DUMMY_RIGHT_LOWER = 'DUMMY_RIGHT_LOWER';
    const DUMMY_RIGHT_UPPER = 'DUMMY_RIGHT_UPPER';

    private $setts;

//    public function __construct()
//    {
//        $this->setts = new \stdClass();
//    }

    protected function configure()
    {
        $this
            ->setName('tianos:create:tree-one-to-many')
            ->setDescription('TreeOneToMany generator')
            ->addOption('baz', 'tn', InputOption::VALUE_NONE, 'Test option')
//            ->addArgument('status', InputArgument::OPTIONAL, 'El status: e.g. TRUE - FALSE', false)
            ->addArgument('bundle_left', InputArgument::OPTIONAL, 'The bundle left: product, client', false)
            ->addArgument('bundle_right', InputArgument::OPTIONAL, 'The bundle right: product, client', false)
        ;
    }

    /**
     * Execute the command
     * The environment option is automatically handled.
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->setts = new \stdClass();

        $bundleLeft = $input->getArgument('bundle_left');
        $this->setts->bundleLeftLower = strtolower($bundleLeft);
        $this->setts->bundleLeftUpper = ucfirst($this->setts->bundleLeftLower);

        $bundleRight = $input->getArgument('bundle_right');
        $this->setts->bundleRightLower = strtolower($bundleRight);
        $this->setts->bundleRightUpper = ucfirst($this->setts->bundleRightLower);

        $output->writeln(['<comment>=========== <question>OneToMany creator:</question> 
            bundle left: ' . $this->setts->bundleLeftUpper . ' --  bundle right: ' . $this->setts->bundleRightUpper . ' ===========</comment>',
            '--',
        ]);

        $source = getcwd() . '/data/generator/treeOneToMany';
        $dest = getcwd() . '/src/Bundle/AssociativeBundle';


        //=============================================
        $output->writeln('');
        $output->writeln('<question>OneToMany: controller</question>');

        $controllerSource = $source . '/Controller/'.self::DUMMY_LEFT_UPPER.'Has'.self::DUMMY_RIGHT_UPPER.'Controller.php';
        $controllerDest = $dest . '/Controller/'.$this->setts->bundleLeftUpper.'Has'.$this->setts->bundleRightUpper.'Controller.php';

        $this->linuxCommand('cp -R '.$controllerSource.' '. $controllerDest);
        $output->writeln('<info>* Copiar controller</info>');

        $this->linuxCommand('find '.$controllerDest.' -name \*.php -exec sed -i "s/'.self::DUMMY_LEFT_UPPER.'/'.$this->setts->bundleLeftUpper.'/g" {} \;');
        $this->linuxCommand('find '.$controllerDest.' -name \*.php -exec sed -i "s/'.self::DUMMY_RIGHT_UPPER.'/'.$this->setts->bundleRightUpper.'/g" {} \;');
        $output->writeln('<info>* Cambiar texto PHP dentro del bundle</info>');

        $this->linuxCommand('chown -R 1000:1000 '. $controllerDest);
        $output->writeln('<info>* Dar permisos controller</info>');



        //=============================================
        $output->writeln('');
        $output->writeln('<question>OneToMany: copy view</question>');

        $viewSource = $source . '/Resources/views/'.self::DUMMY_LEFT_UPPER.'Has'.self::DUMMY_RIGHT_UPPER;
        $viewDest = $dest . '/Resources/views/'.$this->setts->bundleLeftUpper.'Has'.$this->setts->bundleRightUpper;

        $this->linuxCommand('cp -R '.$viewSource.' '. $viewDest);
        $output->writeln('<info>* Copiar view</info>');

        $this->linuxCommand('chown -R 1000:1000 '. $viewDest);
        $output->writeln('<info>* Dar permisos view</info>');



        //=============================================
        $output->writeln('');
        $output->writeln('<question>OneToMany: routing 1</question>');

        $routingSource = $source . '/Resources/config/routing/'.self::DUMMY_LEFT_LOWER.'Has'.self::DUMMY_RIGHT_LOWER.'.yml';
        $routingDest = $dest . '/Resources/config/routing/'.$this->setts->bundleLeftLower.'_has_'.$this->setts->bundleRightLower.'.yml';

        $this->linuxCommand('cp -R '.$routingSource.' '. $routingDest);
        $output->writeln('<info>* Copiar routing</info>');

        $this->linuxCommand('find '.$routingDest.' -name \*.yml -exec sed -i "s/'.self::DUMMY_LEFT_LOWER.'/'.$this->setts->bundleLeftLower.'/g" {} \;');
        $this->linuxCommand('find '.$routingDest.' -name \*.yml -exec sed -i "s/'.self::DUMMY_LEFT_UPPER.'/'.$this->setts->bundleLeftUpper.'/g" {} \;');

        $this->linuxCommand('find '.$routingDest.' -name \*.yml -exec sed -i "s/'.self::DUMMY_RIGHT_LOWER.'/'.$this->setts->bundleRightLower.'/g" {} \;');
        $this->linuxCommand('find '.$routingDest.' -name \*.yml -exec sed -i "s/'.self::DUMMY_RIGHT_UPPER.'/'.$this->setts->bundleRightUpper.'/g" {} \;');
        $output->writeln('<info>* Cambiar texto PHP dentro del bundle</info>');

        $this->linuxCommand('chown -R 1000:1000 '. $routingDest);
        $output->writeln('<info>* Dar permisos routing</info>');



        //=============================================
        $output->writeln('');
        $output->writeln('<question>OneToMany YML: services.yml</question>');
        $this->servicesYml();
        $output->writeln('<info>* services YML bundle</info>');



        //=============================================
        $output->writeln('');
        $output->writeln('<question>CRUD YML: routing.yml</question>');
        $result = $this->routingYml();
        $output->writeln('<info>* routing YML bundle: '.$result.'</info>');



        //=============================================
        $output->writeln('--');
        $output->writeln('<comment>=== Se termino el proceso, pon el Kernel ===</comment>');
        $output->writeln('<comment>* Para eliminar, borrar files:</comment>');
        $output->writeln('* CONTROLLER: Bundle/AssociativeBundle/Controller/'.$this->setts->bundleLeftUpper.'Has'.$this->setts->bundleRightUpper.'Controller.php');
        $output->writeln('* ROUTING: Bundle/AssociativeBundle/Resources/config/routing/'.$this->setts->bundleLeftUpper.'_has_'.$this->setts->bundleRightLower.'.yml');
        $output->writeln('* SERVICES: Bundle/AssociativeBundle/Resources/config/services.yml');
        $output->writeln('* VIEW: Bundle/AssociativeBundle/Resources/views/ProfileHasRole');
        $output->writeln('--');
    }

    private function linuxCommand($command) {

        $process = new Process($command);
        $process->run();

        // executes after the command finishes
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        sleep(1);

        return $process->getOutput();
    }

    private function servicesYml()
    {
        $services = [];
        $services['tianos.'.$this->setts->bundleLeftLower.'has'.$this->setts->bundleRightLower.'.controller.associative'] = [
            'class' => 'Bundle\AssociativeBundle\Controller\\'.$this->setts->bundleLeftUpper.'Has'.$this->setts->bundleRightUpper.'Controller',
            'arguments' => ['Bundle\ResourceBundle\Factory\RequestConfigurationFactoryInterface'],
            'tags' => [
                [
                    'name' => 'tianos.'.$this->setts->bundleLeftLower.'has'.$this->setts->bundleRightLower.'.controller.associative',
                    'alias' => 'tianos.'.$this->setts->bundleLeftLower.'has'.$this->setts->bundleRightLower.'.controller.associative'
                ]
            ],
        ];

        $destPath = getcwd() . '/src/Bundle/AssociativeBundle/Resources/config/services.yml';
        $destYmlValues = Yaml::parseFile($destPath);

        $destYmlValues = is_array($destYmlValues['services']) ? $destYmlValues['services'] : [];
        $saveYmlValues['services'] = array_merge($destYmlValues, $services);

        //COPIAR YML
        file_put_contents($destPath, Yaml::dump($saveYmlValues));
    }

    private function routingYml()
    {
        $exist = false;
        $bundle = $this->setts->bundleLeftLower.'_has_'.$this->setts->bundleRightLower;
        $prefix = $this->setts->bundleLeftLower.'-has-'.$this->setts->bundleRightLower;
        $ymlPath = __DIR__ . '/../../../../src/Bundle/AssociativeBundle/Resources/config/routing.yml';

        $ymlValues = Yaml::parseFile($ymlPath);
        $ymlValues = is_array($ymlValues) ? $ymlValues : [];

        foreach ($ymlValues as $key => $ymlValue){

            $ymlValue = str_replace('backend_associative_', '', $ymlValue);

            if($ymlValue == $bundle){
                $exist = true;
            }
        }

        if(!$exist){
            $ymlValues['backend_associative_' . $bundle] = [
                'resource' => '@AssociativeBundle/Resources/config/routing/' . $bundle . '.yml',
                'prefix' => '/' . $prefix,
            ];
        }

        //COPIAR YML
        file_put_contents($ymlPath, Yaml::dump($ymlValues));
    }

}


