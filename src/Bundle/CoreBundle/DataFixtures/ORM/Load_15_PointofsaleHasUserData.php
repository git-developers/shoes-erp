<?php

declare(strict_types=1);

namespace Bundle\CoreBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Bundle\PointofsaleBundle\Entity\Pointofsale;

class Load_15_PointofsaleHasUserData extends AbstractFixture implements OrderedFixtureInterface
{

    protected $applicationUrl;

    public function __construct($applicationUrl)
    {
        $this->applicationUrl = $applicationUrl;
    }

    public function load(ObjectManager $manager)
    {
	
	    $user_2 = $this->getReference('user-2');
	
	    $pointofsale_1 = $this->getReference('pointofsale-1');
	    $pointofsale_3 = $this->getReference('pointofsale-3');
	    $pointofsale_4 = $this->getReference('pointofsale-4');
	
	    
//	    $pointofsale_1->addUser($user_2);
//	    $manager->persist($pointofsale_1);
//
//	    $pointofsale_3->addUser($user_2);
//	    $manager->persist($pointofsale_3);
//
//	    $pointofsale_4->addUser($user_2);
//	    $manager->persist($pointofsale_4);
	    
        $manager->flush();

    }

    public function getOrder()
    {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 15;
    }
}