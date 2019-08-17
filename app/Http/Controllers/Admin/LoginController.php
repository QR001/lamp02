<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Hash;
use Illuminate\Support\Facades\DB;
use App\Models\user;
use App\Models\userdetail;
use App\Models\Recard;

class LoginController extends Controller
{
    //进入后台的默认方法，判断账户是否登录
    public function index()
    {
        $admin = session('admin');
        
        return $admin ? view('admin.index.index') : view('admin.login.login') ;
    }

    //执行后台登录的操作
    public function dologin(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'password' => 'required',
        ]);
        
        //查询该账户是否存在
        $user = User::where('name',$request->name)->first();
        if(!$user){
            return view('admin.login.login')->with('error','账号不存在！！！');
        }
        //验证密码
        if(!Hash::check($request->password,$user->password)){
            return view('admin.login.login')->with('error','密码输入错误！！！');     
        }
        //验证状态
        if($user->status == '2'){
            return view('admin.login.login')->with('error','该账户已冻结！！！');
            
        }
        //验证权限
        if($user->power != '3'){
            return view('admin.login.login')->with('error','该账户还不是管理员！！！'); 
        }
        
        //存入session
        $request->session()->put('admin',$user);

        //需对当前账户做登陆记录
        $recard = Recard::where('uid',$user->id)->first();
       
        if(isset($recard)){
           
            $recard->ip = $_SERVER["REMOTE_ADDR"];
            $recard->r_num = $recard->r_num + 1;
            $res = $recard->save();
        }else{
            
            $res = Recard::insertGetId([
                'uid' => $user->id,
                'ip' => $_SERVER["REMOTE_ADDR"],
                'r_num' => 1
            ]);
        }

      

        return redirect('/admin/index');
        
    }

    //显示后台首页默认内容
    public function indexShow()
    {
        //统计数据,用于存放数据
        $num = [];
        //商品数量
        $num['商品数量'] = DB::table('goods')->count();
        //活动数量
        $num['推出活动'] = DB::table('blogs')->count();
        //商品评论数量
        $num['商品评论'] = DB::table('comments')->count();
        //用户数量
        $num['用户数量'] = DB::table('users')->count();
        //订单数量
        $num['订单数量'] = DB::table('orders')->count();

        //对登陆记录的提示信息
        $recard = Recard::where('uid',session('admin')->id)->first();
       
        return view('admin/index/index2',['num' => $num,'recard'=>$recard]);
    }

    //退出账户登录
    public function logout()
    {
        session()->forget('admin');
        return redirect('/admin/index');
    }
}
