<?php

namespace App\Repository;

use App\Entity\Games;
use App\Entity\Referee;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * @method Games|null find($id, $lockMode = null, $lockVersion = null)
 * @method Games|null findOneBy(array $criteria, array $orderBy = null)
 * @method Games[]    findAll()
 * @method Games[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GamesRepository extends ServiceEntityRepository
{
    protected $container;
    public function __construct(RegistryInterface $registry, ContainerInterface $container)
    {
        parent::__construct($registry, Games::class);
        $this->container = $container;
    }

    // /**
    //  * @return Games[] Returns an array of Games objects
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
    public function findOneBySomeField($value): ?Games
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function findAllByLeagueName($request, $search_leagueName){
        $entityManager = $this->getEntityManager();
        $container = $this->container;


        $club = $entityManager->createQueryBuilder()
            ->select('g')
            ->from(Games::class, 'g')
            ->where("gl.league_name LIKE :leagueName")
            ->setParameter('leagueName',  $search_leagueName.'%')
            ->join('g.league_id', 'gl')
            ->orderBy('g.date', 'DESC')
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

    public function findAllByLeagueNameReferee($request, $search_leagueName, $userId){
        $entityManager = $this->getEntityManager();
        $container = $this->container;

        $referee = $entityManager->createQueryBuilder()
            ->select('r')
            ->from(Referee::class, 'r')
            ->where('r.user_id = :userId')
            ->setParameter('userId', $userId)
            ->getQuery()
            ->getOneOrNullResult();

        $refereeId = $referee->getId();

        $club = $entityManager->createQueryBuilder()
            ->select('g')
            ->from(Games::class, 'g')
            ->where("gl.league_name LIKE :leagueName")
            ->andWhere('g.referee_id = :refereeId')
            ->setParameter('refereeId', $refereeId)
            ->setParameter('leagueName',  $search_leagueName.'%')
            ->join('g.league_id', 'gl')
            ->orderBy('g.date', 'DESC')
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
