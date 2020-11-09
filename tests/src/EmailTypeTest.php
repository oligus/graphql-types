<?php declare(strict_types=1);

namespace Tests\Types;

use GraphQL\Language\AST\IntValueNode;
use GraphQL\Language\AST\StringValueNode;
use GraphQL\Error\Error;
use GraphQLTypes\EmailType;
use PHPUnit\Framework\TestCase;
use Exception;

/**
 * Class EmailTypeTest
 * @package Tests\Types
 */
class EmailTypeTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function testSerialize()
    {
        $emailType = new EmailType();
        $email = 'test@email.com';

        $this->assertEquals('test@email.com', $emailType->serialize($email));
    }

    /**
     * @throws Exception
     */
    public function testSerializeException()
    {
        $this->expectException(Error::class);
        $this->expectExceptionMessage('Invalid email: "test"');
        $emailType = new EmailType();
        $emailType->serialize('test');
    }

    /**
     * @throws Exception
     */
    public function testParseValue()
    {
        $emailType = new EmailType();
        $email = 'test@email.com';
        $this->assertEquals($email, $emailType->parseValue($email));
    }

    /**
     * @throws Exception
     */
    public function testParseValueException()
    {
        $this->expectException(Error::class);
        $this->expectExceptionMessage('Invalid email: "test"');
        $emailType = new EmailType();
        $emailType->parseValue('test');
    }

    /**
     * @throws Error
     */
    public function testParseLiteral()
    {
        $emailType = new EmailType();
        $node = new StringValueNode(['value' => 'test@email.com']);
        $this->assertEquals('test@email.com', $emailType->parseLiteral($node));
    }

    /**
     * @throws Error
     */
    public function testParseLiteralException()
    {
        $this->expectException(Error::class);
        $this->expectExceptionMessage('Query error: Can only parse strings got: IntValue');
        $emailType = new EmailType();
        $emailType->parseLiteral(new IntValueNode([]));
    }

    /**
     * @throws Error
     */
    public function testParseLiteralValueException()
    {
        $this->expectException(Error::class);
        $this->expectExceptionMessage('Invalid email');
        $emailType = new EmailType();
        $emailType->parseLiteral(new StringValueNode(['value' => 'test']));
    }
}
