<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Link;

class SystemsController extends Controller
{
    //默认返回结果标识
    static $status = 'error';

    //查询指定数据是否存在
    public static function findLink($id)
    {
        return Link::find($id);
    }

    //显示友情链接列表页面
    public function links()
    {
        //查询条件 
        //l_name 链接名称
        $l_name = $_GET['l_name'] ?? '' ;
        //start 开始日期    end 截止日期
        $start = $_GET['start'] ?? '' ;
        $end = $_GET['end'] ?? '' ;

        if($start && $end && $start <= $end){
            $links = Link::where('l_name','like',"%".$l_name."%")->whereBetween('created_at',[$start,$end])->paginate(3);
            $count = Link::where('l_name','like',"%".$l_name."%")->whereBetween('created_at',[$start,$end])->count();
        }else{
            $links = Link::where('l_name','like',"%".$l_name."%")->paginate(3);
            $count = Link::where('l_name','like',"%".$l_name."%")->count();
        }
        
        return view('admin.systems.links',['links' => $links,'count' => $count]);
    }

    //显示友情链接添加页面
    public function links_create()
    {
        return view('admin.systems.links_create');
    }

    //执行友情链接添加操作
    public function links_store(Request $request)
    {
        $links = new Link;
        $links->l_name = $request->l_name;
        $links->l_url = $request->l_url;
        $links->l_status = $request->l_status;

        if($links->save()){
            $status = 'success';
        }else{
            $status = 'error';
        }

        return $status; 
    }

    //更改友情链接的状态
    public function links_status(Request $request)
    {
        
        $link = self::findLink($request->id);

        if($link){
            $link->l_status = $request->l_status;
            if($link->save()){
                self::$status = 'success';
            }
            
        }
        
        return self::$status;
        
    }

    // 编辑友情链接
    public function links_edit($id)
    {
        $link = Link::findOrFail($id);
        
        return view('admin.systems.links_edit',['link' => $link]);
        
    }

    //执行友情链接修改操作
    public function links_update(Request $request)
    {

        $link = self::findLink($request->id);
        
        if($link){
            $link->l_name = $request->l_name;
            $link->l_url = $request->l_url;
            $link->l_status = $request->l_status;
            
            if($link->save()){
                self::$status = 'success';
            }

        }
        
        return self::$status;
        
    }

    // 删除指定友情链接
    public function links_del($id)
    { 
         
        if(self::findLink($id)){
            if(Link::destroy($id)){
                self::$status = 'success';
            };
        }

        return self::$status;
    }

    // 批量删除
    public function links_delAll(Request $request)
    {
        if($request->idAll){
            //多条数据id进行便利，其中一个不存在，则取消此次操作
            foreach($request->idAll as $v){
                $link = self::findLink($v);
                if(!$link){
                    //所勾选的商品中含有不存在的商品
                    self::$status = 'false';
                }
            }
        }else{
            self::$status = 'none'; 
        }  

        if(self::$status == 'error' && Link::destroy($request->idAll)){
            self::$status = 'success';
        }

        return self::$status;
    }


}
