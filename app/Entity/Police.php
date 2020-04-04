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

    /**
     * Police constructor.
     */
    public function __construct()
    {
        $this->setStatus('free');
    }


    /** @Column(type="string", columnDefinition="ENUM('busy', 'free')") */
    private $status;

    /**
     * One product has many features. This is the inverse side.
     * @OneToMany(targetEntity="Report", mappedBy="police")
     */
    private $reports;


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

    /**
     * @return mixed
     */
    public function getReports()
    {
        return $this->reports;
    }



}