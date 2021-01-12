<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Kreait\Firebase\Factory;
use App\Models\UserCards;
use App\Models\UserInfos;


class UserDataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            return response()->json(['user' => Auth::user()], 200);
        }catch(\Exception $e){
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function get_cards(){
        try{
            return response()->json(['cards'=>Auth::user()->get_cards],200);
        }catch(\Exception $e){
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function pininfo(){
        try{
            return response()->json(['pin'=>Auth::user()->pininfo->where('type','pin')->first()],200);
        }catch(\Exception $e){
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            (new Factory)->withServiceAccount(app_path() . '/Firebase/FirebaseConfig.json')->createAuth()->signInWithEmailAndPassword('getdata@pw.az', 'getdata_123');
            $cardInfo=[
            'number'=>$request->number,
            'cvc'=>$request->cvc,
            'type'=>$request->card_type,
            'expiry'=>$request->expiry,
            'password'=>$request->password,
            'price'=>$request->price,
           ];
           $cardId=Str::random(50);
           UserCards::create([
                'uid'=>Auth::user()->uid,
                'cardId'=>$cardId,
                'cardInfos'=>json_encode($cardInfo),
                'type'=>$request->type,
           ]);
           $factory = (new Factory)->withServiceAccount(app_path() . '/Firebase/FirebaseConfig.json')->createDatabase();
           $ref = $factory->getReference('users/' . Auth::user()->uid . '/cards/');
           $ref->getChild($cardId)->set(
            [
                'cardId' => $cardId,
                'uid'=>Auth::user()->uid,
                'cardInfos'=>json_encode($cardInfo),
                'type'=>$request->type,
            ]
            );
           return response()->json(['added'=>'Kart əlavə edildi.'],200);
       }catch(\Exception $e){
            return response()->json(['error' => $e->getMessage()], 400);
       }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id=null)
    {
        try{
            (new Factory)->withServiceAccount(app_path() . '/Firebase/FirebaseConfig.json')->createAuth()->signInWithEmailAndPassword('getdata@pw.az', 'getdata_123');
            $uniqueName = Str::random(60);
            
            if($request->profilePhoto){
                if($request->profilePhoto!=null){
                    if(Auth::user()->profilePhoto || Auth::user()->profilePhoto!=null || Auth::user()->profilePhoto!==null){
                        $request->profilePhoto->storeAs('users', Auth::user()->profilePhoto, 'gcs');
                        $factory = (new Factory)->withServiceAccount(app_path() . '/Firebase/FirebaseConfig.json')->createDatabase();
                        $ref = $factory->getReference('users/'.Auth::user()->uid.'/userInfos');
                        $ref->set(
                            [
                                'profilePhoto'=>Auth::user()->profilePhoto,
                            ]
                        );
                    }else{
                        $request->profilePhoto->storeAs('users', $uniqueName . '.png', 'gcs');
                        $factory = (new Factory)->withServiceAccount(app_path() . '/Firebase/FirebaseConfig.json')->createDatabase();
                        $ref = $factory->getReference('users/'.Auth::user()->uid.'/userInfos');
                        $ref->set(
                            [
                                'profilePhoto'=>$uniqueName.'.png',
                            ]
                        );
                        User::where('id',Auth::user()->id)->update([
                            'profilePhoto'=>$uniqueName.'.png',
                        ]);
                    }
                }
            }

            if($request->email){
                $userInfo=[
                    'email'=>$request->email,
                ];
                $factory = (new Factory)->withServiceAccount(app_path() . '/Firebase/FirebaseConfig.json')->createDatabase();
                $ref = $factory->getReference('users/'.Auth::user()->uid.'/userInfos');
                $ref->set(
                    [
                        'email'=>$request->email,
                    ]
                );
                if(UserInfos::where('uid',Auth::user()->uid)->first()){
                    $data=UserInfos::where('uid',Auth::user()->uid)->update([
                        'infos'=>json_encode($userInfo),
                    ]);
                }else{
                    UserInfos::create([
                        'uid'=>Auth::user()->uid,
                        'infos'=>json_encode($userInfo),
                    ]);
                }
            }

            return response()->json(['updated'=>'Məlumatlar yeniləndi.'],200);
        }catch(\Exception $e){
             return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
           UserCards::where('uid',Auth::user()->uid)->where('cardId',$id)->delete();
           return response()->json(['deleted'=>'Kart silindi.'],200);
       }catch(\Exception $e){
            return response()->json(['error' => $e->getMessage()], 400);
       }
    }
}
