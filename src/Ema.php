<?php

namespace Romulodl;

class Ema
{
	private static $mult = null;

	public function calculate(array $values, array $previous_values = []) : float
	{
		return self::calculate_ema($values, $previous_values);
	}

	public static function calculateStatic(array $values, array $previous_values = []): float
	{
		return self::calculate_ema($values, $previous_values);
	}

	/**
	 * Calculate the EMA based on this formula
	 * (Close - previous EMA) * (2 / n+1) + previous EMA
	 *
	 * The previous values options exists to try to smooth the current calculation
	 * if it is empty, it will calculate the SMA for the first round.
	 */
	private static function calculate_ema(array $values, array $previous_values = []) : float
	{
		if (empty($values)) {
			throw new \Exception('[' . __METHOD__ . '] $values parameters is empty');
		}

		self::$mult = self::$mult ?: 2 / (count($values) + 1);
		$prev = false;
		foreach ($values as $value) {
			if ( !is_numeric($value)) {
				throw new \Exception('[' . __METHOD__ . '] invalid value: '. $value);
			}

			if (!$prev) {
				$prev = !empty($previous_values) ? self::calculate_ema($previous_values) : self::sma($values);
				continue;
			}

			$prev = ($value - $prev) * self::$mult + $prev;
		}

		return $prev ?: 0;
	}

	private static function sma(array $values) : float
	{
		return array_sum($values) / count($values);
	}

}
