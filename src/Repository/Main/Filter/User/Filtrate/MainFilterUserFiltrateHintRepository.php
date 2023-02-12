<?php

namespace App\Repository\Main\Filter\User\Filtrate;

use App\Entity\Main\Filter\User\Filtrate\MainFilterUserFiltrateHint;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<MainFilterUserFiltrateHint>
 *
 * @method MainFilterUserFiltrateHint|null find($id, $lockMode = null, $lockVersion = null)
 * @method MainFilterUserFiltrateHint|null findOneBy(array $criteria, array $orderBy = null)
 * @method MainFilterUserFiltrateHint[]    findAll()
 * @method MainFilterUserFiltrateHint[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MainFilterUserFiltrateHintRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MainFilterUserFiltrateHint::class);
    }

    public function save(MainFilterUserFiltrateHint $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(MainFilterUserFiltrateHint $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return MainFilterUserFiltrateHint[] Returns an array of MainFilterUserFiltrateHint objects
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

//    public function findOneBySomeField($value): ?MainFilterUserFiltrateHint
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
