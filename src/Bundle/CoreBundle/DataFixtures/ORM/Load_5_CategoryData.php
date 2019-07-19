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
	
	    $pointofsale_10 = $this->getReference('pointofsale-10');

        /**
         * COSMETICOS
         */
        $entity2 = new Category();
        $entity2->setCode('001');
        $entity2->setName('Cosmeticos');
        $entity2->setType(Category::TYPE_PRODUCT);
        $manager->persist($entity2);
	    $pointofsale_10->addCategory($entity2);
        $manager->persist($pointofsale_10);
        $this->addReference('category-1', $entity2);

        $entity = new Category();
        $entity->setCode('002');
        $entity->setName('Ojos');
        $entity->setType(Category::TYPE_PRODUCT);
        $entity->setCategory($entity2);
        $manager->persist($entity);
	    $pointofsale_10->addCategory($entity);
	    $manager->persist($pointofsale_10);
        $this->addReference('category-2', $entity);

        $entity = new Category();
        $entity->setCode('003');
        $entity->setName('Labios');
        $entity->setType(Category::TYPE_PRODUCT);
        $entity->setCategory($entity2);
        $manager->persist($entity);
	    $pointofsale_10->addCategory($entity);
	    $manager->persist($pointofsale_10);
        $this->addReference('category-3', $entity);
        
        $entity = new Category();
        $entity->setCode('004');
        $entity->setName('Shampoos');
        $entity->setType(Category::TYPE_PRODUCT);
        $manager->persist($entity);
	    $pointofsale_10->addCategory($entity);
	    $manager->persist($pointofsale_10);
        $this->addReference('category-4', $entity);

        $entity = new Category();
        $entity->setCode('005');
        $entity->setName('Tintes');
        $entity->setType(Category::TYPE_PRODUCT);
        $manager->persist($entity);
	    $pointofsale_10->addCategory($entity);
	    $manager->persist($pointofsale_10);
        $this->addReference('category-5', $entity);



        /**
         * CREMAS
         */
        $entity1 = new Category();
        $entity1->setCode('006');
        $entity1->setName('Cremas');
        $entity1->setType(Category::TYPE_PRODUCT);
        $manager->persist($entity1);
	    $pointofsale_10->addCategory($entity1);
	    $manager->persist($pointofsale_10);
        $this->addReference('category-6', $entity);

        $entity = new Category();
        $entity->setCode('007');
        $entity->setName('Crema mano');
        $entity->setType(Category::TYPE_PRODUCT);
        $entity->setCategory($entity1);
        $manager->persist($entity);
	    $pointofsale_10->addCategory($entity);
	    $manager->persist($pointofsale_10);
        $this->addReference('category-7', $entity);

        $entity = new Category();
        $entity->setCode('008');
        $entity->setName('Crema pie');
        $entity->setType(Category::TYPE_PRODUCT);
        $entity->setCategory($entity1);
        $manager->persist($entity);
	    $pointofsale_10->addCategory($entity);
	    $manager->persist($pointofsale_10);
        $this->addReference('category-8', $entity);

        $entity = new Category();
        $entity->setCode('009');
        $entity->setName('Crema cuerpo');
        $entity->setType(Category::TYPE_PRODUCT);
        $entity->setCategory($entity1);
        $manager->persist($entity);
	    $pointofsale_10->addCategory($entity);
	    $manager->persist($pointofsale_10);
        $this->addReference('category-9', $entity);



        /**
         * SERVICE - CORTE
         */
        $entity3 = new Category();
        $entity3->setCode('010');
        $entity3->setName('Corte de cabello');
        $entity3->setType(Category::TYPE_SERVICE);
        $manager->persist($entity3);
	    $pointofsale_10->addCategory($entity3);
	    $manager->persist($pointofsale_10);
        $this->addReference('category-10', $entity3);

        $entity = new Category();
        $entity->setCode('011');
        $entity->setName('Hombre');
        $entity->setType(Category::TYPE_SERVICE);
        $entity->setCategory($entity3);
        $manager->persist($entity);
	    $pointofsale_10->addCategory($entity);
	    $manager->persist($pointofsale_10);
        $this->addReference('category-11', $entity);

        $entity = new Category();
        $entity->setCode('012');
        $entity->setName('Mujer');
        $entity->setType(Category::TYPE_SERVICE);
        $entity->setCategory($entity3);
        $manager->persist($entity);
	    $pointofsale_10->addCategory($entity);
	    $manager->persist($pointofsale_10);
        $this->addReference('category-12', $entity);

        

        /**
         * SERVICE - MANOS - PIES
         */
        $entity3 = new Category();
        $entity3->setCode('013');
        $entity3->setName('Pedicure');
        $entity3->setType(Category::TYPE_SERVICE);
        $manager->persist($entity3);
	    $pointofsale_10->addCategory($entity3);
	    $manager->persist($pointofsale_10);
        $this->addReference('category-13', $entity3);

        $entity3 = new Category();
        $entity3->setCode('014');
        $entity3->setName('Manicure');
        $entity3->setType(Category::TYPE_SERVICE);
        $manager->persist($entity3);
	    $pointofsale_10->addCategory($entity3);
	    $manager->persist($pointofsale_10);
        $this->addReference('category-14', $entity3);




        $manager->flush();

    }

    public function getOrder()
    {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 5;
    }
}