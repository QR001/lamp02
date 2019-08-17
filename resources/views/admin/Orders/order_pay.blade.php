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
      {{-- <script async="" charset="utf-8" src="/admin/layuiadmin/lib/index.js"></script><link id="layuicss-layer" rel="stylesheet" href="http://www.lamp02.com/admin/lib/layui/css/modules/layer/default/layer.css?v=3.1.1" media="all"></head> --}}
      
      <body class="form-wrap">
    
      <div class="layui-fluid">
        <div class="layui-card">
          <div class="layui-card-header">支付方式</div>
          <div class="layui-card-body" style="padding: 15px;">
            
             <form method='post' class="layui-form" enctype='multipart/form-data' action="/admin/Orders/order_pay_add" >
                {{ csrf_field() }}
                @if ($errors->any())
                @foreach ($errors->all() as $error) 
                  <li>{{$error}}</li>
                @endforeach
              @endif
                <div class="layui-form-item">
                        <label class="layui-form-label">支付方式的名字:</label>
                        <div class="layui-input-block">
                          <input type="text" name="p_method" lay-verify="required" placeholder="请输入支付方式的名字" autocomplete="off" class="layui-input">
                        </div>
                </div>
                <div class="layui-form-item">
                  <label class="layui-form-label">添加支付方式</label>
                  <div class="layui-input-block">
                      
                      <div class="layui-upload">
                            <button type="button" class="layui-btn"><input type="file" lay-verify="required" name='p_img'></button>
                            <div class="layui-upload-list">
                                <img class="layui-upload-img" id="demo1">
                                <p id="demoText"></p>
                            </div>
                        </div>
                      
                  </div>
                </div>
                  
                <div>
                    <div class="layui-input-block">
                      <div class="layui-footer">
                        <button class="layui-btn" lay-submit="" lay-filter="component-form-demo1">立即提交</button>
                      </div>
                    </div>
                </div>
              </form>
            
           
          </div>
        </div>
      </div>
    
      <div class="x-body">
          
         <form class="layui-form layui-col-md8 x-so">
            <input type="text" name="p_method" placeholder="请输入支付方式名称" autocomplete="off" class="layui-input">
            <button class="layui-btn" lay-submit="" lay-filter="sreach"><i class="layui-icon"></i></button>
        </form>
            <span class="x-right" style="line-height:40px">共有数据：{{ $count }} 条</span>
            
        
          <table class="layui-table">
            <thead>
              <tr>
                <th>
                  <div class="layui-unselect header layui-form-checkbox" lay-skin="primary"><i class="layui-icon"></i></div>
                </th>
                <th>编号</th>
                <th>物流图片</th>
                <th>物流名称</th>
                <th>创建时间</th>
                <th>操作</th>
                </tr>
            </thead>
            <tbody>
              @foreach ($pay as $v)
            
              <tr>
                <td>
                  <div class="layui-unselect layui-form-checkbox" lay-skin="primary" data-id="1"><i class="layui-icon"></i></div>
                </td>
                <td></td>
                <td><img src="/uploads/{{ $v->p_img }}" alt="图片读取中...."></td>
                <td>{{ $v->p_method }}</td>
                <td>{{ $v->created_at }}</td>
                <td class="td-manage">
                  <a title="编辑" onclick="x_admin_show('编辑','/admin/Orders/order_pay_update/{{ $v->id }}')" href="javascript:;">
                    <i class="layui-icon"></i>
                  </a>
                  <a title="删除" href="/admin/Orders/pay_delete/{{ $v->id }}">
                    <i class="layui-icon">&#xe640;</i>
                  </a>
                </td>
              </tr>                 
              @endforeach
            </tbody>
          </table>
          <div class="page">
            <div>
              {{ $pay->links() }}
            </div>
          </div>
    
        </div>  
     
    
    
    <style id="LAY_layadmin_theme">.layui-side-menu,.layadmin-pagetabs .layui-tab-title li:after,.layadmin-pagetabs .layui-tab-title li.layui-this:after,.layui-layer-admin .layui-layer-title,.layadmin-side-shrink .layui-side-menu .layui-nav>.layui-nav-item>.layui-nav-child{background-color:#20222A !important;}.layui-nav-tree .layui-this,.layui-nav-tree .layui-this>a,.layui-nav-tree .layui-nav-child dd.layui-this,.layui-nav-tree .layui-nav-child dd.layui-this a{background-color:#009688 !important;}.layui-layout-admin .layui-logo{background-color:#20222A !important;}</style>
    
    
    
    </body>
    
  
    </html>