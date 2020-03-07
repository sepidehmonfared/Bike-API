
<?php

/**
 * Created by PhpStorm.
 * User: sepideh
 * Date: 2020-02-28
 */


use Doctrine\ORM\Tools\Console\ConsoleRunner;

define("PATH_ROOT", __DIR__ . '/../');
// replace with file to your own project bootstrap
require_once 'bootstrap.php';

// replace with mechanism to retrieve EntityManager in your app
//$entityManager = GetEntityManager();

return ConsoleRunner::createHelperSet($em);