<html><head>
        <meta charset="UTF-8">
        <title>欢迎页面-L-admin1.0</title>
        <meta name="renderer" content="webkit">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi">
        <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
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
      <link id="layuicss-layer" rel="stylesheet" href="/admin/lib/layui/css/modules/layer/default/layer.css?v=3.1.1" media="all"></head>
      
      <body>
        <div class="x-body layui-anim layui-anim-up">
            <form class="layui-form">
              <div class="layui-form-item">
                  <label for="L_email" class="layui-form-label">
                      <span class="x-red">*</span>邮箱
                  </label>
                  <div class="layui-input-inline">
                      <input type="text" id="L_email" name="email" required="" lay-verify="email" autocomplete="off" class="layui-input">
                  </div>
                
              </div>
              <div class="layui-form-item">
                    <label for="phone" class="layui-form-label">
                        <span class="x-red">*</span>手机号
                    </label>
                    <div class="layui-input-inline">
                        <input type="tel"  name="phone" required="" lay-verify="required|phone" autocomplete="off" class="layui-input">
                    </div>
                    
              </div>
            
              <div class="layui-form-item">
                    <label for="pic" class="layui-form-label">
                        <span class="x-red">*</span>头像
                    </label>
                    <div class="layui-input-inline">
                        <input type="file" id="pic" name="pic" required=""  ay-verify=”required” autocomplete="off" class="layui-input">
                    </div>
                   
              </div>
              <div class="layui-form-item">
                    <label class="layui-form-label">性别</label>
                    <div class="layui-input-block">
                      <input type="radio" name="sex" value="1" title="男" checked=""><div class="layui-unselect layui-form-radio layui-form-radioed"><i class="layui-anim layui-icon"></i><div>男</div></div>
                      <input type="radio" name="sex" value="2" title="女"><div class="layui-unselect layui-form-radio"><i class="layui-anim layui-icon"></i><div>女</div></div>
                    
                    </div>
              </div>
              <div class="layui-form-item">
                  <label for="L_username" class="layui-form-label">
                      <span class="x-red">*</span>用户名
                  </label>
                  <div class="layui-input-inline">
                      <input type="text" id="L_username" name="username" required="" lay-verify="name" autocomplete="off" class="layui-input">
                  </div>
              </div>
              <div class="layui-form-item">
                  <label for="L_pass" class="layui-form-label">
                      <span class="x-red">*</span>密码
                  </label>
                  <div class="layui-input-inline">
                      <input type="password" id="L_pass" name="pwd" required="" lay-verify="pass" autocomplete="off" class="layui-input">
                  </div>
                  <div class="layui-form-mid layui-word-aux">
                      6到18个字符
                  </div>
              </div>
              <div class="layui-form-item">
                  <label for="L_repass" class="layui-form-label">
                      <span class="x-red">*</span>确认密码
                  </label>
                  <div class="layui-input-inline">
                      <input type="password" id="L_repass" name="repwd" required="" lay-verify="repass" autocomplete="off" class="layui-input">
                  </div>
              </div>
              <div class="layui-form-item">
                  <label for="L_repass" class="layui-form-label">
                  </label>
                  <button class="layui-btn" lay-filter="add" lay-submit="">
                      增加
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
                name: function(value){
                  if(value.length < 6){
                    return '昵称至少得6个字符啊';
                  }
                },
               
                pass: [/(.+){6,12}$/, '密码必须6到18位'],
                repass: function(value){
                    if($('#L_pass').val()!=$('#L_repass').val()){
                        return '两次密码不一致';
                    }
                }
              });
    
              
            form.on('submit(add)', function(data){
            //发异步，把数据提交给php
            $.ajax({
              url:'/admin/user/user_store',
              data:{data:data.field,'_token':"{{csrf_token()}}"},
              type:'POST',
              success:function(data){
                  console.log(data);
                //访问成功，返回信息
                // if(data == 'success'){
                //   layer.alert("添加成功", {icon: 6},function () {
                //     // 获得frame索引
                //     var index = parent.layer.getFrameIndex(window.name);
                //     //关闭当前frame
                //     parent.layer.close(index);
                //   });
                // }else{
                //   layer.alert("添加失败，请重新添加", {icon: 6},function () {
                //     // 获得frame索引
                //     var index = parent.layer.getFrameIndex(window.name);
                //     //关闭当前frame
                //     parent.layer.close(index);
                //   });
                // }
                
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
      
    
    </body></html>