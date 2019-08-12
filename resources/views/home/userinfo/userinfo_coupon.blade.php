@extends('home.layouts.userinfo')
<link href="/home/css/personal.css" rel="stylesheet" type="text/css">
<link href="/home/css/cpstyle.css" rel="stylesheet" type="text/css">
@section('content')
<div class="main-wrap">
	<div class="user-coupon">
		<!--标题 -->
		<div class="am-cf am-padding">
			<div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">优惠券</strong> / <small>Coupon</small></div>
		</div>
		<hr/>

		<div class="am-tabs-d2 am-tabs  am-margin" data-am-tabs>

			<ul class="am-avg-sm-2 am-tabs-nav am-nav am-nav-tabs">
				<li class="am-active"><a href="#tab1">可用优惠券</a></li>
				<li><a href="#tab2">已用/过期优惠券</a></li>

			</ul>

			<div class="am-tabs-bd">
				<div class="am-tab-panel am-fade am-in am-active" id="tab1">
					@foreach($coupons as $coupon)
					@if($coupon->c_status==1)
						<div class="coupon-items">
							<div class="coupon-item coupon-item-d">
								<div class="coupon-list">
									<div class="c-type">
										<div class="c-class">
											<strong>购物券</strong>
										</div>
										<div class="c-price">
											<strong>￥{{ $coupon->c_money }}</strong>
										</div>
										<div class="c-limit">
											【全场通用】
										</div>
										<div class="c-time"><span>使用期限</span>{{ $coupon->c_time }}</div>
										<div class="c-type-top"></div>

										<div class="c-type-bottom"></div>
									</div>

									<div class="c-msg">
										
										<div class="op-btns">
											<a href="/home/userinfo/usecoupons/{{ $coupon->id }}" class="btn"><span class="txt">立即使用</span><b></b></a>
										</div>
									</div>
								</div>
							</div>
							
						</div>
					@endif
					@endforeach
				</div>
				<div class="am-tab-panel am-fade" id="tab2">
					@foreach($coupons as $coupon)
					@if($coupon->c_status==2)
						<div class="coupon-items">
							<div class="coupon-item coupon-item-d">
								<div class="coupon-list">
									<div class="c-type">
										<div class="c-class">
											<strong>购物券</strong>
											<span class="am-icon-trash"></span>
										</div>
										<div class="c-price">
											<strong>￥{{ $coupon->c_money }}</strong>
										</div>
										<div class="c-limit">
											【全场通用】
										</div>
										<div class="c-time"><span>使用期限</span>{{ $coupon->c_time }}</div>
										<div class="c-type-top"></div>

										<div class="c-type-bottom"></div>
									</div>

									<div class="c-msg">
										
										<div class="op-btns c-del">
											<a href="/home/userinfo/delcoupons/{{ $coupon->id }}" class="btn"><span class="txt">删除</span><b></b></a>
										</div>
									</div>
									
									<li class="td td-usestatus ">
										<div class="item-usestatus ">
											<span><img src="images/gift_stamp_31.png"</span>
										</div>
									</li>												
								</div>
							</div>
						
						</div>
					@endif
					@endforeach
				</div>
			</div>

		</div>

	</div>
</div>
@endsection