<?php declare(strict_types=1);

namespace GraphQLTypes;

class TypeConfigDecorator
{
    public static function resolve()
    {
       return function(array $typeConfig)
       {
           switch($typeConfig['name']) {
               case 'UUID':
                   $uuid = new UuidType();

                   $typeConfig = array_merge($typeConfig, [
                       'serialize' => function($value) use ($uuid) {
                           return $uuid->serialize($value);
                       },
                       'parseValue' => function($value) use ($uuid) {
                           return $uuid->parseValue($value);
                       },
                       'parseLiteral' => function($ast) use ($uuid) {
                           return $uuid->parseLiteral($ast);
                       }
                   ]);
                   break;
           }

           return $typeConfig;
       };
    }
}
