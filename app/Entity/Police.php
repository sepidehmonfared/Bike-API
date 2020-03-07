<?php
/**
 * Created by PhpStorm.
 * User: sepideh
 * Date: 2020-02-28
 * Time: 21:02
 */

namespace App\Entity;


/**
 * @Entity
 * @Table(name="police")
 */
class Police extends Person {

    private $personalCode;

    /**
     * @return mixed
     */
    public function getPersonalCode()
    {
        return $this->personalCode;
    }

    /**
     * @param mixed $personalCode
     */
    public function setPersonalCode($personalCode)
    {
        $this->personalCode = $personalCode;
    }


}