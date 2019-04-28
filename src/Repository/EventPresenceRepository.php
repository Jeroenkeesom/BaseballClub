<?php

namespace App\Repository;

use App\Entity\EventPresence;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method EventPresence|null find($id, $lockMode = null, $lockVersion = null)
 * @method EventPresence|null findOneBy(array $criteria, array $orderBy = null)
 * @method EventPresence[]    findAll()
 * @method EventPresence[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EventPresenceRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, EventPresence::class);
    }

    // /**
    //  * @return EventPresence[] Returns an array of EventPresence objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?EventPresence
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
