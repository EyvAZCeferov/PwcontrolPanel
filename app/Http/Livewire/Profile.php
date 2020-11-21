<?php

namespace App\Http\Livewire;

use App\User;
use Illuminate\Support\Facades\Auth;
use Kreait\Firebase\Factory;
use Livewire\Component;

class Profile extends Component
{
    public $user, $formFields = [
        'profPic' => null,
        'name' => null,
        'email' => null,
        'password' => null,
    ];

    public function mount()
    {
        (new Factory)->withServiceAccount(app_path() . '/Firebase/FirebaseConfig.json')->createAuth()->signInWithEmailAndPassword('getdata@pw.az', 'getdata_123');
        $id = Auth::user()->id;
        $this->user = User::where('id', $id)->get();
        $this->formFields = [
            'profPic' => $this->user[0]->profilePhoto,
            'name' => $this->user[0]->name,
            'email' => $this->user[0]->email,
        ];
    }

    public function updated()
    {
        $this->validate([
            'formFields.name' => 'required|max:300',
            'formFields.email' => 'required|max:300|email',
        ]);
    }

    public function change()
    {
        if (array_key_exists('password', $this->formFields)) {
            $id = Auth::user()->id;
            User::where('id', $id)->update([
                'email' => $this->formFields['email'],
                'name' => $this->formFields['name'],
            ]);
        } else {
            $id = Auth::user()->id;
            User::where('id', $id)->update([
                'email' => $this->formFields['email'],
                'name' => $this->formFields['name'],
                'password' => $this->formFields['password'],
            ]);
        }
        $this->formFields = [
            'profPic' => null,
            'name' => null,
            'email' => null,
            'password' => null,
        ];
        session()->flash('message', 'Məlumatlar dəyişdirildi!');
    }

    public function changeProfPic()
    {
        $profPic = Auth::user()->profPic;
        $this->formFields['profPic']->storeAs('admins', $profPic, 'uploads');
        session()->flash('message', 'Şəkil dəyişdirildi!');
    }

    public function render()
    {
        return view('livewire.profile');
    }
}
