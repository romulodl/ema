<?php

namespace Romulodl;

class Ema
{
	/**
	 * Calculate the EMA based on this formula
	 * (Close - previous EMA) * (2 / n+1) + previous EMA
	 */
	public function calculate(array $values, int $period = 9) : array
	{
		if (empty($values) || count($values) < $period) {
			throw new \Exception('[' . __METHOD__ . '] $values parameters is empty');
		}

		$mult = 2 / ($period + 1);
		$ema[] = 0;
		foreach ($values as $value) {
			if ( !is_numeric($value)) {
				throw new \Exception('[' . __METHOD__ . '] invalid value: '. $value);
			}

			$prev = array_slice($ema, -1)[0];
			$ema[] = ($value - $prev) * $mult + $prev;
		}

		return array_reverse($ema);
	}
}
