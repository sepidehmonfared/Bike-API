<?php
/**
 * Created by PhpStorm.
 * User: sepideh
 * Date: 2020-03-04
 * Time: 16:03
 */


namespace App\Entity;


/**
 * @Entity(repositoryClass="App\Repository\ReportRepository")
 * @Table(name="report")
 */
class Report
{

    /** @Id @Column(type="integer") @GeneratedValue */
    protected $id;

    /**
     * Many bikes have one user. This is the owning side.
     * @OneToOne(targetEntity="Vehicle")
     * @JoinColumn(name="viechel_id", referencedColumnName="id")
     */
    private $vehicle;


    /**
     * Many bikes have one user. This is the owning side.
     * @OneToOne(targetEntity="Police")
     * @JoinColumn(name="police_id", referencedColumnName="id")
     */
    private $police;


    /**
     * Many bikes have one user. This is the owning side.
     * @OneToOne(targetEntity="Person")
     * @JoinColumn(name="person_id", referencedColumnName="id")
     */
    private $owner;


    /** @Column(type="string", columnDefinition="ENUM('open', 'close')") */
    private $status;


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getVehicle()
    {
        return $this->vehicle;
    }

    /**
     * @return mixed
     */
    public function getPolice()
    {
        return $this->police;
    }

    /**
     * @return mixed
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $vehicle
     */
    public function setVehicle($vehicle): void
    {
        $this->vehicle = $vehicle;
    }

    /**
     * @param mixed $police
     */
    public function setPolice($police): void
    {
        $this->police = $police;

        if (!is_null($police)) {
            $police->setStatus('busy');
        }
    }

    /**
     * @param mixed $owner
     */
    public function setOwner($owner): void
    {
        $this->owner = $owner;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status): void
    {
        $this->status = $status;
    }




}