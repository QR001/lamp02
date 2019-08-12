<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=0">

		<title>框架</title>

		<link href="/home/AmazeUI-2.4.2/assets/css/admin.css" rel="stylesheet" type="text/css">
		<link href="/home/AmazeUI-2.4.2/assets/css/amazeui.css" rel="stylesheet" type="text/css">

		<link href="/home/css/personal.css" rel="stylesheet" type="text/css">

		<script src="/home/AmazeUI-2.4.2/assets/js/jquery.min.js" type="text/javascript"></script>
		<script src="/home/AmazeUI-2.4.2/assets/js/amazeui.js" type="text/javascript"></script>
		


		<!-- <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,600" rel="stylesheet"> -->

		<!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->

	<!-- <link rel="stylesheet" href="/home/css/lcss/reset.min.css"> -->


<link rel="stylesheet" href="/home/css/lcss/style.css">
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
									<a href="#" target="_top" class="h">亲，请登录</a>
									<a href="#" target="_top">免费注册</a>
								</div>
							</div>
						</ul>
						<ul class="message-r">
							<div class="topMessage home">
								<div class="menu-hd"><a href="#" target="_top" class="h">商城首页</a></div>
							</div>
							<div class="topMessage my-shangcheng">
								<div class="menu-hd MyShangcheng"><a href="#" target="_top"><i class="am-icon-user am-icon-fw"></i>个人中心</a></div>
							</div>
							<div class="topMessage mini-cart">
								<div class="menu-hd"><a id="mc-menu-hd" href="#" target="_top"><i class="am-icon-shopping-cart  am-icon-fw"></i><span>购物车</span><strong id="J_MiniCartNum" class="h">0</strong></a></div>
							</div>
							<div class="topMessage favorite">
								<div class="menu-hd"><a href="#" target="_top"><i class="am-icon-heart am-icon-fw"></i><span>收藏夹</span></a></div>
						</ul>
						</div>

						<!--悬浮搜索框-->

						<div class="nav white">
							<div class="logoBig">
								<li><img src="images/logobig.png" /></li>
							</div>

							<div class="search-bar pr">
								<a name="index_none_header_sysc" href="#"></a>
								<form>
									<input id="searchInput" name="index_none_header_sysc" type="text" placeholder="搜索" autocomplete="off">
									<input id="ai-topsearch" class="submit am-btn" value="搜索" index="1" type="submit">
								</form>
							</div>
						</div>

						<div class="clear"></div>
					</div>
				</div>
			</article>
		</header>


		<div class="center">
			<div class="col-main">
				<div class="main-wrap">
					<div class="wrapper">
						<div class="container">
							<div class="left">
								<!-- <div class="top">
									<input type="text" placeholder="Search" />
									<a href="javascript:;" class="search"></a>
								</div>
								<ul class="people">
									<li class="person" data-chat="person1">
										<img src="img/thomas.jpg" alt="" />
										<span class="name">Thomas Bangalter</span>
										<span class="time">2:09 PM</span>
										<span class="preview">I was wondering...</span>
									</li>
									<li class="person" data-chat="person2">
										<img src="img/dog.png" alt="" />
										<span class="name">Dog Woofson</span>
										<span class="time">1:44 PM</span>
										<span class="preview">I've forgotten how it felt before</span>
									</li>
								  
								</ul> -->
							</div>
							<div class="right">
								<div class="top"><span>To: <span class="name">Dog Woofson</span></span></div>
								<div class="chat" data-chat="person1">
									<div class="conversation-start">
										<span>Today, 6:48 AM</span>
									</div>
									<div class="bubble you">
										Hello,
									</div>
									<div class="bubble you">
										it's me.
									</div>
									<div class="bubble you">
										I was wondering...
									</div>
								</div>
								<div class="chat" data-chat="person2">
									<div class="conversation-start">
										<span>Today, 5:38 PM</span>
									</div>
									<div class="bubble you">
										Hello, can you hear me?
									</div>
									<div class="bubble you">
										I'm in California dreaming
									</div>
									<div class="bubble me">
										... about who we used to be.
									</div>
									<div class="bubble me">
										Are you serious?
									</div>
									<div class="bubble you">
										When we were younger and free...
									</div>
									<div class="bubble you">
										I've forgotten how it felt before
									</div>
									<div class="bubble you">
										When we were younger and free...
									</div>
									<div class="bubble you">
										I've forgotten how it felt before
									</div>
									<div class="bubble me">
										... about who we used to be.
									</div>
									<div class="bubble me">
										Are you serious?
									</div>
									<div class="bubble me">
										... about who we used to be.
									</div>
									<div class="bubble me">
										Are you serious?
									</div>
									<div class="bubble me">
										... about who we used to be.
									</div>
									<div class="bubble me">
										Are you serious?
									</div>

									<div class="bubble me">
										... about who we used to be.
									</div>
									<div class="bubble me">
										Are you serious?
									</div>
									<div class="bubble me">
										... about who we used to be.
									</div>
									<div class="bubble me">
										Are you serious?
									</div>
									<div class="bubble me">
										... about who we used to be.
									</div>
									<div class="bubble me">
										Are you serious?
									</div>
									<div class="bubble me">
										Are you serious?
									</div>
									<div class="bubble me">
										... about who we used to be.
									</div>
									<div class="bubble me">
										Are you serious?
									</div>
								</div>
								
								
								
								
								<div class="write">
									<a href="javascript:;" class="write-link attach"></a>
									<input type="text" />
									<a href="javascript:;" class="write-link smiley"></a>
									<a href="javascript:;" class="write-link send"></a>
								</div>
							</div>
						</div>
					</div>
					  
				</div>
				<!--底部-->
				<div class="footer">
					<div class="footer-hd">
						<p>
							<a href="#">恒望科技</a>
							<b>|</b>
							<a href="#">商城首页</a>
							<b>|</b>
							<a href="#">支付宝</a>
							<b>|</b>
							<a href="#">物流</a>
						</p>
					</div>
					<div class="footer-bd">
						<p>
							<a href="#">关于恒望</a>
							<a href="#">合作伙伴</a>
							<a href="#">联系我们</a>
							<a href="#">网站地图</a>
							<em>© 2015-2025 Hengwang.com 版权所有</em>
						</p>
					</div>
				</div>
			</div>

			<aside class="menu">
				<ul>
					<li class="person">
						<a href="index.html">个人中心</a>
					</li>
					<li class="person">
						<a href="#">个人资料</a>
						<ul>
							<li> <a href="information.html">个人信息</a></li>
							<li> <a href="safety.html">安全设置</a></li>
							<li> <a href="address.html">收货地址</a></li>
						</ul>
					</li>
					<li class="person">
						<a href="#">我的交易</a>
						<ul>
							<li><a href="order.html">订单管理</a></li>
							<li> <a href="change.html">退款售后</a></li>
						</ul>
					</li>
					<li class="person">
						<a href="#">我的资产</a>
						<ul>
							<li> <a href="coupon.html">优惠券 </a></li>
							<li> <a href="bonus.html">红包</a></li>
							<li> <a href="bill.html">账单明细</a></li>
						</ul>
					</li>

					<li class="person">
						<a href="#">我的小窝</a>
						<ul>
							<li> <a href="collection.html">收藏</a></li>
							<li> <a href="foot.html">足迹</a></li>
							<li> <a href="comment.html">评价</a></li>
							<li> <a href="news.html">消息</a></li>
							
						</ul>
					</li>
					<li class="person">
						<!-- <div class="container"> -->
							<div class="left">
							
							<ul class="people">
								<li class="person" data-chat="person2">
									
									
									
									<span class="preview">联系卖家</span>
								</li>
							  
							</ul>
						<!-- </div> -->
					</li>
				</ul>
				
			</aside>
		</div>
		<script  src="/home/js/ljs/index.js"></script>
	</body>

</html>