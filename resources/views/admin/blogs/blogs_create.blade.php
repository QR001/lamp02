<!DOCTYPE html>
<html>
  
  <head>
    <meta charset="UTF-8">
    <title>欢迎页面-L-admin1.0</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
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
  </head>
  
  <body>
    <div class="x-body">
        <form class="layui-form">
          {{ csrf_field() }}
          <div class="layui-form-item">
              <label for="username" class="layui-form-label">
                  <span class="x-red">*</span>活动标题
              </label>
              <div class="layui-input-inline">
                  <input type="text" id="username" name="b_title" required lay-verify="b_title"
                  autocomplete="off" class="layui-input">
              </div>
              
          </div>

          <div class="layui-form-item">
              <label for="username" class="layui-form-label">
                  <span class="x-red">*</span>活动时间
              </label>
              <div class="layui-input-inline">
             
                    <input class="layui-input" placeholder="开始日" name="start" id="start" />
                    <br/>
                    至
                    <br/>
                    <br/>
                    <input class="layui-input" placeholder="截止日" name="end" id="end"  />
                </div>
              
          </div>
          

          <div class="layui-form-item">
                <label class="layui-form-label">
                    <span class="x-red">*</span>活动内容
                </label>
                <div class="layui-input-block">
                  <textarea name="b_content" placeholder="" class="layui-textarea" lay-verify="b_content"></textarea>
                </div>
          </div>
          
          <div class="layui-form-item">
              <label for="L_repass" class="layui-form-label">
              </label>
              <button  class="layui-btn" lay-filter="add" lay-submit="">
                  添加
              </button>
          </div>
      </form>
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

        layui.use(['form','layer'], function(){
            $ = layui.jquery;
          var form = layui.form
          ,layer = layui.layer;
        
          //自定义验证规则
          form.verify({
            b_title: function(value){
              if(value.length < 5 || value > 10){
                return '标题请保持在 5 - 10 个字符内！';
              }

              if($('#start')[0].value >= $('#end')[0].value){
                  return '选择时间不规范，请重新选择';
              }

              if($('#start')[0].value.length < 1 || $('#end')[0].value.length < 1){
                  return "活动时间不可为空";
              }
            },  
            b_content:function(value){
                if(value.length < 10 || value > 200){
                    return '内容请保持在 10 - 200 个字符内！';
                }
            }
          });

          //监听提交
          form.on('submit(add)', function(data){
            // console.log(data);
            //发异步，把数据提交给php
            $.ajax({
              url:'/admin/blogs/blogs_store',
              type:'POST',
              data:data.field,
              success:function(data){
                if(data == 'success'){
                  layer.alert("添加成功", {icon: 6},function () {
                    // 获得frame索引
                    var index = parent.layer.getFrameIndex(window.name);
                    // 关闭当前frame
                    parent.layer.close(index);
                  });
                }else{
                  layer.alert("添加失败", {icon: 5},function () {
                    // 获得frame索引
                    var index = parent.layer.getFrameIndex(window.name);
                    // 关闭当前frame
                    parent.layer.close(index);
                  });
                }
                  
              },
              error:function(){
                layer.alert("请求失败", {icon: 5},function () {
                    // 获得frame索引
                    var index = parent.layer.getFrameIndex(window.name);
                    // 关闭当前frame
                    parent.layer.close(index);
                });
              }
            });
            
            return false;
          });
          
          
        });
    </script>
  </body>

</html>