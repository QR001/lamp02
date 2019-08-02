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
      <div class="layui-card-header">网站配置</div>
      <div class="layui-card-body" style="padding: 15px;">
        @if($data)
         <form method='post' class="layui-form" enctype='multipart/form-data' action="/admin/web/doweb" lay-filter="component-form-group">
            {{ csrf_field() }}
            <div class="layui-form-item">
              <label class="layui-form-label">网站标题:</label>
              <div class="layui-input-block">
                <input type="text" name="w_title" lay-verify="required" value= "{{ $data->w_title }}" autocomplete="off" class="layui-input">
              </div>
            </div>
            <div class="layui-form-item">
              <label class="layui-form-label">网站关键字:</label>
              <div class="layui-input-block">
                <input type="text" name="w_keyword" lay-verify="required" value="{{ $data->w_keyword }}" autocomplete="off" class="layui-input">
              </div>
            </div>
            <div class="layui-form-item">
              <label class="layui-form-label">网站的版权:</label>
              <div class="layui-input-block">
                <input type="text" name="w_cright" lay-verify="required" value="{{ $data->w_cright }}" autocomplete="off" class="layui-input">
              </div>
            </div>
            <div class="layui-form-item">
              <label class="layui-form-label">网站的开关:</label>
              <div class="layui-input-block">
                <input type="radio" name="w_isopen" value="1" {{$data->w_isopen==1 ? 'checked' : ''}} title="开" checked=""><div class="layui-unselect layui-form-radio layui-form-radioed"><i class="layui-anim layui-icon"></i><div>开</div></div>
                <input type="radio" name="w_isopen" value="2" {{$data->w_isopen==2 ? 'checked' : ''}} title="关"><div class="layui-unselect layui-form-radio"><i class="layui-anim layui-icon"></i><div>关</div></div>
              </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">网站的logo展示:</label>
                <div class="layui-input-block">
                    <div class="layui-upload">
                        {{-- <button type="button" class="layui-btn" id="test1"></button><input class="layui-upload-file" type="file" accept="undefined" name="file"> --}}
                        <div class="layui-upload-list">
                            <img class="layui-upload-img" width='200px' src="/uploads/{{$data->w_logo}}" id="demo1">
                        </div>
                    </div>
                        
                </div>
            </div>

            <div class="layui-form-item">
              <label class="layui-form-label">更换网站的logo:</label>
              <div class="layui-input-block">
                  
                  <div class="layui-upload">
                        <button type="button" class="layui-btn"><input type="file" name='w_logo'></button>
                        <div class="layui-upload-list">
                            <img class="layui-upload-img" id="demo1">
                            <p id="demoText"></p>
                        </div>
                    </div>
                  
              </div>
            </div>
            <div class="layui-form-item layui-form-text">
              <label class="layui-form-label">网站的描述:</label>
              <div class="layui-input-block">
                <textarea name="w_description" placeholder="请输入内容" class="layui-textarea">{{ $data->w_description }}</textarea>
              </div>
            </div>        
            <div class="layui-form-item layui-layout-admin">
              <div class="layui-input-block">
                <div class="layui-footer" style="left: 0;">
                  <button class="layui-btn" lay-submit="" lay-filter="component-form-demo1">立即提交</button>
                  {{-- <button type="reset" class="layui-btn layui-btn-primary">重置</button> --}}
                </div>
              </div>
            </div>
          </form>
        @else
        <form method="post" enctype='multipart/form-data' class="layui-form" action="/admin/web/doweb" lay-filter="component-form-group">
            {{ csrf_field() }}
            <div class="layui-form-item">
              <label class="layui-form-label">网站标题:</label>
              <div class="layui-input-block">
                <input type="text" name="w_title" lay-verify="required" placeholder="请输入" autocomplete="off" class="layui-input">
              </div>
            </div>
            <div class="layui-form-item">
              <label class="layui-form-label">网站关键字:</label>
              <div class="layui-input-block">
                <input type="text" name="w_keyword" lay-verify="required" placeholder="请输入" autocomplete="off" class="layui-input">
              </div>
            </div>
            <div class="layui-form-item">
              <label class="layui-form-label">网站的版权:</label>
              <div class="layui-input-block">
                <input type="text" name="w_cright" lay-verify="required" placeholder="请输入" autocomplete="off" class="layui-input">
              </div>
            </div>
            <div class="layui-form-item">
              <label class="layui-form-label">网站的开关:</label>
              <div class="layui-input-block">
                <input type="radio" name="w_isopen" value="1" title="开" checked=""><div class="layui-unselect layui-form-radio layui-form-radioed"><i class="layui-anim layui-icon"></i><div>开</div></div>
                <input type="radio" name="w_isopen" value="2" title="关"><div class="layui-unselect layui-form-radio"><i class="layui-anim layui-icon"></i><div>关</div></div>
              </div>
            </div>
            <div class="layui-form-item">
              <label class="layui-form-label">网站的logo:</label>
              <div class="layui-input-block">
                  <div class="layui-upload">
                      <button type="button" class="layui-btn"><input type="file" name='w_logo'></button>
                      <div class="layui-upload-list">
                          <img class="layui-upload-img" id="demo1">
                          <p id="demoText"></p>
                      </div>
                  </div>
                  
              </div>
            </div>
            <div class="layui-form-item layui-form-text">
              <label class="layui-form-label">网站的描述:</label>
              <div class="layui-input-block">
                <textarea name="w_description" placeholder="请输入内容" class="layui-textarea"></textarea>
              </div>
            </div>        
            <div class="layui-form-item layui-layout-admin">
              <div class="layui-input-block">
                <div class="layui-footer" style="left: 0;">
                  <button class="layui-btn" lay-submit="" lay-filter="component-form-demo1">立即提交</button>
                  <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                </div>
              </div>
            </div>
          </form>
        @endif
        {{-- 提示信息 --}}
        @if(session('success'))
            
            <div id='update' class="layui-layer layui-layer-dialog" id="layui-layer1" type="dialog" times="1" showtime="0" contype="string" style="z-index: 19891015; top: 24.4px; left: 519px;">
                <div class="layui-layer-title" style="cursor: move;">信息</div>
                <div  class="layui-layer-content">{{ session('success') }}</div>
                <div class="layui-layer-btn layui-layer-btn-">
                    <a class="layui-layer-btn0" id='close'>关闭</a>
                </div>
                <span class="layui-layer-resize"></span>
            </div>
        @endif
      </div>
    </div>
  </div>

    
  <script>

    let close=document.getElementById('close');
    let update=document.getElementById('update');
    close.onclick=function(){
        
        update.style.display ='none';
    }
 
  </script>


<style id="LAY_layadmin_theme">.layui-side-menu,.layadmin-pagetabs .layui-tab-title li:after,.layadmin-pagetabs .layui-tab-title li.layui-this:after,.layui-layer-admin .layui-layer-title,.layadmin-side-shrink .layui-side-menu .layui-nav>.layui-nav-item>.layui-nav-child{background-color:#20222A !important;}.layui-nav-tree .layui-this,.layui-nav-tree .layui-this>a,.layui-nav-tree .layui-nav-child dd.layui-this,.layui-nav-tree .layui-nav-child dd.layui-this a{background-color:#009688 !important;}.layui-layout-admin .layui-logo{background-color:#20222A !important;}</style>



</body></html>