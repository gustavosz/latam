<?php


namespace App\Exercise1;


class Person
{

    public const ONE_COMBINATION = 1;
    public const TWO_COMBINATION = 2;

    public function getPossibleCombinations(Stairs $stairs): int
    {
        $sum = 0;
        for ($i = 1; $i <= $stairs->getSteps(); $i++) {
            $sum = $this->calculateStepCombination($i);
        }

        return $sum;
    }

    public function calculateStepCombination(int $step): int
    {
        if ($step === 1) {
            return self::ONE_COMBINATION;
        }
        if ($step === 2) {
            return self::TWO_COMBINATION;
        }

        return $this->calculateStepCombination(($step - 1)) + $this->calculateStepCombination(($step - 2));
    }
}
