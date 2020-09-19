<?php

namespace App\Repository;

use App\Entity\Gites;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Gites|null find($id, $lockMode = null, $lockVersion = null)
 * @method Gites|null findOneBy(array $criteria, array $orderBy = null)
 * @method Gites[]    findAll()
 * @method Gites[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GitesRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Gites::class);
    }

    // /**
    //  * @return Gites[] Returns an array of Gites objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Gites
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
