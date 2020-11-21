<?php

namespace App\Http\Livewire;

use App\Models\Locations;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Kreait\Firebase\Factory;
use Livewire\Component;
use Livewire\WithFileUploads;

class PostsEditAdd extends Component
{
    use WithFileUploads;

    public $urlPath = null, $categories = null, $customers = null, $post = null, $formFields = [
        'images' => null,
        'category' => null,
        'customer_id' => null,
        'clasor' => null,
        'az_name' => null,
        'ru_name' => null,
        'en_name' => null,
        'slug' => null,
        'az_description' => null,
        'ru_description' => null,
        'en_description' => null,
        'startTime' => null,
        'endTime' => null,
        'price' => null,
    ];

    public function mount($id = null)
    {
        $this->urlPath = request()->path();
        $this->categories = \App\Models\Categories::all();
        $this->customers = \App\Models\Customers::all();
        if ($id !== null) {
            $this->post = \App\Models\Posts::where('id', $id)->get();
            $this->formFields = [
                'images.*' => $this->post[0]->images,
                'category' => $this->post[0]->category,
                'customer_id' => $this->post[0]->customer_id,
                'clasor' => $this->post[0]->clasor,
                'az_name' => $this->post[0]->az_name,
                'ru_name' => $this->post[0]->ru_name,
                'en_name' => $this->post[0]->en_name,
                'slug' => $this->post[0]->slug,
                'az_description' => $this->post[0]->az_description,
                'ru_description' => $this->post[0]->ru_description,
                'en_description' => $this->post[0]->en_description,
                'startTime' => Carbon::createFromTimestampUTC($this->post[0]->startTime),
                'endTime' => Carbon::createFromTimestampUTC($this->post[0]->endTime),
                'price' => $this->post[0]->price,
            ];
        }
    }

    public function updated()
    {
        (new Factory)->withServiceAccount(app_path() . '/Firebase/FirebaseConfig.json')->createAuth()->signInWithEmailAndPassword('getdata@pw.az', 'getdata_123');
        $slug = Str::slug($this->formFields['az_name']);
        $this->formFields['slug'] = $slug;
        $this->validate([
            'formFields.icon' => 'max:10240|image',
            'formFields.clasor' => 'required|max:300',
            'formFields.customer_id' => 'required|integer|max:11',
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
        $images = [];
        Carbon::setLocale('az');
        $date = Carbon::now()->getTimestamp();
        $clasor = $date . Str::slug($this->formFields['az_name']);
        foreach ($this->formFields['images'] as $image) {
            $uniqueName = uniqid();
            $image->storeAs('posts/' . $clasor . '/', $uniqueName . '.png', 'uploads');
            $image->storeAs('posts/' . $clasor . '/', $uniqueName . '.png', 'gcs');
            array_push($images, $uniqueName . '.png');
        }
        \App\Models\Posts::create([
            'images' => json_encode($images),
            'category' => $this->formFields['category'],
            'customer_id' => $this->formFields['customer_id'],
            'clasor' => $clasor,
            'az_name' => $this->formFields['az_name'],
            'ru_name' => $this->formFields['ru_name'],
            'en_name' => $this->formFields['en_name'],
            'slug' => $this->formFields['slug'],
            'read_count' => 0,
            'az_description' => $this->formFields['az_description'],
            'ru_description' => $this->formFields['ru_description'],
            'en_description' => $this->formFields['en_description'],
            'startTime' => strtotime($this->formFields['startTime']),
            'endTime' => strtotime($this->formFields['endTime']),
            'price' => $this->formFields['price'],
        ]);
        $this->formFields = [
            'images' => null,
            'category' => null,
            'customer_id' => null,
            'clasor' => null,
            'az_name' => null,
            'ru_name' => null,
            'en_name' => null,
            'slug' => null,
            'az_description' => null,
            'ru_description' => null,
            'en_description' => null,
            'startTime' => null,
            'endTime' => null,
            'price' => null,
        ];
        session()->flash('message', 'Məlumatlar əlavə edildi!');
        $this->redirect('/posts');
    }

    public function update()
    {
        Carbon::setLocale('az');
        if (array_key_exists('images', $this->formFields)) {
            $newImages = [];
            foreach ($this->formFields['images'] as $image) {
                $uniqueName = uniqid();
                $image->storeAs('posts/' . $this->post[0]->clasor . '/', $uniqueName . '.png', 'uploads');
                $image->storeAs('posts/' . $this->post[0]->clasor . '/', $uniqueName . '.png', 'gcs');
                array_push($newImages, $uniqueName . '.png');
            }
            $lastDatas = \App\Models\Posts::where('id', $this->post[0]->id)->get();
            $lastImages = json_decode($lastDatas[0]->images);
            $images = array_merge($newImages, $lastImages);
            \App\Models\Posts::where('id', $this->post[0]->id)->update(['images' => json_encode($images)]);
        }
        \App\Models\Posts::where('id', $this->post[0]->id)->update([
            'category' => $this->formFields['category'],
            'customer_id' => $this->formFields['customer_id'],
            'az_name' => $this->formFields['az_name'],
            'ru_name' => $this->formFields['ru_name'],
            'en_name' => $this->formFields['en_name'],
            'slug' => $this->formFields['slug'],
            'az_description' => $this->formFields['az_description'],
            'ru_description' => $this->formFields['ru_description'],
            'en_description' => $this->formFields['en_description'],
            'startTime' => strtotime($this->formFields['startTime']),
            'endTime' => strtotime($this->formFields['endTime']),
            'price' => $this->formFields['price'],
        ]);
        $this->formFields = [
            'images' => null,
            'category' => null,
            'customer_id' => null,
            'clasor' => null,
            'az_name' => null,
            'ru_name' => null,
            'en_name' => null,
            'slug' => null,
            'az_description' => null,
            'ru_description' => null,
            'en_description' => null,
            'startTime' => null,
            'endTime' => null,
            'price' => null,
        ];
        session()->flash('message', 'Məlumatlar əlavə edildi!');
        $this->redirect('/posts');
    }

    public function deleteImage($image = null)
    {
        if ($image !== null) {
            $datas = \App\Models\Posts::where('id', $this->post[0]->id)->get();
            $images = $datas[0]->images;
            $array = json_decode($images);
            $images = array_diff($array, array($image));
            \App\Models\Posts::where('id', $this->post[0]->id)->update([
                'images' => array_values($images)]);
            Storage::disk('uploads')->delete('posts/' . $this->post[0]->clasor . '/' . $image);
            Storage::disk('gcs')->delete('posts/' . $this->post[0]->clasor . '/' . $image);
            session()->flash('message', 'Şəkil Silindi!');
            $this->mount($this->post[0]->id);
        }
    }

    public function render()
    {
        return view('livewire.posts-edit-add');
    }
}
