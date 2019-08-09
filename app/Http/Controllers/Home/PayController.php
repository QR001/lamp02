<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PayController extends Controller
{
<<<<<<< HEAD
    //
    public function index()
    {
        return view('home.pay.index');
    }

    public function shopping(Request $request)
    {
        return $request;
    }
=======
    // 支付页面
    public  function index(){
        return view('home.pay.index');
    }
>>>>>>> origin/zhangyahan
}
