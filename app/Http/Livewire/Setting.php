<?php

namespace App\Http\Livewire;

use App\Models\Settings;
use Livewire\Component;
use Livewire\WithFileUploads;


class Setting extends Component
{

    use WithFileUploads;

    public $setting = null, $formFields = [
        'projectName' => null,
        'description' => null,
        'adminUrl' => null,
        'logo' => null,
        'phoneNumb' => null,
        'email' => null,
        'facebook_page' => null,
        'instagram_page' => null,
        'youtube_page' => null,
        'twitter_page' => null,
        'copyright' => null,
        'coop_loc' => null,
        'site_address' => null
    ];

    public function mount()
    {
        $settings = Settings::where('id', 1)->get();
        $this->setting = $settings;
        $this->formFields = [
            'projectName' => $settings[0]->projectName,
            'description' => $settings[0]->description,
            'adminUrl' => $settings[0]->adminUrl,
            'logo' => null,
            'phoneNumb' => $settings[0]->phoneNumb,
            'email' => $settings[0]->email,
            'facebook_page' => $settings[0]->facebook_page,
            'instagram_page' => $settings[0]->instagram_page,
            'youtube_page' => $settings[0]->youtube_page,
            'twitter_page' => $settings[0]->twitter_page,
            'copyright' => $settings[0]->copyright,
            'coop_loc' => $settings[0]->coop_loc,
            'site_address' => $settings[0]->site_address
        ];
    }

    public function updateSettings()
    {
        if ($this->formFields['logo'] != null) {
            if (array_key_exists('logo', $this->formFields)) {
                $this->formFields['logo']->storeAs('commons/logos', 'logo.png', 'uploads');
                $this->formFields['logo']->storeAs('commons/logos', 'logo.png', 'gcs');
            }
        }
        Settings::where('id', 1)->update([
            'projectname' => $this->formFields['projectName'],
            'description' => $this->formFields['description'],
            'adminUrl' => $this->formFields['adminUrl'],
            'logo' => 'logo.png',
            'phoneNumb' => $this->formFields['phoneNumb'],
            'email' => $this->formFields['email'],
            'facebook_page' => $this->formFields['facebook_page'],
            'instagram_page' => $this->formFields['instagram_page'],
            'youtube_page' => $this->formFields['youtube_page'],
            'twitter_page' => $this->formFields['twitter_page'],
            'copyright' => $this->formFields['copyright'],
            'coop_loc' => $this->formFields['coop_loc'],
            'site_address' => $this->formFields['site_address']
        ]);
        session()->flash('message', 'Məlumatlar dəyişdirildi!');
    }

    public function render()
    {
        return view('livewire.setting');
    }
}
