<?php

declare(strict_types=1);

namespace Bundle\CoreBundle\EventListener;

use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Cocur\Slugify\Slugify;

class BaseDoctrineListenerService
{

    protected $dateTime;
    protected $tokenStorage;

    public function __construct(TokenStorage $tokenStorage)
    {
        $this->dateTime = new \DateTime();
        $this->tokenStorage = $tokenStorage;
    }

    protected function setupCreatedAt($entity)
    {
        $createdAt = $entity->getCreatedAt();

        if(is_null($createdAt)){
            return $this->dateTime;
        }

        return $createdAt;
    }

    protected function getUser()
    {
        return $this->tokenStorage->getToken()->getUser();
    }

    protected function slugify($string, $separator = '-')
    {
        $slugify = new Slugify(['lowercase' => true, 'separator' => $separator, 'ruleset' => 'default']);
        return $slugify->slugify($string);
    }
}