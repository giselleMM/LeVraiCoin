<?php

namespace App\Repository;

use App\Entity\Post;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Post>
 *
 * @method Post|null find($id, $lockMode = null, $lockVersion = null)
 * @method Post|null findOneBy(array $criteria, array $orderBy = null)
 * @method Post[]    findAll()
 * @method Post[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method Post[]    findOneBySomeField($field = null, $value = null)
 */
class PostRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Post::class);
    }

    public function save(Post $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Post $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * @return Post[]
     */
    
    public function searchPost($value): array
    {
        if($value['minimumPrice'] == null){
            $value['minimumPrice'] = "0";
        }
        if($value['maximumPrice'] == null){
            $value['maximumPrice'] = "1000000000";
        }

        $withTAG = $this->createQueryBuilder('t')
            ->andWhere('t.tag = :tag')
            ->setParameter('tag', $value['tag_id'])
            ->andWhere('t.price > :minimumPrice')
            ->setParameter('minimumPrice', $value['minimumPrice'])
            ->andWhere('t.price < :maximumPrice')
            ->setParameter('maximumPrice', $value['maximumPrice'])
            ->andWhere('t.title LIKE :title')
            ->setParameter('title', '%'.$value['title'].'%')
            ->orderBy('t.'.$value['filter'], 'DESC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult();

        $withOutTAG = $this->createQueryBuilder('t')
            ->andWhere('t.price > :minimumPrice')
            ->setParameter('minimumPrice', $value['minimumPrice'])
            ->andWhere('t.price < :maximumPrice')
            ->setParameter('maximumPrice', $value['maximumPrice'])
            ->andWhere('t.title LIKE :title')
            ->setParameter('title', '%'.$value['title'].'%')
            ->orderBy('t.'.$value['filter'], 'DESC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult();

        if($value['tag_id']!=''){
            return $withTAG;
        }else{
            return $withOutTAG;
        }
        ;
    }

//    /**
//     * @return Post[] Returns an array of Post objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

    
}
