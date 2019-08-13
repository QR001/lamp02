<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Blog;
use App\Models\Good;

class BlogsController extends Controller
{
    //全部活动
    public function blogAll()
    {
        $blogs = Blog::where('b_status',1)->paginate(3);
        
        foreach($blogs as $v){
            $goods = Good::where(['bid' => $v->id,'g_status' => 1])->limit(3)->get();
            foreach($goods as $g){
                $img = explode(',',$g->g_img);
                $g->img = $img[0];
            }
            $v->goods = $goods;
        }

        //热门话题
        $sblogs = Blog::where('b_status',1)->orderBy('updated_at','desc')->limit(5)->get();

        return view('home.blogs.blogAll',['blogs' => $blogs,'sblogs' => $sblogs]);
    }

    //活动详情
    public function bloglist($id)
    {
        //获取指定活动信息
        $blogs = Blog::where('b_status',1)->findOrFail($id);

        //获取相关活动的商品
        $goods = Good::where(['g_status' => 1,'bid' => $id])->paginate(2);
        foreach($goods as $g){
            $img = explode(',',$g->g_img);
            $g->img = $img[0];
        }

        //热门话题
        $sblogs = Blog::where('b_status',1)->orderBy('updated_at','desc')->limit(5)->get();

        return view('home.blogs.bloglist',['blogs' => $blogs,'sblogs' => $sblogs,'goods' => $goods]);

    }
}
