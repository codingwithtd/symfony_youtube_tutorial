<?php

namespace App\Repository\Main\Translation;

use App\Entity\Main\Translation\MainTranslationValidators;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<MainTranslationValidators>
 *
 * @method MainTranslationValidators|null find($id, $lockMode = null, $lockVersion = null)
 * @method MainTranslationValidators|null findOneBy(array $criteria, array $orderBy = null)
 * @method MainTranslationValidators[]    findAll()
 * @method MainTranslationValidators[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MainTranslationValidatorsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MainTranslationValidators::class);
    }

    public function save(MainTranslationValidators $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(MainTranslationValidators $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return MainTranslationValidators[] Returns an array of MainTranslationValidators objects
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

//    public function findOneBySomeField($value): ?MainTranslationValidators
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
