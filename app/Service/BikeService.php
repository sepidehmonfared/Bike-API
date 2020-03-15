<?php
/**
 * Created by PhpStorm.
 * User: sepideh
 * Date: 2020-03-06
 * Time: 16:49
 */

namespace App\Service;

use App\Entity\Bike;


/**
 * Class BikeService
 * @package App\Service
 *
 * @author Sepideh Monfared <monfared.sepideh@gmail.com>
 */
class BikeService extends _Service {

    private $repository;

    public function init()
    {
        $this->repository = $this->entityManager
                                 ->getRepository(Bike::class);
    }


    /**
     * @param int $id
     * @return mixed
     */
    public function one(int $id) {

        //TODO check is_null bike and generate 404 statusCode
        return $this->repository->one($id);
    }


    /**
     * @param array $filters
     * @return mixed
     */
    public function Search(array $filters = [])
    {
        $data = $this->repository->search($filters);

        return $data;
    }
}