<?php

namespace App\Repository\Main\Translation;

use App\Entity\Main\Translation\MainTranslationMessages;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<MainTranslationMessages>
 *
 * @method MainTranslationMessages|null find($id, $lockMode = null, $lockVersion = null)
 * @method MainTranslationMessages|null findOneBy(array $criteria, array $orderBy = null)
 * @method MainTranslationMessages[]    findAll()
 * @method MainTranslationMessages[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MainTranslationMessagesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MainTranslationMessages::class);
    }

    public function save(MainTranslationMessages $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(MainTranslationMessages $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return MainTranslationMessages[] Returns an array of MainTranslationMessages objects
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

//    public function findOneBySomeField($value): ?MainTranslationMessages
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
