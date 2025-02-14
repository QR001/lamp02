<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

		<title>搜索页面</title>

		<link href="/home/AmazeUI-2.4.2/assets/css/amazeui.css" rel="stylesheet" type="text/css" />
		<link href="/home/AmazeUI-2.4.2/assets/css/admin.css" rel="stylesheet" type="text/css" />

		<link href="/home/basic/css/demo.css" rel="stylesheet" type="text/css" />

		<link href="/home/css/seastyle.css" rel="stylesheet" type="text/css" />

		<script type="text/javascript" src="/home/basic/js/jquery-1.7.min.js"></script>
		<script type="text/javascript" src="/home/js/script.js"></script>
		@if($web != '')
			{{-- 网站的描述 --}}
		<meta name="keywords" content="{{ $web->w_keyword }}">
			{{-- 网站的关键字 --}}
		<meta name="description" content="{{ $web->w_description }}">
		@endif
	</head>

	<body>

		<!--顶部导航条 -->
		{{-- <div class="am-container header">
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
		</div> --}}
		<div class="am-container header">
				@if(session('home.id'))
					<ul class="message-l">
						<div class="topMessage">
							<div class="menu-hd">
								<a href="#" target="_top" class="h">欢迎 {{ session('home.name') }} 光临</a>
								<a href="/home/login/logout">退出</a>
							</div>
						</div>
					</ul>
				@else
				  <ul class="message-l">
						<div class="topMessage">
							<div class="menu-hd">
						
								<a href="/home/login" target="_top" class="h">亲，请登录</a>
								<a href="/home/register" target="_top">免费注册</a>
							</div>
						</div>
					</ul>
				@endif
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
					<form>
						<input id="searchInput" name="index_none_header_sysc" type="text" placeholder="搜索" autocomplete="off">
						<input id="ai-topsearch" class="submit am-btn"  value="搜索" index="1" type="submit">
					</form>
				</div>
			</div>

			<div class="clear"></div>
			<b class="line"></b>
           <div class="search">
			<div class="search-list">
			<div class="nav-table">
					   <div class="long-title"><span class="all-goods">全部分类</span></div>
					   <div class="nav-cont">
							<ul>
								<li class="index"><a href="/home/index">首页</a></li>
                                <li class="qc"><a href="/home/blogs/blogAll">活动</a></li>
							</ul>
						    
						</div>
			</div>
			
				
					<div class="am-g am-g-fixed">
						<div class="am-u-sm-12 am-u-md-12">
	                  	<div class="theme-popover">														
							<div class="searchAbout">
								<span class="font-pale">相关商品：</span>
							
							</div>
							<ul class="select">
								
								
								<div class="clear"></div>
								@foreach($sort2 as $k => $v2)
								<li class="select-list">
									<dl id="select1">
										<dt class="am-badge am-round">{{ $v2->s_name }}</dt>	
									
										 <div class="dd-conent">	

											<dd class="{{ Session()->get('goods')[$k] == $v2->id ? 'selected' : '' }}"><a href="/home/goods/goodlist/{{ $sid }}/{{ $k }}/{{ $v2->id }}">全部</a></dd>
											@foreach($v2->sort3 as $v3)
											<dd class="{{ Session()->get('goods')[$k] == $v3->id ? 'selected' : '' }}"><a href="/home/goods/goodlist/{{ $sid }}/{{ $k }}/{{ $v3->id }}">{{ $v3->s_name }}</a></dd>
											@endforeach
										 </div>
						
									</dl>
								</li>
								@endforeach
							</ul>
							<div class="clear"></div>
                        </div>
								<div class="sort">
									<li class="{{ $type == 'time' ? 'first' : '' }}"><a href="/home/goods/goodlist/{{ $sid }}/{{ $kv }}/{{ $sortv }}/time">最新上架</a></li>
									<li class="{{ $type == 'sales' ? 'first' : '' }}"><a href="/home/goods/goodlist/{{ $sid }}/{{ $kv }}/{{ $sortv }}/sales">销量优先</a></li>
									<li class="{{ $type == 'price' ? 'first' : '' }}"><a href="/home/goods/goodlist/{{ $sid }}/{{ $kv }}/{{ $sortv }}/price">价格排序</a></li>
								</div>
								<div class="clear"></div>

								<ul class="am-avg-sm-2 am-avg-md-3 am-avg-lg-4 boxes">
									@foreach($goods as $v)
										<li onclick="goodInfo( {{ $v->id }} )">
											<div class="i-pic limit">
												<img src="/uploads/goods/{{ $v->img }}" height="278px" />											
												<p class="title fl">{{ $v->g_name }}</p>
												<p class="price fl">
													<b>¥</b>
													<strong>{{ $v->g_nprice }}</strong>
												</p>
												<p class="number fl">
													销量<span>{{ $v->g_sales }}</span>
												</p>
											</div>
										</li>
									@endforeach
								</ul>

								<script>
									function goodInfo(id){
										window.location.href="/home/goods/goodInfo/"+id;
									}
								</script>
							
							<div class="clear"></div>
							<!--分页 -->
							
							{{ $goods->links() }}

						</div>

						<style>
							.pagination {
								position: relative;
							}

							.am-pagination-right {
								text-align: right;
							}
							.pagination {
								padding-left: 0;
								margin: 1.5rem 0;
								list-style: none;
								color: #999999;
								text-align: left;
							}

							.pagination li {
								float: none;
							}
							.pagination > li {
								display: inline-block;
							}
							.pagination > li > a, .pagination > li > span {
								position: relative;
								display: block;
								padding: 0.5em 1em;
								text-decoration: none;
								line-height: 1.2;
								background-color: #fff;
								border: 1px solid #ddd;
								border-radius: 0;
								margin-bottom: 5px;
								margin-right: 5px;
							}

							.pagination > .active > a, .pagination > .active > span, .pagination > .active > a:hover, .pagination > .active > span:hover, .pagination > .active > a:focus, .pagination > .active > span:focus {
								z-index: 2;
								color: #fff;
								background-color: #0e90d2;
								border-color: #0e90d2;
								cursor: default;
							}
						</style>
					</div>
<<<<<<< HEAD
					@extends('home.layouts.footer')
=======
@extends('home.layouts.footer')
>>>>>>> origin/zhangyahan

@section('content')

@endsection