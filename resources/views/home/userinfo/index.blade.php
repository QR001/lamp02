<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=0">

		<title>个人中心</title>

		<link href="/home/AmazeUI-2.4.2/assets/css/admin.css" rel="stylesheet" type="text/css">
		<link href="/home/AmazeUI-2.4.2/assets/css/amazeui.css" rel="stylesheet" type="text/css">
		<link href="/home/css/personal.css" rel="stylesheet" type="text/css">
		<link href="/home/css/systyle.css" rel="stylesheet" type="text/css">
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
							
							<div class="logoBig" style="width:10%;">
								<li>
									@if($web != '')
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
				<div class="main-wrap">
					<div class="wrap-left">
						<div class="wrap-list">
							<div class="m-user">
								<!--个人信息 -->
								
								<div class="m-bg"></div>
								<div class="m-userinfo">
									<div class="m-baseinfo">
										<a href="information.html">
											
											<img src="/uploads/{{ $userphoto }}">
										</a>
										<em class="s-name">({{ session('home.name') }})<span class="vip1"></em>
										<div class="s-prestige am-btn am-round">
											</span>会员福利</div>
									</div>
									<div class="m-right">
										<div class="m-new">
											<a href="news.html"><i class="am-icon-bell-o"></i>消息</a>
										</div>
										<div class="m-address">
											<a href="/home/userinfo_address" class="i-trigger">我的收货地址</a>
										</div>
									</div>
								</div>

								<!--个人资产-->
								<div class="m-userproperty">
									<div class="s-bar">
										<i class="s-icon"></i>个人资产
									</div>
									
									<p class="m-coupon">
										<a href="coupon.html">
											<i><img src="images/coupon.png"/></i>
											<span class="m-title">优惠券</span>
											<em class="m-num">{{ $couponCount }}</em>
										</a>
									</p>
									<p class="m-bill">
										<a href="bill.html">
											<i><img src="images/wallet.png"/></i>
											<span class="m-title">钱包</span>
										</a>
									</p>
									<p class="m-big">
										<a href="#">
											<i><img src="images/day-to.png"/></i>
											<span class="m-title">签到有礼</span>
										</a>
									</p>
									<p class="m-big">
										<a href="#">
											<i><img src="images/72h.png"/></i>
											<span class="m-title">72小时发货</span>
										</a>
									</p>
								</div>
							</div>
							<div class="box-container-bottom"></div>

							<!--订单 -->
							<div class="m-order">
								<div class="s-bar">
									<i class="s-icon"></i>我的订单
									<a class="i-load-more-item-shadow" href="/home/userinfo_order">全部订单</a>
								</div>
								<ul>
									<li><a href="#"><i><img src="images/pay.png"/></i><span>待付款<em class="m-num">{{ $orderStatus['status_1'] }}</em></span></span></a></li>
									<li><a href="#"><i><img src="images/send.png"/></i><span>待发货<em class="m-num">{{ $orderStatus['status_2'] }}</em></span></a></li>
									<li><a href="#"><i><img src="images/receive.png"/></i><span>待收货<em class="m-num">{{ $orderStatus['status_3'] }}</em></span></span></a></li>
									<li><a href="#"><i><img src="images/comment.png"/></i><span>待评价<em class="m-num">{{ $orderStatus['status_4'] }}</em></span></a></li>
									<li><a href="#"><i><img src="images/comment.png"/></i><span>已评价<em class="m-num">{{ $orderStatus['status_5'] }}</em></span></span></a></li>
								</ul>
							</div>
							<!--九宫格-->
							<div class="user-patternIcon">
								<div class="s-bar">
									<i class="s-icon"></i>我的常用
								</div>
								<ul>
									<a href="home/shopcart.html"><li class="am-u-sm-4"><i class="am-icon-shopping-basket am-icon-md"></i><img src="images/iconbig.png"/><p>购物车</p></li></a>
									<a href="collection.html"><li class="am-u-sm-4"><i class="am-icon-heart am-icon-md"></i><img src="images/iconsmall1.png"/><p>我的收藏</p></li></a>
									<a href="home/home.html"><li class="am-u-sm-4"><i class="am-icon-gift am-icon-md"></i><img src="images/iconsmall0.png"/><p>为你推荐</p></li></a>
									<a href="comment.html"><li class="am-u-sm-4"><i class="am-icon-pencil am-icon-md"></i><img src="images/iconsmall3.png"/><p>好评宝贝</p></li></a>
									<a href="foot.html"><li class="am-u-sm-4"><i class="am-icon-clock-o am-icon-md"></i><img src="images/iconsmall2.png"/><p>我的足迹</p></li></a>                                                                        
								</ul>
							</div>
							
						

						</div>
					</div>
					<div class="wrap-right">

						<!-- 日历-->
						<div class="day-list">
							<div class="s-bar">
								<a class="i-history-trigger s-icon" href="#"></a>我的日历
								<a class="i-setting-trigger s-icon" href="#"></a>
							</div>
							<div class="s-care s-care-noweather">
								<div class="s-date">
									<em>{{ $day }}</em>
									<span>{{ $week }}</span>
									<span>{{ $year }}.{{ $month }}</span>
								</div>
							</div>
						</div>
						<!--新品 -->
						@if($newgood !==0)
							<div class="new-goods">
								<div class="s-bar">
									<i class="s-icon"></i>今日新品
							
								</div>
								<div class="new-goods-info">
									<a class="shop-info" href="#" target="_blank">
										<div class="face-img-panel">
											<img src="/uploads/goods/{{ $newgood->g_img }}" alt="">
										</div>
										<span class="new-goods-num ">{{ $newgood->g_sales }}</span>
										<span class="shop-title">{{ $newgood->g_name }}</span>
									</a>
								
								</div>
							</div>
						@endif

						<!--热卖推荐 -->
						@if($newgood !==0)
							<div class="new-goods">
								<div class="s-bar">
									<i class="s-icon"></i>热卖推荐
								</div>
								<div class="new-goods-info">
									<a class="shop-info" href="#" target="_blank">
										<div >
											<img src="/uploads/goods/{{ $hotgood->g_img }}" alt="">
										</div>
										<span class="one-hot-goods">￥{{ $hotgood->g_nprice }}</span>
									</a>
								</div>
							</div>
						@endif
					</div>
				</div>
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
							<li> <a href="/home/userinfo_refund">退款售后</a></li>
						</ul>
					</li>
					<li class="person">
						<a href="#">我的资产</a>
						<ul>
							<li> <a href="/home/userinfo_coupon">优惠券</a></li>
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
			<li><a href="home/shopcart.html"><i class="am-icon-shopping-basket"></i>购物车</a></li>	
			<li class="active"><a href="index.html"><i class="am-icon-user"></i>我的</a></li>					
		</div>
	</body>

</html>
