<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Good;
use App\Models\Detail;
use App\Models\Comment;
use App\Models\sorts;

class GoodsController extends Controller
{
    //显示商品详情
    public function goodInfo($id)
    {
        //确定该商品是否存在
        $good = Good::findOrFail($id);
        // return $good;


        return view('home.goods.goodInfo');
    }

    //全局搜索下的商品列表
    public function goodSearch($type = 'time')
    {
        //商品查询依据条件排序
        if($type == 'time'){
            $goods = Good::where('g_status','1')->where('g_name','like','%'.$_GET['gname'].'%')->orderBy('updated_at','desc')->paginate(1); 
        }elseif($type == 'sales'){
            $goods = Good::where('g_status','1')->where('g_name','like','%'.$_GET['gname'].'%')->orderBy('g_sales','desc')->paginate(2);
        }elseif($type == 'price'){
            $goods = Good::where('g_status','1')->where('g_name','like','%'.$_GET['gname'].'%')->orderBy('g_nprice')->paginate(2);
        }else{
            $goods = Good::where('g_status','1')->where('g_name','like','%'.$_GET['gname'].'%')->orderBy('updated_at','desc')->paginate(2);
        }
       
        foreach($goods as $v){
            $img = explode(',',$v->g_img);
            $v->img = $img[0];
        }

        return view('home.goods.goodSearch',['type'=>$type,'goods' => $goods]);
    }

    /**
     * 板块下的商品列表
     * 
     * @param 顶级板块的id,所查询的相对应的二级板块的键,三级板块的id
     *  */
    public function goodlist($sid,$kv = 'none',$sortv = 'none',$type = 'time')
    {
        //查询相关板块下的二级板块
        $sort2 = sorts::where('s_pid',$sid)->get();
        if(!$sort2){
            return back();
        }
        //声明空数组，用于存放所选择的板块
        $goods = [];
        foreach($sort2 as $k => $v){
            //获取三级板块
            $sort2[$k]->sort3 = sorts::where('s_pid',$v->id)->get();
            //@param 已经选择板块并且选择的板块事当前遍历的板块
            if($kv != 'none' && $sortv != 'none' && $kv == $k){
                $goods[$kv] = $sortv;
            }elseif($kv != 'none' && $sortv != 'none' && session()->get('goods')[$k] != $v->id){
                //该板块选择过
                $goods[$k] = session()->get('goods')[$k];
            }else{
                //默认指向
                $goods[$k] = $v->id;
            }

        }   

        // dump($goods);
        //用于存放用户所选择板块的信息
        session()->put('goods', $goods);

        // dump($goods);die;
        
        //获取相关三级板块的id
        $sidlist = [];
        foreach($goods as $v){
            $sorts = sorts::find($v,['s_path']);
            if(substr_count($sorts->s_path,',') == 2){
                $sids = sorts::where('s_pid',$v)->get();
                foreach($sids as $v){
                    $sidlist[] = $v->id;
                }
            }else{
                $sidlist[] = $v;
            }
        }

        //商品查询依据条件排序
        if($type == 'time'){
            $goodlist = Good::where('g_status','1')->WhereIn('sid',$sidlist)->orderBy('updated_at','desc')->paginate(2); 
        }elseif($type == 'sales'){
            $goodlist = Good::where('g_status','1')->WhereIn('sid',$sidlist)->orderBy('g_sales','desc')->paginate(2);
        }elseif($type == 'price'){
            $goodlist = Good::where('g_status','1')->WhereIn('sid',$sidlist)->orderBy('g_nprice')->paginate(2);
        }else{
            $goodlist = Good::where('g_status','1')->WhereIn('sid',$sidlist)->orderBy('updated_at','desc')->paginate(2);
        }



        foreach($goodlist as $v){
            $img = explode(',',$v->g_img);
            $v->img = $img[0];
        }


        return view('home.goods.goodlist',['sid' => $sid,'kv' => $kv,'sortv' => $sortv,'type' => $type,'sort2' => $sort2,'goods' => $goodlist]);
    }
}
