<?php

namespace App\Repository;

use App\Entity\Test;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Test>
 *
 * @method Test|null find($id, $lockMode = null, $lockVersion = null)
 * @method Test|null findOneBy(array $criteria, array $orderBy = null)
 * @method Test[]    findAll()
 * @method Test[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TestRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Test::class);
    }

    public function save(Test $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Test $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return Test[] Returns an array of Test objects
//     */
    public function searchTest($value): array
    {
        if($value['minimumPrice'] == null){
            $value['minimumPrice'] = "0";
        }
        if($value['maximumPrice'] == null){
            $value['maximumPrice'] = "1000000000";
        }
        return $this->createQueryBuilder('t')
            ->andWhere('t.tag_id LIKE :tag_id')
            ->setParameter('tag_id', '%'.$value['tag_id'].'%')
            ->andWhere('t.price > :minimumPrice')
            ->setParameter('minimumPrice', $value['minimumPrice'])
            ->andWhere('t.price < :maximumPrice')
            ->setParameter('maximumPrice', $value['maximumPrice'])
            ->andWhere('t.title LIKE :title')
            ->setParameter('title', '%'.$value['title'].'%')
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }

//    public function findOneBySomeField($value): ?Test
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
