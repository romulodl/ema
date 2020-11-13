# Exponential Moving Average

Calculate the EMA of giving values.

![Ema](https://github.com/romulodl/ema/workflows/Ema/badge.svg)

## Instalation

```
composer require romulodl/ema
```

or add `romulodl/ema` to your `composer.json`. Please check the latest version in releases.

## Usage

```php
$ema = new Romulodl\Ema();
$values = $ema->calculate(array $values, int $period = 9);
// return array, $values[0] being the last one
```

For example:
```php
$ema = new Romulodl\Ema();
$ema->calculate([10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20]);
```

## Why did you do this?

The PECL Trading extension is crap and not everyone wants to install it.
I am building a trading bot and building more complex trading indicators that use the EMA as a basic step.
