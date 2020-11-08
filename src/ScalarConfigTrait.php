<?php declare(strict_types=1);

namespace GraphQLTypes;

use Closure;
use Exception;
use GraphQL\Error\Error;
use GraphQL\Type\Definition\ScalarType;

/**
 * Trait ScalarConfigTrait
 * @package GraphQLTypes
 */
trait ScalarConfigTrait
{
    /**
     * @return Closure[]
     * @throws error
     * @phan-suppress PhanUndeclaredMethod
     */
    public static function config(): array
    {
        $class = self::class;

        /**
         * TODO: Initiate parent class in a better way?
         * @var ScalarType $scalar
         */
        $scalar = new $class;

        if (!$scalar instanceof ScalarType) {
            throw new Error('Not instance of ScalarType');
        }

        return [
            /**
             * @param mixed $value
             * @throws Error
             */
            'serialize' => function ($value) use ($scalar): string {
                return $scalar->serialize($value);
            },
            /**
             * @param mixed $value
             * @return mixed
             * @throws Error
             */
            'parseValue' => function ($value) use ($scalar) {
                return $scalar->parseValue($value);
            },
            /**
             * @param mixed $node
             * @return mixed
             * @throws Exception
             */
            'parseLiteral' => function ($node) use ($scalar) {
                return $scalar->parseLiteral($node);
            }
        ];
    }
}
