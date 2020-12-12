<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Bockets extends Component
{
    public $buckets = [];

    public function render()
    {
        return view('livewire.bockets');
    }

    public function cancel($id)
    {
        return 'cancel';
    }

    public function ready($id)
    {
        return 'ready';
    }

    public function prepare()
    {
        return 'prepare';
    }

}
