<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\collects;
use DB;

class CartController extends Controller
{
    // 显示购物车
    public function index (){
        
        // 判断用户是否登录
        if(!session('home.id')){
          return view('home.login.index');
        }

        $res=Cart::join('goods','goods.id','carts.gid')->where(['carts.uid'=>session('home.id')])->get();
        
      
        foreach($res as $k=>$v){
            $gimg=explode(',',$v->g_img);
            // 商品的图片
            $res[$k]['g_img']=$gimg[0];
            
        }

        // 查询该用户是否有优惠券
        
        return view('home.carts.index',['carts'=>$res]);
    }

    // 移入收藏夹
    public function updatecollect($id){
        $uid = session('home.id');

        DB::beginTransaction();
        // 从购物车表里删除改商品
        //存入收藏夹 
        $collect= collects::create(['uid'=>$uid,'gid'=>$id]);
        $res2=Cart::destroy($id);
        if($collect && $res2){
            DB::commit();
            return view('home.userinfo.userinfo_collect');
        }else{
            DB::rollback();
            return back();
        }
    }

    public function cart(Request $request)
    {
        return $request;
    }
    // 移出收藏夹
    public function chardelete($id)
    {   
        DB::beginTransaction();
       $delete = DB::table('carts')->where('gid',$id)->delete();

    
       if($delete){
        DB::commit();
        return back();
       }else{
        DB::rollback();
        return back();
       }
    }

}
