<?php

declare(strict_types=1);

namespace Bundle\CoreBundle\DataFixtures\ORM;

use Bundle\ProductBundle\Entity\Product;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class Load_18_ProductoData extends AbstractFixture implements OrderedFixtureInterface
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
        
        $unit_1 = $this->getReference('unit-1');

		
	
	    /**
	     * CATEGORY 1
	     */
        $entity = new Product();
	    $entity->setColor('#0000FF');
	    $entity->setSize(10);
	    $entity->setStock(35);
	    $entity->setCode('111');
	    $entity->setPrice(25.33);
	    $entity->setUnit($unit_1);
	    $entity->setName('Producto 1');
	    $entity->setCategory($category_1);
        $manager->persist($entity);
        $this->addReference('product-1', $entity);

        $entity = new Product();
	    $entity->setColor('#FF0000');
	    $entity->setSize(9);
	    $entity->setStock(67);
	    $entity->setCode('222');
	    $entity->setPrice(67.77);
	    $entity->setUnit($unit_1);
	    $entity->setName('Producto 2');
	    $entity->setCategory($category_1);
        $manager->persist($entity);
        $this->addReference('product-2', $entity);
        
        $entity = new Product();
	    $entity->setColor('#00FF00');
	    $entity->setSize(8);
	    $entity->setStock(25);
	    $entity->setCode('333');
	    $entity->setPrice(15.33);
	    $entity->setUnit($unit_1);
	    $entity->setName('Producto 3');
	    $entity->setCategory($category_1);
        $manager->persist($entity);
        $this->addReference('product-3', $entity);
        
        $entity = new Product();
	    $entity->setColor('#0000FF');
	    $entity->setSize(10);
	    $entity->setStock(98);
	    $entity->setCode('444');
	    $entity->setPrice(12.33);
	    $entity->setUnit($unit_1);
	    $entity->setName('Producto 4');
	    $entity->setCategory($category_1);
        $manager->persist($entity);
        $this->addReference('product-4', $entity);
        
        $entity = new Product();
	    $entity->setColor('#FF0000');
	    $entity->setSize(11);
	    $entity->setStock(15);
	    $entity->setCode('555');
	    $entity->setPrice(43.33);
	    $entity->setUnit($unit_1);
	    $entity->setName('Producto 5');
	    $entity->setCategory($category_1);
        $manager->persist($entity);
        $this->addReference('product-5', $entity);

        

	    /**
	     * CATEGORY 2
	     */
        $entity = new Product();
	    $entity->setColor('#00FF00');
	    $entity->setSize(12);
	    $entity->setStock(35);
	    $entity->setCode('666');
	    $entity->setPrice(23.44);
	    $entity->setUnit($unit_1);
	    $entity->setName('Producto 6');
	    $entity->setCategory($category_2);
        $manager->persist($entity);
        $this->addReference('product-6', $entity);

        $entity = new Product();
	    $entity->setColor('#0000FF');
	    $entity->setSize(9);
	    $entity->setSize(10);
	    $entity->setStock(67);
	    $entity->setCode('777');
	    $entity->setPrice(99.22);
	    $entity->setUnit($unit_1);
	    $entity->setName('Producto 7');
	    $entity->setCategory($category_2);
        $manager->persist($entity);
        $this->addReference('product-7', $entity);
        
        $entity = new Product();
	    $entity->setColor('#FF0000');
	    $entity->setSize(8);
	    $entity->setStock(25);
	    $entity->setCode('888');
	    $entity->setPrice(77.88);
	    $entity->setUnit($unit_1);
	    $entity->setName('Producto 8');
	    $entity->setCategory($category_2);
        $manager->persist($entity);
        $this->addReference('product-8', $entity);
        
        $entity = new Product();
	    $entity->setColor('#0000FF');
	    $entity->setSize(10);
	    $entity->setStock(98);
	    $entity->setCode('999');
	    $entity->setPrice(41.66);
	    $entity->setUnit($unit_1);
	    $entity->setName('Producto 9');
	    $entity->setCategory($category_2);
        $manager->persist($entity);
        $this->addReference('product-9', $entity);
	
	
	    /**
	     * CATEGORY 3
	     */
        $entity = new Product();
	    $entity->setColor('#FF0000');
	    $entity->setSize(12);
	    $entity->setStock(78);
	    $entity->setCode('1010');
	    $entity->setPrice(67.55);
	    $entity->setUnit($unit_1);
	    $entity->setName('Producto 10');
	    $entity->setCategory($category_3);
        $manager->persist($entity);
        $this->addReference('product-10', $entity);
        
        $entity = new Product();
	    $entity->setColor('#0000FF');
	    $entity->setSize(11);
	    $entity->setStock(34);
	    $entity->setCode('1111');
	    $entity->setPrice(45.22);
	    $entity->setUnit($unit_1);
	    $entity->setName('Producto 11');
	    $entity->setCategory($category_3);
        $manager->persist($entity);
        $this->addReference('product-11', $entity);
        
        $entity = new Product();
	    $entity->setColor('#00FF00');
	    $entity->setSize(10);
	    $entity->setStock(22);
	    $entity->setCode('1212');
	    $entity->setPrice(14.33);
	    $entity->setUnit($unit_1);
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
        return 18;
    }
}