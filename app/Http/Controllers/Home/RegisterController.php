<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Userdetail;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\Home\Register;
use App\Http\Requests\Home\RegisterPhone;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    // 显示模板
    public function index ()
    {
        return View('home.register.index');
    }

    // 邮箱注册
    public function store(Register $request){
       
        // 注册
        $users=New User();
        
        $users->name=$request->input('name','');

        $users->email=$request->input('email','');
        
        // 用来验证用户的唯一性
        $users->token=str_random(30);
        
        $users->password=Hash::make($request->input('pwd',''));
        
        if ( $users->save() ){

            // 在用户详情表中添加用户的头像
            $userDetail=new Userdetail();
            $userDetail->pic='photo.jpg'; // 默认的头像

            $userDetail->realname='';
            $userDetail->description='';
            $userDetail->sex='';
            $userDetail->integral=0;
            $userDetail->phone='';

            $userDetail->uid=$users->id;
            
            if( $userDetail->save() ){
           
                Mail::send('home.email.email', ['id' =>$users->id,'token'=>$users->token], function ($m) use ($users) {
                    //  发送到那个位置
                    $m->to($users->email)->subject('[lamp软件学院]注册激活邮件');
                });
            }else{
               return back();
            }

            return view('home.email.activate');
        }else{
           return back();
        }
    }

    // 邮箱激活
    public function changeemail(Request $request){
        
        // 获取token和id
        $id=$request->input('id',0);
        $token=$request->input('token',0);

        // 查找对应的数据
        $user=User::find($id);
        // 进行token比对
        if($user->token !== $token){
            
            return redirect()->action('Home\RegisterController@index')->withErrors(['linkerror'=>'链接失效']);
           
        }

        $user->email_status=1;

        // 为了保证链接只能一次有效,在这里需要更新token的值
        $user->token=str_random(30);
        //判断是否激活成功
        if($user->save()){
       
            return redirect()->action('Home\LoginController@index');
        }else{
         
            return redirect()->action('Home\LoginController@index')->withErrors(['activeerror'=>'激活失败重新发送试试']);
          
        }
    }

    // 发送手机号验证码
    public function sendPhone(Request $request)
    {
        
      
        // 接收手机号
        $phone=$request->input('phone');
      
        $code=rand(1234,4321);

        // 如果存到redis中 注意建名覆盖
        $k=$phone.'_code';
        session([$k=>$code]);
        
        $url = "http://v.juhe.cn/sms/send";
        $params = array(
            'key'   => 'ec23ab5562872ad112176e409b99bf26', //您申请的APPKEY
            'mobile'    => $phone, //接受短信的用户手机号码
            'tpl_id'    => '176433', //您申请的短信模板ID，根据实际情况修改
            'tpl_value' =>'#code#='.$code, //您设置的模板变量，根据实际情况修改
            'dtype'    =>'json'
        );

        $paramstring = http_build_query($params);
        $content = self::juheCurl($url, $paramstring);
        echo $content;

       
    }


    /**
     * 请求接口返回内容
     * @param  string $url [请求的URL地址]
     * @param  string $params [请求的参数]
     * @param  int $ipost [是否采用POST形式]
     * @return  string
     */
    public static function juheCurl($url, $params = false, $ispost = 0)
    {
        $httpInfo = array();
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_USERAGENT, 'JuheData');
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        if ($ispost) {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
            curl_setopt($ch, CURLOPT_URL, $url);
        } else {
            if ($params) {
                curl_setopt($ch, CURLOPT_URL, $url.'?'.$params);
            } else {
                curl_setopt($ch, CURLOPT_URL, $url);
            }
        }
        $response = curl_exec($ch);
        if ($response === FALSE) {
           
            return false;
        }
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $httpInfo = array_merge($httpInfo, curl_getinfo($ch));
        curl_close($ch);
        return $response;
    } 

    // 执行手机号注册
    public function phoneRegister(Request $request){
         
        //判断是否为空
        foreach ($request->all() as $key => $value) {
            if($value==''){
             return back()->withErrors(['kong'=>'内容不能为空']);
            }
        }
        
        //验证规则
       
        $validator = Validator::make($request->all(), [
            'pname'=>'required|regex:/^[a-zA-Z]{1}[\w]{5,15}$/',
            'phone'=>'required|regex:/^1{1}[3-9]{1}[\d]{9}$/',
            'code'=>'required|regex:/^[0-9]{4}$/',
            'ppwd'=>'required|regex:/^[\w]{6,18}$/',
            'prepwd'=>'required|same:ppwd'
        ]);
           
        if ($validator->fails()) {
            return back()->withErrors($validator);
        }


        // 验证验证码是否正确
        $phone=$request->input('phone',0);
        $k=$phone.'_code';
        // 表单的验证码
        $code=$request->input('code',0); 
        
        // session中的验证码
        $phone_code= session($k);
       
        if($code != $phone_code){
            
            echo "<script>alert('验证码错误');location.href='/home/register'</script>";
            exit;
        }
        
       
        // 开启事务
        DB::beginTransaction();

        // 压入到数据库
        $user=User::create([
            'name'=>$request->pname,
            // 如果用户是使用手机号注册使用的邮箱默认是'手机号@163.com'
            'email'=>$request->phone.'@163.com',
            'password'=>Hash::make($request->ppwd),
            'token'=>$request->_token,
        ]);
       
        // 写入用户详情表 
        $res=Userdetail::create(['uid'=>$user->id,'pic'=>'photo.jpg','phone'=>$request->phone]);
        if($user && $res){
            // 事务提交
            DB::commit();
            return redirect()->action('Home\LoginController@index');
        }else{

            // 事务回滚
            DB::rollback();
            
            return back()->withErrors(['phoneRegistererror'=>'注册失败']);
        }

    }
}
