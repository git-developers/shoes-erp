<?php

declare(strict_types=1);

namespace Bundle\CoreBundle\DataFixtures\ORM;

use Bundle\ProductBundle\Entity\Product;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class Load_17_ProductoData extends AbstractFixture implements OrderedFixtureInterface
{

    protected $applicationUrl;

    public function __construct($applicationUrl)
    {
        $this->applicationUrl = $applicationUrl;
    }

    public function load(ObjectManager $manager)
    {

        $category_1 = $this->getReference('category-1');
        $category_2 = $this->getReference('category-2');
        $category_3 = $this->getReference('category-3');

	
	
	    /**
	     * CATEGORY 1
	     */
        $entity = new Product();
	    $entity->setStock(35);
	    $entity->setCode('111');
	    $entity->setName('Producto 1');
	    $entity->setCategory($category_1);
        $manager->persist($entity);
        $this->addReference('product-1', $entity);

        $entity = new Product();
	    $entity->setStock(67);
	    $entity->setCode('222');
	    $entity->setName('Producto 2');
	    $entity->setCategory($category_1);
        $manager->persist($entity);
        $this->addReference('product-2', $entity);
        
        $entity = new Product();
	    $entity->setStock(25);
	    $entity->setCode('333');
	    $entity->setName('Producto 3');
	    $entity->setCategory($category_1);
        $manager->persist($entity);
        $this->addReference('product-3', $entity);
        
        $entity = new Product();
	    $entity->setStock(98);
	    $entity->setCode('444');
	    $entity->setName('Producto 4');
	    $entity->setCategory($category_1);
        $manager->persist($entity);
        $this->addReference('product-4', $entity);
        
        $entity = new Product();
	    $entity->setStock(15);
	    $entity->setCode('555');
	    $entity->setName('Producto 5');
	    $entity->setCategory($category_1);
        $manager->persist($entity);
        $this->addReference('product-5', $entity);

        

	    /**
	     * CATEGORY 2
	     */
        $entity = new Product();
	    $entity->setStock(35);
	    $entity->setCode('666');
	    $entity->setName('Producto 6');
	    $entity->setCategory($category_2);
        $manager->persist($entity);
        $this->addReference('product-6', $entity);

        $entity = new Product();
	    $entity->setStock(67);
	    $entity->setCode('777');
	    $entity->setName('Producto 7');
	    $entity->setCategory($category_2);
        $manager->persist($entity);
        $this->addReference('product-7', $entity);
        
        $entity = new Product();
	    $entity->setStock(25);
	    $entity->setCode('888');
	    $entity->setName('Producto 8');
	    $entity->setCategory($category_2);
        $manager->persist($entity);
        $this->addReference('product-8', $entity);
        
        $entity = new Product();
	    $entity->setStock(98);
	    $entity->setCode('999');
	    $entity->setName('Producto 9');
	    $entity->setCategory($category_2);
        $manager->persist($entity);
        $this->addReference('product-9', $entity);
	
	
	    /**
	     * CATEGORY 3
	     */
        $entity = new Product();
	    $entity->setStock(78);
	    $entity->setCode('1010');
	    $entity->setName('Producto 10');
	    $entity->setCategory($category_3);
        $manager->persist($entity);
        $this->addReference('product-10', $entity);
        
        $entity = new Product();
	    $entity->setStock(34);
	    $entity->setCode('1111');
	    $entity->setName('Producto 11');
	    $entity->setCategory($category_3);
        $manager->persist($entity);
        $this->addReference('product-11', $entity);
        
        $entity = new Product();
	    $entity->setStock(22);
	    $entity->setCode('1212');
	    $entity->setName('Producto 12');
	    $entity->setCategory($category_3);
        $manager->persist($entity);
        $this->addReference('product-12', $entity);

        
        
        $manager->flush();

    }

    public function getOrder()
    {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 17;
    }
}