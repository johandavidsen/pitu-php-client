<?php
/**
 * @since v0.1.0
 */

namespace CodeBureau\Pitu;

use CodeBureau\Pitu\Test\TestService;
use PHPUnit\Framework\TestCase;

/**
 * Class TestServiceTest
 *
 * @package CodeBureau\Pitu
 */
class TestServiceTest extends TestCase
{

    /**
     * @covers \CodeBureau\Pitu\Test\TestService::getVehicleOwnerByCPR
     * @test
     */
    public function getVehicleOwnerByCPR()
    {
        $service = new TestService();
        $owner = $service->getVehicleOwnerByCPR("11111");
        $this->assertInstanceOf("CodeBureau\Pitu\Test\Messages\VehicleOwner", $owner);
    }
}
