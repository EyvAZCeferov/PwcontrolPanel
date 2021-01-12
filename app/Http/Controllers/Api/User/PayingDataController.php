<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Kreait\Firebase\Factory;
use App\Models\UsersPaying;

class PayingDataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $payings=UsersPaying::where('uid',Auth::user()->uid)->get();
            if($payings->count()>0){
                return response()->json(['payings' =>$payings ], 200);
            }else{
                return response()->json(['null' =>'Məlumat boşdur.' ], 404);
            }
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
            $payinfo=[
            'market'=>$request->market,
            'cardId'=>$request->cardId,
           ];
           $payId=Str::random(50);
           UsersPaying::create([
                'uid'=>Auth::user()->uid,
                'pay_id'=>$payId,
                'payInfo'=>json_encode($payinfo),
                'type'=>$request->type,
           ]);
           $factory = (new Factory)->withServiceAccount(app_path() . '/Firebase/FirebaseConfig.json')->createDatabase();
           $ref = $factory->getReference('users/' . Auth::user()->uid . '/paying/');
           $ref->getChild($payId)->set(
            [
                'pay_id' => $payId,
                'uid'=>Auth::user()->uid,
                'payInfo'=>json_encode($payinfo),
                'type'=>$request->type,
            ]
            );
           return response()->json(['added'=>'Alış-veriş başladı.'],200);
       }catch(\Exception $e){
            return response()->json(['error' => $e->getMessage()], 400);
       }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{
            $payings=UsersPaying::where('uid',Auth::user()->uid)->where('pay_id',$id)->first();
            if($payings->count()>0){
                return response()->json(['paydata' =>$payings ], 200);
            }else{
                return response()->json(['null' =>'Məlumat boşdur.' ], 404);
            }
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
    public function update(Request $request, $id)
    {
        try{
            (new Factory)->withServiceAccount(app_path() . '/Firebase/FirebaseConfig.json')->createAuth()->signInWithEmailAndPassword('getdata@pw.az', 'getdata_123');
            $payinfo=[
            'market'=>$request->market,
            'cardId'=>$request->cardId,
           ];
           UsersPaying::where('uid',Auth::user()->uid)
           ->where('pay_id',$id)
           ->update([
                'payInfo'=>json_encode($payinfo),
           ]);
           $factory = (new Factory)->withServiceAccount(app_path() . '/Firebase/FirebaseConfig.json')->createDatabase();
           $ref = $factory->getReference('users/' . Auth::user()->uid . '/paying/');
           $ref->getChild($id)->set(
            [
                'payInfo'=>json_encode($payinfo),
            ]
            );
           return response()->json(['updated'=>'Alış-veriş məlumatları yeniləndi.'],200);
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
            $payings=UsersPaying::where('uid',Auth::user()->uid)
            ->where('pay_id',$id)
            ->delete();
            if($payings){
                return response()->json(['status' =>'Məlumat silindi.' ], 200);
            }else{
                return response()->json(['null' =>'Məlumat boşdur.' ], 404);
            }
        }catch(\Exception $e){
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
