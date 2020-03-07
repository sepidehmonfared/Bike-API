<?php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;


/**
 * Class BikeRepository
 * @package App\Repository
 *
 * @author Sepideh Monfared <monfared.sepideh@gmail.com>
 */
class BikeRepository extends EntityRepository
{
    /**
     * @param int $id
     * @return object|null
     */
    public function findOneById(int $id)
    {
        return $this->find($id);
    }

    /**
     * @param array $filters
     */
    public function findAllQueryBuilder(array $filters = []) {

//        $qb = $this->createQueryBuilder('bike');
//        if ($filter) {
//            $qb->andWhere('programmer.nickname LIKE :filter OR programmer.tagLine LIKE :filter')
//                ->setParameter('filter', '%'.$filter.'%');
//        }
//        return $qb;
    }
}