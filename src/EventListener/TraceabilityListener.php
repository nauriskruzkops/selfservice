<?php

namespace App\EventListener;

use App\Entity\User;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;


class TraceabilityListener
{
    /** @var User  */
    private $user;

    public function __construct( TokenStorageInterface $tokenStorage)
    {
        if (($token = $tokenStorage->getToken())) {
            $this->user = $token->getUser();
        }
    }

    public function preUpdate(LifecycleEventArgs $eventArgs)
    {
        $entity = $eventArgs->getEntity();

        if (!$this->user) {
            $this->user = $eventArgs->getEntityManager()->getRepository(User::class)->findOneBy(['username' => 'system'], ['id' => 'ASC']);
        }

        if (method_exists($entity, 'setUpdatedAt')) {
            $entity->setUpdatedAt(new \DateTime());
        }

        if (method_exists($entity, 'setUpdatedBy')) {
            if ($this->user) {
                $entity->setUpdatedBy($this->user);
            }
        }
    }

    public function prePersist(LifecycleEventArgs $eventArgs)
    {
        $entity = $eventArgs->getEntity();
        if ($entity instanceof User) {
            if ($entity->getUsername() == 'systeam') {
                return ;
            }
        }

        if (!$this->user) {
            $this->user = $eventArgs->getEntityManager()->getRepository(User::class)->findOneBy(['username' => 'system'], ['id' => 'ASC']);
        }

        if (method_exists($entity, 'setCreatedAt')) {
            $entity->setCreatedAt(new \DateTime());
        }

        if (method_exists($entity, 'setCreatedBy')) {
            if ($this->user && !$entity->getCreatedBy()) {
                $entity->setCreatedBy($this->user);
            }
        }
    }

}