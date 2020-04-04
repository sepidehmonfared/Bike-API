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


    public function init()
    {
        $this->repository = $this->em->getRepository(Bike::class);
    }


    /**
     * @param array $data
     * @return mixed
     */
    public function oneBy(array $data) {

       $bike = parent::oneBy($data);
       //TODO customization data
       return $bike;
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


    /**
     * @param string $license_number
     * @param string $color
     * @return Bike
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function create(string $license_number, string $color)
    {
        $bike_exist = $this->oneBy([
            'licenseNumber' => $license_number
        ]);

        if($bike_exist) {
            return $this->notify('Bike exist!', 409);
        }

        $bike = new Bike();
        $bike->setLicenseNumber($license_number);
        $bike->setColor($color);

        $this->em->persist($bike);
        $this->em->flush();

        return $bike;
    }



}