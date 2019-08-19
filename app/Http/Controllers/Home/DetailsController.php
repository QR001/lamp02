<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Good;
use App\Models\user;
use DB;
use App\Models\Comment;
use App\Models\coupon;
use App\Models\Track;
<<<<<<< HEAD
=======
use App\Models\Web;
use App\Models\collects;
use App\Models\Cart;
>>>>>>> origin/zhangyahan

class DetailsController extends Controller
{
    
     public function index($id){
<<<<<<< HEAD
        //查找 商品 商品详情 
        $data =Good::join('details','details.gid','goods.id')->where('goods.id',$id)->first();
        // dd($data->g_sales);
    
        // dump($data);
        // 商品的评论
        $data2=Comment::where('gid',$id)->paginate(2);
        //全部评论数量
        $qcount=Comment::where('gid',$id)->count();
        //好评度
        $gcount = Comment::where(['gid' => $id,'c_score' => 3])->count();

        if($gcount && $qcount){
            $num = ceil($gcount / $qcount * 100) . '%'; 
        }else{
            $num = '30%';
        }
        

=======
        //网站配置
        $web=Web::find(1); 
  
        if($web){
            if($web->w_isopen ==2){
                return view('errors.close');
            }
        }else{
            $web='';
        }

        //查找 商品 商品详情 
        $data =Good::join('details','details.gid','goods.id')->where('goods.id',$id)->first();
       
        // 商品的评论
        $data2 = Comment::where('gid',$id)->paginate(2);
        //全部评论数量
        $qcount = Comment::where('gid',$id)->count();
        //好评度
        $gcount = Comment::where(['gid' => $id,'c_score' => 3])->count();

        if($gcount && $qcount){
            $num = ceil($gcount / $qcount * 100) . '%'; 
        }else{
            $num = '30%';
        }
        

>>>>>>> origin/zhangyahan
        //中评数量
        $mcount = Comment::where(['gid' => $id,'c_score' => 2])->count();
        
        //差评数量
        $lcount = Comment::where(['gid' => $id,'c_score' => 1])->count();
        
        $count = ['qcount' => $qcount,'gcount' => $gcount,'mcount' => $mcount,'lcount' => $lcount,'num' => $num];
<<<<<<< HEAD
        // dd($count);
=======
>>>>>>> origin/zhangyahan
        
        //商品详情图
        $image = explode(',',$data->g_img);
        array_pop($image);
        $color = explode(',',$data->g_color);
      
        //查找优惠卷
        $coupons = coupon::where(['uid'=>0,'c_status'=>1])->get();
<<<<<<< HEAD
        // dump($coupons);

=======
     
>>>>>>> origin/zhangyahan
        //推荐最新相似商品
        $goods = Good::where(['sid' => $data->sid,'g_status' => 1])->orderBy('updated_at','desc')->limit(3)->get();
        foreach($goods as $k=>$v){
            $img = explode(',',$v->g_img);
            array_pop($img);
            $v->img = $img[0];

        };
<<<<<<< HEAD

        //猜你喜欢
        $lgoods = Good::where(['sid' => $data->sid,'g_status' => 1])->paginate(1);
        foreach($lgoods as $k=>$v){
            $img = explode(',',$v->g_img);
            array_pop($img);
            $v->img = $img[0];
        };

=======

        //猜你喜欢
        $lgoods = Good::where(['sid' => $data->sid,'g_status' => 1])->paginate(1);
        foreach($lgoods as $k=>$v){
            $img = explode(',',$v->g_img);
            array_pop($img);
            $v->img = $img[0];
        };

>>>>>>> origin/zhangyahan
        //评论数据处理
        foreach($data2 as $k=>$v){
            // 该条评论的头像
            $v['userinfo'] = DB::table('users')->join('userdetails','users.id','=','userdetails.uid')->where('users.id',$v->uid)->first();
            // 评论的图片
<<<<<<< HEAD
            $a= explode(',', $v->c_img);       
=======
            $a = explode(',', $v->c_img);       
>>>>>>> origin/zhangyahan
            
            array_pop($a);
            $v['comment_imgs'] = $a;
           
        };
<<<<<<< HEAD

        if(session('home.id')){
            $track = Track::where(['uid' => session('home.id'),'gid' => $id])->first();
            if($track){
                Track::where(['uid' => session('home.id'),'gid' => $id])->update(['updated_at' => date('Y-m-d H:i:s')]);
            }else{
                Track::insert(['uid' => session('home.id'),'gid' => $id,'created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s')]);
            }

        }
       
        return view('home.goods.goodInfo',['count' => $count,'lgoods' => $lgoods,'data'=>$data,'image'=>$image,'color'=>$color,'comment'=>$data2,'goods'=>$goods,'img'=>$img,'coupons'=>$coupons]);
=======

        if(session('home.id')){
            $track = Track::where(['uid' => session('home.id'),'gid' => $id])->first();
            if($track){
                Track::where(['uid' => session('home.id'),'gid' => $id])->update(['updated_at' => date('Y-m-d H:i:s')]);
            }else{
                Track::insert(['uid' => session('home.id'),'gid' => $id,'created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s')]);
            }

        }
       
        return view('home.goods.goodInfo',['count' => $count,'lgoods' => $lgoods,'data'=>$data,'image'=>$image,'color'=>$color,'comment'=>$data2,'goods'=>$goods,'img'=>$img,'coupons'=>$coupons,'web'=>$web]);
>>>>>>> origin/zhangyahan
    }


    // 优惠券
   public function coupons($id)
   {
        $uid = session('home.id');
        if(!$uid){
            return 'nologin';
        }
        $yh = DB::table('coupons')->find($id);
        if(!$yh){
            return 'noexists';
        }

        $data = DB::table('coupons')->where('uid',$uid)->get();
        if(isset($data[0])){
            return 'exists';
        }

        $coupons = DB::table('coupons')->where('id',$id)->update(['uid'=>$uid]);
        
        if($coupons){
            return 'success';
        }else{
            return 'error';
<<<<<<< HEAD
=======
        }
   }
    //加入收藏    
   public function joincollect($id){
       
        $uid = session('home.id');
        //存入收藏夹 
        // 查看商品是否在收藏夹里
        $res = collects::where(['gid'=>$id,'uid'=>$uid])->first();
       
        if($res){
       
            // 从购物车表里删除改商品
            return 'error';
        }else{
            collects::create(['uid'=>$uid,'gid'=>$id]);

            return 'success';
>>>>>>> origin/zhangyahan
        }
   }
}
