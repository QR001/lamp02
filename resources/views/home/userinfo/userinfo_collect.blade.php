@extends('home.layouts.userinfo')
@section('content')

<link href="/home/css/colstyle.css" rel="stylesheet" type="text/css">

<div class="main-wrap">

		<div class="user-collection">
			<!--标题 -->
			<div class="am-cf am-padding">
				<div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">我的收藏</strong> / <small>My&nbsp;Collection</small></div>
			</div>
			<hr/>

			<div class="you-like">
				<div class="s-bar">
					我的收藏
					
				</div>
				<div class="s-content">
					@foreach($collects as $collect)
						<div class="s-item-wrap">
							<div class="s-item">

								<div class="s-pic">
									<a href="/home/goods/goodInfo/{{ $collect->gid }}" class="s-pic-link">
										<img  src="/uploads/goods/{{$collect->g_img}}" alt="{{ $collect->g_name }}" title="{{ $collect->g_name }}" class="s-pic-img s-guess-item-img">
										@if($collect->g_status==2)
										
											<span class="tip-title">已下架</span>
										@endif
									</a>
								</div>
								<div class="s-info">
									<div class="s-title"><a href="#" title="{{ $collect->g_name }}">{{ $collect->g_name }}</a></div>
									<div class="s-price-box">
										<span class="s-price"><em class="s-price-sign">¥</em><em class="s-value">{{ $collect->g_nprice }}</em></span>
										<span class="s-history-price"><em class="s-price-sign">¥</em><em class="s-value">{{ $collect->g_oprice }}</em></span>
									</div>
									<div class="s-extra-box" style="display:block;">
										<span class="s-comment">评价: {{ $collect->comment_pf }}</span>
										<span class="s-sales">月销: {{ $collect->g_sales }}</span>
									</div>
								</div>
								<div class="s-tp">
									<i class="am-icon-shopping-cart"></i>
									<a href='/home/userinfo/delcollect/{{ $collect->id }}'><span class="ui-btn-loading-before buy">取消收藏</span></a>
								</div>
							</div>
						</div>
					@endforeach
				

				</div>
			
		
					{{ $collects->links() }}
					<script>
						var ul=$('.pagination');
						
						ul.attr('class','am-pagination am-pagination-right');
						
					</script>
				

			</div>

		</div>

	</div>
@endsection