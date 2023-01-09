<?php

namespace App\Repository\Main\Filter\Translation;

use App\Entity\Main\Filter\Translation\MainFilterTranslationCategories;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<MainFilterTranslationCategories>
 *
 * @method MainFilterTranslationCategories|null find($id, $lockMode = null, $lockVersion = null)
 * @method MainFilterTranslationCategories|null findOneBy(array $criteria, array $orderBy = null)
 * @method MainFilterTranslationCategories[]    findAll()
 * @method MainFilterTranslationCategories[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MainFilterTranslationCategoriesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MainFilterTranslationCategories::class);
    }

    public function save(MainFilterTranslationCategories $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(MainFilterTranslationCategories $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return MainFilterTranslationCategories[] Returns an array of MainFilterTranslationCategories objects
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

//    public function findOneBySomeField($value): ?MainFilterTranslationCategories
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
