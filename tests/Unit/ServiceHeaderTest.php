<?php
/**
 * @since v0.1.0
 */

namespace CodeBureau\Pitu\Unit;

use CodeBureau\Pitu\Common\ServiceHeader;
use Exception;
use PHPUnit\Framework\TestCase;

/**
 * Class ServiceHeaderTest
 * @package CodeBureau\Pitu\Unit
 */
class ServiceHeaderTest extends TestCase
{
    /**
     * @covers \CodeBureau\Pitu\Test\Messages\VehicleOwner::toXML
     * @test
     * @throws Exception
     */
    public function test_xml_converter()
    {
        $serviceHeader = new ServiceHeader();
        $serviceHeader
            ->setInstance('PITU-TEST')
            ->setMemberClass('GOV')
            ->setMemberCode('Org1')
            ->setServiceCode('vehicleRegister')
            ->setServiceVersion('getVehicleOwnerByPersonalcode')
            ->setSubsystemCode('v1');
        $this->assertStringContainsString(
            '<xro:service iden:objectType="SERVICE">',
            $serviceHeader->toXMLString()
        );
    }
}
