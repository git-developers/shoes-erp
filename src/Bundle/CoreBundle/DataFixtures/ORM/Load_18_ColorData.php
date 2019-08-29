<?php

declare(strict_types=1);

namespace Bundle\CoreBundle\DataFixtures\ORM;

use Bundle\ProductBundle\Entity\Color;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class Load_18_ColorData extends AbstractFixture implements OrderedFixtureInterface
{

    protected $applicationUrl;

    public function __construct($applicationUrl)
    {
        $this->applicationUrl = $applicationUrl;
    }

    public function load(ObjectManager $manager)
    {
    	
        $entity = new Color();
	    $entity->setName('ROJO');
	    $entity->setPrefix('#FF0000');
	    $entity->setIsActive(true);
        $manager->persist($entity);
        $this->addReference('color-1', $entity);

        $entity = new Color();
	    $entity->setName('AZUL');
	    $entity->setPrefix('#0000FF');
	    $entity->setIsActive(true);
        $manager->persist($entity);
        $this->addReference('color-2', $entity);

        $entity = new Color();
	    $entity->setName('VERDE');
	    $entity->setPrefix('#00FF00');
	    $entity->setIsActive(true);
        $manager->persist($entity);
        $this->addReference('color-3', $entity);

        $entity = new Color();
	    $entity->setName('BLANCO');
	    $entity->setPrefix('#FFFFFF');
	    $entity->setIsActive(true);
        $manager->persist($entity);
        $this->addReference('color-4', $entity);

        $entity = new Color();
	    $entity->setName('CAMOTE');
	    $entity->setPrefix('#CC6600');
	    $entity->setIsActive(true);
        $manager->persist($entity);
        $this->addReference('color-5', $entity);

        $entity = new Color();
	    $entity->setName('CHICLE');
	    $entity->setPrefix('#FF6666');
	    $entity->setIsActive(true);
        $manager->persist($entity);
        $this->addReference('color-6', $entity);

        $entity = new Color();
	    $entity->setName('COBRE');
	    $entity->setPrefix('#FFCC66');
	    $entity->setIsActive(true);
        $manager->persist($entity);
        $this->addReference('color-7', $entity);

        $entity = new Color();
	    $entity->setName('CORAL');
	    $entity->setPrefix('#FFFF00');
	    $entity->setIsActive(true);
        $manager->persist($entity);
        $this->addReference('color-8', $entity);

        $entity = new Color();
	    $entity->setName('HUESO');
	    $entity->setPrefix('#FFCC66');
	    $entity->setIsActive(true);
        $manager->persist($entity);
        $this->addReference('color-9', $entity);

        $entity = new Color();
	    $entity->setName('LILA');
	    $entity->setPrefix('#FF3399');
	    $entity->setIsActive(true);
        $manager->persist($entity);
        $this->addReference('color-10', $entity);

        $entity = new Color();
	    $entity->setName('MIEL');
	    $entity->setPrefix('#FFCC00');
	    $entity->setIsActive(true);
        $manager->persist($entity);
        $this->addReference('color-11', $entity);

        $entity = new Color();
	    $entity->setName('MORO');
	    $entity->setPrefix('#FFFF00');
	    $entity->setIsActive(true);
        $manager->persist($entity);
        $this->addReference('color-12', $entity);

        $entity = new Color();
	    $entity->setName('NEGRO');
	    $entity->setPrefix('#000000');
	    $entity->setIsActive(true);
        $manager->persist($entity);
        $this->addReference('color-13', $entity);

        $entity = new Color();
	    $entity->setName('NUBE');
	    $entity->setPrefix('#33FFFF');
	    $entity->setIsActive(true);
        $manager->persist($entity);
        $this->addReference('color-14', $entity);

        $entity = new Color();
	    $entity->setName('NUDE');
	    $entity->setPrefix('#FFFF00');
	    $entity->setIsActive(true);
        $manager->persist($entity);
        $this->addReference('color-15', $entity);

        $entity = new Color();
	    $entity->setName('NUDE CON LILA Y ROSADO');
	    $entity->setPrefix('#FFFF00');
	    $entity->setIsActive(true);
        $manager->persist($entity);
        $this->addReference('color-16', $entity);

        $entity = new Color();
	    $entity->setName('PACAY');
	    $entity->setPrefix('#00CC66');
	    $entity->setIsActive(true);
        $manager->persist($entity);
        $this->addReference('color-17', $entity);

        $entity = new Color();
	    $entity->setName('ROSADO');
	    $entity->setPrefix('#FF9966');
	    $entity->setIsActive(true);
        $manager->persist($entity);
        $this->addReference('color-18', $entity);
        
        
        $manager->flush();

    }

    public function getOrder()
    {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 18;
    }
}