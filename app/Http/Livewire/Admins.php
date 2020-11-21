<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use App\User;

class Admins extends Component
{
    public $deleted = false, $admins;

    public function mount()
    {
        if ($this->deleted) {
            $this->admins = User::onlyTrashed()->orderBy('created_at', 'DESC')->get();
        } else {
            $this->admins = User::orderBy('created_at', 'DESC')->get();
        }
    }

    public function render()
    {
        $this->mount();
        return view('livewire.admins');
    }

    public function delete($id)
    {
        User::where('id', $id)->delete();
        session()->flash('message', 'Məlumatlar Silindi!');
        $this->mount();
    }

    public function hardDelete($id)
    {
        $datas = User::where('id', $id)->onlyTrashed()->get();
        Storage::disk('uploads')->delete('admins/' . $datas[0]->profilePhoto);
        User::where('id', $id)->onlyTrashed()->forceDelete();
        session()->flash('message', 'Məlumatlar bazadan birdəfəlik silindi!');
        $this->mount();
    }

    public function recover($id)
    {
        User::where('id', $id)->onlyTrashed()->restore();
        session()->flash('message', 'Məlumatlar Geri qaytarıldı!');
        $this->mount();
    }
}
