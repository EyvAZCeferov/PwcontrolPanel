<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class BaseController extends Controller
{
    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }

    public function login()
    {
        return view('common.login');
    }

    public function loginAcc(Request $request)
    {
        $cred = $request->only('email', 'password');
        $userData = User::where('email', $cred['email'])->get();
        if ($userData !== null) {
            $user = User::find($userData[0]['id']);
            if (Hash::check($request->password, $user->password, [])) {
                if ($request->remember == 'on') {
                    Auth::login($user, true);
                    return redirect('/');
                } else {
                    Auth::login($user, false);
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
}
