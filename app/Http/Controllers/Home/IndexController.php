<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Turn;
use App\Models\Blog;
use App\Models\Good;

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

        return view('home.index.index',['turns' => $turns,'blogs' => $blogs,'sale' => $sale]);
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
        $sale = Good::orderBy('created_at','desc')->limit(3)->get(['id','g_name','g_img']);
        // return $sale;
        foreach($sale as $k => $v){
            $imgs = explode(',',$v->g_img);
            array_pop($imgs);
            $sale[$k]->g_img = $imgs[0];
        }
        return $sale;
    }
}
