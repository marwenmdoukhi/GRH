<?php

namespace App\Repository;

use App\Entity\TypeConger;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TypeConger|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeConger|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeConger[]    findAll()
 * @method TypeConger[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeCongerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypeConger::class);
    }

    // /**
    //  * @return TypeConger[] Returns an array of TypeConger objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TypeConger
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
