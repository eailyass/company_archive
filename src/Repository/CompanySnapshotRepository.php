<?php

namespace App\Repository;

use App\Entity\Company;
use Doctrine\ORM\ORMException;
use App\Entity\CompanySnapshot;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method CompanySnapshot|null find($id, $lockMode = null, $lockVersion = null)
 * @method CompanySnapshot|null findOneBy(array $criteria, array $orderBy = null)
 * @method CompanySnapshot[]    findAll()
 * @method CompanySnapshot[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CompanySnapshotRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CompanySnapshot::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(CompanySnapshot $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(CompanySnapshot $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * Find a company snapshot in a specific date
     */
    public function findCompanyByDate(Company $company, \DateTime $date){
        $qb = $this->createQueryBuilder('s')
        ->andWhere('s.company = :company')
        ->andWhere('s.date <= :date')
        ->orderBy('s.date','DESC')
        ->setParameters(['company'=>$company,'date'=>$date]);
        return $qb->getQuery()->getResult();
    }

    // /**
    //  * @return CompanySnapshot[] Returns an array of CompanySnapshot objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CompanySnapshot
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
