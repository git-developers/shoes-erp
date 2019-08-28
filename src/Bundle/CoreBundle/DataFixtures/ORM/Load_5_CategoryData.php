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
         * CATEGORY PARENT 1
         */
        $entity2 = new Category();
        $entity2->setCode('001');
        $entity2->setName('PIBE NORMAL NIÑA 18-21');
        $entity2->setType(Category::TYPE_PRODUCT);
        $manager->persist($entity2);
	    $pointofsale_3->addCategory($entity2);
        $manager->persist($pointofsale_3);
        $this->addReference('category-1', $entity2);

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
        
        
        
        




        /**
         * CATEGORY PARENT 2
         */
        $entity1 = new Category();
        $entity1->setCode('006');
        $entity1->setName('Category parent 2');
        $entity1->setType(Category::TYPE_PRODUCT);
        $manager->persist($entity1);
	    $pointofsale_3->addCategory($entity1);
	    $manager->persist($pointofsale_3);
        $this->addReference('category-8', $entity);

        $entity = new Category();
        $entity->setCode('007');
        $entity->setName('Category 7');
        $entity->setType(Category::TYPE_PRODUCT);
        $entity->setCategory($entity1);
        $manager->persist($entity);
	    $pointofsale_3->addCategory($entity);
	    $manager->persist($pointofsale_3);
        $this->addReference('category-9', $entity);

        $entity = new Category();
        $entity->setCode('008');
        $entity->setName('Category 8');
        $entity->setType(Category::TYPE_PRODUCT);
        $entity->setCategory($entity1);
        $manager->persist($entity);
	    $pointofsale_3->addCategory($entity);
	    $manager->persist($pointofsale_3);
        $this->addReference('category-10', $entity);

        $entity = new Category();
        $entity->setCode('009');
        $entity->setName('Category 9');
        $entity->setType(Category::TYPE_PRODUCT);
        $entity->setCategory($entity1);
        $manager->persist($entity);
	    $pointofsale_3->addCategory($entity);
	    $manager->persist($pointofsale_3);
        $this->addReference('category-11', $entity);
        

        $manager->flush();

    }

    public function getOrder()
    {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 5;
    }
}