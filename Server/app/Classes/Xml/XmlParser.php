<?php

namespace App\Classes\Xml;


use App\Classes\Xml\Exceptions\FileNotReadableException;

class XmlParser
{
    protected ?string $xml = null;
    protected ?\SimpleXMLElement $xmlElement = null;
    public function __construct(string $xmlString = null)
    {
        if ($xmlString)
            $this->setXmlString($xmlString);
    }

    /**
     * @param string $filepath
     * @return XmlParser
     * @throws FileNotReadableException
     */
    public static function fromFile(string $filepath)
    {
        if (! is_readable($filepath))
            throw new FileNotReadableException();

        return new self(file_get_contents($filepath));
    }

    public static function getInstance(string $xml)
    {
        return new self($xml);
    }

    public function setXmlString(string $xml)
    {
        $this->xml = $xml;
        $this->xmlElement = new \SimpleXMLElement($xml,null, false, 'w', true);

        return $this;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $this->xmlElement->body->addAttribute('name', 'behzad');
        header("Content-type: text/xml");

        die($this->xmlElement->asXML());
        dd((array) $this->xmlElement->children('w', true));
        return (array) $this->xmlElement;
    }
}
