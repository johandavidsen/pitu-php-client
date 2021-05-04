<?php

/**
 * @since v0.1.0
 */

namespace CodeBureau\Pitu\Common;

use SimpleXMLElement;

/**
 * Class Envelope
 * @package CodeBureau\Pitu\Common
 */
class Envelope
{
    const TAG = "<soapenv:Envelope></soapenv:Envelope>";
    const NS = "soapenv";
    const SOAPENV = "http://schemas.xmlsoap.org/soap/envelope/";
    const XRO = "http://x-road.eu/xsd/xroad.xsd";
    const IDEN = "http://x-road.eu/xsd/identifiers";
    // TODO: This should possibly be dynamic
    const V1 = "http://x-road.eu/xsd/connector/getVehicleOwnerByPersonalcode/v1";

    private $userId;
    private $id;
    private $protocolVersion;
    private $clientHeader;
    private $serviceHeader;
    private $body;

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @param mixed $userId
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
        return $this;
    }

    /**
     * @param mixed $protocolVersion
     */
    public function setProtocolVersion($protocolVersion)
    {
        $this->protocolVersion = $protocolVersion;
        return $this;
    }

    /**
     * @param mixed $clientHeader
     */
    public function setClientHeader(ClientHeader $clientHeader)
    {
        $this->clientHeader = $clientHeader;
        return $this;
    }

    /**
     * @param mixed $serviceHeader
     */
    public function setServiceHeader(ServiceHeader $serviceHeader)
    {
        $this->serviceHeader = $serviceHeader;
        return $this;
    }

    /**
     * @param ToXMLInterface $instance
     * @return $this
     */
    public function setBody(ToXMLInterface $instance)
    {
        $this->body = $instance;
        return $this;
    }

    /**
     * @return bool|string
     */
    public function toXML()
    {
        $env = new SimpleXMLElement(Envelope::TAG, LIBXML_NOERROR, false, Envelope::NS, true);
        $env->addAttribute('xmlns:xmlns:soapenv', Envelope::SOAPENV);
        $env->addAttribute('xmlns:xmlns:xro', Envelope::XRO);
        $env->addAttribute('xmlns:xmlns:iden', Envelope::IDEN);
        $env->addAttribute('xmlns:xmlns:v1', Envelope::V1);

        // Header
        $header = $env->addChild('xmlns:soapenv:Header');
        // Add UserId
        $header->addChild('xmlns:xro:userId', $this->userId);
        // Add ID
        $header->addChild('xmlns:xro:id', $this->id);
        // Add ProtocolVersion
        $header->addChild('xmlns:xro:protocolVersion', $this->protocolVersion);

        $this->xmlAppend($header, $this->clientHeader->toXML());

        // Client
        $this->xmlAppend($header, $this->serviceHeader->toXML());

        // Body
        $bodyElement = $env->addChild('xmlns:soapenv:Body');
        $this->xmlAppend($bodyElement, $this->body->toXML());

        return $env->asXML();
    }

    /**
     * @param SimpleXMLElement $to
     * @param SimpleXMLElement $from
     */
    private function xmlAppend(SimpleXMLElement $to, SimpleXMLElement $from)
    {
        $toDom = dom_import_simplexml($to);
        $fromDom = dom_import_simplexml($from);
        $toDom->appendChild($toDom->ownerDocument->importNode($fromDom, true));
    }
}
