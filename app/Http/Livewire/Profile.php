<?php

namespace App\Http\Livewire;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Kreait\Firebase\Factory;
use Livewire\Component;

class Profile extends Component
{
    public $user, $formFields = [
        'profPic' => null,
        'name' => null,
        'email' => null,
        'password' => [
            'oldpassword' => null,
            'password' => null,
            'password_confirmation' => null,
        ],

    ];

    public function mount()
    {
        $token = (new Factory)->withServiceAccount(app_path() . '/Firebase/FirebaseConfig.json')->createAuth()->signInWithEmailAndPassword('getdata@pw.az', 'getdata_123')->idToken();
        $user = (new Factory)->withServiceAccount(app_path() . '/Firebase/FirebaseConfig.json')->createAuth()->verifyIdToken($token);
        if ($user) {
            $id = Auth::user()->id;
            $this->user = User::where('id', $id)->get();
            $this->formFields = [
                'profPic' => $this->user[0]->profilePhoto,
                'name' => $this->user[0]->name,
                'email' => $this->user[0]->email,
            ];
        }
    }

    public function updated()
    {
        $this->validate([
            'formFields.name' => 'required|max:300',
            'formFields.email' => 'required|max:300|email',
            'formFields.password.password' => 'min:8',
            'formFields.password.password_confirmation' => 'min:8|required_with:formFields.password.password|same:formFields.password.password|string|confirmed'
        ]);
    }

    public function change()
    {
        $id = Auth::user()->id;
        if (array_key_exists('oldpassword', $this->formFields['password'])) {
            if ($this->formFields['password']['oldpassword'] !== null) {
                if (Hash::check($this->formFields['password']['password1'], $this->user->password)) {
                    User::where('id', $id)->update([
                        'email' => $this->formFields['email'],
                        'name' => $this->formFields['name'],
                        'password' => Hash::make($this->formFields['password']),
                    ]);
                }
            } else {
                session()->flash('message', 'Əvvəlki parolu daxil edin!');
            }
        } else {
            User::where('id', $id)->update([
                'email' => $this->formFields['email'],
                'name' => $this->formFields['name'],
            ]);
        }
        $this->formFields = [
            'profPic' => null,
            'name' => null,
            'email' => null,
            'password' => [
                'oldpassword' => null,
                'password1' => null,
                'password2' => null,
            ],
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
