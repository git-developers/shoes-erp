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
         * COSMETICOS
         */
        $entity2 = new Category();
        $entity2->setCode('001');
        $entity2->setName('Category parent 1');
        $entity2->setType(Category::TYPE_PRODUCT);
        $manager->persist($entity2);
	    $pointofsale_3->addCategory($entity2);
        $manager->persist($pointofsale_3);
        $this->addReference('category-1', $entity2);

        $entity = new Category();
        $entity->setCode('002');
        $entity->setName('Category 2');
        $entity->setType(Category::TYPE_PRODUCT);
        $entity->setCategory($entity2);
        $manager->persist($entity);
	    $pointofsale_3->addCategory($entity);
	    $manager->persist($pointofsale_3);
        $this->addReference('category-2', $entity);

        $entity = new Category();
        $entity->setCode('003');
        $entity->setName('Category 3');
        $entity->setType(Category::TYPE_PRODUCT);
        $entity->setCategory($entity2);
        $manager->persist($entity);
	    $pointofsale_3->addCategory($entity);
	    $manager->persist($pointofsale_3);
        $this->addReference('category-3', $entity);
        
        $entity = new Category();
        $entity->setCode('004');
        $entity->setName('Category 4');
        $entity->setType(Category::TYPE_PRODUCT);
        $manager->persist($entity);
	    $pointofsale_3->addCategory($entity);
	    $manager->persist($pointofsale_3);
        $this->addReference('category-4', $entity);

        $entity = new Category();
        $entity->setCode('005');
        $entity->setName('Category 5');
        $entity->setType(Category::TYPE_PRODUCT);
        $manager->persist($entity);
	    $pointofsale_3->addCategory($entity);
	    $manager->persist($pointofsale_3);
        $this->addReference('category-5', $entity);



        /**
         * CREMAS
         */
        $entity1 = new Category();
        $entity1->setCode('006');
        $entity1->setName('Category parent 2');
        $entity1->setType(Category::TYPE_PRODUCT);
        $manager->persist($entity1);
	    $pointofsale_3->addCategory($entity1);
	    $manager->persist($pointofsale_3);
        $this->addReference('category-6', $entity);

        $entity = new Category();
        $entity->setCode('007');
        $entity->setName('Category 7');
        $entity->setType(Category::TYPE_PRODUCT);
        $entity->setCategory($entity1);
        $manager->persist($entity);
	    $pointofsale_3->addCategory($entity);
	    $manager->persist($pointofsale_3);
        $this->addReference('category-7', $entity);

        $entity = new Category();
        $entity->setCode('008');
        $entity->setName('Category 8');
        $entity->setType(Category::TYPE_PRODUCT);
        $entity->setCategory($entity1);
        $manager->persist($entity);
	    $pointofsale_3->addCategory($entity);
	    $manager->persist($pointofsale_3);
        $this->addReference('category-8', $entity);

        $entity = new Category();
        $entity->setCode('009');
        $entity->setName('Category 9');
        $entity->setType(Category::TYPE_PRODUCT);
        $entity->setCategory($entity1);
        $manager->persist($entity);
	    $pointofsale_3->addCategory($entity);
	    $manager->persist($pointofsale_3);
        $this->addReference('category-9', $entity);



        
        /**
         * SERVICE - CORTE
         */
        /*
        $entity3 = new Category();
        $entity3->setCode('010');
        $entity3->setName('Corte de cabello');
        $entity3->setType(Category::TYPE_SERVICE);
        $manager->persist($entity3);
	    $pointofsale_3->addCategory($entity3);
	    $manager->persist($pointofsale_3);
        $this->addReference('category-10', $entity3);

        $entity = new Category();
        $entity->setCode('011');
        $entity->setName('Hombre');
        $entity->setType(Category::TYPE_SERVICE);
        $entity->setCategory($entity3);
        $manager->persist($entity);
	    $pointofsale_3->addCategory($entity);
	    $manager->persist($pointofsale_3);
        $this->addReference('category-11', $entity);

        $entity = new Category();
        $entity->setCode('012');
        $entity->setName('Mujer');
        $entity->setType(Category::TYPE_SERVICE);
        $entity->setCategory($entity3);
        $manager->persist($entity);
	    $pointofsale_3->addCategory($entity);
	    $manager->persist($pointofsale_3);
        $this->addReference('category-12', $entity);
		*/
        

        /**
         * SERVICE - MANOS - PIES
         */
        /*
        $entity3 = new Category();
        $entity3->setCode('013');
        $entity3->setName('Pedicure');
        $entity3->setType(Category::TYPE_SERVICE);
        $manager->persist($entity3);
	    $pointofsale_3->addCategory($entity3);
	    $manager->persist($pointofsale_3);
        $this->addReference('category-13', $entity3);

        $entity3 = new Category();
        $entity3->setCode('014');
        $entity3->setName('Manicure');
        $entity3->setType(Category::TYPE_SERVICE);
        $manager->persist($entity3);
	    $pointofsale_3->addCategory($entity3);
	    $manager->persist($pointofsale_3);
        $this->addReference('category-14', $entity3);
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