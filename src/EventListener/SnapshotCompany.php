<?php

namespace App\EventListener;

use App\Entity\Company;
use App\Service\SnapshotService;
use Doctrine\Persistence\Event\LifecycleEventArgs;

Class SnapshotCompany{

    public function __construct(private SnapshotService $snapshot)
    {
        
    }

    public function postUpdate(Company $company, LifecycleEventArgs $event): void
    {
        $this->snapshot->snapshotCompany($company);
    }

}