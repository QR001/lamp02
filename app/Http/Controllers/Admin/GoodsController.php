<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Good;
use App\Models\Detail;
use App\Models\Blog;
use App\Models\Comment;
use App\Models\user;

class GoodsController extends Controller
{
    //显示商品列表页面
    public function list()
    {   
        //查询销售状态
        $g_status = $_GET['g_status'] ?? '1' ;
        //搜索的商品名称
        $g_name = $_GET['g_name'] ?? '';
        //start 开始日期    end 截止日期
        $start = $_GET['start'] ?? '' ;
        $end = $_GET['end'] ?? '' ;

        if($start && $end && $start < $end){
            $goods = Good::where(['g_status' => $g_status])
                            ->where('g_name','like',"%".$g_name."%")
                            ->whereBetween('created_at',[$start,$end])
                            ->paginate(3);
            $count = Good::where(['g_status' => $g_status])
                            ->where('g_name','like',"%".$g_name."%")
                            ->whereBetween('created_at',[$start,$end])
                            ->count();
        }else{
            $goods = Good::where(['g_status' => $g_status])
                            ->where('g_name','like',"%".$g_name."%")
                            ->paginate(3);
            $count = Good::where(['g_status' => $g_status])
                            ->where('g_name','like',"%".$g_name."%")
                            ->count();
        }
        
        return view('admin.goods.list',['goods' => $goods,'count' => $count]);
    }

    //显示商品添加页面
    public function goods_create()
    {
        $blog = Blog::get();
        return view('admin.goods.goods_create',['blog' => $blog]);
    }

    //显示商品图片页面
    public function goods_img($id)
    {
        $good = Good::find($id,['g_img','id']);
        $imgs =  explode(',',$good->g_img);
        array_pop($imgs);
        $good->g_img = $imgs;
        // return $good;
        return view('admin.goods.goods_img',['good' => $good]);
    }

    //执行修改商品图片的操作
    public function uploads(Request $request)
    {
        //获取商品信息
        $good = Good::findOrFail($request->id);
        //防止没有图片上传
        if(!empty($request->file('img'))){
            //修改商品图片信息
            $g_img = $this->getImg($request);
            $res = Good::where('id',$request->id)->update(['g_img'=>$g_img]);
            //商品信息修改成功，将原本的图片文件进行删除
            if($res){
                $this->delimg($good);
            }
        }
        
        return back();

    }

   
    //上传图片的操作
    public function getImg($request)
    {
        $file = $request->file('img');
        $filePath = [];  // 定义空数组用来存放图片路径
        
        foreach ($file as $key => $value) {
            // 判断图片上传中是否出错
            if (!$value->isValid()) {
                return back();
            }
            if(!empty($value)){//此处防止没有多文件上传的情况
                $fpath = "/goods";
                $npath =  date('Ymd').'/'.time().rand(0,99999999);
                $ext = $value->extension();
                $path = $npath.'.'.$ext;
                if($value->storeAs($fpath,$path)){
                    $filePath[] = $path;
                }
            }
        }

        $g_img = implode(',',$filePath) . ',';

        return $g_img;
    }

    //删除图片操作
    public function delimg($good)
    {
        $imgs = explode(',',$good->g_img);
        array_pop($imgs);
        foreach($imgs as $v){
            if($v != 'default.jpg'){
                $path = public_path('/uploads/goods/'.$v);
                if(file_exists($path)){  
                    unlink($path);  
                }
            }
        }
    }
 

    //执行商品添加操作
    public function goods_store(Request $request)
    {
        DB::beginTransaction();

        //对商品的基本信息作出处理并返回
        $good = self::fetchData($request,'create');
        //执行插入数据操作
        $id = Good::insertGetId($good);

        //判断是否插入成功，成功 完善商品详情表
        if($id){

            $res = $this->detailStore($request,$id);
            if($res){
                DB::commit();
                $status = 'success';
            }else{
                DB::rollBack();
                $status = 'error';
            }  
        }else{
            $status = 'error';
        }

        return $status;        
    }

    //完善商品详情信息
    public function detailStore($request,$id)
    {
        $detail = new Detail;

        $detail->gid = $id;
        $detail->d_trait = $request->d_trait;
        $detail->d_prompt = $request->d_prompt;
        $detail->d_explain = $request->d_explain;

        $res = $detail->save();
        
        return $res ? true : false ;
    }

    //显示商品编辑页面
    public function goods_edit($id)
    {
        
        $goods = Good::findOrFail($id);
        //获取所有商品颜色，对数据进行处理
        if($goods->g_color){
            $goods->g_color = explode(',',$goods->g_color);
        }
        
        //获取商品的尺寸，对数据进行处理
        if($goods->g_size){
            $goods->g_size = explode(' x ',$goods->g_size);
        }
        //获取商品的详情信息
        $goods->details = $goods->detail;
        //查询现有活动
        $blog = Blog::get();
        // dump($goods);
        return view('admin.goods.goods_edit',['goods' => $goods,'blog' => $blog]);
    }

    //执行商品修改操作
    public function goods_update(Request $request)
    {
        DB::beginTransaction();
        
        //对商品的基本信息作出处理并返回
        $good = self::fetchData($request,'update');

        //准备需要完善的商品信息的数据
        $detail = [];
        $detail['d_trait'] = $request->d_trait;
        $detail['d_prompt'] = $request->d_prompt;
        $detail['d_explain'] = $request->d_explain;

        //执行商品基本信息的修改
        $res1 = Good::where('id',$request->id)->update($good);
        //执行商品详情信息的修改
        $res2 = Detail::where('gid',$request->id)->update($detail);

        if($res1 && $res2){
            DB::commit();
            $status = 'success';
        }else{
            DB::rallBack();
            $status = 'error';
        }

        return $status;
    }

    /**
     * 对商品信息数据操作公共代码进行提取
     * 
     * @param $request 要操作的数据   $type 用途 'create'->添加  'update'->修改
     * 
     *  */
    public static function fetchData($request,$type)
    {
        //准备要插入的信息
        $good = [];
        $good['bid'] = $request->bid;
        $good['g_name'] = $request->g_name;
        $good['g_oprice'] = $request->g_oprice;
        $good['g_nprice'] = $request->g_nprice;
        //将商品颜色数据进行处理
        $color = '';
        if(count($request->g_color)){
            foreach($request->g_color as $v){
                $color .= $v.','; 
            }
            $color = rtrim($color,',');
        }

        $good['g_color'] = $color;
        $good['g_status'] = $request->g_status;
        if($request->g_size1 && $request->g_size2 && $request->g_size3){
            $size = $request->g_size1 . ' x ' . $request->g_size2 . ' x ' . $request->g_size3;
        }else{
            $size = '';
        } 
        $good['g_size'] = $size;
        $good['g_integral'] = $request->g_integral;
        $good['g_stock'] = $request->g_stock; 
        $good['updated_at'] = date('Y-m-d H:i:s');

        if($type == 'create'){
            $good['g_sales'] = 0;
            $good['g_img'] = 'default.jpg,';
            $good['created_at'] = date('Y-m-d H:i:s');
        }

        return $good;
    }

    //删除指定商品
    public function goods_del($id)
    {
        $good = Good::findOrFail($id);
        $res = Good::destroy($id);
        if($res){
            $this->delimg($good);
        }
        return $res ? 'success' : 'error' ;
    }

    //批量删除商品
    public function goods_delAll(Request $request)
    {
        $status = 'error';
        if($request->idAll){
            //多条数据id进行便利，其中一个不存在，则取消此次操作
            foreach($request->idAll as $v){
                $good = Good::find($v);
                if(!$good){
                    //所勾选的商品中含有不存在的商品
                    $status = 'false';
                }
            }
        }else{
            $status = 'none'; 
        }  

        // return $status;

        if($status == 'error'){
            foreach($request->idAll as $v){
                $good = Good::findOrFail($v);
                // return $good;
                $res = Good::destroy($v);
                // return $res;
                if($res){
                    $this->delimg($good);
                }
            }
            $status = 'success';
        }

        return $status;
    }

    public function comments($id)
    {
        $c_score = $_GET['c_score'] ?? '';
        if($c_score){
            $res = User::join('comments','users.id','=','comments.uid')
                        ->where(['comments.gid' => $id,'comments.c_score' => $c_score])
                        ->paginate(3);
            $count = User::join('comments','users.id','=','comments.uid')
                            ->where(['comments.gid' => $id,'comments.c_score' => $c_score])
                            ->count();
        }else{
            $res = User::join('comments','users.id','=','comments.uid')
                    ->where(['comments.gid' => $id])
                    ->paginate(3);
            $count = User::join('comments','users.id','=','comments.uid')
                    ->where(['comments.gid' => $id])
                    ->count();
        }
        

        return view('admin.goods.comments',['comments' => $res,'count' => $count,'goodId' => $id]);
    }

    //查看评论的详细内容
    public function comments_img($id)
    {
        $comment = Comment::findOrFail($id);
        $imgs = explode(',',$comment->c_img);
        array_pop($imgs);
        return view('admin.goods.comments_img',['imgs' => $imgs]);
    }
}
