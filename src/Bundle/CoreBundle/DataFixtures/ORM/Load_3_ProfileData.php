<?php

declare(strict_types=1);

namespace Bundle\CoreBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Bundle\ProfileBundle\Entity\Profile;

class Load_3_ProfileData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $roleUserCreate = $this->getReference('role-user-create');
        $roleUserEdit = $this->getReference('role-user-edit');
        $roleUserView = $this->getReference('role-user-view');
        $roleUserDelete = $this->getReference('role-user-delete');

        // DEFAULT
        $roleUserAdmin = $this->getReference('role-super-admin');
        $rolePdvAdmin = $this->getReference('role-pdv-admin');
        $roleEmployee = $this->getReference('role-employee');
        $roleClient = $this->getReference('role-client');
        $roleGuest = $this->getReference('role-guest');


        $entity = new Profile();
        $entity->setName(Profile::SUPER_ADMIN);
        $entity->addRole($roleUserAdmin);
        $manager->persist($entity);
        $this->addReference('profile-super-admin', $entity);


        $entity = new Profile();
        $entity->setName(Profile::PDV_ADMIN);
        $entity->setSlug(Profile::PDV_ADMIN_SLUG);
        $entity->addRole($rolePdvAdmin);
        $manager->persist($entity);
        $this->addReference('profile-pdv-admin', $entity);


        $entity = new Profile();
        $entity->setName(Profile::EMPLOYEE);
        $entity->setSlug(Profile::EMPLOYEE_SLUG);
        $entity->addRole($roleEmployee);
        $manager->persist($entity);
        $this->addReference('profile-employee', $entity);


        $entity = new Profile();
        $entity->setName(Profile::CLIENT);
        $entity->setSlug(Profile::CLIENT_SLUG);
        $entity->addRole($roleClient);
        $manager->persist($entity);
        $this->addReference('profile-client', $entity);


        $entity = new Profile();
        $entity->setName(Profile::GUEST);
        $entity->addRole($roleGuest);
        $manager->persist($entity);
        $this->addReference('profile-guest', $entity);

        $manager->flush();

    }

    public function getOrder()
    {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 3;
    }
}