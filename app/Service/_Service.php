<?php

namespace App\Service;

use Doctrine\ORM\EntityManager;


/**
 * Class _Service
 * @package App\Service
 *
 * @author Sepideh Monfared <monfared.sepideh@gmail.com>
 */
Abstract class _Service
{

    protected $em;
    protected $repository;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
        $this->init();
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function oneBy(array $data)
    {
        return $this->repository->findOneBy($data);
    }


    /**
     * @param array $filters
     * @return mixed
     */
    public function search(array $filters = [])
    {
        $data = $this->repository->search($filters);

        return $data;
    }


    public function notify(string $message, int $code = 200, array $extraData = []) {

        return ['detail' => $message, 'status' => $code, 'extraValues' => $extraData];
    }



    /**
     * @return mixed
     */
    abstract function init();
}