<?php

declare(strict_types=1);

namespace Bundle\CoreBundle\Application;

//use PSS\SymfonyMockerContainer\DependencyInjection\MockerContainer;
use Symfony\Component\Config\Loader\DelegatingLoader;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\Config\Loader\LoaderResolver;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Loader\ClosureLoader;
use Symfony\Component\DependencyInjection\Loader\DirectoryLoader;
use Symfony\Component\DependencyInjection\Loader\IniFileLoader;
use Symfony\Component\DependencyInjection\Loader\PhpFileLoader;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\HttpKernel\Config\FileLocator;
use Symfony\Component\HttpKernel\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    const VERSION = '1.2.0-DEV';
    const VERSION_ID = '10200';
    const MAJOR_VERSION = '1';
    const MINOR_VERSION = '2';
    const RELEASE_VERSION = '0';
    const EXTRA_VERSION = 'DEV';

    /**
     * {@inheritdoc}
     */
    public function registerBundles(): array
    {

        $bundles = [
            new \Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new \Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new \Symfony\Bundle\TwigBundle\TwigBundle(),
            new \Symfony\Bundle\MonologBundle\MonologBundle(),
            new \Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new \Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new \Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),

            //third-party bundles
            new \FOS\UserBundle\FOSUserBundle(),
            new \FOS\RestBundle\FOSRestBundle(),
            new \Knp\Bundle\MenuBundle\KnpMenuBundle(),
            new \Liip\ImagineBundle\LiipImagineBundle(),
            new \JMS\SerializerBundle\JMSSerializerBundle(),
            new \Symfony\Bundle\AsseticBundle\AsseticBundle(),
            new \Doctrine\Bundle\MigrationsBundle\DoctrineMigrationsBundle(),

            //tianos bundle
            new \Bundle\UiBundle\UiBundle(),
            new \Bundle\ApiBundle\ApiBundle(),
            new \Bundle\CoreBundle\CoreBundle(),
            new \Bundle\UserBundle\UserBundle(),
            new \Bundle\GridBundle\GridBundle(),
            new \Bundle\TreeBundle\TreeBundle(),
            new \Bundle\PagesBundle\PagesBundle(),
            new \Bundle\ThemeBundle\ThemeBundle(),
            new \Bundle\ThemesBundle\ThemesBundle(),
            new \Bundle\BackendBundle\BackendBundle(),
            new \Bundle\FrontendBundle\FrontendBundle(),
            new \Bundle\ResourceBundle\ResourceBundle(),
            new \Bundle\OneToManyBundle\OneToManyBundle(),
            new \Bundle\AssociativeBundle\AssociativeBundle(),
            new \Bundle\TreeOneToManyBundle\TreeOneToManyBundle(),
        ];

        if (in_array($this->getEnvironment(), ['dev', 'test'], true)) {
            $bundles[] = new \Symfony\Bundle\DebugBundle\DebugBundle();
            $bundles[] = new \Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new \Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
            $bundles[] = new \Doctrine\Bundle\FixturesBundle\DoctrineFixturesBundle();

            if ('dev' === $this->getEnvironment()) {
                $bundles[] = new \Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
                $bundles[] = new \Symfony\Bundle\WebServerBundle\WebServerBundle();
            }
        }

        return $bundles;
    }

    /**
     * {@inheritdoc}
     */
    protected function getContainerBaseClass(): string
    {
        if (in_array($this->getEnvironment(), ['test', 'test_cached'], true)) {
            return MockerContainer::class;
        }

        return parent::getContainerBaseClass();
    }

    /**
     * {@inheritdoc}
     */
    protected function getContainerLoader(ContainerInterface $container): LoaderInterface
    {
        $locator = new FileLocator($this, $this->getRootDir() . '/Resources');
        $resolver = new LoaderResolver([
            new XmlFileLoader($container, $locator),
            new YamlFileLoader($container, $locator),
            new IniFileLoader($container, $locator),
            new PhpFileLoader($container, $locator),
            new DirectoryLoader($container, $locator),
            new ClosureLoader($container),
        ]);

        return new DelegatingLoader($resolver);
    }

    /**
     * {@inheritdoc}
     */
    public function registerContainerConfiguration(LoaderInterface $loader)
    {
//        $loader->load($this->getRootDir().'/config/config_'.$this->getEnvironment().'.yml');
        $loader->load($this->getRootDir() . '/config/config_' . $this->getEnvironment() . '.yml');

        $file = $this->getRootDir() . '/config/config_' . $this->getEnvironment() . '.local.yml';
        if (is_file($file)) {
            $loader->load($file);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getCacheDir(): string
    {
        if ($this->isVagrantEnvironment()) {
            return '/dev/shm/sylius/cache/' . $this->getEnvironment();
        }

        return dirname($this->getRootDir()) . '/var/cache/' . $this->getEnvironment();
//        return dirname(__DIR__).'/var/cache/'.$this->getEnvironment();
    }

    /**
     * {@inheritdoc}
     */
    public function getLogDir(): string
    {
        if ($this->isVagrantEnvironment()) {
            return '/dev/shm/sylius/logs';
        }

        return dirname($this->getRootDir()) . '/var/logs';
//        return dirname(__DIR__).'/var/logs';
    }

    /**
     * @return bool
     */
    protected function isVagrantEnvironment(): bool
    {
        return (getenv('HOME') === '/home/vagrant' || getenv('VAGRANT') === 'VAGRANT') && is_dir('/dev/shm');
    }

//    public function getRootDir()
//    {
//        return __DIR__;
//    }
}
