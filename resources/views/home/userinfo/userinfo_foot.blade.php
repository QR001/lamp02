@extends('home.layouts.userinfo')

<link href="/home/css/footstyle.css" rel="stylesheet" type="text/css">

@section('content')

@if(!isset($track[0]))
		<script>
			alert("还没有足迹哦，快去看看想要的商品吧！！！");
			window.history.back();
		</script>
@endif

<div class="main-wrap">

		<div class="user-foot">
			<!--标题 -->
			<div class="am-cf am-padding">
				<div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">我的足迹</strong> / <small>Browser&nbsp;History</small></div>
			</div>
			<hr/>

			

			<!--足迹列表 -->
			@foreach($track as $v)
			<div class="goods">
				<div class="goods-date" data-date="2015-12-21">
					<s class="line"></s>
				</div>

				<div class="goods-box">
					<div class="goods-pic">
						<div class="goods-pic-box">
							<a class="goods-pic-link" target="_blank" href="#" title="{{ $v->good->g_name }}">
								<img src="/uploads/goods/{{ $v->good->img }}" height="180px" class="goods-img"></a>
						</div>
						<a class="goods-delete"  href="javascript:void(0);" ><i onclick="del({{ $v->good->id }})" class="am-icon-trash"></i></a>
						@if($v->good->g_status == 2)
						<div class="goods-status goods-status-show"><span class="desc">宝贝已下架</span></div>
						@endif
					</div>

					<script>
						function del(id)
						{
							$.ajax({
								url:'/home/userinfo/del/'+id,
								type:'GET',
								success:function(data){
									if(data == 'success'){
										alert('删除成功');
										window.location.reload();
									}else{
										alert("系统繁忙，请稍后再试吧");
									}
									
								},
								error:function(){
									alert("系统繁忙，请稍后再试吧");
								}
							});
						}
					</script>

					<div class="goods-attr">
						<div class="good-title">
							<a class="title" href="#" target="_blank">{{ $v->good->g_name }}</a>
						</div>
						<div class="goods-price">
							<span class="g_price">                                    
							<span>¥</span><strong>{{ $v->good->g_nprice }}</strong>
							</span>
							<span class="g_price g_price-original">                                    
							<span>¥</span><strong>{{ $v->good->g_nprice }}</strong>
							</span>
						</div>
						<div class="clear"></div>
						<div class="goods-num">
							<div class="match-recom">
								<!-- <a href="#" class="match-recom-item">找相似</a> -->
								<i><em></em><span></span></i>
							</div>
						</div>
					</div>
				</div>
			</div>		
			@endforeach				
			<div class="clear"></div>
			
			
			
		</div>
	</div>
    
@endsection