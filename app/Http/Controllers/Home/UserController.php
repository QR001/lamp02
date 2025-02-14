<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Userdetail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\Models\locations;
use App\Models\orders;
use App\Models\orderdetails;
use App\Models\Good;
use App\Models\refunds;
use App\Models\Coupon;
use App\Models\Payment;
use App\Models\collects;
use App\Models\Comment;
use App\Models\Track;
use App\Models\Web;

class UserController extends Controller
{
    // 查询个人中心的信息
    public static function catinfo(){
        $userinfo=Userdetail::join('users','users.id','=','userdetails.uid')->where(['users.id'=>session('home.id')])->first();
        return $userinfo;
    }

    // 显示个人中心
    public function index()
    {
        // 网站配置
        $web=Web::find(1); 
  
        if($web){
            if($web->w_isopen ==2){
                return view('errors.close');
            }
        }else{
            $web='';
        }

        // 判断是否登录
        if(session('home.name')==null){
           
            return  view('home.login.index');
        }
        
        
        
        // 红包的数量----优惠券的数量
       
        $couponCount=Coupon::where(['uid'=>session('home.id')])->count();
        // 该用户的订单状态
        // 未付款
        $orderStatus=[];
        $orderStatus['status_1']=orders::where(['uid'=>session('home.id'),'o_status'=>1])->count();
        $orderStatus['status_2']=orders::where(['uid'=>session('home.id'),'o_status'=>2])->count();
        $orderStatus['status_3']=orders::where(['uid'=>session('home.id'),'o_status'=>3])->count();
        $orderStatus['status_4']=orders::where(['uid'=>session('home.id'),'o_status'=>4])->count();
        $orderStatus['status_5']=orders::where(['uid'=>session('home.id'),'o_status'=>5])->count();
        // 日历
        // 年
        $year=date('Y');
        // 月
        $month=date('F');
        // 日
        $day=date('d');
        // 星期
        $week=date('l');
        // 今日新品
        $newgood=Good::orderBy('created_at','desc')->offset(0)->limit(1)->first();

        if(empty($newgood)){
         
            $newgood=0;
           
        }else{
          
           $newgood->g_img=explode(',',$newgood->g_img)[0];
            
        }
        
        // 热卖推荐
        $hotgood=Good::orderBy('g_sales','desc')->offset(0)->limit(1)->first();
 
        if(empty($hotgood)){
            $hotgood=0;
        }else{
            $hotgood->g_img=explode(',',$hotgood->g_img)[0];
        }

        // 用户的头像
        $userinfo=Userdetail::where(['uid'=>session('home.id')])->first();
        $userPhoto=$userinfo->pic;

        return view('home.userinfo.index',['couponCount'=>$couponCount,'orderStatus'=>$orderStatus,'year'=>$year,'month'=>$month,'day'=>$day,'week'=>$week,'newgood'=>$newgood,'hotgood'=>$hotgood,'web'=>$web,'userphoto'=>$userPhoto]);
    }

    // 显示个人中心的---个人资料
    public function userinfo_personal()
    {
        // 网站配置
        $web=Web::find(1); 
  
        if($web){
            if($web->w_isopen ==2){
                return view('errors.close');
            }
        }else{
            $web='';
        }

        $userinfo=self::catinfo();
        
        return view('home.userinfo.userinfo_personal',['userinfo'=>$userinfo,'web'=>$web]);
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
            $id=$request->id;
            //判断用户原来的头像是否是默认头像
            $photo=Userdetail::where('uid',$request->id)->first();
            
            if($photo->pic !== 'photo.jpg'){
              
                //删除原来的头像
                $ypath=public_path('/uploads/'.$photo->pic);
                
                unlink($ypath);  
              
            }
            Userdetail::where('uid',$id)->update(['pic'=>$path]);
        }
      
       
        return back();
        
    }

    // 显示个人中心--安全设置
    public function userinfo_safe()
    {
        // 网站配置
        $web=Web::find(1); 
        if($web){
             if($web->w_isopen ==2){
                 return view('errors.close');
             }
        }else{
             $web='';
        }
       $userinfo=self::catinfo();
       return view('home.userinfo.userinfo_safe',['userinfo'=>$userinfo,'web'=>$web]);
    }

    // 显示个人中心的---修改密码页面
    public function userinfo_safe_updatepwd(){
         // 网站配置
         $web=Web::find(1); 
         if($web){
              if($web->w_isopen ==2){
                  return view('errors.close');
              }
         }else{
              $web='';
         }
        return view('home.userinfo.userinfo_safe_updatepwd',['web'=>$web]);
    }

    //执行个人中心的--修改密码
    public function  userinfo_safe_exupdatepwd(Request $request){
       
        //验证规则
        $validator = Validator::make($request->all(), [
            'ypwd'=>'required |regex:/^[\w]{6,18}$/',
            'npwd'=>'required|regex:/^[\w]{6,18}$/',
            'renpwd'=>'required|same:npwd',
        ]);
           
        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

       
        $id=session('home.id');
       
        $user=User::find($id);
        // 判断原密码是否正确
        if (Hash::check($request->ypwd, $user->password)) {

            $res=DB::table('users')->where('id',$id)->update(['password'=>Hash::make($request->npwd)]);
            
            if($res){

                return redirect('/home/login')->withErrors(['loginExpire'=>'登录过期请重新登录']); 
            }else{
            
                return back()->withErrors(['nomodify'=>'修改失败']); 
            }
        }else{
            return back()->withErrors(['noypwd'=>'原密码不正确']); 
        }

    }

    // 修改支付密码--页面
    public function userinfo_safe_updatepaypwd()
    {
         // 网站配置
         $web=Web::find(1); 
         if($web){
              if($web->w_isopen ==2){
                  return view('errors.close');
              }
         }else{
              $web='';
         }
        $userinfo=self::catinfo();
       
        return view('home.userinfo.userinfo_safe_updatepaypwd',['userinfo'=>$userinfo,'web'=>$web]);
    }


    // 执行支付密码的修改
    public function userinfo_safe_exupdatepaypwd(Request $request){
        // 验证所有的input是否为空
        foreach($request->all() as $k=>$v){
            if($v==''){
                return back()->withErrors(['kong'=>'信息不能为空']);
            }
        }
      
        //验证用户填写的验证码和手机发送的验证码是否是一样的
       
        
      
         //验证规则
         $validator = Validator::make($request->all(), [
           
            'paypwd'=>'required| numeric |regex:/^[0-9]{6}$/',
            'repaypwd'=>'required| numeric |same:paypwd',
        ]);
           
        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        // 拼装数据
        $paypwd=md5($request->input('paypwd'));
        
        $id = session('home.id');
        
        $array = array('id'=>$id,'paypwd'=> $paypwd);

        $update = DB::table('userdetails')->where('uid','=',$id)->update($array);

        
        if($update){
            return back()->withErrors(['success'=>'修改成功']);
        }else{
            return back()->withErrors(['error'=>'修改失败']);
        }
        
    }

    // 显示个人中心--收货地址
    public function userinfo_address()
    {
        // 网站配置
        $web=Web::find(1); 
  
        if($web){
            if($web->w_isopen ==2){
                return view('errors.close');
            }
        }else{
            $web='';
        }
        // 查询收货地址
        $location=locations::where('uid',session('home.id'))->get();
        
        return  view('home.userinfo.userinfo_address',['locations'=>$location,'web'=>$web]);
    }

    // 执行个人中心--添加用户地址
    public function userinfo_address_add(Request $request)
    {
        $count = locations::where('uid',session('home.id'))->count();
        $status = $count > 0 ? '2' : '1';
        //验证规则
        $validator = Validator::make($request->all(), [
            'l_name'=>'required |min:1',
            'l_phone'=>'required|regex:/^1{1}[3-9]{1}[\d]{9}$/',
            'l_address'=>'required',  
        ]);
           
        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        // 执行添加
        $location=new locations;
        $location->uid=session('home.id');
        $location->l_name=$request->l_name;
        $location->l_phone=$request->l_phone;
        $location->l_address=$request->l_address;
        $location->l_status=$status;// 1 是默认 2是未启用
        $res=$location->save();

        return back();
        
    }

    // 收货地址的删除
    public function userinfo_address_delete($id)
    {
       
        $res=locations::find($id);

        if($res){
            //删除
            locations::destroy($id);
            return back();
        }else{
            return back();
        }
    }

    // 个人中心--收货地址设为默认
    public function userinfo_defaultAddr($id)
    {
        //先查询是否有这条数据
        $res=locations::where(['uid'=>session('home.id')])->get();
      
        if($res[0]){
            // 把传过来的id 的地址状态改为 1
            $res2=locations::where(['id'=>$id])->update(['l_status'=>'1']);
            // 把其他的状态改为 2
            foreach($res as $k=>$v){
                if($v->id != $id){
                    locations::where(['id'=>$v->id])->update(['l_status'=>'2']);
                } 
            }
            return 'success';
        }else{
            return 'error';
        }

    }

    // 显示个人中心的--订单管理
    public function userinfo_order()
    {
         // 网站配置
         $web=Web::find(1); 
  
         if($web){
             if($web->w_isopen ==2){
                 return view('errors.close');
             }
         }else{
             $web='';
         }

        // 所有订单
        $Allorders=orders::where(['uid'=>session('home.id')])->paginate(2,['*'],'AllPage');
        // 查询订单详情和订单的商品
        foreach ($Allorders as $k=>$v){
            $res=$Allorders[$k]['orderinfo']=orderdetails::join('goods','goods.id','orderdetails.gid')->where(['orderdetails.oid'=>$v->id])->get();
            foreach($res as $key=>$value){
                
                $value['g_img']=explode(',',$value['g_img'])[0];
                
            }
        }

        // 待付款
        $orders1=orders::where(['uid'=>session('home.id'),'o_status'=>'1'])->paginate(2,['*'],'nopay');

        if(isset($orders1[0])){
           
            foreach ($orders1 as $k=>$v){
                $res=$orders1[$k]['orderinfo']=orderdetails::join('goods','goods.id','orderdetails.gid')->where(['orderdetails.oid'=>$v->id])->get();
                foreach($res as $key=>$value){

                    $value['g_img']=explode(',',$value['g_img'])[0];
                }
            }

        }else{
            $orders1='';
        }
       
        // 未发货
        $orders2=orders::where(['uid'=>session('home.id'),'o_status'=>'2'])->paginate(2,['*'],'nosend');
        
        if(isset($orders2[0])){
           
            foreach ($orders2 as $k=>$v){
                $res=$orders2[$k]['orderinfo']=orderdetails::join('goods','goods.id','orderdetails.gid')->where(['orderdetails.oid'=>$v->id])->get();
                foreach($res as $key=>$value){

                    $value['g_img']=explode(',',$value['g_img'])[0];
                }
            }

        }else{
            $orders2='';
        }

        // 待收货
        $orders3=orders::where(['uid'=>session('home.id'),'o_status'=>'3'])->paginate(2,['*'],'norece');
       
        if(isset($orders3[0])){
           
            foreach ($orders3 as $k=>$v){
                $res=$orders3[$k]['orderinfo']=orderdetails::join('goods','goods.id','orderdetails.gid')->where(['orderdetails.oid'=>$v->id])->get();
                foreach($res as $key=>$value){

                    $value['g_img']=explode(',',$value['g_img'])[0];
                }
            }

        }else{
            $orders3='';
        }

        // 待评价
        $orders4=orders::where(['uid'=>session('home.id'),'o_status'=>'4'])->paginate(2,['*'],'noeval');
       
        if(isset($orders4[0])){
           
            foreach ($orders4 as $k=>$v){
                $res=$orders4[$k]['orderinfo']=orderdetails::join('goods','goods.id','orderdetails.gid')->where(['orderdetails.oid'=>$v->id])->get();
                foreach($res as $key=>$value){
                    $value['g_img']=explode(',',$value['g_img'])[0];
                    
                    $count=$value['g_comment']=Comment::where(['gid'=>$value->gid,'uid'=>session('home.id')])->count();
                }
               
            }
            
        }else{
            $orders4='';
        }
        
    
        return  view('home.userinfo.userinfo_order',['Allorders'=>$Allorders,'orders1'=>$orders1,'orders2'=>$orders2,'orders3'=>$orders3,'orders4'=>$orders4,'web'=>$web]);
    }
    // 取消订单
    public  function delorder($id){
        // 先查询改订单是否存在
        $order=orders::find($id);

        if($order){
            orders::destroy($id);
            return back();
        }else{
            return back();
        }
    }

    // 确认收货
    public function confirm($id)
    {
        $res=orders::find($id);
        if($res){
            orders::where(['id'=>$id])->update(['o_status'=>'4']);
        }
        return back();
    }
    //订单管理的退款
    public function refund($did,$gid,$num)
    {

        $order = orderdetails::with(['order','good'])->where(['oid'=>$did,'gid'=>$gid])->get();
  
        foreach($order as $k=>$v){
            $img=explode(',',$v['good']['g_img']);
            array_pop($img);
        }
       
        return view('home.userinfo.refund',['img'=>$img,'order'=>$order,'gid'=>$gid,'num'=>$num]);
    }

    //退款申请
    public function refundstore(Request $request)
    {
        // dd($request->all());
        //获得所需要的数据   
        $gid = $request->gid;
        $did = $request->did;
     
        $r_num = rand(0,99999).$request->r_num;
        $r_cause = $request->r_cause;
        $payments = $request->payments;
     
        $r_explain = $request->r_explain;

        if($r_explain == null){
            $r_explain = '';
        }

        $data = refunds::create(['uid'=>session('home.id'),'r_payments'=>$payments,'did'=>$did,'r_num'=>$r_num,'r_cause'=>$r_cause,'r_explain'=>$r_explain]);

        if($data){
            $res = orderdetails::where('oid',$did)->update(['d_status'=>2]);
            
            return redirect()->action('Home\UserController@refund_store',['did'=>$did,'gid'=>$gid]);
        }else{
            return back()->with('error','申请失败');
        }

    }

    //显示申请成功页面
   public function refund_store()
   {

        // 网站配置
        $web=Web::find(1); 
    
        if($web){
            if($web->w_isopen ==2){
                return view('errors.close');
            }
        }else{
            $web='';
        }
        $did = $_GET['did'];
        $gid = $_GET['gid'];
        return view('home.userinfo.refund_store',['did'=>$did,'gid'=>$gid,'web'=>$web]);
   }
   // 显示个人中心的--退款售后
   public function userinfo_refund($did,$gid)
   {

        // 网站配置
        $web=Web::find(1); 
        
        if($web){
            if($web->w_isopen ==2){
                return view('errors.close');
            }
        }else{
            $web='';
        }

        // 查询订单和订单详情 商品表
    $order = DB::table('orderdetails')->join('refunds','refunds.did','orderdetails.oid')->where(['refunds.did'=>$did,'orderdetails.oid'=>$did,'orderdetails.gid'=>$gid,'orderdetails.d_status'=>2])->get();
    
       if(!isset($order[0])){

        $order = DB::table('orderdetails')->join('refunds','refunds.did','orderdetails.oid')->where(['refunds.did'=>$did,'orderdetails.oid'=>$did,'orderdetails.gid'=>$gid,'orderdetails.d_status'=>3])->get();
            foreach($order as $k=>$v){
                
                $v->good=Good::find($v->gid);
                $v->good['g_img']=explode(',',Good::find($v->gid)->g_img)[0]; 
            }
        }  
  
        foreach($order as $k=>$v){
            
            $v->good=Good::find($v->gid);
            $v->good['g_img']=explode(',',Good::find($v->gid)->g_img)[0]; 
        }
       return  view('home.userinfo.userinfo_refund',['datas'=>$order,'web'=>$web]);
   }

    // 显示个人中心的--优惠券
    public function userinfo_coupon()
    {
        // 网站配置
        $web=Web::find(1); 
  
        if($web){
            if($web->w_isopen ==2){
                return view('errors.close');
            }
        }else{
            $web='';
        }

        $coupons=Coupon::where(['uid'=>session('home.id')])->get();
        
      
        return view('home.userinfo.userinfo_coupon',['coupons'=>$coupons,'web'=>$web]);
    }

    // 使用优惠券
    public function  usecoupons($id){
        // 首先查询优惠券是否存在
        $res=Coupon::where(['id'=>$id])->first();
        if($res){ 
            Coupon::where(['id'=>$id])->update(['c_status'=>2]);
            return back();
        }else{
            return back();
        }
    }

    //删除已使用的优惠券
    public function  delcoupons($id){
        // 首先查询优惠券是否存在
        $res=Coupon::where(['id'=>$id])->first();
        DB::beginTransaction();
        if($res){
            DB::commit();
            Coupon::destroy($id);
            return back();
        }else{
            DB::rollback();
            return back();
        }
    }


    // 显示个人中心的--用户收藏
    public function collect()
    {
        // 网站配置
        $web=Web::find(1); 
  
        if($web){
            if($web->w_isopen ==2){
                return view('errors.close');
            }
        }else{
            $web='';
        }

        // 判断用户是否登录    
        if(!session('home.id')){
            return view('home.login.index');
        }
        $collects=collects::join('goods','goods.id','collects.gid')->where('collects.uid',session('home.id'))->paginate('1');
        foreach($collects as $k=>$v){
          
            $v['g_img']=explode(',',$v->g_img)[0];
            
            // 获取每一条商品的评论== 好评/评论的条数*100%
            // 改商品的所有评论的条数
            $zcounts=Comment::where(['gid'=>$v->gid])->count();
            $hcounts=Comment::where(['gid'=>$v->gid,'c_score'=>3])->count();
            // 如果商品的好评是0
            if($hcounts == 0){
                $v['comment_pf']='100%';
            }else{ 
                $v['comment_pf']=($hcounts/$zcounts*100)."%";
            }
            
        }
       
        return view('home.userinfo.userinfo_collect',['collects'=>$collects,'web'=>$web]);
    }

    // 取消收藏
    public function delcollect($id){
        // 删除收藏
        collects::where(['gid'=>$id])->delete();
        // 返回
        return back();
    }

     // 显示个人中心的--足迹
     public function foot()
    {
        // 网站配置
        $web=Web::find(1); 
  
        if($web){
            if($web->w_isopen ==2){
                return view('errors.close');
            }
        }else{
            $web='';
        }

        $track = Track::where(['uid' => session('home.id')])->get();
        
        foreach($track as $v){
            $good = Good::find($v->gid);
            $img = explode(',',$good->g_img);
            $good->img = $img[0];
            $v->good = $good;
        }

        return view('home.userinfo.userinfo_foot',['track' => $track,'web'=>$web]);
    }
    //删除足迹中的商品
    public function del($id)
    {
        $res = Track::where(['uid' => session('home.id'),'gid' => $id])->delete();
        if($res){
            return 'success';
        }else{
            return 'error';    
        }
    }

    // 该用户评论过的所有商品的评价
    public function evaluate()
    {
        // 网站配置
        $web=Web::find(1); 
  
        if($web){
            if($web->w_isopen ==2){
                return view('errors.close');
            }
        }else{
            $web='';
        }

        $comments=Comment::join('goods','goods.id','comments.gid')->where('comments.uid',session('home.id'))->get();
       
        //对图片的处理
        foreach($comments as $k=>$v){
            // 商品的图片
            $v['g_img']=explode(',',$v->g_img)[0];
            // 用户评论的图片
            $c_imgs=explode(',',$v->c_img);
            array_pop($c_imgs);
            $c_img=$c_imgs;
            $v['c_img']=$c_img;
        }

        return  view('home.userinfo.userinfo_evaluate',['comments'=>$comments,'web'=>$web]);
    }
    
    // 评论单个商品
    public function commentlist($id){
        // 网站配置
        $web=Web::find(1); 
  
        if($web){
            if($web->w_isopen ==2){
                return view('errors.close');
            }
        }else{
            $web='';
        }

        //$id 是商品的id
        $good= Good::find($id);
        // 图片
        $img=explode(',',$good->g_img)[0];
       
        return view('home.userinfo.userinfo_comment',['good'=>$good,'img'=>$img,'web'=>$web]);
    }
    // 执行个人中心的评论
    public  function excomment(Request $request){
       
        //验证规则
        $validator = Validator::make($request->all(), [
            'c_content'=>'required | min:10',
            'c_score'=>'required',
        ]);
           
        if ($validator->fails()) {
            return back()->withErrors($validator);
        }
     
        //判断用户是否上传图片
        if($request->hasfile('c_img')){
            $file=$request->file('c_img');
            $filePath=[];
            foreach($file as $k=>$v){
                // 判断文件是否上传成功
                if(!$v->isValid()){
                    return back();
                }
                //此处防止没有多文件上传的情况
                if(!empty($v)){
                    $fpath = "/comments";
                    $npath =  date('Ymd').'/'.time().rand(0,99999999);
                    $ext = $v->extension();
                    $path = $npath.'.'.$ext;
                    if($v->storeAs($fpath,$path)){
                        $filePath[] = $path;
                    }
                }
            }
       
            $c_img=implode(',',$filePath).',';
           
            Comment::create([
                'c_score'=>$request->c_score,
                'c_content'=>$request->c_content,
                'c_img'=>$c_img,
                'uid'=>session('home.id'),
                'gid'=>$request->gid,
            ]);

           
            return redirect('/home/userinfo_evaluate')->withErrors(['success'=>'写入成功']);
           
        }else{
            Comment::create([
                'c_score'=>$request->c_score,
                'c_content'=>$request->c_content,
                'c_img'=>'',
                'uid'=>session('home.id'),
                'gid'=>$request->gid,
            ]);    
            return redirect('/home/userinfo_evaluate')->withErrors(['success'=>'写入成功']);
           
        }
    }
    

    // 个人中心的---余额充值
    public function userinfo_payments()
    {
        // 网站配置
        $web=Web::find(1); 
  
        if($web){
            if($web->w_isopen ==2){
                return view('errors.close');
            }
        }else{
            $web='';
        }
        // 查询用户的余额
        $balance = DB::table('payments')->where('uid',session('home.id'))->first();
        if($balance){
            $data=$balance->balance;
        }else{
            $data=0;
        }
        return view('home.userinfo.userinfo_payments',['balance'=>$data,'web'=>$web]);
    }

    // 执行个人中心的---余额充值
    public function userinfo_balance(Request $request)
    {
         //验证规则  判断用户输入的金额是否合法 
         $validator = Validator::make($request->all(), [
            'balance'=>'required',
        ]);
           
        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $id = session('home.id');
        $amount = $request->balance;
        // 查询用户原来的金额
        $balance = DB::table('payments')->where('uid',$id)->first();
        // 如果支付表中没有用户的信息
        if(!$balance){
            // 先插入一条数据，然后再进行查询
            DB::table('payments')->insert(['uid'=>session('home.id'),'balance'=>0,'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')]);
            // return $news;
            $balance = DB::table('payments')->where('uid',$id)->first();
        }
        $number=$balance->balance;
   
       //  执行修改  原来的金额+充值的金额
       $res=DB::table('payments')->where('uid',$id)->update(['balance'=>$number + $amount]);
       if($res){
            return back()->withErrors(['success'=>'充值成功']);
       }else{
           return  back()->withErrors(['error'=>'充值失败']);
       }
       
        
    }

    // 一键支付的页面
    public function userinfo_fastpay(Request $request){
 
        // 网站配置
        $web=Web::find(1); 
  
        if($web){
            if($web->w_isopen ==2){
                return view('errors.close');
            }
        }else{
             $web='';
        }
        // 判断该订单是否存在
        $order=orders::find($request->id);
  
        if($order){
            return view('home.userinfo.userinfo_fastpay',['orderid'=>$request->id,'o_amount'=>$request->zongji,'web'=>$web]);
        }else{
            return back();
        }
    }
    // 执行付款操作
    public  function userinfo_exfastpay(Request $request){
       
        if($request->paypwd==''){
            return back()->withErrors(['nopaypwd'=>"请填写支付密码"]);
        }
        //判断支付密码是否正确
        $ypaypwd=Userdetail::where('uid',session('home.id'))->first();
        $userpwd=md5($request->paypwd);
        
        if($userpwd == $ypaypwd->paypwd){
            // 支付密码正确
            $yue=Payment::where('uid',session('home.id'))->first();
            if(!$yue){
                return redirect('/home/userinfo_payments')->withErrors(['noyue'=>'用户的余额不够']);
            }else{
                 // 判断余额是否够付款
                if($yue->balance < $request->o_amount){
                    // 不够
                    return redirect('/home/userinfo_payments')->withErrors(['noyue'=>'用户的余额不够']);
                }else{
                    // 够---扣除余额--修改订单的状态
                    $res=Payment::where('uid',session('home.id'))->update([
                        'balance'=>$yue->balance - $request->o_amount,
                    ]);
                    if($res){
                        $res2=orders::where('id',$request->orderid)->update([
                            'o_status'=>2,
                        ]);
                        if($res2){
                            return redirect('/home/userinfo_order');
                        }
                    }
                }
            }
           

        }else{
            // 支付密码错误--重新输入密码
                return redirect('/home/userinfo_order')->withErrors(['paypwd'=>'支付密码错误']);
        }
        
    }

   
}
