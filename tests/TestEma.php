<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Romulodl\Ema;

final class EmaTest extends TestCase
{
	public function testCalculateEmaWithEmptyPreviousValues(): void
	{
		$values = [
			9148.27,
			9995,
			9807.49,
			9550.67,
			8719.53,
			8561.09,
			8808.71,
			9305.91,
			9786.80,
			9310.73
		];

		$ema = new Ema();
		$this->assertSame(9288.86, round($ema->calculate($values), 2));
	}

	public function testCalculateEmaWithPreviousValues(): void
	{
		$previous_values = [
			7694.17,
			7774,
			7735.75,
			8784.20,
			8624.76,
			8830.52,
			8975.18,
			8900,
			8873.98,
			9022.78
		];

		$values = [
			9148.27,
			9995,
			9807.49,
			9550.67,
			8719.53,
			8561.09,
			8808.71,
			9305.91,
			9786.80,
			9310.73
		];

		$ema = new Ema();
		$this->assertSame(9197.01, round($ema->calculate($values, $previous_values), 2));
	}

	public function testCalculateEmaWithMorePreviousValues(): void
	{
		$previous_values = [
			7483.35,
			7504.11,
			7534.01,
			7694.17,
			7774,
			7735.75,
			8784.20,
			8624.76,
			8830.52,
			8975.18,
			8900,
			8873.98,
			9022.78
		];

		$values = [
			9148.27,
			9995,
			9807.49,
			9550.67,
			8719.53,
			8561.09,
			8808.71,
			9305.91,
			9786.80,
			9310.73
		];

		$ema = new Ema();
		$this->assertSame(9182.18, round($ema->calculate($values, $previous_values), 2));
	}

	public function testCalculateEmaWithEmptyArray(): void
	{
		$this->expectException(Exception::class);

		$ema = new Ema();
		$ema->calculate([]);
	}

	public function testCalculateEmaWithInvalidArray(): void
	{
		$values = [
			9148.27,
			9995,
			9807.49,
			'hahah',
			8719.53,
			8561.09,
			8808.71,
			9305.91,
			9786.80,
			9310.73
		];

		$this->expectException(Exception::class);

		$ema = new Ema();
		$ema->calculate($values);
	}
}
