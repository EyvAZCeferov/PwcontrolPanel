<?php

namespace App\Http\Controllers\Api\Customers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Kreait\Firebase\Factory;
use App\Models\Comments;

class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $comments=Comments::orderBy('created_at','DESC')
            ->where('uid',Auth::user()->uid)
            ->with(['get_top_comment','get_customer','getCampaign'])
            ->get();
            if($comments){
                return response()->json(['comments' =>$comments ], 200);
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
            $message=[
                'name'=>Auth::user()->name,
                'uid'=>Auth::user()->uid,
                'description'=>$request->description,
            ];
            Comments::create([
                'top_comment_id'=>$request->top_comment_id ? $request->top_comment_id : 0 ,
                'table'=>$request->table,
                'message'=>json_encode($message),
                'post_id'=>$request->post_id
            ]);
            return response()->json(['added' =>'Komentiniz göndərildi.' ], 200);
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
            $comments=Comments::orderBy('created_at','DESC')
            ->where('id',$id)
            ->where('uid',Auth::user()->uid)
            ->with(['get_top_comment','get_customer','getCampaign'])
            ->first();
            if($comments){
                return response()->json(['comment' =>$comments ], 200);
            }else{
                return response()->json(['null' =>'Məlumat boşdur.' ], 404);
            }
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
            $comments=Comments::orderBy('created_at','DESC')
            ->where('id',$id)
            ->with(['get_top_comment','get_customer','getCampaign'])
            ->delete();
            if($comments){
                return response()->json(['comments' =>$comments ], 200);
            }else{
                return response()->json(['null' =>'Məlumat boşdur.' ], 404);
            }
        }catch(\Exception $e){
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
