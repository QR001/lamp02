
@extends('home.layouts.userinfo')
@section('content')
<link href="/home/css/personal.css" rel="stylesheet" type="text/css">
<link href="/home/css/orstyle.css" rel="stylesheet" type="text/css">

<div class="main-wrap">

		<div class="user-order">

			<!--标题 -->
			<div class="am-cf am-padding">
				<div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">订单管理</strong> / <small>Order</small></div>
			</div>
			<hr/>

			<div class="am-tabs am-tabs-d2 am-margin" data-am-tabs>

				<ul class="am-avg-sm-5 am-tabs-nav am-nav am-nav-tabs">
					<li class="am-active"><a href="#tab1">所有订单</a></li>
					<li><a href="#tab2">待付款</a></li>
					<li><a href="#tab3">待发货</a></li>
					<li><a href="#tab4">待收货</a></li>
					<li><a href="#tab5">待评价</a></li>
				</ul>

				<div class="am-tabs-bd">
					<div class="am-tab-panel am-fade am-in am-active" id="tab1">
						<div class="order-top">
							<div class="th th-item">
								<td class="td-inner">商品</td>
							</div>
							<div class="th th-price">
								<td class="td-inner">单价</td>
							</div>
							<div class="th th-number">
								<td class="td-inner">数量</td>
							</div>
							<div class="th th-operation">
								<td class="td-inner">商品操作</td>
							</div>
							<div class="th th-amount">
								<td class="td-inner">合计</td>
							</div>
							<div class="th th-status">
								<td class="td-inner">交易状态</td>
							</div>
							<div class="th th-change">
								<td class="td-inner">交易操作</td>
							</div>
						</div>
						
						@foreach($order as $order)
						{{-- {{ dump($order) }} --}}
							<div class="order-main">
								<div class="order-list">
									<!--交易成功-->
									<div class="order-status5">
										<div class="order-title">
											<div class="dd-num">订单编号：<a href="javascript:;">{{ $order->o_no }}</a></div>
											<span>成交时间：{{ $order->created_at }}</span>
											<!--    <em>店铺：小桔灯</em>-->
										</div>
										
										@foreach($orders as $v)
										{{-- {{ dump($v) }} --}}
										<div class="order-content">
											<div class="order-left">
												<ul class="item-list">
													<li class="td td-item">
														<div class="item-pic">
															<a href="#" class="J_MakePoint">
															
																<img src="/uploads/goods/{{ $imgs[0] }}" class="itempic J_ItemImg">
															</a>
														</div>
														<div class="item-info">
															<div class="item-basic-info">
																<a href="#">
																	<p>{{ $v->g_name }}</p>
																	<p class="info-little">颜色：{{ $v['good']['g_color'] }}
																		<br/>尺寸(长X宽X高):{{ $v['good']['g_size'] }}</p>
																</a>
															</div>
														</div>
													</li>
													<li class="td td-price">
														<div class="item-price">
															{{ $v['good']['g_nprice'] }}
														</div>
													</li>
													<li class="td td-number">
														<div class="item-number">
															<span>×</span>{{ $v->d_num }}
															
														</div>
													</li>


													<li class="td td-operation">
														<div class="item-operation">
															<a href="/home/refund/{{ $v->oid }}/{{ $v->gid }}/{{ $v->d_num }}">退款</a>
														</div>
													</li>
												</ul>

												
											</div>
											<div class="order-right">
												<li class="td td-amount">
													<div class="item-amount">
														合计：{{ $order->o_amount }}
													</div>
												</li>
												<div class="move-right">
													@if($order->o_status ==1)
														<li class="td td-status">
															<div class="item-status">
																<p class="Mystatus">待付款</p>
																
															</div>
														</li>
													@endif
													@if($order->o_status ==2)
														<li class="td td-status">
															<div class="item-status">
																<p class="Mystatus">待发货</p>
																
															</div>
														</li>
													@endif
													@if($order->o_status ==3)
														<li class="td td-status">
															<div class="item-status">
																<p class="Mystatus">已发货</p>
																
															</div>
														</li>
													@endif
													@if($order->o_status ==4)
														<li class="td td-status">
															<div class="item-status">
																<p class="Mystatus">已收到货--待评价</p>
																<p class="order-info"><a href="orderinfo.html">订单详情</a></p>
																<p class="order-info"><a href="logistics.html">查看物流</a></p>
															</div>
														</li>
													@endif
													@if($order->o_status ==5)
														<li class="td td-status">
															<div class="item-status">
																<p class="Mystatus">已评价</p>
																<p class="order-info"><a href="orderinfo.html">订单详情</a></p>
																<p class="order-info"><a href="logistics.html">查看物流</a></p>
															</div>
														</li>
													@endif
													@if($order->o_status ==5)
														<li class="td td-change">
															<div class="am-btn am-btn-danger anniu">
																删除订单
															</div>
														</li>
													@endif
												</div>
											</div>
										</div>
										@endforeach
									</div>

								

								</div>

							</div>
						@endforeach
					</div>
				
				</div>

			</div>
		</div>
	</div>

@endsection