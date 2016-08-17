# Config Schema

[![Build Status](https://img.shields.io/travis/weew/config-schema.svg)](https://travis-ci.org/weew/config-schema)
[![Code Quality](https://img.shields.io/scrutinizer/g/weew/config-schema.svg)](https://scrutinizer-ci.com/g/weew/config-schema)
[![Test Coverage](https://img.shields.io/coveralls/weew/config-schema.svg)](https://coveralls.io/github/weew/config-schema)
[![Version](https://img.shields.io/packagist/v/weew/config-schema.svg)](https://packagist.org/packages/weew/config-schema)
[![Licence](https://img.shields.io/packagist/l/weew/config-schema.svg)](https://packagist.org/packages/weew/config-schema)

## Table of contents

- [Installation](#installation)
- [Introduction](#introduction)
- [Usage](#usage)

## Installation

`composer require weew/config-schema`

## Introduction

This package allows easy config validation and is used in combination with the [weew/config](https://github.com/weew/config) package.

## Usage

You can describe your config schema like this:

```php
$config = new Config([
    'some' => 'value',
    'items' => ['foo', 'bar'],
    'name' => 'John Doe',
]);
$schema = new ConfigSchema($config);

$schema
    ->hasValue('some')
    ->hasArray('items')->allowed(['foo', 'baz'])
    ->hasString('name')->min(3)->max(10)
;
```

After you've described your schema, you can either validate it, which return you an instance of `IValidationResult`, or assert it, which will throw an exception.

```php
$result = $schema->check();
foreach ($result->getErrors() as $error) {
    echo $error->getSubject() . ' ' . $error->getMessage();
}

// or

try {
    $schema->assert();
} catch (ConfigValidationException $ex) {
    $result = $ex->getValidationResult();
}
```
