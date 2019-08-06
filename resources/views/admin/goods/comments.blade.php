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
    <div class="x-nav">
      <span class="layui-breadcrumb">
        <a href="">首页</a>
        <a href="">商品管理</a>
        <a>
          <cite>商品评论</cite></a>
      </span>
      <a class="layui-btn layui-btn-primary layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" href="javascript:location.replace(location.href);" title="刷新">
        <i class="layui-icon" style="line-height:38px">ဂ</i></a>
    </div>
    <div class="x-body">
      <div class="layui-row">
        <form class="layui-form layui-col-md12 x-so" action="/admin/goods/comments/{{ $goodId }}" method="get">
          
          <input type="text" name="c_score" value="{{ $_GET['c_score']?? '' }}" placeholder="请输入评分" autocomplete="off" class="layui-input">
          <button class="layui-btn"  lay-submit="" lay-filter="sreach"><i class="layui-icon">&#xe615;</i></button>
        </form>
      </div>
      <xblock>
       <span class="x-right" style="line-height:40px">共有数据：{{ $count }} 条</span>
      </xblock>
      <table class="layui-table">
        <thead>
          <tr>
            
            <th>ID</th>
            <th>评论人</th>
            <th>评分</th>
            <th>评论内容</th>
            <th>评论时间</th>
            <th>操作</th>
            
        </thead>
        <tbody>
          
            @foreach($comments as $v)
            <tr>
                <td>{{ $v->id }}</td>
                <td>{{ $v->name }}</td>
                <td>{{ $v->c_score }}</td>
                <td>{{ $v->c_content }}</td>
                <td>{{ $v->created_at }}</td>
                <td>
                  @if(!empty($v->c_img))
                    <a title="查看图片"  onclick="x_admin_show('查看图片','/admin/goods/comments_img/{{ $v->id }}')" href="javascript:;">
                      <i class="icon iconfont"></i>
                    </a>
                  @endif
                </td>
            </tr>
            @endforeach
          
        </tbody>
      </table>
      <div class="page">
        <div>
          {{ $comments->appends(['c_score' => $_GET['c_score']?? ''])->links() }}
        </div>
      </div>

    </div>
    
  </body>

</html>