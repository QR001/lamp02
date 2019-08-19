<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\user;
use App\Models\pay;
use App\Models\orders;
use App\Models\orderdetails;
use App\Models\sends;
use App\Models\refunds;
use App\Models\payment;
use DB;

class OrdersController extends Controller
{
    //

    public function index(Request $request)
    {
        // dd($request->all());
        $o_no  = $request->input('o_no') ?? '';
        $list= orders::with(['user','sends','orderdetails'])->where('o_no','like','%'.$o_no.'%')->orderBy('created_at','desc')->paginate(3);
        // dd($list['user']);
        $count= orders::with(['user','sends','orderdetails'])->where('o_no','like','%'.$o_no.'%')->count();
        return view('admin.Orders.orders',['list'=>$list,'count'=>$count]);
    }

    public function order_view($id){

        // $img = orders::with(['sends'])->get();

        $data =orderdetails::with(['refunds','good'])->where('oid','=',$id)->get();

        
     
       foreach($data as $k=>$v){
            $uid = $v['refunds']['uid'];
            $img = explode(',',$v['good']['g_img']);
            array_pop($img);
       }
        return view('admin.Orders.order_view',['data'=>$data,'img'=>$img,'uid'=>$uid]);
    }
    //修改状态
    public function status()
    {
    //    return $_GET;
        $uid = $_GET['uid'];
        $id = $_GET['id'];
        $status = $_GET['status'];
        $res = refunds::find($id);
        
        $payments = $res->payments;
     
        $user = payment::where('uid','=',$uid)->get();
        foreach($user as $k=>$v){
            $balance = $v->balance;
        }
      
        $number = $payments + $balance; 
        // return $number;
       
        $res = payment::where('uid',$uid)->update(['balance'=>$number]);
        
        
        if($res){
            $add=orderdetails::where('id',$id)->update(['d_status'=>$status]);
            if($add){
                return 'success';
            }else{
                return 'error';
            }
        };
        // 
      
        // $status = $_GET['status'];
       
        // $res=orderdetails::where('id',$id)->update(['d_status'=>$status]);
        
        // if($res){
        //     return 'success';
        // }else{
        //     return 'error';
        // }
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

    //添加物流方式 
    public function order_cends(Request $request){
       
        $s_express  = $request->input('s_express') ?? '';
        $page=3;
        $data = sends::where('s_express','like','%'.$s_express.'%')->paginate($page);
         // 当前的页数
        $currentPage=$_GET['page'] ?? 1;
        $id=($currentPage-1)*$page+1;

        $count = sends::count();

        return view('admin.orders.order_cends',['data'=>$data,'id'=>$id,'count'=>$count]);
    }

    // 添加图片
    public function order_add(Request $request){

        $validatedData = $request->validate([
            's_express' => 'min:2|max:50|unique:sends'
        ],[
            's_express.min'=>'物流名称不得低于2个字符',
            's_express.max'=>'物流名称不得高于50个字符',
            's_express.unique'=>'物流名称已存在'
        ]);
       
        if ($request->hasFile('s_img')) {
            // 获取文件后缀
            $ext=$request->file('s_img')->extension();
            // 文件名 
            $filename=time().rand(0,100);
            
            $path = $request->file('s_img')->storeAs('/express',date('Ymd').'/'.$filename.','.$ext);
            // dd($path);
            //写入数据库
            sends::create([
                's_express'=>$request->s_express,
                's_img'=>$path,
            ]);
            return back();
                     
        }else{
            return back();
        }
    }
    //修改物流方式的图片页面
    public function order_update($id)
    {
        $sends = sends::find($id);
        
        $name = $sends->s_express;
        $id = $sends->id;
        return view('admin.Orders.order_update',['name'=>$name,'id'=>$id]);
   
       
    }
    //执行修改物流方式的图片
    public function order_update_add(Request $request)
    {
        $validatedData = $request->validate([
            's_express' => 'min:2|max:50'
        ],[
            's_express.min'=>'物流名称不得低于2个字符',
            's_express.max'=>'物流名称不得高于50个字符',
            // 's_express.unique'=>'物流名称已存在'
        ]);
        $data = sends::find($request->id);
        // dd($data->s_img);
        if ($request->hasFile('s_img')) {
            // 获取文件后缀
            $ext=$request->file('s_img')->extension();
            // 文件名 
            $filename=time().rand(0,100);
            
            $path = $request->file('s_img')->storeAs('/express',date('Ymd').'/'.$filename.','.$ext);
            // dd($path);
            //写入数据库
            sends::where('id',$request->id)->update([
                's_express'=>$request->s_express,
                's_img'=>$path,
            ]);
            return back();
                     
        }else{
            return back();
        }
    }

    //单个删除物流方式
    public function update_delete($id)
    {
       $update_delete =  sends::where('id',$id)->delete();
       if($update_delete){
           return back()->with('success','删除成功');
       }else{
           return back()->with('error','删除失败');
       }
    }


    //添加支付方式
    public function order_pay(Request $request){
       
        // $pay = pay::all();
        $p_method  = $request->input('p_method') ?? '';
        $page=3;
        $pay = pay::where('p_method','like','%'.$p_method.'%')->paginate($page);
         // 当前的页数
        $currentPage=$_GET['page'] ?? 1;
        $id=($currentPage-1)*$page+1;

        $count = pay::count();
// dd($count);
        return view('admin.Orders.order_pay',['pay'=>$pay,'id'=>$id,'count'=>$count]);
    }

    //执行添加支付方式
    public function order_pay_add(Request $request)
    {
        // dd($request->all());
        // $p_method = $request->p_method;
        // $validatedData = $request->validate([
        //     'p_method' => 'min:2|max:50|unique:pays'
        // ],[
        //     'p_method.min'=>'物流名称不得低于2个字符',
        //     'p_method.max'=>'物流名称不得高于50个字符',
        //     'p_method.unique'=>'物流名称已存在'
        // ]);
        // dd($request->all());
        if ($request->hasFile('p_img')) {
            // 获取文件后缀
            $ext=$request->file('p_img')->extension();
            // 文件名 
            $filename=time().rand(0,100);
            
            $path = $request->file('p_img')->storeAs('/pay',date('Ymd').'/'.$filename.','.$ext);
            // dd($path);
            // dd($request->p_method);
            //写入数据库
            // pay::create([
            //     'p_method'=>$request->p_method,
            //     'p_img'=>$path,
            // ]);
            // DB::table('pays')->insert('insert into');
            $time=date('Y-m-d H:i:s');
            DB::insert('insert into pays (p_method, p_img,created_at,updated_at) values (?,?,?,?)', [$request->p_method, $path,$time,$time]);
            return back();
                     
        }else{
            return back();
        }
    }

    //支付的修改页面
    public function order_pay_update($id)
    {
        $pay = pay::find($id);
        
        $name = $pay->p_method;
        $id = $pay->id;
        return view('admin.Orders.order_pay_update',['name'=>$name,'id'=>$id]);
    }

    //执行支付的修改
    public function pay_update(Request $request)
    {
        $validatedData = $request->validate([
            'p_method' => 'min:2|max:50|unique:pays'
        ],[
            'p_method.min'=>'物流名称不得低于2个字符',
            'p_method.max'=>'物流名称不得高于50个字符',
            'p_method.unique'=>'物流名称已存在'
        ]);
        $data = pay::find($request->id);
        // dd($data->s_img);
        if ($request->hasFile('p_img')) {
            // 获取文件后缀
            $ext=$request->file('p_img')->extension();
            // 文件名 
            $filename=time().rand(0,100);
            
            $path = $request->file('p_img')->storeAs('/method',date('Ymd').'/'.$filename.','.$ext);
            // dd($path);
            //写入数据库
            pay::where('id',$request->id)->update([
                'p_method'=>$request->p_method,
                'p_img'=>$path,
            ]);
            return back();
                     
        }else{
            return back();
        }
    }

    //支付方式的单个删除
    public function pay_delete($id)
    {
        $pay_delete = pay::where('id',$id)->delete();
       if($pay_delete){
           return back()->with('success','删除成功');
       }else{
           return back()->with('error','删除失败');
       }
    }
    
}
