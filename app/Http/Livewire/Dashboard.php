<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Kreait\Firebase\Factory;
use Livewire\Component;
use App\User;

class Dashboard extends Component
{
    public $allUsers;

    public function mount()
    {
        $this->allUsers=User::all();
    }

    public function render()
    {
        return view('livewire.dashboard');
    }
}
