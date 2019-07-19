<?php

declare(strict_types=1);

namespace Bundle\CoreBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Bundle\ServicesBundle\Entity\Services;

class Load_16_ServicesData extends AbstractFixture implements OrderedFixtureInterface
{

    protected $applicationUrl;

    public function __construct($applicationUrl)
    {
        $this->applicationUrl = $applicationUrl;
    }

    public function load(ObjectManager $manager)
    {
	
	    $category10 = $this->getReference('category-10');
	    $category11 = $this->getReference('category-11');
	    $category12 = $this->getReference('category-12');
	    $category13 = $this->getReference('category-13');
	    $category14 = $this->getReference('category-14');
	    

        /**
         * SERVICE 10
         */
        $entity = new Services();
        $entity->setCode('001');
        $entity->setName('Servicio 1');
        $entity->setPrice(25.33);
        $entity->setCategory($category10);
        $manager->persist($entity);
        $this->addReference('services-1', $entity);

        $entity = new Services();
        $entity->setCode('002');
        $entity->setName('Servicio 2');
	    $entity->setPrice(56.33);
        $entity->setCategory($category10);
        $manager->persist($entity);
        $this->addReference('services-2', $entity);

        $entity = new Services();
        $entity->setCode('003');
        $entity->setName('Servicio 3');
	    $entity->setPrice(28.33);
        $entity->setCategory($category10);
        $manager->persist($entity);
        $this->addReference('services-3', $entity);

        $entity = new Services();
        $entity->setCode('004');
        $entity->setName('Servicio 4');
	    $entity->setPrice(72.12);
        $entity->setCategory($category10);
        $manager->persist($entity);
        $this->addReference('services-4', $entity);
	
	
	    /**
	     * SERVICE 11
	     */
        $entity = new Services();
        $entity->setCode('005');
        $entity->setName('Servicio 5');
	    $entity->setPrice(67.12);
        $entity->setCategory($category11);
        $manager->persist($entity);
        $this->addReference('services-5', $entity);

        $entity = new Services();
        $entity->setCode('006');
        $entity->setName('Servicio 6');
	    $entity->setPrice(38.45);
        $entity->setCategory($category11);
        $manager->persist($entity);
        $this->addReference('services-6', $entity);
	
	
	    /**
	     * SERVICE 12
	     */
        $entity = new Services();
        $entity->setCode('007');
        $entity->setName('Servicio 7');
	    $entity->setPrice(87.43);
        $entity->setCategory($category12);
        $manager->persist($entity);
        $this->addReference('services-66', $entity);

        $entity = new Services();
        $entity->setCode('008');
        $entity->setName('Servicio 8');
	    $entity->setPrice(56.67);
        $entity->setCategory($category12);
        $manager->persist($entity);
        $this->addReference('services-8', $entity);

        $entity = new Services();
        $entity->setCode('009');
        $entity->setName('Servicio 9');
	    $entity->setPrice(123.44);
        $entity->setCategory($category12);
        $manager->persist($entity);
        $this->addReference('services-9', $entity);
        
	
	    /**
	     * SERVICE 13
	     */
	    $entity = new Services();
	    $entity->setCode('010');
	    $entity->setName('Servicio 10');
	    $entity->setPrice(78.25);
	    $entity->setCategory($category13);
	    $manager->persist($entity);
	    $this->addReference('services-10', $entity);
	
	    $entity = new Services();
	    $entity->setCode('011');
	    $entity->setName('Servicio 11');
	    $entity->setPrice(34.67);
	    $entity->setCategory($category13);
	    $manager->persist($entity);
	    $this->addReference('services-11', $entity);

	
	    /**
	     * SERVICE 14
	     */
	    $entity = new Services();
	    $entity->setCode('012');
	    $entity->setName('Servicio 12');
	    $entity->setPrice(15.45);
	    $entity->setCategory($category14);
	    $manager->persist($entity);
	    $this->addReference('services-12', $entity);
	    
	    
	    
        $manager->flush();

    }

    public function getOrder()
    {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 16;
    }
}