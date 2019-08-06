<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// use 

class ChatsController extends Controller
{
    //聊天室页面
    public function index()
    {
        // // 判断是否登录
        // if(session('home.name')==null){
            
        //     return  view('home.login.index');
        // }

  
        return view('home.customer.index');
    }

    public function fetchChat()
    {
        return Chats::with('user')->get();
    }

    public function sendChat(Request $request)
    {
        $user = session('home');

        $message = $user->chats()->create(['u_content'=> $request->input('u_content')]);

        broadcast(new MessageSent($user,$message))->toOthers();

        return ['u_status' => 'Message Sent!'];
    }


}
