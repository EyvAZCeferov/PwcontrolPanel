<?php

namespace App\Http\Controllers\Api\Action;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Contactus;
use Jenssegers\Agent\Agent;

class ActionController extends Controller
{
    public function contactus(Request $request){
        try{
            $agent = new Agent();
            $browser = $agent->browser();
            $browserversion = $agent->version($browser);
            $languages = $agent->languages();
            $platform = $agent->platform();
            $device = $agent->device();
            $platformversion = $agent->version($platform);
            $user = [
                'ip' => \request()->ip(),
                'browser' => $browser . ' ' . $browserversion,
                'languages' => $languages,
                'platform' => $platform . ' ' . $platformversion,
                'device' => $device,
                'uid'=>Auth::user()->uid,
            ];
            Contactus::create([
                'name'=>$request->name,
                'email'=>$request->email,
                'subject'=>$request->subject,
                'description'=>$request->description,
                'user_info'=>json_encode($user),
            ]);
            return response()->json(['added' => 'Məktub göndərildi.'], 400);
        }catch(\Exception $e){
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
