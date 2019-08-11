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
	    
	    $pointofsale_3 = $this->getReference('pointofsale-3');
	    $pointofsale_4 = $this->getReference('pointofsale-4');
    	
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
	    $entity->setProduct($product_3);
	    $entity->setPointOfSale($pointofsale_4);
	    $entity->setStock(55);
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