<?php


namespace App\Exercise1;


class Stairs
{
    private $steps;

    public function __construct(int $steps)
    {
        $this->steps = $steps;
    }

    /**
     * @return int
     */
    public function getSteps(): int
    {
        return $this->steps;
    }
}
