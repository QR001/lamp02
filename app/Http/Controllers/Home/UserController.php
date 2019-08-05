<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Userdetail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\User;

class UserController extends Controller
{
    // 显示个人中心
    public function index()
    {
        // dump(session('home.name'));
        // 判断是否登录
        if(session('home.name')==null){
           
            return  view('home.login.index');
        }
        return view('home.userinfo.index');
    }

    // 显示个人中心的---个人资料
    public function userinfo_personal()
    {
        $userinfo=Userdetail::join('users','users.id','=','userdetails.uid')->where(['users.id'=>session('home.id')])->first();
        return view('home.userinfo.userinfo_personal',['userinfo'=>$userinfo]);
    }

    // 执行个人中心的---个人资料修改
    public function userinfo_personal_update(Request $request)
    {    
        
        //验证规则
        $validator = Validator::make($request->all(), [
            'name'=>'required |regex:/^[a-zA-Z]{1}[\w]{5,15}$/',
            'phone'=>'required|regex:/^1{1}[3-9]{1}[\d]{9}$/',
            'realname'=>'required|min:1|max:10',
            'email' => 'required|email',
        ]);
           
        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        DB::beginTransaction();
       
        // 修改用户表
        $res1=User::where('id',$request->id)->update(['name'=>$request->name,'email'=>$request->email]);
        $res2=Userdetail::where('uid',$request->id)->update([
            'realname'=>$request->realname,
            'phone'=>$request->phone,
            'sex'=>$request->sex,
        ]);
        if($res1 && $res2){
            DB::commit();
            return back();
        }else{
            DB::rollback();
            return back();
        }
    }

    // 执行个人中心的--头像修改
    public function userinfo_updatepic(Request $request)
    {
        // 判断用户是否上传
        if($request->hasfile('pic')){
            $path = $request->file('pic')->store(date('Ymd').'user');
            // echo $path;
            $id=$request->id;
            $res=Userdetail::where('uid',$id)->update(['pic'=>$path]);
        }
      
        // return $path;
        // return $res;
        return back();

        // dd($request->file);
    }

    // 显示个人中心--安全设置
    public function userinfo_safe()
    {
       return view('home.userinfo.userinfo_safe');
    }

    // 显示个人中心--收货地址
    public function userinfo_address()
    {
        return  view('home.userinfo.userinfo_address');
    }

    // 显示个人中心的--订单管理
    public function userinfo_order()
    {
        return  view('home.userinfo.userinfo_order');
    }

    // 显示个人中心的--退款售后
    public function userinfo_refund()
    {
        return  view('home.userinfo.userinfo_refund');
    }

    // 显示个人中心的--优惠券
    public function userinfo_coupon()
    {
        return view('home.userinfo.userinfo_coupon');
    }

    // 显示个人中心的--红包
    public function redenvelopes()
    {
        // return view('home.userinfo.userinfo_redenvelopes');
        return view('home.userinfo.userinfo_redevelopes');
    }

    // 显示个人中心的--账单明细
    public function collect()
    {
        return view('home.userinfo.userinfo_collect');
    }
    // 显示个人中心的--足迹
    public function foot()
    {
        return view('home.userinfo.userinfo_foot');
    }
    // 评价
    public function evaluate()
    {
        return  view('home.userinfo.userinfo_evaluate');
    }
    // 消息
    public function news()
    {
        return view('home.userinfo.userinfo_news');
    }
}
