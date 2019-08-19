<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\collects;
use App\Models\Web;
use DB;

class CartController extends Controller
{
    // 显示购物车
    public function index (){
        
        //网站配置
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

        $res=Cart::join('goods','goods.id','carts.gid')->where(['carts.uid'=>session('home.id')])->get();
       
        foreach($res as $k=>$v){
            $gimg=explode(',',$v->g_img);
            // 商品的图片
            $res[$k]['g_img']=$gimg[0];
        }
    
        return view('home.carts.index',['carts'=>$res,'web'=>$web]);
    }

    // 移入收藏夹
    public function updatecollect($id){
        $uid = session('home.id');

        //存入收藏夹 
<<<<<<< HEAD
        $collect= collects::create(['uid'=>$uid,'gid'=>$id]);
        // $res2=Cart::destroy($id);
        $res2=Cart::where('gid',$id)->delete();
        if($collect && $res2){
            DB::commit();
            return view('home.userinfo.userinfo_collect');
=======
        // 查看商品是否在收藏夹里
        $res=collects::where(['gid'=>$id,'uid'=>$uid])->first();
        if($res){
            // 从购物车表里删除改商品
            $res2=Cart::where('gid',$id)->delete();
            if($res2){
                DB::commit();
                return redirect('/home/userinfo_collect');
            }else{
                DB::rollback();
            }
            return redirect('/home/userinfo_collect');
>>>>>>> origin/zhangyahan
        }else{
            $collect= collects::create(['uid'=>$uid,'gid'=>$id]);

            $res2=Cart::where('gid',$id)->delete();
            if($collect && $res2){
                DB::commit();
                return redirect('/home/userinfo_collect');
            }else{
                DB::rollback();
                return back();
            }
        }
       
        
        
    }

    // 加入购物车
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

<<<<<<< HEAD
=======

>>>>>>> origin/zhangyahan
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
