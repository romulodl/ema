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
$ema->calculate(array $values, array $previous_values = []);
```

For example:
```php
$ema = new Romulodl\Ema();
$ema->calculate([10, 12, 14, 20, 14, 10, 11]);
```

#### What is `$previous_values` for?

The EMA calculation is based on the previous round of calculation. The `n` round depends on `n - 1` result.
Then what is `n - 1` for the first round? If `$previous_values` is not available, it uses a simple moving average
for it. With `$previous_values` set, it will start the calculation of the EMA before and the result will be more
accurate (at least closest to what TradingView shows.)

## Why did you do this?

The PECL Trading extension is crap and not everyone wants to install it.
I am building a trading bot and building more complex trading indicators that use the EMA as a basic step.
