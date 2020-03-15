<?php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Tools\Pagination\Paginator;


/**
 * Class BikeRepository
 * @package App\Repository
 *
 * @author Sepideh Monfared <monfared.sepideh@gmail.com>
 */
class BikeRepository extends EntityRepository
{
    /**
     * list page's size
     */
    const LIMIT_PAGE_SIZE = 10;


    /**
     * @param int $id
     * @return object|null
     */
    public function one(int $id)
    {
        return $this->findOneById($id);
    }


    /**
     * @param array $filters
     * @return mixed
     */
    public function search(array $filters = [])
    {

        $page       = $filters['page']      ? (int)$filters['page']      : 0;
        $page_size  = $filters['page_size'] ? (int)$filters['page_size'] : self::LIMIT_PAGE_SIZE;

        $qb = $this->createQueryBuilder('bike');

        foreach ($filters as $param => $value) {
            $queryFunction = 'SearchQueryPart'.ucfirst($param);
           if (method_exists($this, $queryFunction)) {
               $this->$queryFunction($qb, $value);
           }
        }
        $qb->setFirstResult($page)
           ->setMaxResults($page_size);

        $paginator = new Paginator($qb, $fetchJoinCollection = true);

        $result = [];
        foreach ($paginator as $post) {
                $result[] = $post;
        }

        return [
            'data'     => $result,
            'page'     => $page,
            'pageSize' => $page_size
        ];

    }


    /**
     * @param QueryBuilder $qb
     * @param string $color
     * @return QueryBuilder
     */
    public function SearchQueryPartColor(QueryBuilder $qb, string $color) {

        $qb->andWhere('bike.color = :bikeColor');
        $qb->setParameter('bikeColor', $color);

        return $qb;
    }


    /**
     * @param QueryBuilder $qb
     * @param string $licenseNumber
     * @return QueryBuilder
     */
    public function SearchQueryPartLicenseNumber(QueryBuilder $qb, string $licenseNumber) {

        $qb->andWhere('bike.licenseNumber = :bikeLicenseNumber');
        $qb->setParameter('bikeLicenseNumber', $licenseNumber);

        return $qb;
    }


}