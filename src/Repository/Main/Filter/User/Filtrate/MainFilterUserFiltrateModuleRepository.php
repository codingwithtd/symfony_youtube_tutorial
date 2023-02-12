<?php

namespace App\Repository\Main\Filter\User\Filtrate;

use App\Entity\Main\Filter\User\Filtrate\MainFilterUserFiltrateModule;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<MainFilterUserFiltrateModule>
 *
 * @method MainFilterUserFiltrateModule|null find($id, $lockMode = null, $lockVersion = null)
 * @method MainFilterUserFiltrateModule|null findOneBy(array $criteria, array $orderBy = null)
 * @method MainFilterUserFiltrateModule[]    findAll()
 * @method MainFilterUserFiltrateModule[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MainFilterUserFiltrateModuleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MainFilterUserFiltrateModule::class);
    }

    public function save(MainFilterUserFiltrateModule $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(MainFilterUserFiltrateModule $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return MainFilterUserFiltrateModule[] Returns an array of MainFilterUserFiltrateModule objects
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

//    public function findOneBySomeField($value): ?MainFilterUserFiltrateModule
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
