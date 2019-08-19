@extends('home.layouts.userinfo')
@section('content')
<div class="main-wrap">
		<!--标题 -->
		<div class="am-cf am-padding">
			<div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">退换货申请</strong> / <small>Apply&nbsp;for&nbsp;returns</small></div>
		</div>
	
		<hr>
		<div class="comment-list">
		<!--进度条-->
		<div class="m-progress">
			<div class="m-progress-list">
				<span class="step-2 step">
					<em class="u-progress-stage-bg"></em>
					<i class="u-stage-icon-inner">1<em class="bg"></em></i>
					<p class="stage-name">买家申请退款</p>
				</span>
				<span class="step-1 step">
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
		<center>				
			<div class="refund-aside" style="fount-size:30px">
				<div style="margin-top:90px;font-size:25px;">
					申请成功
				</div>
				<a style="margin-top:20px" href="/home/userinfo_refund/{{ $did }}/{{ $gid }}">查看钱款去向</a>
				<div class="clear"></div>
			</div>
		</center>
		</div>
		<div class="clear"></div>
	</div>

@endsection