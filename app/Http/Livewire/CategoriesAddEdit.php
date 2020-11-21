<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Kreait\Firebase\Factory;
use Livewire\Component;
use Livewire\WithFileUploads;

class CategoriesAddEdit extends Component
{
    use WithFileUploads;

    public $urlPath = null, $categories = null, $category = null, $formFields = [
        'icon' => null,
        'top_category' => null,
        'clasor' => null,
        'az_name' => null,
        'ru_name' => null,
        'en_name' => null,
        'slug' => null,
        'az_description' => null,
        'ru_description' => null,
        'en_description' => null,
    ];

    public function mount($id = null)
    {
        (new Factory)->withServiceAccount(app_path() . '/Firebase/FirebaseConfig.json')->createAuth()->signInWithEmailAndPassword('getdata@pw.az', 'getdata_123');
        $this->urlPath = request()->path();
        $this->categories = \App\Models\Categories::all();
        if ($id !== null) {
            $this->category = \App\Models\Categories::where('id', $id)->get();
            $this->formFields = [
                'icon' => $this->category[0]->icon,
                'top_category' => $this->category[0]->top_category,
                'clasor' => $this->category[0]->clasor,
                'az_name' => $this->category[0]->az_name,
                'ru_name' => $this->category[0]->ru_name,
                'en_name' => $this->category[0]->en_name,
                'slug' => $this->category[0]->slug,
                'az_description' => $this->category[0]->az_description,
                'ru_description' => $this->category[0]->ru_description,
                'en_description' => $this->category[0]->en_description,
            ];
        }
    }

    public function updated()
    {
        $slug = Str::slug($this->formFields['az_name']);
        $this->formFields['slug'] = $slug;
        $this->validate([
            'formFields.icon' => 'max:10240|image',
            'formFields.clasor' => 'required|max:300',
            'formFields.az_name' => 'required|max:300',
            'formFields.ru_name' => 'required|max:300',
            'formFields.en_name' => 'required|max:300',
            'formFields.az_description' => 'required|max:1000',
            'formFields.ru_description' => 'required|max:1000',
            'formFields.en_description' => 'required|max:1000',
        ]);
    }

    public function save()
    {
        $uniqueName = Carbon::now()->getTimestamp() . Str::slug($this->formFields['az_name']);
        $this->formFields['icon']->storeAs('categories/' . $uniqueName, $this->formFields['az_name'] . '.png', 'uploads');
        $this->formFields['icon']->storeAs('categories/' . $uniqueName, $this->formFields['az_name'] . '.png', 'gcs');
        \App\Models\Categories::create([
            'icon' => $this->formFields['az_name'] . '.png',
            'top_category' => $this->formFields['top_category'] ? $this->formFields['top_category'] : 0,
            'clasor' => $uniqueName,
            'az_name' => $this->formFields['az_name'],
            'ru_name' => $this->formFields['ru_name'],
            'en_name' => $this->formFields['en_name'],
            'slug' => $this->formFields['slug'],
            'az_description' => $this->formFields['az_description'],
            'ru_description' => $this->formFields['ru_description'],
            'en_description' => $this->formFields['en_description'],
        ]);
        $this->formFields = [
            'icon' => null,
            'top_category' => null,
            'clasor' => null,
            'az_name' => null,
            'ru_name' => null,
            'en_name' => null,
            'slug' => null,
            'az_description' => null,
            'ru_description' => null,
            'en_description' => null,
        ];
        session()->flash('message', 'Məlumatlar əlavə edildi!');
        $this->redirect('/categories');
    }

    public function update()
    {
        $this->formFields['icon']->storeAs('categories/' . $this->category[0]->clasor, $this->category[0]->icon, 'uploads');
        $this->formFields['icon']->storeAs('categories/' . $this->category[0]->clasor, $this->category[0]->icon, 'gcs');
        \App\Models\Categories::where('id', $this->category[0]->id)->update([
            'top_category' => $this->formFields['top_category'] ? $this->formFields['top_category'] : 0,
            'az_name' => $this->formFields['az_name'],
            'ru_name' => $this->formFields['ru_name'],
            'en_name' => $this->formFields['en_name'],
            'slug' => $this->formFields['slug'],
            'az_description' => $this->formFields['az_description'],
            'ru_description' => $this->formFields['ru_description'],
            'en_description' => $this->formFields['en_description'],
        ]);

        $this->formFields = [
            'icon' => null,
            'top_category' => null,
            'clasor' => null,
            'az_name' => null,
            'ru_name' => null,
            'en_name' => null,
            'slug' => null,
            'az_description' => null,
            'ru_description' => null,
            'en_description' => null,
        ];
        session()->flash('message', 'Məlumatlar dəyişdirildi!');
        $this->redirect('/categories');
    }

    public function render()
    {
        return view('livewire.categories-add-edit');
    }
}
