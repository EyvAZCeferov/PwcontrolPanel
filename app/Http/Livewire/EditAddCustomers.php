<?php

namespace App\Http\Livewire;

use App\Models\Customers;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditAddCustomers extends Component
{
    use WithFileUploads;

    public $urlPath = null, $customer = null, $formFields = [
        'logo' => null,
        'az_name' => null,
        'ru_name' => null,
        'en_name' => null,
    ];

    public function mount($id = null)
    {
        $this->urlPath = request()->path();
        if ($id !== null) {
            $this->customer = Customers::where('id', $id)->get();
            $this->formFields = [
                'az_name' => $this->customer[0]->az_name,
                'ru_name' => $this->customer[0]->ru_name,
                'en_name' => $this->customer[0]->en_name,
            ];
        }
    }

    public function validate($rules, $messages = [], $attributes = [])
    {
        $rules = [
            'formFields.logo' => 'required|max:10240|image',
            'formFields.az_name' => 'required|max:300',
            'formFields.ru_name' => 'required|max:300',
            'formFields.en_name' => 'required|max:300',
        ];
    }

    public function save()
    {
        $uniqueName = uniqid();
        $this->formFields['logo']->storeAs('customers', $uniqueName . '.png', 'uploads');
        $this->formFields['logo']->storeAs('customers', $uniqueName . '.png', 'gcs');
        Customers::create([
            'logo' => $uniqueName . '.png',
            'az_name' => $this->formFields['az_name'],
            'ru_name' => $this->formFields['ru_name'],
            'en_name' => $this->formFields['en_name'],
        ]);
        $this->formFields = [
            'logo' => null,
            'az_name' => null,
            'ru_name' => null,
            'en_name' => null,
        ];
        session()->flash('message', 'Məlumatlar əlavə edildi!');
        $this->redirect('/customers');
    }

    public function update()
    {
        if (array_key_exists('logo', $this->formFields)) {
            $this->formFields['logo']->storeAs('customers', $this->customer[0]->logo, 'uploads');
            $this->formFields['logo']->storeAs('customers', $this->customer[0]->logo, 'gcs');
        }
        Customers::where('id', $this->customer[0]->id)->update([
            'az_name' => $this->formFields['az_name'],
            'ru_name' => $this->formFields['ru_name'],
            'en_name' => $this->formFields['en_name'],
        ]);
        $this->formFields = [
            'logo' => null,
            'az_name' => null,
            'ru_name' => null,
            'en_name' => null,
        ];
        session()->flash('message', 'Məlumatlar dəyişdirildi!');
        $this->redirect('/customers');
    }

    public function render()
    {
        return view('livewire.edit-add-customers');
    }
}
