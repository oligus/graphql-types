<?php declare(strict_types=1);

namespace GraphQLTypes;

use Closure;
use GraphQL\Error\Error;

/**
 * Class TypeConfigDecorator
 * @package GraphQLTypes
 */
class TypeConfigDecorator
{
    public static function resolve(): Closure
    {
        /**
         * @param array<mixed> $typeConfig
         * @throws Error
         * @return array<mixed>
         */
        return function (array $typeConfig) : array {
            switch ($typeConfig['name']) {
                case 'UUID':
                    $typeConfig = array_merge($typeConfig, UuidType::config());
                    break;

                case 'Money':
                    $typeConfig = array_merge($typeConfig, MoneyType::config());
                    break;

                case 'Email':
                    $typeConfig = array_merge($typeConfig, EmailType::config());
                    break;
            }

            return $typeConfig;
        };
    }
}
