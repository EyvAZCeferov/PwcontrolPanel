<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Kreait\Firebase\Factory;
use App\User;

class Pwusers extends Component
{
    public $users=null;

    public function mount(){
        $this->users=User::orderBy('created_at','DESC')->withTrashed()->with('get_cards')->get();
    }

    public function render()
    {
        return view('livewire.pwusers');
    }

    public function blockorUnblock($id)
    {
        try{
            $userData=User::where('uid',$id)->withTrashed()->first();
            if ($userData->trashed()) {
                User::where('uid',$id)->onlyTrashed()->restore();
                session()->flash('message', 'Hesab aktivləşdi!');
            } else {
                User::where('uid',$id)->delete();
                session()->flash('message', 'Hesab deaktivləşdi!');
            }
        }catch(\Exception $e){
            session()->flash('message', \Lang::get('static.formFields.actions.error').$e->getMessage());
        }
        $this->mount();
    }

    public function delete($id)
    {
        try{
            $factoryDb = (new Factory)->withServiceAccount(app_path() . '/Firebase/FirebaseConfig.json')->createDatabase();
            $user = $factoryDb->getReference('users/' . $id);
            $user->remove();
            User::where('uid',$id)->onlyTrashed()->remove();
            session()->flash('message', 'Silindi!');
        }catch(\Exception $e){
            session()->flash('message', \Lang::get('static.formFields.actions.error').$e->getMessage());
        }
        $this->mount();
    }

}
