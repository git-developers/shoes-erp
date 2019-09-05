<?php

declare(strict_types=1);

namespace Bundle\CoreBundle\DataFixtures\ORM;

use Bundle\TicketBundle\Entity\PaymentType;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Bundle\SettingsBundle\Entity\Settings;

class Load_22_SettingsData extends AbstractFixture implements OrderedFixtureInterface
{

    protected $applicationUrl;

    public function __construct($applicationUrl)
    {
        $this->applicationUrl = $applicationUrl;
    }

    public function load(ObjectManager $manager)
    {
        
        $entity = new Settings();
	    $entity->setClassName(Settings::SYSTEM_EMAIL);
	    $entity->setClassValue("system@" . $this->applicationUrl);
        $manager->persist($entity);
        
        $entity = new Settings();
	    $entity->setClassName(Settings::SALES_QUANTITY);
	    $entity->setClassValue("0.5");
        $manager->persist($entity);
        
        $entity = new Settings();
	    $entity->setClassName(Settings::SALES_QUANTITY_PRICE_X);
	    $entity->setClassValue("12");
        $manager->persist($entity);
        
        $entity = new Settings();
	    $entity->setClassName(Settings::PRINTER_FILENAME);
	    $entity->setClassValue("localhost:631");
        $manager->persist($entity);

        
        $manager->flush();

    }

    public function getOrder()
    {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 22;
    }
}