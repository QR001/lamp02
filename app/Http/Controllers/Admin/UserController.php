<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// use Illuminate\Foundation\Auth\User;
use App\Models\Userdetail;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;


class UserController extends Controller
{
    // 用户列表
    public function user(){

        //搜索
        $name=$_GET['name'] ??  '';
        // 每页显示的条数
        $page=3;
        
        $users=Userdetail::join('users','users.id','=','userdetails.uid')->where('name','like' ,'%'.$name.'%')->paginate($page);
        
        // 当前的页数
        $currentPage=$_GET['page'] ?? 1;
        $id=($currentPage-1)*$page+1;
        // 总条数
        $count=Userdetail::join('users','users.id','=','userdetails.uid')->count();
       
        return view('admin.users.userlist',['users'=>$users,'count'=>$count,'id'=>$id]);
    }
    // 后台添加用户页面
    public function user_create(){
        return view('admin.users.useradd');
    }

    // 执行用户添加
    public function user_store(Request $request){

        // 开启事务
        DB::beginTransaction();
        $users = [];
        $users['name'] = $request -> input('name');
        $users['email'] = $request -> input('email');
        $users['power'] = $request -> input('power');
        $users['password'] = Hash::make($request -> pwd);
        $users['token'] =str_random(30);
        $users['status'] = '1';
        $users['created_at'] = date('Y-m-d H:i:s');
        $users['updated_at'] = date('Y-m-d H:i:s');

        $res = User::insertGetId($users);

        if($res){
            // 添加数据到用户详情表
            $userinfo=new Userdetail;
            $userinfo -> uid=$res;
            $userinfo -> phone = $request -> phone;
            $userinfo -> sex = $request -> sex;
            $userinfo -> pic = 'photo.jpg';
            $userinfo -> realname = '';
            $userinfo -> integral = 0;
            $userinfo ->description = '' ;

            if($userinfo->save()){
                // 事务提交
                DB::commit();
                $status='success';
            }else{
                // 事务回滚
                DB::rollback();
                $status='error';
            }
  
        }else{
            // 事务回滚
            DB::rollback();
            $status='error';
        }


        return $status;
      
    }

    // 修改用户的状态
    public function  user_status(Request $request){
        // return $request->all();
       $res=User::where('id',$request->id)->update(['status'=>$request->status]);
       if($res){
            return 'success';
       }else{
           return 'error';
       }
    }

    // 修改用户的权限页面
    public  function user_exit($id){
        // return $id;
        $user=User::find($id);
        return  view('admin.users.userupdate',['user'=>$user]);
    }

    // 执行用户修改操作
    public  function  user_update(Request $request){
   
        $res=User::where('id',$request->id)->update(['power'=>$request->power,'status'=>$request->status]);
      
        if($res){
            return 'success';
        }else{
            return 'error';
        }
    }

    // 后台用户删除
    public function user_delete($id){
        // 开启事务
        DB::beginTransaction();

        // 删除用户表
        $res1=User::where('id',$id)->delete();

        if($res1){
            $res2=Userdetail::where('uid',$id)->delete();
            if($res2){
                // 事务提交
                DB::commit();
                return 'success';
            }else{
                // 事务回滚
                DB::rollback();
                return 'error';
            } 
        }else{
            // 事务回滚
            DB::rollback();
            return 'error';
        }
    }
    // 后台批量 删除用户
    public function user_deleteAll(Request $request){
      
        //先查询数据是否存在        
        foreach($request->data  as $k=>$v){

            $res=User::find($v);
            
            if($res){
                
                DB::BeginTransaction();
                // 删除用户表
                $res1=User::destroy($v);
                if($res1){ 
                    $res2=Userdetail::where('uid',$v)->delete();
                    if($res2){
                        DB::commit();
                      
                        echo 'success';
                    }else{
                        DB::rollbak();
                        echo 'error';
                    }
                }else{
                    DB::rollback();
                    echo 'error';
                }
            }else{
                echo 'error';
            }

        }
    }

   

}
