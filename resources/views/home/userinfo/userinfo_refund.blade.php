@extends('home.layouts.userinfo')
<link href="/home/css/personal.css" rel="stylesheet" type="text/css">
<link href="/home/css/orstyle.css" rel="stylesheet" type="text/css">
@section('content')
<div class="main-wrap">

		<div class="user-order">

			<!--标题 -->
			<div class="am-cf am-padding">
				<div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">退换货管理</strong> / <small>Change</small></div>
			</div>
			<hr/>

			<div class="am-tabs am-tabs-d2 am-margin" data-am-tabs>

				<ul class="am-avg-sm-2 am-tabs-nav am-nav am-nav-tabs">
					<li class="am-active"><a href="#tab1">退款管理</a></li>
				
				</ul>

				<div class="am-tabs-bd">
					<div class="am-tab-panel am-fade am-in am-active" id="tab1">
						<div class="order-top">
							<div class="th th-item">
								<td class="td-inner">商品</td>
							</div>
							<div class="th th-orderprice th-price">
								<td class="td-inner">交易金额</td>
							</div>
							<div class="th th-changeprice th-price">
								<td class="td-inner">退款金额</td>
							</div>
							<div class="th th-status th-moneystatus">
								<td class="td-inner">交易状态</td>
							</div>
							<div class="th th-change th-changebuttom">
								<td class="td-inner">退款编号</td>
							</div>
						</div>
						
						@foreach($datas as $k=>$v)
							<div class="order-main">
								<div class="order-list">
									<div class="order-title">
										
									</div>
									<div class="order-content">
										<div class="order-left">
											<ul class="item-list">
												<li class="td td-item">
													<div class="item-pic">
														<a href="#" class="J_MakePoint">
															<img src="/uploads/goods/{{ $v->good->g_img }}" class="itempic J_ItemImg">
														</a>
													</div>
													<div class="item-info">
														<div class="item-basic-info">
															<a href="#">
																<p>{{ $v->good->g_name }}</p>
																<p class="info-little">颜色：{{ $v->d_color }}
															</a>
														</div>
													</div>
												</li>

												<ul class="td-changeorder">
													<li class="td td-orderprice">
														<div class="item-orderprice">
															<span>交易金额：</span>{{ $v->r_payments }}
														</div>
													</li>
													<li class="td td-changeprice">
														<div class="item-changeprice">
															<span>退款金额：</span>{{ $v->r_payments }}
														</div>
													</li>
												</ul>
												<div class="clear"></div>
											</ul>

											<div class="change move-right">
												<li class="td td-moneystatus td-status">
													<div class="item-status">
														@if($v->d_status == 3)
														<p class="Mystatus">退款成功</p>
														@elseif($v->d_status == 2)
														<p class="Mystatus">退款中</p>
														@endif
													</div>
												</li>
											</div>
											<li class="td td-change td-changebutton">
												<a>{{ $v->r_num }}</a>
												
											</li>

										</div>
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