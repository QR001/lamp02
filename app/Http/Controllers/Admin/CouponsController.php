<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Coupon;

class CouponsController extends Controller
{
    // 显示优惠券
    public function index()
    {
        $res=Coupon::all();
        $count=Coupon::count();
        // dd($res);
        return view('admin.coupons.index',['datas'=>$res,'count'=>$count]);
    }

    // 添加优惠券
    public function addcoupon(){
        return view('admin.coupons.add');
    }

    // 执行添加优惠券
    public function doaddcoupon(Request $reuqest)
    {

        // 过期时间
       
        // 最大优惠金额
        if($reuqest->c_money >100){
            $maxmoney=100;
        }else{
            $maxmoney=$reuqest->c_money;
        }
        
        $res=Coupon::create([
            'uid'=>0,
            'c_money'=>$maxmoney,
            'c_type'=>$reuqest->c_type,
            'c_status'=>1, //默认是未使用
            'c_time'=>$reuqest->start .'至'.$reuqest->end,
        ]);

        if($res){
           return 'success';
        }else{
            return 'error';
        }
       
    }

    // 删除优惠券
    public function delcoupon($id)
    {
        // 判断此条数据是否存在
        // return $id;
        $res1=Coupon::find($id);
        $res2=Coupon::destroy($id);
        if($res1 && $res2){
            return 'success';
        }else{
            return 'error';
        } 
    }

    //修改优惠券--页面
    public function update($id)
    {
       
        $data=Coupon::findOrFail($id);
       
        if($data){
            $res=explode('至',$data->c_time);
            
            $data->date=$res;
        }
       
        return view('admin.coupons.update',['data'=>$data]);
    }
    // 执行优惠券--修改
    // public function updateCount($id){
        // return $id;
    // } 
}
