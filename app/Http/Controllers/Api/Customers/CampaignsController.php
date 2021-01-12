<?php

namespace App\Http\Controllers\Api\Customers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Kreait\Firebase\Factory;
use App\Models\Posts;

class CampaignsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $campaigns=Posts::orderBy('created_at','DESC')
            ->with(['getCustomer','get_comments','get_rating'])
            ->get();
            if($campaigns->count()>0){
                return response()->json(['campaigns' =>$campaigns ], 200);
            }else{
                return response()->json(['null' =>'Məlumat boşdur.' ], 404);
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
            $campaign=Posts::orderBy('created_at','DESC')
            ->where('id',$id)
            ->with(['getCustomer','get_comments','get_rating'])
            ->first();
            if($campaign){
                return response()->json(['campaign' =>$campaign ], 200);
            }else{
                return response()->json(['null' =>'Məlumat boşdur.' ], 404);
            }
        }catch(\Exception $e){
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

}
