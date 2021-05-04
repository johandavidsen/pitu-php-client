<?php

/**
 * @since v0.1.0
 */

namespace CodeBureau\Pitu\Test;

use CodeBureau\Pitu\Common\ClientHeader;
use CodeBureau\Pitu\Common\Courier;
use CodeBureau\Pitu\Common\Envelope;
use CodeBureau\Pitu\Common\ServiceHeader;
use CodeBureau\Pitu\Test\Messages\VehicleOwner;

/**
 * Class TestService
 * @package CodeBureau\Pitu\Test
 */
class TestService
{
    /**
     * This method calls the test service VehicleService and fetches the corresponding owner.
     *
     * @param $cpr
     * @return VehicleOwner
     */
    public function getVehicleOwnerByCPR($cpr): VehicleOwner
    {
        // Create envelope
        $env = new Envelope();

        $env->setUserId('');
        $env->setId('?');
        $env->setProtocolVersion('4.0');

        // Add Client Header
        $clientHeader = new ClientHeader();
        $clientHeader
            ->setInstance('PITU-TEST')
            ->setMemberClass('GOV')
            ->setMemberCode('Org1')
            ->setSubsystemCode('v1');
        $env->setClientHeader($clientHeader);

        // Add Service Header
        $serviceHeader = new ServiceHeader();
        $serviceHeader
            ->setInstance('PITU-TEST')
            ->setMemberClass('GOV')
            ->setMemberCode('Org1')
            ->setSubsystemCode('vehicleRegister')
            ->setServiceCode('getVehicleOwnerByPersonalcode')
            ->setServiceVersion('v1');
        $env->setServiceHeader($serviceHeader);

        // Add Message
        $vehicleOwner = new VehicleOwner();
        $vehicleOwner
            ->setPersonCode($cpr);
        $env->setBody($vehicleOwner);

        $message = $env->toXML();

        // Send message
        $courier = new Courier();
        $response = $courier->sendMessage($message);

        $person = new VehicleOwner();
        $person
            ->setPersonCode($cpr)
            ->setFirstName($response['value'][1]['value'][0]['value'][0]['value'])
            ->setLastName($response['value'][1]['value'][0]['value'][1]['value'])
            ->setDateOfBirth($response['value'][1]['value'][0]['value'][2]['value']);

        // Return answer
        return $person;
    }
}
