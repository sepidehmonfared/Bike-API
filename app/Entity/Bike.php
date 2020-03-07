<?php
/**
 * Created by PhpStorm.
 * User: sepideh
 * Date: 2020-02-28
 */

namespace App\Entity;


/**
 * @Entity
 * @Table(name="bike")
 */
class Bike {

    /** @Id @Column(type="integer") @GeneratedValue */
    private $id;

    /** @LicenseNumber @Column(type="string")*/
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
    public function getId() {
        return $this->id;
    }

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