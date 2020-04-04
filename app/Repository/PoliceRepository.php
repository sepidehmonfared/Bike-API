<?php
/**
 * Created by PhpStorm.
 * User: sepideh
 * Date: 2020-03-24
 * Time: 18:12
 */

namespace App\Repository;


use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Tools\Pagination\Paginator;

class PoliceRepository extends EntityRepository
{

    /**
     * list page's size
     */
    const LIMIT_PAGE_SIZE = 10;
    const DEFAULT_PAGE = 0;


    /**
     * @param array $filters
     * @return mixed
     */
    public function search(array $filters = [])
    {
        $page       = isset($filters['page'])      ? (int)$filters['page']      : self::DEFAULT_PAGE;
        $page_size  = isset($filters['page_size']) ? (int)$filters['page_size'] : self::LIMIT_PAGE_SIZE;

        $qb = $this->createQueryBuilder('police');

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
            'data'      => $result,
            'page'      => $page,
            'page_size' => $page_size
        ];

    }


    /**
     * @param QueryBuilder $qb
     * @param int $policed_id
     *
     * @return QueryBuilder
     */
    public function SearchQueryPartId(QueryBuilder $qb, int $policed_id) {

        $qb->andWhere('police.id = :policeId');
        $qb->setParameter('policeId', $policed_id);

        return $qb;
    }

    /**
     * @param QueryBuilder $qb
     * @param string $national_code
     * @return QueryBuilder
     */
    public function SearchQueryPartNationalCode(QueryBuilder $qb, string $national_code) {

        $qb->andWhere('police.nationalCode = :policeNationalCode');
        $qb->setParameter('policeNationalCode', $national_code);

        return $qb;
    }

    /**
     * @param QueryBuilder $qb
     * @param string $status
     * @return QueryBuilder
     */
    public function SearchQueryPartStatus(QueryBuilder $qb, string $status) {

        $qb->andWhere('police.status = :policeStatus');
        $qb->setParameter('policeStatus', $status);

        return $qb;
    }


    /**
     * @param int $except_id
     * @return mixed
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getFreePolice(int $except_id = null) {

        $qb = $this->createQueryBuilder('police');
        $qb->where('police.status = :status');
        $params = ['status' => 'free'];

        if (!is_null($except_id)) {
            $qb->andWhere('police.id != :identifier');
            $params['identifier'] =  $except_id;
        }


        $qb->setParameters($params)
            ->setMaxResults(1);

        return $qb->getQuery()->getOneOrNullResult();
    }


}