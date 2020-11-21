<?php

namespace App\Http\Livewire;

use Livewire\Component;

class PostsCalendar extends Component
{
    public $posts;

    public function mount()
    {
        $this->posts = \App\Models\Posts::all();
    }

    public function render()
    {
        return view('livewire.posts-calendar');
    }
}
