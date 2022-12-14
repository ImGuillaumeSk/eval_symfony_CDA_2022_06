<?php

namespace App\Repository;

use App\Entity\ComputerListByUser;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ComputerListByUser>
 *
 * @method ComputerListByUser|null find($id, $lockMode = null, $lockVersion = null)
 * @method ComputerListByUser|null findOneBy(array $criteria, array $orderBy = null)
 * @method ComputerListByUser[]    findAll()
 * @method ComputerListByUser[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ComputerListByUserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ComputerListByUser::class);
    }

    public function save(ComputerListByUser $entity, bool $flush = true): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(ComputerListByUser $entity, bool $flush = true): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return ComputerListByUser[] Returns an array of ComputerListByUser objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ComputerListByUser
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
