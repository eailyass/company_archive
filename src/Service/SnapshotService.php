<?php

namespace App\Service;

use App\Entity\Company;
use App\Entity\CompanySnapshot;
use App\Repository\CompanySnapshotRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\SerializerInterface;

class SnapshotService{

    public function __construct(private EntityManagerInterface $em, private NormalizerInterface $normalizer, private SerializerInterface $serializer, private DenormalizerInterface $denormalizer, private CompanySnapshotRepository $repo)
    {
        
    }

    /**
     * take a company snapshot
     */

    public function snapshotCompany(Company $company):void{

        $currentState =  $this->normalizer->normalize($company,null,["groups" => ["snapshot"]]);
        $date = new \DateTime();
        $companySnapshot = new CompanySnapshot();
        $companySnapshot->setCompany($company);
        $companySnapshot->setSnapshot($currentState);
        $companySnapshot->setDate($date);
        $this->em->persist($companySnapshot);
        $this->em->flush();
        
    }

    /**
     * restore a company snapshot in specific date
     */
    public function restoreCompany(Company $company, DateTime $date):Company{

        $companySnapshotList = $this->repo->findCompanyByDate($company, $date);
        if ($companySnapshotList !== []) {
            return $this->denormalizer->denormalize($companySnapshotList[0]->getSnapshot(),Company::class,'null');
        }
        return $company;
    }

}