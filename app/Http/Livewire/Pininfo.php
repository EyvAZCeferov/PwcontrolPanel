<?php

namespace App\Http\Livewire;

use Kreait\Firebase\Factory;
use Livewire\Component;

class Pininfo extends Component
{
    public $userData, $userAuth;

    public function mount($id)
    {
        (new Factory)->withServiceAccount(app_path() . '/Firebase/FirebaseConfig.json')->createAuth()->signInWithEmailAndPassword('getdata@pw.az', 'getdata_123');
        $token = (new Factory)->withServiceAccount(app_path() . '/Firebase/FirebaseConfig.json')->createIdTokenVerifier();
        $verify=(new Factory)->withServiceAccount(app_path() . '/Firebase/FirebaseConfig.json')->withGoogleAuthTokenCredentials($token);
        $factory = (new Factory)->withServiceAccount(app_path() . '/Firebase/FirebaseConfig.json')->createDatabase();
        $user = $factory->getReference('users/' . $id);
        $factoryUser = (new Factory)->withServiceAccount(app_path() . '/Firebase/FirebaseConfig.json')->createAuth();
        $this->userAuth = $factoryUser->getUser($id)->jsonSerialize();
        $this->userData = $user->getValue();
    }

    public function resetPin()
    {
        $factory = (new Factory)->withServiceAccount(app_path() . '/Firebase/FirebaseConfig.json')->createDatabase();
        $infoRef = $factory->getReference('users/' . $this->userData['userInfos']['uid'] . '/pinArena/1/cardInfo/');
        $infoRef->update([
            'price' => 0
        ]);
        $shopRef = $factory->getReference('users/' . $this->userData['userInfos']['uid'] . '/pinArena/1/shoppings');
        $orderRef = $factory->getReference('users/' . $this->userData['userInfos']['uid'] . '/pinArena/1/ordering');
        $shopRef->remove();
        $orderRef->remove();
        session()->flash('message', 'Pin Bonusları, Alış-verişləri sıfırlandı!');
        $this->mount($this->userData['userInfos']['uid']);
    }

    public function render()
    {
        return view('livewire.pininfo');
    }
}
