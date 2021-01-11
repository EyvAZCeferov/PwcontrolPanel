<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Kreait\Firebase\Factory;
use Livewire\Component;
use App\User;
use App\Models\UsersCards;
use App\Models\UsersPaying;


class Pwuserinfo extends Component
{
    public $userData = null;
    public $notification = [
        'title' => null,
        'content' => null
    ];

    public function mount($id)
    {
        $userData=User::where('uid',$id)->withTrashed()->first();
        $this->userData = $userData;
    }

    public function sendNotify()
    {
        $this->validate([
            'notification.title' => 'required|min:6|max:300',
            'notification.content' => 'required|min:6|max:400',
        ]);

        $factory = (new Factory)->withServiceAccount(app_path() . '/Firebase/FirebaseConfig.json')->createDatabase();
        $ref = $factory->getReference('users/' . $this->userData->uid . '/notifications/');
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
        $this->mount($this->userData->uid);
    }

    public function delete($id, $type)
    {
        switch ($type) {
            case "cards":
                UserCards::where('cardId',$id)->forceDelete();
                break;
            case "checks":
                UsersPaying::where('pay_id',$id)->forceDelete();
                break;
            default:
                session()->flash('message', 'Xəta yarandı daha sonra yoxlayın!');
        }
        session()->flash('message', 'Seçdiyiniz kart Silindi!');
        $this->mount($this->userData->uid);
    }

    public function render()
    {
        return view('livewire.pwuserinfo');
    }
}
