<?php

declare(strict_types=1);

namespace Bundle\CoreBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Bundle\RoleBundle\Entity\Role;
use Bundle\ProfileBundle\Entity\Profile;
use Bundle\UserBundle\Entity\User;
use Bundle\PointofsaleBundle\Entity\Pointofsale;
use Bundle\CategoryBundle\Entity\Category;
use Bundle\TicketBundle\Entity\Ticket;
use Bundle\ProductBundle\Entity\Product;
use Bundle\TicketBundle\Entity\PaymentType;
use Bundle\ReportBundle\Entity\ReportPdv;


class Load_2_RoleData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {

        /**
         * ROLES DEFAULT
         */
	    $entity = new Role();
	    $entity->setName('Role stadistics');
	    $entity->setSlug(Role::ROLE_STADISTICS);
	    $entity->setGroupRol('Stadistics');
	    $entity->setGroupRolTag('group-stadistics');
	    $manager->persist($entity);
	    $this->addReference('role-stadistics', $entity);
	    
	    $entity = new Role();
	    $entity->setName('Role settings');
	    $entity->setSlug(Role::ROLE_SETTINGS);
	    $entity->setGroupRol('Settings');
	    $entity->setGroupRolTag('group-settings');
	    $manager->persist($entity);
	    $this->addReference('role-settings', $entity);
	    
	    $entity = new Role();
	    $entity->setName('Role upload image');
	    $entity->setSlug(Role::ROLE_UPLOAD_IMAGE);
	    $entity->setGroupRol('Upload image');
	    $entity->setGroupRolTag('group-upload-image');
	    $manager->persist($entity);
	    $this->addReference('role-upload-image', $entity);
	    
	    
	

        /**
         * PROFILE
         */
	    $entity = new Role();
	    $entity->setName('Profile view');
	    $entity->setSlug(Profile::ROLE_PROFILE_VIEW);
	    $entity->setGroupRol('Perfil');
	    $entity->setGroupRolTag('group-profile');
	    $manager->persist($entity);
	    $this->addReference('role-profile-view', $entity);
        
        $entity = new Role();
        $entity->setName('Profile create');
        $entity->setSlug(Profile::ROLE_PROFILE_CREATE);
        $entity->setGroupRol('Perfil');
        $entity->setGroupRolTag('group-profile');
        $manager->persist($entity);
        $this->addReference('role-profile-create', $entity);

        $entity = new Role();
        $entity->setName('Profile edit');
        $entity->setSlug(Profile::ROLE_PROFILE_EDIT);
        $entity->setGroupRol('Perfil');
        $entity->setGroupRolTag('group-profile');
        $manager->persist($entity);
        $this->addReference('role-profile-edit', $entity);

        $entity = new Role();
        $entity->setName('Profile delete');
        $entity->setSlug(Profile::ROLE_PROFILE_DELETE);
        $entity->setGroupRol('Perfil');
        $entity->setGroupRolTag('group-profile');
        $manager->persist($entity);
        $this->addReference('role-profile-delete', $entity);
	
	
        
	    
	

        /**
         * PROFILE
         */
	    $entity = new Role();
	    $entity->setName('Report view');
	    $entity->setSlug(ReportPdv::ROLE_REPORT_VIEW);
	    $entity->setGroupRol('Reporte');
	    $entity->setGroupRolTag('group-report');
	    $manager->persist($entity);
	    $this->addReference('role-report-view', $entity);
        
        $entity = new Role();
        $entity->setName('Report create');
        $entity->setSlug(ReportPdv::ROLE_REPORT_CREATE);
        $entity->setGroupRol('Reporte');
        $entity->setGroupRolTag('group-report');
        $manager->persist($entity);
        $this->addReference('role-report-create', $entity);

        $entity = new Role();
        $entity->setName('Report edit');
        $entity->setSlug(ReportPdv::ROLE_REPORT_EDIT);
        $entity->setGroupRol('Reporte');
        $entity->setGroupRolTag('group-report');
        $manager->persist($entity);
        $this->addReference('role-report-edit', $entity);

        $entity = new Role();
        $entity->setName('Report delete');
        $entity->setSlug(ReportPdv::ROLE_REPORT_DELETE);
        $entity->setGroupRol('Reporte');
        $entity->setGroupRolTag('group-report');
        $manager->persist($entity);
        $this->addReference('role-report-delete', $entity);
	
	
        
        
	
	    /**
	     * USER
	     */
	    $entity = new Role();
	    $entity->setName('User view');
	    $entity->setSlug(User::ROLE_USER_VIEW);
	    $entity->setGroupRol('Usuario');
	    $entity->setGroupRolTag('group-user');
	    $manager->persist($entity);
	    $this->addReference('role-user-view', $entity);
	
	    $entity = new Role();
	    $entity->setName('User create');
	    $entity->setSlug(User::ROLE_USER_CREATE);
	    $entity->setGroupRol('Usuario');
	    $entity->setGroupRolTag('group-user');
	    $manager->persist($entity);
	    $this->addReference('role-user-create', $entity);
	
	    $entity = new Role();
	    $entity->setName('User edit');
	    $entity->setSlug(User::ROLE_USER_EDIT);
	    $entity->setGroupRol('Usuario');
	    $entity->setGroupRolTag('group-user');
	    $manager->persist($entity);
	    $this->addReference('role-user-edit', $entity);
	
	    $entity = new Role();
	    $entity->setName('User delete');
	    $entity->setSlug(User::ROLE_USER_DELETE);
	    $entity->setGroupRol('Usuario');
	    $entity->setGroupRolTag('group-user');
	    $manager->persist($entity);
	    $this->addReference('role-user-delete', $entity);
        
        

	    
        /**
         * CLIENT
         */
	    $entity = new Role();
	    $entity->setName('client view');
        $entity->setSlug(User::ROLE_CLIENT_VIEW);
        $entity->setGroupRol('Cliente');
        $entity->setGroupRolTag('group-client');
        $manager->persist($entity);
        $this->addReference('role-client-view', $entity);
        
        $entity = new Role();
        $entity->setName('Client create');
        $entity->setSlug(User::ROLE_CLIENT_CREATE);
        $entity->setGroupRol('Cliente');
        $entity->setGroupRolTag('group-client');
        $manager->persist($entity);
        $this->addReference('role-client-create', $entity);

        $entity = new Role();
        $entity->setName('client edit');
        $entity->setSlug(User::ROLE_CLIENT_EDIT);
        $entity->setGroupRol('Cliente');
        $entity->setGroupRolTag('group-client');
        $manager->persist($entity);
        $this->addReference('role-client-edit', $entity);

        $entity = new Role();
        $entity->setName('client delete');
        $entity->setSlug(User::ROLE_CLIENT_DELETE);
        $entity->setGroupRol('Cliente');
        $entity->setGroupRolTag('group-client');
        $manager->persist($entity);
        $this->addReference('role-client-delete', $entity);
        
        

        
        /**
         * EMPLOYEE
         */
	    $entity = new Role();
	    $entity->setName('Employee view');
        $entity->setSlug(User::ROLE_EMPLOYEE_VIEW);
        $entity->setGroupRol('Empleado');
        $entity->setGroupRolTag('group-employee');
        $manager->persist($entity);
        $this->addReference('role-employee-view', $entity);
        
        $entity = new Role();
        $entity->setName('Employee create');
        $entity->setSlug(User::ROLE_EMPLOYEE_CREATE);
        $entity->setGroupRol('Empleado');
        $entity->setGroupRolTag('group-employee');
        $manager->persist($entity);
        $this->addReference('role-employee-create', $entity);

        $entity = new Role();
        $entity->setName('Employee edit');
        $entity->setSlug(User::ROLE_EMPLOYEE_EDIT);
        $entity->setGroupRol('Empleado');
        $entity->setGroupRolTag('group-employee');
        $manager->persist($entity);
        $this->addReference('role-employee-edit', $entity);

        $entity = new Role();
        $entity->setName('Employee delete');
        $entity->setSlug(User::ROLE_EMPLOYEE_DELETE);
        $entity->setGroupRol('Empleado');
        $entity->setGroupRolTag('group-employee');
        $manager->persist($entity);
        $this->addReference('role-employee-delete', $entity);



        /**
         * PDV
         */
	    $entity = new Role();
	    $entity->setName('Pdv view');
	    $entity->setSlug(Pointofsale::ROLE_PDV_VIEW);
        $entity->setGroupRol('Pdv');
        $entity->setGroupRolTag('group-pdv');
        $manager->persist($entity);
        $this->addReference('role-pdv-view', $entity);
        
        $entity = new Role();
        $entity->setName('Pdv create');
        $entity->setSlug(Pointofsale::ROLE_PDV_CREATE);
        $entity->setGroupRol('Pdv');
        $entity->setGroupRolTag('group-pdv');
        $manager->persist($entity);
        $this->addReference('role-pdv-create', $entity);

        $entity = new Role();
        $entity->setName('Pdv edit');
        $entity->setSlug(Pointofsale::ROLE_PDV_EDIT);
        $entity->setGroupRol('Pdv');
        $entity->setGroupRolTag('group-pdv');
        $manager->persist($entity);
        $this->addReference('role-pdv-edit', $entity);

        $entity = new Role();
        $entity->setName('Pdv delete');
        $entity->setSlug(Pointofsale::ROLE_PDV_DELETE);
        $entity->setGroupRol('Pdv');
        $entity->setGroupRolTag('group-pdv');
        $manager->persist($entity);
        $this->addReference('role-pdv-delete', $entity);



        
        /**
         * CATEGORY
         */
	    $entity = new Role();
	    $entity->setName('Category view');
	    $entity->setSlug(Category::ROLE_CATEGORY_VIEW);
	    $entity->setGroupRol('Categoría');
	    $entity->setGroupRolTag('group-category');
	    $manager->persist($entity);
	    $this->addReference('role-category-view', $entity);
        
        $entity = new Role();
        $entity->setName('Category create');
        $entity->setSlug(Category::ROLE_CATEGORY_CREATE);
        $entity->setGroupRol('Categoría');
        $entity->setGroupRolTag('group-category');
        $manager->persist($entity);
        $this->addReference('role-category-create', $entity);

        $entity = new Role();
        $entity->setName('Category edit');
        $entity->setSlug(Category::ROLE_CATEGORY_EDIT);
        $entity->setGroupRol('Categoría');
        $entity->setGroupRolTag('group-category');
        $manager->persist($entity);
        $this->addReference('role-category-edit', $entity);

        $entity = new Role();
        $entity->setName('Category delete');
        $entity->setSlug(Category::ROLE_CATEGORY_DELETE);
        $entity->setGroupRol('Categoría');
        $entity->setGroupRolTag('group-category');
        $manager->persist($entity);
        $this->addReference('role-category-delete', $entity);




        /**
         * PRODUCT
         */
	    $entity = new Role();
	    $entity->setName('Product view');
	    $entity->setSlug(Product::ROLE_PRODUCT_VIEW);
	    $entity->setGroupRol('Producto');
	    $entity->setGroupRolTag('group-product');
	    $manager->persist($entity);
	    $this->addReference('role-product-view', $entity);
        
        $entity = new Role();
        $entity->setName('Product create');
        $entity->setSlug(Product::ROLE_PRODUCT_CREATE);
        $entity->setGroupRol('Producto');
        $entity->setGroupRolTag('group-product');
        $manager->persist($entity);
        $this->addReference('role-product-create', $entity);

        $entity = new Role();
        $entity->setName('Product edit');
        $entity->setSlug(Product::ROLE_PRODUCT_EDIT);
        $entity->setGroupRol('Producto');
        $entity->setGroupRolTag('group-product');
        $manager->persist($entity);
        $this->addReference('role-product-edit', $entity);

        $entity = new Role();
        $entity->setName('Product delete');
        $entity->setSlug(Product::ROLE_PRODUCT_DELETE);
        $entity->setGroupRol('Producto');
        $entity->setGroupRolTag('group-product');
        $manager->persist($entity);
        $this->addReference('role-product-delete', $entity);




        /**
         * PAYMENT TYPE
         */
	    $entity = new Role();
	    $entity->setName('PaymentType view');
	    $entity->setSlug(PaymentType::ROLE_PAYMENT_TYPE_VIEW);
	    $entity->setGroupRol('Tipo de pago');
	    $entity->setGroupRolTag('group-paymenttype');
	    $manager->persist($entity);
	    $this->addReference('role-paymenttype-view', $entity);
        
        $entity = new Role();
        $entity->setName('PaymentType create');
        $entity->setSlug(PaymentType::ROLE_PAYMENT_TYPE_CREATE);
        $entity->setGroupRol('Tipo de pago');
        $entity->setGroupRolTag('group-paymenttype');
        $manager->persist($entity);
        $this->addReference('role-paymenttype-create', $entity);

        $entity = new Role();
        $entity->setName('PaymentType edit');
        $entity->setSlug(PaymentType::ROLE_PAYMENT_TYPE_EDIT);
        $entity->setGroupRol('Tipo de pago');
        $entity->setGroupRolTag('group-paymenttype');
        $manager->persist($entity);
        $this->addReference('role-paymenttype-edit', $entity);

        $entity = new Role();
        $entity->setName('PaymentType delete');
        $entity->setSlug(PaymentType::ROLE_PAYMENT_TYPE_DELETE);
        $entity->setGroupRol('Tipo de pago');
        $entity->setGroupRolTag('group-paymenttype');
        $manager->persist($entity);
        $this->addReference('role-paymenttype-delete', $entity);




        /**
         * TICKET
         */
	    $entity = new Role();
	    $entity->setName('Ticket view');
	    $entity->setSlug(Ticket::ROLE_TICKET_VIEW);
	    $entity->setGroupRol('Ticket');
	    $entity->setGroupRolTag('group-ticket');
	    $manager->persist($entity);
	    $this->addReference('role-ticket-view', $entity);
        
        $entity = new Role();
        $entity->setName('Ticket create');
        $entity->setSlug(Ticket::ROLE_TICKET_CREATE);
        $entity->setGroupRol('Ticket');
        $entity->setGroupRolTag('group-ticket');
        $manager->persist($entity);
        $this->addReference('role-ticket-create', $entity);

        $entity = new Role();
        $entity->setName('Ticket edit');
        $entity->setSlug(Ticket::ROLE_TICKET_EDIT);
        $entity->setGroupRol('Ticket');
        $entity->setGroupRolTag('group-ticket');
        $manager->persist($entity);
        $this->addReference('role-ticket-edit', $entity);

        $entity = new Role();
        $entity->setName('Ticket delete');
        $entity->setSlug(Ticket::ROLE_TICKET_DELETE);
        $entity->setGroupRol('Ticket');
        $entity->setGroupRolTag('group-ticket');
        $manager->persist($entity);
        $this->addReference('role-ticket-delete', $entity);



        $manager->flush();

    }

    public function getOrder()
    {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 2;
    }
}