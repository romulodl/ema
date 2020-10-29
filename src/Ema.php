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
		$ema = 0;
		foreach ($values as $value) {
			if ( !is_numeric($value)) {
				throw new \Exception('[' . __METHOD__ . '] invalid value: '. $value);
			}

			$ema = ($value - $ema) * $mult + $ema;
		}

		return $ema;
	}
}
