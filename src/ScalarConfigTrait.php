<?php declare(strict_types=1);

namespace GraphQLTypes;

trait ScalarConfigTrait
{
    public static function config(): array
    {
        $scalar = new self();

        return [
            'serialize' => function ($value) use ($scalar) {
                return $scalar->serialize($value);
            },
            'parseValue' => function ($value) use ($scalar) {
                return $scalar->parseValue($value);
            },
            'parseLiteral' => function ($ast) use ($scalar) {
                return $scalar->parseLiteral($ast);
            }
        ];
    }
}
