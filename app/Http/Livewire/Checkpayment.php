<?php

namespace App\Http\Livewire;

use Kreait\Firebase\Factory;

use Livewire\Component;

class Checkpayment extends Component
{
    public $userData;
    public $check;

    public function mount($userid, $checkid)
    {
        (new Factory)->withServiceAccount(app_path() . '/Firebase/FirebaseConfig.json')->createAuth()->signInWithEmailAndPassword('getdata@pw.az', 'getdata_123');
        $token = (new Factory)->withServiceAccount(app_path() . '/Firebase/FirebaseConfig.json')->createIdTokenVerifier();
        $verify=(new Factory)->withServiceAccount(app_path() . '/Firebase/FirebaseConfig.json')->withGoogleAuthTokenCredentials($token);
        $factory = (new Factory)->withServiceAccount(app_path() . '/Firebase/FirebaseConfig.json')->createDatabase();
        $refUs = $factory->getReference('users/' . $userid);
        $refCheck = $factory->getReference('users/' . $userid . '/checks/' . $checkid . '/');
        $this->userData = $refUs->getValue();
        $this->check = $refCheck->getValue();

    }

    public function render()
    {
        return view('livewire.checkpayment');
    }
}
