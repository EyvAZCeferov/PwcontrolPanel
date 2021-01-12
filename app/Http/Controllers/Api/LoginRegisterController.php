<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use Illuminate\Support\Str;
use Kreait\Firebase\Factory;
use Illuminate\Support\Facades\Auth;
use App\Models\UserCards;

class LoginRegisterController extends Controller
{
    /**
     * Handles Registration Request
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        try{
            $this->validate($request, [
                'phoneNumber' => 'required|unique:users',
                'password' => 'required|min:6',
                'remember_token'=>'max:300'
            ],[
                'phoneNumber.required' => \Lang::get('static.formFields.validation.required'),
                'phoneNumber.unique' => \Lang::get('static.formFields.validation.unique'),
                'password.required' => \Lang::get('static.formFields.validation.required'),
                'password.min' => \Lang::get('static.formFields.validation.lengthMin', ['len' => 8]),
            ]);

            $uid=Str::random(40);

            $user = User::create([
                'name'=>'Ad',
                'profilePhoto'=>null,
                'phoneNumber' => $request->phoneNumber,
                'password' => Hash::make($request->password),
                'uid'=> $uid,
            ]);

            $token = $user->createToken('TutsForWeb')->accessToken;

            $factory = (new Factory)->withServiceAccount(app_path() . '/Firebase/FirebaseConfig.json')->createDatabase();
            $ref = $factory->getReference('users/'.$uid.'/userInfos');
            $ref->set(
                [
                    'profilePhoto'=>null,
                    'name'=>'Ad',
                    'phoneNumber'=>$request->phoneNumber,
                    'password'=>Hash::make($request->password),
                    'uid'=>$uid,
                ]
            );

            $this->checkPin($uid);

            return response()->json(['token' => $token], 200);
        }catch(\Exception $e){
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    /**
     * Handles Login Request
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        try{
            $this->validate($request, [
                'phoneNumber' => 'required',
                'password' => 'required|min:6',
            ],[
                'phoneNumber.required' => \Lang::get('static.formFields.validation.required'),
                'phoneNumber.unique' => \Lang::get('static.formFields.validation.unique'),
                'password.required' => \Lang::get('static.formFields.validation.required'),
                'password.min' => \Lang::get('static.formFields.validation.lengthMin', ['len' => 8]),
            ]);

            $credentials = [
                'phoneNumber' => $request->phoneNumber,
                'password' => $request->password
            ];

            if (Auth::attempt(['phoneNumber'=>$credentials['phoneNumber'],'password'=>$credentials['password']])) {
                $token = Auth::user()->createToken('TutsForWeb')->accessToken;
                $user=Auth::user();
                return response()->json(['token' => $token,'user'=>$user], 200);
            } else {
                return response()->json(['error' => 'UnAuthorised'], 401);
            }

            $this->checkPin($uid);

        }catch(\Exception $e){
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function makePinNumb(){
        $code = '111';
        for($i = 0; $i < 13; $i++) { $code .= mt_rand(0, 9); }
        return $code;
    }

    public function checkPin($uid){
        $pin=UserCards::where('uid',$uid)->where('type','pin')->first();
        if(!$pin || $pin->count()==0 || $pin==null){
            $number=$this->makePinNumb();
            $cardInfo=[
                'number'=>$number,
                'cvc'=>rand(101,999),
                'type'=>'pin',
                'expiry'=>'∞/∞',
                'password'=>null,
                'price'=>0,
            ];
            $cardId=Str::random(20);
            UserCards::create([
                'uid'=>$uid,
                'cardId'=>$cardId,
                'cardInfos'=>json_encode($cardInfo),
                'type'=>'pin',
            ]);
            $factory = (new Factory)->withServiceAccount(app_path() . '/Firebase/FirebaseConfig.json')->createDatabase();
            $ref = $factory->getReference('users/'.$uid.'/pin/'.$cardId);
            $ref->set(
                [
                    'uid'=>$uid,
                    'cardId'=>$cardId,
                    'cardInfos'=>json_encode($cardInfo),
                    'type'=>'pin',
                ]
            );
        }
    }

}





