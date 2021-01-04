<?php

namespace App\Http\Livewire;

use App\Models\Teams;
use Livewire\Component;
use App\Models\About as AboutPage;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use App\Models\WhyChooseUs;
use App\Models\WhyChooseUsItems;


class About extends Component
{
    use WithFileUploads;

    public $about = null,
        $whychooseus = null,
        $teams = null,
        $social = [
        'facebook',
        'instagram',
        'twitter',
        'email',
    ],
        $formFields = [
        'about' => [
            'images' => null,
            'az_title' => null,
            'ru_title' => null,
            'en_title' => null,
            'az_motive' => null,
            'ru_motive' => null,
            'en_motive' => null,
            'az_description' => null,
            'ru_description' => null,
            'en_description' => null,
        ],
        'whychooseus' => [
            'items' => [
                'icon' => null,
                'top_id' => 1,
                'az_title' => null,
                'ru_title' => null,
                'en_title' => null,
                'az_description' => null,
                'ru_description' => null,
                'en_description' => null,
                'order' => null,
            ],
            'table' => [
                'az_title' => null,
                'ru_title' => null,
                'en_title' => null,
                'cover_image' => null,
            ],
        ],
        'teams' => [
            'image' => null,
            'az_title' => null,
            'ru_title' => null,
            'en_title' => null,
            'social' => [
                'facebook' => null,
                'instagram' => null,
                'twitter' => null,
                'email' => null,
                'whatsapp' => null
            ],
            'az_description' => null,
            'ru_description' => null,
            'en_description' => null,
            'order' => null,
        ],
    ];

    public function mount()
    {
        $this->about = AboutPage::where('id', 1)->get();
        $this->whychooseus = WhyChooseUs::where('id', 1)->with('getItems')->get();
        $this->teams = Teams::all();
        $this->formFields = [
            'about' => [
                'images' => $this->about[0]->images,
                'az_title' => $this->about[0]->az_title,
                'ru_title' => $this->about[0]->ru_title,
                'en_title' => $this->about[0]->en_title,
                'az_motive' => $this->about[0]->az_motive,
                'ru_motive' => $this->about[0]->ru_motive,
                'en_motive' => $this->about[0]->en_motive,
                'az_description' => $this->about[0]->az_description,
                'ru_description' => $this->about[0]->ru_description,
                'en_description' => $this->about[0]->en_description,
            ],
            'whychooseus' => [
                'table' => [
                    'az_title' => $this->whychooseus[0]->az_title,
                    'ru_title' => $this->whychooseus[0]->ru_title,
                    'en_title' => $this->whychooseus[0]->en_title,
                    'cover_image' => $this->whychooseus[0]->cover_image,
                ],
                'items' => [
                    'icon' => null,
                    'top_id' => 1,
                    'az_title' => null,
                    'ru_title' => null,
                    'en_title' => null,
                    'az_description' => null,
                    'ru_description' => null,
                    'en_description' => null,
                    'order' => null,
                ],
            ],
            'teams' => [
                'image' => null,
                'az_title' => null,
                'ru_title' => null,
                'en_title' => null,
                'social' => [
                    'facebook' => null,
                    'instagram' => null,
                    'twitter' => null,
                    'email' => null,
                    'whatsapp' => null
                ],
                'az_description' => null,
                'ru_description' => null,
                'en_description' => null,
                'order' => null,
            ],
        ];
    }

    public function aboutUpdate()
    {
        try {
            if ($this->formFields['about']['images'] != null) {
                if (array_key_exists('images', $this->formFields['about'])) {
                    $newImages = [];
                    foreach ($this->formFields['about']['images'] as $image) {
                        $uniqueName = uniqid();
                        $image->storeAs('about/' . 'aboutImages/', $uniqueName . '.png', 'uploads');
                        $image->storeAs('about/' . 'aboutImages/', $uniqueName . '.png', 'gcs');
                        array_push($newImages, $uniqueName . '.png');
                    }
                    $lastDatas = AboutPage::where('id', 1)->get();
                    $lastImages = json_decode($lastDatas[0]->images);
                    $images = array_merge($newImages, $lastImages);
                    AboutPage::where('id', 1)->update(['images' => json_encode($images)]);
                }
            }
            AboutPage::where('id', 1)->update([
                'az_title' => $this->formFields['about']['az_title'],
                'ru_title' => $this->formFields['about']['ru_title'],
                'en_title' => $this->formFields['about']['en_title'],
                'az_motive' => $this->formFields['about']['az_motive'],
                'ru_motive' => $this->formFields['about']['ru_motive'],
                'en_motive' => $this->formFields['about']['en_motive'],
                'az_description' => $this->formFields['about']['az_description'],
                'ru_description' => $this->formFields['about']['ru_description'],
                'en_description' => $this->formFields['about']['en_description'],
            ]);
            session()->flash('message', 'Məlumatlar yeniləndi!');
        } catch (\Exception $e) {
            session()->flash('message', 'Məlumatlar yenilənmədi!' . $e->getMessage());
        }
    }

    public function whyChooseUsUpdate()
    {
        try {
            if (array_key_exists('cover_image', $this->formFields['whychooseus']['table'])) {
                $uniqueName = uniqid();
                $this->formFields['whychooseus']['table']['cover_image']->storeAs('about/whychooseus/table/', $uniqueName . '.png', 'uploads');
                WhyChooseUs::where('id', 1)->update([
                    'cover_image' => $uniqueName . '.png',
                ]);
            }
            WhyChooseUs::where('id', 1)->update([
                'az_title' => $this->formFields['whychooseus']['table']['az_title'],
                'ru_title' => $this->formFields['whychooseus']['table']['ru_title'],
                'en_title' => $this->formFields['whychooseus']['table']['en_title'],
            ]);
            session()->flash('message', 'Məlumatlar yeniləndi!');
        } catch (\Exception $e) {
            session()->flash('message', 'Məlumatlar yenilənmədi!' . $e->getMessage());
        }
        $this->mount();
    }

    public function whyChooseUsItemAdd()
    {
        try {
            $lastItem = WhyChooseUsItems::orderBy('id', 'DESC')->first();
            $lastOrder = 0;
            if ($lastItem->count() > 0) {
                $lastOrder = $lastItem->order;
            }
            WhyChooseUsItems::create([
                'az_title' => $this->formFields['whychooseus']['items']['az_title'],
                'ru_title' => $this->formFields['whychooseus']['items']['ru_title'],
                'en_title' => $this->formFields['whychooseus']['items']['en_title'],
                'az_description' => $this->formFields['whychooseus']['items']['az_description'],
                'ru_description' => $this->formFields['whychooseus']['items']['ru_description'],
                'en_description' => $this->formFields['whychooseus']['items']['en_description'],
                'order' => $lastOrder + 1,
                'top_id' => 1,
            ]);
            if (array_key_exists('icon', $this->formFields['whychooseus']['items'])) {
                $uniqueName = uniqid();
                $this->formFields['whychooseus']['items']['icon']->storeAs('about/whychooseus/items/', $uniqueName . '.png', 'uploads');
                WhyChooseUsItems::where('id', $lastItem->id + 1)->update([
                    'icon' => $uniqueName . '.png',
                ]);
            }
            session()->flash('message', 'Məlumatlar əlavə edildi!');
        } catch (\Exception $e) {
            session()->flash('message', 'Məlumatlar əlavə edilmədi!' . $e->getMessage());
        }
        $this->mount();
    }

    public function teammemberAdd()
    {
        try {
            $lastItem = Teams::orderBy('id', 'DESC')->first();
            if (!$lastItem) {
                $lastItem['id'] = 0;
            }
            $lastOrder = 0;
            if ($lastItem) {
                $lastOrder = $lastItem->order;
            }
            $social = [
                'facebook' => $this->formFields['teams']['social']['facebook'],
                'instagram' => $this->formFields['teams']['social']['instagram'],
                'twitter' => $this->formFields['teams']['social']['twitter'],
                'email' => $this->formFields['teams']['social']['email'],
                'whatsapp' => $this->formFields['teams']['social']['whatsapp']
            ];
            Teams::create([
                'az_title' => $this->formFields['teams']['az_title'],
                'ru_title' => $this->formFields['teams']['ru_title'],
                'en_title' => $this->formFields['teams']['en_title'],
                'social' => json_encode($social),
                'az_description' => $this->formFields['teams']['az_description'],
                'ru_description' => $this->formFields['teams']['ru_description'],
                'en_description' => $this->formFields['teams']['en_description'],
                'order' => $lastOrder + 1,
                'top_id' => 1,
            ]);
            if (array_key_exists('image', $this->formFields['teams'])) {
                $uniqueName = uniqid();
                $this->formFields['teams']['image']->storeAs('about/teams/', $uniqueName . '.png', 'uploads');
                Teams::where('id', $lastItem->id + 1)->update([
                    'image' => $uniqueName . '.png',
                ]);
            }
            session()->flash('message', 'Məlumatlar əlavə edildi!');
        } catch (\Exception $e) {
            session()->flash('message', 'Məlumatlar əlavə edilmədi!' . $e->getMessage());
        }
        $this->mount();
    }

    public function deleteContent($id, $type = null)
    {
        try {
            switch ($type) {
                case "whychooseus":
                    $data = WhyChooseUsItems::where('id', $id)->first();
                    if ($data->icon) {
                        Storage::disk('gcs')->delete('/about/whychooseus/items/' . $data->icon);
                    }
                    WhyChooseUsItems::where('id', $id)->delete();
                    break;
                case "teams":
                    $data = Teams::where('id', $id)->first();
                    if ($data->icon) {
                        Storage::disk('gcs')->delete('/about/teams/' . $data->icon);
                    }
                    Teams::where('id', $id)->delete();
                    break;
            }
            session()->flash('message', 'Məlumatlar Silindi!');
        } catch (\Exception $e) {
            session()->flash('message', 'Məlumatlar Silinmədi!');
        }
        $this->mount();
    }

    public function deleteImage($image = null, $type = null)
    {
        if ($image !== null) {
            switch ($type) {
                case 'about':
                    $datas = AboutPage::where('id', 1)->get();
                    $images = $datas[0]->images;
                    $array = json_decode($images);
                    $images = array_diff($array, array($image));
                    AboutPage::where('id', 1)->update([
                        'images' => array_values($images)]);
                    Storage::disk('uploads')->delete('about/' . 'aboutImages/' . $image);
                    Storage::disk('gcs')->delete('about/' . 'aboutImages/' . $image);
                    break;
                default:
                    session()->flash('message', 'Şəkil Silinmədi!');
                    break;
            }
            session()->flash('message', 'Şəkil Silindi!');
            $this->mount();
        }
    }

    public function render()
    {
        return view('livewire.about');
    }
}
