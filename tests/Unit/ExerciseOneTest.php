<?php

namespace Tests\Unit;

use App\Exercise1\Person;
use App\Exercise1\Stairs;
use PHPUnit\Framework\TestCase;

class ExerciseOneTest extends TestCase
{

    public function test_person_can_climb_ladder(): void
    {
        $stairs = new Stairs(10);

        $this->assertTrue($stairs->getSteps() > 0);
    }

    public function test_maximum_number_steps_is_equal_two()
    {
        $person = new Person();

        $this->assertEquals($person->calculateStepCombination(4), 5);
    }
}
