<!DOCTYPE html>
<html>

	<head lang="en">
		<meta charset="UTF-8">
		<title>注册</title>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<meta name="format-detection" content="telephone=no">
		<meta name="renderer" content="webkit">
		<meta http-equiv="Cache-Control" content="no-siteapp" />
		<link rel="stylesheet" href="AmazeUI-2.4.2/assets/css/amazeui.min.css" />
		<link href="/home/css/dlstyle.css" rel="stylesheet" type="text/css">
		<script src="/home/AmazeUI-2.4.2/assets/js/jquery.min.js"></script>
		<script src="/home/AmazeUI-2.4.2/assets/js/amazeui.min.js"></script>
		@if($web != '')
		{{-- 网站的描述 --}}
			<meta name="keywords" content="{{ $web->w_keyword }}">
		{{-- 网站的关键字 --}}
			<meta name="description" content="{{ $web->w_description }}">
		@endif
	</head>

	<body>

		<div class="login-boxtitle">
			<a href="#">
				 {{-- 网站的logo --}}
				 @if($web == '')
				 <img alt="logo" src="images/logobig.png" />
			   	@else
				 <img src="/uploads/{{ $web->w_logo }}" alt="">
			    @endif
			</a>
		</div>

		<div class="res-banner">
			<div class="res-main">
				<div class="login-banner-bg"><span></span><img src="images/big.jpg" /></div>
				<div class="login-box">

						<div class="am-tabs" id="doc-my-tabs">
							<ul class="am-tabs-nav am-nav am-nav-tabs am-nav-justify">
								<li class="am-active"><a href="">邮箱注册</a></li>
								<li><a href="">手机号注册</a></li>
							</ul>
							
							<div class="am-tabs-bd">
								<div class="am-tab-panel am-active">
                                   
                                   
									<form  id='emailRegister' method="post" action='/home/register'>
										{{ csrf_field()}}
										{{-- 链接失效 --}}
										@if($errors->has('linkerror'))
										
											<div class="user-phone">
												<input type="tel" name="name" id="phone" value='链接失效' disabled style="color:red;font-weigth:bold">
											</div>
										@endif
										{{-- 注册失败 --}}
										@if($errors->has('activeerror'))
										
											<div class="user-phone">
												<input type="tel" name="name" id="phone" value='激活失败重新发送邮件试试' disabled style="color:red;font-weigth:bold;">
											</div>
										@endif


										<div class="user-email">
												<label for="email"><i class="am-icon-code-fork"></i></label>
												
												@if($errors->has('name'))
													<input type="text" name="name" id="name" style='background-color:#E81010;' placeholder="请正确输入">
												@else
													<input type="text" name="name" id="name" placeholder="请输入用户名">
												@endif
					
										</div>
                                        <div class="user-email">
                                            <label for="email"><i class="am-icon-envelope-o"></i></label>
											
											@if($errors->has('email'))
												<input type="email" name="email" id="email" style='background-color:#E81010;' placeholder="请正确输入">
											@else
												<input type="email" name="email" id="email" placeholder="请输入邮箱账号">
											@endif

                                        </div>										
                                        <div class="user-pass">
											<label for="password"><i class="am-icon-lock"></i></label>
											@if($errors->has('pwd'))
												<input type="password" name="pwd" style='background-color:#E81010;' id="pwd" placeholder="请正确填写6-18">
											@else
												<input type="password" name="pwd" id="pwd" placeholder="设置密码">
											@endif
                                        </div>										
                                        <div class="user-pass">
											<label for="passwordRepeat"><i class="am-icon-lock"></i></label>
											@if($errors->has('repwd'))
												<input type="password" name="repwd" style='background-color:#E81010;'  id="repwd" placeholder="请正确填写">
											@else
												<input type="password" name="repwd" id="repwd" placeholder="确认密码">
											@endif
                                            
                                        </div>	
                                        <div class="am-cf">
                                            <input type="submit" name="" value="注册" class="am-btn am-btn-primary am-btn-sm am-fl">
										</div>
										
                                    </form>
            
									
								</div>

								<div class="am-tab-panel">
									
                                    <form method="post" action='/home/register/phoneRegister' >
										{{ csrf_field()}}
										
										<div class="user-phone">
											<label for="name"><i class="am-icon-code-fork am-icon-sm"></i></label>
											<input type="tel" name="pname" id="panme" placeholder="请输入用户名">
											
										</div>
                                        <div class="user-phone">
                                            <label for="phone"><i class="am-icon-mobile-phone am-icon-md"></i></label>
                                            <input type="tel" name="phone" id="phone" placeholder="请输入手机号">
                                        </div>																			
                                        <div class="verification">
                                            <label for="code"><i class="am-icon-code-fork"></i></label>
                                            <input type="tel" name="code" id="code" placeholder="请输入验证码">
                                            <a class="btn" href="javascript:void(0);" onClick="sendMobileCode(this);" id="sendMobileCode">
                                                <span id="dyMobileButton">获取</span></a>
                                        </div>
                                        <div class="user-pass">
                                            <label for="password"><i class="am-icon-lock"></i></label>
                                            <input type="password" name="ppwd" id="password" placeholder="设置密码">
                                        </div>										
                                        <div class="user-pass">
                                            <label for="passwordRepeat"><i class="am-icon-lock"></i></label>
                                            <input type="password" name="prepwd" id="passwordRepeat" placeholder="确认密码">
										</div>	
										<div class="am-cf">
												<input type="submit" name="" value="注册" class="am-btn am-btn-primary am-btn-sm am-fl">
										</div>
										{{-- 错误提示信息的开始 --}}
										@if($errors->has('kong'))
										
											<div class="user-phone">
												{{-- <label for="name"><i class="am-icon-code-fork am-icon-sm"></i></label> --}}
												<input type="tel" name="name" id="phone" value='内容不能为空' disabled style="color:red;">
											</div>
										@endif
										@if($errors->has('pname'))
										
											<div class="user-phone">
												<input type="tel" name="name" id="phone" value='请正确填写用户名6-15' disabled style="color:red;">
											</div>
										@endif
										@if($errors->has('phone'))
										
											<div class="user-phone">
												<input type="tel" name="name" id="phone" value='请正确填写手机号1-11' disabled style="color:red;">
											</div>
										@endif
										@if($errors->has('code'))
										
											<div class="user-phone">
												<input type="tel" name="name" id="phone" value='请正确填写验证码' disabled style="color:red;">
											</div>
										@endif
										@if($errors->has('ppwd'))
										
											<div class="user-phone">
												<input type="tel" name="name" id="phone" value='请正确填写密码6-18' disabled style="color:red;">
											</div>
										@endif
										@if($errors->has('prepwd'))
										
											<div class="user-phone">
												<input type="tel" name="name" id="phone" value='两次密码不一致' disabled style="color:red;">
											</div>
										@endif
										@if($errors->has('phoneRegistererror'))
											<div class="user-phone">
												<input type="tel" name="name" id="phone" value='手机号注册未成功,请检查验证码是否正确!!' disabled style="color:red;">
											</div>
										@endif
										{{-- 错误提示信息的结束 --}}
									</form>
									
									
								   
									<hr>
								</div>

								<script>
									$(function() {
									    $('#doc-my-tabs').tabs();
									  })
								</script>

							</div>
						</div>

				</div>
			</div>
			
			<div class="footer ">
				<div class="footer-hd ">
					<p>
						<a href="# ">恒望科技</a>
						<b>|</b>
						<a href="# ">商城首页</a>
						<b>|</b>
						<a href="# ">支付宝</a>
						<b>|</b>
						<a href="# ">物流</a>
					</p>
				</div>
				<div class="footer-bd ">
					<p>
						<a href="# ">关于恒望</a>
						<a href="# ">合作伙伴</a>
						<a href="# ">联系我们</a>
						<a href="# ">网站地图</a>
						{{-- 版权 --}}
						@if($web != '')
							<em>© {{ $web->w_cright }} 版权所有</em></p>
						@else
							<em>© 未来家具 版权所有</em></p>
						@endif
						
					</p>
				</div>
			</div>
	</body>

	<script>
		// 邮箱验证
		var flag_1=null;
		var flag_2=null;
		var flag_3=null;
		var flag_4=null;
		// 验证用户名
		$("#name").blur(function(){
			var str = $("#name").val();
			var ret = /^[a-zA-Z]{1}[\w]{5,15}$/;
			if(!ret.test(str)){
				$("#name").css('backgroundColor','orange');
				flag_1=false;
			}else{
				$("#name").css('backgroundColor','');
				flag_1=true;
			}
		});

		// 验证密码
		$('#pwd').blur(function(){
			//密码不能为空
			if($("#pwd").val() ==''){
				$("#pwd").css('backgroundColor','orange');
				flag_2=	false;
			}else{
				$("#pwd").css('backgroundColor','');
				flag_2=true;
			}

			// 密码验证  /^[\w]{6,18}$/
			var str = $("#pwd").val();
			var ret = /^[\w]{6,18}$/;
			if(!ret.test(str)){
				flag_3=	false;
				$("#pwd").css('backgroundColor','orange');
				
			}else{
				$("#pwd").css('backgroundColor','');
				flag_3=true;
			}
		});

		//验证确认密码

		$('#repwd').blur(function(){
			if($("#pwd").val() != $("#repwd").val()){
				$("#repwd").css('backgroundColor','orange');
				flag_4=false;	
			}else{
				$("#repwd").css('backgroundColor','');
				flag_4=true;
			}
			
		});
		
		
	</script>
	<script>
		// 手机号
		function sendMobileCode(obj){
			//获得用户的手机号
			let phone =$('#phone').val();
				// 验证手机号是否正确 
			let phone_preg=/^1{1}[3-9]{1}[\d]{9}$/;
			
			if(!phone_preg.test(phone)){
				alert('手机号格式不正确');
				return false;
			}

			$(obj).attr('disabled',true);
			$(obj).css('cursor','no-drop'); //鼠标变不可操作的样式
			$(obj).css('color','#ccc');
			$('#dyMobileButton').css('color','#ccc');
			
			// 判断什么时候开始计时   当disabled为true时开始计时
			let time=null;
			if($('#dyMobileButton').html() == '获取'){
				let i=60;

				time = setInterval(function(){
					i--;
					$('#dyMobileButton').html('('+i+')s');
					if(i < 1){
						// 变回原来的样式
						$(obj).attr('disabled',false);
						$(obj).css('color','#333');
						$(obj).css('cursor','pointer'); //鼠标变不可操作的样式
						$('#dyMobileButton').css('color','#333');
						$('#dyMobileButton').html('获取');
						// 清除定时器
						clearInterval(time);
						
					}
				},1000);
				
				// 发送ajax 发送验证码
				/*$.get('地址','数据',function(res){
					console.log(res);
				},'返回的格式');*/
				
				
				$.get('/home/register/sendPhone',{phone},function(res){
					// console.log(res);
					if(res.error_code == 0){
						alert('发送成功,验证码十分钟有效');
					}else{
						alert('发送失败.');
					}
				},'json');
				
			}
			
		
		}
	</script>
</html>