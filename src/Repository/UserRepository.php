<?php


namespace App\Repository;

use App\Entity\User;
use App\Repository\Filter\UserFilter;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

class UserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    /**
     * @param UserFilter $filter
     * @return mixed
     */
    public function findAllByFilter(UserFilter $filter)
    {
        $qb = $this->createQueryBuilderByUserFilter($filter);
        return $qb->getQuery()->getOneOrNullResult();
    }

    /**
     * @param UserFilter $filter
     * @return \Doctrine\ORM\QueryBuilder
     */
    private function createQueryBuilderByUserFilter(UserFilter $filter)
    {
        $qb = $this->createQueryBuilder('user');
        if ($filter->getIsActive()) {
            $qb->andWhere('user.isActive = :isActive')
                ->setParameter('isActive', $filter->getIsActive() );
        }

        return $qb;
    }
}