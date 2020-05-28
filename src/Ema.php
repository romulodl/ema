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
	public function calculate(array $values, int $period = 9) : float
	{
		if (empty($values) || count($values) < $period) {
			throw new \Exception('[' . __METHOD__ . '] $values parameters is empty');
		}

		$mult = 2 / ($period + 1);
		$prev_close = [];
		$prev_ema = false;
		foreach ($values as $value) {
			if ( !is_numeric($value)) {
				throw new \Exception('[' . __METHOD__ . '] invalid value: '. $value);
			}

			if (count($prev_close) < $period) {
				$prev_close[] = $value;
				if (count($prev_close) === $period) {
					$prev_ema = array_sum($prev_close) / $period;
				}
				continue;
			}

			$prev_ema = ($value - $prev_ema) * $mult + $prev_ema;
		}

		return $prev_ema;
	}
}
