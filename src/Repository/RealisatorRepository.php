<?php

namespace App\Repository;

use App\Entity\Realisator;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Realisator>
 *
 * @method Realisator|null find($id, $lockMode = null, $lockVersion = null)
 * @method Realisator|null findOneBy(array $criteria, array $orderBy = null)
 * @method Realisator[]    findAll()
 * @method Realisator[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RealisatorRepository extends ServiceEntityRepository
{
  public function __construct(ManagerRegistry $registry)
  {
    parent::__construct($registry, Realisator::class);
  }

  public function save(Realisator $entity, bool $flush = false): void
  {
    $this->getEntityManager()->persist($entity);

    if ($flush) {
      $this->getEntityManager()->flush();
    }
  }

  public function remove(Realisator $entity, bool $flush = false): void
  {
    $this->getEntityManager()->remove($entity);

    if ($flush) {
      $this->getEntityManager()->flush();
    }
  }

  /**
   * @return Realisator[] Returns an array of Realisator objects
   */
  public function findByExampleField($value): array
  {
    return $this->createQueryBuilder('r')
      ->andWhere('r.exampleField = :val')
      ->setParameter('val', $value)
      ->orderBy('r.id', 'ASC')
      ->setMaxResults(10)
      ->getQuery()
      ->getResult();
  }

  public function findOneBySomeField($value): ?Realisator
  {
    return $this->createQueryBuilder('r')
      ->andWhere('r.exampleField = :val')
      ->setParameter('val', $value)
      ->getQuery()
      ->getOneOrNullResult();
  }
}
