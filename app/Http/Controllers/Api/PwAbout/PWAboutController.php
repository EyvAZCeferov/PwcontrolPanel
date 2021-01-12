<?php

namespace App\Http\Controllers\Api\PwAbout;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TermofUse;
use App\Models\Settings;
use App\Models\About;
use App\Models\Faq;
use App\Models\Teams;
use App\Models\WhyChooseUs;
use App\Models\WhyChooseUsItems;

class PWAboutController extends Controller
{
    public function termofuse(){
        try{
            $termofuse=TermofUse::where('id',1)->first();
            if($termofuse->count()>0){
                return response()->json(['termofuse' =>$termofuse ], 200);
            }else{
                return response()->json(['null' =>'Məlumat boşdur.' ], 404);
            }
        }catch(\Exception $e){
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function settings(){
        try{
            $settings=Settings::where('id',1)->first();
            if($settings->count()>0){
                return response()->json(['settings' =>$settings ], 200);
            }else{
                return response()->json(['null' =>'Məlumat boşdur.' ], 404);
            }
        }catch(\Exception $e){
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function about(){
        try{
            $about=About::where('id',1)->first();
            if($about->count()>0){
                return response()->json(['about' =>$about ], 200);
            }else{
                return response()->json(['null' =>'Məlumat boşdur.' ], 404);
            }
        }catch(\Exception $e){
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function faqs(){
        try{
            $faqs=Faq::all();
            if($faqs->count()>0){
                return response()->json(['faqs' =>$faqs ], 200);
            }else{
                return response()->json(['null' =>'Məlumat boşdur.' ], 404);
            }
        }catch(\Exception $e){
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function teams(){
        try{
            $teams=Teams::all();
            if($teams->count()>0){
                return response()->json(['teams' =>$teams ], 200);
            }else{
                return response()->json(['null' =>'Məlumat boşdur.' ], 404);
            }
        }catch(\Exception $e){
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function whychooseus(){
        try{
            $whychooseus=WhyChooseUs::find(1)->first();
            $whychooseusitems=WhyChooseUsItems::where('top_id',1)->get();
            if($whychooseus->count()>0){
                return response()->json(['whychooseus' =>$whychooseus,'whychooseusitems'=>$whychooseusitems ], 200);
            }else{
                return response()->json(['null' =>'Məlumat boşdur.' ], 404);
            }
        }catch(\Exception $e){
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

}
