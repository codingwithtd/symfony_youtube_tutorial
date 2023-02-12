<?php

namespace App\Repository\Main\Filter\User;

use App\Entity\Main\Filter\User\MainFilterUserRole;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<MainFilterUserRole>
 *
 * @method MainFilterUserRole|null find($id, $lockMode = null, $lockVersion = null)
 * @method MainFilterUserRole|null findOneBy(array $criteria, array $orderBy = null)
 * @method MainFilterUserRole[]    findAll()
 * @method MainFilterUserRole[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MainFilterUserRoleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MainFilterUserRole::class);
    }

    public function save(MainFilterUserRole $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(MainFilterUserRole $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return MainFilterUserRole[] Returns an array of MainFilterUserRole objects
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

//    public function findOneBySomeField($value): ?MainFilterUserRole
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
