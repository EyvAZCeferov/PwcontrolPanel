<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Kreait\Firebase\Factory;
use Livewire\Component;
use App\Models\Locations;
use App\Models\Customers;
use Livewire\WithFileUploads;

class EdtAddLocation extends Component
{
    use WithFileUploads;

    public $urlPath = null, $location = null, $customers = null, $formFields = [
        'images' => null,
        'customer_id' => null,
        'az_description' => null,
        'ru_description' => null,
        'en_description' => null,
        'az_location' => null,
        'ru_location' => null,
        'en_location' => null,
        'geometry' => [
            'longitude' => null,
            'latitude' => null,
        ]
    ];

    public function mount($id = null)
    {
        (new Factory)->withServiceAccount(app_path() . '/Firebase/FirebaseConfig.json')->createAuth()->signInWithEmailAndPassword('getdata@pw.az', 'getdata_123');
        $this->urlPath = request()->path();
        $this->customers = Customers::orderBy('created_at', 'DESC')->get();
        if ($id !== null) {
            $this->location = Locations::where('id', $id)->get();
            $geometry = json_decode($this->location[0]->geometry);
            $this->formFields = [
                'customer_id' => $this->location[0]->customer_id,
                'az_description' => $this->location[0]->az_description,
                'ru_description' => $this->location[0]->ru_description,
                'en_description' => $this->location[0]->en_description,
                'az_location' => $this->location[0]->az_location,
                'ru_location' => $this->location[0]->ru_location,
                'en_location' => $this->location[0]->en_location,
                'geometry' => [
                    'longitude' => $geometry->longitude,
                    'latitude' => $geometry->latitude,
                ]
            ];
        }
    }

    public function updated()
    {
        $this->validate([
            'formFields.images.*' => 'max:10240|image',
            'formFields.customer_id' => 'required|integer|max:11',
            'formFields.az_description' => 'required|max:1000',
            'formFields.ru_description' => 'required|max:1000',
            'formFields.en_description' => 'required|max:1000',
            'formFields.az_location' => 'required|max:1000',
            'formFields.ru_location' => 'required|max:1000',
            'formFields.en_location' => 'required|max:1000',
            'formFields.geometry.longitude' => 'required|max:50',
            'formFields.geometry.latitude' => 'required|max:50',
        ]);
    }

    public function save()
    {
        $images = [];
        $date = Carbon::now()->getTimestamp();
        $clasor = $date . Str::slug($this->formFields['az_location']);
        foreach ($this->formFields['images'] as $image) {
            $uniqueName = uniqid();
            $image->storeAs('locations/' . $clasor . '/', $uniqueName . '.png', 'uploads');
            $image->storeAs('locations/' . $clasor . '/', $uniqueName . '.png', 'gcs');
            array_push($images, $uniqueName . '.png');
        }
        $geometry = [
            'longitude' => $this->formFields['geometry']['longitude'],
            'latitude' => $this->formFields['geometry']['latitude'],
        ];

        Locations::create([
            'images' => json_encode($images),
            'customer_id' => $this->formFields['customer_id'],
            'clasor' => $clasor,
            'az_description' => $this->formFields['az_description'],
            'ru_description' => $this->formFields['ru_description'],
            'en_description' => $this->formFields['en_description'],
            'az_location' => $this->formFields['az_location'],
            'ru_location' => $this->formFields['ru_location'],
            'en_location' => $this->formFields['en_location'],
            'geometry' => json_encode($geometry)
        ]);


        $this->formFields = [
            'images' => null,
            'customer_id' => null,
            'az_description' => null,
            'ru_description' => null,
            'en_description' => null,
            'az_location' => null,
            'ru_location' => null,
            'en_location' => null,
            'geometry' => [
                'longitude' => null,
                'latitude' => null,
            ]
        ];
        session()->flash('message', 'Məlumatlar əlavə edildi!');
        $this->redirect('/locations');
    }

    public function update()
    {
        if (array_key_exists('images', $this->formFields)) {
            $images = [];
            $newImages = [];
            foreach ($this->formFields['images'] as $image) {
                $uniqueName = uniqid();
                $image->storeAs('locations/' . $this->location[0]->clasor . '/', $uniqueName . '.png', 'uploads');
                $image->storeAs('locations/' . $this->location[0]->clasor . '/', $uniqueName . '.png', 'gcs');
                array_push($newImages, $uniqueName . '.png');
            }
            $lastDatas = Locations::where('id', $this->location[0]->id)->get();
            $lastImages = json_decode($lastDatas[0]->images);
            $images = array_merge($newImages, $lastImages);
            Locations::where('id', $this->location[0]->id)->update(['images' => json_encode($images)]);
        }
        $geometry = [
            'longitude' => $this->formFields['geometry']['longitude'],
            'latitude' => $this->formFields['geometry']['latitude'],
        ];

        Locations::where('id', $this->location[0]->id)->update([
            'customer_id' => $this->formFields['customer_id'],
            'az_description' => $this->formFields['az_description'],
            'ru_description' => $this->formFields['ru_description'],
            'en_description' => $this->formFields['en_description'],
            'az_location' => $this->formFields['az_location'],
            'ru_location' => $this->formFields['ru_location'],
            'en_location' => $this->formFields['en_location'],
            'geometry' => json_encode($geometry)
        ]);


        $this->formFields = [
            'images' => null,
            'customer_id' => null,
            'az_description' => null,
            'ru_description' => null,
            'en_description' => null,
            'az_location' => null,
            'ru_location' => null,
            'en_location' => null,
            'geometry' => [
                'longitude' => null,
                'latitude' => null,
            ]
        ];

        session()->flash('message', 'Məlumatlar dəyişdirildi!');
        $this->redirect('/locations');
    }

    public function deleteImage($image = null)
    {
        if ($image !== null) {
            $datas = Locations::where('id', $this->location[0]->id)->get();
            $images = $datas[0]->images;
            $array = json_decode($images);
            $images = array_diff($array, array($image));
            Locations::where('id', $this->location[0]->id)->update([
                'images' => array_values($images)]);
            Storage::disk('uploads')->delete('locations/' . $this->location[0]->clasor . '/' . $image);
            Storage::disk('gcs')->delete('locations/' . $this->location[0]->clasor . '/' . $image);
            session()->flash('message', 'Şəkil Silindi!');
            $this->mount($this->location[0]->id);
        }
    }

    public function render()
    {
        return view('livewire.edt-add-location');
    }
}
