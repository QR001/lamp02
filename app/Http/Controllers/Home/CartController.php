<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
    // 显示购物车
    public function index (){
        return view('home.carts.index');
    }
}
