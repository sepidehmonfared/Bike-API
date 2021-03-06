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
    private $repository;

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


    /**
     * @param array $filters
     *
     * @dataProvider searchDataProvider
     */
    public function testSearch(array $filters = [])
    {
        $result = $this->repository->Search($filters);

        $this->assertIsArray($result);
        $this->assertArrayHasKey('data', $result);
        $this->assertArrayHasKey('page', $result);
        $this->assertArrayHasKey('page_size', $result);

        $bikes = $result['data'];
        $this->assertIsArray($bikes);
        $this->assertContainsOnlyInstancesOf(
            'App\Entity\Bike',
            $bikes
        );


        if (isset($filters['page_size'])) {

            $this->assertLessThanOrEqual($filters['page_size'], sizeof($bikes));
            $this->assertEquals($filters['page_size'], $result['page_size']);
            unset($filters['page_size']);
        }

        foreach ($bikes as $key => $bike) {
            foreach ($filters as $property => $value) {

                $func_name  = 'get'.ucfirst($property);
                $real_value = $bike->$func_name();

                $this->assertEquals(
                    $value,
                    $real_value,
                    "actual ".$property." is not equals to expected"
                );
            }
        }
    }

    public static function searchDataProvider() {

        return [
            [['id' => 2]],
            [['color' => 'red','page_size' => 1]],
            [['licenseNumber' => '124-674-78965-3443', 'color' => 'red']]
        ];
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        $this->entityManager->close();
        $this->entityManager = null;
    }
}
