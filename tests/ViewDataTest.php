<?php namespace OrnoTest;

use PHPUnit_Framework_TestCase;
use Orno\Mvc\View\JsonRenderer;
use Orno\Mvc\View\XmlRenderer;
use Orno\Mvc\View\Renderer;
use SimpleXMLElement;

class ViewDataTest extends PHPUnit_Framework_TestCase
{
    public function testMagicMethodsSetData()
    {
        $json = new JsonRenderer;
        $xml  = new XmlRenderer;
        $php  = new Renderer;

        $json->data = 'json';
        $xml->data = 'xml';
        $php->data = 'php';

        $this->assertTrue(isset($json->data));
        $this->assertTrue(isset($xml->data));
        $this->assertTrue(isset($php->data));
        $this->assertSame($json->data, 'json');
        $this->assertSame($xml->data, 'xml');
        $this->assertSame($php->data, 'php');

        unset($json->data);
        unset($xml->data);
        unset($php->data);

        $this->assertFalse(isset($json->data));
        $this->assertFalse(isset($xml->data));
        $this->assertFalse(isset($php->data));
    }

    public function testArrayAccessSetData()
    {
        $json = new JsonRenderer;
        $xml  = new XmlRenderer;
        $php  = new Renderer;

        $json['data'] = 'json';
        $xml['data'] = 'xml';
        $php['data'] = 'php';

        $this->assertTrue(isset($json['data']));
        $this->assertTrue(isset($xml['data']));
        $this->assertTrue(isset($php['data']));
        $this->assertSame($json['data'], 'json');
        $this->assertSame($xml['data'], 'xml');
        $this->assertSame($php['data'], 'php');

        unset($json['data']);
        unset($xml['data']);
        unset($php['data']);

        $this->assertFalse(isset($json['data']));
        $this->assertFalse(isset($xml['data']));
        $this->assertFalse(isset($php['data']));
    }

    public function testArrayToXmlConversion()
    {
        $xml = new SimpleXMLElement('<root/>');
        $array = ['data' => [['test' => 'alpha', 3 => 'numerical'],['test' => 'alpha', 3 => 'numerical']], 'test' => 'named key'];

        $xmlView = new XmlRenderer;

        $xmlView->arrayToXml($array, $xml);

        $this->assertTrue($xml instanceof SimpleXMLElement);
    }
}
