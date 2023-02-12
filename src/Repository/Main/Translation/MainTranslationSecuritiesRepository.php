<?php

namespace App\Repository\Main\Translation;

use App\Entity\Main\Translation\MainTranslationSecurities;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<MainTranslationSecurities>
 *
 * @method MainTranslationSecurities|null find($id, $lockMode = null, $lockVersion = null)
 * @method MainTranslationSecurities|null findOneBy(array $criteria, array $orderBy = null)
 * @method MainTranslationSecurities[]    findAll()
 * @method MainTranslationSecurities[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MainTranslationSecuritiesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MainTranslationSecurities::class);
    }

    public function save(MainTranslationSecurities $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(MainTranslationSecurities $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return MainTranslationSecurities[] Returns an array of MainTranslationSecurities objects
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

//    public function findOneBySomeField($value): ?MainTranslationSecurities
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
