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
<body class="form-wrap">
    <div class="layui-row">
    <div class=" layui-col-md12 ">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li></li>
                        <fieldset class="layui-elem-field layui-field-title" style="margin-top: 30px; color:red;">
                                <legend>你的名字必须是汉字</legend>
                        </fieldset>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="/admin/Sorts" method="POST">
            {{ csrf_field() }}
            <div class="layui-card">
                <div class="layui-card-header">添加分类</div>
                <div class="layui-card-body layui-row layui-col-space10">
                <div class="layui-col-md12">
                    <input type="text" name="s_name" required  placeholder="请输入分类名称"  autocomplete="off" class="layui-input">
                </div>

                <div class="layui-col-md12">
                        <select name="s_pid" lay-verify="">
                                <option value="0">--请选择--</option>
                                @foreach($create as $v )
                                
                                <option value="{{ $v->id }}" {{ substr_count($v->s_path,',') >= 3 ? 'disabled' : '' }}>{{ $v->s_name }}</option>
                                @endforeach
                        </select>
                </div>
                
                </div> 
                <div class="row cl">
                        <div class="col-9 col-offset-2" style="margin-left:95%">
                            <input class="layui-btn layui-btn-sm btn-primary radius" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
                        </div>
                </div>
            </div>
          
            
        </form>
    </div>

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
</body>

<script>

        let close=document.getElementById('close');
        let update=document.getElementById('update');
        close.onclick=function(){
            
            update.style.display ='none';
        }
     
</script>
