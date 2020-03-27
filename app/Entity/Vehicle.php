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
 * @Table(name="viechel")
 * @InheritanceType("JOINED")
 * @DiscriminatorColumn(name="type", type="string")
 * @DiscriminatorMap({"bike" = "Bike"})
 */
abstract class Vehicle
{

    /** @Id @Column(type="integer") @GeneratedValue */
    protected $id;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }
}
