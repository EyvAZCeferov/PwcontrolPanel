<?php

namespace App\Http\Livewire;

use Kreait\Firebase\Factory;
use Kreait\Firebase\Auth;
use Livewire\Component;
use App\Models\Faq;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;


class Faqsandtermofuse extends Component
{
    use WithFileUploads;

    public $formFields = [
        'faqs' => [
            'image' => null,
            'az_title' => null,
            'ru_title' => null,
            'en_title' => null,
            'az_description' => null,
            'ru_description' => null,
            'en_description' => null,
        ],
    ], $faqs = null, $user = null;


    public function mount()
    {
        $this->faqs = Faq::orderBy('order', 'DESC')->get();
    }

    public function faqsAdd()
    {
        try {
            $lastItem = Faq::orderBy('order', 'DESC')->first();
            $lastOrder = 0;
            if ($lastItem->count() > 0) {
                $lastOrder = $lastItem->order;
            }
            Faq::create([
                'az_title' => $this->formFields['faqs']['az_title'],
                'ru_title' => $this->formFields['faqs']['ru_title'],
                'en_title' => $this->formFields['faqs']['en_title'],
                'az_description' => $this->formFields['faqs']['az_description'],
                'ru_description' => $this->formFields['faqs']['ru_description'],
                'en_description' => $this->formFields['faqs']['en_description'],
                'order' => $lastOrder + 1,
                'top_id' => 1,
            ]);
            if (array_key_exists('image', $this->formFields['faqs'])) {
                $uniqueName = uniqid();
                $this->formFields['faqs']['image']->storeAs('about/faqs/', $uniqueName . '.png', 'uploads');
                Faq::where('id', $lastItem->id + 1)->update([
                    'image' => $uniqueName . '.png',
                ]);
            }
            session()->flash('message', 'Məlumatlar əlavə edildi!');
        } catch (\Exception $e) {
            session()->flash('message', 'Məlumatlar əlavə edilmədi!' . $e->getMessage());
        }
        $this->mount();
    }

    public function deleteContent($id, $type = null)
    {
        try {
            switch ($type) {
                case "faqs":
                    $data = Faq::where('id', $id)->first();
                    if ($data->image) {
                        Storage::disk('gcs')->delete('/about/faqs/' . $data->image);
                    }
                    Faq::where('id', $id)->delete();
                    break;
                case "termofuse":
                    $data = Faq::where('id', $id)->first();
                    if ($data->icon) {
                        Storage::disk('gcs')->delete('/about/teams/' . $data->icon);
                    }
                    Faq::where('id', $id)->delete();
                    break;
            }
            session()->flash('message', 'Məlumatlar Silindi!');
        } catch (\Exception $e) {
            session()->flash('message', 'Məlumatlar Silinmədi!');
        }
        $this->mount();
    }

    public function getUser(Auth $auth){
        $signInResult=(new Factory)->withServiceAccount(app_path() . '/Firebase/FirebaseConfig.json')->createAuth()->signInWithEmailAndPassword('getdata@pw.az', 'getdata_123');
        $idToken=$signInResult->idToken(); // string|null
        $firebaseUserId=$signInResult->firebaseUserId(); // string|null
        $accessToken=$signInResult->accessToken(); // string|null
        $refreshToken=$signInResult->refreshToken(); // string|null
        $data=$signInResult->data(); // array
        $asTokenResponse=$signInResult->asTokenResponse(); // array
        $facAuth=(new Factory)->withServiceAccount(app_path() . '/Firebase/FirebaseConfig.json')->createAuth();
        $signInResult2=$facAuth->signInWithRefreshToken($refreshToken);
        $idToken=$signInResult2->idToken(); // string|null
        $firebaseUserId=$signInResult2->firebaseUserId(); // string|null
        $accessToken=$signInResult2->accessToken(); // string|null
        $refreshToken=$signInResult2->refreshToken(); // string|null
        $data=$signInResult2->data(); // array
        $asTokenResponse=$signInResult2->asTokenResponse(); // array
        dd($data);
    }

    public function render()
    {
        return view('livewire.faqsandtermofuse');
    }
}
