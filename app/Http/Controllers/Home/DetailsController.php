<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Good;
use App\Models\user;
use DB;
use App\Models\Comment;
use App\Models\coupon;

class DetailsController extends Controller
{
    //
     public function index($id){
        // dd($id);
        //查找 商品 商品详情 
        $data =Good::join('details','details.gid','goods.id')->where('goods.id',$id)->first();
        // dd($data->g_sales);
        
        //商品的销量
        $orders=Good::join('orderdetails','orderdetails.gid','goods.id')->where(['goods.id'=>$id,'d_status'=>1])->count();
        if($orders !=0){
            $g_sales = $data->g_sales +  $orders;
        }

      
        // 商品的评论
        $data2=Comment::where('gid',$id)->paginate(2);
        $count=Comment::where('gid',$id)->count();

        $image = explode(',',$data->g_img);
        array_pop($image);
        $color = explode(',',$data->g_color);

        
      
        //查找优惠卷
        $uid = session('home.id');
        $coupons = coupon::where(['uid'=>0,'c_status'=>1])->orderBy('c_time','desc')->get();
        // dd($coupons);

        //查找所有商品
        $goods = Good::offset(0)->limit(3)->get();
        foreach($goods as $k=>$v){
            $img = explode(',',$v->g_img);
            array_pop($img);
        }
      
      

        foreach($data2 as $k=>$v){
            
            // 该条评论的头像
            $v['userinfo']=DB::table('users')->join('userdetails','users.id','=','userdetails.uid')->where('users.id',$v->uid)->first();
            // 评论的图片
            $a= explode(',', $v->c_img);
            
            
            
            $v['comment_imgs']=array_pop($a);
            $v['comment_imgs'] = $a;
           
        }

       
        return view('home.goods.goodInfo',['data'=>$data,'image'=>$image,'color'=>$color,'comment'=>$data2,'goods'=>$goods,'img'=>$img,'coupons'=>$coupons,'count'=>$count,'g_sales'=>$g_sales]);
    }

   public function coupons($id)
   {
        $uid = session('home.id');

        $coupons = DB::table('coupons')->where('id',$id)->update(['uid'=>$uid]);
        
        if($coupons){
            return back();
        }
   }
}
