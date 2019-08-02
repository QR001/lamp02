<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>后台登录-L-admin2.0</title>
	<meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />

    <link rel="shortcut icon" href="/admin/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="/admin/css/font.css">
	<link rel="stylesheet" href="/admin/css/xadmin.css">
	
    <script src="/admin/js/jquery.min.js"></script>
    <script src="/admin/lib/layui/layui.js" charset="utf-8"></script>
    <script type="text/javascript" src="/admin/js/xadmin.js"></script>

</head>
  
  <body>
    <div class="x-nav">
      <span class="layui-breadcrumb">
        <a href="">首页</a>
        <a href="">演示</a>
        <a>
          <cite>导航元素</cite></a>
      </span>
      <a class="layui-btn layui-btn-primary layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" href="javascript:location.replace(location.href);" title="刷新">
        <i class="layui-icon" style="line-height:38px">ဂ</i></a>
    </div>
    <div class="x-body">
      <div class="layui-row">
      {{-- {{ dump($serch) }} --}}
      <form  method="GET" class="layui-form layui-col-md12 x-so">
          {{-- <input class="layui-input" placeholder="开始日" name="start" id="start"> --}}
          {{-- <input class="layui-input" placeholder="截止日" name="end" id="end"> --}}
          <input type="text" name="username" value="{{ $username }}"  placeholder="" autocomplete="off" class="layui-input">
          <button class="layui-btn"  ><i class="layui-icon">&#xe615;</i></button>
        </form>
      </div>
      
       
        {{-- <button class="layui-btn" onclick="x_admin_show('添加用户','./admin-add.html')"><i class="layui-icon"></i>添加</button> --}}
        {{-- <span class="x-right" style="line-height:40px">共有数据：88 条</span> --}}
    
      {{-- <xblock>
       <button class="layui-btn layui-btn-danger" onclick="delAll(this)"><i class="layui-icon"></i>批量删除</button>
      </xblock> --}}
      <table class="layui-table">
        <thead>
          <tr>
            {{-- <th>
              <div class="layui-unselect header layui-form-checkbox" lay-skin="primary"><i class="layui-icon">&#xe605;</i></div>
            </th> --}}
            <th>ID</th>
            <th>父级ID</th>
            <th>分类名称</th>
            <th>分类路径</th>
            <th>创建时间</th>
            <th>操作</th>
        </thead>
        <tbody>
            @foreach($create as $k=>$v )
          <tr>

            {{-- <td>
              <div class="layui-unselect layui-form-checkbox" lay-skin="primary" data-id={{ $v->id }}><i class="layui-icon">&#xe605;</i></div>
            </td> --}}
            <td>{{ $v->id }}</td>
            <td>{{ $v->s_name }}</td>
            <td>{{ $v->s_pid }}</td>
            <td>{{ $v->s_path }}</td>
            <td>{{ $v->created_at }}</td>
            
            <td class="td-manage">
              @if(substr_count($v->s_path,',') <2)
                <a title="添加子分类" href="/admin/Sorts/create?id={{ $v->id }}">
                  <i class="layui-icon"></i>
                  </a>
              @endif
              {{-- <a onclick="member_stop(this,'10001')" href="javascript:;"  title="启用">
                <i class="layui-icon">&#xe601;</i>
              </a> --}}
              <a title="编辑"  onclick="x_admin_show('编辑','/admin/Sorts/{{ $v->id }}/edit')" href="javascript:;" >
                <i class="layui-icon">&#xe642;</i>
              </a>
              @if(substr_count($v->s_path,',') <1)
                <a title="删除" onclick="member_del(this,{{ $v->id }})" >
                  <i class="layui-icon">&#xe640;</i>
                </a>
              @endif
            </td>
        
          </tr>
          @endforeach
        </tbody>
      </table>
     
      <div class="page">
        <div>
         
          {{ $create->appends($username)->links() }}
      
        </div>
      </div>

    </div>
  <script>
        layui.use('laydate', function(){
          var laydate = layui.laydate;
          
          //执行一个laydate实例
          laydate.render({
            elem: '#start' //指定元素
          });
  
          //执行一个laydate实例
          laydate.render({
            elem: '#end' //指定元素
          });
        });
  
         /*用户-停用*/
        function member_stop(obj,id){
            layer.confirm('确认要停用吗？',function(index){
  
                if($(obj).attr('title')=='启用'){
  
                  //发异步把用户状态进行更改
                  $(obj).attr('title','停用')
                  $(obj).find('i').html('&#xe62f;');
  
                  $(obj).parents("tr").find(".td-status").find('span').addClass('layui-btn-disabled').html('已停用');
                  layer.msg('已停用!',{icon: 5,time:1000});
  
                }else{
                  $(obj).attr('title','启用')
                  $(obj).find('i').html('&#xe601;');
  
                  $(obj).parents("tr").find(".td-status").find('span').removeClass('layui-btn-disabled').html('已启用');
                  layer.msg('已启用!',{icon: 5,time:1000});
                }
                
            });
        }
  
        /*用户-删除*/
        function member_del(obj,id){
            layer.confirm('确认要删除吗？',function(index){
                //发异步删除数据

                $.ajax({
                  type:'GET',
                  url:'/admin/Sorts/delete/'+id,
                  success: function (data) {
                    if(data = 1){
                      $(obj).parents("tr").remove();
                    layer.msg('已删除!', { icon: 1, time: 1000 });
                    }
                   },
                  error: function(data){
                    layer.msg('删除失败', {icon: 2});
                  }
                })

              
            });
        }
  
  
  
        function delAll (argument,id) {
  
          var data = tableCheck.getData().toString();
          console.log(data);
    
          layer.confirm('确认要删除吗？',function(index){

            if(data == 0){
              layer.msg('请至少选择一项');
              return;
            }

            $.ajax({
                  type:'GET',
                  url:'/admin/Sorts/pdelete/'+data,
                  success: function (data) {
                    layer.msg('删除成功', {icon: 1});
                     $(".layui-form-checked").not('.header').parents('tr').remove();
                  
                   },
                  error: function(data){
                    console.log('error');
                  }
                })

            // $.post('/admin/sorts/destroy/'+id,{'_token':'{{csrf_token()}}',"_method": "delete","data":data},function(data){
            //     　　console.log(data);
            //     });
              //捉到所有被选中的，发异步进行删除
              // layer.msg('删除成功', {icon: 1});
              // $(".layui-form-checked").not('.header').parents('tr').remove();
          });
        }
      </script>
  </body>

</html>