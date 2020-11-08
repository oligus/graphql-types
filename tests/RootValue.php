<?php declare(strict_types=1);

namespace Test;

use Money\Money;
use Ramsey\Uuid\Uuid;

class RootValue
{
    public static function resolve()
    {
        return [
            'record' => function($rootValue, $args, $context) {
                return [
                    'id' => Uuid::fromString('3716cda3-81dd-4297-952a-38ef744218bb'),
                    'price' => Money::USD(1999)
                ];
            },
        ];
    }
}
