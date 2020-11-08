<?php declare(strict_types=1);

namespace GraphQLTypes;

use GraphQL\Error\InvariantViolation;
use GraphQL\Language\AST\StringValueNode;
use GraphQL\Type\Definition\ScalarType;
use GraphQL\Utils\Utils;
use GraphQL\Error\Error;
use GraphQL\Language\AST\Node;
use Ramsey\Uuid\UuidInterface;
use Ramsey\Uuid\Uuid;

/**
 * Class UuidType
 * @package GraphQLTypes
 */
class UuidType extends ScalarType
{
    use ScalarConfigTrait;

    /**
     * @var string $name
     */
    public $name = 'UUID';

    /**
     * @var string $description
     */
    public $description = 'The `UUID` scalar type represents a universally unique identifier (UUID), according to RFC 4122.';

    /**
     * @param mixed $value
     * @throws InvariantViolation
     */
    public function serialize($value): string
    {
        if (!$value instanceof UuidInterface) {
            throw new InvariantViolation('Not an instance type of UUID (' . Utils::printSafe($value) . ')');
        }

        return $value->toString();
    }

    /**
     * @param mixed $value
     * @throws Error
     */
    public function parseValue($value): UuidInterface
    {
        if (!Uuid::isValid($value)) {
            throw new Error('Query error: Value is not a valid UUID string: ' . Utils::printSafe($value));
        }

        return Uuid::fromString($value);
    }

    /**
     * @param array<mixed>|null $variables
     * @throws Error
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     * @phan-suppress PhanUnusedPublicMethodParameter
     */
    public function parseLiteral(Node $valueNode, ?array $variables = null): UuidInterface
    {
        if (!$valueNode instanceof Node) {
            throw new Error('Query error: Unknown node type');
        }

        if (!$valueNode instanceof StringValueNode) {
            throw new Error('Query error: Can only parse strings got: ' . $valueNode->kind, [$valueNode]);
        }

        if (!Uuid::isValid($valueNode->value)) {
            throw new Error('Query error: Value is not a valid UUID string: ' . $valueNode->value, [$valueNode]);
        }

        return Uuid::fromString($valueNode->value);
    }
}
