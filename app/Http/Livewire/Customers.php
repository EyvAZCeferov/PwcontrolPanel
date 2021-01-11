<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class Customers extends Component
{
    public $deleted = false, $customers;

    public function mount()
    {
        if ($this->deleted) {
            $this->customers = \App\Models\Customers::onlyTrashed()->orderBy('created_at', 'DESC')->with(['get_locations','get_posts','get_comments','get_rating'])->get();
        } else {
            $this->customers = \App\Models\Customers::orderBy('created_at', 'DESC')->with(['get_locations','get_posts','get_comments','get_rating'])->get();
        }
    }

    public function render()
    {
        $this->mount();
        return view('livewire.customers');
    }

    public function delete($id)
    {
        \App\Models\Customers::where('id', $id)->delete();
        session()->flash('message', 'Məlumatlar Silindi!');
        $this->mount();
    }

    public function hardDelete($id)
    {
        $datas = \App\Models\Customers::where('id', $id)->onlyTrashed()->get();
        Storage::disk('uploads')->delete('customers/' . $datas[0]->logo);
        Storage::disk('gcs')->delete('customers/' . $datas[0]->logo);
        \App\Models\Customers::where('id', $id)->onlyTrashed()->forceDelete();
        session()->flash('message', 'Məlumatlar bazadan birdəfəlik silindi!');
        $this->mount();
    }

    public function recover($id)
    {
        \App\Models\Customers::where('id', $id)->onlyTrashed()->restore();
        session()->flash('message', 'Məlumatlar Geri qaytarıldı!');
        $this->mount();
    }
}
