<?php
/**
 * Created by PhpStorm.
 * User: sepideh
 * Date: 2020-02-28
 * Time: 21:02
 */

namespace App\Entity;

/**
 * @Entity(repositoryClass="App\Repository\PersonRepository")
 * @Table(name="person")
 * @InheritanceType("JOINED")
 * @DiscriminatorColumn(name="role", type="string")
 * @DiscriminatorMap({"person" = "Person", "police" = "Police"})
 */
class Person {

    /** @Id @Column(type="integer") @GeneratedValue */
    protected $id;

    /** @Name @Column(type="string", nullable=true) */
    protected $name;

    /** @Name @Column(type="string", unique=true)  */
    protected $nationalCode;


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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getNationalCode()
    {
        return $this->nationalCode;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @param mixed $nationalCode
     */
    public function setNationalCode(string $nationalCode): void
    {
        $this->nationalCode = $nationalCode;
    }
}