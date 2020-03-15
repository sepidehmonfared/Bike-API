<?php
/**
 * Created by PhpStorm.
 * User: sepideh
 * Date: 2020-03-15
 * Time: 16:52
 */
namespace Tests\Service;

use App\Entity\Bike;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Dotenv\Dotenv;

class BikeRepositoryTest extends TestCase
{

    private $entityManager;

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
        $this->repository = $this->entityManager->getRepository(Bike::class);

    }

    public function testOne()
    {
        $repo = $this->entityManager->getRepository(Bike::class);
        $bike = $repo->one(1);
        $this->assertInstanceOf('App\Entity\Bike', $bike);

    }
}
