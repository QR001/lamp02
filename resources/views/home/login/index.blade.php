<!DOCTYPE html>
<html>
  
  <head lang="en">
    <meta charset="UTF-8">
    <title>登录</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="format-detection" content="telephone=no">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp" />

    
    @if($web != '')
      {{-- 网站的描述 --}}
        <meta name="keywords" content="{{ $web->w_keyword }}">
      {{-- 网站的关键字 --}}
        <meta name="description" content="{{ $web->w_description }}">
    @endif
    
    <link rel="stylesheet" href="/home/AmazeUI-2.4.2/assets/css/amazeui.css" />
    <link href="/home/css/dlstyle.css" rel="stylesheet" type="text/css"></head>
    
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
    <div class="login-banner">
      <div class="login-main">
        <div class="login-banner-bg">
          <span></span>
          <img src="images/big.jpg" /></div>
        <div class="login-box">
          <h3 class="title">登录商城</h3>
          <div class="clear"></div>
          <div class="login-form">
			<form method='post' action='/home/login'>
				{{ csrf_field()}}
          <div class="user-name">
                <label for="user">
                  <i class="am-icon-user"></i>
				    </label>
					@if($errors->has('name'))
						<input type="text" name="name" id="user" style='background-color:#E81010;' placeholder="此选项必填">
          @endif

          @if($errors->has('nouser'))
              <input type="text" name="name" id="user" style='background-color:#E81010;' placeholder="用户名不存在">
          @endif

          @if($errors->has('frozen'))
            <input type="text" name="name" id="user" style='background-color:#E81010;' placeholder="账号被冻结">
          @endif
          {{-- 邮箱未激活 --}}
          @if($errors->has('activate'))
            <input type="text" name="name" id="user" style='background-color:#E81010;' placeholder="邮箱未激活">
          @endif
          @if($errors->has('format'))
            <input type="text" name="name" id="user" style='background-color:#E81010;' placeholder="请正确输入">
          @endif
            <input type="text" name="name" id="user" placeholder="邮箱/手机/用户名"> 
			    </div>
              <div class="user-pass">
                <label for="password">
                  <i class="am-icon-lock"></i>
				</label>
				@if($errors->has('pwd'))
						<input type="password"  name="pwd" id="password" style='background-color:#E81010;' placeholder="请输入密码">
					@else
            <input type="password"  name="pwd" id="password" placeholder="请输入密码">
            
				@endif
				
         </div>
         @if($errors->has('nopwd'))
          <div class="user-name">
              
              <input type="text" disabled id="user" style='background-color:#E81010;'  placeholder="用户名或密码不正确"> 
          </div>

          @endif
          {{-- 登录过期请重新登录 --}}
          @if($errors->has('loginExpire'))
          <div class="user-name">
              <input type="text" disabled  style='background-color:#E81010;' value='登录过期请重新登录'> 
          </div>

          @endif
				<div class="am-cf">
					
					<input type="submit" name="" value="登 录" class="am-btn am-btn-primary am-btn-sm">
				</div>
            </form>
          </div>
          <div class="login-links">
           
            <a href="/home/register" class="zcnext am-fr am-btn-default">注册</a>
            <br /></div>
          
          <div class="partner">
            <h3>合作账号</h3>
            <div class="am-btn-group">
              <li>
                <a href="#">
                  <i class="am-icon-qq am-icon-sm"></i>
                  <span>QQ登录</span></a>
              </li>
              <li>
                <a href="#">
                  <i class="am-icon-weibo am-icon-sm"></i>
                  <span>微博登录</span></a>
              </li>
              <li>
                <a href="#">
                  <i class="am-icon-weixin am-icon-sm"></i>
                  <span>微信登录</span></a>
              </li>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="footer">
        <div class="footer-hd ">
          <p>
            @foreach($links as $v)
            <b>|</b>
            <a href="{{ $v->l_url }}">{{ $v->l_name }}</a>
            @endforeach
          </p>
        </div>
      <div class="footer-bd">
        <p>
          <a href="#">关于恒望</a>
          <a href="#">合作伙伴</a>
          <a href="#">联系我们</a>
          <a href="#">网站地图</a>

          @if($web != '')
            <em>© {{ $web->w_cright }} 版权所有</em></p>
          @else
            <em>© 未来家具 版权所有</em></p>
          @endif
        </p>
      </div>
    </div>
  </body>

</html>