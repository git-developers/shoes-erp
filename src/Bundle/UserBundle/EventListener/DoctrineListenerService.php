<?php

declare(strict_types=1);

namespace Bundle\UserBundle\EventListener;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Bundle\UserBundle\Entity\User;
use Bundle\UserBundle\Entity\Friends;
use Cocur\Slugify\Slugify;
use Bundle\CoreBundle\EventListener\BaseDoctrineListenerService;

// https://coderwall.com/p/es3zkw/symfony2-listen-doctrine-events

class DoctrineListenerService extends BaseDoctrineListenerService implements EventSubscriber
{
    protected $encoder;

    public function __construct(TokenStorage $tokenStorage, UserPasswordEncoderInterface $encoder)
    {
        parent::__construct($tokenStorage);
        $this->encoder = $encoder;
    }

    /**
     * Returns an array of events this subscriber wants to listen to.
     *
     * @return array
     */
    public function getSubscribedEvents()
    {
        return [
            'preUpdate',
            'prePersist',
            'preRemove',
            'preFlush',
            'postFlush',
            'postPersist',
            'postUpdate',
            'postRemove',
            'postLoad',
            'onFlush',
        ];
    }

    /**
     * This method will called on Doctrine postPersist event
     */
    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
//        $entityManager = $args->getEntityManager();
//        $className = $entityManager->getClassMetadata(get_class($entity))->getName();

        if ($entity instanceof User) {

            $uniqid = uniqid();
            $nameRaw = $entity->getName();
            $name = $this->slugify($nameRaw);
            $name = substr($name, 0, 35);

            $entity->setLastName(is_null($entity->getLastName()) ? '' : $entity->getLastName());
            $entity->setCreatedAt($this->setupCreatedAt($entity));
            $entity->setUsername($uniqid);
            $entity->setEnabled(true);
            $entity->setUsernameCanonical($uniqid);
            $entity->setHeadline('Soy parte de Tianos!');
            $entity->setAboutMe(is_null($entity->getAboutMe()) ? 'Soy parte de Tianos ERP.' : $entity->getAboutMe());
	        $entity->setEmail($this->generateEmail($entity));
	        $entity->setEmailCanonical($this->generateEmail($entity));

            //password
            $plainPassword = $entity->getPassword();
            $encoded = $this->encoder->encodePassword($entity, $plainPassword);
            $entity->setPassword($encoded);

            return;
        } elseif ($entity instanceof Friends){
            $entity->setCreatedAt($this->setupCreatedAt($entity));
        }

    }

    /**
     * This method will called on Doctrine postPersist event
     */
    public function preUpdate(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        if ($entity instanceof User){

            $username = $entity->getUsername();
            $name = $entity->getName();
            $name = $this->slugify($name);
            $name = substr($name, 0, 35);

            $entity->setSlug($username . '-' . $name);
            $entity->setUpdatedAt($this->dateTime);

            return;
        }
    }

    /**
     * This method will called on Doctrine postUpdate event
     */
    public function postUpdate(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        if ($entity instanceof User){

            return;
        }
    }

    /**
     * This method will called on Doctrine postRemove event
     */
    public function postRemove(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        if ($entity instanceof User){

            return;
        }
    }

    /**
     * This method will called on Doctrine postLoad event
     */
    public function postLoad(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        if ($entity instanceof User){

            return;
        }
    }
    
    private function generateEmail(User $entity)
    {
	
	    if (!$entity instanceof User){
		    return;
	    }
    	
    	if (!is_null($entity->getEmail())) {
    	    return $entity->getEmail();
	    }
	
	    return $entity->getUsername() . "@example.com";
    }

}






