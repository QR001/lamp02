<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Good;

class BlogsController extends Controller
{
    //显示活动列表
    public function list()
    {
        //搜索的活动标题
        $b_title = $_GET['b_title'] ?? '';

        $blogs = Blog::where('b_title','like','%'.$b_title.'%')->paginate(3);
        $count = Blog::where('b_title','like','%'.$b_title.'%')->count();
        return view('admin.blogs.list',['blogs' => $blogs,'count' => $count]);
    }

    //显示添加活动页面
    public function blogs_create()
    {
        return view('admin.blogs.blogs_create');
    }

    //执行活动添加操作
    public function blogs_store(Request $request)
    {
        // return $request->all();
        $blog = [];
        $blog['b_title'] = $request->b_title;
        $blog['b_content'] = $request->b_content;
        $blog['b_time'] = $request->start . ' 至 ' . $request->end ;
        $blog['b_img'] = 'blog.jpg';
        //默认活动刚加入时 的状态 -》 关闭
        $blog['b_status'] = '2';
        $blog['created_at'] = date('Y-m-d H:i:s');
        $blog['updated_at'] = date('Y-m-d H:i:s');

        $status = 'error';
        $res = Blog::insertGetId($blog);
        if($res){
            $status = 'success';
        }

        return $status;
    }

    //修改活动状态
    public function blogs_status(Request $request)
    {
        $blog = Blog::findOrFail($request->id);
        $res = Blog::where('id',$request->id)->update(['b_status' => $request->b_status]);
        return $res ? 'success' : 'error' ;
    }

    //显示活动编辑页面
    public function blogs_edit($id)
    {
        $blog = Blog::findOrFail($id);
        if($blog){
            $date = explode(' 至 ',$blog->b_time);
            $blog->date = $date;
        }
        return view('admin.blogs.blogs_edit',['blog' => $blog]);
    }

    //执行活动修改操作
    public function blogs_update(Request $request)
    {
        // return $request->all();
        $blog = [];
        $blog['b_title'] = $request->b_title;
        $blog['b_time'] = $request->start . ' 至 ' .$request->end;
        $blog['b_content'] = $request->b_content;

        // return $blog;
        $res = Blog::where('id',$request->id)->update($blog);
        return $res ? 'success' : 'error' ;
    }

    //删除活动
    public function blogs_del($id)
    {
        // return $id;
        $blog = Blog::findOrFail($id);
        //将在此活动下的商品进行活动状态的修改
        Good::where('bid',$id)->update(['bid'=>0]);

        $res = Blog::destroy($id);
        $this->delimg($blog);
        return $res ? 'success' : 'error' ;
    }

    //显示活动封面
    public function blogs_img($id)
    {
        $blog = Blog::findOrFail($id);
        return view('admin.blogs.blogs_img',['blog' => $blog]);
    }

    //修改活动封面
    public function uploads(Request $request)
    {
        
        //获取活动信息
        $blog = Blog::findOrFail($request->id);
        //防止没有图片上传
        if(!empty($request->file('img'))){
            //修改商品图片信息
            $b_img = $this->getImg($request);
            if($b_img){
                $res = Blog::where('id',$request->id)->update(['b_img'=>$b_img]);
            }
            //活动信息修改成功，将原本的图片文件进行删除
            if($res){
                $this->delimg($blog);
            }
        }
        
        return back();

    }

   
    //上传图片的操作
    public function getImg($request)
    {
        $file = $request->file('img');
        
        // 判断图片上传中是否出错
        if (!$file->isValid()) {
            return back();
        }
       
        $fpath = "/blogs";
        $npath =  date('Ymd').'/'.time().rand(0,99999999);
        $ext = $file->extension();
        $path = $npath.'.'.$ext;
        // return $path;
                
        if(!$file->storeAs($fpath,$path)){
              $path = ''; 
        }

        return $path;
    }

    //删除图片操作
    public function delimg($blog)
    {
        if($blog->b_img != 'blog.jpg'){
            $path = public_path('/uploads/blogs/'.$blog->b_img);
            if(file_exists($path)){
                    
                unlink($path);  

            }
        }
    }

}
