<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PayController extends Controller
{
    // 支付页面
    public  function index(){
        return view('home.pay.index');
    }
}
