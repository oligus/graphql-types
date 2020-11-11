<?php declare(strict_types=1);

namespace GraphQLTypes;

use GraphQL\Error\Error;
use GraphQL\Language\AST\Node;
use GraphQL\Language\AST\StringValueNode;
use GraphQL\Type\Definition\ScalarType;
use GraphQL\Utils\Utils;

/**
 * Class UrlType
 * @package GraphQLTypes
 */
class UrlType extends ScalarType
{
    use ScalarConfigTrait;

    /**
     * @var string $name
     */
    public $name = 'URL';

    /**
     * @var string $description
     */
    public $description = '`URL` a Uniform Resource Locator.';

    /**
     * @param mixed $value
     * @throws Error
     */
    public function serialize($value): string
    {
        if (!filter_var($value, FILTER_VALIDATE_URL)) {
            throw new Error("Invalid URL: " . Utils::printSafeJson($value));
        }

        return $value;
    }

    /**
     * @param mixed $value
     * @throws Error
     */
    public function parseValue($value): string
    {
        if (!filter_var($value, FILTER_VALIDATE_URL)) {
            throw new Error("Invalid URL: " . Utils::printSafeJson($value));
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

        if (!filter_var($valueNode->value, FILTER_VALIDATE_URL)) {
            throw new Error("Invalid URL", [$valueNode]);
        }

        return $valueNode->value;
    }
}
