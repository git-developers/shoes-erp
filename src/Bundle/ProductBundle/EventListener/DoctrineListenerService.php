<?php

declare(strict_types=1);

namespace Bundle\ProductBundle\EventListener;

use Cocur\Slugify\Slugify;
use Doctrine\Common\EventSubscriber;
use Bundle\ProductBundle\Entity\Unit;
use Bundle\ProductBundle\Entity\Color;
use Bundle\ProductBundle\Entity\Product;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Bundle\CoreBundle\EventListener\BaseDoctrineListenerService;

class DoctrineListenerService extends BaseDoctrineListenerService implements EventSubscriber
{

    public function __construct(TokenStorage $tokenStorage)
    {
        parent::__construct($tokenStorage);
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
    public function postPersist(LifecycleEventArgs $args)
    {
	    $entity = $args->getEntity();
	    $em = $args->getEntityManager();
	
	    if ($entity instanceof Product) {
	    	
		
		    $entity->setBarcode(strval(Product::BARCODE + $entity->getId()));
		    $em->persist($entity);
		
		    return;
		
	    }
    }

    /**
     * This method will called on Doctrine prePersist event
     */
    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
//        $entityManager = $args->getEntityManager();
//        $className = $entityManager->getClassMetadata(get_class($entity))->getName();

        if ($entity instanceof Product) {
            $name = $entity->getName();
            $entity->setSlug($this->slugify($name));
            $entity->setCreatedAt($this->setupCreatedAt($entity));
            
            return;
        } elseif ($entity instanceof Unit) {
	        $name = $entity->getName();
	        $entity->setSlug($this->slugify($name));
	        $entity->setCreatedAt($this->setupCreatedAt($entity));
	
	        return;
        } elseif ($entity instanceof Color) {
	        $name = $entity->getName();
	        $entity->setSlug($this->slugify($name));
	        $entity->setCreatedAt($this->setupCreatedAt($entity));
	
	        return;
        }
    }

    /**
     * This method will called on Doctrine postPersist event
     */
    public function preUpdate(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        if ($entity instanceof Product){
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

        if ($entity instanceof Product){

            return;
        }
    }

    /**
     * This method will called on Doctrine postRemove event
     */
    public function postRemove(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        if ($entity instanceof Product){

            return;
        }
    }

    /**
     * This method will called on Doctrine postLoad event
     */
    public function postLoad(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        if ($entity instanceof Product){

            return;
        }
    }

}






