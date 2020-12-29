<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Control extends Component
{
    public $name;

    public function save()
    {
        dd($this->name);
    }

    public function render()
    {
        return view('livewire.control');
    }
}
