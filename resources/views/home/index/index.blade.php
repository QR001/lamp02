<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

	

		<link href="/home/AmazeUI-2.4.2/assets/css/amazeui.css" rel="stylesheet" type="text/css" />
		<link href="/home/AmazeUI-2.4.2/assets/css/admin.css" rel="stylesheet" type="text/css" />

		<link href="/home/basic/css/demo.css" rel="stylesheet" type="text/css" />

		<link href="/home/css/hmstyle.css" rel="stylesheet" type="text/css"/>
		<link href="/home/css/skin.css" rel="stylesheet" type="text/css" />
		<script src="/home/AmazeUI-2.4.2/assets/js/jquery.min.js"></script>
		<script src="/home/AmazeUI-2.4.2/assets/js/amazeui.min.js"></script>

		<script type='text/javascript' src='https://webchat.7moor.com/javascripts/7moorInit.js?accessId=231515b0-b999-11e9-ba32-bfd32cf2bdfe&autoShow=false&language=ZHCN' async='async'>
		</script>
		@if($web != '')
		<title>{{ $web->w_title }}</title>
		{{-- 网站的描述 --}}
		  <meta name="keywords" content="{{ $web->w_keyword }}">
		{{-- 网站的关键字 --}}
		  <meta name="description" content="{{ $web->w_description }}">
		  @endif
		  

	</head>

	<body>
		<div class="hmtop">
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
				@if($web !='')
					<div class="logo"><img width='30px' src="/uploads/{{ $web->w_logo }}" /></div>
					<div class="logoBig" style="width:10%;">
						<li><img width='30px' src="/uploads/{{ $web->w_logo }}" /></li>
					</div>
				@else
					<div class="logo"><img src="/home/images/logo.png" /></div>
					<div class="logoBig">
						<li><img src="/home/images/logobig.png" /></li>
					</div>
				@endif
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
			<div class="banner">
                      <!--轮播 -->
						<div class="am-slider am-slider-default scoll" data-am-flexslider id="demo-slider-0">
							<ul class="am-slides">
								@foreach($turns as $v)
								<li class="banner4"><a><img src="/uploads/turns/{{ $v }}" style="width:100%;height:100%;left:0;margin-left:0;" /></a></li>
								@endforeach
							</ul>
						</div>
						<div class="clear"></div>	
			</div>
			<div class="shopNav">
				<div class="slideall">
					
					   <div class="long-title"><span class="all-goods">全部分类</span></div>
					   <div class="nav-cont">
							<ul>
								<li class="index"><a href="/home/index">首页</a></li>
                                <li class="qc"><a href="/home/blogs/blogAll">活动</a></li>
                                
							</ul>
						    
						</div>					
		        				
						<!--侧边导航 -->
						<div id="nav" class="navfull">
							<div class="area clearfix">
								<div class="category-content" id="guide_2">
									
									<div class="category" style="height: 430px;">
										<ul class="category-list" id="js_climit_li">
										@foreach($sort as $v)
											<li class="appliance js_toggle relative first">
												<div class="category-info">
													<h3 class="category-name b-category-name"><a class="ml-22" title="{{ $v->s_name }}">{{ $v->s_name }}</a></h3>
													<em>&gt;</em>
												</div>
												<div class="menu-item menu-in top">
													<div class="area-in">
														<div class="area-bg">
															<div class="menu-srot">
																<div class="sort-side">
																@foreach($v->sort2 as $k2 => $v2)

																	<dl class="dl-sort">
																		<dt><span title="{{ $v2->s_name }}">{{ $v2->s_name }}</span></dt>
																		@foreach($v2->sort3 as $v3)
																		<dd><a title="{{ $v3->s_name }}" href="/home/goods/goodlist/{{ $v->id }}/{{ $k2 }}/{{ $v3->id }}"><span>{{ $v3->s_name }}</span></a></dd>
																		@endforeach
																	</dl>
																@endforeach
																</div>
																
															</div>
														</div>
													</div>
												</div>
												<b class="arrow"></b>	
											</li>
										@endforeach	
										
										
										</ul>
									</div>
								</div>

							</div>
						</div>
						
						
						<!--轮播-->
						
						<script type="text/javascript">
							(function() {
								$('.am-slider').flexslider();
							});
							$(document).ready(function() {
								$("li").hover(function() {
									$(".category-content .category-list li.first .menu-in").css("display", "none");
									$(".category-content .category-list li.first").removeClass("hover");
									$(this).addClass("hover");
									$(this).children("div.menu-in").css("display", "block")
								}, function() {
									$(this).removeClass("hover")
									$(this).children("div.menu-in").css("display", "none")
								});
							})
						</script>



					<!--小导航 -->
					<div class="am-g am-g-fixed smallnav">
						<div class="am-u-sm-3">
							<a href="sort.html"><img src="/home/images/navsmall.jpg" />
								<div class="title">商品分类</div>
							</a>
						</div>
						<div class="am-u-sm-3">
							<a href="/home/blogs/blogAll"><img src="/home/images/huismall.jpg" />
								<div class="title">特惠活动</div>
							</a>
						</div>
						<div class="am-u-sm-3">
							<a href="#"><img src="/home/images/mansmall.jpg" />
								<div class="title">个人中心</div>
							</a>
						</div>
						<div class="am-u-sm-3">
							<a href="#"><img src="/home/images/moneysmall.jpg" />
								<div class="title">投资理财</div>
							</a>
						</div>
					</div>

					<!--走马灯 -->

					<div class="marqueen">
						<span class="marqueen-title">商城头条</span>
						<div class="demo">

							<ul>
							
						{{-- 判断是否登录 --}}
						@if(session('home'))
							<div class="mod-vip">
								<div class="m-baseinfo">
									<a href="/home/userinfo">
										<img src="/uploads/{{ $userPhoto }}">
									</a>
									<em>
										Hi,<span class="s-name">{{ session('home.name') }}</span>
										<a href="/home/blogs/blogAll"><p>点击更多优惠活动</p></a>									
									</em>
									<div class="member-login">
										<a href="#"><strong>{{ $order[0] }}</strong>待收货</a>
										<a href="#"><strong>{{ $order[1] }}</strong>待发货</a>
										<a href="#"><strong>{{ $order[2] }}</strong>待付款</a>
										<a href="#"><strong>{{ $order[3] }}</strong>待评价</a>
									</div>
								</div>
								
								
								<div class="clear"></div>	
							</div>
						@else	    
							<div class="mod-vip">
								<div class="m-baseinfo">
									<a href="#">
										<img src="/home/images/getAvatar.do.jpg">
									</a>
									<em>
										Hi,<span class="s-name">小叮当</span>
										<a href="/home/blogs/blogAll"><p>点击更多优惠活动</p></a>									
									</em>
								</div>
								<div class="member-logout">
									<a class="am-btn-warning btn" href="/home/login">登录</a>
									<a class="am-btn-warning btn" href="/home/register">注册</a>
								</div>
								
								<div class="clear"></div>	
							</div>
						@endif																	    
							@foreach($blogs as $v)  
								<li><a href="/home/blogs/bloglist/{{ $v->id }}"><span>[特惠]</span>{{ $v->b_title }}</a></li>
							@endforeach
							</ul>
                        <div class="advTip"><img src="/uploads/turn2.jpg" height="100px"/></div>
						</div>
					</div>
					<div class="clear"></div>
				</div>
				<script type="text/javascript">
					if ($(window).width() < 640) {
						function autoScroll(obj) {
							$(obj).find("ul").animate({
								marginTop: "-39px"
							}, 500, function() {
								$(this).css({
									marginTop: "0px"
								}).find("li:first").appendTo(this);
							})
						}
						$(function() {
							setInterval('autoScroll(".demo")', 3000);
						})
					}
				</script>
			</div>
			<div class="shopMainbg">
				<div class="shopMain" id="shopmain">

					<!--今日推荐 -->

					<div class="am-g am-g-fixed recommendation">
						<div class="clock am-u-sm-3" >
							<img src="/home/images/2019.png ">
							<p>今日<br>推荐</p>
						</div>
						@foreach($sale as $v)
						<div class="am-u-sm-4 am-u-lg-3 ">
							<div class="info " style="width:50%;">
								<h3 style="overflow:hidden;width:80%;">{{ $v->g_name }}</h3>
							</div>
							<div class="recommendationMain one">
								<a href="/home/goods/goodInfo/{{ $v->id }}"><img src="/uploads/goods/{{ $v->g_img }} " height="120px"></a>
							</div>
						</div>						
						@endforeach
					</div>
					<div class="clear "></div>
					<!--热门活动 -->

					<div class="am-container activity ">
						<div class="shopTitle ">
							<h4>活动</h4>
							<h3>每期活动 优惠享不停 </h3>
							<span class="more ">
                              <a href="/home/blogs/blogAll">全部活动<i class="am-icon-angle-right" style="padding-left:10px ;" ></i></a>
                        </span>
						</div>
					  <div class="am-g am-g-fixed ">
						  @foreach($blogs as $v)
							<div class="am-u-sm-3 " >
								<div class="icon-sale"></div>	
									<h4>特惠</h4>							
								<div class="activityMain ">
									<a href="/home/blogs/bloglist/{{ $v->id }}"><img src="/uploads/blogs/{{ $v->b_img }}" width="100%" height="250px"></a>
								</div>
								<div class="info ">
									<h3>{{ $v->b_title }}</h3>
								</div>														
							</div>
						
						  @endforeach

					  </div>
                   </div>
					<div class="clear "></div>

					<!-- 主页主体 -->
					@foreach($sort as $k=>$v)
                    <div id="f{{ $k+1 }}">
					<div class="am-container ">
						<div class="shopTitle ">
							<h4>{{ $v->s_name }}</h4>
							
							<span class="more ">
                    			<a href="/home/goods/goodlist/{{ $v->id }}">更多商品<i class="am-icon-angle-right" style="padding-left:10px ;" ></i></a>
                        	</span>
						</div>
					</div>
					
					<div class="am-g am-g-fixed floodFour">
						<div class="am-u-sm-5 am-u-md-4 text-one list ">
							<div class="word">
								@foreach($v->sort2 as $k2=>$v2)
								<a class="outer" href="#"><span class="inner"><b class="text">{{ $v2->s_name }}</b></span></a>
								@endforeach
							</div>
							<a href=" ">
								<div class="outer-con ">
									<div class="title ">
									开抢啦！
									</div>
									<div class="sub-title ">
										零食大礼包
									</div>									
								</div>
                                <img src="/home/images/act1.png " />								
							</a>
							<div class="triangle-topright"></div>						
						</div>
						@foreach($v->goods as $good)
							<div class="am-u-sm-7 am-u-md-4 text-two">
								<div class="outer-con ">
									<div class="title ">
										{{ $good->g_name }} 
									</div>									
									<div class="sub-title ">
										¥{{ $good->g_nprice }}
									</div>
									<i class="am-icon-shopping-basket am-icon-md  seprate" onclick="carts({{ $good->id }})"></i>
								</div>
								<a href="/home/goods/goodInfo/{{ $good->id }}"><img src="/uploads/goods/{{ $good->img }}" height="170px" /></a>
								
<<<<<<< HEAD
=======
								<a href="/home/goods/goodInfo/{{ $good->id }}"><img src="/uploads/goods/{{ $v->goods[0]->img }}" /></a>
>>>>>>> origin/zhangyahan
							</div>
						@endforeach

					</div>
					@endforeach

					<script>
						function carts(id)
						{
							$.ajax({
								type:'POST',
								url:'/home/carts/cart',
								data:{'color':'图片色','number':1,'id':id,'_token':'{{csrf_token()}}'},
								success:function(data){
									if(data == 'nologin'){
										alert("还没有登录哦");
									}
									if(data == 'success'){
										alert('加入成功');
<<<<<<< HEAD
									}
									if(data == 'error'){
=======
									}else{
>>>>>>> origin/zhangyahan
										alert("请稍后再试试吧~");
									}
								},
								error:function(){
									alert('请稍后再试试吧~');
								}
							})
						}
						
					</script>


                 <div class="clear "></div>  
                 </div>
                 

<<<<<<< HEAD
				 @extends('home.layouts.footer')

@section('content')

@endsection				
=======
@extends('home.layouts.footer')
@section('content')
@endsection
>>>>>>> origin/zhangyahan
