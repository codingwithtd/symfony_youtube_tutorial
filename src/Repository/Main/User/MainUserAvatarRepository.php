<?php

namespace App\Repository\Main\User;

use App\Entity\Main\User\MainUserAvatar;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<MainUserAvatar>
 *
 * @method MainUserAvatar|null find($id, $lockMode = null, $lockVersion = null)
 * @method MainUserAvatar|null findOneBy(array $criteria, array $orderBy = null)
 * @method MainUserAvatar[]    findAll()
 * @method MainUserAvatar[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MainUserAvatarRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MainUserAvatar::class);
    }

    public function save(MainUserAvatar $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(MainUserAvatar $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return MainUserAvatar[] Returns an array of MainUserAvatar objects
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

//    public function findOneBySomeField($value): ?MainUserAvatar
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
