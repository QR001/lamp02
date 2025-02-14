<html><head>
        <meta charset="UTF-8">
        <title>欢迎页面-L-admin1.0</title>
        <meta name="renderer" content="webkit">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi">
        <link rel="shortcut icon" href="/admin/favicon.ico" type="image/x-icon">
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
      <link id="layuicss-layer" rel="stylesheet" href="http://www.lamp02.com/admin/lib/layui/css/modules/layer/default/layer.css?v=3.1.1" media="all"></head>
      
      <body>
        <div class="x-body">
            <form class="layui-form">
             
              <input type="hidden" name="_token" value="8sfc4BEeyPWdumD0AsnFJPISpBM3AIIVAmTsuWGS">
              <div class="layui-form-item">
                  <label for="username" class="layui-form-label">
                      <span class="x-red">*</span>优惠的金额
                  </label>
                  <div class="layui-input-inline">
                      {{-- 你要修改的id --}}
                      <input type="hidden" name='id' value='{{ $id }} '>
                      
                      <input type="text" value='{{ $data->c_money }} ' min='1' max='100' id="l_name" name="c_money" placeholder="优惠的金额" required="" lay-verify="c_money" autocomplete="off" class="layui-input">
                  </div>
                  <div class="layui-form-mid layui-word-aux">
                      <span class="x-red">*</span>优惠券金额必须大于0
                  </div>
              </div>

              <div class="layui-form-item">
                  <label for="L_repass" class="layui-form-label">
                  </label>
                  <button class="layui-btn" lay-filter="add" lay-submit="">
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
                c_money: function(value){
                   
                    if(value==''){
                        return '请填写优惠金额';
                    }

                    if(value < 0){
                        return '优惠的金额必须大于0';
                    }

                },  
              });
              
    
              //监听提交
              form.on('submit(add)', function(data){
                //发异步，把数据提交给php
                $.ajax({
                  url:'/admin/coupons/exupdate',
                
                  data:{'data':data.field,'_token':'{{csrf_token()}}'},
                  type:'POST',
                  success:function(data){
                    
                    // 访问成功，返回信息
                    if(data == 'success'){
                      layer.alert("修改成功", {icon: 6},function () {
                        // 获得frame索引
                        var index = parent.layer.getFrameIndex(window.name);
                        //关闭当前frame
                        parent.layer.close(index);
                      });
                    }else{
                      layer.alert("修改失败，请重新添加", {icon: 6},function () {
                        // 获得frame索引
                        var index = parent.layer.getFrameIndex(window.name);
                        //关闭当前frame
                        parent.layer.close(index);
                      });
                    }
                    
                  },
                  error:function(err){
                    // console.log(err);
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