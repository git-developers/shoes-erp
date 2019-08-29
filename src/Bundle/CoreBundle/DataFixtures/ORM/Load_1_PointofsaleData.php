<?php

declare(strict_types=1);

namespace Bundle\CoreBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Bundle\PointofsaleBundle\Entity\Pointofsale;

class Load_1_PointofsaleData extends AbstractFixture implements OrderedFixtureInterface
{

    protected $applicationUrl;

    public function __construct($applicationUrl)
    {
        $this->applicationUrl = $applicationUrl;
    }

    public function load(ObjectManager $manager)
    {

        $entity = new Pointofsale();
        $entity->setCode('111');
        $entity->setName('Oficina principal');
        $entity->setAddress('Av. Petit Thouars 2161, San Isidro');
        $entity->setPhone('999888777');
        $entity->setSlug('point-of-sale-1');
        $entity->setLatitude('-12.0240716');
        $entity->setLongitude('-77.1120326');
        $manager->persist($entity);
        $this->addReference('pointofsale-1', $entity);

        $entity = new Pointofsale();
        $entity->setCode('222');
        $entity->setName('Tienda Calza II');
	    $entity->setAddress('Av. Petit Thouars 2161, San Isidro');
        $entity->setPhone('999888777');
        $entity->setSlug('point-of-sale-2');
        $entity->setLatitude('-12.1476123');
        $entity->setLongitude('-77.021375');
        $manager->persist($entity);
        $this->addReference('pointofsale-2', $entity);

        $entity = new Pointofsale();
        $entity->setCode('333');
        $entity->setName('Tienda Calza Trujillo');
	    $entity->setAddress('Av. Petit Thouars 2161, San Isidro');
        $entity->setPhone('999888777');
        $entity->setSlug('point-of-sale-3');
        $entity->setLatitude('-12.0982821');
        $entity->setLongitude('-76.9620132');
        $manager->persist($entity);
        $this->addReference('pointofsale-3', $entity);

        $entity = new Pointofsale();
        $entity->setCode('444');
        $entity->setName('Punto de venta 4');
	    $entity->setAddress('Av. Petit Thouars 2161, San Isidro');
        $entity->setPhone('999888777');
        $entity->setSlug('point-of-sale-4');
        $entity->setLatitude('-12.0625411');
        $entity->setLongitude('-77.0167905');
        $manager->persist($entity);
        $this->addReference('pointofsale-4', $entity);


        $manager->flush();

    }

    public function getOrder()
    {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 1;
    }
}