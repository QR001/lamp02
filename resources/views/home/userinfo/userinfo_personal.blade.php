@extends('home.layouts.userinfo')
@section('content')
<div class="main-wrap">

		<div class="user-info">
			<!--标题 -->
			<div class="am-cf am-padding">
				<div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">个人资料</strong> / <small>Personal&nbsp;information</small></div>
			</div>
			<hr/>

			
			<div class="user-infoPic">
				<!--头像 -->
				<form method='POST' action='/home/userinfo_updatepic' enctype="multipart/form-data">
					{{ csrf_field() }}
					<div class="filePic">
						<input type="hidden" name='id' value='{{ $userinfo->id }}'>
						<input type="file" name='pic' class="inputPic" allowexts="gif,jpeg,jpg,png,bmp" accept="image/*">
						<img class="am-circle am-img-thumbnail" src="/uploads/{{ $userinfo->pic }}" alt="" />
					</div>
					
					<button class="am-btn am-btn-danger">保存修改</button>
				</form>

				<div class="info-m">
					<div><b>用户名：<i>{{ $userinfo->name }}</i></b></div>
					<div class="u-level">
						<span class="rank r2">
							 <s class="vip1"></s><a class="classes" href="#">铜牌会员</a>
						</span>
					</div>
					<div class="u-safety">
						<a href="safety.html">
						 账户安全
						<span class="u-profile"><i class="bc_ee0000" style="width: 60px;" width="0">60分</i></span>
						</a>
					</div>
				</div>
			</div>

			<!--个人信息 -->
			<div class="info-main">
				<form class="am-form am-form-horizontal" method="post" action='/home/userinfo_personal_update'>
					{{ csrf_field()}}
					<div class="am-form-group">
						<label for="user-name2" class="am-form-label">用户名</label>
						<div class="am-form-content">
							<input type="hidden" name='id'  value="{{$userinfo->id}}">
							<input type="text" name='name' id="name" value="{{ $userinfo->name ?? '' }}">
							
						</div>
					</div>
					{{-- 错误提示 --}}
					@if($errors->has('name'))
						<div class="am-form-group">
							<label for="user-name2" class="am-form-label">用户名错误</label>
							<div class="am-form-content">
								<input type="text" disabled value="请正确填写用户名" style='color:red;'>
							</div>
						</div>
					@endif

					<div class="am-form-group">
						<label for="user-name" class="am-form-label">真实姓名</label>
						<div class="am-form-content">
							<input type="text" name='realname' id="realname" value="{{ $userinfo->realname ?? '' }}">
						</div>
					</div>
					{{-- 错误提示 --}}
					@if($errors->has('realname'))
						<div class="am-form-group">
							<label for="user-name2" class="am-form-label">真实姓名错误</label>
							<div class="am-form-content">
								<input type="text" disabled value="请正确填写" style='color:red;'>
							</div>
						</div>
					@endif

					<div class="am-form-group">
						<label class="am-form-label">性别</label>
						<div class="am-form-content sex">
							<label class="am-radio-inline">
								@if($userinfo->sex==1)
									<input type="radio" name="sex" checked value="1" data-am-ucheck> 男
								@else
									<input type="radio" name="sex" value="1" data-am-ucheck> 男
								@endif
							</label>
							<label class="am-radio-inline">
								@if($userinfo->sex==2)
									<input type="radio" name="sex" checked value="2" data-am-ucheck> 女
								@else
									<input type="radio" name="sex" value="2" data-am-ucheck> 女
								@endif
							</label>
							<label class="am-radio-inline">
								@if($userinfo->sex !=2)
									<input type="radio" checked name="sex" value="3" data-am-ucheck> 保密
								@else
									<input type="radio" name="sex" value="3" data-am-ucheck> 保密
								@endif
							</label>
						</div>
					</div>

					
					<div class="am-form-group">
						<label for="user-phone" class="am-form-label">电话</label>
						<div class="am-form-content">
							<input id="phone" name='phone'  value="{{ $userinfo->phone ?? '' }}" type="tel">
						</div>
					</div>
					{{-- 错误提示 --}}
					@if($errors->has('phone'))
						<div class="am-form-group">
							<label for="user-name2" class="am-form-label">电话错误</label>
							<div class="am-form-content">
								<input type="text" disabled value="请正确填写" style='color:red;'>
							</div>
						</div>
					@endif
					<div class="am-form-group">
						<label for="user-email" class="am-form-label">电子邮件</label>
						<div class="am-form-content">
							<input id="email" name='email' value="{{ $userinfo->email ?? '' }}" type="email">
						</div>
					</div>
					{{-- 错误提示 --}}
					@if($errors->has('email'))
						<div class="am-form-group">
							<label for="user-name2" class="am-form-label"></label>
							<div class="am-form-content">
								<input type="text" disabled value="请正确填写" style='color:red;'>
							</div>
						</div>
					@endif
					
					<div class="info-btn">
						
						<button class="am-btn am-btn-danger">保存修改</button>
					</div>
				
				</form>
			</div>

		</div>

	</div>
	<script>
		
		// 验证用户名
		$("#name").blur(function(){

			var str = $("#name").val();
			
			if(str.length!=0){
				
				var ret = /^[a-zA-Z]{1}[\w]{5,15}$/;
				if(!ret.test(str)){
					
					$('#name').val('用户名格式不正确');
					
					$("#name").css('backgroundColor','orange');
					

				}else{
					$("#name").css('backgroundColor','');
					
				}
			}else{
				$("#name").css('backgroundColor','orange');
				$("#name").attr('placeholder','用户名不能为空');
			}
			
		});
		// 验证真实姓名
		$('#realname').blur(function(){
			var length=$('#realname').val();
			if(length==0){
				$("#realname").css('backgroundColor','orange');
				$("#realname").attr('placeholder','请填写真实姓名');
			}else{
				$("#realname").css('backgroundColor','');
			}
		});

		//验证手机号
		$('#phone').blur(function(){
		
			var str = $("#phone").val();
			
			if(str.length!=0){

				var ret = /^1{1}[3-9]{1}[\d]{9}$/;
				if(!ret.test(str)){
					$('#phone').val('请填写有效的手机号');	
					$("#phone").css('backgroundColor','orange');
				}else{
					$("#phone").css('backgroundColor','');
					
				}
			}else{
				$("#phone").css('backgroundColor','orange');
				$("#phone").attr('placeholder','请填写有效的手机号');
			}
		}); 

		// 验证电子邮箱
		$('#email').blur(function(){
			var str = $("#email").val();
			
			if(str.length!=0){

				var ret = /^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/;
				if(!ret.test(str)){
					$('#email').val('请填写有效的邮箱');	
					$("#email").css('backgroundColor','orange');
				}else{
					$("#email").css('backgroundColor','');
					
				}
			}else{
				$("#email").css('backgroundColor','orange');
				$("#email").attr('placeholder','请填写有效的邮箱');
			}
		});
		
	</script>
@endsection