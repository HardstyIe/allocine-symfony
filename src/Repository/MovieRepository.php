<?php

namespace App\Repository;

use App\Entity\Movie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\Expr\Orx;
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

  public function search($query, $actors, $realisators, $categories)
  {
    $qb = $this->createQueryBuilder('m');

    // Recherche par titre
    if ($query) {
      $qb->andWhere($qb->expr()->like('m.title', ':query'))
        ->setParameter('query', '%' . $query . '%');
    }

    // Recherche par acteurs
    if ($actors) {
      $orX = new Orx();
      foreach ($actors as $index => $actor) {
        $paramName = 'actor_' . $index;
        $orX->add($qb->expr()->isMemberOf(':' . $paramName, 'm.actors'));
        $qb->setParameter($paramName, $actor);
      }
      $qb->andWhere($orX);
    }

    // Recherche par réalisateurs
    if ($realisators) {
      $orX = new Orx();
      foreach ($realisators as $index => $realisator) {
        $paramName = 'realisator_' . $index;
        $orX->add($qb->expr()->isMemberOf(':' . $paramName, 'm.realisators'));
        $qb->setParameter($paramName, $realisator);
      }
      $qb->andWhere($orX);
    }

    // Recherche par catégories
    if ($categories) {
      $orX = new Orx();
      foreach ($categories as $index => $category) {
        $paramName = 'category_' . $index;
        $orX->add($qb->expr()->isMemberOf(':' . $paramName, 'm.categories'));
        $qb->setParameter($paramName, $category);
      }
      $qb->andWhere($orX);
    }

    return $qb->getQuery()->getResult();
  }
}
