<link href="/home/css/personal.css" rel="stylesheet" type="text/css">
<link href="/home/css/orstyle.css" rel="stylesheet" type="text/css">

@extends('home.layouts.userinfo')
@section('content')
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
						
							@foreach($Allorders as $order)
								<div class="order-main">
									<div class="order-list">
										<!--交易成功-->
										<div class="order-status5">
											<div class="order-title">
												<div class="dd-num">订单编号：<a href="javascript:;">{{ $order->o_no }}</a></div>
												<span>成交时间：{{ $order->created_at }}</span>
												
											</div>
											<div class="order-content">
												
													<div class="order-left">
														@foreach($order->orderinfo as $k=>$v)
														<ul class="item-list">
															<li class="td td-item">
																<div class="item-pic">
																	<a href="#" class="J_MakePoint">
																		<img src="/uploads/goods/{{ $v->g_img }}" class="itempic J_ItemImg">
																	</a>
																</div>
																<div class="item-info" style="padding-right: 0px;">
																	<div class="item-basic-info">
																		<a href="#">
																			<p>{{ $v->g_name }}</p>
																			<p class="info-little">颜色：{{ $v->d_color }}
																				<br/>尺寸(长X宽X高):{{ $v->g_size }}</p>
																		</a>
																	</div>
																</div>
															</li>
															<li class="td td-price">
																<div class="item-price">
																	{{ $v->g_oprice }}
																</div>
															</li>
															<li class="td td-number">
																<div class="item-number">
																	<span>×</span>{{ $v->d_num }}
																</div>
															</li>


															<li class="td td-operation">
																<div class="item-operation">
																	
																</div>
															</li>
														</ul>
														@endforeach
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
																	
																	</div>
																</li>
															@endif
															@if($order->o_status ==5)
																<li class="td td-status">
																	<div class="item-status">
																		<p class="Mystatus">已评价</p>
																		
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
											
										</div>
										
									

									</div>

								</div>
							@endforeach
							
							{{-- 分页 --}}
							{{ $Allorders->links() }}
							<script>
								var ul=$('.pagination');
								
								ul.attr('class','am-pagination am-pagination-right');
								
							</script>
						
					</div>
					<div class="am-tab-panel am-fade am-in am-active" id="tab2">
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
						
							@if($orders1 !== '')
							
								@foreach($orders1 as $order)
									<div class="order-main">
										<div class="order-list">
										
											<div class="order-status5">
												<div class="order-title">
													<div class="dd-num">订单编号：<a href="javascript:;">{{ $order->o_no }}</a></div>
													<span>成交时间：{{ $order->created_at }}</span>
													
												</div>
												<div class="order-content">
													
													<div class="order-left">
														@foreach($order->orderinfo as $k=>$v)
															<ul class="item-list">
																<li class="td td-item">
																	<div class="item-pic">
																		<a href="#" class="J_MakePoint">
																			<img src="/uploads/goods/{{ $v->g_img }}" class="itempic J_ItemImg">
																		</a>
																	</div>
																	<div class="item-info" style="padding-right: 0px;">
																		<div class="item-basic-info">
																			<a href="#">
																				<p>{{ $v->g_name }}</p>
																				<p class="info-little">颜色：{{ $v->d_color }}
																					<br/>尺寸(长X宽X高):{{ $v->g_size }}</p>
																			</a>
																		</div>
																	</div>
																</li>
																<li class="td td-price">
																	<div class="item-price">
																		{{ $v->g_oprice }}
																	</div>
																</li>
																<li class="td td-number">
																	<div class="item-number">
																		<span>×</span>{{ $v->d_num }}
																	</div>
																</li>
	
	
																<li class="td td-operation">
																	<div class="item-operation">
																		
																	</div>
																</li>
															</ul>
														@endforeach
													</div>
													<div class="order-right">
														<li class="td td-amount">
															<div class="item-amount">
																合计：{{ $order->o_amount }}
															</div>
														</li>
														<div class="move-right">
															
																<li class="td td-status">
																	<div class="item-status">
																		<p class="Mystatus">待付款</p>
																		{{-- 取消订单 --}}
																		<p><a href="/home/userinfo/delorder/{{ $order->id }}" class="Mystatus">取消订单</a></p>
																		
																		
																	</div>
																</li>
															{{-- 一键支付 --}}
															<form action='/home/userinfo_fastpay' method='POST'>
																{{ csrf_field() }}
																{{-- 订单的id --}}
																<input type="hidden" name='id' value='{{ $order->id }}'>
																{{-- 订单的总价 --}}
																<input type="hidden" name='zongji' value='{{ $order->o_amount }}'>
																<li class="td td-change">
																	<button class="am-btn am-btn-danger anniu">
																		一键支付
																	</button>
																</li>
															</form>
															
														</div>
													</div>
														
												</div>	
											
											</div>

										</div>
		
									</div>
								@endforeach
								{{-- 支付密码错误的提示信息 --}}
								@if($errors->has('paypwd'))

									<p style="color:red;">支付密码错误</p>						
								
								@endif
								{{-- 分页 --}}
								{{ $orders1->links() }}
								<script>
									var ul=$('.pagination');
									
									ul.attr('class','am-pagination am-pagination-right');
									
								</script>
							@endif
					</div>
					<div class="am-tab-panel am-fade am-in am-active" id="tab3">
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
							
							@if($orders2 !== '')
								@foreach($orders2 as $order)
									<div class="order-main">
										<div class="order-list">
										
											<div class="order-status5">
												<div class="order-title">
													<div class="dd-num">订单编号：<a href="javascript:;">{{ $order->o_no }}</a></div>
													<span>成交时间：{{ $order->created_at }}</span>
													
												</div>
												<div class="order-content">
													<div class="order-left">
														@foreach($order->orderinfo as $k=>$v)
														
															<ul class="item-list">
																<li class="td td-item">
																	<div class="item-pic">
																		<a href="#" class="J_MakePoint">
																			<img src="/uploads/goods/{{ $v->g_img }}" class="itempic J_ItemImg">
																		</a>
																	</div>
																	<div class="item-info" style="padding-right: 0px;">
																		<div class="item-basic-info">
																			<a href="#">
																				<p>{{ $v->g_name }}</p>
																				<p class="info-little">颜色：{{ $v->d_color }}
																					<br/>尺寸(长X宽X高):{{ $v->g_size }}</p>
																			</a>
																		</div>
																	</div>
																</li>
																<li class="td td-price">
																	<div class="item-price">
																		{{ $v->g_oprice }}
																	</div>
																</li>
																<li class="td td-number">
																	<div class="item-number">
																		<span>×</span>{{ $v->d_num }}
																	</div>
																</li>
	
	
																<li class="td td-operation">
																	<div class="item-operation">
																		@if($v->d_status == 1)
																			<a href='/home/refund/{{$order->id}}/{{$v->gid}}/{{$v->d_num}}'>申请退款</a>
																		@endif
																	</div>
																</li>
															</ul>
														@endforeach
													</div>
													<div class="order-right">
														
														<li class="td td-amount">
															<div class="item-amount">
																合计：{{ $order->o_amount }}
															</div>
														</li>
														<div class="move-right">
															
															
															<li class="td td-status">
																<div class="item-status">
																	<p class="Mystatus">待发货</p>
																	{{-- <p><a href='/home/refund/{{$order->id}}/{gid}/{{$order->d_num}}'>申请退款</a></p> --}}
																</div>
															</li>
															<li class="td td-change">
																<div class="am-btn am-btn-danger anniu">
																	<a class='tixingfahuo'>提醒发货</a>
																</div>
															</li>
															
															
															
														</div>
													</div>
												</div>	
											
											</div>

										</div>
		
									</div>
								@endforeach
								<script>
									// console.log($('#tixingfahuo'));
									$('.tixingfahuo').click(function(){
										alert('提醒成功');
										// console.log('111');
									});
								</script>
								{{-- 分页 --}}
								{{ $orders2->links() }}
								<script>
									var ul=$('.pagination');
									
									ul.attr('class','am-pagination am-pagination-right');
									
								</script>
							@endif
					</div>
					<div class="am-tab-panel am-fade am-in am-active" id="tab4">
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
							
							@if($orders3 !== '')
								@foreach($orders3 as $order)
									<div class="order-main">
										<div class="order-list">
										
											<div class="order-status5">
												<div class="order-title">
													<div class="dd-num">订单编号：<a href="javascript:;">{{ $order->o_no }}</a></div>
													<span>成交时间：{{ $order->created_at }}</span>
													
												</div>
												<div class="order-content">
										
													<div class="order-left">
														@foreach($order->orderinfo as $k=>$v)
															<ul class="item-list">
																<li class="td td-item">
																	<div class="item-pic">
																		<a href="#" class="J_MakePoint">
																			<img src="/uploads/goods/{{ $v->g_img }}" class="itempic J_ItemImg">
																		</a>
																	</div>
																	<div class="item-info" style="padding-right: 0px;">
																		<div class="item-basic-info">
																			<a href="#">
																				<p>{{ $v->g_name }}</p>
																				<p class="info-little">颜色：{{ $v->d_color }}
																					<br/>尺寸(长X宽X高):{{ $v->g_size }}</p>
																			</a>
																		</div>
																	</div>
																</li>
																<li class="td td-price">
																	<div class="item-price">
																		{{ $v->g_oprice }}
																	</div>
																</li>
																<li class="td td-number">
																	<div class="item-number">
																		<span>×</span>{{ $v->d_num }}
																	</div>
																</li>
	
	
																<li class="td td-operation">
																	<div class="item-operation">
																		
																	</div>
																</li>
															</ul>
														@endforeach
													</div>
													<div class="order-right">
														<li class="td td-amount">
															<div class="item-amount">
																合计：{{ $order->o_amount }}
															</div>
														</li>
														<div class="move-right">
															
															<li class="td td-status">
																<div class="item-status">
																	<p class="Mystatus">已发货</p>
																	
																</div>
															</li>
															<li class="td td-change">
																<a href='/home/userinfo/goods/confirm/{{$order->id}}' class="am-btn am-btn-danger anniu">
																	确认收货
																</a>
															</li>
															
														</div>
													</div>
														
												</div>	
											
											</div>

										</div>
		
									</div>
								@endforeach
								{{-- 分页 --}}
								{{ $orders3->links() }}
								<script>
									var ul=$('.pagination');
									
									ul.attr('class','am-pagination am-pagination-right');
									
								</script>
							@endif
					</div>
					<div class="am-tab-panel am-fade am-in am-active" id="tab5">
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
							
							@if($orders4 !== '')
								@foreach($orders4 as $order)
									<div class="order-main">
										<div class="order-list">
										
											<div class="order-status5">
												<div class="order-title">
													<div class="dd-num">订单编号：<a href="javascript:;">{{ $order->o_no }}</a></div>
													<span>成交时间：{{ $order->created_at }}</span>
													
												</div>
												<div class="order-content">
														
													<div class="order-left">
														@foreach($order->orderinfo as $k=>$v)
														
															<ul class="item-list">
																<li class="td td-item">
																	<div class="item-pic">
																		<a href="#" class="J_MakePoint">
																			<img src="/uploads/goods/{{ $v->g_img }}" class="itempic J_ItemImg">
																		</a>
																	</div>
																	<div class="item-info" style="padding-right: 0px;">
																		<div class="item-basic-info">
																			<a href="#">
																				<p>{{ $v->g_name }}</p>
																				<p class="info-little">颜色：{{ $v->d_color }}
																					<br/>尺寸(长X宽X高):{{ $v->g_size }}</p>
																			</a>
																		</div>
																	</div>
																</li>
																<li class="td td-price">
																	<div class="item-price">
																		{{ $v->g_oprice }}
																	</div>
																</li>
																<li class="td td-number">
																	<div class="item-number">
																		<span>×</span>{{ $v->d_num }}
																	</div>
																</li>
	
	
																<li class="td td-operation">
																	<div class="item-operation">
																		
																	</div>
																</li>
															</ul>
															<div class="order-right">
														
																	<li class="td td-amount">
																		<div class="item-amount">
																			合计：{{ $order->o_amount }}
																		</div>
																	</li>
																	<div class="move-right">
																		<li class="td td-status">
																			<div class="item-status">
																				
																				<p class="Mystatus">待评价</p>
																				
																			</div>
																		</li>
																		
																		<li class="td td-change">
																			<div class="item-status">
																				
																				@if($v->g_comment <=0)
																					<div class="am-btn am-btn-danger anniu">
																						
																							<a href="/home/userinfo/commentlist/{{$v->gid}}">去评价</a>
																					</div>
																					
																				@else
																					
																					<div class="am-btn am-btn-danger anniu">
																						
																							<a href="/home/userinfo/commentlist/{{$v->gid}}">写追评</a>
																					</div>
																					
																				@endif
																			</div>
																		</li>
																	</div>
																</div>
														@endforeach
													</div>
													
														
												</div>	
											
											</div>

										</div>
		
									</div>
								@endforeach
								{{-- 分页 --}}
								{{ $orders4->links() }}
								<script>
									var ul=$('.pagination');
									
									ul.attr('class','am-pagination am-pagination-right');
									
								</script>
							@endif
					</div>
					
					
				</div>
					

			</div>
		</div>
	</div>

@endsection