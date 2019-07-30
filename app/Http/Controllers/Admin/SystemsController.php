<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Link;

class SystemsController extends Controller
{
    //显示友情链接列表页面
    public function links()
    {
        $links = Link::paginate(3);
        return view('admin.systems.links',['links' => $links]);
    }

    //显示友情链接添加页面
    public function links_create()
    {
        return view('admin.systems.links_create');
    }

    //执行友情链接添加操作
    public function links_store(Request $request)
    {
        // return $request -> all();
        $links = new Link;
        $links -> l_name = $request -> l_name;
        $links -> l_url = $request -> l_url;
        $links -> l_status = $request -> l_status;

        if($links -> save()){
            $status = 'success';
        }else{
            $status = 'error';
        }

        return $status;

        
    }
}
