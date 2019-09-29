<?php

declare(strict_types=1);

namespace Bundle\CoreBundle\DataFixtures\ORM;

use Bundle\TicketBundle\Entity\PaymentType;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Bundle\PointofsaleBundle\Entity\PointofsaleHasProduct;

class Load_21_PdvHasProductData extends AbstractFixture implements OrderedFixtureInterface
{

    protected $applicationUrl;

    public function __construct($applicationUrl)
    {
        $this->applicationUrl = $applicationUrl;
    }

    public function load(ObjectManager $manager)
    {
	    $product_1 = $this->getReference('product-1');
	    $product_2 = $this->getReference('product-2');
	    $product_3 = $this->getReference('product-3');
	    $product_4 = $this->getReference('product-4');
	    $product_5 = $this->getReference('product-5');
	    $product_6 = $this->getReference('product-6');
	    $product_7 = $this->getReference('product-7');
	    $product_8 = $this->getReference('product-8');
	    $product_9 = $this->getReference('product-9');
	    $product_10 = $this->getReference('product-10');
	    $product_11 = $this->getReference('product-11');
	    $product_12 = $this->getReference('product-12');
	    
	    $pointofsale_3 = $this->getReference('pointofsale-3');
	    $pointofsale_4 = $this->getReference('pointofsale-4');
	
	
	    /**
	     * PDV 3
	     */
        $entity = new PointofsaleHasProduct();
	    $entity->setProduct($product_1);
	    $entity->setPointOfSale($pointofsale_3);
	    $entity->setStock(11);
        $manager->persist($entity);

        $entity = new PointofsaleHasProduct();
	    $entity->setProduct($product_2);
	    $entity->setPointOfSale($pointofsale_3);
	    $entity->setStock(22);
        $manager->persist($entity);
        
        $entity = new PointofsaleHasProduct();
	    $entity->setProduct($product_3);
	    $entity->setPointOfSale($pointofsale_3);
	    $entity->setStock(33);
        $manager->persist($entity);
        
        $entity = new PointofsaleHasProduct();
	    $entity->setProduct($product_4);
	    $entity->setPointOfSale($pointofsale_3);
	    $entity->setStock(44);
        $manager->persist($entity);
        
        $entity = new PointofsaleHasProduct();
	    $entity->setProduct($product_5);
	    $entity->setPointOfSale($pointofsale_3);
	    $entity->setStock(55);
        $manager->persist($entity);
        
        $entity = new PointofsaleHasProduct();
	    $entity->setProduct($product_6);
	    $entity->setPointOfSale($pointofsale_3);
	    $entity->setStock(66);
        $manager->persist($entity);
        
        $entity = new PointofsaleHasProduct();
	    $entity->setProduct($product_7);
	    $entity->setPointOfSale($pointofsale_3);
	    $entity->setStock(77);
        $manager->persist($entity);
        
        $entity = new PointofsaleHasProduct();
	    $entity->setProduct($product_8);
	    $entity->setPointOfSale($pointofsale_3);
	    $entity->setStock(88);
        $manager->persist($entity);
        
        $entity = new PointofsaleHasProduct();
	    $entity->setProduct($product_9);
	    $entity->setPointOfSale($pointofsale_3);
	    $entity->setStock(99);
        $manager->persist($entity);
        
        $entity = new PointofsaleHasProduct();
	    $entity->setProduct($product_10);
	    $entity->setPointOfSale($pointofsale_3);
	    $entity->setStock(234);
        $manager->persist($entity);
        
        $entity = new PointofsaleHasProduct();
	    $entity->setProduct($product_11);
	    $entity->setPointOfSale($pointofsale_3);
	    $entity->setStock(456);
        $manager->persist($entity);
        
        $entity = new PointofsaleHasProduct();
	    $entity->setProduct($product_12);
	    $entity->setPointOfSale($pointofsale_3);
	    $entity->setStock(789);
        $manager->persist($entity);
	
	
        
        
	    /**
	     * PDV 4
	     */
	    $entity = new PointofsaleHasProduct();
	    $entity->setProduct($product_1);
	    $entity->setPointOfSale($pointofsale_4);
	    $entity->setStock(345);
	    $manager->persist($entity);
	
	    $entity = new PointofsaleHasProduct();
	    $entity->setProduct($product_2);
	    $entity->setPointOfSale($pointofsale_4);
	    $entity->setStock(543);
	    $manager->persist($entity);
	    
        $entity = new PointofsaleHasProduct();
	    $entity->setProduct($product_3);
	    $entity->setPointOfSale($pointofsale_4);
	    $entity->setStock(567);
        $manager->persist($entity);
	
	    $entity = new PointofsaleHasProduct();
	    $entity->setProduct($product_4);
	    $entity->setPointOfSale($pointofsale_4);
	    $entity->setStock(876);
	    $manager->persist($entity);
        
	    
	    
	    
        $manager->flush();

    }

    public function getOrder()
    {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 21;
    }
}