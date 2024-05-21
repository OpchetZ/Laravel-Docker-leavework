<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Counter extends Component
{
    public $count = 0;
    public $message = "this is default text";

    public $height = 179;
    public $weight = 40;
    public $bmi;

    public function increment()
    {
        $this->count++;
    }
    public function decrement()
    {
        $this->count--;
    }

    public function calculate()
    {
        $result = $this->weight / $this->height / $this->height *100 *100;
        $this->bmi = number_format($result,2);
    }

    public function render()
    {
        $this->calculate();
        return view('livewire.counter');
    }
}