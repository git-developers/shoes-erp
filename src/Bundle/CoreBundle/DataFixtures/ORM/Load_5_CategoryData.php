<?php

declare(strict_types=1);

namespace Bundle\CoreBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Bundle\CategoryBundle\Entity\Category;

class Load_5_CategoryData extends AbstractFixture implements OrderedFixtureInterface
{

    protected $applicationUrl;

    public function __construct($applicationUrl)
    {
        $this->applicationUrl = $applicationUrl;
    }

    public function load(ObjectManager $manager)
    {
	
	    $pointofsale_3 = $this->getReference('pointofsale-3');

        /**
         * CATEGORY PARENT
         */
        $entity2 = new Category();
        $entity2->setName('PIBE NORMAL NIÑA 18-21');
        $entity2->setType(Category::TYPE_PRODUCT);
        $manager->persist($entity2);
	    $pointofsale_3->addCategory($entity2);
        $manager->persist($pointofsale_3);
        
	
        
        
	    $child = new Category();
	    $child->setName('J-505');
	    $child->setType(Category::TYPE_PRODUCT);
	    $child->setCategory($entity2);
	    $manager->persist($child);
	    $pointofsale_3->addCategory($child);
	    $manager->persist($pointofsale_3);
	    $this->addReference('category-3', $child);
	    
	
	    $o = new Category();
	    $o->setName('18 - 21');
	    $o->setType(Category::TYPE_PRODUCT);
	    $o->setCategory($child);
	    $manager->persist($o);
	    $pointofsale_3->addCategory($o);
	    $manager->persist($pointofsale_3);
	    $this->addReference('category-1', $o);
	
	    $o = new Category();
	    $o->setName('19 - 21');
	    $o->setType(Category::TYPE_PRODUCT);
	    $o->setCategory($child);
	    $manager->persist($o);
	    $pointofsale_3->addCategory($o);
	    $manager->persist($pointofsale_3);
	    $this->addReference('category-5', $o);
	
	
	    
	    
	    $child = new Category();
	    $child->setName('J-509');
	    $child->setType(Category::TYPE_PRODUCT);
	    $child->setCategory($entity2);
	    $manager->persist($child);
	    $pointofsale_3->addCategory($child);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-2', $child);
	
	    $o = new Category();
	    $o->setName('18 - 21');
	    $o->setType(Category::TYPE_PRODUCT);
	    $o->setCategory($child);
	    $manager->persist($o);
	    $pointofsale_3->addCategory($o);
	    $manager->persist($pointofsale_3);
	    $this->addReference('category-4', $o);
	
	    $a = new Category();
	    $a->setName('19 - 21');
	    $a->setType(Category::TYPE_PRODUCT);
	    $a->setCategory($child);
	    $manager->persist($a);
	    $pointofsale_3->addCategory($a);
	    $manager->persist($pointofsale_3);
	    $this->addReference('category-2', $a);
	    
	    
	    
	    
		
	    $child = new Category();
	    $child->setName('J-512');
	    $child->setType(Category::TYPE_PRODUCT);
	    $child->setCategory($entity2);
	    $manager->persist($child);
	    $pointofsale_3->addCategory($child);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-8', $child);
	
	    $o = new Category();
	    $o->setName('18 - 21');
	    $o->setType(Category::TYPE_PRODUCT);
	    $o->setCategory($child);
	    $manager->persist($o);
	    $pointofsale_3->addCategory($o);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-9', $o);
	
	    $o = new Category();
	    $o->setName('19 - 21');
	    $o->setType(Category::TYPE_PRODUCT);
	    $o->setCategory($child);
	    $manager->persist($o);
	    $pointofsale_3->addCategory($o);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-10', $o);
	    
	    
	    
	    
	
	    $child = new Category();
	    $child->setName('J-515');
	    $child->setType(Category::TYPE_PRODUCT);
	    $child->setCategory($entity2);
	    $manager->persist($child);
	    $pointofsale_3->addCategory($child);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-11', $child);
	
	    $o = new Category();
	    $o->setName('18 - 21');
	    $o->setType(Category::TYPE_PRODUCT);
	    $o->setCategory($child);
	    $manager->persist($o);
	    $pointofsale_3->addCategory($o);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-12', $o);
	
	    $o = new Category();
	    $o->setName('19 - 21');
	    $o->setType(Category::TYPE_PRODUCT);
	    $o->setCategory($child);
	    $manager->persist($o);
	    $pointofsale_3->addCategory($o);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-13', $o);
	    
	    
	
	    
	    
	    $child = new Category();
	    $child->setName('J-520');
	    $child->setType(Category::TYPE_PRODUCT);
	    $child->setCategory($entity2);
	    $manager->persist($child);
	    $pointofsale_3->addCategory($child);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-14', $child);
	
	    $o = new Category();
	    $o->setName('18 - 21');
	    $o->setType(Category::TYPE_PRODUCT);
	    $o->setCategory($child);
	    $manager->persist($o);
	    $pointofsale_3->addCategory($o);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-15', $o);
	
	    $o = new Category();
	    $o->setName('19 - 21');
	    $o->setType(Category::TYPE_PRODUCT);
	    $o->setCategory($child);
	    $manager->persist($o);
	    $pointofsale_3->addCategory($o);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-16', $o);
	    
	    
	    
	    
	
	    $child = new Category();
	    $child->setName('J-521');
	    $child->setType(Category::TYPE_PRODUCT);
	    $child->setCategory($entity2);
	    $manager->persist($child);
	    $pointofsale_3->addCategory($child);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-17', $child);
	
	    $o = new Category();
	    $o->setName('18 - 21');
	    $o->setType(Category::TYPE_PRODUCT);
	    $o->setCategory($child);
	    $manager->persist($o);
	    $pointofsale_3->addCategory($o);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-18', $o);
	
	    $o = new Category();
	    $o->setName('19 - 21');
	    $o->setType(Category::TYPE_PRODUCT);
	    $o->setCategory($child);
	    $manager->persist($o);
	    $pointofsale_3->addCategory($o);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-19', $o);
	    
	    
	    
	    
	
	    $child = new Category();
	    $child->setName('J-522');
	    $child->setType(Category::TYPE_PRODUCT);
	    $child->setCategory($entity2);
	    $manager->persist($child);
	    $pointofsale_3->addCategory($child);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-20', $child);
	
	    $o = new Category();
	    $o->setName('18 - 21');
	    $o->setType(Category::TYPE_PRODUCT);
	    $o->setCategory($child);
	    $manager->persist($o);
	    $pointofsale_3->addCategory($o);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-21', $o);
	
	    $o = new Category();
	    $o->setName('19 - 21');
	    $o->setType(Category::TYPE_PRODUCT);
	    $o->setCategory($child);
	    $manager->persist($o);
	    $pointofsale_3->addCategory($o);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-22', $o);
	    
	    
	    
	    
	
	    $child = new Category();
	    $child->setName('J-531');
	    $child->setType(Category::TYPE_PRODUCT);
	    $child->setCategory($entity2);
	    $manager->persist($child);
	    $pointofsale_3->addCategory($child);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-23', $child);
	
	    $o = new Category();
	    $o->setName('18 - 21');
	    $o->setType(Category::TYPE_PRODUCT);
	    $o->setCategory($child);
	    $manager->persist($o);
	    $pointofsale_3->addCategory($o);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-24', $o);
	
	    $o = new Category();
	    $o->setName('19 - 21');
	    $o->setType(Category::TYPE_PRODUCT);
	    $o->setCategory($child);
	    $manager->persist($o);
	    $pointofsale_3->addCategory($o);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-25', $o);
	    
	    
	    
	    
	    
	
	    $child = new Category();
	    $child->setName('J-532');
	    $child->setType(Category::TYPE_PRODUCT);
	    $child->setCategory($entity2);
	    $manager->persist($child);
	    $pointofsale_3->addCategory($child);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-26', $child);
	
	    $o = new Category();
	    $o->setName('18 - 21');
	    $o->setType(Category::TYPE_PRODUCT);
	    $o->setCategory($child);
	    $manager->persist($o);
	    $pointofsale_3->addCategory($o);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-27', $o);
	
	    $o = new Category();
	    $o->setName('19 - 21');
	    $o->setType(Category::TYPE_PRODUCT);
	    $o->setCategory($child);
	    $manager->persist($o);
	    $pointofsale_3->addCategory($o);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-28', $o);
	    
	    
	    
	    
	    
	    
	
	    $child = new Category();
	    $child->setName('J-533');
	    $child->setType(Category::TYPE_PRODUCT);
	    $child->setCategory($entity2);
	    $manager->persist($child);
	    $pointofsale_3->addCategory($child);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-29', $child);
	
	    $o = new Category();
	    $o->setName('18 - 21');
	    $o->setType(Category::TYPE_PRODUCT);
	    $o->setCategory($child);
	    $manager->persist($o);
	    $pointofsale_3->addCategory($o);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-30', $o);
	
	    $o = new Category();
	    $o->setName('19 - 21');
	    $o->setType(Category::TYPE_PRODUCT);
	    $o->setCategory($child);
	    $manager->persist($o);
	    $pointofsale_3->addCategory($o);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-31', $o);
	    
	    
	    
	    
	
	    $child = new Category();
	    $child->setName('J-535');
	    $child->setType(Category::TYPE_PRODUCT);
	    $child->setCategory($entity2);
	    $manager->persist($child);
	    $pointofsale_3->addCategory($child);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-32', $child);
	
	    $o = new Category();
	    $o->setName('18 - 21');
	    $o->setType(Category::TYPE_PRODUCT);
	    $o->setCategory($child);
	    $manager->persist($o);
	    $pointofsale_3->addCategory($o);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-33', $o);
	
	    $o = new Category();
	    $o->setName('19 - 21');
	    $o->setType(Category::TYPE_PRODUCT);
	    $o->setCategory($child);
	    $manager->persist($o);
	    $pointofsale_3->addCategory($o);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-34', $o);
	    
	    
	    
	    
	
	    $child = new Category();
	    $child->setName('J-537');
	    $child->setType(Category::TYPE_PRODUCT);
	    $child->setCategory($entity2);
	    $manager->persist($child);
	    $pointofsale_3->addCategory($child);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-35', $child);
	
	    $o = new Category();
	    $o->setName('18 - 21');
	    $o->setType(Category::TYPE_PRODUCT);
	    $o->setCategory($child);
	    $manager->persist($o);
	    $pointofsale_3->addCategory($o);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-36', $o);
	
	    $o = new Category();
	    $o->setName('19 - 21');
	    $o->setType(Category::TYPE_PRODUCT);
	    $o->setCategory($child);
	    $manager->persist($o);
	    $pointofsale_3->addCategory($o);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-37', $o);
	    
	    
	    
	    
	
	    $child = new Category();
	    $child->setName('J-539');
	    $child->setType(Category::TYPE_PRODUCT);
	    $child->setCategory($entity2);
	    $manager->persist($child);
	    $pointofsale_3->addCategory($child);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-38', $child);
	
	    $o = new Category();
	    $o->setName('18 - 21');
	    $o->setType(Category::TYPE_PRODUCT);
	    $o->setCategory($child);
	    $manager->persist($o);
	    $pointofsale_3->addCategory($o);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-39', $o);
	
	    $o = new Category();
	    $o->setName('19 - 21');
	    $o->setType(Category::TYPE_PRODUCT);
	    $o->setCategory($child);
	    $manager->persist($o);
	    $pointofsale_3->addCategory($o);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-2', $o);
	    
	    
	    
	    
	
	    $child = new Category();
	    $child->setName('J-543');
	    $child->setType(Category::TYPE_PRODUCT);
	    $child->setCategory($entity2);
	    $manager->persist($child);
	    $pointofsale_3->addCategory($child);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-2', $child);
	
	    $o = new Category();
	    $o->setName('18 - 21');
	    $o->setType(Category::TYPE_PRODUCT);
	    $o->setCategory($child);
	    $manager->persist($o);
	    $pointofsale_3->addCategory($o);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-2', $o);
	
	    $o = new Category();
	    $o->setName('19 - 21');
	    $o->setType(Category::TYPE_PRODUCT);
	    $o->setCategory($child);
	    $manager->persist($o);
	    $pointofsale_3->addCategory($o);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-2', $o);
	    
	    
	    
	
	    $child = new Category();
	    $child->setName('J-544');
	    $child->setType(Category::TYPE_PRODUCT);
	    $child->setCategory($entity2);
	    $manager->persist($child);
	    $pointofsale_3->addCategory($child);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-2', $child);
	
	    $o = new Category();
	    $o->setName('18 - 21');
	    $o->setType(Category::TYPE_PRODUCT);
	    $o->setCategory($child);
	    $manager->persist($o);
	    $pointofsale_3->addCategory($o);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-2', $o);
	
	    $o = new Category();
	    $o->setName('19 - 21');
	    $o->setType(Category::TYPE_PRODUCT);
	    $o->setCategory($child);
	    $manager->persist($o);
	    $pointofsale_3->addCategory($o);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-2', $o);
	    
	    
	    
	    
	    
	
	    $child = new Category();
	    $child->setName('J-546');
	    $child->setType(Category::TYPE_PRODUCT);
	    $child->setCategory($entity2);
	    $manager->persist($child);
	    $pointofsale_3->addCategory($child);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-2', $child);
	
	    $o = new Category();
	    $o->setName('18 - 21');
	    $o->setType(Category::TYPE_PRODUCT);
	    $o->setCategory($child);
	    $manager->persist($o);
	    $pointofsale_3->addCategory($o);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-2', $o);
	
	    $o = new Category();
	    $o->setName('19 - 21');
	    $o->setType(Category::TYPE_PRODUCT);
	    $o->setCategory($child);
	    $manager->persist($o);
	    $pointofsale_3->addCategory($o);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-2', $o);
	    
	    
	    
	    
	    
	
	    $child = new Category();
	    $child->setName('J-547');
	    $child->setType(Category::TYPE_PRODUCT);
	    $child->setCategory($entity2);
	    $manager->persist($child);
	    $pointofsale_3->addCategory($child);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-2', $child);
	
	    $o = new Category();
	    $o->setName('18 - 21');
	    $o->setType(Category::TYPE_PRODUCT);
	    $o->setCategory($child);
	    $manager->persist($o);
	    $pointofsale_3->addCategory($o);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-2', $o);
	
	    $o = new Category();
	    $o->setName('19 - 21');
	    $o->setType(Category::TYPE_PRODUCT);
	    $o->setCategory($child);
	    $manager->persist($o);
	    $pointofsale_3->addCategory($o);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-2', $o);
	    
	    
	    
	
	    $child = new Category();
	    $child->setName('J-548');
	    $child->setType(Category::TYPE_PRODUCT);
	    $child->setCategory($entity2);
	    $manager->persist($child);
	    $pointofsale_3->addCategory($child);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-2', $child);
	
	    $o = new Category();
	    $o->setName('18 - 21');
	    $o->setType(Category::TYPE_PRODUCT);
	    $o->setCategory($child);
	    $manager->persist($o);
	    $pointofsale_3->addCategory($o);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-2', $o);
	
	    $o = new Category();
	    $o->setName('19 - 21');
	    $o->setType(Category::TYPE_PRODUCT);
	    $o->setCategory($child);
	    $manager->persist($o);
	    $pointofsale_3->addCategory($o);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-2', $o);
	    
	    
	    
	
	    $child = new Category();
	    $child->setName('J-549');
	    $child->setType(Category::TYPE_PRODUCT);
	    $child->setCategory($entity2);
	    $manager->persist($child);
	    $pointofsale_3->addCategory($child);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-2', $child);
	
	    $o = new Category();
	    $o->setName('18 - 21');
	    $o->setType(Category::TYPE_PRODUCT);
	    $o->setCategory($child);
	    $manager->persist($o);
	    $pointofsale_3->addCategory($o);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-2', $o);
	
	    $o = new Category();
	    $o->setName('19 - 21');
	    $o->setType(Category::TYPE_PRODUCT);
	    $o->setCategory($child);
	    $manager->persist($o);
	    $pointofsale_3->addCategory($o);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-2', $o);
	    
	    
	    
	    
	
	    $child = new Category();
	    $child->setName('J-550');
	    $child->setType(Category::TYPE_PRODUCT);
	    $child->setCategory($entity2);
	    $manager->persist($child);
	    $pointofsale_3->addCategory($child);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-2', $child);
	
	    $o = new Category();
	    $o->setName('18 - 21');
	    $o->setType(Category::TYPE_PRODUCT);
	    $o->setCategory($child);
	    $manager->persist($o);
	    $pointofsale_3->addCategory($o);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-2', $o);
	
	    $o = new Category();
	    $o->setName('19 - 21');
	    $o->setType(Category::TYPE_PRODUCT);
	    $o->setCategory($child);
	    $manager->persist($o);
	    $pointofsale_3->addCategory($o);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-2', $o);
	    
	    
	    
	    
	
	    $child = new Category();
	    $child->setName('J-557');
	    $child->setType(Category::TYPE_PRODUCT);
	    $child->setCategory($entity2);
	    $manager->persist($child);
	    $pointofsale_3->addCategory($child);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-2', $child);
	
	    $o = new Category();
	    $o->setName('18 - 21');
	    $o->setType(Category::TYPE_PRODUCT);
	    $o->setCategory($child);
	    $manager->persist($o);
	    $pointofsale_3->addCategory($o);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-2', $o);
	
	    $o = new Category();
	    $o->setName('19 - 21');
	    $o->setType(Category::TYPE_PRODUCT);
	    $o->setCategory($child);
	    $manager->persist($o);
	    $pointofsale_3->addCategory($o);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-2', $o);
	    
	    
	    
	
	    $child = new Category();
	    $child->setName('J-559');
	    $child->setType(Category::TYPE_PRODUCT);
	    $child->setCategory($entity2);
	    $manager->persist($child);
	    $pointofsale_3->addCategory($child);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-2', $child);
	
	    $o = new Category();
	    $o->setName('18 - 21');
	    $o->setType(Category::TYPE_PRODUCT);
	    $o->setCategory($child);
	    $manager->persist($o);
	    $pointofsale_3->addCategory($o);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-2', $o);
	
	    $o = new Category();
	    $o->setName('19 - 21');
	    $o->setType(Category::TYPE_PRODUCT);
	    $o->setCategory($child);
	    $manager->persist($o);
	    $pointofsale_3->addCategory($o);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-2', $o);
	    
	    
	    
	    
	
	    $child = new Category();
	    $child->setName('J-562');
	    $child->setType(Category::TYPE_PRODUCT);
	    $child->setCategory($entity2);
	    $manager->persist($child);
	    $pointofsale_3->addCategory($child);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-2', $child);
	
	    $o = new Category();
	    $o->setName('18 - 21');
	    $o->setType(Category::TYPE_PRODUCT);
	    $o->setCategory($child);
	    $manager->persist($o);
	    $pointofsale_3->addCategory($o);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-2', $o);
	
	    $o = new Category();
	    $o->setName('19 - 21');
	    $o->setType(Category::TYPE_PRODUCT);
	    $o->setCategory($child);
	    $manager->persist($o);
	    $pointofsale_3->addCategory($o);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-2', $o);
	    
	    
	    
	
	    $child = new Category();
	    $child->setName('J-563');
	    $child->setType(Category::TYPE_PRODUCT);
	    $child->setCategory($entity2);
	    $manager->persist($child);
	    $pointofsale_3->addCategory($child);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-2', $child);
	
	    $o = new Category();
	    $o->setName('18 - 21');
	    $o->setType(Category::TYPE_PRODUCT);
	    $o->setCategory($child);
	    $manager->persist($o);
	    $pointofsale_3->addCategory($o);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-2', $o);
	
	    $o = new Category();
	    $o->setName('19 - 21');
	    $o->setType(Category::TYPE_PRODUCT);
	    $o->setCategory($child);
	    $manager->persist($o);
	    $pointofsale_3->addCategory($o);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-2', $o);
	    
	    
	    
	
	    $child = new Category();
	    $child->setName('J-564');
	    $child->setType(Category::TYPE_PRODUCT);
	    $child->setCategory($entity2);
	    $manager->persist($child);
	    $pointofsale_3->addCategory($child);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-2', $child);
	
	    $o = new Category();
	    $o->setName('18 - 21');
	    $o->setType(Category::TYPE_PRODUCT);
	    $o->setCategory($child);
	    $manager->persist($o);
	    $pointofsale_3->addCategory($o);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-2', $o);
	
	    $o = new Category();
	    $o->setName('19 - 21');
	    $o->setType(Category::TYPE_PRODUCT);
	    $o->setCategory($child);
	    $manager->persist($o);
	    $pointofsale_3->addCategory($o);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-2', $o);
	    
	    
	    
	    
	
	    $child = new Category();
	    $child->setName('J-565');
	    $child->setType(Category::TYPE_PRODUCT);
	    $child->setCategory($entity2);
	    $manager->persist($child);
	    $pointofsale_3->addCategory($child);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-2', $child);
	
	    $o = new Category();
	    $o->setName('18 - 21');
	    $o->setType(Category::TYPE_PRODUCT);
	    $o->setCategory($child);
	    $manager->persist($o);
	    $pointofsale_3->addCategory($o);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-2', $o);
	
	    $o = new Category();
	    $o->setName('19 - 21');
	    $o->setType(Category::TYPE_PRODUCT);
	    $o->setCategory($child);
	    $manager->persist($o);
	    $pointofsale_3->addCategory($o);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-2', $o);
	    
	    
	    
	    
	
	    $child = new Category();
	    $child->setName('J-566');
	    $child->setType(Category::TYPE_PRODUCT);
	    $child->setCategory($entity2);
	    $manager->persist($child);
	    $pointofsale_3->addCategory($child);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-2', $child);
	
	    $o = new Category();
	    $o->setName('18 - 21');
	    $o->setType(Category::TYPE_PRODUCT);
	    $o->setCategory($child);
	    $manager->persist($o);
	    $pointofsale_3->addCategory($o);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-2', $o);
	
	    $o = new Category();
	    $o->setName('19 - 21');
	    $o->setType(Category::TYPE_PRODUCT);
	    $o->setCategory($child);
	    $manager->persist($o);
	    $pointofsale_3->addCategory($o);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-2', $o);
	    
	    
	    
	    
	
	    $child = new Category();
	    $child->setName('J-568');
	    $child->setType(Category::TYPE_PRODUCT);
	    $child->setCategory($entity2);
	    $manager->persist($child);
	    $pointofsale_3->addCategory($child);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-2', $child);
	
	    $o = new Category();
	    $o->setName('18 - 21');
	    $o->setType(Category::TYPE_PRODUCT);
	    $o->setCategory($child);
	    $manager->persist($o);
	    $pointofsale_3->addCategory($o);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-2', $o);
	
	    $o = new Category();
	    $o->setName('19 - 21');
	    $o->setType(Category::TYPE_PRODUCT);
	    $o->setCategory($child);
	    $manager->persist($o);
	    $pointofsale_3->addCategory($o);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-2', $o);
	    
	    
	    
	    
	
	    $child = new Category();
	    $child->setName('J-572');
	    $child->setType(Category::TYPE_PRODUCT);
	    $child->setCategory($entity2);
	    $manager->persist($child);
	    $pointofsale_3->addCategory($child);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-2', $child);
	
	    $o = new Category();
	    $o->setName('18 - 21');
	    $o->setType(Category::TYPE_PRODUCT);
	    $o->setCategory($child);
	    $manager->persist($o);
	    $pointofsale_3->addCategory($o);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-2', $o);
	
	    $o = new Category();
	    $o->setName('19 - 21');
	    $o->setType(Category::TYPE_PRODUCT);
	    $o->setCategory($child);
	    $manager->persist($o);
	    $pointofsale_3->addCategory($o);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-2', $o);
	    
	    
	    
	    
	
	    $child = new Category();
	    $child->setName('J-573');
	    $child->setType(Category::TYPE_PRODUCT);
	    $child->setCategory($entity2);
	    $manager->persist($child);
	    $pointofsale_3->addCategory($child);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-2', $child);
	
	    $o = new Category();
	    $o->setName('18 - 21');
	    $o->setType(Category::TYPE_PRODUCT);
	    $o->setCategory($child);
	    $manager->persist($o);
	    $pointofsale_3->addCategory($o);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-2', $o);
	
	    $o = new Category();
	    $o->setName('19 - 21');
	    $o->setType(Category::TYPE_PRODUCT);
	    $o->setCategory($child);
	    $manager->persist($o);
	    $pointofsale_3->addCategory($o);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-2', $o);
	    
	    
	    
	
	    $child = new Category();
	    $child->setName('J-574');
	    $child->setType(Category::TYPE_PRODUCT);
	    $child->setCategory($entity2);
	    $manager->persist($child);
	    $pointofsale_3->addCategory($child);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-2', $child);
	
	    $o = new Category();
	    $o->setName('18 - 21');
	    $o->setType(Category::TYPE_PRODUCT);
	    $o->setCategory($child);
	    $manager->persist($o);
	    $pointofsale_3->addCategory($o);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-2', $o);
	
	    $o = new Category();
	    $o->setName('19 - 21');
	    $o->setType(Category::TYPE_PRODUCT);
	    $o->setCategory($child);
	    $manager->persist($o);
	    $pointofsale_3->addCategory($o);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-2', $o);
	    
	    
	    
	    
	
	    $child = new Category();
	    $child->setName('J-575');
	    $child->setType(Category::TYPE_PRODUCT);
	    $child->setCategory($entity2);
	    $manager->persist($child);
	    $pointofsale_3->addCategory($child);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-2', $child);
	
	    $o = new Category();
	    $o->setName('18 - 21');
	    $o->setType(Category::TYPE_PRODUCT);
	    $o->setCategory($child);
	    $manager->persist($o);
	    $pointofsale_3->addCategory($o);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-2', $o);
	
	    $o = new Category();
	    $o->setName('19 - 21');
	    $o->setType(Category::TYPE_PRODUCT);
	    $o->setCategory($child);
	    $manager->persist($o);
	    $pointofsale_3->addCategory($o);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-2', $o);
	    
	    
	    
	    
	
	    $child = new Category();
	    $child->setName('J-576');
	    $child->setType(Category::TYPE_PRODUCT);
	    $child->setCategory($entity2);
	    $manager->persist($child);
	    $pointofsale_3->addCategory($child);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-2', $child);
	
	    $o = new Category();
	    $o->setName('18 - 21');
	    $o->setType(Category::TYPE_PRODUCT);
	    $o->setCategory($child);
	    $manager->persist($o);
	    $pointofsale_3->addCategory($o);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-2', $o);
	
	    $o = new Category();
	    $o->setName('19 - 21');
	    $o->setType(Category::TYPE_PRODUCT);
	    $o->setCategory($child);
	    $manager->persist($o);
	    $pointofsale_3->addCategory($o);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-2', $o);
	    
	    
	    
	    
	
	    $child = new Category();
	    $child->setName('J-577');
	    $child->setType(Category::TYPE_PRODUCT);
	    $child->setCategory($entity2);
	    $manager->persist($child);
	    $pointofsale_3->addCategory($child);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-2', $child);
	
	    $o = new Category();
	    $o->setName('18 - 21');
	    $o->setType(Category::TYPE_PRODUCT);
	    $o->setCategory($child);
	    $manager->persist($o);
	    $pointofsale_3->addCategory($o);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-2', $o);
	
	    $o = new Category();
	    $o->setName('19 - 21');
	    $o->setType(Category::TYPE_PRODUCT);
	    $o->setCategory($child);
	    $manager->persist($o);
	    $pointofsale_3->addCategory($o);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-2', $o);
	    
	    
	    
	    
	
	    $child = new Category();
	    $child->setName('J-578');
	    $child->setType(Category::TYPE_PRODUCT);
	    $child->setCategory($entity2);
	    $manager->persist($child);
	    $pointofsale_3->addCategory($child);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-2', $child);
	
	    $o = new Category();
	    $o->setName('18 - 21');
	    $o->setType(Category::TYPE_PRODUCT);
	    $o->setCategory($child);
	    $manager->persist($o);
	    $pointofsale_3->addCategory($o);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-2', $o);
	
	    $o = new Category();
	    $o->setName('19 - 21');
	    $o->setType(Category::TYPE_PRODUCT);
	    $o->setCategory($child);
	    $manager->persist($o);
	    $pointofsale_3->addCategory($o);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-2', $o);
	    
	    
	    
	
	    $child = new Category();
	    $child->setName('J-579');
	    $child->setType(Category::TYPE_PRODUCT);
	    $child->setCategory($entity2);
	    $manager->persist($child);
	    $pointofsale_3->addCategory($child);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-2', $child);
	
	    $o = new Category();
	    $o->setName('18 - 21');
	    $o->setType(Category::TYPE_PRODUCT);
	    $o->setCategory($child);
	    $manager->persist($o);
	    $pointofsale_3->addCategory($o);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-2', $o);
	
	    $o = new Category();
	    $o->setName('19 - 21');
	    $o->setType(Category::TYPE_PRODUCT);
	    $o->setCategory($child);
	    $manager->persist($o);
	    $pointofsale_3->addCategory($o);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-2', $o);
	    
	    
	    
	
	    $child = new Category();
	    $child->setName('J-581');
	    $child->setType(Category::TYPE_PRODUCT);
	    $child->setCategory($entity2);
	    $manager->persist($child);
	    $pointofsale_3->addCategory($child);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-2', $child);
	
	    $o = new Category();
	    $o->setName('18 - 21');
	    $o->setType(Category::TYPE_PRODUCT);
	    $o->setCategory($child);
	    $manager->persist($o);
	    $pointofsale_3->addCategory($o);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-2', $o);
	
	    $o = new Category();
	    $o->setName('19 - 21');
	    $o->setType(Category::TYPE_PRODUCT);
	    $o->setCategory($child);
	    $manager->persist($o);
	    $pointofsale_3->addCategory($o);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-2', $o);
	    
	    
	    
	    
	
	    $child = new Category();
	    $child->setName('J-582');
	    $child->setType(Category::TYPE_PRODUCT);
	    $child->setCategory($entity2);
	    $manager->persist($child);
	    $pointofsale_3->addCategory($child);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-2', $child);
	
	    $o = new Category();
	    $o->setName('18 - 21');
	    $o->setType(Category::TYPE_PRODUCT);
	    $o->setCategory($child);
	    $manager->persist($o);
	    $pointofsale_3->addCategory($o);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-2', $o);
	
	    $o = new Category();
	    $o->setName('19 - 21');
	    $o->setType(Category::TYPE_PRODUCT);
	    $o->setCategory($child);
	    $manager->persist($o);
	    $pointofsale_3->addCategory($o);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-2', $o);
	    
	    
	    
	    
	
	    $child = new Category();
	    $child->setName('J-584');
	    $child->setType(Category::TYPE_PRODUCT);
	    $child->setCategory($entity2);
	    $manager->persist($child);
	    $pointofsale_3->addCategory($child);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-2', $child);
	
	    $o = new Category();
	    $o->setName('18 - 21');
	    $o->setType(Category::TYPE_PRODUCT);
	    $o->setCategory($child);
	    $manager->persist($o);
	    $pointofsale_3->addCategory($o);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-2', $o);
	
	    $o = new Category();
	    $o->setName('19 - 21');
	    $o->setType(Category::TYPE_PRODUCT);
	    $o->setCategory($child);
	    $manager->persist($o);
	    $pointofsale_3->addCategory($o);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-2', $o);
	    
	    
	    
	    
	
	    $child = new Category();
	    $child->setName('J-586');
	    $child->setType(Category::TYPE_PRODUCT);
	    $child->setCategory($entity2);
	    $manager->persist($child);
	    $pointofsale_3->addCategory($child);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-2', $child);
	
	    $o = new Category();
	    $o->setName('18 - 21');
	    $o->setType(Category::TYPE_PRODUCT);
	    $o->setCategory($child);
	    $manager->persist($o);
	    $pointofsale_3->addCategory($o);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-2', $o);
	
	    $o = new Category();
	    $o->setName('19 - 21');
	    $o->setType(Category::TYPE_PRODUCT);
	    $o->setCategory($child);
	    $manager->persist($o);
	    $pointofsale_3->addCategory($o);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-2', $o);
	    
	    
	    
	    
	
	    $child = new Category();
	    $child->setName('J-587');
	    $child->setType(Category::TYPE_PRODUCT);
	    $child->setCategory($entity2);
	    $manager->persist($child);
	    $pointofsale_3->addCategory($child);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-2', $child);
	
	    $o = new Category();
	    $o->setName('18 - 21');
	    $o->setType(Category::TYPE_PRODUCT);
	    $o->setCategory($child);
	    $manager->persist($o);
	    $pointofsale_3->addCategory($o);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-2', $o);
	
	    $o = new Category();
	    $o->setName('19 - 21');
	    $o->setType(Category::TYPE_PRODUCT);
	    $o->setCategory($child);
	    $manager->persist($o);
	    $pointofsale_3->addCategory($o);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-2', $o);
	    
	    
	    
	
	    $child = new Category();
	    $child->setName('J-588');
	    $child->setType(Category::TYPE_PRODUCT);
	    $child->setCategory($entity2);
	    $manager->persist($child);
	    $pointofsale_3->addCategory($child);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-2', $child);
	    
	    $o = new Category();
	    $o->setName('18 - 21');
	    $o->setType(Category::TYPE_PRODUCT);
	    $o->setCategory($child);
	    $manager->persist($o);
	    $pointofsale_3->addCategory($o);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-2', $o);
	
	    $o = new Category();
	    $o->setName('19 - 21');
	    $o->setType(Category::TYPE_PRODUCT);
	    $o->setCategory($child);
	    $manager->persist($o);
	    $pointofsale_3->addCategory($o);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-2', $o);
     
     
     
     
     
     
     
     
     
     
     
	
	
	    /**
	     * CATEGORY PARENT
	     */
	    $entity1 = new Category();
	    $entity1->setName('PIBE B-A NIÑA 18-21');
	    $entity1->setType(Category::TYPE_PRODUCT);
	    $manager->persist($entity1);
	    $pointofsale_3->addCategory($entity1);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-2', $entity1);
	
	
	    /**
	     * CATEGORY PARENT
	     */
	    $entity1 = new Category();
	    $entity1->setName('NIÑA NORMAL 22-26');
	    $entity1->setType(Category::TYPE_PRODUCT);
	    $manager->persist($entity1);
	    $pointofsale_3->addCategory($entity1);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-3', $entity1);
	
	
	    /**
	     * CATEGORY PARENT
	     */
	    $entity1 = new Category();
	    $entity1->setName('NIÑA B-A 22-26');
	    $entity1->setType(Category::TYPE_PRODUCT);
	    $manager->persist($entity1);
	    $pointofsale_3->addCategory($entity1);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-4', $entity1);
	
	
	    /**
	     * CATEGORY PARENT
	     */
	    $entity1 = new Category();
	    $entity1->setName('NORMAL NIÑA 27-32');
	    $entity1->setType(Category::TYPE_PRODUCT);
	    $manager->persist($entity1);
	    $pointofsale_3->addCategory($entity1);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-5', $entity1);
	
	
	    /**
	     * CATEGORY PARENT
	     */
	    $entity1 = new Category();
	    $entity1->setName('NIÑA ESCOLAR 24-26');
	    $entity1->setType(Category::TYPE_PRODUCT);
	    $manager->persist($entity1);
	    $pointofsale_3->addCategory($entity1);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-6', $entity1);
	
	
	    /**
	     * CATEGORY PARENT
	     */
	    $entity1 = new Category();
	    $entity1->setName('NIÑA ESCOLAR 27-32');
	    $entity1->setType(Category::TYPE_PRODUCT);
	    $manager->persist($entity1);
	    $pointofsale_3->addCategory($entity1);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-7', $entity1);
	
	
	    /**
	     * CATEGORY PARENT
	     */
	    $entity1 = new Category();
	    $entity1->setName('NIÑA ESCOLAR 33-36');
	    $entity1->setType(Category::TYPE_PRODUCT);
	    $manager->persist($entity1);
	    $pointofsale_3->addCategory($entity1);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-8', $entity1);
	
	
	    /**
	     * CATEGORY PARENT
	     */
	    $entity1 = new Category();
	    $entity1->setName('NIÑA ESCOLAR 33-37');
	    $entity1->setType(Category::TYPE_PRODUCT);
	    $manager->persist($entity1);
	    $pointofsale_3->addCategory($entity1);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-9', $entity1);
	
	
	    /**
	     * CATEGORY PARENT
	     */
	    $entity1 = new Category();
	    $entity1->setName('NIÑA ESCOLAR 33-38');
	    $entity1->setType(Category::TYPE_PRODUCT);
	    $manager->persist($entity1);
	    $pointofsale_3->addCategory($entity1);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-10', $entity1);
	
	
	    /**
	     * CATEGORY PARENT
	     */
	    $entity1 = new Category();
	    $entity1->setName('NIÑA ESCOLAR 33-39');
	    $entity1->setType(Category::TYPE_PRODUCT);
	    $manager->persist($entity1);
	    $pointofsale_3->addCategory($entity1);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-11', $entity1);
	
	
	    /**
	     * CATEGORY PARENT
	     */
	    $entity1 = new Category();
	    $entity1->setName('PIBE NORMAL NIÑO 19-21');
	    $entity1->setType(Category::TYPE_PRODUCT);
	    $manager->persist($entity1);
	    $pointofsale_3->addCategory($entity1);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-12', $entity1);
	
	
	    /**
	     * CATEGORY PARENT
	     */
	    $entity1 = new Category();
	    $entity1->setName('PIBE B-O NIÑO 19-21');
	    $entity1->setType(Category::TYPE_PRODUCT);
	    $manager->persist($entity1);
	    $pointofsale_3->addCategory($entity1);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-13', $entity1);
	
	
	    /**
	     * CATEGORY PARENT
	     */
	    $entity1 = new Category();
	    $entity1->setName('NIÑO NORMAL 22-26');
	    $entity1->setType(Category::TYPE_PRODUCT);
	    $manager->persist($entity1);
	    $pointofsale_3->addCategory($entity1);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-14', $entity1);
	
	
	    /**
	     * CATEGORY PARENT
	     */
	    $entity1 = new Category();
	    $entity1->setName('NIÑO B-O 22-26');
	    $entity1->setType(Category::TYPE_PRODUCT);
	    $manager->persist($entity1);
	    $pointofsale_3->addCategory($entity1);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-15', $entity1);
	
	
	    /**
	     * CATEGORY PARENT
	     */
	    $entity1 = new Category();
	    $entity1->setName('NIÑO NORMAL 27-32');
	    $entity1->setType(Category::TYPE_PRODUCT);
	    $manager->persist($entity1);
	    $pointofsale_3->addCategory($entity1);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-16', $entity1);
	
	
	    /**
	     * CATEGORY PARENT
	     */
	    $entity1 = new Category();
	    $entity1->setName('NIÑO B-O 27-32');
	    $entity1->setType(Category::TYPE_PRODUCT);
	    $manager->persist($entity1);
	    $pointofsale_3->addCategory($entity1);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-17', $entity1);
	
	
	    /**
	     * CATEGORY PARENT
	     */
	    $entity1 = new Category();
	    $entity1->setName('NIÑO ESCOLAR 24-26');
	    $entity1->setType(Category::TYPE_PRODUCT);
	    $manager->persist($entity1);
	    $pointofsale_3->addCategory($entity1);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-18', $entity1);
	
	
	    /**
	     * CATEGORY PARENT
	     */
	    $entity1 = new Category();
	    $entity1->setName('NIÑO ESCOLAR 27-32');
	    $entity1->setType(Category::TYPE_PRODUCT);
	    $manager->persist($entity1);
	    $pointofsale_3->addCategory($entity1);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-19', $entity1);
	
	
	    /**
	     * CATEGORY PARENT
	     */
	    $entity1 = new Category();
	    $entity1->setName('NIÑO ESCOLAR 30-32');
	    $entity1->setType(Category::TYPE_PRODUCT);
	    $manager->persist($entity1);
	    $pointofsale_3->addCategory($entity1);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-20', $entity1);
	
	
	    /**
	     * CATEGORY PARENT
	     */
	    $entity1 = new Category();
	    $entity1->setName('NIÑO ESCOLAR 33-38');
	    $entity1->setType(Category::TYPE_PRODUCT);
	    $manager->persist($entity1);
	    $pointofsale_3->addCategory($entity1);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-21', $entity1);
	
	
	    /**
	     * CATEGORY PARENT
	     */
	    $entity1 = new Category();
	    $entity1->setName('PIBE SANDALIA NIÑA 18-21');
	    $entity1->setType(Category::TYPE_PRODUCT);
	    $manager->persist($entity1);
	    $pointofsale_3->addCategory($entity1);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-22', $entity1);
	
	
	    /**
	     * CATEGORY PARENT
	     */
	    $entity1 = new Category();
	    $entity1->setName('SANDALIA NIÑA 22-26');
	    $entity1->setType(Category::TYPE_PRODUCT);
	    $manager->persist($entity1);
	    $pointofsale_3->addCategory($entity1);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-23', $entity1);
	
	
	    /**
	     * CATEGORY PARENT
	     */
	    $entity1 = new Category();
	    $entity1->setName('PIBE SANDALIA NIÑO 18-21');
	    $entity1->setType(Category::TYPE_PRODUCT);
	    $manager->persist($entity1);
	    $pointofsale_3->addCategory($entity1);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-24', $entity1);
	
	
	    /**
	     * CATEGORY PARENT
	     */
	    $entity1 = new Category();
	    $entity1->setName('SANDALIA NIÑO 22-26');
	    $entity1->setType(Category::TYPE_PRODUCT);
	    $manager->persist($entity1);
	    $pointofsale_3->addCategory($entity1);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-25', $entity1);

	    
	
	

        
        /*
        $entity3 = new Category();
	    $entity3->setCode('002');
	    $entity3->setName('J-505');
	    $entity3->setType(Category::TYPE_PRODUCT);
	    $entity3->setCategory($entity2);
        $manager->persist($entity3);
	    $pointofsale_3->addCategory($entity3);
	    $manager->persist($pointofsale_3);
        $this->addReference('category-2', $entity3);
        
        //CHILDREN
	    $entity = new Category();
	    $entity->setCode('0044');
	    $entity->setName('18 - 21');
	    $entity->setType(Category::TYPE_PRODUCT);
	    $entity->setCategory($entity3);
	    $manager->persist($entity);
	    $pointofsale_3->addCategory($entity);
	    $manager->persist($pointofsale_3);
	    $this->addReference('category-3', $entity);
	
	    //CHILDREN
	    $entity = new Category();
	    $entity->setCode('0055');
	    $entity->setName('19 - 21');
	    $entity->setType(Category::TYPE_PRODUCT);
	    $entity->setCategory($entity3);
	    $manager->persist($entity);
	    $pointofsale_3->addCategory($entity);
	    $manager->persist($pointofsale_3);
	    $this->addReference('category-4', $entity);
        
        

        $entity4 = new Category();
        $entity4->setCode('003');
        $entity4->setName('J-512');
        $entity4->setType(Category::TYPE_PRODUCT);
        $entity4->setCategory($entity2);
        $manager->persist($entity4);
	    $pointofsale_3->addCategory($entity4);
	    $manager->persist($pointofsale_3);
        $this->addReference('category-5', $entity4);
	
	    //CHILDREN
	    $entity = new Category();
	    $entity->setCode('004');
	    $entity->setName('18 - 21');
	    $entity->setType(Category::TYPE_PRODUCT);
	    $entity->setCategory($entity4);
	    $manager->persist($entity);
	    $pointofsale_3->addCategory($entity);
	    $manager->persist($pointofsale_3);
	    $this->addReference('category-6', $entity);
	
	    //CHILDREN
	    $entity = new Category();
	    $entity->setCode('005');
	    $entity->setName('19 - 21');
	    $entity->setType(Category::TYPE_PRODUCT);
	    $entity->setCategory($entity4);
	    $manager->persist($entity);
	    $pointofsale_3->addCategory($entity);
	    $manager->persist($pointofsale_3);
	    $this->addReference('category-7', $entity);
        
        */
        
        





        

        $manager->flush();

    }

    public function getOrder()
    {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 5;
    }
}