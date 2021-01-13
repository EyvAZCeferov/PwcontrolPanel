<?php

namespace App\Http\Controllers\Api\Customers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Kreait\Firebase\Factory;
use App\Models\Ratings;

class RatingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $ratings=Ratings::orderBy('created_at','DESC')
            ->where('author_id',Auth::user()->uid)
            ->get();
            if($ratings){
                return response()->json(['ratings' =>$ratings ], 200);
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
            $ratings=Ratings::create([
                'rating'=>$request->rating,
                'ratingable_id'=>$request->post_id,
                'author_type'=>'user',
                'author_id'=>Auth::user()->id,
                'tablename'=>$request->table,
            ]);
            if($ratings){
                return response()->json(['ratings' =>'Məlumat əlavə edildi.' ], 200);
            }else{
                return response()->json(['null' =>'Məlumat əlavə edilmədi.' ], 404);
            }
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
            $ratings=Ratings::orderBy('created_at','DESC')
            ->where('author_id',Auth::user()->uid)
            ->where('ratingable_id',$id)
            ->get();
            if($ratings){
                $resultRating=0;
                $i=0;
                foreach($ratings as $rating){
                    $resultRating+=$rating->rating;
                    $i++;
                }
                return response()->json(['ratings' =>ceil($resultRating/$i) ], 200);
            }else{
                return response()->json(['null' =>'Məlumat boşdur.' ], 404);
            }
        }catch(\Exception $e){
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

}
