<?php declare(strict_types=1);

namespace Tests\Types;

use Exception;
use GraphQL\Error\Error;
use GraphQL\Language\AST\IntValueNode;
use GraphQL\Language\AST\StringValueNode;
use GraphQLTypes\UrlType;
use PHPUnit\Framework\TestCase;

/**
 * Class UrlTypeTest
 * @package Tests\Types
 */
class UrlTypeTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function testSerialize()
    {
        $urlType = new UrlType();
        $url = 'http://www.google.com/another/url';

        $this->assertEquals('http://www.google.com/another/url', $urlType->serialize($url));
        $this->assertEquals('`URL` a Uniform Resource Locator.', $urlType->description);
    }

    /**
     * @throws Exception
     */
    public function testSerializeException()
    {
        $this->expectException(Error::class);
        $this->expectExceptionMessage('Invalid URL: "test"');
        $urlType = new UrlType();
        $urlType->serialize('test');
    }

    /**
     * @throws Exception
     */
    public function testParseValue()
    {
        $urlType = new UrlType();
        $url = 'http://www.google.com/another/url';
        $this->assertEquals($url, $urlType->parseValue($url));
    }

    /**
     * @throws Exception
     */
    public function testParseValueException()
    {
        $this->expectException(Error::class);
        $this->expectExceptionMessage('Invalid URL: "test"');
        $urlType = new UrlType();
        $urlType->parseValue('test');
    }

    /**
     * @throws Error
     */
    public function testParseLiteral()
    {
        $urlType = new UrlType();
        $node = new StringValueNode(['value' => 'http://www.google.com/another/url']);
        $this->assertEquals('http://www.google.com/another/url', $urlType->parseLiteral($node));
    }

    /**
     * @throws Error
     */
    public function testParseLiteralException()
    {
        $this->expectException(Error::class);
        $this->expectExceptionMessage('Query error: Can only parse strings got: IntValue');
        $urlType = new UrlType();
        $urlType->parseLiteral(new IntValueNode([]));
    }

    /**
     * @throws Error
     */
    public function testParseLiteralValueException()
    {
        $this->expectException(Error::class);
        $this->expectExceptionMessage('Invalid URL');
        $urlType = new UrlType();
        $urlType->parseLiteral(new StringValueNode(['value' => 'test']));
    }
}
