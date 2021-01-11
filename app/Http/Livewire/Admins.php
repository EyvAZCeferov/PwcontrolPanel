<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use App\Admins as Admin;

class Admins extends Component
{
    public $deleted = false, $admins, $adminRoles = [
        [
            'name' => 'Nəzarətçi',
            'id' => 1,
        ],
        [
            'name' => 'Müştəri',
            'id' => 2,
        ],
        [
            'name' => 'Baş admin',
            'id' => 3,
        ],
        [
            'name' => 'Səbət nəzarətçisi',
            'id' => 4,
        ],
    ];

    public function mount()
    {
        if ($this->deleted) {
            $this->admins = Admin::onlyTrashed()->orderBy('created_at', 'DESC')->get();
        } else {
            $this->admins = Admin::orderBy('created_at', 'DESC')->get();
        }
    }

    public function render()
    {
        $this->mount();
        return view('livewire.admins');
    }

    public function delete($id)
    {
        Admin::where('id', $id)->delete();
        session()->flash('message', 'Məlumatlar Silindi!');
        $this->mount();
    }

    public function hardDelete($id)
    {
        $datas = Admin::where('id', $id)->onlyTrashed()->get();
        Storage::disk('uploads')->delete('admins/' . $datas[0]->profilePhoto);
        Admin::where('id', $id)->onlyTrashed()->forceDelete();
        session()->flash('message', 'Məlumatlar bazadan birdəfəlik silindi!');
        $this->mount();
    }

    public function recover($id)
    {
        Admin::where('id', $id)->onlyTrashed()->restore();
        session()->flash('message', 'Məlumatlar Geri qaytarıldı!');
        $this->mount();
    }
}
