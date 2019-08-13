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
        // dd($res);
        return view('home.carts.index',['carts'=>$res]);
    }

    // 移入收藏夹
    public function updatecollect($id){
        $uid = session('home.id');

        DB::beginTransaction();
        // 从购物车表里删除改商品

        //存入收藏夹 
        $collect= collects::create(['uid'=>$uid,'gid'=>$id]);
<<<<<<< HEAD
        // $res2=Cart::destroy($id);
        $res2=Cart::where('gid',$id)->delete();
=======
        
        $res2=Cart::where('gid',$id)->delete();
        
>>>>>>> origin/zhangyahan
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
        $uid = session('home.id');
        if(!$uid){
            return 'nologin';
        }
        $arr = ['uid' => $uid,'gid' => $request->id,'c_color' => $request->color];
        $res = DB::table('carts')->where($arr)->get();
        if(isset($res[0])){
            $res = DB::table('carts')->where($arr)->update(['c_num' => $res[0]->c_num + $request->number]);
        }else{
            $arr['c_num'] = $request->number;
            $res = DB::table('carts')->insert($arr);
        }
        if($res){
            return 'success';
        }else{
            return 'error';
        }

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
