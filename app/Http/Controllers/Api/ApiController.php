<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\Customers;
use App\Models\Locations;
use App\Models\Posts;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function customers()
    {
        $datas = Customers::with(['get_locations', 'get_posts'])->get()->toJson();
        return json_decode($datas);
    }

    public function customer($id)
    {
        $datas = Customers::where('id', $id)->with(['get_posts', 'get_locations'])->get()->toJson();
        return json_decode($datas);
    }

    public function categories()
    {
        $datas = Categories::with('topCategory')->get()->toJson();
        return json_decode($datas);
    }

    public function category($id)
    {
        $datas = Categories::where('id', $id)->with('topCategory')->get()->toJson();
        return json_decode($datas);
    }

    public function posts()
    {
        $datas = Posts::with('getCustomer')->get()->toJson();
        return json_decode($datas);
    }

    public function post($id)
    {
        $datas = Posts::where('id', $id)->with('getCustomer')->get()->toJson();
        return json_decode($datas);
    }

    public function postread($id, $bool)
    {
        if ($bool == 'true') {
            $post = Posts::where('id', $id)->get();
            Posts::where('id', $id)->update([
                'read_count' => $post[0]['read_count'] + 1
            ]);
            $datas = Posts::where('id', $id)->with('getCustomer')->get()->toJson();
            return json_decode($datas);
        } else {
            return false;
        }
    }

    public function locations()
    {
        $datas = Locations::with('get_customer')->get()->toJson();
        return json_decode($datas);
    }

    public function location($id)
    {
        $datas = Locations::where('id', $id)->with('get_customer')->get()->toJson();
        return json_decode($datas);
    }

}
