<?php

namespace App\Repository\Main\Filter\User\Filtrate;

use App\Entity\Main\Filter\User\Filtrate\MainFilterUserFiltrateRole;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<MainFilterUserFiltrateRole>
 *
 * @method MainFilterUserFiltrateRole|null find($id, $lockMode = null, $lockVersion = null)
 * @method MainFilterUserFiltrateRole|null findOneBy(array $criteria, array $orderBy = null)
 * @method MainFilterUserFiltrateRole[]    findAll()
 * @method MainFilterUserFiltrateRole[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MainFilterUserFiltrateRoleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MainFilterUserFiltrateRole::class);
    }

    public function save(MainFilterUserFiltrateRole $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(MainFilterUserFiltrateRole $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return MainFilterUserFiltrateRole[] Returns an array of MainFilterUserFiltrateRole objects
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

//    public function findOneBySomeField($value): ?MainFilterUserFiltrateRole
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
