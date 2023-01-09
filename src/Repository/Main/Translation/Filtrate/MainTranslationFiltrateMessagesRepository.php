<?php

namespace App\Repository\Main\Translation\Filtrate;

use App\Entity\Main\Translation\Filtrate\MainTranslationFiltrateMessages;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<MainTranslationFiltrateMessages>
 *
 * @method MainTranslationFiltrateMessages|null find($id, $lockMode = null, $lockVersion = null)
 * @method MainTranslationFiltrateMessages|null findOneBy(array $criteria, array $orderBy = null)
 * @method MainTranslationFiltrateMessages[]    findAll()
 * @method MainTranslationFiltrateMessages[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MainTranslationFiltrateMessagesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MainTranslationFiltrateMessages::class);
    }

    public function save(MainTranslationFiltrateMessages $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(MainTranslationFiltrateMessages $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return MainTranslationFiltrateMessages[] Returns an array of MainTranslationFiltrateMessages objects
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

//    public function findOneBySomeField($value): ?MainTranslationFiltrateMessages
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
