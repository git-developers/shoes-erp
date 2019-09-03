<?php

declare(strict_types=1);

namespace Bundle\CoreBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Bundle\UserBundle\Entity\User;

class Load_12_UserHasPointOfSaleData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {

        $user_1 = $this->getReference('user-1');
        $user_2 = $this->getReference('user-2');
        $user_3 = $this->getReference('user-3');

        $pointofsale_1 = $this->getReference('pointofsale-1');
        $pointofsale_2 = $this->getReference('pointofsale-2');
        $pointofsale_3 = $this->getReference('pointofsale-3');


//        $user_1->addPointOfSale($pointofsale_1);
//        $manager->persist($user_1);
//
//        $user_2->addPointOfSale($pointofsale_2);
//        $manager->persist($user_2);
//
//        $user_3->addPointOfSale($pointofsale_3);
//        $manager->persist($user_3);
//
//        $user_3->addPointOfSale($pointofsale_1);
//        $manager->persist($user_3);
//
//        $user_3->addPointOfSale($pointofsale_2);
//        $manager->persist($user_3);


        $manager->flush();

    }

    public function getOrder()
    {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 12;
    }
}