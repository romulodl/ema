# Exponential Moving Average

## Instalation

```
composer require romulodl/ema
```

or add `romulodl/ema` to your `composer.json`. Please check the latest version in releases.

## Usage

```php
$ema = new Romulodl\Ema();
$ema->calculate([10, 12, 14, 20, 14, 10, 11]);
```

it also contains a static method:

```php
Ema::calculateStatic([10, 12, 14, 20, 14, 10, 11]);
```


## Why did you do this?

The PECL Trading extension is crap and not everyone wants to install it.
I am building a trading bot and building more complex trading indicators that use EMA as a basic step.
I am also planning to open-source the other indicators (not the trading bot)
