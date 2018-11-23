<?php

namespace App\Repository;

use App\Entity\Referee;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * @method Referee|null find($id, $lockMode = null, $lockVersion = null)
 * @method Referee|null findOneBy(array $criteria, array $orderBy = null)
 * @method Referee[]    findAll()
 * @method Referee[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RefereeRepository extends ServiceEntityRepository
{
    protected $container;
    public function __construct(RegistryInterface $registry, ContainerInterface $container)
    {
        parent::__construct($registry, Referee::class);
        $this->container = $container;
    }

    // /**
    //  * @return Referee[] Returns an array of Referee objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Referee
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function findAllByRefereeSurname($request, $search_surname){
        $entityManager = $this->getEntityManager();
        $container = $this->container;


        $club = $entityManager->createQueryBuilder()
            ->select('r')
            ->from(Referee::class, 'r')
            ->where("r.surname LIKE :surname")
            ->setParameter('surname',  $search_surname.'%')
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

    public function findAllByUserId($userId){
        $entityManager = $this->getEntityManager();
        $referee = $entityManager->createQueryBuilder()
            ->select('r')
            ->from(Referee::class, 'r')
            ->where("u.id = :userId")
            ->setParameter('userId',  $userId)
            ->join('r.user_id', 'u')
            ->getQuery()
            ->getOneOrNullResult();
        return $referee;
    }
}
