
<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=0">

		<title>个人中心</title>
		<link href="/home/AmazeUI-2.4.2/assets/css/admin.css" rel="stylesheet" type="text/css">
		
		<link href="/home/css/personal.css" rel="stylesheet" type="text/css">
		
		<link href="/home/AmazeUI-2.4.2/assets/css/amazeui.css" rel="stylesheet" type="text/css">

		<link href="/home/css/infstyle.css" rel="stylesheet" type="text/css">
		<script src="/home/AmazeUI-2.4.2/assets/js/jquery.min.js" type="text/javascript"></script>
		<script src="/home/AmazeUI-2.4.2/assets/js/amazeui.js" type="text/javascript"></script>

		<link href="/home/css/systyle.css" rel="stylesheet" type="text/css">

		<link href="/home/css/stepstyle.css" rel="stylesheet" type="text/css">


		<link href="/home/css/personal.css" rel="stylesheet" type="text/css">
		<link href="/home/css/infstyle.css" rel="stylesheet" type="text/css">

		<link href="/home/AmazeUI-2.4.2/assets/css/admin.css" rel="stylesheet" type="text/css">
		<link href="/home/AmazeUI-2.4.2/assets/css/amazeui.css" rel="stylesheet" type="text/css">

		<link href="/home/css/personal.css" rel="stylesheet" type="text/css">
		<link href="/home/css/addstyle.css" rel="stylesheet" type="text/css">
		<script src="/home/AmazeUI-2.4.2/assets/js/jquery.min.js" type="text/javascript"></script>
		<script src="/home/AmazeUI-2.4.2/assets/js/amazeui.js"></script>
		@if($web != '')
			{{-- 网站的描述 --}}
		<meta name="keywords" content="{{ $web->w_keyword }}">
			{{-- 网站的关键字 --}}
		<meta name="description" content="{{ $web->w_description }}">
		
		@endif
	</head>

	<body>
		<!--头 -->
		<header>
			<article>
				<div class="mt-logo">
					<!--顶部导航条 -->
					
					<div class="am-container header">
						<ul class="message-l">
							<div class="topMessage">
								<div class="menu-hd">
								
									@if(session('home'))
										<a href="#" target="_top" class="h">欢迎 {{ session('home.name') }} 光临</a>
										<a href="/home/login/logout">退出</a>
										@else
										<a href="/home/login" target="_top" class="h">亲，请登录</a>
										<a href="/home/register" target="_top">免费注册</a>
									@endif
								</div>
							</div>
						</ul>
						<ul class="message-r">
							<div class="topMessage home">
								<div class="menu-hd"><a href="/home/index" target="_top" class="h">商城首页</a></div>
							</div>
							@if(session('home'))
								<div class="topMessage my-shangcheng">
									<div class="menu-hd MyShangcheng"><a href="/home/userinfo" target="_top"><i class="am-icon-user am-icon-fw"></i>个人中心</a></div>
								</div>
								<div class="topMessage mini-cart">
									<div class="menu-hd"><a id="mc-menu-hd" href="/home/carts" target="_top"><i class="am-icon-shopping-cart  am-icon-fw"></i><span>购物车</span></a></div>
								</div>
								<div class="topMessage favorite">
									<div class="menu-hd"><a href="/home/userinfo_collect" target="_top"><i class="am-icon-heart am-icon-fw"></i><span>收藏夹</span></a></div>
								</div>
							@endif
						</ul>
						</div>
		
						<!--悬浮搜索框-->
		
						<div class="nav white">
							
							<div class="logoBig" style='width:10%;'>
								<li>
									@if($web !='')
										<img src="/uploads/{{ $web->w_logo }}" />
									@else
										<img src="/home/images/logobig.png" />
									@endif
								</li>
							</div>
		
							<div class="search-bar pr">
								<a name="index_none_header_sysc" href="#"></a>
								<form action="/home/goods/goodSearch" method="get" >
									<input id="searchInput" name="gname" type="text" placeholder="搜索" autocomplete="off">
									<input id="ai-topsearch" class="submit am-btn" value="搜索"  type="submit">
								</form>
							</div>
						</div>
		
						<div class="clear"></div>
					</div>
				</div>
			</article>
		</header>
            <div class="nav-table">
					   <div class="long-title"><span class="all-goods">全部分类</span></div>
					   <div class="nav-cont">
							<ul>
								<li class="index"><a href="/home/index">首页</a></li>
                                <li class="qc"><a href="/home/blogs/blogAll">活动</a></li>
                               
							</ul>
						    
						</div>
			</div>
			<b class="line"></b>
		<div class="center">
			<div class="col-main">
                @yield('content')
                
                @show
				<!--底部-->
				<div class="footer">
						<div class="footer-hd ">
							<p>
								@foreach($links as $v)
								<b>|</b>
								<a href="{{ $v->l_url }}">{{ $v->l_name }}</a>
								@endforeach
							</p>
						</div>
					<div class="footer-bd">
						<p>
							<a href="#">关于恒望</a>
							<a href="#">合作伙伴</a>
							<a href="#">联系我们</a>
							<a href="#">网站地图</a>

							@if($web != '')
								<em>© {{ $web->w_cright }} 版权所有</em></p>
							@else
								<em>© 未来家具 版权所有</em></p>
							@endif
						</p>
					</div>
				</div>

			</div>
			
			<aside class="menu">
					<ul>
						<li class="person active">
							<a href="/home/userinfo">个人中心</a>
						</li>
						<li class="person">
							<a href="#">个人资料</a>
							<ul>
								<li> <a href="/home/userinfo_personal">个人信息</a></li>
								<li> <a href="/home/userinfo_safe">安全设置</a></li>
								<li> <a href="/home/userinfo_address">收货地址</a></li>
							</ul>
						</li>
						<li class="person">
							<a href="#">我的交易</a>
							<ul>
								<li><a href="/home/userinfo_order">订单管理</a></li>
								
							</ul>
						</li>
						<li class="person">
							<a href="#">我的资产</a>
							<ul>
								<li> <a href="/home/userinfo_coupon">优惠券 </a></li>
								
							</ul>
						</li>
		
						<li class="person">
							<a href="#">我的小窝</a>
							<ul>
								<li> <a href="/home/userinfo_collect">收藏</a></li>
								<li> <a href="/home/userinfo_foot">足迹</a></li>
								<li> <a href="/home/userinfo_evaluate">评价</a></li>
								
							</ul>
						</li>
		
					</ul>
		
			</aside>
		</div>
		<!--引导 -->
		<div class="navCir">
			<li><a href="home/home.html"><i class="am-icon-home "></i>首页</a></li>
			<li><a href="home/sort.html"><i class="am-icon-list"></i>分类</a></li>
			<li><a href="/home/cart"><i class="am-icon-shopping-basket"></i>购物车</a></li>	
			<li class="active"><a href="index.html"><i class="am-icon-user"></i>我的</a></li>					
		</div>
	</body>

</html>