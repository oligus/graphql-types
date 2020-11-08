# Generic GraphQL Types

A collection of generic types
## Quick start

## Adding types

##### With type decorator

```php
$schema = BuildSchema::build($source, TypeConfigDecorator::resolve());
```

If you already have a type config decorator, you can add specific types to your current type config decorator:

```php
...
switch($typeConfig['name']) {
    case 'UUID':
        $typeConfig = array_merge($typeConfig, UuidType::config());
        break;
}
...
```

##### Directly

You can also just add types directly

```php
$uuid = new UuidType();
```

## Money

The `Money` scalar type represents the lowest denominator of a currency. 

Will resolve to [moneyphp/money](https://github.com/moneyphp/money) type.

_GraphQL definition:_
```graphql
scalar Money
```

## UUID

The `UUID` scalar type represents a universally unique identifier (UUID). 

Will resolve to [ramsey/uuid](https://github.com/ramsey/uuid) type.

_GraphQL definition:_
```graphql
scalar UUID
```
