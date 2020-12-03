<?php

namespace App\Http\Controllers;

use App\Exercise1\Person;
use App\Exercise1\Stairs;
use App\Exercise2\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ExerciceController extends Controller
{
    public function exerciseOne()
    {
        $stairs = new Stairs(10);
        $person = new Person();

        $combinations = $person->getPossibleCombinations($stairs);

        return view('exercise_one', compact('combinations', 'stairs'));
    }

    public function exerciseTwo()
    {
        $purchases = $this->getPurchasesInStorage();

        $customer = new Customer($purchases);

        $rePurchases = $customer->calculateRePurchase();

        return view('exercise_two', compact('rePurchases'));
    }

    private function getPurchasesInStorage(): string
    {
        return Storage::disk('public')->get('purchases.json');
    }
}
