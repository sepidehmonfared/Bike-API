<?php
/**
 * Created by PhpStorm.
 * User: sepideh
 * Date: 2020-03-27
 * Time: 17:04
 */

namespace Tests\Service;


use App\Entity\Bike;
use App\Entity\Police;
use App\Entity\Report;
use App\Repository\ReportRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
use Doctrine\Persistence\ObjectManager;
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


    /**
     * @param string $national_code
     * @param string $status
     *
     * @dataProvider createDataProvider
     */
    public function testCreate(string $national_code, string $status = 'free') {




    }

    public static function createDataProvider() {

        return [
            ['national_code' => '0013762087'],

        ];
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        $this->entityManager->close();
        $this->entityManager = null;
    }

}