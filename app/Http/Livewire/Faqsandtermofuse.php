<?php

namespace App\Http\Livewire;

use Kreait\Firebase\Factory;
use Kreait\Firebase\Auth;
use Livewire\Component;
use App\Models\Faq;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use App\Models\TermofUse;

class Faqsandtermofuse extends Component
{
    use WithFileUploads;

    public $formFields = [
        'faqs' => [
            'image' => null,
            'az_title' => null,
            'ru_title' => null,
            'en_title' => null,
            'az_description' => null,
            'ru_description' => null,
            'en_description' => null,
        ],
        'termofuse'=>[
            'az_description' => null,
            'ru_description' => null,
            'en_description' => null,
        ],
    ], $faqs = null,$termofuse=null;


    public function mount()
    {
        $this->faqs = Faq::orderBy('order', 'DESC')->get();
        $this->termofuse=TermofUse::where('id',1)->first();
        $this->formFields = [
            'faqs' => [
                'image' => null,
                'az_title' => null,
                'ru_title' => null,
                'en_title' => null,
                'az_description' => null,
                'ru_description' => null,
                'en_description' => null,
            ],
            'termofuse'=>[
                'az_description' => $this->termofuse->az_description,
                'ru_description' => $this->termofuse->ru_description,
                'en_description' => $this->termofuse->en_description,
            ],
        ];
    }

    public function faqsAdd()
    {
        try {
            $lastItem = Faq::orderBy('order', 'DESC')->first();
            $lastOrder = 0;
            if ($lastItem) {
                $lastOrder = $lastItem->order;
            }
            Faq::create([
                'az_title' => $this->formFields['faqs']['az_title'],
                'ru_title' => $this->formFields['faqs']['ru_title'],
                'en_title' => $this->formFields['faqs']['en_title'],
                'az_description' => $this->formFields['faqs']['az_description'],
                'ru_description' => $this->formFields['faqs']['ru_description'],
                'en_description' => $this->formFields['faqs']['en_description'],
                'order' => $lastOrder + 1,
                'top_id' => 1,
            ]);
            if (array_key_exists('image', $this->formFields['faqs'])) {
                $uniqueName = uniqid();
                $this->formFields['faqs']['image']->storeAs('about/faqs/', $uniqueName . '.png', 'uploads');
                if($lastItem){
                    Faq::where('id', $lastItem->id + 1)->update([
                        'image' => $uniqueName . '.png',
                    ]);
                }else{
                    Faq::where('id', 1)->update([
                        'image' => $uniqueName . '.png',
                    ]);
                }
            }
            session()->flash('message', 'Məlumatlar əlavə edildi!');
        } catch (\Exception $e) {
            session()->flash('message', 'Məlumatlar əlavə edilmədi!' . $e->getMessage());
        }
        $this->mount();
    }

    public function termofuseupdate(){
        try{
            if($this->termofuse->count()>0){
                TermofUse::where('id',1)->update([
                    'az_description' => $this->formFields['termofuse']['az_description'],
                    'ru_description' => $this->formFields['termofuse']['ru_description'],
                    'en_description' => $this->formFields['termofuse']['en_description'],
                ]);
            }else{
                TermofUse::create([
                    'az_description' => $this->formFields['termofuse']['az_description'],
                    'ru_description' => $this->formFields['termofuse']['ru_description'],
                    'en_description' => $this->formFields['termofuse']['en_description'],
                ]);
            }
            session()->flash('message', 'Məlumatlar yeniləndi!');
        } catch (\Exception $e) {
            session()->flash('message', 'Məlumatlar yenilənmədi!' . $e->getMessage());
        }
    }

    public function deleteContent($id, $type = null)
    {
        try {
            switch ($type) {
                case "faqs":
                    $data = Faq::where('id', $id)->first();
                    if ($data->image) {
                        Storage::disk('uploads')->delete('/about/faqs/' . $data->image);
                    }
                    Faq::where('id', $id)->delete();
                break;
            }
            session()->flash('message', 'Məlumatlar Silindi!');
        } catch (\Exception $e) {
            session()->flash('message', 'Məlumatlar Silinmədi!');
        }
        $this->mount();
    }

    public function render()
    {
        return view('livewire.faqsandtermofuse');
    }
}
