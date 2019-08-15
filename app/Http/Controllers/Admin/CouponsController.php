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
       
        // 优惠券的金额
        $money=$_GET['c_money'] ?? '';
        // 开始的时间
        $start=$_GET['start'] ?? '';
        $end=$_GET['end'] ?? '';
        
        // 优惠券的创建时间是你输入的

        // 每页显示的条数
        $page=2;
        // 当前的页数
        $currentPage=$_GET['page'] ?? 1;
        $id=($currentPage-1)*$page+1;

        if($start && $end && $end > $start){
            $coupon = Coupon::where('c_money','like',"%".$money."%")->whereBetween('created_at',[$start,$end])->paginate($page);
            $count = Coupon::where('c_money','like',"%".$money."%")->whereBetween('created_at',[$start,$end])->count();
        }else{
            $coupon=Coupon::where('c_money','like','%'.$money.'%')->paginate($page);
            $count=Coupon::where('c_money','like','%'.$money.'%')->count();
        }
         

        return view('admin.coupons.index',['datas'=>$coupon,'count'=>$count,'id'=>$id]);
        
    }
    // 添加优惠券
    public function addcoupon(){
        return view('admin.coupons.add');
    }

    // 执行添加优惠券
    public function doaddcoupon(Request $reuqest)
    {

        // 最大优惠金额
        $maxmoney=$reuqest->data['c_money'];
        
        $res=Coupon::create([
            'uid'=>0,
            'c_money'=>$maxmoney,
            
            'c_status'=>1, //默认是未使用
        
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
       
        // dump($data);
        return view('admin.coupons.update',['data'=>$data,'id'=>$id]);
    }

    // 执行优惠券--修改
    public function exupdate(Request $request){
        // return $request->all();
        $res=Coupon::where('id',$request->data['id'])->update([
            'c_money'=>$request->data['c_money'],
        ]);

        if($res){
            return 'success';
        }else{
            return 'error';
        }
    } 
}
