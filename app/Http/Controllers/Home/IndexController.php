<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Turn;
use App\Models\Blog;
use App\Models\Good;
use App\Models\Sorts;

class IndexController extends Controller
{
    //商城首页面
    public  function index(){
        //获取轮播图图片
        $turns = $this->getTurns();
        //获取正在热销中的活动
        $blogs = $this->getBlogs();
        //获取今日推荐商品
        $sale = $this->getSale();
        // dump($sale);
        // return $sale;

        //获取分类 以及分类下的商品
        $sort = $this->getSorts();

        // dump($sort);
        return view('home.index.index',['turns' => $turns,'blogs' => $blogs,'sale' => $sale,'sort' => $sort]);
    }

    //分类
    public function getSorts(){
        //获取一级分类数据
        $sort1 = Sorts::where('s_pid',0)->get();
        foreach($sort1 as $k=>$v){
            //二级分类数据
            $sort2 = Sorts::where('s_pid',$v->id)->get();
            //声明数组 用于获取所有二级板块数据
            $sfid = [];           
            foreach($sort2 as $k2=>$v2){
                $sfid[] = $v2->id;
                
                //三级分类数据
                $sort3 = Sorts::where('s_pid',$v2->id)->get();
                $sort2[$k2]->sort3 = $sort3;
            }

            //声明空数组 用于存放相关板块的商品
            $goods = Good::where('g_status','1')->whereIn('sfid',$sfid)->orderBy('updated_at','desc')->limit(8)->get();
            foreach($goods as $v){
                $imgs = explode(',',$v->g_img);
                $v->img = $imgs[0];
            }

            $sort1[$k]->sort2 = $sort2;
            $sort1[$k]->goods = $goods;
        }
  
        return $sort1;
    }

    //获取轮播图图片
    public function getTurns()
    {
        $turns = Turn::where('id',1)->first();
        // return $turns;
        $imgs = explode(',',$turns->t_img);
        array_pop($imgs);
        return $imgs;
    }

    //获取正在热销中的活动
    public function getBlogs()
    {
        $blogs = Blog::where('b_status','1')->orderBy('updated_at','desc')->limit(4)->get();
        return $blogs;
    }

    //获取今日推荐商品
    public function getSale()
    {
        $sale = Good::where('g_status','1')->orderBy('created_at','desc')->limit(3)->get(['id','g_name','g_img']);
        foreach($sale as $k => $v){
            $imgs = explode(',',$v->g_img);
            array_pop($imgs);
            $sale[$k]->g_img = $imgs[0];
        }
        return $sale;
    }

    

    //商品主题
    public function goodmotif()
    {
        
    }
}
