<?php
/**
 * @since v0.1.0
 */

namespace CodeBureau\Pitu\Unit;

use CodeBureau\Pitu\Test\Messages\VehicleOwner;
use Exception;
use PHPUnit\Framework\TestCase;

/**
 * Class VehicleOwnerTest
 *
 * @package CodeBureau\Pitu\Unit
 */
class VehicleOwnerTest extends TestCase
{
    /**
     * @covers \CodeBureau\Pitu\Test\Messages\VehicleOwner::toXML
     * @test
     * @throws Exception
     */
    public function xmlConverter()
    {
        $vehicleOwner = new VehicleOwner();
        $vehicleOwner
            ->setPersonCode('11111');
        $this->assertXmlStringEqualsXmlString(
            '<v1:getVehicleOwnerByPersonalcode><personalcode>11111</personalcode></v1:getVehicleOwnerByPersonalcode>',
            $vehicleOwner->toXMLString()
        );
    }
}
