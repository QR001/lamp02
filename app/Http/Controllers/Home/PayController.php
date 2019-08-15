<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\locations;
use App\Models\sends;
use App\Models\Pay;
use App\Models\Good;
use App\Models\orderdetails;
use App\Models\orders;
use App\Models\Payment;
use App\Models\Userdetail;
use DB;

class PayController extends Controller
{
    //
    public function index(Request $request)
    {
        // 判断用户是否选择商品
        if(!$request->items){
            return back()->withErrors(['no'=>'至少选择一个商品']);
        }
        
        if(!session('home.id')){
           
            return redirect('/home/login');
        }
      
        // 查询 数据
        // 查该用户下面的地址
        $location=locations::where(['uid'=>session('home.id')])->get();
        // 查询物流方式
        $wuliu=sends::all();
        
        // 查询快递方式
        $express=Pay::all();

        // 显示用户要下单的商品
       
        $goods=[];
        foreach($request->items as $k=>$item){
            $arr=[];
            $arr=explode('-',$item);

            $goods[$k]=Good::join('carts','carts.gid','goods.id')->where(['carts.uid'=>session('home.id'),'goods.id'=>$arr[0]])->first();
            
            $goods[$k]['g_img']=explode(',',$goods[$k]->g_img)[0];
            // 购买的商品的数量
            $goods[$k]['buynum']=$arr[1];
        }
   
        
        // 优惠券
        $coupon=Coupon::where(['uid'=>session('home.id'),'c_status'=>1])->get();
        
        // 选中的商品的总价
        $total=$request->total;  
        
        return view('home.pay.index',['locations'=>$location,'wulius'=>$wuliu,'express'=>$express,'goods'=>$goods,'coupon'=>$coupon,'total'=>$total]);

    }

   
    //执行支付
    public function comfirepay(Request $request){

        // 判断用户是否选择物流方式 快递方式
        foreach($request->all() as $k=>$v){

            if(empty($v)){
                return redirect('/home/carts')->withErrors(['repay'=>'请选择 物流方式 支付方式后重新下单']); die;
            }

        }

        // 写入订单
        // 查询用户 输入的收货地址 
        $location=locations::find($request->address);
        
        // 判断用户是否使用优惠券
        if($request->coupon!='请选择'){
            $res=Coupon::find($request->coupon);
            $coupon=$res->id;
            $couponmoney=$res->c_money;
            // 删除用户选择的优惠券
            Coupon::where('id',$coupon)->update(['c_status'=>2]);
        }else{
            $coupon='';
            $couponmoney=0;
        }
        
        //实付的总价
        $total=$request->total- $couponmoney;
       
         // 判断用户的支付密码是否正确
         $userpaypwd=md5($request->paypwd);

         // 查看支付密码是否正确
         $ypwd=Userdetail::where('uid',session('home.id'))->first();
         
         if($userpaypwd==$ypwd->paypwd){
            $orderStatus=1;
            // 从用户的余额中扣除
            $yue=Payment::where('uid',session('home.id'))->first();
            // dd($yue);
            if(!$yue){
               
                return redirect('/home/userinfo_payments')->withErrors(['noyue'=>'用户的余额不够']);
            }else{
                if($yue->balance < $total){
               
                    // 订单照样写入
                    $ordernum=$this->ordernum();
                    // 写入订单表
                    $res=orders::create([
                        'uid'=>session('home.id'),
                        'sid'=>$request->expressmethods,
                        'cid'=>$coupon,
                        'o_consignee'=>$location->l_name,
                        'o_contact'=>$location->l_phone,
                        'o_address'=>$location->l_address,
                        'o_no'=>$ordernum,
                        'o_amount'=>$total,
                        'o_status'=>1,
                        'pid'=>$request->paymethods
                    ]);
                   
    
                    // 写入订单详情表
                    // 分割传过来的数据  商品的id-数量-颜色
                    foreach($request->goodid as $v){
                        $arr=explode('-',$v);
                        // 商品id
                        $goodid=$arr[0];
                        // 数量
                        $goodnum=$arr[1];
                        // 颜色
                        $goodcolor=$arr[2];
                        $res1=orderdetails::create([
                            'oid'=>$res->id,
                            'gid'=>$goodid,
                            'd_num'=>$goodnum,
                            'd_color'=>$goodcolor,
                            'd_status'=>'1'
                        ]);
    
                    
                        //  清空购物车
                        Cart::where('gid',$goodid)->delete();
                        // 增加用户的积分
                        $yuserjf=Userdetail::where('uid',session('home.id'))->first();
                        // dd($yuserjf);
                        // 商品的积分
                        $goodjf=Good::find($goodid);
                        $userjf=$yuserjf->integral + $goodjf->g_integral;
                        //修改用户的积分
                        Userdetail::where('uid',session('home.id'))->update(['integral'=>$userjf]);
                        
                        // 商品的销量+ 库存-
                        $good=Good::find($goodid);
                        $stocknum=$good->g_stock - $goodnum;
                        $salesnum=$good->g_sales + $goodnum;
                        // 执行修改
                        $gss=Good::where('id',$goodid)->update(['g_stock'=>$stocknum,'g_sales'=>$salesnum]);
                        
                        if($res && $res1 &&  $gss){
    
                            return view('home.pay.success',['order'=>$res]);
                        }else{
                            DB::rollback();
                            return redirect('/home/carts')->withErrors(['repay'=>'请选择 物流方式 支付方式后重新下单']);
                        }
            
                    }
    
                    return redirect('/home/userinfo_payments')->withErrors(['noyue'=>'用户的余额不够']);
                  
                }else{
                    $orderStatus=2;
                    // 减去用户的余额
                    Payment::where('uid',session('home.id'))->update(['balance'=>$yue->balance-$total]);
                }
            }

         }else{
             $orderStatus=1;
         }

        $ordernum=$this->ordernum();
        // 写入订单表
        $res=orders::create([
            'uid'=>session('home.id'),
            'sid'=>$request->expressmethods,
            'cid'=>$coupon,
            'o_consignee'=>$location->l_name,
            'o_contact'=>$location->l_phone,
            'o_address'=>$location->l_address,
            'o_no'=>$ordernum,
            'o_amount'=>$total,
            'o_status'=>$orderStatus,
            'pid'=>$request->paymethods
        ]);

  
        // 写入订单详情表
        // 分割传过来的数据  商品的id-数量-颜色
        foreach($request->goodid as $v){
            
            $arr=explode('-',$v);
            // 商品id
            $goodid=$arr[0];
            // 数量
            $goodnum=$arr[1];
            // 颜色
            $goodcolor=$arr[2];
            $res1=orderdetails::create([
                'oid'=>$res->id,
                'gid'=>$goodid,
                'd_num'=>$goodnum,
                'd_color'=>$goodcolor,
                'd_status'=>'1'
            ]);

            //  清空购物车
         
            Cart::where('gid',$goodid)->delete();
            
            // 商品的销量+ 库存-
            $good=Good::find($goodid);
            $stocknum=$good->g_stock - $goodnum;
            $salesnum=$good->g_sales + $goodnum;
            // 执行修改
            $gss=Good::where('id',$goodid)->update(['g_stock'=>$stocknum,'g_sales'=>$salesnum]);
            
            if($res && $res1 &&  $gss){

                return view('home.pay.success',['order'=>$res]);
            }else{
                DB::rollback();
                return redirect('/home/carts')->withErrors(['repay'=>'请选择 物流方式 支付方式后重新下单']);
            }
  
        }
       

    }

    // 订单编号
    function ordernum(){
        $dn='';
        for($i=0;$i<=11;$i++){
            $dn.=mt_rand(0,9);
        }
        //查询订单号是否已存在
        $orders=orders::where('o_no',$dn)->get();
        if(isset($orders[0])){
            db();
        }

        return $dn;
    }
    
}
