<!DOCTYPE html>
<html>
<head lang="en">
  <meta charset="UTF-8">
  <title>新闻页面</title>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <meta name="format-detection" content="telephone=no">
  <meta name="renderer" content="webkit">
  <meta http-equiv="Cache-Control" content="no-siteapp"/>
  
   <link href="/home/AmazeUI-2.4.2/assets/css/admin.css" rel="stylesheet" type="text/css">
   <link href="/home/AmazeUI-2.4.2/assets/css/amazeui.css" rel="stylesheet" type="text/css">
   <link href="/home/css/personal.css" rel="stylesheet" type="text/css">
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
								<li><img src="/home/images/logobig.png" /></li>
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
            <div class="nav-table">
					   <div class="long-title"><span class="all-goods">全部分类</span></div>
					   <div class="nav-cont">
							<ul>
								<li class="index"><a href="#">首页</a></li>
                                <li class="qc"><a href="#">闪购</a></li>
                                <li class="qc"><a href="#">限时抢</a></li>
                                <li class="qc"><a href="#">团购</a></li>
                                <li class="qc last"><a href="#">大包装</a></li>
							</ul>
						    <div class="nav-extra">
						    	<i class="am-icon-user-secret am-icon-md nav-user"></i><b></b>我的福利
						    	<i class="am-icon-angle-right" style="padding-left: 10px;"></i>
						    </div>
						</div>
			</div>
			<b class="line"></b>	
<!--文章 -->
<div class="am-g am-g-fixed blog-g-fixed bloglist">
  <div class="am-u-md-9">
    <article class="blog-main">
      <h3 class="am-article-title blog-title">
        <a href="#">×活动总是如期而至，抓紧机会抢购吧！</a>
      </h3>

      <div class="am-g blog-content">
        <div class="am-u-sm-12">
          
		  	@foreach($blogs as $v)
			  	<div class="am-u-sm-12" style="margin-top:25px;">
				  	<strong class="blog-tit"><p><span>丨</span>{{ $v->b_title }}</p></strong>
					<h4 class="am-article-meta blog-meta">{{ $v->updated_at }}</h4>
			
				</div>
				
				<div class="Row" class="am-u-sm-12">
					@if(isset($v->goods[0]))
						@foreach($v->goods as $g)
						<li onclick="good({{ $g->id }})"><img src="/uploads/goods/{{ $g->img }}"/></li>
						@endforeach
					@else
						
						<li onclick="blog( {{ $v->id}} )"><img src="/uploads/blogs/{{ $v->b_img }}"/></li>

					@endif
					
				</div>
				<p class="am-u-sm-12">{{ $v->b_content }}</p>
			@endforeach

        </div>
  
      </div>

    </article>

	<script>
		function good(id){
			window.location.href = "/home/goods/goodInfo/"+id;
		}

		function blog(id){
			window.location.href = "/home/blogs/bloglist/"+id;
		}
	</script>


    <hr class="am-article-divider blog-hr">
    
	{{ $blogs->links() }}
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

  <div class="am-u-md-3 blog-sidebar">
    <div class="am-panel-group">

      <section class="am-panel am-panel-default">
        <div class="am-panel-hd">热门话题</div>
        <ul class="am-list blog-list">
        	@foreach($sblogs as $s)
          	<li><a href="/home/blogs/bloglist/{{ $s->id }}"><p>[特惠]{{ $s->b_title }}</p></a></li>      
			@endforeach
        </ul>
      </section>

    </div>
  </div>

</div>

@extends('home.layouts.footer')

@section('content')

@endsection
