<html><head>
        <meta charset="UTF-8">
        <title>欢迎页面-L-admin1.0</title>
        <meta name="renderer" content="webkit">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi">
        <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
        <link rel="stylesheet" href="../css/font.css">
        <link rel="stylesheet" href="../css/xadmin.css">
        <script src="../js/jquery.min.js"></script>
        <script type="text/javascript" src="../lib/layui/layui.js" charset="utf-8"></script>
        <script type="text/javascript" src="../js/xadmin.js"></script>
        <!-- 让IE8/9支持媒体查询，从而兼容栅格 -->
        <!--[if lt IE 9]>
          <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
          <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
      <link id="layuicss-laydate" rel="stylesheet" href="http://www.lamp02.com/admin/lib/layui/css/modules/laydate/default/laydate.css?v=5.0.9" media="all"><link id="layuicss-layer" rel="stylesheet" href="http://www.lamp02.com/admin/lib/layui/css/modules/layer/default/layer.css?v=3.1.1" media="all"></head>
      
      <body class="layui-anim layui-anim-up">
        <div class="x-nav">
          <span class="layui-breadcrumb" style="visibility: visible;">
            <a href="">首页</a><span lay-separator="">/</span>
            <a href="">演示</a><span lay-separator="">/</span>
            <a>
              <cite>导航元素</cite></a>
          </span>
          <a class="layui-btn layui-btn-primary layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" href="javascript:location.replace(location.href);" title="刷新">
            <i class="layui-icon" style="line-height:38px">ဂ</i></a>
        </div>
        <div class="x-body">
          <div class="layui-row">
            <form class="layui-form layui-col-md12 x-so" action='/admin/user/userlist'>
              {{-- <input class="layui-input" value="{{$_GET['start'] ?? ''}}" placeholder="开始日" name="start" id="start" lay-key="1">
              <input class="layui-input" value="{{$_GET['end'] ?? ''}}" placeholder="截止日" name="end" id="end" lay-key="2"> --}}
              <input type="text" name="name" value="{{ $_GET['name'] ?? '' }}" autocomplete="off" class="layui-input">
              <button class="layui-btn" lay-submit="" lay-filter="sreach"><i class="layui-icon"></i></button>
            </form>
          </div>
          <xblock>
            <button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon"></i>批量删除</button>
            <button class="layui-btn" onclick="x_admin_show('添加用户','/admin/user/useradd',600,400)"><i class="layui-icon"></i>添加</button>
            <span class="x-right" style="line-height:40px">共有数据：{{ $count }} 条</span>
          </xblock>
          <table class="layui-table">
            <thead>
              <tr>
                <th>
                  <div class="layui-unselect header layui-form-checkbox" lay-skin="primary"><i class="layui-icon"></i></div>
                </th>
                <th>ID</th>
                <th>用户名</th>
                <th>性别</th>
                <th>手机</th>
                <th>邮箱</th>
                <th>权限</th>
                <th>加入时间</th>
                <th>状态</th>
                <th>操作</th></tr>
            </thead>
            <tbody>
             @foreach ($users as $user)
             <tr>
                <td>
                  <div class="layui-unselect layui-form-checkbox" lay-skin="primary" data-id="{{ $user->id }}"><i class="layui-icon"></i></div>
                </td>
                <td>{{$id++}}</td>
                <td>{{ $user->name }}</td>
                @if($user->sex)
                  <td>{{ $user->sex==1 ? '男' : '女' }}</td>
                @else
                  <td> 保密 </td>
                @endif
                @if($user->phone)
                  <td>{{ $user->phone }}</td>
                @else
                  <td>保密</td>
                @endif
                <td>{{ $user->email }}</td>
                @if($user->power==1)
                  <td>普通会员</td>
                @elseif($user->power==2)
                  <td>vip会员</td>
                @elseif($user->power==3)
                  <td>管理员</td>
                @endif
              
                <td>{{ $user->created_at }}</td>
                <td class="td-status">
                  <span class="layui-btn layui-btn-normal layui-btn-sm">{{ $user->status==1 ? '启用' : '停用' }}</span></td>
                <td class="td-manage">
                    @if($user->status == 1)
                    <a onclick="member_stop(this,'{{ $user->id }}')" href="javascript:;"  title="停用">
                      <i class="layui-icon">&#xe601;</i>
                    </a>
                    @else
                    <a onclick="member_stop(this,'{{ $user->id }}')" href="javascript:;"  title="启用">
                      <i class="layui-icon">&#xe62f;</i>
                    </a>
                    @endif
                 
                  <a title="编辑" onclick="x_admin_show('编辑','/admin/user/user_exit/{{ $user->id }}',600,400)" href="javascript:;">
                    <i class="layui-icon"></i>
                  </a>
                
                  <a title="删除" onclick="member_del(this,'{{ $user->id }}')" href="javascript:;">
                    <i class="layui-icon"></i>
                  </a>
                </td>
              </tr>
              
             @endforeach
              
            </tbody>
          </table>
          
          <div class="page">
              <div>
                {{ $users->appends(['name'=>$_GET['name'] ?? ''])->links() }}
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
              layer.confirm('确认要修改状态吗？',function(index){
    
                  if($(obj).attr('title')=='启用'){
                    // 等于启用的时候 发送ajax 修改数据库
                    $.ajax({
                      url:'/admin/user/user_status',
                      data:{'id':id,'status':'1','_token':'{{csrf_token()}}'},
                      type:'POST',
                      success:function(data){
                        if(data == 'success'){
                          $(obj).attr('title','停用')
                          $(obj).find('i').html('&#xe601;');

                          $(obj).parents("tr").find(".td-status").find('span').removeClass('layui-btn-disabled').html('启用');
                          layer.msg('启用!',{icon: 6,time:1000});
                        }else{
                          layer.msg('请求失败!',{icon: 5,time:1000});
                        }
                      },
                      error:function(){
                        layer.msg('请求失败!',{icon: 5,time:1000});
                      },
                      async:true
                    });
    
    
                  }else{
                    // 等于停用的时候  发送ajax 修改数据库
                    $.ajax({
                      url:'/admin/user/user_status',
                      data:{'id':id,'status':'2','_token':'{{csrf_token()}}'},
                      type:'POST',
                      success:function(data){
                        
                        if(data == 'success'){
                          $(obj).attr('title','停用')
                          $(obj).find('i').html('&#xe601;');

                          $(obj).parents("tr").find(".td-status").find('span').removeClass('layui-btn-disabled').html('停用');
                          layer.msg('停用!',{icon: 6,time:1000});
                        }else{
                          layer.msg('请求失败!',{icon: 5,time:1000});
                        }
                      },
                      error:function(){
                        layer.msg('请求失败!',{icon: 5,time:1000});
                      },
                      async:true
                    });
                   
                  }
                  
              });
          }
    
          /*用户-删除*/
          function member_del(obj,id){
            // console.log(id);
              layer.confirm('确认要删除吗？',function(index){
                $.ajax({
                  url:'/admmin/user/user_delete/'+id,
                  // data:{'id':id},
                  type:'GET',
                 
                  success:function(data){
                    console.log(data);
                    //发异步删除数据
                    $(obj).parents("tr").remove();
                    layer.msg('已删除!',{icon:1,time:1000});
                  },
                  error:function(){
                    layer.msg('删除失败',{icon:5,time:1000});
                  }
                });
                  
              });
          }
    
    
    
          function delAll () {
           
            var data = tableCheck.getData();
            
            $.ajax({
                url:'/admin/user/user_deleteAll',
                data:{'data':data,'_token':'{{csrf_token()}}'},
                type:'POST',
                success:function(data){
                  // 判断是否有success 在成功里面
                  if(data.indexOf('success') !=-1 ){

                     layer.confirm('确认要删除吗?',function(index){
                      //捉到所有被选中的，发异步进行删除
                      layer.msg('删除成功', {icon: 1});
                        $(".layui-form-checked").not('.header').parents('tr').remove();
                      });
                  }else{
                      layer.msg('删除失败', {icon: 5});
                  }
                  
                 
                },
                error:function(){
                  layer.msg('请求失败!',{icon: 5,time:1000});
                },
                async:true
              });
      
          
          }

          
        </script>
      
    
    </body></html>