<?php
namespace Noodlehaus\Parser\Test;

use Noodlehaus\Parser\Xml;
use Yoast\PHPUnitPolyfills\Polyfills\ExpectException;
use Yoast\PHPUnitPolyfills\TestCases\TestCase;

/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.1 on 2014-04-21 at 22:37:22.
 */
class XmlTest extends TestCase
{
    use ExpectException;
    /**
     * @var Xml
     */
    protected $xml;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function set_up()
    {
        $this->xml = new Xml();
    }

    /**
     * @covers Noodlehaus\Parser\Xml::getSupportedExtensions()
     */
    public function testGetSupportedExtensions()
    {
        $expected = ['xml'];
        $actual   = $this->xml->getSupportedExtensions();
        $this->assertEquals($expected, $actual);
    }

    /**
     * @covers                   Noodlehaus\Parser\Xml::parseFile()
     * @covers                   Noodlehaus\Parser\Xml::parse()
     */
    public function testLoadInvalidXml()
    {
        $this->expectException(\Noodlehaus\Exception\ParseException::class);
        $this->expectExceptionMessage('Opening and ending tag mismatch: name line 4');
        $this->xml->parseFile(__DIR__ . '/../mocks/fail/error.xml');
    }

    /**
     * @covers Noodlehaus\Parser\Xml::parseFile()
     * @covers Noodlehaus\Parser\Xml::parseString()
     * @covers Noodlehaus\Parser\Xml::parse()
     */
    public function testLoadXml()
    {
        $file = $this->xml->parseFile(__DIR__ . '/../mocks/pass/config.xml');
        $string = $this->xml->parseString(file_get_contents(__DIR__ . '/../mocks/pass/config.xml'));

        $this->assertEquals('localhost', $file['host']);
        $this->assertEquals('80', $file['port']);

        $this->assertEquals('localhost', $string['host']);
        $this->assertEquals('80', $string['port']);
    }

    /**
     * @covers Noodlehaus\Parser\Xml::parseFile()
     * @covers Noodlehaus\Parser\Xml::parseString()
     * @covers Noodlehaus\Parser\Xml::parse()
     */
    public function testLoadXmlWithAttributes()
    {
        $file = $this->xml->parseFile(__DIR__ . '/../mocks/pass/config-with-attributes.xml');
        $string = $this->xml->parseString(file_get_contents(__DIR__ . '/../mocks/pass/config-with-attributes.xml'));

        $this->assertEquals('localhost', $file['host']);
        $this->assertEquals('80', $file['port']);

        $this->assertEquals('localhost', $string['host']);
        $this->assertEquals('80', $string['port']);
    }
}
