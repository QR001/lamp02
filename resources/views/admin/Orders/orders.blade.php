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
      <div class="layui-row">
        <form class="layui-form layui-col-md12 x-so">
          {{-- <input class="layui-input" placeholder="开始日"  name="start" id="start">
          <input class="layui-input" placeholder="截止日" name="end" id="end"> --}}
          {{-- <div class="layui-input-inline">
            <select name="contrller">
              <option>支付状态</option>
              <option>已支付</option>
              <option>未支付</option>
            </select>
          </div> --}}
          {{-- <div class="layui-input-inline">
            <select name="contrller">
              <option>支付方式</option>
              <option>支付宝</option>
              <option>微信</option>
              <option>货到付款</option>
            </select>
          </div> --}}
          {{-- <div class="layui-input-inline">
            <select name="contrller">
              <option value="">订单状态</option>
              <option value="0">待确认</option>
              <option value="1">已确认</option>
              <option value="2">已收货</option>
              <option value="3">已取消</option>
              <option value="4">已完成</option>
              <option value="5">已作废</option>
            </select>
          </div> --}}
          <input type="text" name="o_no"  placeholder="请输入订单号" autocomplete="off" class="layui-input">
          <button class="layui-btn"  lay-submit="" lay-filter="sreach"><i class="layui-icon">&#xe615;</i></button>
        </form>
      </div>
      <xblock>
        <button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon"></i>批量删除</button>

        <span class="x-right" style="line-height:40px">共有数据：{{ $count }} 条</span>
      </xblock>
      <table class="layui-table">
        <thead>
          <tr>
            <th>
              <div class="layui-unselect header layui-form-checkbox" lay-skin="primary"><i class="layui-icon">&#xe605;</i></div>
            </th>
            <th>订单编号</th>
            <th>收货人</th>
            <th>总金额</th>
            <th>应付金额</th>
            <th>订单状态</th>
            <th>收货地址</th>
            <th>配送方式</th>
            <th>下单时间</th>
            <th >操作</th>
            </tr>
        </thead>
        <tbody>
          @foreach ($list as $k=>$v )
<<<<<<< HEAD

=======
          {{-- {{dd($v)}} --}}
>>>>>>> origin/zhangyahan
          <tr>
            <td>
              <div class="layui-unselect layui-form-checkbox" lay-skin="primary" data-id='{{ $v->id }}'><i class="layui-icon">&#xe605;</i></div>
            </td>
            <td>{{ $v->o_no  }}</td>
            <td>{{$v->o_consignee }}:{{ $v->o_contact }}</td>
            <td>{{ $v->o_amount }}</td>
            <td>{{ $v->o_amount }}</td>
            <td>
            @if($v->o_status == 1)
                  未付款
            @elseif($v->o_status == 2)
                  未发货
            @elseif($v->o_status == 3)
                  已发货
            @elseif($v->o_status == 4)
                已收货-待评价
            @elseif($v->o_status == 5)
                已评价
            @endif
            </td>
            <td>{{ $v->o_address }}</td>
            <td>{{ $v['sends']['s_express'] }}</td>
            <td>{{ $v->created_at }}</td>
            <td class="td-manage">
              <a title="查看"  onclick="x_admin_show('编辑','/admin/Orders/order_view/{{ $v->id }}')" href="javascript:;">
                <i class="layui-icon">&#xe63c;</i>
              </a>
              <a title="删除" onclick="member_del(this,'{{ $v->id }}')" href="javascript:;">
                <i class="layui-icon">&#xe640;</i>
              </a>
              <a title="发货" onclick="member_fahuo(this,'{{ $v->id }}')" href="javascript:;">
                  <i class="layui-icon">&#xe642;</i>
              </a>
            </td>
          </tr>
        @endforeach
        </tbody>
      </table>
      <div class="page">
        <div>
          {{ $list->links() }}
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


      function member_fahuo(obj,id){
        layer.confirm('确认要发货吗？',function(index){
              //发异步删除数据

              $.ajax({
                  type:'GET',
                  url:'/admin/Orders/order_fahuo/'+id,
                  success: function (data) {
                   
                      layer.msg('修改成功!', { icon: 1, time: 1000 });

                  },
                  error: function(data){
                  
                    layer.msg('修改失败', {icon: 2});
                  }
                })
          });
      }

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
                  url:'/admin/Orders/delete/'+id,
                  success: function (data) {
                    //  console.log(data);
                      // $(obj).parents("tr").remove();
                      layer.msg('已删除!', { icon: 1, time: 1000 });

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
          type:'POST',
          url:'/admin/Orders/pdelete',
          data:{'data':data,'_token':'{{csrf_token()}}'},
          success: function (data) {
            
            layer.msg('删除成功', {icon: 1});
             $(".layui-form-checked").not('.header').parents('tr').remove();
          
           },
          error: function(data){
            layer.msg('删除失败', {icon: 2});
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