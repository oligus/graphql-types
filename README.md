# Generic GraphQL Types

## Adding types

##### With type decorator

```php
$typeConfigDecorator = new TypeConfigDecorator();
$schema = BuildSchema::build($source, $typeConfigDecorator::resolve());
```

If you already have a type config decorator, you can add specific types to your current type config decorator:

```php
...
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
...
```

##### Directly

You can also just add types directly

```php
$uuid = new UuidType();
```

## UUID


_GraphQL definition:_
```graphql
scalar UUID
```
