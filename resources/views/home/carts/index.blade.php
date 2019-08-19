<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

		<title>购物车页面</title>

		<link href="AmazeUI-2.4.2/assets/css/amazeui.css" rel="stylesheet" type="text/css" />
		<link href="basic/css/demo.css" rel="stylesheet" type="text/css" />
		<link href="css/cartstyle.css" rel="stylesheet" type="text/css" />
		<link href="css/optstyle.css" rel="stylesheet" type="text/css" />

		<script type="text/javascript" src="js/jquery.js"></script>

		{{-- <script type="text/javascript" src="js/jquery.js"></script> --}}

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

			<!--购物车 -->
			<div class="concent">
				<div id="cartTable">
					<div class="cart-table-th">
						<div class="wp">
							<div class="th th-chk">
								<div id="J_SelectAll1" class="select-all J_SelectAll">

								</div>
							</div>
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
							<div class="th th-op">
								<div class="td-inner">操作</div>
							</div>
						</div>
					</div>
					<div class="clear"></div>

					<tr class="item-list">
							<div class="bundle  bundle-last ">
							  
							  <div class="clear"></div>
							  <div class="bundle-main">
								<form action='/home/comfirmpay' method='post'>
									{{ csrf_field() }}
								@foreach($carts as $cart)
								
								 <ul class="item-content clearfix">
								  <li class="td td-chk">
									<div class="cart-checkbox ">
										{{-- 传输了 商品id和商品的数量 --}}
									  <input class="check" id="J_CheckBox_170037950254"  name="items[]"  value="{{ $cart->id }}-{{ $cart->c_num }}" type="checkbox">
									  <label for="J_CheckBox_170037950254"></label>
									</div>
								
								  </li>
								  <li class="td td-item">
									<div class="item-pic">
									 
									  <a href="#" target="_blank" data-title=" {{ $cart->g_name }} " class="J_MakePoint" data-point="tbcart.8.12">
										<img width='75' src="/uploads/goods/{{ $cart->g_img }}" class="itempic J_ItemImg"></a>
									</div>
									<div class="item-info">
									  <div class="item-basic-info">
										<a href="#" target="_blank" title="{{ $cart->g_name }}" class="item-title J_MakePoint" data-point="tbcart.8.11">{{ $cart->g_name }}</a></div>
									</div>
								  </li>
								  <li class="td td-info">
									<div class="item-props item-props-can">
									  <span class="sku-line">颜色：{{ $cart->c_color }}</span>
									  <br/>
									  <br/>
									  <span class="sku-line">尺寸：{{ $cart->g_size }}</span>
									  
									  <i class="theme-login am-icon-sort-desc"></i>
									</div>
								  </li>
								  <li class="td td-price">
									<div class="item-price price-promo-promo">
									  <div class="price-content">
										<div class="price-line">
										  <em class="price-original">{{ $cart->g_oprice }}</em></div>
										<div class="price-line">
										  <em class="J_Price price-now" tabindex="0">{{ $cart->g_nprice }}</em>
										</div>
									  </div>
									</div>
								  </li>
								  <li class="td td-amount">
									<div class="amount-wrapper ">
									  <div class="item-amount ">
										<div class="sl">
										 
										  <input class='text_box' name="" min='1' max='100' type="number" value="{{ $cart->c_num }}" style="width:50px;" />
									  </div>
									</div>
								  </li>
								  <li class="td td-sum">
									<div class="td-inner">
									  <em tabindex="0" class="J_ItemSum number">{{ $cart->g_nprice * $cart->c_num  }}</em></div>
								  </li>
								  <li class="td td-op">
									<div class="td-inner">
									  <a title="移入收藏夹" class="btn-fav" href="/home/updatecollect/{{$cart->id }}">移入收藏夹</a>
									<a href="/home/chardelete/{{$cart->gid}}" data-point-url="#" class="delete">删除</a></div>
								  </li>
								 </ul>
								@endforeach
							
							  </div>
							</div>
						  </tr>
					<div class="clear"></div>

					
				</div>
				<div class="clear"></div>

				<div class="float-bar-wrapper">
					<div id="J_SelectAll2" class="select-all J_SelectAll">
						<div class="cart-checkbox">
						
							<input id="selectAll" class="check-all" id="J_SelectAllCbx2" name="select-all" value="true" type="checkbox">
							<label for="J_SelectAllCbx2"></label>
						</div>
						<span>全选</span>
					</div>
					
					<div class="float-bar-right">
						
						<div class="price-sum">
							<span class="txt">合计:</span>
							<strong class="price">¥<em id="J_Total">0.00</em></strong>
							@if($errors->has('no'))
								<strong class="price"><em>至少选择一个商品</em></strong>
							@endif
							@if($errors->has('repay'))
								<strong class="price"><em>请选择 物流方式 支付方式后重新下单</em></strong>
							@endif
							@if($errors->has('nopaypwd'))
								<strong class="price"><em>请输入密码后重新下单</em></strong>
							@endif
							
							
						</div>
						{{-- 隐藏域传输总价 --}}
						<input type="hidden" name='total' id='total' value=''>
						<button class="btn-area">
							<a href="pay.html" id="J_Go" class="submit-btn submit-btn-disabled" aria-label="请注意如果没有选择宝贝，将无法结算">
								<span>结&nbsp;算</span></a>
						</button>
					</div>

				</div>
			</form>
				<div class="footer">
					<div class="footer-hd">
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
							<em>© 2015-2025 Hengwang.com 版权所有</em>
						</p>
					</div>
				</div>

			</div>

			<!--操作页面-->

			<div class="theme-popover-mask"></div>

		<!--引导 -->
		<div class="navCir">
			<li><a href="home.html"><i class="am-icon-home "></i>首页</a></li>
			<li><a href="sort.html"><i class="am-icon-list"></i>分类</a></li>
			<li class="active"><a href="shopcart.html"><i class="am-icon-shopping-basket"></i>购物车</a></li>	
			<li><a href="person/index.html"><i class="am-icon-user"></i>我的</a></li>					
		</div>
		<script>
		  //  购物车
          $(function(){
			  //  购物车的每一个商品的数量
			  $('.text_box').each(function(){
				//   商品的数量
				var cart_num=$(this).val();
			
				//  每一个商品的价格
				var price=$(this).parent().parent().parent().parent().prev().children().children().children(1).children()[1].innerText;
				
				// 计算到小计
				var sum=cart_num*price;
				
                $(this).parent().parent().parent().parent().next().children().children().text(sum);
				totalPrice();
				
			  });
				// 当数量改变的时候价格改变
			
				$('.text_box').change(function(){
				
					$('.text_box').each(function(){
					//   商品的数量
					var cart_num=$(this).val();
					// console.log(cart_num);
					if(cart_num <=0){
						
					$(this).val(1);
					cart_num=1;
					}

					console.log(cart_num);

					//  每一个商品的价格
					var price=$(this).parent().parent().parent().parent().prev().children().children().children(1).children()[1].innerText;
					
					// 计算到小计
					var sum=cart_num*price;
					
					$(this).parent().parent().parent().parent().next().children().children().text(sum);
					
			  	});
			  	totalPrice();
			});

		
				
			// 全选
			$('#selectAll').click(function(){

				if($(this).attr('checked')){
	
					$('.check').attr('checked','checked');
				}else{
					$('.check').removeAttr('checked');
				}
				totalPrice();
			});

			$('.check').click(function(){
				if($(this).attr('checked')){
					totalPrice();
				}else{
					totalPrice();
				}

				
			});

			//计算总价
			function totalPrice(){
		        //计算总金额
		        var total=0;
		        $('.J_ItemSum').each(function(){
			  
				 if($(this).parent().parent().parent().children(0).children().children().attr('checked')){
				    
				   total+=parseFloat($(this).text());
			     }
		        });
		        //写入总金额
				$('#J_Total').text(total);
				$('#total').val(total);
	        }

		  })
		</script>
	</body>

</html>