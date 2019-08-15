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
        <a href="">系统设置</a>
        <a>
          <cite></cite></a>
      </span>
      <a class="layui-btn layui-btn-primary layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" href="javascript:location.replace(location.href);" title="刷新">
        <i class="layui-icon" style="line-height:38px">ဂ</i></a>
    </div>
    <div class="x-body">
      <div class="layui-row">
        <form class="layui-form layui-col-md12 x-so" action="/admin/coupons/couponslist" method="get">
          <input class="layui-input" value="{{$_GET['start'] ?? ''}}" placeholder="开始日" name="start" id="start">
          <input class="layui-input" value="{{$_GET['end'] ?? ''}}" placeholder="截止日" name="end" id="end">
          <input type="text" name="c_money" value="{{$_GET['c_money'] ?? ''}}" placeholder="请输入优惠券的金额" autocomplete="off" class="layui-input">
          <button class="layui-btn" lay-submit="" lay-filter="sreach"><i class="layui-icon">&#xe615;</i></button>
        </form>
      </div>



      <xblock>
        {{-- <button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon"></i>批量删除</button> --}}
        <button class="layui-btn" onclick="x_admin_show('添加链接','/admin/coupons/coupons_create')"><i class="layui-icon"></i>添加</button>
        <span class="x-right" style="line-height:40px">共有数据：{{ $count }} 条</span>
      </xblock>
      <table class="layui-table">
        <thead>
            {{-- <th>
              <div class="layui-unselect header layui-form-checkbox" lay-skin="primary"><i class="layui-icon">&#xe605;</i></div>
            </th> --}}
            <th>ID</th>
            <th>优惠的金额</th>
           
            <th>加入时间</th>
            <th>状态</th>
            <th>操作</th>
        </thead>
        <tbody>
          @foreach($datas as $data)
            <tr>
              
                <td>{{ $id++ }}</td>
                <td>{{ $data->c_money }}</td>
               
                <td>{{ $data->created_at }}</td>
                <td class="td-status">
                  @if($data->c_status==1)
                    <span class="layui-btn layui-btn-normal layui-btn-mini">未使用</span></td>
                  @endif
                  @if($data->c_status==2)
                    <span class="layui-btn layui-btn-normal layui-btn-mini">已使用</span></td>
                  @endif
                  @if($data->c_status==3)
                    <span class="layui-btn layui-btn-normal layui-btn-mini">已过期</span></td>
                  @endif
                <td class="td-manage">
                    @if($data->c_status==1)
                      <a title="编辑" onclick="x_admin_show('编辑','/admin/coupons/update/{{$data->id}}')" href="javascript:;">
                      <i class="layui-icon"></i>
                    </a>
                    @endif
                    <a title="删除" onclick="member_del(this,{{ $data->id }})" href="javascript:;">
                    <i class="layui-icon"></i>
                    </a>
                </td>
            </tr>
          @endforeach
        </tbody>
      </table>
      <div class="page">
        <div>
          {{ $datas->appends(['c_money' => $_GET['c_money'] ?? ''])->links() }}
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

     

      /*优惠券的-删除*/
      function member_del(obj,id){
          layer.confirm('确认要删除吗？',function(index){
              //发异步删除数据
              $.ajax({
                url:'/admin/coupons/delcoupon/'+id,
                type:'GET',
                success:function(data){
                  // console.log(data);
                  if(data == 'success'){
                    $(obj).parents("tr").remove();
                    layer.msg('已删除!',{icon:6,time:1000});
                  }else{
                    layer.msg('请求失败!',{icon:5,time:1000});
                  }
                },
                error:function(){
                  layer.msg('请求失败!',{icon:5,time:1000});
                }
              });
              
          });
      }



      function delAll (argument) {
        //绑定的数据id
        var data = tableCheck.getData();
        
        layer.confirm('确认要删除吗？',function(index){
            //捉到所有被选中的，发异步进行删除
            $.ajax({
              url:'/admin/systems/links_delAll',
              type:'POST',
              data:{'idAll':data,'_token':'{{csrf_token()}}'},
              success:function(data){
                // console.log(data);
                if(data == 'success'){
                  layer.msg('删除成功', {icon: 6});
                  $(".layui-form-checked").not('.header').parents('tr').remove();
                }else if(data == 'none'){
                  layer.msg('至少勾选一个选项', {icon: 5});
                  // $(".layui-form-checked").not('.header').parents('tr').remove();
                }else if(data == 'false'){
                  layer.msg('请求失败,刷新页面重试一下吧', {icon: 5});
                }else{
                  layer.msg('请求失败', {icon: 5});
                }
              },
              error:function(){
                layer.msg('请求失败', {icon: 5});
                // $(".layui-form-checked").not('.header').parents('tr').remove();
              }
            });
            
        });
      }
    </script>
  </body>

</html>