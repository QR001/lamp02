<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>后台登录-L-admin2.0</title>
	<meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />

    <link rel="shortcut icon" href="/admin/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="/admin/css/font.css">
	<link rel="stylesheet" href="/admin/css/xadmin.css">
	
    <script src="/admin/js/jquery.min.js"></script>
    <script src="/admin/lib/layui/layui.js" charset="utf-8"></script>
    <script type="text/javascript" src="/admin/js/xadmin.js"></script>

</head>
<body>
<div class="layui-card">
        <div class="layui-card-header">更改分类</div>
        <div class="layui-card-body">
          <form class="layui-form" action="/admin/Sorts/edit_update" method="POST" lay-filter="component-form-element">
            {{ csrf_field() }}
            <div class="layui-row layui-col-space10 layui-form-item">
              <div class="layui-col-lg6">
                <label class="layui-form-label">分类名称：</label>
                <div class="layui-input-block">
                  <input type="text" name="s_name" lay-verify="required" placeholder="" autocomplete="off" class="layui-input">
                </div>
              </div>
              <input type="hidden" name="id" value="{{ $id }}">
            </div>

            <div class="layui-form-item">
              <div class="layui-input-block">
                <button class="layui-btn" lay-submit="" lay-filter="component-form-element">立即提交</button>
                <button type="reset" class="layui-btn layui-btn-primary">重置</button>
              </div>
            </div>
          </form>
        </div>
      </div>

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
</body>

<script>

    let close=document.getElementById('close');
    let update=document.getElementById('update');
    close.onclick=function(){
        
        update.style.display ='none';
    }
 
  </script>

