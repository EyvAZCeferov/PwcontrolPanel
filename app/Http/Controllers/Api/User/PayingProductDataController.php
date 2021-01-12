<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Kreait\Firebase\Factory;
// use App\Models\UsersPaying;
use App\Models\BarcodeProducts;

class PayingProductDataController extends Controller
{

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
           $element_id=Str::random(50);
           $price=$request->price*$request->qyt;
           BarcodeProducts::create([
                'uid'=>Auth::user()->uid,
                'pay_id'=>$request->pay_id,
                'element_id'=>$element_id,
                'product'=>$request->product,
                'price'=>$price,
                'qyt'=>$request->qyt,
           ]);
           $factory = (new Factory)->withServiceAccount(app_path() . '/Firebase/FirebaseConfig.json')->createDatabase();
           $ref = $factory->getReference('users/' . Auth::user()->uid . '/paying/'.$element_id.'products/');
           $ref->getChild($element_id)->set(
            [
                'uid'=>Auth::user()->uid,
                'pay_id'=>$request->pay_id,
                'element_id'=>$element_id,
                'product'=>$request->product,
                'price'=>$price,
                'qyt'=>$request->qyt,
            ]
            );
           return response()->json(['added'=>'Məhsul əlavə edildi.'],200);
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
            $products=BarcodeProducts::where('uid',Auth::user()->uid)->where('pay_id',$id)->get();
            if($products->count()>0){
                return response()->json(['products' =>$products ], 200);
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
            $price=$request->price*$request->qyt;
           BarcodeProducts::where('uid',Auth::user()->uid)
           ->where('pay_id',$request->pay_id)
           ->where('element_id',$id)->update([
                'price'=>$price,
                'qyt'=>$request->qyt,
           ]);
           $factory = (new Factory)->withServiceAccount(app_path() . '/Firebase/FirebaseConfig.json')->createDatabase();
           $ref = $factory->getReference('users/' . Auth::user()->uid . '/paying/'.$request->pay_id.'products/');
           $ref->getChild($id)->set(
            [
                'price'=>$price,
                'qyt'=>$request->qyt,
            ]
            );
           return response()->json(['uptaded'=>'Məhsul məlumatları yeniləndi.'],200);
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
    public function destroy($id,$productid)
    {
        try{
            $products=BarcodeProducts::where('uid',Auth::user()->uid)
            ->where('pay_id',$id)
            ->where('id',$productid)
            ->delete();
            if($products->count()>0){
                return response()->json(['status' =>'Silindi.' ], 200);
            }else{
                return response()->json(['null' =>'Məlumat boşdur.' ], 404);
            }
        }catch(\Exception $e){
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
