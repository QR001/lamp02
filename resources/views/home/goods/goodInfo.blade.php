<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

		<title>商品页面</title>

		<link href="/home/AmazeUI-2.4.2/assets/css/admin.css" rel="stylesheet" type="text/css" />
		<link href="/home/AmazeUI-2.4.2/assets/css/amazeui.css" rel="stylesheet" type="text/css" />
		<link href="/home/basic/css/demo.css" rel="stylesheet" type="text/css" />
		<link type="text/css" href="/home/css/optstyle.css" rel="stylesheet" />
		<link type="text/css" href="/home/css/style.css" rel="stylesheet" />

		<script type="text/javascript" src="/home/basic/js/jquery-1.7.min.js"></script>
		<script type="text/javascript" src="/home/basic/js/quick_links.js"></script>

		<script type="text/javascript" src="/home/AmazeUI-2.4.2/assets/js/amazeui.js"></script>
		<script type="text/javascript" src="/home/js/jquery.imagezoom.min.js"></script>
		<script type="text/javascript" src="/home/js/jquery.flexslider.js"></script>
		<script type="text/javascript" src="/home/js/list.js"></script>

	</head>

	<body>


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
				<div class="logo"><img src="/home/images/logo.png" /></div>
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
            <b class="line"></b>
			<div class="listMain">

				<!--分类-->
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
				<ol class="am-breadcrumb am-breadcrumb-slash">
					<li><a href="#">首页</a></li>
					<li><a href="#">分类</a></li>
					<li class="am-active">内容</li>
				</ol>
				<script type="text/javascript">
					$(function() {});
					$(window).load(function() {
						$('.flexslider').flexslider({
							animation: "slide",
							start: function(slider) {
								$('body').removeClass('loading');
							}
						});
					});
				</script>
				<div class="scoll">
					<section class="slider">
						<div class="flexslider">
							<ul class="slides">
								<li>
									<img src="/home/images/01.jpg" title="pic" />
								</li>
								<li>
									<img src="/home/images/02.jpg" />
								</li>
								<li>
									<img src="/home/images/03.jpg" />
								</li>
							</ul>
						</div>
					</section>
				</div>

				<!--放大镜-->

				<div class="item-inform">
				<div class="clearfixLeft" id="clearcontent">

					<div class="box">
						<script type="text/javascript">
							$(document).ready(function() {
								$(".jqzoom").imagezoom();
								$("#thumblist li a").click(function() {
									$(this).parents("li").addClass("tb-selected").siblings().removeClass("tb-selected");
									$(".jqzoom").attr('src', $(this).find("img").attr("mid"));
									$(".jqzoom").attr('rel', $(this).find("img").attr("big"));
								});
							});
						</script>

						<div class="tb-booth tb-pic tb-s310">
							<a href="images/01.jpg"><img src="/uploads/goods/{{ $image[0] }}" alt="细节展示放大镜特效" rel="/uploads/goods/{{ $image[0] }}" class="jqzoom" /></a>
						</div>
						<ul class="tb-thumb" id="thumblist">
							@foreach($image as $v)
							<li>
								<div class="tb-pic tb-s40">
									<a href="#"><img src="/uploads/goods/{{ $v }}" mid="/uploads/goods/{{ $v }}" big="/uploads/goods/{{ $v }}"></a>
								</div>
							</li>
							@endforeach
						</ul>
					</div>

					<div class="clear"></div>
					</div>

					<div class="clearfixRight">

						<!--规格属性-->
						<!--名称-->
						<div class="tb-detail-hd">
							<h1>{{ $data->g_name }}</h1>  
						</div>
						<div class="tb-detail-list">
							<!--价格-->
							<div class="tb-detail-price">
								<li class="price iteminfo_price">
									<dt>促销价</dt>
									<dd><em>¥</em><b class="sys_item_price">{{ $data->g_nprice }}</b>  </dd>                                 
								</li>
								<li class="price iteminfo_mktprice">
									<dt>原价</dt>
									<dd><em>¥</em><b class="sys_item_mktprice">{{ $data->g_oprice }}</b></dd>									
								</li>
								<div class="clear"></div>
							</div>

							
							<!--销量-->
							<ul class="tm-ind-panel">
								
								<li class="tm-ind-item tm-ind-sumCount canClick">
									<div class="tm-indcon"><span class="tm-label">累计销量</span><span class="tm-count">{{ $data->g_sales }}</span></div>
								</li>
								<li class="tm-ind-item tm-ind-reviewCount canClick tm-line3">
									<div class="tm-indcon"><span class="tm-label">累计评价</span><span class="tm-count">{{ $count['qcount'] }}</span></div>
								</li>
							</ul>
							<div class="clear"></div>

							<!--各种规格-->
							<dl class="iteminfo_parameter sys_item_specpara">
								<dt class="theme-login"><div class="cart-title">可选规格<span class="am-icon-angle-right"></span></div></dt>
								<dd>
									<!--操作页面-->

									<div class="theme-popover-mask"></div>

									<div class="theme-popover">
										<div class="theme-span"></div>
										<div class="theme-poptit">
											<a href="javascript:;" title="关闭" class="close">×</a>
										</div>
										<div class="theme-popbod dform">
											<form class="theme-signin" name="loginform" action="" method="post">

												<div class="theme-signin-left">
													
													<div class="theme-options">
														<div class="cart-title">尺寸</div>
														<ul>
															@if( $data->g_size )
															<li class="sku-line size selected">{{ $data->g_size }}<i></i></li>
															@else
															<li class="sku-line size selected"> 正常规格 <i></i></li>

															@endif
														</ul>
													</div>
													<div class="theme-options">
														<div class="cart-title">颜色</div>
														<ul>
															@foreach($color as $k => $v)
															<li class="sku-line color">{{ $v }}<i></i></li>
															@endforeach
														</ul>
													</div>
													
													<div class="theme-options">
														<div class="cart-title number">数量</div>
														<dd>
															<input id="min" class="am-btn am-btn-default" name="" type="button" value="-" />
															<input id="text_box" name="" type="text" value="1" style="width:30px;" />
															<input id="add" class="am-btn am-btn-default" name="" type="button" value="+" />
															<span id="Stock" class="tb-hidden">库存<span class="stock">{{ $data->g_stock }}</span>件</span>
														</dd>

													</div>
													<div class="clear"></div>

													<div class="btn-op">
														<div class="btn am-btn am-btn-warning">确认</div>
														<div class="btn close am-btn am-btn-warning">取消</div>
													</div>
												</div>
												<div class="theme-signin-right">
													<div class="img-info">
														<img src="/home/images/songzi.jpg" />
													</div>
													<div class="text-info">
														<span class="J_Price price-now">¥{{ $data->g_nprice }}</span>
														<span id="Stock" class="tb-hidden">库存<span class="stock">{{ $data->g_stock }}</span>件</span>
													</div>
												</div>

											</form>
										</div>
									</div>

								</dd>
							</dl>
							<div class="clear"></div>
							<!--活动	-->
							<div class="shopPromotion gold">
								<div class="hot">
									<dt class="tb-metatit">店铺优惠</dt>
									<div class="gold-list">
										<p>
											@if( $data->g_integral )
											购买可领积分{{ $data->g_integral }}
											@endif
											
											@if( isset($coupons[0]) )
											<span>领取优惠<i class="am-icon-sort-down"></i></span>
											@endif
										</p>
									</div>
								</div>
								<div class="clear"></div>
								<div class="coupon">
									<dt class="tb-metatit">优惠券</dt>
									<div class="gold-list">
										<ul>
											@foreach($coupons as $v)
											<li onclick="yh({{ $v->id }})">优惠{{ $v->c_money }}</li>
											@endforeach
											
										</ul>
										<script>
											function yh(id){
												$.ajax({
													url:'/home/goods/coupons/'+id,
													type:'GET',
													success:function(res){
														if(res == 'nologin'){
															alert("还没有登陆哦");
														}
														if(res == 'noexists' || res == 'error'){
															alert('该优惠已经领取完了哦');

														}
														if(res == 'exists'){
															alert("已经领取过了哦");
														}
														if(res == 'success'){
															alert('领取成功');
														}
													},
													error:function(){
														alert("该优惠已经领取完了哦，下次再试试吧");
													}
												});
											}
										</script>
									</div>
								</div>
							</div>
						</div>

						<div class="pay">
							<div class="pay-opt">
							<a href="home.html"><span class="am-icon-home am-icon-fw">首页</span></a>
							<a><span class="am-icon-heart am-icon-fw">收藏</span></a>
							
							</div>
							<li>
								<div class="clearfix tb-btn tb-btn-buy theme-login">
									<a id="LikBuy" onclick="shopping({{ $data->id }})" title="点此按钮到下一步确认购买0m信息" >立即购买</a>
								</div>
							</li>
							<li>
								<div class="clearfix tb-btn tb-btn-basket theme-login">
									<a id="LikBasket" onclick="charts({{ $data->id }})" title="加入购物车" ><i></i>加入购物车</a>
								</div>
							</li>
						</div>

						<script>
		
							function shopping(id){
								var price = $('.sys_item_price').html() ;
								var color = $('.sku-line.selected').html();
								var size = $('#size').html();
								var number = $('#text_box').val();
								var img=$('.jqzoom')[0].src;
								// console.log(img);
								$.ajax({
									type:'POST',
									url:'/home/shopping',
									data:{'price':price,'color':color,'size':size,'number':number,'img':img,'_token':'{{csrf_token()}}'},
									success:function(data){
										console.log(data);
									},
									error:function(data){
										console.log(data);
									}
								})
								
							}

							$('#text_box').blur(function(){
								var number = $('#text_box').val();
								if(number < 1){
									$('#text_box').val(1)
								}
								// console.log(number);
							});

							function charts(id){
								// var color = $('.selected').html();
								var color = $('.color');
								var number = $('#text_box').val();
								// console.log(color);
								var g_color = '';
								for(var i=0;i<color.length;i++){
									if(color[i].getAttribute('class') == 'sku-line color selected'){
										g_color = $(color[i]);
									}
								}
								if(g_color == ''){
									alert("可选规格不可为空");
									return false;
								}

								g_color = g_color[0].innerText;
								
								$.ajax({
									type:'POST',
									url:'/home/carts/cart',
									data:{'color':g_color,'number':number,'id':id,'_token':'{{csrf_token()}}'},
									success:function(data){
										if(data == 'nologin'){
											alert("还没有登录哦");
										}
										if(data == 'success'){
											alert('加入成功');
										}else{
											alert("请稍后再试试吧~");
										}
									},
									error:function(){
										alert('请稍后再试试吧~');
									}
								})
							}
						</script>


					</div>

					<div class="clear"></div>

				</div>

				
				<div class="clear"></div>
				
							
				<!-- introduce-->

				<div class="introduce">
					<div class="browse">
					    <div class="mc"> 
						     <ul>					    
						     	<div class="mt">            
						            <h2>看了又看</h2>        
					            </div>
                                @foreach ($goods as $k=>$v )
									<li class="first">
									    <div class="p-img">                    
											<a  href="/home/goods/goodInfo/{{ $v->id }}"> <img class="" src="/uploads/goods/{{ $v->img }}"> </a>               
                                        </div>
										<div class="p-name">
                                            <a href="/home/goods/goodInfo/{{ $v->id }}">{{ $v->g_name }}</a>
										</div>
										<div class="p-price"><strong>￥{{ $v->g_nprice  }}</strong></div>
										</li>
									 @endforeach
									
						     </ul>					
					    </div>
					</div>
					<div class="introduceMain">
						<div class="am-tabs" data-am-tabs>
							<ul class="am-avg-sm-3 am-tabs-nav am-nav am-nav-tabs">
								<li class="am-active">
									<a href="#"><span class="index-needs-dt-txt">宝贝详情</span></a>
								</li>

								<li>
									<a href="#"><span class="index-needs-dt-txt">全部评价</span></a>
								</li>

								<li>
									<a href="#"><span class="index-needs-dt-txt">猜你喜欢</span></a>
								</li>
							</ul>

							<div class="am-tabs-bd">

								<div class="am-tab-panel am-fade am-in am-active">
									<div class="J_Brand">

										<div class="attr-list-hd tm-clear">
											<h4>产品参数:</h4></div>
										<div class="clear"></div>
										<ul id="J_AttrUL">
											<li title="">产品特点:&nbsp;</li>
											<li title="">相关提示:&nbsp;</li>
											<li title="">保养说明:&nbsp;</li>
											<li title="">{{ $data->d_trait }}&nbsp;</li>
											<li title="">{{ $data->d_prompt }}&nbsp;</li>
											<li title="">{{ $data->d_explain }}&nbsp;</li>
										</ul>
										<div class="clear"></div>
									</div>

									<div class="details">
										<div class="attr-list-hd after-market-hd">
											<h4>商品细节</h4>
										</div>
										<div class="twlistNews">
                                            @foreach ($image as $v)																	
												<img src="/uploads/goods/{{ $v }}" />
											@endforeach
										</div>
									</div>
									<div class="clear"></div>
								</div>
								<div class="am-tab-panel am-fade">
									
                                    <div class="actor-new">
                                    	<div class="rate">                
                                    		<strong>{{ $count['num'] }}<span></span></strong><br> <span>好评度</span>            
                                    	</div>
                                        
                                    </div>	
                                    <div class="clear"></div>
									<div class="tb-r-filter-bar">
										<ul class=" tb-taglist am-avg-sm-4">
											<li class="tb-taglist-li tb-taglist-li-current">
												<div class="comment-info">
													<span>全部评价</span>
													<span class="tb-tbcr-num">( {{ $count['qcount'] }} )</span>
												</div>
											</li>
2
											<li class="tb-taglist-li tb-taglist-li-1">
												<div class="comment-info">
													<span>好评</span>
													<span class="tb-tbcr-num">( {{ $count['gcount'] }} )</span>
												</div>
											</li>

											<li class="tb-taglist-li tb-taglist-li-0">
												<div class="comment-info">
													<span>中评</span>
													<span class="tb-tbcr-num">( {{ $count['mcount'] }} )</span>
												</div>
											</li>

											<li class="tb-taglist-li tb-taglist-li--1">
												<div class="comment-info">
													<span>差评</span>
													<span class="tb-tbcr-num">( {{ $count['lcount'] }} )</span>
												</div>
											</li>
										</ul>
									</div>
									<div class="clear"></div>

									<ul class="am-comments-list am-comments-list-flip">
									@foreach($comment as $v)
										<li class="am-comment">
											<!-- 评论容器 -->
											<a href="">
												<img class="am-comment-avatar" src="/uploads/{{ $v->userinfo->pic }}" />
												<!-- 评论者头像 -->
											</a>

											<div class="am-comment-main">
												<!-- 评论内容容器 -->
												<header class="am-comment-hd">
													<!--<h3 class="am-comment-title">评论标题</h3>-->
													<div class="am-comment-meta">
														<!-- 评论元数据 -->
														<a href="#link-to-user" class="am-comment-author">{{ $v->userinfo->name }}</a>
														<!-- 评论者 -->
														评论于
														<time datetime="">{{ $v->created_at }}</time>
													</div>
												</header>

												<div class="am-comment-bd">
													<div class="tb-rev-item " data-id="255776406962">
														<div class="J_TbcRate_ReviewContent tb-tbcr-content ">
															{{ $v->c_content }}
														</div>
														<div class="tb-r-act-bar">
															<!-- 颜色分类：柠檬黄&nbsp;&nbsp;尺寸1500L -->
															@if($v->comment_imgs)
															@foreach($v->comment_imgs as $img)
															<img src="/uploads/comments/{{ $img }}" width="20%" height="30%" alt="">
															@endforeach
															@endif
														</div>
													</div>

												</div>
												<!-- 评论内容 -->
											</div>
											
										</li>
									@endforeach
									</ul>

									<div class="clear"></div>

									<!--分页 -->
									{{ $comment->links() }}

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
									<div class="clear"></div>

									<div class="tb-reviewsft">
										<div class="tb-rate-alert type-attention">购买前请查看该商品的 <a href="#" target="_blank">购物保障</a>，明确您的售后保障权益。</div>
									</div>

								</div>

								<div class="am-tab-panel am-fade">
									<div class="like">
										<ul class="am-avg-sm-2 am-avg-md-3 am-avg-lg-4 boxes">
											@foreach($lgoods as $v)
											<li>
												<div class="i-pic limit">
													<img src="/uploads/goods/{{ $v->img }}" />
													<p>{{ $v->g_name }}</p>
													<p class="price fl">
														<b>¥</b>
														<strong>{{ $v->g_nprice }}</strong>
													</p>
												</div>
											</li>
											@endforeach
										</ul>
									</div>
									<div class="clear"></div>

									<!--分页 -->
									{{ $lgoods->links() }}

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
									<div class="clear"></div>

								</div>

							</div>

						</div>

						<div class="clear"></div>

						@extends('home.layouts.footer')

@section('content')

@endsection
	<script>
		
		function shopping(id){
			var price = $('.sys_item_price').html() ;
			var color = $('.sku-line.selected').html();
			var size = $('#size').html();
			var number = $('#text_box').val();
			var img=$('.jqzoom')[0].src;
			console.log(img);
			$.ajax({
				type:'POST',
				url:'/home/shopping',
				data:{'price':price,'color':color,'size':size,'number':number,'img':img,'_token':'{{csrf_token()}}'},
				success:function(data){
					console.log(data);
				},
				error:function(data){
					console.log(data);
				}
			})
			
		}

		function charts(id){
			var price = $('.sys_item_price').html() ;
			var color = $('.sku-line.selected').html();
			var size = $('#size').html();
			var number = $('#text_box').val();
			var img=$('.jqzoom')[0].src;
			// console.log(img);
			$.ajax({
				type:'POST',
				url:'/home/carts/cart',
				data:{'price':price,'color':color,'size':size,'number':number,'img':img,'_token':'{{csrf_token()}}'},
				success:function(data){
					console.log(data);
				},
				error:function(data){
					console.log(data);
				}
			})
		}
	</script>

</html>
