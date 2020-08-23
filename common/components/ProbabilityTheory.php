<?php

namespace common\components;

use Exception;

/**
 * Class ProbabilityTheory
 * @package common\components
 */
class ProbabilityTheory
{
    /**
     * @param int[]|float[] $fortuneData
     * @return int|string
     * @throws Exception
     */
    public static function fortune(array $fortuneData)
    {
        $recalculatedCoefficients = static::recalculateCoefficients($fortuneData);
        $probabilitySum = array_sum($recalculatedCoefficients);
        $random = random_int(1, $probabilitySum);
        $previous = 0;

        foreach ($recalculatedCoefficients as $key => $value) {
            $value += $previous;

            if (in_array($random, range($previous + 1, $value))) {
                return $key;
            }

            $previous = $value;
        }

        throw new Exception('Error occured while making fortune');
    }

    /**
     * @param int[]|float[] $fortuneData
     * @return int[]
     */
    protected static function recalculateCoefficients(array $fortuneData): array
    {
        $minimalCoefficient = min($fortuneData);

        if (is_int($minimalCoefficient)) {
            return $fortuneData;
        }

        $numberOfDecinals = static::getNumberOfDecimals($minimalCoefficient);
        $multiplicationFactor = pow(10, $numberOfDecinals);

        return array_map(fn($number) => $number * $multiplicationFactor, $fortuneData);
    }

    /**
     * @param float $number
     * @return int
     */
    protected static function getNumberOfDecimals(float $number): int
    {
        return strlen($number) - strrpos($number, '.') - 1;
    }

    /**
     * @param array $fortuneData
     * @param int $iterations
     * @throws Exception
     */
    public static function test(array $fortuneData, int $iterations = 1000)
    {
        echo "ProbabilityTheory:\n\n";

        $startTime = microtime(true);
        $stats = self::calculateStats($fortuneData, $iterations);

        self::printStats($fortuneData, $stats, $iterations);

        $completeTime = microtime(true) - $startTime;
        echo "\nCompleted in $completeTime seconds...\n";

        die;
    }
    
    /**
     * @param array $fortuneData
     * @param array $stats
     * @param int $iterations
     */
    public static function printStats(array $fortuneData, array $stats, int $iterations)
    {
        foreach ($stats as $key => $value) {
            $percent = self::calculatePercents($value, $iterations);
            $expectedPercent = self::calculatePercents($fortuneData[$key], array_sum($fortuneData));

            echo $key . ': ' . $value . " ($percent%/$expectedPercent%)\n";
        }
    }

    /**
     * @param array $fortuneData
     * @param int $iterations
     * @return int[]
     * @throws Exception
     */
    public static function calculateStats(array $fortuneData, int $iterations = 1000): array
    {
        $stats = [];

        for ($i = 0; $i < $iterations; $i++) {
            $fortune = self::fortune($fortuneData);

            if (!isset($stats[$fortune])) {
                $stats[$fortune] = 0;
            }

            $stats[$fortune]++;
        }

        return static::sortStats($stats, array_keys($fortuneData));
    }

    /**
     * @param int[] $stats
     * @param array $fortuneDataKeys
     * @return int[]
     */
    protected static function sortStats(array $stats, array $fortuneDataKeys): array
    {
        $sortedStats = [];

        foreach ($fortuneDataKeys as $fortuneDataKey) {
            if (!isset($stats[$fortuneDataKey])) {
                continue;
            }

            $sortedStats[$fortuneDataKey] = $stats[$fortuneDataKey];
        }

        return $sortedStats;
    }

    /**
     * @param float|int $number
     * @param float|int $total
     * @return float|int
     */
    protected static function calculatePercents($number, $total)
    {
        return $number / ($total / 100);
    }
}
