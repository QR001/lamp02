<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// use App\Models\user;
// use App\Models\sends;
use App\Models\orders;
use App\Models\orderdetails;

use App\Models\refunds;

class OrdersController extends Controller
{
    //

    public function index(Request $request)
    {

        $o_no  = $request->input('o_no') ?? '';
        $list= orders::with(['user','sends','orderdetails'])->where('o_no','like','%'.$o_no.'%')->orderBy('created_at','desc')->paginate(3);
        $count= orders::with(['user','sends','orderdetails'])->where('o_no','like','%'.$o_no.'%')->count();
        return view('admin.Orders.orders',['list'=>$list,'count'=>$count]);
    }

    public function order_view($id){

        // $img = orders::with(['sends'])->get();

        $data =orderdetails::with(['refunds','good'])->where('id','=',$id)->get();
        // dd($data);
        return view('admin.Orders.order_view',['data'=>$data]);
    }


   
        //删除单个
    public function delete($id)
    {
        $data= orders::find($id);
        $data->orderdetails()->delete();
        $data->delete();
        
        // $data = orders::destroy($id);

       if($data){
           return 'success';
       }else{
           return 'error';
       }
       
    //    return $data ? 'success' : 'error';
    }


    public function store(Request $request)
    {
        
    }

    public function status()
    {
        // return $_GET;
        $id = $_GET['id'];
        $status = $_GET['status'];
        $res=orderdetails::where('id',$id)->update(['d_status'=>$status]);
        if($res){
            return 'success';
        }else{
            return 'error';
        }
    }

    //批量删除
    public function pdelete(Request $request){
        // return $request;
        $data= explode(',',$request->data);
        // return $data;
        foreach($data as $v){
            $data = orders::find($v);
            $data->orderdetails()->delete();
            $data->refunds()->delete();
            $data->delete();
        }


    }
}
