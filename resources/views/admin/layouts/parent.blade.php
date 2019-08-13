<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>网站后台</title>
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
    <!-- 顶部开始 -->
    <div class="container">
        <div class="logo"><a href="index.html">未来家具-FF 后台管理</a></div>
        <div class="left_open">
            <i title="展开左侧栏" class="iconfont">&#xe699;</i>
        </div>
        
        <ul class="layui-nav right" lay-filter="">
          <li class="layui-nav-item">
            <a href="javascript:;">{{ Session::get('admin')->name }}</a>
            <dl class="layui-nav-child"> <!-- 二级菜单 -->
              <dd><a href="/admin/login/logout">退出</a></dd>
            </dl>
          </li>
          <li class="layui-nav-item to-index"><a href="/home/index">前台首页</a></li>
        </ul>
        
    </div>
    <!-- 顶部结束 -->
    <!-- 中部开始 -->
     <!-- 左侧菜单开始 -->
    <div class="left-nav">
      <div id="side-nav">
        <ul id="nav">
             <li >
                <a href="javascript:;">
                    <i class="iconfont">&#xe6eb;</i>
                    <cite>主页</cite>
                    <i class="iconfont nav_right">&#xe6a7;</i>
                </a>
                <ul class="sub-menu">
                    <li><a _href="/admin/index/index2"><i class="iconfont">&#xe6a7;</i><cite>控制台</cite></a></li >
                </ul>
            </li>
            
            <li>
                <a href="javascript:;"><i class="iconfont">&#xe6f6;</i><cite>优惠管理</cite><i class="iconfont nav_right">&#xe6a7;</i></a>
                <ul class="sub-menu">
                    <li><a _href="html/upload.html"><i class="iconfont">&#xe6a7;</i><cite>优惠列表</cite></a></li>
                </ul>
            </li>

            <li>
                <a href="javascript:;">
                    <i class="iconfont">&#xe69e;</i>
                    <cite>商品管理</cite>
                    <i class="iconfont nav_right">&#xe6a7;</i>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a _href="/admin/goods/list">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>商品列表</cite>
                        </a>
                    </li >
                </ul>
            </li>  

            <li>
                <a href="javascript:;">
                    <i class="icon iconfont">&#xe6f6;</i>
                    <cite>活动管理</cite>
                    <i class="iconfont nav_right">&#xe6a7;</i>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a _href="/admin/blogs/list">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>活动列表</cite>
                        </a>
                    </li >
                </ul>
            </li>  

            <li>
                <a href="javascript:;">
                    <i class="iconfont">&#xe69e;</i>
                    <cite>订单管理</cite>
                    <i class="iconfont nav_right">&#xe6a7;</i>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a _href="/admin/Orders">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>订单列表</cite>
                        </a>
                    </li >
                    <li>
                        <a _href="/admin/Orders/order_cends ">
                                <i class="iconfont">&#xe6a7;</i>
                                <cite>物流方式</cite>
                        </a>
                        </li >
                        <li>
                            <a _href="/admin/Orders/order_pay">
                                <i class="iconfont">&#xe6a7;</i>
                                <cite>支付方式</cite>
                            </a>
                        </li >
                </ul>
            </li>

            <li>
<li>
                <a href="javascript:;">
                    <i class="iconfont">&#xe69e;</i>
                    <cite>分类管理</cite>
                    <i class="iconfont nav_right">&#xe6a7;</i>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a _href="/admin/Sorts">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>分类列表</cite>
                        </a>
                    </li >
            <li>
                        <a _href="/admin/Sorts/create">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>分类添加</cite>
                        </a>
                    </li >
                </ul>
            </li>
                       
            <li>
                <a href="javascript:;">
                    <i class="iconfont">&#xe6b8;</i>
                    <cite>用户管理</cite>
                    <i class="iconfont nav_right">&#xe6a7;</i>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a _href="/admin/user/userlist">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>会员列表</cite>
                            
                        </a>
                    </li >
                    
                </ul>
            </li>             
             
            <li>
                <a href="javascript:;">
                    <i class="iconfont">&#xe6ae;</i>
                    <cite>系统设置</cite>
                    <i class="iconfont nav_right">&#xe6a7;</i>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a _href="/admin/systems/links">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>友情链接</cite>
                        </a>
                    </li >
                    <li>
                        <a _href="/admin/systems/turns">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>轮播图</cite>
                        </a>
                    </li >
                    <li>
                        <a _href="/admin/coupons/couponslist">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>优惠券</cite>
                        </a>
                    </li >
                    <li>
                        <a _href="/admin/coupons/couponslist">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>物流方式</cite>
                        </a>
                    </li >
                    <li>
                        <a _href="/admin/coupons/couponslist">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>支付方式</cite>
                        </a>
                    </li>
 
                </ul>
            </li>
            <li>
                <a href="javascript:;">
                    <i class="iconfont">&#xe6ae;</i>
                    <cite>网站配置</cite>
                    <i class="iconfont nav_right">&#xe6a7;</i>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a _href="/admin/webs/webs">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>网站配置</cite>
                        </a>
                    </li >
                  
                </ul>
            </li>
          </ul>
      </div>
    </div>
    <!-- <div class="x-slide_left"></div> -->
    <!-- 左侧菜单结束 -->
    <!-- 右侧主体开始 -->
    <div class="page-content">
        <div class="layui-tab tab" lay-filter="xbs_tab" lay-allowclose="false">
          <ul class="layui-tab-title">
            <li class="home"><i class="layui-icon">&#xe68e;</i>我的桌面</li>
          </ul>
          <div class="layui-tab-content">
            <div class="layui-tab-item layui-show">
            
              @section('content')

              @show

            </div>
          </div>
        </div>
    </div>
    <div class="page-content-bg"></div>
    <!-- 右侧主体结束 -->
    <!-- 中部结束 -->
    <!-- 底部开始 -->
    <!--<div class="footer">
        <div class="copyright">Copyright ©2019 L-admin v2.3 All Rights Reserved</div>  
    </div>-->
    <!-- 底部结束 -->
</body>
</html>