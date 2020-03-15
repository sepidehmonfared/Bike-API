<?php
/**
 * Created by PhpStorm.
 * User: sepideh
 * Date: 2020-02-28
 * Time: 14:30
 */

namespace App\Api;

use App\Service\_Service;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

/**
 * Class ApiController
 * @package App\Api
 *
 * @author Sepideh Monfared <monfared.sepideh@gmail.com>
 */
Abstract class ApiController {

    protected $entityManager;
    protected $service;
    protected $serializer;

    /**
     * ApiController constructor.
     * @param EntityManager $em
     * @param _Service $service
     *
     * @author Sepideh Monfared <monfared.sepideh@gmail.com>
     */
    public function __construct(EntityManager $em, _Service $service) {

            $this->entityManager = $em;
            $this->service = $service;

            $encoders         = [new JsonEncoder()];
            $normalizers      = [new ObjectNormalizer()];
            $this->serializer =  new Serializer($normalizers, $encoders);
    }


    /**
     * @param $data
     * @return string
     *
     * @author Sepideh Monfared <monfared.sepideh@gmail.com>
     */
    public function serialize( $data) {

        return $this->serializer->serialize($data,'json');

    }



}