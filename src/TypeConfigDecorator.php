<?php declare(strict_types=1);

namespace GraphQLTypes;

class TypeConfigDecorator
{
    public static function resolve()
    {
        return function (array $typeConfig) {
            switch ($typeConfig['name']) {
                case 'UUID':
                    $typeConfig = array_merge($typeConfig, UuidType::config());
                    break;

                case 'Money':
                    $typeConfig = array_merge($typeConfig, MoneyType::config());
                    break;
            }

            return $typeConfig;
        };
    }
}
