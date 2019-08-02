<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\User;
use App\Models\Userdetail;

class UserController extends Controller
{
    // 用户列表
    public function user(){
        
        return view('admin.users.userlist');
    }
    // 后台添加用户
    public function user_create(){
        return view('admin.users.useradd');
    }

    public function user_store(Request $request){
        return $request->all();
        //  echo 123;
        $users = new User;
        $users -> name = $request -> name;
        $users -> email = $request -> email;
        $users -> password = Hash::make($request -> pwd);

        $userinfo=new Userdetail;
        $userinfo -> phone = $request -> phone;
        $userinfo -> sex = $request -> sex;
        $photo=explode('\/',$request -> pic);
        $userinfo -> pic = $photo[3];
        if($users->save() && $userinfo->save()){
            $status='success';
        }else{
            $status='success';
        }

        return $status;
        // $pic=explode("\",$request->phone);
        // $userinfo -> pic = $pic[2];
        
        // if($users -> save()){
        //     $status = 'success';
        // }else{
        //     $status = 'error';
        // }

        // return $status;
    }
}
