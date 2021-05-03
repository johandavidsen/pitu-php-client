<?php
/**
 * @since v0.1.0
 */

namespace CodeBureau\Pitu\Common;

use SimpleXMLElement;

/**
 * Class ClientHeader
 * @package CodeBureau\Pitu\Common
 */
class ClientHeader implements ToXMLInterface
{
    private $instance;
    private $memberClass;
    private $memberCode;
    private $subsystemCode;

    /**
     * @param mixed $instance
     */
    public function setInstance($instance)
    {
        $this->instance = $instance;
        return $this;
    }

    /**
     * @param mixed $memberClass
     */
    public function setMemberClass($memberClass)
    {
        $this->memberClass = $memberClass;
        return $this;
    }

    /**
     * @param mixed $memberCode
     */
    public function setMemberCode($memberCode)
    {
        $this->memberCode = $memberCode;
        return $this;
    }

    /**
     * @param mixed $subsystemCode
     */
    public function setSubsystemCode($subsystemCode)
    {
        $this->subsystemCode = $subsystemCode;
        return $this;
    }

    /**
     * @return SimpleXMLElement
     */
    public function toXML()
    {
        $xml = new SimpleXMLElement('<xro:client></xro:client>', LIBXML_NOERROR, false, 'xro', true);
        $xml->addAttribute('xmlns:iden:objectType', '?');
        $xml->addChild('xmlns:iden:xRoadInstance', $this->instance);
        $xml->addChild('xmlns:iden:memberClass', $this->memberClass);
        $xml->addChild('xmlns:iden:memberCode', $this->memberCode);
        $xml->addChild('xmlns:iden:subsystemCode', $this->subsystemCode);
        return $xml;
    }

    /**
     *
     */
    public function toXMLString()
    {
        $domXml = dom_import_simplexml($this->toXML());
        return $domXml->ownerDocument->saveXML($domXml->ownerDocument->documentElement);
    }
}
