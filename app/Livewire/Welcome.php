<?php

namespace App\Livewire;

use Livewire\Component;

class Welcome extends Component
{

    public $count = 1;

    public function increment()
    {
        $this->count++;
    }
    public function decrement()
    {
        $this->count--;
    }
    public function render()
    {
        return view('livewire.welcome');
    }
}
