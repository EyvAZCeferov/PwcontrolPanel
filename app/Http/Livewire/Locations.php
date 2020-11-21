<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Storage;
use Kreait\Firebase\Factory;
use Livewire\Component;

class Locations extends Component
{
    public $deleted = false, $locations;

    public function mount()
    {
        (new Factory)->withServiceAccount(app_path() . '/Firebase/FirebaseConfig.json')->createAuth()->signInWithEmailAndPassword('getdata@pw.az', 'getdata_123');
        if ($this->deleted) {
            $this->locations = \App\Models\Locations::onlyTrashed()->orderBy('created_at', 'DESC')->get();
        } else {
            $this->locations = \App\Models\Locations::orderBy('created_at', 'DESC')->get();
        }
    }

    public function render()
    {
        $this->mount();
        return view('livewire.locations');
    }

    public function delete($id)
    {
        \App\Models\Locations::where('id', $id)->delete();
        session()->flash('message', 'Məlumatlar Silindi!');
        $this->mount();
    }

    public function hardDelete($id)
    {
        $datas = \App\Models\Locations::where('id', $id)->onlyTrashed()->get();
        Storage::disk('gcs')->deleteDirectory('/locations/' . $datas[0]->clasor . '/');
        Storage::disk('uploads')->deleteDirectory('/locations/' . $datas[0]->clasor);
        \App\Models\Locations::where('id', $id)->onlyTrashed()->forceDelete();
        session()->flash('message', 'Məlumatlar bazadan birdəfəlik silindi!');
        $this->mount();
    }

    public function recover($id)
    {
        \App\Models\Locations::where('id', $id)->onlyTrashed()->restore();
        session()->flash('message', 'Məlumatlar Geri qaytarıldı!');
        $this->mount();
    }
}
