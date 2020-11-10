# Generic GraphQL Types

[![Build Status](https://travis-ci.org/oligus/graphql-types.svg?branch=master)](https://travis-ci.org/oligus/graphql-types)
[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)
[![Codecov.io](https://codecov.io/gh/oligus/graphql-types/branch/master/graphs/badge.svg)](https://codecov.io/gh/oligus/graphql-types)

A collection of generic types for use with [webonyx/graphql-php](https://github.com/webonyx/graphql-php)

## Quick start

## TOC
- [Scalar types](README.md#scalar-types)
  - [Email](README.md#email)
  - [Money](README.md#money)
  - [UUID](README.md#uuid)
  - [URL](README.md#url)

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

# Scalar types

## Email

Standard email validation

_GraphQL definition:_
```graphql
scalar Email
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

## URL

`URL` a Uniform Resource Locator. 

_GraphQL definition:_
```graphql
scalar URL
```
