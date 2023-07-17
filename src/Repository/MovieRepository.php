<?php

namespace App\Repository;

use App\Entity\Movie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Movie>
 *
 * @method Movie|null find($id, $lockMode = null, $lockVersion = null)
 * @method Movie|null findOneBy(array $criteria, array $orderBy = null)
 * @method Movie[]    findAll()
 * @method Movie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MovieRepository extends ServiceEntityRepository
{
  public function __construct(ManagerRegistry $registry)
  {
    parent::__construct($registry, Movie::class);
  }

  public function save(Movie $entity, bool $flush = false): void
  {
    $this->getEntityManager()->persist($entity);

    if ($flush) {
      $this->getEntityManager()->flush();
    }
  }

  public function remove(Movie $entity, bool $flush = false): void
  {
    $this->getEntityManager()->remove($entity);

    if ($flush) {
      $this->getEntityManager()->flush();
    }
  }

  public function search(string $query, array $actorIds, array $realisatorIds, array $categoryIds)
  {
    $queryBuilder = $this->createQueryBuilder('m');

    // Filtre par titre si le critère de recherche est spécifié
    if ($query) {
      $queryBuilder
        ->andWhere('m.title LIKE :query')
        ->setParameter('query', '%' . $query . '%');
    }

    // Filtre par acteurs s'il y a des IDs d'acteurs spécifiés
    if ($actorIds) {
      $queryBuilder
        ->join('m.actors', 'a')
        ->andWhere('a.id IN (:actorIds)')
        ->setParameter('actorIds', $actorIds);
    }

    // Filtre par réalisateurs s'il y a des IDs de réalisateurs spécifiés
    if ($realisatorIds) {
      $queryBuilder
        ->join('m.realisators', 'r')
        ->andWhere('r.id IN (:realisatorIds)')
        ->setParameter('realisatorIds', $realisatorIds);
    }

    // Filtre par catégories s'il y a des IDs de catégories spécifiés
    if ($categoryIds) {
      $queryBuilder
        ->join('m.categories', 'c')
        ->andWhere('c.id IN (:categoryIds)')
        ->setParameter('categoryIds', $categoryIds);
    }

    return $queryBuilder->getQuery()->getResult();
  }
}
