<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Comments as Comment;


class Comments extends Component
{
    public $customers=null,$deleted=false,$campaigns=null;

    public function mount(){
        if (!$this->deleted) {
            $this->customers=Comment::where('table','customers')->with(['get_customer','get_campaign'])->get();
            $this->campaigns=Comment::where('table','posts')->with(['get_campaign','get_customer'])->get();
        }else{
            $this->customers=Comment::onlyTrashed()->where('table','customers')->with(['get_customer','get_campaign'])->get();
            $this->campaigns=Comment::onlyTrashed()->where('table','posts')->with(['get_customer','get_campaign'])->get();
        }
    }

    public function render()
    {
        $this->mount();
        return view('livewire.comments');
    }

    public function delete($id,$type=null){
        try{
            switch ($type) {
                case 'customers':
                    Comment::where('table','customers')->where('id',$id)->delete();
                    break;
                case 'campaigns':
                    Comment::where('table','posts')->where('id',$id)->delete();
                    break;
                default:
                    # code...
                    break;
            }
            session()->flash('message', 'Məlumatlar silindi!');
        } catch (\Exception $e) {
            session()->flash('message', 'Məlumatlar silinmədi!' . $e->getMessage());
        }
        $this->mount();
    }

    public function hardDelete($id,$type=null){
        try{
            switch ($type) {
                case 'customers':
                    Comment::where('table','customers')->where('id',$id)->onlyTrashed()->forceDelete();
                    break;
                case 'campaigns':
                    Comment::where('table','posts')->where('id',$id)->onlyTrashed()->forceDelete();
                    break;
                default:
                    # code...
                    break;
            }
            session()->flash('message', 'Məlumatlar birdəfəlik silindi!');
        } catch (\Exception $e) {
            session()->flash('message', 'Məlumatlar birdəfəlik silinmədi!' . $e->getMessage());
        }
        $this->mount();
    }

    public function recover($id,$type=null){
        try{
            switch ($type) {
                case 'customers':
                    Comment::where('table','customers')->where('id',$id)->onlyTrashed()->restore();
                    break;
                case 'campaigns':
                    Comment::where('table','posts')->where('id',$id)->onlyTrashed()->restore();
                    break;
                default:
                    # code...
                    break;
            }
            session()->flash('message', 'Məlumatlar geri qaytarıldi!');
        } catch (\Exception $e) {
            session()->flash('message', 'Məlumatlar geri qaytarılmadi!' . $e->getMessage());
        }
        $this->mount();
    }

}
