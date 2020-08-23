<?php

namespace common\tests\unit\components;

use Codeception\Test\Unit;
use common\components\ProbabilityTheory;

/**
 * Class ProbabilityTheoryTest
 * @package common\tests\unit\components
 */
class ProbabilityTheoryTest extends Unit
{
    /**
     * @throws Exception
     */
    public function testProbability(): void
    {
        $sampleData = [
            'A' => 70,
            'B' => 15,
            'C' => 10,
            'D' => 4,
            'E' => 0.9,
            'F' => 0.09,
            'G' => 0.009,
            'H' => 0.001,
        ];

        ProbabilityTheory::test($sampleData, 10000);
    }
}
