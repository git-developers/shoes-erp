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
	    $entity->setName('Red');
	    $entity->setPrefix('#FF0000');
	    $entity->setIsActive(true);
        $manager->persist($entity);
        $this->addReference('color-1', $entity);

        $entity = new Color();
	    $entity->setName('Blue');
	    $entity->setPrefix('#0000FF');
	    $entity->setIsActive(true);
        $manager->persist($entity);
        $this->addReference('color-2', $entity);

        $entity = new Color();
	    $entity->setName('Green');
	    $entity->setPrefix('#00FF00');
	    $entity->setIsActive(true);
        $manager->persist($entity);
        $this->addReference('color-3', $entity);

        $entity = new Color();
	    $entity->setName('Yellow');
	    $entity->setPrefix('#FFFF00');
	    $entity->setIsActive(true);
        $manager->persist($entity);
        $this->addReference('color-4', $entity);
        
        
        $manager->flush();

    }

    public function getOrder()
    {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 18;
    }
}