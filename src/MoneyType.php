<?php declare(strict_types=1);

namespace GraphQLTypes;

use Money\Money;
use GraphQL\Error\InvariantViolation;
use GraphQL\Language\AST\StringValueNode;
use GraphQL\Type\Definition\ScalarType;
use GraphQL\Utils\Utils;
use GraphQL\Error\Error;
use GraphQL\Language\AST\Node;

/**
 * Class MoneyType
 * @package GraphQLTypes
 */
class MoneyType extends ScalarType
{
    use ScalarConfigTrait;

    /**
     * @var string $name
     */
    public $name = 'Money';

    /**
     * @var string $description
     */
    public $description = 'The `Money` scalar type represents the lowest denominator of a currency. Value here is a subunit that is a fraction of the main currency unit (base).';

    /**
     * @param mixed $value
     * @throws InvariantViolation
     */
    public function serialize($value): string
    {
        if (!$value instanceof Money) {
            throw new InvariantViolation('Not an instance of Money (' . Utils::printSafe($value) . ')');
        }

        return $value->getAmount();
    }

    /**
     * @param mixed $value
     * @throws Error
     */
    public function parseValue($value): Money
    {

        if (!is_string($value)) {
            throw new Error('Query error: Can only parse strings got: ' . Utils::printSafe($value));
        }

        if (empty($value) && is_string($value)) {
            throw new Error('Query error: Can only parse non empty strings got: ' . Utils::printSafe($value));
        }

        return Money::SEK($value);
    }

    /**
     * @param array<mixed>|null $variables
     * @throws Error
     * @phan-suppress PhanUnusedPublicMethodParameter,PhanUndeclaredProperty
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function parseLiteral(Node $valueNode, ?array $variables = null): Money
    {
        if (!$valueNode instanceof Node) {
            throw new Error('Query error: Unknown node type');
        }

        if (!$valueNode instanceof StringValueNode) {
            throw new Error('Query error: Can only parse strings got: ' . $valueNode->kind, [$valueNode]);
        }

        return Money::SEK($valueNode->value);
    }
}
