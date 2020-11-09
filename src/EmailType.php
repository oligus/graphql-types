<?php declare(strict_types=1);

namespace GraphQLTypes;

use GraphQL\Error\Error;
use GraphQL\Language\AST\Node;
use GraphQL\Language\AST\StringValueNode;
use GraphQL\Type\Definition\ScalarType;
use GraphQL\Utils\Utils;

/**
 * Class EmailType
 * @package GraphQLTypes
 */
class EmailType extends ScalarType
{
    use ScalarConfigTrait;

    /**
     * @var string $name
     */
    public $name = 'Email';

    /**
     * @var string $description
     */
    public $description = 'The `UUID` scalar type represents a universally unique identifier (UUID), according to RFC 4122.';

    /**
     * @param mixed $value
     * @throws Error
     */
    public function serialize($value): string
    {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            throw new Error("Invalid email: " . Utils::printSafeJson($value));
        }

        return $value;
    }

    /**
     * @param mixed $value
     * @throws Error
     */
    public function parseValue($value): string
    {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            throw new Error("Invalid email: " . Utils::printSafeJson($value));
        }

        return $value;
    }

    /**
     * @param array<mixed>|null $variables
     * @throws Error
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     * @phan-suppress PhanUnusedPublicMethodParameter
     */
    public function parseLiteral(Node $valueNode, ?array $variables = null): string
    {
        if (!$valueNode instanceof StringValueNode) {
            throw new Error('Query error: Can only parse strings got: ' . $valueNode->kind, [$valueNode]);
        }

        if (!filter_var($valueNode->value, FILTER_VALIDATE_EMAIL)) {
            throw new Error("Invalid email", [$valueNode]);
        }

        return $valueNode->value;
    }
}
