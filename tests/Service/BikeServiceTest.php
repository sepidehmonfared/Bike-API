<?php
/**
 * Created by PhpStorm.
 * User: sepideh
 * Date: 2020-03-24
 * Time: 13:46
 */

namespace Tests\Service;


use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Dotenv\Dotenv;

class BikeServiceTest extends TestCase
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
        $this->service = new \App\Service\BikeService($this->entityManager);

    }


    /**
     * @test
     * @param $data
     *
     * @dataProvider oneByDataProvider
     */
    public function testOneBy(array $data) {

        $bike = $this->service->oneBy($data);

        $this->assertInstanceOf('App\Entity\Bike', $bike);

        foreach ($data as $property => $value) {

            $func_name = 'get'.ucfirst($property);
            $real_value = $bike->$func_name();

            $this->assertEquals($value, $real_value);
        }

    }

    /**
     * @test
     * @param array $filters
     *
     * @dataProvider searchDataProvider
     */
    public function testSearch(array $filters ) {

        $result = $this->service->search($filters);

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

    public function testCreateException() {

        $exist_bike = $this->service->oneBy([]);

        $this->expectException("\Exception");
        $this->expectExceptionCode(409);
        $this->expectExceptionMessage("Bike exist!");

        $this->service->create($exist_bike->getLicenseNumber(), 'blue');
    }

    public function testCreate() {

        $license_number = '111-111-111-111';
        $color = 'red';

        $this->entityManager->getConnection()->beginTransaction();
        $bike = $this->service->create($license_number, $color);

        $this->assertInstanceOf('App\Entity\Bike', $bike);
        $this->assertEquals($color, $bike->getColor());
        $this->assertEquals($license_number, $bike->getLicenseNumber());

        $this->entityManager->getConnection()->rollback();
    }



    public static function oneByDataProvider()
    {
        return [
            [['id' => 1]],
            [['color' => 'blue']],
            [['licenseNumber' => '124-674-78965-3443', 'color' => 'red']]
        ];
    }

    public static function searchDataProvider() {

        return [
            [['id' => 2]],
            [['color' => 'red','page_size' => 1]],
            [['licenseNumber' => '124-674-78965-3443', 'color' => 'red']]
        ];
    }
}