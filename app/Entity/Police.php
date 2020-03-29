<?php
/**
 * Created by PhpStorm.
 * User: sepideh
 * Date: 2020-02-28
 * Time: 21:02
 */

namespace App\Entity;


/**
 * @Entity(repositoryClass="App\Repository\PoliceRepository")
 * @Table(name="police")
 * @HasLifecycleCallbacks()
 */
class Police extends Person
{

    public function __construct()
    {
        $this->setStatus('free');
    }

    /** @Column(type="string", columnDefinition="ENUM('busy', 'free')") */
        private $status;


    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status): void
    {
        $this->status = $status;
    }



}