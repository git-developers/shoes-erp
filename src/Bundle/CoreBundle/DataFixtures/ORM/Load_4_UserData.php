<?php

declare(strict_types=1);

namespace Bundle\CoreBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Bundle\UserBundle\Entity\User;

class Load_4_UserData extends AbstractFixture implements OrderedFixtureInterface
{

    protected $applicationUrl;

    public function __construct($applicationUrl)
    {
        $this->applicationUrl = $applicationUrl;
    }

    public function load(ObjectManager $manager)
    {

        $profileSuperAdmin = $this->getReference('profile-super-admin');
        $profilePdvAdmin = $this->getReference('profile-pdv-admin');
        $profileEmployee = $this->getReference('profile-employee');
        $profileClient = $this->getReference('profile-client');
        $profileGuest = $this->getReference('profile-guest');
	
	    $pointOfSale_10 = $this->getReference('pointofsale-3');
		

        $entity = new User();
        $entity->setDni('12345688');
        $entity->setPassword('123');
        $entity->setName('Carlos');
        $entity->setLastName('Carlos');
        $entity->setEmail('carlos@' . $this->applicationUrl);
        $entity->setProfile($profileSuperAdmin);
        $manager->persist($entity);
        $this->addReference('user-1', $entity);

        $entity = new User();
        $entity->setDni('87654321');
        $entity->setPassword('123');
        $entity->setName('Albert');
        $entity->setLastName('Einstein');
        $entity->setEmail('aeinstein@' . $this->applicationUrl);
        $entity->setProfile($profilePdvAdmin);
        $manager->persist($entity);
        $this->addReference('user-2', $entity);
	
        
	
	    /**
	     * EMPLOYEE
	     */
        $entity = new User();
        $entity->setDni('22334455');
        $entity->setPassword('1q2w3e4r');
        $entity->setName('Bill');
        $entity->setLastName('Gates');
        $entity->setEmail('bgates@' . $this->applicationUrl);
        $entity->setProfile($profileEmployee);
        $manager->persist($entity);
	
	    $pointOfSale_10->addUser($entity);
	    $manager->persist($pointOfSale_10);
        
        $this->addReference('user-3', $entity);

        $entity = new User();
        $entity->setDni('99887766');
        $entity->setPassword('123');
        $entity->setName('Isaac');
        $entity->setLastName('Newton');
        $entity->setEmail('inewton@' . $this->applicationUrl);
        $entity->setProfile($profileEmployee);
        $manager->persist($entity);
	
	    $pointOfSale_10->addUser($entity);
	    $manager->persist($pointOfSale_10);
        
        $this->addReference('user-4', $entity);

        $entity = new User();
        $entity->setDni('6757234535');
        $entity->setPassword('123');
        $entity->setName('Marco');
        $entity->setLastName('Polo');
        $entity->setEmail('mpolo@' . $this->applicationUrl);
        $entity->setProfile($profileEmployee);
        $manager->persist($entity);
	
	    $pointOfSale_10->addUser($entity);
	    $manager->persist($pointOfSale_10);
        
        $this->addReference('user-41', $entity);

        $entity = new User();
        $entity->setDni('99887766');
        $entity->setPassword('123');
        $entity->setName('Theodore');
        $entity->setLastName('Roosevelt');
        $entity->setEmail('troosevelt@' . $this->applicationUrl);
        $entity->setProfile($profileEmployee);
        $manager->persist($entity);
	
	    $pointOfSale_10->addUser($entity);
	    $manager->persist($pointOfSale_10);
        
        $this->addReference('user-42', $entity);

        $entity = new User();
        $entity->setDni('99887766');
        $entity->setPassword('123');
        $entity->setName('Karl');
        $entity->setLastName('Marx');
        $entity->setEmail('kmarx@' . $this->applicationUrl);
        $entity->setProfile($profileEmployee);
        $manager->persist($entity);
	
	    $pointOfSale_10->addUser($entity);
	    $manager->persist($pointOfSale_10);
        
        $this->addReference('user-43', $entity);

        $entity = new User();
        $entity->setDni('99887766');
        $entity->setPassword('123');
        $entity->setName('Frederick');
        $entity->setLastName('Douglass');
        $entity->setEmail('fdouglass@' . $this->applicationUrl);
        $entity->setProfile($profileEmployee);
        $manager->persist($entity);
	
	    $pointOfSale_10->addUser($entity);
	    $manager->persist($pointOfSale_10);
	    
        $this->addReference('user-44', $entity);

        $entity = new User();
        $entity->setDni('99887766');
        $entity->setPassword('123');
        $entity->setName('John');
        $entity->setLastName('Lennon');
        $entity->setEmail('jlennon@' . $this->applicationUrl);
        $entity->setProfile($profileEmployee);
        $manager->persist($entity);
	
	    $pointOfSale_10->addUser($entity);
	    $manager->persist($pointOfSale_10);
	    
        $this->addReference('user-45', $entity);
	
        
        
	
	    /**
	     * CLIENT
	     */
        $entity = new User();
        $entity->setDni('88889999');
        $entity->setPassword('123');
        $entity->setName('Steve');
        $entity->setLastName('Jobs');
        $entity->setEmail('sjobs@' . $this->applicationUrl);
        $entity->setProfile($profileClient);
        $manager->persist($entity);
	
	    $pointOfSale_10->addUser($entity);
        $manager->persist($pointOfSale_10);
	    
        $this->addReference('user-5', $entity);

        $entity = new User();
        $entity->setDni('657657567');
        $entity->setPassword('123');
        $entity->setName('Roger');
        $entity->setLastName('Federer');
        $entity->setEmail('rfederer@' . $this->applicationUrl);
        $entity->setProfile($profileClient);
        $manager->persist($entity);
	
	    $pointOfSale_10->addUser($entity);
	    $manager->persist($pointOfSale_10);
        
        $this->addReference('user-6', $entity);

        $entity = new User();
        $entity->setDni('657657567');
        $entity->setPassword('123');
        $entity->setName('Neymar');
        $entity->setLastName('Junior');
        $entity->setEmail('njunior@' . $this->applicationUrl);
        $entity->setProfile($profileClient);
        $manager->persist($entity);
	
	    $pointOfSale_10->addUser($entity);
	    $manager->persist($pointOfSale_10);
        
        $this->addReference('user-7', $entity);

        $entity = new User();
        $entity->setDni('35462333');
        $entity->setPassword('123');
        $entity->setName('Keiko');
        $entity->setLastName('Garcia');
        $entity->setEmail('kgarcia@' . $this->applicationUrl);
        $entity->setProfile($profileClient);
        $manager->persist($entity);
	
	    $pointOfSale_10->addUser($entity);
	    $manager->persist($pointOfSale_10);
        
        $this->addReference('user-8', $entity);

        $entity = new User();
        $entity->setDni('55566644');
        $entity->setPassword('123');
        $entity->setName('Juan');
        $entity->setLastName('Lopez');
        $entity->setEmail('jlopez@' . $this->applicationUrl);
        $entity->setProfile($profileClient);
        $manager->persist($entity);
	
	    $pointOfSale_10->addUser($entity);
	    $manager->persist($pointOfSale_10);
        
        $this->addReference('user-9', $entity);

        $entity = new User();
        $entity->setDni('35462333');
        $entity->setPassword('123');
        $entity->setName('Renee');
        $entity->setLastName('Medina');
        $entity->setEmail('rmedina@' . $this->applicationUrl);
        $entity->setProfile($profileClient);
        $manager->persist($entity);
	
	    $pointOfSale_10->addUser($entity);
	    $manager->persist($pointOfSale_10);
        
        $this->addReference('user-10', $entity);

        $entity = new User();
        $entity->setDni('5464656456456');
        $entity->setPassword('123');
        $entity->setName('Katherine');
        $entity->setLastName('Johnson');
        $entity->setEmail('kjohnson@' . $this->applicationUrl);
        $entity->setProfile($profileClient);
        $manager->persist($entity);
        $this->addReference('user-11', $entity);

        $entity = new User();
        $entity->setDni('2131233454');
        $entity->setPassword('123');
        $entity->setName('Margaret');
        $entity->setLastName('Hamilton');
        $entity->setEmail('mhamilton@' . $this->applicationUrl);
        $entity->setProfile($profileClient);
        $manager->persist($entity);
	
	    $pointOfSale_10->addUser($entity);
	    $manager->persist($pointOfSale_10);
        
        $this->addReference('user-12', $entity);

        $entity = new User();
        $entity->setDni('7897978956');
        $entity->setPassword('123');
        $entity->setName('Katharine');
        $entity->setLastName('Hepburn');
        $entity->setEmail('khepburn@' . $this->applicationUrl);
        $entity->setProfile($profileClient);
        $manager->persist($entity);
	
	    $pointOfSale_10->addUser($entity);
	    $manager->persist($pointOfSale_10);
        
        $this->addReference('user-13', $entity);

        $entity = new User();
        $entity->setDni('7897654321');
        $entity->setPassword('123');
        $entity->setName('Dorothy');
        $entity->setLastName('Parker');
        $entity->setEmail('dparker@' . $this->applicationUrl);
        $entity->setProfile($profileClient);
        $manager->persist($entity);
	
	    $pointOfSale_10->addUser($entity);
	    $manager->persist($pointOfSale_10);
        
        $this->addReference('user-14', $entity);

        $entity = new User();
        $entity->setDni('123123214');
        $entity->setPassword('123');
        $entity->setName('Abraham');
        $entity->setLastName('Lincoln');
        $entity->setEmail('alincoln@' . $this->applicationUrl);
        $entity->setProfile($profileClient);
        $manager->persist($entity);
	
	    $pointOfSale_10->addUser($entity);
	    $manager->persist($pointOfSale_10);
        
        $this->addReference('user-15', $entity);

        $entity = new User();
        $entity->setDni('890787564');
        $entity->setPassword('123');
        $entity->setName('Walt');
        $entity->setLastName('Disney');
        $entity->setEmail('wdisney@' . $this->applicationUrl);
        $entity->setProfile($profileClient);
        $manager->persist($entity);
	
	    $pointOfSale_10->addUser($entity);
	    $manager->persist($pointOfSale_10);
        
        $this->addReference('user-16', $entity);

        $entity = new User();
        $entity->setDni('78907890890');
        $entity->setPassword('123');
        $entity->setName('Napoleon');
        $entity->setLastName('Bonaparte');
        $entity->setEmail('nbonaparte@' . $this->applicationUrl);
        $entity->setProfile($profileClient);
        $manager->persist($entity);
	
	    $pointOfSale_10->addUser($entity);
	    $manager->persist($pointOfSale_10);
        
        $this->addReference('user-17', $entity);

        $entity = new User();
        $entity->setDni('78907890890');
        $entity->setPassword('123');
        $entity->setName('Abraham');
        $entity->setLastName('Elizabeth');
        $entity->setEmail('aelizabeth@' . $this->applicationUrl);
        $entity->setProfile($profileClient);
        $manager->persist($entity);
	
	    $pointOfSale_10->addUser($entity);
	    $manager->persist($pointOfSale_10);
        
        $this->addReference('user-18', $entity);

        $entity = new User();
        $entity->setDni('3245353452');
        $entity->setPassword('123');
        $entity->setName('Benjamin');
        $entity->setLastName('Franklin');
        $entity->setEmail('bfranklin@' . $this->applicationUrl);
        $entity->setProfile($profileClient);
        $manager->persist($entity);
	
	    $pointOfSale_10->addUser($entity);
	    $manager->persist($pointOfSale_10);
        
        $this->addReference('user-19', $entity);

        $entity = new User();
        $entity->setDni('764355456');
        $entity->setPassword('123');
        $entity->setName('Wright');
        $entity->setLastName('Brothers');
        $entity->setEmail('wbrothers@' . $this->applicationUrl);
        $entity->setProfile($profileClient);
        $manager->persist($entity);
	
	    $pointOfSale_10->addUser($entity);
	    $manager->persist($pointOfSale_10);
        
        $this->addReference('user-20', $entity);


        $manager->flush();

    }

    public function getOrder()
    {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 4;
    }
}