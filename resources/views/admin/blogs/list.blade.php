<!DOCTYPE html>
<html>
  
  <head>
    <meta charset="UTF-8">
    <title>欢迎页面-L-admin1.0</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <link rel="shortcut icon" href="/admin/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="/admin/css/font.css">
    <link rel="stylesheet" href="/admin/css/xadmin.css">
    <script src="/admin/js/jquery.min.js"></script>
    <script type="text/javascript" src="/admin/lib/layui/layui.js" charset="utf-8"></script>
    <script type="text/javascript" src="/admin/js/xadmin.js"></script>
    <!-- 让IE8/9支持媒体查询，从而兼容栅格 -->
    <!--[if lt IE 9]>
      <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
      <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  
  <body>
    <div class="x-nav">
      <span class="layui-breadcrumb">
        <a href="">首页</a>
        <a href="">活动管理</a>
        <a>
          <cite>活动列表</cite></a>
      </span>
      <a class="layui-btn layui-btn-primary layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" href="javascript:location.replace(location.href);" title="刷新">
        <i class="layui-icon" style="line-height:38px">ဂ</i></a>
    </div>
    <div class="x-body">
      <div class="layui-row">
        <form class="layui-form layui-col-md12 x-so" action="/admin/blogs/list" method="get" >
          
          <input type="text" name="b_title"  placeholder="请输入活动标题" value="{{ $_GET['b_title'] ?? '' }}" autocomplete="off" class="layui-input">
          <button class="layui-btn"  lay-submit="" lay-filter="sreach"><i class="layui-icon">&#xe615;</i></button>
        </form>
      </div>
      <xblock>
        <button class="layui-btn" onclick="x_admin_show('添加活动','/admin/blogs/blogs_create')"><i class="layui-icon"></i>添加</button>
        <span class="x-right" style="line-height:40px">共有数据：{{ $count }} 条</span>
      </xblock>
      <table class="layui-table">
        <thead>
          <tr>
            <th>ID</th>
            <th>活动封面</th>
            <th>活动标题</th>
            <th>加入时间</th>
            <th>活动状态</th>
            <th>操作</th>
        </thead>
        <tbody>
          @foreach($blogs as $blog)
          <tr>
            
            <td>{{ $blog->id }}</td>
            <td><img src="/uploads/blogs/{{ $blog->b_img }}" alt="图片读取中...."  ></td>
            <td>{{ $blog->b_title }}</td>
            <td>{{ $blog->created_at }}</td>
            <td class="td-status">
              @if($blog->b_status == '1')
              <span class="layui-btn layui-btn-normal layui-btn-mini">开启中</span>
              @else
              <span class="layui-btn layui-btn-normal layui-btn-mini layui-btn-disabled">关闭中</span>
              @endif 
              </td>
            <td class="td-manage">
              @if($blog->b_status == '1')
              <a onclick="member_stop(this,'{{ $blog->id }}')" href="javascript:;"  title="关闭">
                <i class="layui-icon">&#xe601;</i>
              </a>
              @else
              <a onclick="member_stop(this,'{{ $blog->id }}')" href="javascript:;"  title="开启">
                <i class="layui-icon">&#xe62f;</i>
              </a>
              @endif
              <a title="封面"  onclick="x_admin_show('查看活动封面','/admin/blogs/blogs_img/{{ $blog->id }}')" href="javascript:;">
                <i class="icon iconfont"></i>
              </a>
              <a title="编辑"  onclick="x_admin_show('编辑','/admin/blogs/blogs_edit/{{ $blog->id }}')" href="javascript:;">
                <i class="layui-icon">&#xe642;</i>
              </a>
              <a title="删除" onclick="member_del(this,'{{ $blog->id }}')" href="javascript:;">
                <i class="layui-icon">&#xe640;</i>
              </a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      <div class="page">
        <div>
          {{ $blogs->appends(['b_title' => $_GET['b_title'] ?? '' ])->links() }}
        </div>
      </div>

    </div>
    <script>

       /*用户-停用*/
      function member_stop(obj,id){
        layer.confirm('确认要修改状态吗？',function(index){
              if($(obj).attr('title')=='开启'){

                //发异步把用户状态进行更改
                $.ajax({
                  url:'/admin/blogs/blogs_status',
                  data:{'id':id,'b_status':'1','_token':'{{csrf_token()}}'},
                  type:'POST',
                  success:function(data){
                    if(data == 'success'){
                      $(obj).attr('title','关闭')
                      $(obj).find('i').html('&#xe601;');

                      $(obj).parents("tr").find(".td-status").find('span').removeClass('layui-btn-disabled').html('开启中');
                      layer.msg('已开启!',{icon: 6,time:1000});
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
                
                //发异步把用户状态进行更改
                $.ajax({
                  url:'/admin/blogs/blogs_status',
                  data:{'id':id,'b_status':'2','_token':'{{csrf_token()}}'},
                  type:'POST',
                  success:function(data){
                    if(data == 'success'){
                      $(obj).attr('title','开启')
                      $(obj).find('i').html('&#xe62f;');

                      $(obj).parents("tr").find(".td-status").find('span').addClass('layui-btn-disabled').html('关闭中');
                      layer.msg('已关闭!',{icon: 5,time:1000});
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

      /*活动-删除*/
      function member_del(obj,id){
          layer.confirm('确认要删除吗？',function(index){
              //发异步删除数据
              $.ajax({
                url:'/admin/blogs/blogs_del/'+id,
                type:'GET',
                success:function(data){
                  // console.log(data);
                  if(data == 'success'){
                    $(obj).parents("tr").remove();
                    layer.msg('已删除!',{icon:6,time:1000});
                  }else{
                    $(obj).parents("tr").remove();
                    layer.msg('删除失败!',{icon:5,time:1000});
                  }
                },
                error:function(){
                    $(obj).parents("tr").remove();
                    layer.msg('请求失败!',{icon:5,time:1000});
                }
              });
              
          });
      }

    </script>
  </body>

</html>