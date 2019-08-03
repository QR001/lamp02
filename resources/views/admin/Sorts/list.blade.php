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

    <div class="layui-col-md10">
        <form action="/admin/Sorts/list_add" method="POST">
            {{ csrf_field() }}
            <div class="layui-card">
                <div class="layui-card-header">添加分类</div>
                <div class="layui-card-body layui-row layui-col-space10">
                <div class="layui-col-md12">
                    <input type="text" name="s_name" required  placeholder="请输入分类名称"  autocomplete="off" class="layui-input">
                </div>

                <div class="layui-col-md12">
                        <select name="s_pid" lay-verify="">
                            <option value="{{ $list->id }}">{{ $list->s_name }}</option>
                        </select>
                </div>
                <input type="hidden" value="{{ $list->id }}" name='id'>
                </div> 
   
            </div>
          
            <div class="row cl">
                <div class="col-9 col-offset-2">
                    <input class="btn btn-primary radius" lay-submit="" lay-verify="add" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
                </div>
            </div>
        </form>
    </div>
</body>

<script>

   

         
          
          

</script>