<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Sorts;
use DB;

class SortsController extends Controller
{

    //排版字符的方法
    public static function getCreate($username='')
    {
        
        // $create = Sorts::select(" *,concat(s_path,',',id) as paths from sorts order by paths asc")->orderBy('paths','asc')->paginate(3);;
        
        $create = Sorts::select('id','s_name','s_pid','s_path',DB::raw("concat(s_path,',',id) as paths"))
                    ->orderBy('paths','asc')->where('s_name','like','%'.$username.'%')->paginate(3);
        // dd($create);
        // return $create;
        foreach ($create as $key => $value){
            $n = substr_count($value->s_path,',');

            $create[$key]->s_name = str_repeat("|----",$n).$value->s_name;
        }

        return $create;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // dd($request->all());
        // dump($request->);

        $username = $request->input('username');

        // dump($username);
        if($username==null){
            $username = '';
        }

        if (empty($username)) {
            // return view('admin.Sorts.index');
            $username = '';
        }
        // $serch = DB::table('sorts')->where('s_name','like','%'.$username.'%')->get();
        // dump($serch);
        // dump($username);
   
        return view('admin.Sorts.index',['username'=>$username,'create'=>self::getcreate($username) ]);
    }

    /** 
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //

        $id = $request->input('id',0);

        return view('admin.Sorts.sorts',['id'=>$id,'create'=>self::getcreate()]);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        // dd($request->all());
        $s_pid = $request->input('s_pid');
        if ($s_pid == 0) {
            $s_path = 0;
        }else{
            //获取父级id
            $parent_data = Sorts::find($s_pid);
            $s_path= $parent_data->s_path.','.$parent_data->id;
        }

        //添加
        $cate = new Sorts;
   
        $cate->s_name = $request->input('s_name','');
        $cate->s_pid = $s_pid;
        $cate->s_path = $s_path;

        if ($cate->save()) {
            // return redirect('admin\Sorts')->with('success','添加成功');
            return back()->with('success','添加成功');
        }else{
            return back()->with('error','添加失败');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit($id)
    {
        return view('admin.Sorts.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //删除单个
    public function delete($id)
    {
        
       $data =  DB::table('sorts')->where('id', '=', $id)->delete();
       if($data){
            return 1;
       }else{
           return 2;
       }
    }

    //批量删除
    public function pdelete($data){
        
        $id= explode(',',$data);
        foreach($id as $v){
            DB::table('sorts')->where('id','=',$v)->delete();
        }

    }

}
