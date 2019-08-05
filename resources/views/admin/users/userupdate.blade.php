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
          <form class="layui-form" >  
              {{ csrf_field() }}
            {{-- {{csrf_token()}} --}}
          <div class="layui-form-item">
            <label class="layui-form-label">权限</label>
            <div class="layui-input-block">
              <input type="radio" name="power" value="1" title="普通会员" {{ $user->power==1 ? 'checked' : '' }} ><div class="layui-unselect layui-form-radio layui-form-radioed"><i class="layui-anim layui-icon"></i><div>普通会员</div></div>
              <input type="radio" name="power" value="2" title="vip会员"  {{ $user->power==2 ? 'checked' : '' }}><div class="layui-unselect layui-form-radio"><i class="layui-anim layui-icon"></i><div>vip会员</div></div>
              <input type="radio" name="power" value="3" title="管理员"   {{ $user->power==3 ? 'checked' : '' }}><div class="layui-unselect layui-form-radio"><i class="layui-anim layui-icon"></i><div>管理员</div></div>
            
              {{-- 隐藏域传输id --}}
                <input type="hidden" name='id' value="{{ $user->id }}">
            </div>
          </div>

          <div class="layui-form-item">
                <label class="layui-form-label">状态</label>
                <div class="layui-input-block">
                  <input type="radio" name="status" value="1"  title="启用" {{ $user->status==1 ? 'checked' : '' }} ><div class="layui-unselect layui-form-radio layui-form-radioed"><i class="layui-anim layui-icon"></i><div>启用</div></div>
                  <input type="radio" name="status" value="2" title="未启用" {{ $user->status==2 ? 'checked' : '' }} ><div class="layui-unselect layui-form-radio layui-form-radioed"><i class="layui-anim layui-icon"></i><div>未启用</div></div>
                </div>
          </div>
             
          <div class="layui-form-item layui-layout-admin">
            <div class="layui-input-block">
              <div class="layui-footer" style="left: 0;">
                <button class="layui-btn" lay-submit="" lay-filter="add">立即提交</button>
              </div>
            </div>
          </div>
        </form>
    </div>
    <script>
        layui.use(['form','layer'], function(){
            $ = layui.jquery;
          var form = layui.form
          ,layer = layui.layer;
        
          /* 自定义验证规则 */
        form.verify({
            title: function(value){
                if(value.length < 5){
                return '标题至少得5个字符啊';
                }
            }
            ,pass: [/(.+){6,12}$/, '密码必须6到12位']
            ,content: function(value){
                layedit.sync(editIndex);
            }
        });

         //监听提交
         form.on('submit(add)', function(data){
          //发异步，把数据提交给php
          // console.log(111);
          $.ajax({
              url:'/admin/user/user_update',
              data:data.field,
              // data:{data:data.field,'_token':'{{csrf_token()}}'},
              // data:{'data':data.field,'_token':'{{csrf_token()}}'},
              type:'POST',
              success:function(data){
                  // console.log(data);
                //访问成功，返回信
                if(data == 'success'){
                  layer.alert("修改成功", {icon: 6},function () {
                    // 获得frame索引
                    var index = parent.layer.getFrameIndex(window.name);
                    //关闭当前frame
                    parent.layer.close(index);
                  });
                }else{
                  layer.alert("修改失败，请重新修改", {icon: 6},function () {
                    // 获得frame索引
                    var index = parent.layer.getFrameIndex(window.name);
                    //关闭当前frame
                    parent.layer.close(index);
                  });
                }
                
              },
              error:function(){
                layer.alert("修改失败，请重新修改", {icon: 6},function () {
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