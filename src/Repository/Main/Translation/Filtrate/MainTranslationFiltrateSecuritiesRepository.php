<?php

namespace App\Repository\Main\Translation\Filtrate;

use App\Entity\Main\Translation\Filtrate\MainTranslationFiltrateSecurities;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<MainTranslationFiltrateSecurities>
 *
 * @method MainTranslationFiltrateSecurities|null find($id, $lockMode = null, $lockVersion = null)
 * @method MainTranslationFiltrateSecurities|null findOneBy(array $criteria, array $orderBy = null)
 * @method MainTranslationFiltrateSecurities[]    findAll()
 * @method MainTranslationFiltrateSecurities[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MainTranslationFiltrateSecuritiesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MainTranslationFiltrateSecurities::class);
    }

    public function save(MainTranslationFiltrateSecurities $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(MainTranslationFiltrateSecurities $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return MainTranslationFiltrateSecurities[] Returns an array of MainTranslationFiltrateSecurities objects
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

//    public function findOneBySomeField($value): ?MainTranslationFiltrateSecurities
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
