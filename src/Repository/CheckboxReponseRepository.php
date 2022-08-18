<?php

namespace App\Repository;

use App\Entity\CheckboxReponse;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CheckboxReponse>
 *
 * @method CheckboxReponse|null find($id, $lockMode = null, $lockVersion = null)
 * @method CheckboxReponse|null findOneBy(array $criteria, array $orderBy = null)
 * @method CheckboxReponse[]    findAll()
 * @method CheckboxReponse[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CheckboxReponseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CheckboxReponse::class);
    }

    public function add(CheckboxReponse $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush() ;
        }
    }

    public function remove(CheckboxReponse $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return CheckboxReponse[] Returns an array of CheckboxReponse objects
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

//    public function findOneBySomeField($value): ?CheckboxReponse
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
