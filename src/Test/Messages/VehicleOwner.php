<?php

/**
 * @since v0.1.0
 */

namespace CodeBureau\Pitu\Test\Messages;

use CodeBureau\Pitu\Common\ToXMLInterface;
use SimpleXMLElement;
use Exception;

/**
 * Class VehicleOwner
 * @package CodeBureau\Pitu\Test\Messages
 */
class VehicleOwner implements ToXMLInterface
{
    private $personCode;
    private $firstName;
    private $lastName;
    private $dateOfBirth;

    /**
     * @param mixed $firstName
     */
    public function setFirstName($firstName): VehicleOwner
    {
        $this->firstName = $firstName;
        return $this;
    }

    /**
     * @param mixed $lastName
     */
    public function setLastName($lastName): VehicleOwner
    {
        $this->lastName = $lastName;
        return $this;
    }

    /**
     * @param mixed $dateOfBirth
     */
    public function setDateOfBirth($dateOfBirth): VehicleOwner
    {
        $this->dateOfBirth = $dateOfBirth;
        return $this;
    }

    /**
     * @param mixed $personCode
     */
    public function setPersonCode($personCode): VehicleOwner
    {
        $this->personCode = $personCode;
        return $this;
    }

    /**
     * @return SimpleXMLElement
     */
    public function toXML(): SimpleXMLElement
    {
        $xml = new SimpleXMLElement(
            '<v1:getVehicleOwnerByPersonalcode></v1:getVehicleOwnerByPersonalcode>',
            LIBXML_NOERROR,
            false,
            'v1',
            true
        );
        $xml->addChild('personalcode', $this->personCode);
        return $xml;
    }

    /**
     * @throws Exception
     */
    public function toXMLString()
    {
        $domXml = dom_import_simplexml($this->toXML());
        return $domXml->ownerDocument->saveXML($domXml->ownerDocument->documentElement);
    }
}
