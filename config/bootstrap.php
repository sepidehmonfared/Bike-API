<?php

/**
 * Created by PhpStorm.
 * User: sepideh
 * Date: 2020-02-28
 */

require PATH_ROOT . 'vendor/autoload.php';


$dotenv = new Symfony\Component\Dotenv\Dotenv();
$dotenv->loadEnv(PATH_ROOT.'.env');



$paths = array(PATH_ROOT."app/Entity");
$isDevMode = false;

// the connection configuration
$dbParams = array(
    'driver'   => $_ENV['DB_DRIVER'],
    'user'     => $_ENV['DB_USER'],
    'password' => $_ENV['DB_PASS'],
    'dbname'   => $_ENV['DB_NAME'],
);

$config = \Doctrine\ORM\Tools\Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);
$config->setProxyDir(PATH_ROOT.'public/cache');

$em     = \Doctrine\ORM\EntityManager::create($dbParams, $config);

$request  = \App\Handlers\CustomRequest::createFromGlobals();
$response = \Symfony\Component\HttpFoundation\Response::create();

$app = new \App\Core();
$app->setEntityManager($em);
require PATH_ROOT . 'app/Api/routes.php';

$response = $app->handle($request);
$response->send();

