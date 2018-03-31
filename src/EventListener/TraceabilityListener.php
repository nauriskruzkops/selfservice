<?php

namespace App\EventListener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;


class TraceabilityListener {

    /** @var TokenStorageInterface  */
    private $tokenStorage;

    public function __construct( TokenStorageInterface $tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
    }

    public function preUpdate(LifecycleEventArgs $eventArgs)
    {
        $entity = $eventArgs->getEntity();

        if (method_exists($entity, 'setUpdatedAt')) {
            $entity->setUpdatedAt(new \DateTime());
        }

        if (method_exists($entity, 'setUpdateBy')) {
            $entity->setUpdatedBy(1); // ToDo : Auth user
        }
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        if (method_exists($entity, 'setCreatedAt')) {
            $entity->setCreatedAt(new \DateTime());
        }

        if (method_exists($entity, 'setCreateBy')) {
            $entity->setCreateBy(1); // ToDo : Auth user
        }


    }

}