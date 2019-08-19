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
								{{-- 网站的logo --}}
								@if($web == '')
								<img alt="logo" src="images/logobig.png" />
								@else
								<img  src="/uploads/{{ $web->w_logo }}" alt="">
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
<!--文章 -->
<div class="am-g am-g-fixed blog-g-fixed bloglist">
  <div class="am-u-md-9">
    <article class="blog-main">
      <h3 class="am-article-title blog-title">
        <a href="#">×{{ $blogs->b_title }}</a>
      </h3>
      <h4 class="am-article-meta blog-meta">{{ $blogs->updated_at }}</h4>

      <div class="am-g blog-content">
        <div class="am-u-sm-12">
          <p>{{ $blogs->b_content }}</p>
          
          <div class="Row">
		  	@foreach($goods as $k => $v)
			  	
          		<li onclick="good({{ $v->id }})"><img src="/uploads/goods/{{ $v->img }}" height="230px" /></li>
            @endforeach
            
            @if(!isset($goods[0]))
            <script>
            
                alert("该活动商品已经抢光了呢，等待下次机会吧");
                window.history.back();
            </script>    
            @endif
          </div>
			<script>
					function good(id)
					{
						window.location.href = "/home/goods/goodInfo/"+id;
					} 
			</script>
          
        </div>
  
      </div>

    </article>


    <hr class="am-article-divider blog-hr">
    
	{{ $goods->links() }}
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
        	@foreach($sblogs as $v)
          	<li><a href="/home/blogs/bloglist/{{ $v->id }}"><p>[特惠]{{ $v->b_title }}</p></a></li>    
			@endforeach  
        </ul>
      </section>

    </div>
  </div>

</div>


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


<!--[if (gte IE 9)|!(IE)]><!-->
<script src="/home/AmazeUI-2.4.2/assets/js/jquery.min.js"></script>
<!--<![endif]-->
<script src="/home/AmazeUI-2.4.2/assets/js/amazeui.min.js"></script>

</body>
</html>
