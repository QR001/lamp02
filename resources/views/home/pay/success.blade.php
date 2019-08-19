
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
<title>付款成功页面</title>
<link rel="stylesheet"  type="text/css" href="/home/AmazeUI-2.4.2/assets/css/amazeui.css"/>
<link href="/home/AmazeUI-2.4.2/assets/css/admin.css" rel="stylesheet" type="text/css">
<link href="/home/basic/css/demo.css" rel="stylesheet" type="text/css" />

<link href="/home/css/sustyle.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="basic/js/jquery-1.7.min.js"></script>

</head>

<body>


	<!--顶部导航条 -->
  <div class="am-container header">
      <ul class="message-l">
        <div class="topMessage">
          <div class="menu-hd">
          
            @if(session('home'))
              <a href="#" target="_top" class="h">欢迎 {{ session('home.name') }} 光临</a>
              <a href="/home/login/logout">退出</a>
              @else
              <a href="/home/login" target="_top" class="h">亲，请登录</a>
              <a href="/home/register" target="_top">免费注册</a>
            @endif
          </div>
        </div>
      </ul>
      <ul class="message-r">
        <div class="topMessage home">
          <div class="menu-hd"><a href="/home/index" target="_top" class="h">商城首页</a></div>
        </div>
        @if(session('home'))
          <div class="topMessage my-shangcheng">
            <div class="menu-hd MyShangcheng"><a href="/home/userinfo" target="_top"><i class="am-icon-user am-icon-fw"></i>个人中心</a></div>
          </div>
          <div class="topMessage mini-cart">
            <div class="menu-hd"><a id="mc-menu-hd" href="/home/carts" target="_top"><i class="am-icon-shopping-cart  am-icon-fw"></i><span>购物车</span></a></div>
          </div>
          <div class="topMessage favorite">
            <div class="menu-hd"><a href="/home/userinfo_collect" target="_top"><i class="am-icon-heart am-icon-fw"></i><span>收藏夹</span></a></div>
          </div>
        @endif
      </ul>
  </div>

  <!--悬浮搜索框-->

  <div class="nav white">
    @if($web !='')
      <div class="logo"><img width='30px' src="/uploads/{{ $web->w_logo }}" /></div>
      <div class="logoBig" style="width:10%;">
        <li><img width='30px' src="/uploads/{{ $web->w_logo }}" /></li>
      </div>
    @else
      <div class="logo"><img src="/home/images/logo.png" /></div>
      <div class="logoBig">
        <li><img src="/home/images/logobig.png" /></li>
      </div>
    @endif
    <div class="search-bar pr">
      <a name="index_none_header_sysc" href="#"></a>
      <form action="/home/goods/goodSearch" method="get" >
        <input id="searchInput" name="gname" type="text" placeholder="搜索" autocomplete="off">
        <input id="ai-topsearch" class="submit am-btn" value="搜索"  type="submit">
      </form>
    </div>
</div>

<div class="clear"></div>



<div class="take-delivery">
 <div class="status">
   @if($order->o_status==1)
      <h2>您已下单成功---请到个人中心进行付款</h2>
   @else
      <h2>您已支付成功!!</h2>
   @endif
   
   <div class="successInfo">
     <ul>
       <li>付款金额<em>¥{{ $order->o_amount }}</em></li>
       <div class="user-info">
         <p>收货人：{{ $order->o_consignee }}</p>
         <p>联系电话：{{ $order->o_contact }}</p>
         <p>收货地址：{{ $order->o_address }}</p>
       </div>
             请认真核对您的收货信息，如有错误请联系客服                 
     </ul>
     <div class="option">
       <span class="info">您可以</span>
        <a href="/home/userinfo_order" class="J_MakePoint">查看<span>已买到的宝贝</span></a>
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
