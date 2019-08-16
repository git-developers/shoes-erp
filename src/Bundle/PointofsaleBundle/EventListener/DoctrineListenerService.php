<?php

declare(strict_types=1);

namespace Bundle\PointofsaleBundle\EventListener;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Bundle\PointofsaleBundle\Entity\Pointofsale;
use Bundle\PointofsaleBundle\Entity\PointofsaleOpening;
use Cocur\Slugify\Slugify;
use Bundle\CoreBundle\EventListener\BaseDoctrineListenerService;
// https://coderwall.com/p/es3zkw/symfony2-listen-doctrine-events

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
    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
//        $entityManager = $args->getEntityManager();
//        $className = $entityManager->getClassMetadata(get_class($entity))->getName();

        if ($entity instanceof Pointofsale){

            $slug = $entity->getSlug();

            if (empty($slug)) {
                $slug = $entity->getName();
            }

            $entity->setSlug($this->slugify($slug));
            $entity->setStatus(Pointofsale::STATUS_CLOSED);
            $entity->setCreatedAt($this->setupCreatedAt($entity));

            return;
        } elseif ($entity instanceof PointofsaleOpening) {
	        $slug = $entity->getName();
	        $entity->setSlug($this->slugify($slug));
	        $entity->setCreatedAt($this->setupCreatedAt($entity));
        }
    }

    /**
     * This method will called on Doctrine postPersist event
     */
    public function preUpdate(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        if ($entity instanceof Pointofsale){
            $entity->setUpdatedAt($this->dateTime);

            $slug = $entity->getSlug();

            if (empty($slug)) {
                $slug = $entity->getName();
            }

            $entity->setSlug($this->slugify($slug));

            return;
        }
    }

    /**
     * This method will called on Doctrine postUpdate event
     */
    public function postUpdate(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        if ($entity instanceof Pointofsale){

            return;
        }
    }

    /**
     * This method will called on Doctrine postRemove event
     */
    public function postRemove(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        if ($entity instanceof Pointofsale){

            return;
        }
    }

    /**
     * This method will called on Doctrine postLoad event
     */
    public function postLoad(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        if ($entity instanceof Pointofsale){
	
	        $timeStart = $entity->getCreatedAt();
	        $timeEnd = new \DateTime();
	
	        $interval = $timeStart->diff($timeEnd);
	        $interval = $interval->format('%m meses - %a dias - %h horas'); // %y years %m months %a days - %i minutos - %s segundos
	
	        $entity->setCreatedAtDiff($interval);
	        
	        return;
        }
    }
}






