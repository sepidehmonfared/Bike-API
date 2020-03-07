<?php

namespace App\Service;

use Doctrine\ORM\EntityManager;


/**
 * Class _Service
 * @package App\Service
 *
 * @author Sepideh Monfared <monfared.sepideh@gmail.com>
 */
Abstract class _Service
{

    protected $entityManager;

    public function __construct(EntityManager $em)
    {
        $this->entityManager = $em;
        $this->init();
    }

    abstract function init();
}