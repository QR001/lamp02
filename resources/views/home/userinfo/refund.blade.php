<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=0">

		<title>退换货</title>

		<link href="/home/AmazeUI-2.4.2/assets/css/admin.css" rel="stylesheet" type="text/css">
		<link href="/home/AmazeUI-2.4.2/assets/css/amazeui.css" rel="stylesheet" type="text/css">

		<link href="/home/css/personal.css" rel="stylesheet" type="text/css">
		<link href="/home/css/refstyle.css" rel="stylesheet" type="text/css">

		<script src="/home/AmazeUI-2.4.2/assets/js/jquery.min.js" type="text/javascript"></script>
		<script src="/home/AmazeUI-2.4.2/assets/js/amazeui.js" type="text/javascript"></script> 

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
		<div class="center">
			<div class="col-main">
				<div class="main-wrap">
					<!--标题 -->
					<div class="am-cf am-padding">
						<div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">退换货申请</strong> / <small>Apply&nbsp;for&nbsp;returns</small></div>
					</div>
					<hr/>
					<div class="comment-list">
					<!--进度条-->
					<div class="m-progress">
						<div class="m-progress-list">
							<span class="step-1 step">
                                <em class="u-progress-stage-bg"></em>
                                <i class="u-stage-icon-inner">1<em class="bg"></em></i>
                                <p class="stage-name">买家申请退款</p>
                            </span>
							<span class="step-2 step">
                                <em class="u-progress-stage-bg"></em>
                                <i class="u-stage-icon-inner">2<em class="bg"></em></i>
                                <p class="stage-name">商家处理退款申请</p>
                            </span>
							<span class="step-3 step">
                                <em class="u-progress-stage-bg"></em>
                                <i class="u-stage-icon-inner">3<em class="bg"></em></i>
                                <p class="stage-name">款项成功退回</p>
                            </span>                            
							<span class="u-progress-placeholder"></span>
						</div>
						<div class="u-progress-bar total-steps-2">
							<div class="u-progress-bar-inner"></div>
						</div>
					</div>
                 
                   
                    @foreach ($order as $k=>$v)
                    <div class="refund-aside">
							<div class="item-pic">
								<a href="#" class="J_MakePoint">
									<img src="/uploads/goods/{{ $img[0] }}" class="itempic">
								</a>
							</div>

							<div class="item-title">

								<div class="item-name">
									<a href="#">
										<p class="item-basic-info">{{ $v['good']['g_name'] }}</p>
									</a>
								</div>
								<div class="info-little">
									<span>颜色：{{  $v['good']['g_color'] }}</span>
								
								</div>
							</div>
							<div class="item-info">
								<div class="item-ordernumber">
									<span class="info-title">订单编号：</span><a>{{  $v['order']['o_no'] }}</a>
								</div>
								<div class="item-price">
									<span class="info-title">价&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;格：</span><span class="price">{{  $v['good']['g_nprice'] }}元</span>
									<span class="number">×{{ $num }}</span><span class="item-title">(数量)</span>
								</div>
								<div class="item-amount">
									<span class="info-title">小&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;计：</span><span class="amount">{{  $v['good']['g_nprice'] * $num }}元</span>
								</div>
								
								<div class="item-amountall">
									<span class="info-title">总&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;计：</span><span class="amountall">{{ $v['good']['g_nprice'] * $num }}元</span>
								</div>
								<div class="item-time">
									<span class="info-title">成交时间：</span><span class="time">{{ $v->created_at }}</span>
								</div>

							</div>
							<div class="clear"></div>
						</div>
                    @endforeach
					
                    <form action="/home/refundstore" method="post" enctype='multipart/form-data'>
                        {{csrf_field()}}
						<div class="refund-main">
							<div class="item-comment">
							
								<div class="am-form-group">
									<label for="refund-reason" class="am-form-label">退款原因</label>
									<div class="am-form-content">
										<select name="r_cause" data-am-selected="">
											<option value="1" selected>请选择退款原因</option>
											<option value="2">不想要了</option>
											<option value="3">买错了</option>
											<option value="4">没收到货</option>											
											<option value="5">与说明不符</option>
										</select>
									</div>
								</div>

								<div class="am-form-group">
									<label for="refund-money" class="am-form-label">退款金额<span>（不可修改）</span></label>
									<div class="am-form-content">
										<input type="text" name="payments" id="refund-money" readonly="readonly" placeholder="{{  $v['good']['g_nprice'] * $num }}" value="{{  $v['good']['g_nprice'] * $num }}">
									</div>
								</div>
								<div class="am-form-group">
									<label for="refund-info" class="am-form-label">退款说明<span>（可不填）</span></label>
									<div class="am-form-content">
										<textarea name="r_explain" placeholder="请输入退款说明"></textarea>
									</div>
								</div>
                                <input type="hidden" name="r_num" value={{$num}}>
                                <input type="hidden" name="did" value={{$v->oid}}>
                                 <input type="hidden" name="gid" value={{$v->gid}}>
							</div>
							<div class="info-btn">
								<button class="am-btn am-btn-danger">提交申请</button>
							</div>
                        </div>
                    </form>
					</div>
					<div class="clear"></div>
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
					<li class="person active">
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

				</ul>

			</aside>
		</div>

	</body>

</html>