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
        <a href="">演示</a>
        <a>
          <cite>导航元素</cite></a>
      </span>
      <a class="layui-btn layui-btn-primary layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" href="javascript:location.replace(location.href);" title="刷新">
        <i class="layui-icon" style="line-height:38px">ဂ</i></a>
    </div>
    <div class="x-body">
      
      <table class="layui-table">
        <thead>
          <tr>
          
            <th>商品名称</th>
            <th>商品图片</th>
            <th>商品颜色</th>
            <th>商品数量</th>
            <th>商品尺寸</th>
            <th>状态</th>
            <th >操作</th>
            </tr>
        </thead>
        <tbody>
          @foreach ($data as $k=>$v)
{{-- {{dd($v)}} --}}
          <tr>
          
            <td>{{ $v['good']['g_name']}}</td>
            <td><img src="/uploads/goods/{{ $img[0] }}" alt="图片读取中...."></td>
            <td>{{ $v['good']['g_color'] }}</td>
            <td>{{ $v->d_num}}</td>
            <td>{{ $v['good']['g_size'] }}</td>
            <td>
            @if($v->d_status == 1)  
              正常
            @elseif($v->d_status == 2)
              退款中
            @elseif($v->d_status == 3)
              已退款
            @endif
        
            </td>
            <td class="td-manage">
    
              @if($v->d_status == 1)
                <a href="javascript:;"  title="正常">
                  <i class="layui-icon layui-icon-face-smile">&#xe6af;</i>
                </a>
              @elseif($v->d_status == 2)
              <a onclick="member_stop(this,'{{ $v->oid }}','{{ $uid }}')" href="javascript:;"  title="用户申请退款">
                <i class="layui-icon layui-icon-face-cry">&#xe69c;</i>
              </a>
              @elseif($v->d_status == 3)
              <a  href="javascript:;"  title="退款成功">
                <i class="layui-icon layui-icon-face-cry">&#xe69c;</i>
              </a>
              @endif
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    

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

       /*用户-退款*/
      function member_stop(obj,id,uid){
          layer.confirm('确认此次操作吗？',function(index){

            if($(obj).attr('title')=='用户申请退款'){
                  $.ajax({
                    url:'/admin/Orders/status',
                    data:{'id':id,'status':'3','uid':uid},
                    type:'GET',
                    success:function(data){
                      // console.log(data);
                      if(data == 'success'){
                        $(obj).attr('title','退款成功')
                        $(obj).find('i').html('&#xe69c;');
                        layer.msg('退款成功',{icon: 5,time:1000});
                        // $(obj).parents("tr").find(".td-status").find('span').remove();
                      }
                    },
                    error:function(data){
                      layer.msg('退款失败',{icon: 6,time:1000});
                    }

                  })
              }
              
          });
      }

      /*用户-删除*/
      function member_del(obj,id){
          layer.confirm('确认要删除吗？',function(index){
              //发异步删除数据
              $(obj).parents("tr").remove();
              layer.msg('已删除!',{icon:1,time:1000});
          });
      }

      function delAll (argument) {

        var data = tableCheck.getData();
  
        layer.confirm('确认要删除吗？'+data,function(index){
            //捉到所有被选中的，发异步进行删除
            layer.msg('删除成功', {icon: 1});
            $(".layui-form-checked").not('.header').parents('tr').remove();
        });
      }
    </script>
  </body>

</html>