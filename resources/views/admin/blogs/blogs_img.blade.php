<!DOCTYPE html>
<html>
  
  <head>
    <meta charset="UTF-8">
    <title>欢迎页面-L-admin1.0</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
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
        
        <fieldset class="layui-elem-field layui-field-title" style="margin-top: 30px;">
          <legend>封面预览</legend>
        </fieldset> 
        <blockquote class="layui-elem-quote layui-quote-nm" style="margin-top: 10px;">
          
            <div class="layui-upload-list">
                <img src="/uploads/blogs/{{ $blog->b_img }}" style="width:30%;" alt="图片读取中..." />
            </div>
        </blockquote>

        <fieldset class="layui-elem-field layui-field-title" style="margin-top: 30px;">
          <legend>更换活动封面</legend>
        </fieldset> 
        <form class="layui-form" action="/admin/blogs/uploads" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
          <div class="layui-form-item">
              
              <div class="layui-input-inline">
                  <input type="file" name="img" />
              </div>
          </div>
          <div class="layui-form-item">
              <input type="hidden" name="id" value="{{ $blog->id }}" />
          </div>
          <div class="layui-form-item">
              
              <div class="layui-input-inline">
                  <input type="submit" class="layui-btn" value="更换">
              </div>
          </div>
        </form>
    </div>
    
  </body>

</html>