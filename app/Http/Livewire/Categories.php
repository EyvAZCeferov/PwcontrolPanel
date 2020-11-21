<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Storage;
use Kreait\Firebase\Factory;
use Livewire\Component;

class Categories extends Component
{
    public $deleted = false, $categories;

    public function mount()
    {
        (new Factory)->withServiceAccount(app_path() . '/Firebase/FirebaseConfig.json')->createAuth()->signInWithEmailAndPassword('getdata@pw.az', 'getdata_123');
        if ($this->deleted) {
            $this->categories = \App\Models\Categories::onlyTrashed()->with('topCategory')->orderBy('created_at', 'DESC')->get();
        } else {
            $this->categories = \App\Models\Categories::orderBy('created_at', 'DESC')->with('topCategory')->get();
        }
    }

    public function delete($id)
    {
        \App\Models\Categories::where('id', $id)->delete();
        session()->flash('message', 'Məlumatlar Silindi!');
        $this->mount();
    }

    public function hardDelete($id)
    {
        $datas = \App\Models\Categories::where('id', $id)->onlyTrashed()->get();
        Storage::disk('uploads')->deleteDirectory('categories/' . $datas[0]->clasor);
        Storage::disk('gcs')->deleteDirectory('categories/' . $datas[0]->clasor);
        \App\Models\Categories::where('id', $id)->onlyTrashed()->forceDelete();
        session()->flash('message', 'Məlumatlar bazadan birdəfəlik silindi!');
        $this->mount();
    }

    public function recover($id)
    {
        \App\Models\Categories::where('id', $id)->onlyTrashed()->restore();
        session()->flash('message', 'Məlumatlar Geri qaytarıldı!');
        $this->mount();
    }

    public function render()
    {
        $this->mount();
        return view('livewire.categories');
    }
}
