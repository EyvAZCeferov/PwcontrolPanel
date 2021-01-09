<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Livewire\Component;

class PostsBrowse extends Component
{
    public $post=null;

    public function mount($id = null)
    {
        Carbon::setLocale('az');
        $this->post = \App\Models\Posts::where('id', $id)->first();
    }

    public function render()
    {
        return view('livewire.posts-browse');
    }
}
