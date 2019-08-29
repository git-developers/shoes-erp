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
	    $roleStadistics = $this->getReference('role-stadistics');
	    $roleSettings = $this->getReference('role-settings');
	    $roleUploadImage = $this->getReference('role-upload-image');
    	
	    $roleUserView = $this->getReference('role-user-view');
	    $roleUserCreate = $this->getReference('role-user-create');
	    $roleUserEdit = $this->getReference('role-user-edit');
        $roleUserDelete = $this->getReference('role-user-delete');
	
	    $roleProfileView = $this->getReference('role-profile-view');
	    $roleProfileCreate = $this->getReference('role-profile-create');
	    $roleProfileEdit = $this->getReference('role-profile-edit');
	    $roleProfileDelete = $this->getReference('role-profile-delete');
	
	    $roleClientView = $this->getReference('role-client-view');
	    $roleClientCreate = $this->getReference('role-client-create');
	    $roleClientEdit = $this->getReference('role-client-edit');
	    $roleClientDelete = $this->getReference('role-client-delete');
	
	    $rolePdvView = $this->getReference('role-pdv-view');
	    $rolePdvCreate = $this->getReference('role-pdv-create');
	    $rolePdvEdit = $this->getReference('role-pdv-edit');
	    $rolePdvDelete = $this->getReference('role-pdv-delete');
	
	    $roleCategoryView = $this->getReference('role-category-view');
	    $roleCategoryCreate = $this->getReference('role-category-create');
	    $roleCategoryEdit = $this->getReference('role-category-edit');
	    $roleCategoryDelete = $this->getReference('role-category-delete');
	
	    $roleTicketView = $this->getReference('role-ticket-view');
	    $roleTicketCreate = $this->getReference('role-ticket-create');
	    $roleTicketEdit = $this->getReference('role-ticket-edit');
	    $roleTicketDelete = $this->getReference('role-ticket-delete');
	
	    $roleProductView = $this->getReference('role-product-view');
	    $roleProductCreate = $this->getReference('role-product-create');
	    $roleProductEdit = $this->getReference('role-product-edit');
	    $roleProductDelete = $this->getReference('role-product-delete');
	
	    $roleEmployeeView = $this->getReference('role-employee-view');
	    $roleEmployeeCreate = $this->getReference('role-employee-create');
	    $roleEmployeeEdit = $this->getReference('role-employee-edit');
	    $roleEmployeeDelete = $this->getReference('role-employee-delete');
	
	    $rolePaymentTypeView = $this->getReference('role-paymenttype-view');
	    $rolePaymentTypeCreate = $this->getReference('role-paymenttype-create');
	    $rolePaymentTypeEdit = $this->getReference('role-paymenttype-edit');
	    $rolePaymentTypeDelete = $this->getReference('role-paymenttype-delete');
	
	    $roleReportView = $this->getReference('role-report-view');
	    $roleReportCreate = $this->getReference('role-report-create');
	    $roleReportEdit = $this->getReference('role-report-edit');
	    $roleReportDelete = $this->getReference('role-report-delete');


        $entity = new Profile();
        $entity->setName(Profile::SUPER_ADMIN);
	
	    $entity->addRole($roleStadistics);
	    $entity->addRole($roleSettings);
	    $entity->addRole($roleUploadImage);
        
        $entity->addRole($roleUserView);
        $entity->addRole($roleUserCreate);
        $entity->addRole($roleUserEdit);
        $entity->addRole($roleUserDelete);
        
        $entity->addRole($roleProfileView);
        $entity->addRole($roleProfileCreate);
        $entity->addRole($roleProfileEdit);
        $entity->addRole($roleProfileDelete);
        
        $entity->addRole($roleClientView);
        $entity->addRole($roleClientCreate);
        $entity->addRole($roleClientEdit);
        $entity->addRole($roleClientDelete);
        
        $entity->addRole($rolePdvView);
        $entity->addRole($rolePdvCreate);
        $entity->addRole($rolePdvEdit);
        $entity->addRole($rolePdvDelete);
        
        $entity->addRole($roleCategoryView);
        $entity->addRole($roleCategoryCreate);
        $entity->addRole($roleCategoryEdit);
        $entity->addRole($roleCategoryDelete);
        
        $entity->addRole($roleTicketView);
        $entity->addRole($roleTicketCreate);
        $entity->addRole($roleTicketEdit);
        $entity->addRole($roleTicketDelete);
        
        $entity->addRole($roleProductView);
        $entity->addRole($roleProductCreate);
        $entity->addRole($roleProductEdit);
        $entity->addRole($roleProductDelete);
        
        $entity->addRole($roleEmployeeView);
        $entity->addRole($roleEmployeeCreate);
        $entity->addRole($roleEmployeeEdit);
        $entity->addRole($roleEmployeeDelete);
        
        $entity->addRole($rolePaymentTypeView);
        $entity->addRole($rolePaymentTypeCreate);
        $entity->addRole($rolePaymentTypeEdit);
        $entity->addRole($rolePaymentTypeDelete);
        
        $entity->addRole($roleReportView);
        $entity->addRole($roleReportCreate);
        $entity->addRole($roleReportEdit);
        $entity->addRole($roleReportDelete);
        
        
        $manager->persist($entity);
        $this->addReference('profile-super-admin', $entity);


        $entity = new Profile();
        $entity->setName(Profile::PDV_ADMIN);
        $entity->setSlug(Profile::PDV_ADMIN_SLUG);
        $entity->addRole($roleUserView);
        
	    $entity->addRole($roleTicketView);
	    $entity->addRole($roleTicketCreate);
	    $entity->addRole($roleTicketEdit);
	    $entity->addRole($roleTicketDelete);
        $manager->persist($entity);
        $this->addReference('profile-pdv-admin', $entity);


        $entity = new Profile();
        $entity->setName(Profile::SELLER);
        $entity->setSlug(Profile::SELLER_SLUG);
	    $entity->addRole($roleCategoryView);
	    $entity->addRole($roleTicketView);
	    $entity->addRole($roleTicketCreate);
	    $entity->addRole($roleStadistics);
	    $entity->addRole($rolePdvView);
	    $entity->addRole($roleProductEdit);
        $manager->persist($entity);
        $this->addReference('profile-employee', $entity);


        $entity = new Profile();
        $entity->setName(Profile::CLIENT);
        $entity->setSlug(Profile::CLIENT_SLUG);
        $entity->addRole($roleUserView);
        $manager->persist($entity);
        $this->addReference('profile-client', $entity);


        $entity = new Profile();
        $entity->setName(Profile::GUEST);
        $entity->addRole($roleUserView);
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