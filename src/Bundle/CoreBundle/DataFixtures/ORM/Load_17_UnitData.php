<?php

declare(strict_types=1);

namespace Bundle\CoreBundle\DataFixtures\ORM;

use Bundle\ProductBundle\Entity\Unit;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class Load_17_UnitData extends AbstractFixture implements OrderedFixtureInterface
{

    protected $applicationUrl;

    public function __construct($applicationUrl)
    {
        $this->applicationUrl = $applicationUrl;
    }

    public function load(ObjectManager $manager)
    {
    	
//        $entity = new Unit();
//	    $entity->setName("Paquete 0.5 docena");
//	    $entity->setSlug(Unit::PAQUETE_6);
//	    $entity->setUnitValue(6);
//	    $entity->setIsActive(true);
//        $manager->persist($entity);
//        $this->addReference('unit-1', $entity);
    	
        $entity = new Unit();
	    $entity->setName("Paquete 1 docena");
	    $entity->setSlug(Unit::PAQUETE_12);
	    $entity->setUnitValue(12);
	    $entity->setIsActive(true);
        $manager->persist($entity);
        $this->addReference('unit-1', $entity);
	
        
	    $entity = new Unit();
	    $entity->setName("Una unidad");
	    $entity->setSlug(Unit::UNIDAD);
	    $entity->setUnitValue(1);
	    $entity->setIsActive(true);
	    $manager->persist($entity);
	    $this->addReference('unit-3', $entity);
        
	    
	    
        /*
		
        //UNIT 3
        $entity = new Unit();
	    $entity->setName('gramos');
	    $entity->setIsActive(true);
        $manager->persist($entity);
        $this->addReference('unit-3', $entity);
        
        
        //UNIT 4
        $entity = new Unit();
	    $entity->setName('onzas');
	    $entity->setIsActive(true);
        $manager->persist($entity);
        $this->addReference('unit-4', $entity);
        
        
        //UNIT 5
        $entity = new Unit();
	    $entity->setName('mililitros');
	    $entity->setIsActive(true);
        $manager->persist($entity);
        $this->addReference('unit-5', $entity);

        
        //UNIT 6
        $entity = new Unit();
	    $entity->setName('ampollas');
	    $entity->setIsActive(true);
        $manager->persist($entity);
        $this->addReference('unit-6', $entity);
        */
        
        $manager->flush();

    }

    public function getOrder()
    {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 17;
    }
}