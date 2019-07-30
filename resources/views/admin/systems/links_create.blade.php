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
    <div class="x-body">
        <form class="layui-form">
          {{ csrf_field() }}
          <div class="layui-form-item">
              <label for="username" class="layui-form-label">
                  <span class="x-red">*</span>链接名称
              </label>
              <div class="layui-input-inline">
                  <input type="text" id="l_name" name="l_name" required lay-verify="l_name"
                  autocomplete="off" class="layui-input">
              </div>
              <!-- <div class="layui-form-mid layui-word-aux">
                  <span class="x-red">*</span>将会成为您唯一的登入名
              </div> -->
          </div>
          <div class="layui-form-item">
              <label for="phone" class="layui-form-label">
                  <span class="x-red">*</span>链接地址
              </label>
              <div class="layui-input-inline">
                  <input type="url" id="l_url" name="l_url" required lay-verify="url"
                  autocomplete="off" class="layui-input">
              </div>
              <!-- <div class="layui-form-mid layui-word-aux">
                  <span class="x-red">*</span>将会成为您唯一的登入名
              </div> -->
          </div>
          
          <div class="layui-form-item">
              <label class="layui-form-label"><span class="x-red">*</span>是否启用</label>
              <div class="layui-input-block">
                <input type="radio" name="l_status" value="1" lay-skin="primary" title="是" checked="">
                <input type="radio" name="l_status" value="2" lay-skin="primary" title="否">
              </div>
          </div>

          <div class="layui-form-item">
              <label for="L_repass" class="layui-form-label">
              </label>
              <button  class="layui-btn" lay-filter="add" lay-submit="">
                  提交
              </button>
          </div>
      </form>
    </div>
    <script>
        layui.use(['form','layer'], function(){
            $ = layui.jquery;
          var form = layui.form
          ,layer = layui.layer;
        
          //自定义验证规则
          form.verify({
            l_name: function(value){
              if(value.length < 2 || value.length > 6){
                return '链接名称请保持在 2 - 6 个字符内';
              }
            }
            ,
          });

          //监听提交
          form.on('submit(add)', function(data){
            //发异步，把数据提交给php
            $.ajax({
              url:'/admin/systems/links_store',
              data:data.field,
              type:'POST',
              success:function(data){
                //访问成功，返回信息
                if(data == 'success'){
                  layer.alert("添加成功", {icon: 6},function () {
                    // 获得frame索引
                    var index = parent.layer.getFrameIndex(window.name);
                    //关闭当前frame
                    parent.layer.close(index);
                  });
                }else{
                  layer.alert("添加失败，请重新添加", {icon: 6},function () {
                    // 获得frame索引
                    var index = parent.layer.getFrameIndex(window.name);
                    //关闭当前frame
                    parent.layer.close(index);
                  });
                }
                
              },
              error:function(){
                layer.alert("添加失败，请重新添加", {icon: 6},function () {
                  // 获得frame索引
                  var index = parent.layer.getFrameIndex(window.name);
                  //关闭当前frame
                  parent.layer.close(index);
                });
              },
              async:true
            });
            return false;
          });
          
          
        });
    </script>
  </body>

</html>