<?php

namespace App\Repository\Main\Filter\User;

use App\Entity\Main\Filter\User\MainFilterUserHint;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<MainFilterUserHint>
 *
 * @method MainFilterUserHint|null find($id, $lockMode = null, $lockVersion = null)
 * @method MainFilterUserHint|null findOneBy(array $criteria, array $orderBy = null)
 * @method MainFilterUserHint[]    findAll()
 * @method MainFilterUserHint[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MainFilterUserHintRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MainFilterUserHint::class);
    }

    public function save(MainFilterUserHint $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(MainFilterUserHint $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return MainFilterUserHint[] Returns an array of MainFilterUserHint objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('m.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?MainFilterUserHint
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
