@extends('home.layouts.userinfo')
@section('content')
<div class="main-wrap">

        <div class="am-cf am-padding">
            <div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">支付密码</strong> / <small>Set&nbsp;Pay&nbsp;Password</small></div>
        </div>
        <hr>
        <!--进度条-->
        <div class="m-progress">
            <div class="m-progress-list">
                <span class="step-1 step">
                    <em class="u-progress-stage-bg"></em>
                    <i class="u-stage-icon-inner">1<em class="bg"></em></i>
                    <p class="stage-name">设置支付密码</p>
                </span>
                <span class="step-2 step">
                    <em class="u-progress-stage-bg"></em>
                    <i class="u-stage-icon-inner">2<em class="bg"></em></i>
                    <p class="stage-name">完成</p>
                </span>
                <span class="u-progress-placeholder"></span>
            </div>
            <div class="u-progress-bar total-steps-2">
                <div class="u-progress-bar-inner"></div>
            </div>
        </div>
        <form class="am-form am-form-horizontal" method="post" action='/home/userinfo/safe/updatepaypwd'>
            {{ csrf_field() }}
            <div class="am-form-group bind">
                <label for="user-phone" class="am-form-label">验证手机</label>
                <div class="am-form-content">
                    <span id="phone">{{ $userinfo->phone }}</span>
                </div>
            </div>
            <div class="am-form-group code">
                <label for="user-code" class="am-form-label">验证码</label>
                <div class="am-form-content">
                    <input type="hidden" name='phone' id='userphone' value='{{$userinfo->phone}}'>
                    <input type="tel" id="user-code" name='code'  placeholder="短信验证码四位数字">
                </div>
                <a class="btn" href="javascript:void(0);" onclick="sendMobileCode(this);" id="sendMobileCode">
                    <div class="am-btn am-btn-danger">验证码</div>
                </a>
            </div>
            @if($errors->has('nocode'))
                <div class="am-form-group">
                    <div class="am-form-content">
                        <input type="tel" style='color:red;' disabled value='请正确填写验证码四位数字'>
                    </div>
                </div>
            @endif
            <div class="am-form-group">
                <label for="user-password" class="am-form-label">支付密码</label>
                <div class="am-form-content">
                    <input type="password" id="user-password" name='paypwd' placeholder="6位数字--注意:请记住你的支付密码">
                </div>
            </div>
            <div class="am-form-group">
                <label for="user-confirm-password" class="am-form-label">确认密码</label>
                <div class="am-form-content">
                    <input type="password" id="user-confirm-password" name='repaypwd' placeholder="请再次输入上面的密码">
                </div>
            </div>
            @if($errors->has('repaypwd'))
                <div class="am-form-group">
                    <div class="am-form-content">
                        <input type="tel" style='color:red;' disabled value='两次密码不一致'>
                    </div>
                </div>
            @endif
            @if($errors->has('kong'))
                <div class="am-form-group">
                    <div class="am-form-content">
                        <input type="tel" style='color:red;' disabled value='信息不能为空'>
                    </div>
                </div>
            @endif

            @if($errors->has('success'))
                <div class="am-form-group">
                    <div class="am-form-content">
                        <input type="tel" style='color:green;' disabled value='修改成功，你可以安心去购物了'>
                    </div>
                </div>
            @endif

            @if($errors->has('error'))
                <div class="am-form-group">
                    <div class="am-form-content">
                        <input type="tel" style='color:red;' disabled value='新密码不能和旧密码一样'>
                    </div>
                </div>
            @endif
            <div class="info-btn">
                <button class="am-btn am-btn-danger">保存修改</button>
            </div>
        </form>

    </div>
    <script>

            // 手机号
            function sendMobileCode(obj){
                //获得用户的手机号
                let phone =$('#phone').html();
                // console.log(phone);
    
                // $(obj).attr('disabled',true);
                // $(obj).css('cursor','no-drop'); //鼠标变不可操作的样式
                // $(obj).css('color','#ccc');
                // $('#dyMobileButton').css('color','#ccc');
                
                // 判断什么时候开始计时   当disabled为true时开始计时
                // let time=null;
                // if($('#dyMobileButton').html() == '获取'){
                //     let i=60;
    
                //     time = setInterval(function(){
                //         i--;
                //         $('#dyMobileButton').html('('+i+')s');
                //         if(i < 1){
                //             // 变回原来的样式
                //             $(obj).attr('disabled',false);
                //             $(obj).css('color','#333');
                //             $(obj).css('cursor','pointer'); //鼠标变不可操作的样式
                //             $('#dyMobileButton').css('color','#333');
                //             $('#dyMobileButton').html('获取');
                //             // 清除定时器
                //             clearInterval(time);
                            
                //         }
                //     },1000);
                    
                    // 发送ajax 发送验证码
                    /*$.get('地址','数据',function(res){
                        console.log(res);
                    },'返回的格式');*/
                    
                    
                    // $.get('/home/userinfo_safe_exupdatepaypwd/',{phone},function(res){
                    //     // console.log(res);
                    //     console.log(res);
                    //     // if(res.error_code == 0){
                    //     //     alert('发送成功,验证码十分钟有效');
                    //     // }else{
                    //     //     alert('发送失败.');
                    //     // }
                    // },'json');

                    $.ajax({
                        url:'/home/userinfo/sendPhone/'+phone,
                        type:'GET',
                        success:function(res){
                            console.log(res);
                        },
                        error:function(err){
                            console.log(err);
                        }
                    });
                    
                // }
                
            
            }
    </script>
@endsection