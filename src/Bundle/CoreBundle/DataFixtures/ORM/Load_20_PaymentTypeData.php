<?php

declare(strict_types=1);

namespace Bundle\CoreBundle\DataFixtures\ORM;

use Bundle\TicketBundle\Entity\PaymentType;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class Load_20_PaymentTypeData extends AbstractFixture implements OrderedFixtureInterface
{

    protected $applicationUrl;

    public function __construct($applicationUrl)
    {
        $this->applicationUrl = $applicationUrl;
    }

    public function load(ObjectManager $manager)
    {
    	
        $entity = new PaymentType();
	    $entity->setCode('001');
	    $entity->setName('Abono por parte');
        $manager->persist($entity);

        $entity = new PaymentType();
	    $entity->setCode('002');
	    $entity->setName('Adelanto por mercadería');
        $manager->persist($entity);

        $entity = new PaymentType();
	    $entity->setCode('003');
	    $entity->setName('Efectivo');
        $manager->persist($entity);
        
        $entity = new PaymentType();
	    $entity->setCode('004');
	    $entity->setName('Credito');
        $manager->persist($entity);
        
        $entity = new PaymentType();
	    $entity->setCode('005');
	    $entity->setName('Pago por deposito');
        $manager->persist($entity);

        
        $manager->flush();

    }

    public function getOrder()
    {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 20;
    }
}