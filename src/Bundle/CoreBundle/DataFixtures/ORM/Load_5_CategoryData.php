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
	    $this->addReference('category-1', $child);
	
	    
	    
	    $child = new Category();
	    $child->setName('J-509');
	    $child->setType(Category::TYPE_PRODUCT);
	    $child->setCategory($entity2);
	    $manager->persist($child);
	    $pointofsale_3->addCategory($child);
	    $manager->persist($pointofsale_3);
	    $this->addReference('category-2', $child);
	    
	    
		
	    $child = new Category();
	    $child->setName('J-512');
	    $child->setType(Category::TYPE_PRODUCT);
	    $child->setCategory($entity2);
	    $manager->persist($child);
	    $pointofsale_3->addCategory($child);
	    $manager->persist($pointofsale_3);
	    $this->addReference('category-3', $child);
	    
	    
	
	    $child = new Category();
	    $child->setName('J-515');
	    $child->setType(Category::TYPE_PRODUCT);
	    $child->setCategory($entity2);
	    $manager->persist($child);
	    $pointofsale_3->addCategory($child);
	    $manager->persist($pointofsale_3);
	    $this->addReference('category-4', $child);
	    
	    
	    
	    
	    $child = new Category();
	    $child->setName('J-520');
	    $child->setType(Category::TYPE_PRODUCT);
	    $child->setCategory($entity2);
	    $manager->persist($child);
	    $pointofsale_3->addCategory($child);
	    $manager->persist($pointofsale_3);
	    $this->addReference('category-5', $child);
	    
	    
	    
	
	    $child = new Category();
	    $child->setName('J-521');
	    $child->setType(Category::TYPE_PRODUCT);
	    $child->setCategory($entity2);
	    $manager->persist($child);
	    $pointofsale_3->addCategory($child);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-17', $child);
	    
	
	    $child = new Category();
	    $child->setName('J-522');
	    $child->setType(Category::TYPE_PRODUCT);
	    $child->setCategory($entity2);
	    $manager->persist($child);
	    $pointofsale_3->addCategory($child);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-20', $child);
	    
	    
	
	    $child = new Category();
	    $child->setName('J-531');
	    $child->setType(Category::TYPE_PRODUCT);
	    $child->setCategory($entity2);
	    $manager->persist($child);
	    $pointofsale_3->addCategory($child);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-23', $child);
	
	    
	
	    $child = new Category();
	    $child->setName('J-532');
	    $child->setType(Category::TYPE_PRODUCT);
	    $child->setCategory($entity2);
	    $manager->persist($child);
	    $pointofsale_3->addCategory($child);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-26', $child);
	    
	    
	    $child = new Category();
	    $child->setName('J-533');
	    $child->setType(Category::TYPE_PRODUCT);
	    $child->setCategory($entity2);
	    $manager->persist($child);
	    $pointofsale_3->addCategory($child);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-29', $child);
	    
	
	    $child = new Category();
	    $child->setName('J-535');
	    $child->setType(Category::TYPE_PRODUCT);
	    $child->setCategory($entity2);
	    $manager->persist($child);
	    $pointofsale_3->addCategory($child);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-32', $child);
	    
	
	    $child = new Category();
	    $child->setName('J-537');
	    $child->setType(Category::TYPE_PRODUCT);
	    $child->setCategory($entity2);
	    $manager->persist($child);
	    $pointofsale_3->addCategory($child);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-35', $child);
	    
	
	    $child = new Category();
	    $child->setName('J-539');
	    $child->setType(Category::TYPE_PRODUCT);
	    $child->setCategory($entity2);
	    $manager->persist($child);
	    $pointofsale_3->addCategory($child);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-38', $child);

	
	    $child = new Category();
	    $child->setName('J-543');
	    $child->setType(Category::TYPE_PRODUCT);
	    $child->setCategory($entity2);
	    $manager->persist($child);
	    $pointofsale_3->addCategory($child);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-2', $child);
	    
	
	    $child = new Category();
	    $child->setName('J-544');
	    $child->setType(Category::TYPE_PRODUCT);
	    $child->setCategory($entity2);
	    $manager->persist($child);
	    $pointofsale_3->addCategory($child);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-2', $child);
	    
	    
	
	    $child = new Category();
	    $child->setName('J-546');
	    $child->setType(Category::TYPE_PRODUCT);
	    $child->setCategory($entity2);
	    $manager->persist($child);
	    $pointofsale_3->addCategory($child);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-2', $child);
	    
	    
	
	    $child = new Category();
	    $child->setName('J-547');
	    $child->setType(Category::TYPE_PRODUCT);
	    $child->setCategory($entity2);
	    $manager->persist($child);
	    $pointofsale_3->addCategory($child);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-2', $child);
	    
	
	    $child = new Category();
	    $child->setName('J-548');
	    $child->setType(Category::TYPE_PRODUCT);
	    $child->setCategory($entity2);
	    $manager->persist($child);
	    $pointofsale_3->addCategory($child);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-2', $child);
	    
	
	    $child = new Category();
	    $child->setName('J-549');
	    $child->setType(Category::TYPE_PRODUCT);
	    $child->setCategory($entity2);
	    $manager->persist($child);
	    $pointofsale_3->addCategory($child);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-2', $child);

	    
	
	    $child = new Category();
	    $child->setName('J-550');
	    $child->setType(Category::TYPE_PRODUCT);
	    $child->setCategory($entity2);
	    $manager->persist($child);
	    $pointofsale_3->addCategory($child);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-2', $child);
	    
	    
	
	    $child = new Category();
	    $child->setName('J-557');
	    $child->setType(Category::TYPE_PRODUCT);
	    $child->setCategory($entity2);
	    $manager->persist($child);
	    $pointofsale_3->addCategory($child);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-2', $child);

	
	    $child = new Category();
	    $child->setName('J-559');
	    $child->setType(Category::TYPE_PRODUCT);
	    $child->setCategory($entity2);
	    $manager->persist($child);
	    $pointofsale_3->addCategory($child);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-2', $child);
	    
	
	    $child = new Category();
	    $child->setName('J-562');
	    $child->setType(Category::TYPE_PRODUCT);
	    $child->setCategory($entity2);
	    $manager->persist($child);
	    $pointofsale_3->addCategory($child);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-2', $child);
	    
	
	    $child = new Category();
	    $child->setName('J-563');
	    $child->setType(Category::TYPE_PRODUCT);
	    $child->setCategory($entity2);
	    $manager->persist($child);
	    $pointofsale_3->addCategory($child);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-2', $child);
	    
	
	    $child = new Category();
	    $child->setName('J-564');
	    $child->setType(Category::TYPE_PRODUCT);
	    $child->setCategory($entity2);
	    $manager->persist($child);
	    $pointofsale_3->addCategory($child);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-2', $child);
	    
	
	    $child = new Category();
	    $child->setName('J-565');
	    $child->setType(Category::TYPE_PRODUCT);
	    $child->setCategory($entity2);
	    $manager->persist($child);
	    $pointofsale_3->addCategory($child);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-2', $child);
	    
	
	    $child = new Category();
	    $child->setName('J-566');
	    $child->setType(Category::TYPE_PRODUCT);
	    $child->setCategory($entity2);
	    $manager->persist($child);
	    $pointofsale_3->addCategory($child);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-2', $child);
	    
	
	    $child = new Category();
	    $child->setName('J-568');
	    $child->setType(Category::TYPE_PRODUCT);
	    $child->setCategory($entity2);
	    $manager->persist($child);
	    $pointofsale_3->addCategory($child);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-2', $child);
	    
	
	    $child = new Category();
	    $child->setName('J-572');
	    $child->setType(Category::TYPE_PRODUCT);
	    $child->setCategory($entity2);
	    $manager->persist($child);
	    $pointofsale_3->addCategory($child);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-2', $child);
	    
	
	    $child = new Category();
	    $child->setName('J-573');
	    $child->setType(Category::TYPE_PRODUCT);
	    $child->setCategory($entity2);
	    $manager->persist($child);
	    $pointofsale_3->addCategory($child);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-2', $child);
	    
	
	    $child = new Category();
	    $child->setName('J-574');
	    $child->setType(Category::TYPE_PRODUCT);
	    $child->setCategory($entity2);
	    $manager->persist($child);
	    $pointofsale_3->addCategory($child);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-2', $child);
	    
	
	    $child = new Category();
	    $child->setName('J-575');
	    $child->setType(Category::TYPE_PRODUCT);
	    $child->setCategory($entity2);
	    $manager->persist($child);
	    $pointofsale_3->addCategory($child);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-2', $child);
	    
	
	    $child = new Category();
	    $child->setName('J-576');
	    $child->setType(Category::TYPE_PRODUCT);
	    $child->setCategory($entity2);
	    $manager->persist($child);
	    $pointofsale_3->addCategory($child);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-2', $child);
	    
	
	    $child = new Category();
	    $child->setName('J-577');
	    $child->setType(Category::TYPE_PRODUCT);
	    $child->setCategory($entity2);
	    $manager->persist($child);
	    $pointofsale_3->addCategory($child);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-2', $child);

	
	    $child = new Category();
	    $child->setName('J-578');
	    $child->setType(Category::TYPE_PRODUCT);
	    $child->setCategory($entity2);
	    $manager->persist($child);
	    $pointofsale_3->addCategory($child);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-2', $child);
	    
	
	    $child = new Category();
	    $child->setName('J-579');
	    $child->setType(Category::TYPE_PRODUCT);
	    $child->setCategory($entity2);
	    $manager->persist($child);
	    $pointofsale_3->addCategory($child);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-2', $child);
	    
	
	    $child = new Category();
	    $child->setName('J-581');
	    $child->setType(Category::TYPE_PRODUCT);
	    $child->setCategory($entity2);
	    $manager->persist($child);
	    $pointofsale_3->addCategory($child);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-2', $child);
	    
	
	    $child = new Category();
	    $child->setName('J-582');
	    $child->setType(Category::TYPE_PRODUCT);
	    $child->setCategory($entity2);
	    $manager->persist($child);
	    $pointofsale_3->addCategory($child);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-2', $child);
	    
	
	    $child = new Category();
	    $child->setName('J-584');
	    $child->setType(Category::TYPE_PRODUCT);
	    $child->setCategory($entity2);
	    $manager->persist($child);
	    $pointofsale_3->addCategory($child);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-2', $child);

	
	    $child = new Category();
	    $child->setName('J-586');
	    $child->setType(Category::TYPE_PRODUCT);
	    $child->setCategory($entity2);
	    $manager->persist($child);
	    $pointofsale_3->addCategory($child);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-2', $child);
	    
	
	    $child = new Category();
	    $child->setName('J-587');
	    $child->setType(Category::TYPE_PRODUCT);
	    $child->setCategory($entity2);
	    $manager->persist($child);
	    $pointofsale_3->addCategory($child);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-2', $child);

	
	    $child = new Category();
	    $child->setName('J-588');
	    $child->setType(Category::TYPE_PRODUCT);
	    $child->setCategory($entity2);
	    $manager->persist($child);
	    $pointofsale_3->addCategory($child);
	    $manager->persist($pointofsale_3);
//	    $this->addReference('category-2', $child);

     
     
     
     
  
	
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
	    

        $manager->flush();

    }

    public function getOrder()
    {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 5;
    }
}