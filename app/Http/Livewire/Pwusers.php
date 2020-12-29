<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Kreait\Firebase\Factory;

class Pwusers extends Component
{

    public function render()
    {
        (new Factory)->withServiceAccount(app_path() . '/Firebase/FirebaseConfig.json')->createAuth()->signInWithEmailAndPassword('getdata@pw.az', 'getdata_123');
        $factory = (new Factory)->withServiceAccount(app_path() . '/Firebase/FirebaseConfig.json')->createAuth();
        $factoryDB = (new Factory)->withServiceAccount(app_path() . '/Firebase/FirebaseConfig.json')->createDatabase();
        $userDat = $factoryDB->getReference('users/');
        $userDatas = $userDat->getValue();
        $users = $factory->listUsers();return view('livewire.pwusers', compact(['users', 'userDatas']));
    }

    public function blockorUnblock($id)
    {
        $factory = (new Factory)->withServiceAccount(app_path() . '/Firebase/FirebaseConfig.json')->createAuth();
        $user = $factory->getUser($id);
        if ($user->disabled) {
            $factory->enableUser($id);
            session()->flash('message', 'Hesab aktivləşdi!');
        } else {
            $factory->disableUser($id);
            session()->flash('message', 'Hesab deaktivləşdi!');
        }
        $this->dispatchBrowserEvent('close-modal');
    }

    public function delete($id)
    {
        $factory = (new Factory)->withServiceAccount(app_path() . '/Firebase/FirebaseConfig.json')->createAuth();
        $factoryDb = (new Factory)->withServiceAccount(app_path() . '/Firebase/FirebaseConfig.json')->createDatabase();
        $user = $factoryDb->getReference('users/' . $id);
        $user->remove();
        $factory->deleteUser($id);
        session()->flash('message', 'Silindi!');
    }

}
