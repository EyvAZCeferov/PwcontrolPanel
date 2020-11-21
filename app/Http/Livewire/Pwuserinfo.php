<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Kreait\Firebase\Factory;
use Livewire\Component;

class Pwuserinfo extends Component
{
    public $userData = null;
    public $userAuth = null;
    public $notification = [
        'title' => null,
        'content' => null
    ];

    public function mount($id)
    {
        (new Factory)->withServiceAccount(app_path() . '/Firebase/FirebaseConfig.json')->createAuth()->signInWithEmailAndPassword('getdata@pw.az', 'getdata_123');
        $factory = (new Factory)->withServiceAccount(app_path() . '/Firebase/FirebaseConfig.json')->createDatabase();
        $factoryUser = (new Factory)->withServiceAccount(app_path() . '/Firebase/FirebaseConfig.json')->createAuth();
        $user = $factory->getReference('users/' . $id);
        $this->userAuth = $factoryUser->getUser($id)->jsonSerialize();
        $this->userData = $user->getValue();
    }

    public function sendNotify()
    {
        $this->validate([
            'notification.title' => 'required|min:6|max:300',
            'notification.content' => 'required|min:6|max:400',
        ]);

        $factory = (new Factory)->withServiceAccount(app_path() . '/Firebase/FirebaseConfig.json')->createDatabase();
        $ref = $factory->getReference('users/' . $this->userData['userInfos']['uid'] . '/notifications/');
        $key = $ref->push()->getKey();
        $ref->getChild($key)->set(
            [
                "id" => $key,
                "title" => $this->notification['title'],
                "content" => $this->notification['content'],
                "created_at" => Carbon::now(),
            ]
        );
        session()->flash('message', 'Notifikasiya göndərildi!');
        $this->notification = [
            'title' => null,
            'content' => null
        ];
    }

    public function delete($id, $type)
    {
        $factory = (new Factory)->withServiceAccount(app_path() . '/Firebase/FirebaseConfig.json')->createDatabase();
        switch ($type) {
            case "cards":
                $ref = $factory->getReference('users/' . $this->userData['userInfos']['uid'] . '/cards/' . $id);
                $ref->remove();
                break;
            case "bonuses":
                $ref = $factory->getReference('users/' . $this->userData['userInfos']['uid'] . '/bonuses/' . $id);
                $ref->remove();
                break;
            case "checks":
                $ref = $factory->getReference('users/' . $this->userData['userInfos']['uid'] . '/checks/' . $id);
                $ref->remove();
                break;
            default:
                session()->flash('message', 'Xəta yarandı daha sonra yoxlayın!');
        }
        session()->flash('message', 'Seçdiyiniz kart Silindi!');
        $this->mount($this->userData['userInfos']['uid']);
    }

    public function render()
    {
        return view('livewire.pwuserinfo');
    }
}
