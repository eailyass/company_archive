<?php

namespace App\EventListener;

use App\Entity\Address;
use App\Entity\Company;
use Doctrine\ORM\Events;
use App\Service\SnapshotService;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Doctrine\Bundle\DoctrineBundle\EventSubscriber\EventSubscriberInterface;

Class SnapshotCompany implements EventSubscriberInterface{

    public function __construct(private SnapshotService $snapshot)
    {
        
    }

    public function getSubscribedEvents(): array
    {
        return [
            Events::postPersist,
            Events::postUpdate,
        ];
    }
    
    public function postUpdate( LifecycleEventArgs $args): void
    {
        $entity = $args->getObject();

        if ($entity instanceof Company) {
            $this->snapshot->snapshotCompany($entity);
            return;
        }
        if ($entity instanceof Address) {
            $this->snapshot->snapshotCompany($entity->getCompany());
            return;
        }
    }

    public function postPersist(LifecycleEventArgs $args): void
    {
        $entity = $args->getObject();

        if ($entity instanceof Company) {
            $this->snapshot->snapshotCompany($entity);
            return;
        }
        if ($entity instanceof Address) {
            $this->snapshot->snapshotCompany($entity->getCompany());
            return;
        }
    }

}