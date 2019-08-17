<!DOCTYPE html>
<html lang="en">
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
    </head>
<body>
        <div class="layui-fluid">
                <div class="layui-card">
                  <div class="layui-card-header">物流方式</div>
                  <div class="layui-card-body" style="padding: 15px;">
                    @if ($errors->any())
                      @foreach ($errors->all() as $error) 
                        <li>{{$error}}</li>
                      @endforeach
                    @endif
                     <form method='post' class="layui-form" enctype='multipart/form-data' action="/admin/Orders/pay_update" >
                        {{ csrf_field() }}
                        <div class="layui-form-item">
                                <label class="layui-form-label">物流的名字:</label>
                                <div class="layui-input-block">
                                  <input type="text" name="p_method" lay-verify="required" placeholder="{{ $name }}" autocomplete="off" class="layui-input">
                                </div>
                        </div>
                        <div class="layui-form-item">
                          <label class="layui-form-label">添加物流</label>
                          <div class="layui-input-block">
                              
                              <div class="layui-upload">
                                  <input type="hidden" name="id" value="{{ $id }}">
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
</body>
</html>
