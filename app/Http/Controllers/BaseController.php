<?php

namespace App\Http\Controllers;

use App\Models\Teams;
use App\Admins;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Session;
use App\Models\WhyChooseUsItems;
use App\Models\Faq;

class BaseController extends Controller
{
    public function logout()
    {
        Auth::guard('admins')->logout();
        return redirect('/login');
    }

    public function login()
    {
        return view('common.login');
    }

    public function loginAcc(Request $request)
    {
        $cred = $request->only('email', 'password');
        $userData = Admins::where('email', $cred['email'])->first();
        if ($userData != null) {
            $user = Admins::find($userData['id']);
            if (Hash::check($request->password, $user->password, [])) {
                if ($request->remember == 'on') {
                    Auth::guard('admins')->login($user,true);
                    return redirect('/');
                } else {
                    Auth::guard('admins')->login($user,false);
                    return redirect('/');
                }
            } else {
                session()->flash('message', 'Daxil etdiyiniz şifrə yanlışdır!');
                return redirect('/login');
            }
        } else {
            session()->flash('message', 'Daxil etdiyiniz email vəya şifrə bazamızda tapılmadı!');
            return redirect('/login');
        }
    }

    public function changeLocale($locale)
    {
        App::setLocale($locale);
        Session::put('localization', $locale);
        return redirect('/');
    }

    public function changeWHYCHOOSEOrder(Request $request)
    {
        try {
            foreach ($request->get('whychooseus_order') as $key => $id) {
                WhyChooseUsItems::where('id', $id)->update(['order' => $key]);
            }
            session()->flash('message', 'Məlumatlar Dəyişdirildi!');

        } catch (\Exception $e) {
            session()->flash('message', 'Məlumatlar Dəyişdirilmədi!');
        }
    }

    public function changeTEAMMEMBEROrder(Request $request)
    {
        try {
            foreach ($request->get('teams_order') as $key => $id) {
                Teams::where('id', $id)->update(['order' => $key]);
            }
            session()->flash('message', 'Məlumatlar Dəyişdirildi!');

        } catch (\Exception $e) {
            session()->flash('message', 'Məlumatlar Dəyişdirilmədi!');
        }
    }

    public function changeFAQSOrder(Request $request)
    {
        try {
            foreach ($request->get('faqs_order') as $key => $id) {
                Faq::where('id', $id)->update(['order' => $key]);
            }
            session()->flash('message', 'Məlumatlar Dəyişdirildi!');
        } catch (\Exception $e) {
            session()->flash('message', 'Məlumatlar Dəyişdirilmədi!');
        }
    }

    function fallback()
    {
        return view('common.404');
    }
}
