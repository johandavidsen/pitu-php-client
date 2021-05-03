<?php
/**
 * @since v0.1.0
 */

namespace CodeBureau\Pitu\Unit;

use CodeBureau\Pitu\Common\ClientHeader;
use PHPUnit\Framework\TestCase;

/**
 * Class ClientHeaderTest
 * @package CodeBureau\Pitu\Unit
 */
class ClientHeaderTest extends TestCase
{

    /**
     * @covers \CodeBureau\Pitu\Common\ClientHeader::toXMLString
     * @test
     */
    public function test_xml_converter()
    {
        $clientHeader = new ClientHeader();
        $clientHeader
            ->setInstance('PITU-TEST')
            ->setMemberClass('GOV')
            ->setMemberCode('Org1')
            ->setSubsystemCode('v1');
        $this->assertStringContainsString(
            '<xro:client iden:objectType="?">',
            $clientHeader->toXMLString()
        );
    }
}
