<?php

namespace App\Repository;

use App\Entity\Conference;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * @method Conference|null find($id, $lockMode = null, $lockVersion = null)
 * @method Conference|null findOneBy(array $criteria, array $orderBy = null)
 * @method Conference[]    findAll()
 * @method Conference[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ConferenceRepository extends ServiceEntityRepository
{

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Conference::class);
    }

    public const PAGINATOR_PER_PAGE = 3;
    public function getConferencePaginator(int $offset, string $year = '', string $city = ''): Paginator
    {
        $queryBuilder = $this->createQueryBuilder('c');
        if ($year) {
            $queryBuilder = $queryBuilder
                ->andWhere('c.year = :year')
                ->setParameter('year', $year);
        }
        if ($city) {
            $queryBuilder = $queryBuilder
                ->andWhere('c.city = :city')
                ->setParameter('city', $city);
        }
        $query = $queryBuilder
            ->orderBy('c.year', 'DESC')
            ->addOrderBy('c.city', 'ASC')
            ->setMaxResults(self::PAGINATOR_PER_PAGE)
            ->setFirstResult($offset)
            ->getQuery()
        ;

        return new Paginator($query);
    }



    public function getListYear()
    {
        $years = [];
        foreach ($this->createQueryBuilder('c')
            ->select('c.year')
            ->distinct(true)
            ->orderBy('c.year', 'ASC')
            ->getQuery()
            ->getResult() as $cols) {
            $years[] = $cols['year'];
        }
        return $years;
    }



    public function getListCity()
    {
        $cities = [];
        foreach ($this->createQueryBuilder('c')
            ->select('c.city')
            ->distinct(true)
            ->orderBy('c.city', 'ASC')
            ->getQuery()
            ->getResult() as $cols) {
            $cities[] = $cols['city'];
        }
        return $cities;
    }

    // /**
    //  * @return Conference[] Returns an array of Conference objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Conference
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
