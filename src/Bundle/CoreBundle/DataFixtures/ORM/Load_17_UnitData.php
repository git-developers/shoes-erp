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
	
//	    $product_1 = $this->getReference('product-1');
//	    $product_2 = $this->getReference('product-2');
     
	    
	    //UNIT 1
        $entity = new Unit();
	    $entity->setName('paquete');
	    $entity->setIsActive(true);
        $manager->persist($entity);
	
//	    $product_1->setUnit($entity);
//	    $manager->persist($product_1);
        
        $this->addReference('unit-1', $entity);
	
	
	    //UNIT 2
	    $entity = new Unit();
	    $entity->setName('unidades');
	    $entity->setIsActive(true);
	    $manager->persist($entity);
	
//	    $product_2->setUnit($entity);
//	    $manager->persist($product_2);
	
	    $this->addReference('unit-2', $entity);
        
	    
	    
        /*
         *
        //UNIT 3
        $entity = new Unit();
	    $entity->setName('gramos');
	    $entity->setIsActive(true);
        $manager->persist($entity);
	
	    $product_1->setUnit($entity);
	    $manager->persist($product_1);
        
        $this->addReference('unit-3', $entity);
        
        
        //UNIT 4
        $entity = new Unit();
	    $entity->setName('onzas');
	    $entity->setIsActive(true);
        $manager->persist($entity);
	
	    $product_1->setUnit($entity);
	    $manager->persist($product_1);
        
        $this->addReference('unit-4', $entity);
        
        
        //UNIT 5
        $entity = new Unit();
	    $entity->setName('mililitros');
	    $entity->setIsActive(true);
        $manager->persist($entity);
	
	    $product_2->setUnit($entity);
	    $manager->persist($product_2);
        
        $this->addReference('unit-5', $entity);

        
        //UNIT 6
        $entity = new Unit();
	    $entity->setName('ampollas');
	    $entity->setIsActive(true);
        $manager->persist($entity);
	
	    $product_2->setUnit($entity);
	    $manager->persist($product_2);
        
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