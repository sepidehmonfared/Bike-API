<?php
/**
 * Created by PhpStorm.
 * User: sepideh
 * Date: 2020-02-28
 */

namespace App\Entity;


/**
 * @Entity(repositoryClass="App\Repository\BikeRepository")
 * @Table(name="bike")
 */
class Bike extends Vehicle
{

    /** @LicenseNumber @Column(type="string", unique=true)*/
    private $licenseNumber;

    /** @Color @Column(type="string")*/
    private $color;

    /**
     * Many bikes have one user. This is the owning side.
     * @ManyToOne(targetEntity="Person")
     * @JoinColumn(name="person_id", referencedColumnName="id")
     */
    private $owner;

    /**
     * @return mixed
     */
    public function getLicenseNumber()
    {
        return $this->licenseNumber;
    }

    /**
     * @param mixed $licenseNumber
     */
    public function setLicenseNumber($licenseNumber)
    {
        $this->licenseNumber = $licenseNumber;
    }

    /**
     * @return mixed
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * @param mixed $color
     */
    public function setColor($color)
    {
        $this->color = $color;
    }

    /**
     * @return mixed
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * @param mixed $owner
     */
    public function setOwner($owner)
    {
        $this->owner = $owner;
    }
}