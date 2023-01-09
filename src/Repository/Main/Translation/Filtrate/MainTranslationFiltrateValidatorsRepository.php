<?php

namespace App\Repository\Main\Translation\Filtrate;

use App\Entity\Main\Translation\Filtrate\MainTranslationFiltrateValidators;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<MainTranslationFiltrateValidators>
 *
 * @method MainTranslationFiltrateValidators|null find($id, $lockMode = null, $lockVersion = null)
 * @method MainTranslationFiltrateValidators|null findOneBy(array $criteria, array $orderBy = null)
 * @method MainTranslationFiltrateValidators[]    findAll()
 * @method MainTranslationFiltrateValidators[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MainTranslationFiltrateValidatorsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MainTranslationFiltrateValidators::class);
    }

    public function save(MainTranslationFiltrateValidators $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(MainTranslationFiltrateValidators $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return MainTranslationFiltrateValidators[] Returns an array of MainTranslationFiltrateValidators objects
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

//    public function findOneBySomeField($value): ?MainTranslationFiltrateValidators
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
