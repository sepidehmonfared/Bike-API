<?php
/**
 * Created by PhpStorm.
 * User: sepideh
 * Date: 2020-03-27
 * Time: 17:04
 */

namespace Tests\Service;


use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Dotenv\Dotenv;

class PoliceServiceTest extends TestCase
{

    private $entityManager;
    private $service;

    public static function setUpBeforeClass() :void {

        define("PATH_ROOT", __DIR__ . '/../../');
        require_once PATH_ROOT . 'vendor/autoload.php';

        $dotenv = new Dotenv();
        $dotenv->loadEnv(PATH_ROOT.'.env');
    }

    public function setUp() : void
    {

        $paths    = array(PATH_ROOT."app/Entity");
        $dbParams = array(
            'driver'   => $_ENV['DB_DRIVER'],
            'user'     => $_ENV['DB_USER'],
            'password' => $_ENV['DB_PASS'],
            'dbname'   => $_ENV['DB_NAME'],
        );
        $config = Setup::createAnnotationMetadataConfiguration($paths);

        $this->entityManager = EntityManager::create($dbParams, $config);
        $this->service = new \App\Service\PoliceService($this->entityManager);

    }

    public function testCreate() {

    }

    protected function tearDown(): void
    {
        parent::tearDown();

        $this->entityManager->close();
        $this->entityManager = null;
    }

}