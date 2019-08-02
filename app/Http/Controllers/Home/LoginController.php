<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Home\Login;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Userdetail;

class LoginController extends Controller
{
    //
    public  function index(){
        return view('home.login.index');
    }
    
    public function login(Login $request){
        // dd($request->all());
        
        // 用户名的正则
        $pattern1 = '/^[a-zA-Z]{1}[\w]{5,15}$/'; 
        // 邮箱的正则 
        $pattern2 = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/";  
        //手机号正则 
        $pattern3='/^1{1}[3-9]{1}[\d]{9}$/';
        $str = $request->name;  
        preg_match($pattern1, $str, $match1); 
        preg_match($pattern2, $str, $match2); 
        preg_match($pattern3, $str, $match3); 
        
        //使用用户名登录
        if($match1){
            
            $user=User::where(['name'=>$request->name])->first();
            
            // dd($user);
            if($user){
                // 验证密码是否正确
                if (Hash::check($request->pwd, $user->password)) {
                    // 密码匹配
                    if($user->status==2){
                        return back()->withErrors(['frozen'=>'你的账号已被冻结']);
                    }
                    
                    // 查询用户详情表 并且存入session
                    $userinfo=User::join('userdetails','userdetails.id','=','users.id')->where(['users.id'=>$user->id])->get();
                    
                    session(['home'=>[
                        'name'=>$userinfo[0]->name,
                        'email'=>$userinfo[0]->email,
                        'phone'=>$userinfo[0]->phone,
                        'pic'=>$userinfo[0]->pic,
                    ]]);
                    // dd(session('home'));
                    return redirect('home/index');
                }else{
                // 密码匹配不正确
                return back()->withErrors(['nopwd'=>'密码匹配不正确']);
                }
            }else{
                return back()->withErrors(['nouser'=>'用户名不存在']);
            }
            
        }else if($match2){
            //邮箱验证
            $user=User::where(['email'=>$request->name])->first();
            //判断用户是否存在
            if($user){
                // 验证密码是否正确
                if (Hash::check($request->pwd, $user->password)) {
                    // 密码匹配
                    if($user->status==2){
                        return back()->withErrors(['frozen'=>'你的账号已被冻结']);
                    }
                    //判断邮箱是否激活
                    if($user->email_status==0){
                        return back()->withErrors(['activate'=>'邮箱未激活']);
                    }
                    // 查询用户详情表 并且存入session
                     $userinfo=User::join('userdetails','userdetails.id','=','users.id')->where(['users.id'=>$user->id])->get();
                    
                     session(['home'=>[
                         'name'=>$userinfo[0]->name,
                         'email'=>$userinfo[0]->email,
                         'phone'=>$userinfo[0]->phone,
                         'pic'=>$userinfo[0]->pic,
                     ]]);
                    return redirect('home/index');
                }else{
                    // 密码匹配不正确
                    return back()->withErrors(['nopwd'=>'密码匹配不正确']);
                }
            }else{
                return back()->withErrors(['nouser'=>'用户名不存在']);
            }
            // return $user;

        }else if($match3){
            //使用手机号验证
            $res=Userdetail::join('users','users.id','=','userdetails.uid')->where(['phone'=>$request->name])->get();
            // dd($res);
            if($res){
                // 验证密码是否正确
                if (Hash::check($request->pwd, $res[0]->password)) {
                    // 密码匹配
                    if($res[0]->status==2){
                        return back()->withErrors(['frozen'=>'你的账号已被冻结']);
                    }
                    session(['home'=>[
                        'name'=>$res[0]->name,
                        'email'=>$res[0]->email,
                        'phone'=>$res[0]->phone,
                        'pic'=>$res[0]->pic,
                    ]]);

                    return redirect('home/index');
                }else{
                // 密码匹配不正确
                return back()->withErrors(['nopwd'=>'密码匹配不正确']);
                }
            }else{
                return back()->withErrors(['nouser'=>'手机号不存在']);
            }
           

        }else{
            // dump('格式不正确');
            return back()->withErrors(['format'=>'格式不正确']);
        }

    }


}
