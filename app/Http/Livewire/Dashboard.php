<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Kreait\Firebase\Factory;
use Livewire\Component;

class Dashboard extends Component
{
    public $allUsers, $onlineUsers, $checks = [];

    public function mount()
    {
        $httpConfig = [
            'proxy' => [
                'http' => env('APP_URL'),
                'https' => env('APP_HTTPS_URL'),
            ],
            'debug' => true
        ];
        (new Factory)->withServiceAccount(app_path() . '/Firebase/FirebaseConfig.json')->createAuth()->signInWithEmailAndPassword('getdata@pw.az', 'getdata_123');
        $factory = (new Factory)->withServiceAccount(app_path() . '/Firebase/FirebaseConfig.json')->createAuth();
        $factoryDB = (new Factory)->withServiceAccount(app_path() . '/Firebase/FirebaseConfig.json')->createDatabase();
        $userDatas = $factoryDB->getReference('users/')->getValue();
        $onlineUsers = [];
        foreach ($factory->listUsers() as $user) {
            $time = Carbon::now()->getTimestamp() - $user->metadata->lastRefreshAt->getTimestamp();
            if ($time <= 24000) {
                array_push($onlineUsers, $user);
            }
        }
        if (is_null($onlineUsers)) {
            $this->onlineUsers = 0;
        } else {
            $this->onlineUsers = count($onlineUsers);
        }
        foreach ($userDatas as $user) {
            $checks = $factoryDB->getReference('users/' . $user['userInfos']['uid'] . '/checks/');
            foreach ($checks as $check) {
                $oneCheck = $factoryDB->getReference('users/' . $user['userInfos']['uid'] . '/checks/' . $check->checkId);
                array_push($this->checks, $oneCheck);
            }
        }
        $this->allUsers = $userDatas;
    }

    public function render()
    {
        return view('livewire.dashboard');
    }
}
