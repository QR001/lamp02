@extends('home.layouts.userinfo')
@section('content')
<div class="main-wrap">

	<div class="user-address">
		<!--标题 -->
		<div class="am-cf am-padding">
			<div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">地址管理</strong> / <small>Address&nbsp;list</small> <small id='success' style='display:none;color:green;'>设置成功</small> </div>
		</div>
		<hr/>
		<ul class="am-avg-sm-1 am-avg-md-3 am-thumbnails">

			@foreach($locations as $location)
			
			@if($location->l_status == '1')
				<li class="user-addresslist defaultAddr">
					<span class="new-option-r"><i class="am-icon-check-circle"></i><a onclick='defaultAddr({{$location->id}})'>默认地址</a></span>
					<p class="new-tit new-p-re">
						<span class="new-txt">{{ $location->l_name }}</span>
						<span class="new-txt-rd2">{{ $location->l_phone }}</span>
					</p>
					<div class="new-mu_l2a new-p-re">
						<p class="new-mu_l2cw">
							<span>{{ $location->l_address }}</span>
						</p>
					</div>
					<div class="new-addr-btn">
						
						<a href="/home/userinfo_address/delete/{{$location->id }}" ><i class="am-icon-trash"></i>删除</a>
					</div>
				</li>
			@else
				<li class="user-addresslist">
					<span class="new-option-r"><i class="am-icon-check-circle"></i><a onclick='defaultAddr({{$location->id}})'>默认地址</a></span>
					<p class="new-tit new-p-re">
						<span class="new-txt">{{ $location->l_name }}</span>
						<span class="new-txt-rd2">{{ $location->l_phone }}</span>
					</p>
					<div class="new-mu_l2a new-p-re">
						<p class="new-mu_l2cw">
							<span>{{ $location->l_address }}</span>
						</p>
					</div>
					<div class="new-addr-btn">
						
						<a href="/home/userinfo_address/delete/{{$location->id }}" ><i class="am-icon-trash"></i>删除</a>
					</div>
				</li>
			@endif
			@endforeach
			
			
		</ul>
		<div class="clear"></div>
		<a class="new-abtn-type" data-am-modal="{target: '#doc-modal-1', closeViaDimmer: 0}">添加新地址</a>
		<!--例子-->
		<div class="am-modal am-modal-no-btn" id="doc-modal-1">

			<div class="add-dress">

				<!--标题 -->
				<div class="am-cf am-padding">
					<div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">新增地址</strong> / <small>Add&nbsp;address</small></div>
				</div>
				<hr/>

				<div class="am-u-md-12 am-u-lg-8" style="margin-top: 20px;">
					<form class="am-form am-form-horizontal" action='/home/userinfo_address' method='post'>
						{{ csrf_field() }}
						<div class="am-form-group">
							<label for="user-name" class="am-form-label">收货人</label>
							<div class="am-form-content">
								<input type="text" name="l_name" placeholder="收货人">
							</div>
						</div>

						@if($errors->has('l_name'))
							<div class="am-form-group">
								
								<div class="am-form-content">
									<input id="user-phone" type='text' disabled style='color:red' value='请填写用户名'>
								</div>
							</div>
						@endif
						<div class="am-form-group">
							<label for="user-phone" class="am-form-label">手机号码</label>
							<div class="am-form-content">
								<input id="user-phone" type='text' name='l_phone' placeholder="手机号必填">
							</div>
						</div>
					
						@if($errors->has('l_phone'))
							<div class="am-form-group">
								
								<div class="am-form-content">
									<input id="user-phone" type='text' disabled style='color:red' value='请填写正确填写手机号'>
								</div>
							</div>
						@endif

						<div class="am-form-group">
							<label for="user-intro" class="am-form-label">收货地址</label>
							<div class="am-form-content">
								<textarea class="" rows="3" name='l_address' id="user-intro" placeholder="输入详细地址"></textarea>
								
							</div>
						</div>

						@if($errors->has('l_address'))
							<div class="am-form-group">
								<div class="am-form-content">
									<input id="user-phone" type='text' disabled style='color:red' value='请填写收货地址'>
								</div>
							</div>
						@endif

						<div class="am-form-group">
							<div class="am-u-sm-9 am-u-sm-push-3">
								<button class="am-btn am-btn-danger">保存</button>
								
							</div>
						</div>
						
					</form>
				</div>

			</div>

		</div>

	</div>

	<script type="text/javascript">
		$(document).ready(function() {							
			$(".new-option-r").click(function() {
				$(this).parent('.user-addresslist').addClass("defaultAddr").siblings().removeClass("defaultAddr");
			});
			
			var $ww = $(window).width();
			if($ww>640) {
				$("#doc-modal-1").removeClass("am-modal am-modal-no-btn")
			}
			
		})
		function defaultAddr($id){
			
			$.ajax({
				url:'/home/userinfo/defaultAddr/'+$id,
				type:"GET",
				success:function(res){
				
					if(res=='success'){
						// alert('设置成功');
						$('#success').css('display','block');
					}else{
						alert('设置失败');
					}
				},
				error:function(err){
					
					alert('设置失败');
				}
			})
		}
	</script>

	<div class="clear"></div>

</div>
@endsection