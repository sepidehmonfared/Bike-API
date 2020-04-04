<?php
/**
 * Created by PhpStorm.
 * User: sepideh
 * Date: 2020-03-27
 * Time: 10:54
 */

namespace App\Repository;


use Doctrine\ORM\EntityRepository;

/**
 * Class ReportRepository
 * @package App\Repository
 */
class ReportRepository extends EntityRepository
{

    /**
     * @param int|null $except_id
     * @return mixed
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getOpenReport(int $except_id = null) {

        $qb = $this->createQueryBuilder('report');
        $qb->where('report.status = :status');
        $params = ['status' => 'open'];

        if (!is_null($except_id)) {
            $qb->andWhere('report.id != :identifier');
            $params['identifier'] =  $except_id;
        }


        $qb->setParameters($params)
            ->setMaxResults(1);

        return $qb->getQuery()->getOneOrNullResult();
    }

}