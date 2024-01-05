<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;
use App\Models\User;

class DashboardController extends Controller
{
    public function index(){
        $notactive=User::select('id')->where('status','=',0)->count();
        $active=User::select('id')->where('status','=',1)->count();
        $products=Products::select('id')->count();
        return view('index',['not'=>$notactive,'active'=>$active,'product'=>$products]);
    }
}
