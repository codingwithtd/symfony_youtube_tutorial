<?php

namespace App\Repository\Main\Filter\Translation\Filtrate;

use App\Entity\Main\Filter\Translation\Filtrate\MainFilterTranslationFiltrateCategories;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<MainFilterTranslationFiltrateCategories>
 *
 * @method MainFilterTranslationFiltrateCategories|null find($id, $lockMode = null, $lockVersion = null)
 * @method MainFilterTranslationFiltrateCategories|null findOneBy(array $criteria, array $orderBy = null)
 * @method MainFilterTranslationFiltrateCategories[]    findAll()
 * @method MainFilterTranslationFiltrateCategories[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MainFilterTranslationFiltrateCategoriesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MainFilterTranslationFiltrateCategories::class);
    }

    public function save(MainFilterTranslationFiltrateCategories $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(MainFilterTranslationFiltrateCategories $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return MainFilterTranslationFiltrateCategories[] Returns an array of MainFilterTranslationFiltrateCategories objects
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

//    public function findOneBySomeField($value): ?MainFilterTranslationFiltrateCategories
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
