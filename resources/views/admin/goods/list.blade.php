
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
        <a href="">商品管理</a>
        <a>
          <cite>商品列表</cite></a>
      </span>
      <a class="layui-btn layui-btn-primary layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" href="javascript:location.replace(location.href);" title="刷新">
        <i class="layui-icon" style="line-height:38px">ဂ</i></a>
    </div>
    <div class="x-body">
      <div class="layui-row">
        <form class="layui-form layui-col-md12 x-so" action="/admin/goods/list" method="get">
          <input class="layui-input" placeholder="开始日" value="{{ $_GET['start'] ?? '' }}" name="start" id="start">
          <input class="layui-input" placeholder="截止日" value="{{ $_GET['end'] ?? '' }}" name="end" id="end">
          <div class="layui-input-inline">
            
            <select name="g_status">
              @if(isset($_GET['g_status']) && $_GET['g_status'] == '1')
                <option value="1" selected >已上架</option>
                <option value="2"  >已下架</option>
              @elseif(isset($_GET['g_status']) && $_GET['g_status'] == '2')
                <option value="1"  >已上架</option>
                <option value="2" selected >已下架</option>
              @else
                <option value="1"  >已上架</option>
                <option value="2"  >已下架</option>
              @endif
              
            </select>
          </div>
          
          <input type="text" name="g_name"  placeholder="请输入商品名称" value="{{ $_GET['g_name'] ?? '' }}" autocomplete="off" class="layui-input">
          <button class="layui-btn"  lay-submit="" lay-filter="sreach"><i class="layui-icon">&#xe615;</i></button>
        </form>
      </div>

      <!-- <div class="layui-bg-red" style="height:40px;line-height:40px;" id="date">
        <span>日期之间需要有一定的间隔时间</span>
      </div> -->

      <xblock>
        <button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon"></i>批量删除</button>
        <button class="layui-btn" onclick="x_admin_show('添加商品','/admin/goods/goods_create')"><i class="layui-icon"></i>添加</button>
        <span class="x-right" style="line-height:40px">共有数据：{{ $count }} 条</span>
      </xblock>
      <table class="layui-table">
        <thead>
          <tr>
            <th>
              <div class="layui-unselect header layui-form-checkbox" lay-skin="primary"><i class="layui-icon">&#xe605;</i></div>
            </th>
            <th>ID</th>
            <th>名称</th>
            <th>原价</th>
            <th>现价</th>
            <th>销量</th>
            <th>库存</th>
            <th>加入时间</th>
            <th>活动状态</th>
            <th>操作</th>
          </tr>
        </thead>
        <tbody>
          @foreach($goods as $good)
          <tr>
            <td>
              <div class="layui-unselect layui-form-checkbox" lay-skin="primary" data-id='{{ $good->id }}'><i class="layui-icon">&#xe605;</i></div>
            </td>
            <td>{{ $good->id }}</td>
            <td>{{ $good->g_name }}</td>
            <td>￥{{ $good->g_oprice }}</td>
            <td>￥{{ $good->g_nprice }}</td>
            <td>{{ $good->g_sales }}</td>
            <td>{{ $good->g_stock }}</td>
            <td>{{ $good->created_at }}</td>
            <td>{{ $good->bid == 0 ? '未参与活动' : '已参与活动' }}</td>
            <td class="td-manage">
              <a title="查看"  onclick="x_admin_show('查看商品图片','/admin/goods/goods_img/{{ $good->id }}')" href="javascript:;">
                <i class="icon iconfont"></i>
              </a>
              <a title="编辑"  onclick="x_admin_show('编辑商品信息','/admin/goods/goods_edit/{{ $good->id }}')" href="javascript:;">
                <i class="layui-icon">&#xe63c;</i>
              </a>
              <a title="查看评论" href="/admin/goods/comments/{{ $good->id }}"><i class="icon iconfont">&#xe842;</i></a>
              <a title="删除" onclick="member_del(this,'{{ $good->id }}')" href="javascript:;">
                <i class="layui-icon">&#xe640;</i>
              </a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      <div class="page">
        <div>
          {{ $goods->appends(['start' => $_GET['start'] ?? '' ,'end' => $_GET['end'] ?? '' ,'g_name' => $_GET['g_name'] ?? '' ,'g_status' => $_GET['g_status'] ?? '1'])->links() }}
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

      /*商品-删除*/
      function member_del(obj,id){
          layer.confirm('确认要删除吗？',function(index){
              //发异步删除数据
              // console.log(id);
              $.ajax({
                url:'/admin/goods/goods_del/'+id,
                type:'GET',
                success:function(data){
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

      //商品批量删除
      function delAll (argument) {

        var data = tableCheck.getData();
        // console.log(data);
        layer.confirm('确认要删除吗？',function(index){
            //捉到所有被选中的，发异步进行删除
            $.ajax({
              url:'/admin/goods/goods_delAll',
              type:'POST',
              data:{'idAll':data,'_token':'{{csrf_token()}}'},
              success:function(data){
                // console.log(data);
                if(data == 'success'){
                  layer.msg('删除成功', {icon: 6});
                  $(".layui-form-checked").not('.header').parents('tr').remove();
                }else if(data == 'none'){
                  layer.msg('至少勾选一个选项', {icon: 5});
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
