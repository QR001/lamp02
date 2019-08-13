@extends('home.layouts.userinfo')

@section('content')
<div class="main-wrap">

        <div class="am-cf am-padding">
            <div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">支付密码</strong> / <small>Password</small></div>
        </div>
        <hr>
        <!--进度条-->
           
        <form class="am-form am-form-horizontal" method='post' action='/home/userinfo_exfastpay'>
            {{ csrf_field() }}
            {{-- 订单的id --}}
            <input type="hidden" name='orderid' value='{{ $orderid }}'>
            {{-- 订单的总价 --}}
            <input type="hidden" name='o_amount' value='{{ $o_amount }}'>

            <div class="am-form-group">
                <label for="user-new-password" class="am-form-label">支付密码</label>
                <div class="am-form-content">
                    <input type="password" name="paypwd" pattern="\d*">
                </div>
            </div>
            
            
            @if($errors->has('nopaypwd'))
                <div class="am-form-group">
                    <div class="am-form-content">
                        <input type="text" disabled value="请填写支付密码" style="color:green;" type="text" pattern="\d*">
                    </div>
                </div>
            @endif
            
            

            <div class="info-btn">
                <button class="am-btn am-btn-danger">立即支付</button>
            </div>

        </form>

    </div>
    
    
@endsection