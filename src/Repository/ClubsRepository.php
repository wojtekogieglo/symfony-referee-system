<?php

namespace App\Repository;

use App\Entity\Clubs;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * @method Clubs|null find($id, $lockMode = null, $lockVersion = null)
 * @method Clubs|null findOneBy(array $criteria, array $orderBy = null)
 * @method Clubs[]    findAll()
 * @method Clubs[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClubsRepository extends ServiceEntityRepository
{
    protected $container;

    public function __construct(RegistryInterface $registry, ContainerInterface $container)
    {
        parent::__construct($registry, Clubs::class);
        $this->container = $container;
    }

    // /**
    //  * @return Clubs[] Returns an array of Clubs objects
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
    public function findOneBySomeField($value): ?Clubs
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function getAll(): array {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT clubs FROM App\Entity\Clubs clubs'
        );

        return $query->execute();
    }

    public function getAllWithKey(): array {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
          'SELECT clubs, league FROM App\Entity\Clubs clubs LEFT JOIN clubs.league_id league'
        );

        return $query->execute();
    }

    public function findAllByClubName($request, $search_clubName){
        $entityManager = $this->getEntityManager();
        $container = $this->container;


        $club = $entityManager->createQueryBuilder()
            ->select('c')
            ->from(Clubs::class, 'c')
            ->where("c.club_name LIKE :clubName")
            ->setParameter('clubName',  $search_clubName.'%')
            ->getQuery()
            ->getResult();

        $pagenator = $container->get('knp_paginator');
        $result = $pagenator->paginate(
            $club,
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 5)
        );

        return $result;
    }
}
