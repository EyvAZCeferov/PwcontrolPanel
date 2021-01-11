<?php

namespace App\Http\Livewire;

use Kreait\Firebase\Factory;
use Livewire\Component;
use App\User;
use App\Models\UserCards;
use App\Models\UsersPaying;

class Pininfo extends Component
{
    public $userData=null,$pininfo=null,$payinfo=null;

    public function mount($id)
    {
        $userData=User::where('uid',$id)->withTrashed()->first();
        $this->userData = $userData;
        $pininfo=UserCards::where('type','pin')->first();
        $this->pininfo = $pininfo;
        $payinfo=UsersPaying::where('uid',$id)->get();
        $this->payinfo = $payinfo;
    }

    public function resetPin()
    {
        $factory = (new Factory)->withServiceAccount(app_path() . '/Firebase/FirebaseConfig.json')->createDatabase();
        $infoRef = $factory->getReference('users/' .$this->userData->uid . '/cards/'.$this->pininfo->cardId.'/cardInfo/');
        $infoRef->update([
            'price' => 0
        ]);
        $lastDatas=json_decode($this->pininfo->cardInfos);
        $lastDatas['price']=0;
        UsersPaying::where('uid',$id)->update([
            'cardInfos'=>json_encode($lastDatas),
        ]);
        $shopRef = $factory->getReference('users/' .$this->userData->uid . '/cards/'.$this->pininfo->cardId.'/shoppings');
        $orderRef = $factory->getReference('users/' .$this->userData->uid . '/cards/'.$this->pininfo->cardId.'/ordering');
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
