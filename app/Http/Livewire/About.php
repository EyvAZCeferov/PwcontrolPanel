<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\About as AboutPage;
use Livewire\WithFileUploads;



class About extends Component
{
    use WithFileUploads;

    public $about=null,
           $formFields=[
                'about'=>[
                    'images'=>null,
                    'az_title'=>null,
                    'ru_title'=>null,
                    'en_title'=>null,
                    'az_motive'=>null,
                    'ru_motive'=>null,
                    'en_motive'=>null,
                    'az_description'=>null,
                    'ru_description'=>null,
                    'en_description'=>null,
                ],
    ];

    public function mount(){
         $this->about=AboutPage::where('id',1)->get();
    }

    public function aboutUpdate(){
        try{
            AboutPage::create([
                'images'=>$this->formFields['about']['images'],
                'az_title'=>$this->formFields['about']['az_title'],
                'ru_title'=>$this->formFields['about']['ru_title'],
                'en_title'=>$this->formFields['about']['en_title'],
                'az_motive'=>$this->formFields['about']['az_motive'],
                'ru_motive'=>$this->formFields['about']['ru_motive'],
                'en_motive'=>$this->formFields['about']['en_motive'],
                'az_description'=>$this->formFields['about']['az_description'],
                'ru_description'=>$this->formFields['about']['ru_description'],
                'en_description'=>$this->formFields['about']['en_description'],
            ]);
            session()->flash('message', 'Məlumatlar yeniləndi!');
        }catch(\Exception $e){
            session()->flash('message', 'Məlumatlar yenilənmədi!'.$e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.about');
    }
}
