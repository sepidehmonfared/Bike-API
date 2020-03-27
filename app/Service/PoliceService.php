<?php
/**
 * Created by PhpStorm.
 * User: sepideh
 * Date: 2020-03-24
 * Time: 18:59
 */

namespace App\Service;


use App\Entity\Police;
use App\Entity\Report;
use App\Handlers\CustomExceptionHandler;

class PoliceService extends _Service
{

    /**
     * @return mixed|void
     */
    public function init()
    {
        $this->repository = $this->em->getRepository(Police::class);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function oneBy(array $data)
    {
        return parent::oneBy($data); // TODO: Change the autogenerated stub
    }


    /**
     * @param string $national_code
     * @param string $status
     * @return Police|false|string
     * @throws \Doctrine\DBAL\ConnectionException
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function create(string $national_code, string $status = 'free') {

        $this->em->getConnection()->beginTransaction();
        $reportRepository = $this->em->getRepository(Report::class);

        try {
            $police = new Police();
            $police->setNationalCode($national_code);
            $police->setName('u_'.$national_code);
            $police->setStatus($status);

            $report = $reportRepository->findOneBy(['police' => null]);
            if ($report) {
                $report->setPolice($police);
                $this->em->persist($report);
            }

            $this->em->persist($police);
            $this->em->flush();
            $this->em->getConnection()->commit();

        } catch (Exception $e) {
            $this->em->getConnection()->rollBack();
            return $this->notify('error occurred', 409);
        }

        return $police;
    }


    /**
     * @param int $id
     * @return false|string
     * @throws \Doctrine\DBAL\ConnectionException
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function delete(int $id) {

        $police = $this->oneBy(['id' => $id]);
        if (!$police) {
            return $this->notify('Police not found!', 404);
        }

        $reportRepository = $this->em->getRepository(Report::class);
        $this->em->getConnection()->beginTransaction();

        try {
            $report = $reportRepository->findOneBy(['police' => $police->getId()]);
            if ($report) {
                $free_police = $this->repository->getFreePolice($id);
                $report->setPolice($free_police);
                $this->em->persist($report);
            }

            $this->em->remove($police);
            $this->em->flush();
            
            $this->em->getConnection()->commit();

        } catch (Exception $e) {
            $this->em->getConnection()->rollBack();
            return $this->notify('error occurred', 409);
        }

    }


    /**
     * @param array $filters
     * @return mixed
     */
    public function search(array $filters = [])
    {
        $data = parent::search($filters);
        //TODO customization data
        return $data;
    }

}