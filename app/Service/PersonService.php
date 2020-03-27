<?php
/**
 * Created by PhpStorm.
 * User: sepideh
 * Date: 2020-03-24
 * Time: 12:12
 */

namespace App\Service;


use App\Entity\Person;

class PersonService extends _Service
{
    /**
     * @var BikeRepository
     */
    private $repository;


    public function init()
    {
        $this->repository = $this->em->getRepository(Bike::class);
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
     * @param string $national_code
     * @return Person
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function create(string $national_code)
    {
        $person = new Person();
        $person->setName('u_'.$national_code);
        $person->setNationalCode($national_code);

        $this->em->persist($person);
        $this->em->flush();

        return $person;
    }


}