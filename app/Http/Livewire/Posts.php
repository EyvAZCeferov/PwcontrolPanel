<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Kreait\Firebase\Factory;
use Livewire\Component;

class Posts extends Component
{
    public function render()
    {
        $this->mount();
        return view('livewire.posts');
    }

    public $deleted = false, $posts;

    public function mount()
    {
        Carbon::setlocale('az');
        (new Factory)->withServiceAccount(app_path() . '/Firebase/FirebaseConfig.json')->createAuth()->signInWithEmailAndPassword('getdata@pw.az', 'getdata_123');
        if ($this->deleted) {
            $this->posts = \App\Models\Posts::onlyTrashed()->orderBy('created_at', 'DESC')->with(['getCustomer','get_comments','get_rating'])->get();
        } else {
            $this->posts = \App\Models\Posts::orderBy('created_at', 'DESC')->with(['getCustomer','get_comments','get_rating'])->get();
        }
    }

    public function delete($id)
    {
        \App\Models\Posts::where('id', $id)->delete();
        session()->flash('message', 'Məlumatlar Silindi!');
        $this->mount();
    }

    public function hardDelete($id)
    {
        $datas = \App\Models\Posts::where('id', $id)->onlyTrashed()->get();
        Storage::disk('gcs')->deleteDirectory('/posts/' . $datas[0]->clasor . '/');
        Storage::disk('uploads')->deleteDirectory('/posts/' . $datas[0]->clasor);
        \App\Models\Posts::where('id', $id)->onlyTrashed()->forceDelete();
        session()->flash('message', 'Məlumatlar bazadan birdəfəlik silindi!');
        $this->mount();
    }

    public function recover($id)
    {
        \App\Models\Posts::where('id', $id)->onlyTrashed()->restore();
        session()->flash('message', 'Məlumatlar Geri qaytarıldı!');
        $this->mount();
    }
}
