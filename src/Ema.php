<?php

namespace Romulodl;

class Ema
{
	/**
	 * Calculate the EMA based on this formula
	 * (Close - previous EMA) * (2 / n+1) + previous EMA
	 *
	 * The previous values options exists to try to smooth the current calculation
	 * if it is empty, it will calculate the SMA for the first round.
	 */
	public function calculate(array $values, array $previous_values = []) : float
	{
		if (empty($values)) {
			throw new \Exception('[' . __METHOD__ . '] $values parameters is empty');
		}

		$mult = 2 / (count($values) + 1);

		return $this->calculate_ema($values, $mult, $previous_values);
	}

	private function calculate_ema(
		array $values,
		float $mult,
		array $previous_values = [],
		$prev = false
	): float
	{
		foreach ($values as $value) {
			if ( !is_numeric($value)) {
				throw new \Exception('[' . __METHOD__ . '] invalid value: '. $value);
			}

			if (!$prev) {
				$prev = !empty($previous_values) ?
					$this->calculate_ema($previous_values, $mult) :
					$this->sma($values);

				continue;
			}

			$prev = ($value - $prev) * $mult + $prev;
		}

		return $prev;
	}

	private function sma(array $values) : float
	{
		return array_sum($values) / count($values);
	}

}
