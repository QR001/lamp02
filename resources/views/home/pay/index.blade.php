<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0 ,minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

		<title>结算页面</title>

		<link href="AmazeUI-2.4.2/assets/css/amazeui.css" rel="stylesheet" type="text/css" />

		<link href="basic/css/demo.css" rel="stylesheet" type="text/css" />
		<link href="css/cartstyle.css" rel="stylesheet" type="text/css" />

		<link href="css/jsstyle.css" rel="stylesheet" type="text/css" />

		<script type="text/javascript" src="js/address.js"></script>

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
				<div class="logo"><img src="images/logo.png" /></div>
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
			<div class="concent">
				<form action='/home/comfirepay' method='post'>
					
					{{ csrf_field() }}
						<!--地址 -->
						<div class="paycont">
						<div class="address">
							<h3>确认收货地址--双击对收货地址进行选择 </h3>
							<div class="control">
								<div class="tc-btn createAddr theme-login am-btn am-btn-danger"><a href='/home/userinfo_address'>新增地址</a></div>
							</div>
							<div class="clear"></div>
							<ul>
								<div class="per-border"></div>
								@foreach($locations as $location)
								@if($location->l_status == '1')
									<li class="user-addresslist defaultAddr" addrid='{{ $location->id }}'>

										<div class="address-left">
											<div class="user DefaultAddr">

												<span class="buy-address-detail">   
													<span class="buy-user">{{ $location->l_name }}</span>
													<span class="buy-phone">{{ $location->l_phone }}</span>
												</span>
											</div>
											
											
											<div class="default-address">
												<span class="buy-line-title buy-line-title-type">收货地址：</span>
												<span class="buy--address-detail">
													{{ $location->l_address }}
													
												</span>

												</span>
											</div>
											
										</div>
										<div class="address-right">
											<a href="person/address.html">
												<span class="am-icon-angle-right am-icon-lg"></span></a>
										</div>
										<div class="clear"></div>


									</li>
								@else
									<li class="user-addresslist" addrid='{{ $location->id }}'>

										<div class="address-left">
											<div class="user DefaultAddr" >

												<span class="buy-address-detail">   
													<span class="buy-user">{{ $location->l_name }} </span>
													<span class="buy-phone">{{ $location->l_phone }}</span>
												</span>
											</div>
											
											
												<div class="default-address">
													<span class="buy-line-title buy-line-title-type">收货地址：</span>
													<span class="buy--address-detail">
														{{ $location->l_address }}
														
													</span>

													</span>
												</div>
											
										</div>
										<div class="address-right">
											<a href="person/address.html">
												<span class="am-icon-angle-right am-icon-lg"></span></a>
										</div>
										<div class="clear"></div>


									</li>
								@endif
									<div class="per-border"></div>
								@endforeach

							</ul>

							<div class="clear"></div>
						</div>
						{{-- 隐藏域传地址 --}}
						<input type="hidden" name='address' id='address' value=''>
						<!--物流 -->
						<div class="logistics">
							<h3>选择物流方式--双击对物流进行选择</h3>
							<ul class="op_express_delivery_hot">
								@foreach ($wulius as $wuliu)
									<li data-value="shentong" class="OP_LOG_BTN" expressmethods='{{ $wuliu->id }}'><img src='/uploads/{{ $wuliu->s_img }}' style="width:100px">{{ $wuliu->s_express }}<span></span></li>
								@endforeach
								
							</ul>
						</div>
						{{-- 隐藏域传物流方式 --}}
						<input type="hidden" name='expressmethods' id='expressmethods' value=''>

						<div class="clear"></div>

						<!--支付方式-->
						<div class="logistics">
							<h3>选择支付方式--双击对支付方式进行选择</h3>
							<ul class="pay-list">
								@foreach ($express as $res)
									<li class="pay" paymethods="{{ $res->id }}" ><img src="/uploads/pay/{{ $res->p_img }}" />{{ $res->p_method }}<span></span></li>
								@endforeach
								
							</ul>
						</div>
						<div class="clear"></div>
						{{-- 隐藏域传 支付方式 --}}
						
						<input type="hidden" name='paymethods' id='paymethods' value=''>
						<!--订单 -->
						<div class="concent">
							<div id="payTable">
								<h3>确认订单信息</h3>
								<div class="cart-table-th">
									<div class="wp">

										<div class="th th-item">
											<div class="td-inner">商品信息</div>
										</div>
										<div class="th th-price">
											<div class="td-inner">单价</div>
										</div>
										<div class="th th-amount">
											<div class="td-inner">数量</div>
										</div>
										<div class="th th-sum">
											<div class="td-inner">金额</div>
										</div>
										
									</div>
								</div>
								<div class="clear"></div>
								@foreach ($goods as $k=>$good)
								
									{{-- 商品的id-数量-颜色  --}}
									<input type="hidden" name="goodid[]" value='{{ $good->gid }}-{{ $good->buynum }}-{{ $good->c_color }}'>
								
									<tr class="item-list">
										<div class="bundle  bundle-last">
		
											<div class="bundle-main">
												<ul class="item-content clearfix">
													<div class="pay-phone">
														<li class="td td-item">
															<div class="item-pic">
																<a href="#" class="J_MakePoint">
																	<img width='80' src="/uploads/goods/{{ $good->g_img }}" class="itempic J_ItemImg"></a>
															</div>
															<div class="item-info">
																<div class="item-basic-info">
																	<a href="#" class="item-title J_MakePoint" data-point="tbcart.8.11">{{ $good->g_name }}</a>
																</div>
															</div>
														</li>
														<li class="td td-info">
															<div class="item-props">
																<span class="sku-line">颜色：{{ $good->c_color }}</span>
																<span class="sku-line">尺寸：{{ $good->g_size }}</span>
															</div>
														</li>
														<li class="td td-price">
															<div class="item-price price-promo-promo">
																<div class="price-content">
																	<em class="J_Price price-now">{{ $good->g_nprice }}</em>
																</div>
															</div>
														</li>
													</div>
													<li class="td td-amount">
														<div class="amount-wrapper ">
															<div class="item-amount ">
																<span class="phone-title">购买数量</span>
																<div class="sl">
																	
																	<input class="text_box" disabled name="" type="text" value="{{ $good->buynum }}" style="width:30px;" />
																	
																</div>
															</div>
														</div>
													</li>
													<li class="td td-sum">
														<div class="td-inner">
															<em tabindex="0" class="J_ItemSum">{{ $good->g_nprice * $good->buynum }}</em>
														</div>
													</li>
												
		
												</ul>
												<div class="clear"></div>
		
											</div>
									</tr>
									<div class="clear"></div>
									</div>
								@endforeach
								
								</div>
								<div class="clear"></div>
								<div class="pay-total">
							<!--留言-->
							<div class="order-extra">
								<div class="order-user-info">
									<div id="holyshit257" class="memo">
										<label>买家留言：</label>
										<input type="text"  disabled title="对本次交易的说明（建议填写已经和卖家达成一致的说明）" placeholder="选填,建议填写和卖家达成一致的说明,请和客服聊具体的细节" class="memo-input J_MakePoint c2c-text-default memo-close">
										<div class="msg hidden J-msg">
											<p class="error">最多输入500个字符</p>
										</div>
									</div>
								</div>

							</div>
							<!--优惠券 -->
							<div class="buy-agio">
								<li class="td td-coupon">

									<span class="coupon-title">优惠券</span>
									<select data-am-selected name='coupon'>
											<option>
												<div>
													<strong>请选择</strong>
												</div>
												<div class="c-limit">
													
												</div>
											</option>
										@foreach ($coupon as $c)
											<option value="{{ $c->id }}">
												<div class="c-price">
													<strong>￥{{ $c->c_money }}</strong>
												</div>
												<div class="c-limit">
													【通用】
												</div>
											</option>
										@endforeach
										
									</select>
								</li>

								

							</div>
							<div class="clear"></div>
							</div>
							<!--含运费小计 -->
							<div class="buy-point-discharge ">
								<p class="price g_price ">
									合计（含运费） <span>¥</span><em class="pay-sum">包邮</em>
								</p>
							</div>
							<div class="order-go clearfix">
								<div class="pay-confirm clearfix">
									<div class="box">
										<div tabindex="0" id="holyshit267" class="realPay"><em class="t">应付款：</em>
											<span class="price g_price ">
											<span>¥</span> <em class="style-large-bold-red " id="J_ActualFee">{{ $total }}</em>
											<input type="hidden" name='total' value='{{ $total }}'>
										
										</span>
										</div>

									</div>
									<br/>
									<br/>
									<br/>
									<br/>
									<div class="box">
											<div tabindex="0" id="holyshit267" class="realPay"><em class="t">支付密码:</em>
												<input type="password" name='paypwd' placeholder="请输入支付密码">
											</span>
											</div>
	
										</div>

									<div id="holyshit269" class="submitOrder">
										<div class="go-btn-wrap">
											<a><button id="J_Go" href="#" class="btn-go" tabindex="0" title="点击此按钮，提交订单">提交订单</button></a>
										</div>
									</div>
									<div class="clear"></div>
								</div>
							</div>	
						</div>

							<div class="clear"></div>
						</div>
					</div>
					
				</form>
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
			

			<div class="clear"></div>
	</body>

	<script>
		
		// 收货地址
		$('.user-addresslist').click(function(){
			
			
			if($(this).attr('class')=='user-addresslist defaultAddr'){
				
				$('#address').val($(this).attr('addrid'));
			}
			
		});

		// 支付方式

		$('.OP_LOG_BTN').click(function(){
			if($(this).attr('class')=='OP_LOG_BTN selected'){
				
				$('#expressmethods').val($(this).attr('expressmethods'));
			}
		});

		// 物流方式方式

		$('.pay').click(function(){
			
			if($(this).attr('class')=='pay selected'){
				
				$('#paymethods').val($(this).attr('paymethods'));
			}
		});


		//计算总价
		// var total=0;
		// $('.J_ItemSum').each(function(){
			// console.log($('.J_ItemSum').text());
			// var price=parseInt($('.J_ItemSum').text());
			// console.log(typeof(price));
			// console.log(typeof(total));
			// total=total+price;

			// console.log(total);

		// })
		// var price=parseInt($('.J_ItemSum').text());
		// 	console.log(price);
		// var length=$('.J_ItemSum').length;
		// console.log(length);
		// for(var i=0; i<=length; i++){
		// 	var price=parseInt($('.J_ItemSum').text());
		// 	total+=price;
		// 	// console.log(price);
		// 	// console.log(i);
		// }
		// console.log(total);
		// console.log($('.coupons'));
		// $('.usercoupon').click(function(){
		// 	alert(11);
		// })
	</script>
</html>

