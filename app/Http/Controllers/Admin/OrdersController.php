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

        // dd($request->all());
        // $start = $request->input('start') ?? '';
        // $end = $request->input('end') ?? '';
        $o_no  = $request->input('o_no') ?? '';
        // $contrller = $request->input('contrller') ?? '';

        $list= orders::with(['user','sends','orderdetails'])->where('o_no','like','%'.$o_no.'%')->orderBy('created_at','desc')->paginate(3);
        // dd($list);
        // if($start && $end && $o_no )

        // if($o_no){
        //     $list = orders::where('')
        // }

        
        return view('admin.Orders.orders',['list'=>$list]);
    }

    public function order_view($id){

        // $img = orders::with(['sends'])->get();

        $data =orderdetails::with(['refunds','good'])->get();

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
}
