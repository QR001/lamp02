@extends('home.layouts.userinfo')

@section('content')
<div class="main-wrap">

        <div class="am-cf am-padding">
            <div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">余额充值</strong> / <small>Password</small></div>
        </div>
        <hr>
        <!--进度条-->
        <div class="m-progress">
            <div class="m-progress-list">
                <span class="step-1 step">
                    <em class="u-progress-stage-bg"></em>
                    <i class="u-stage-icon-inner">1<em class="bg"></em></i>
                    <p class="stage-name">余额充值</p>
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
        
          
            <div class="am-form-group">
                <label for="user-old-password" class="am-form-label">剩余金额</label>
                <div class="am-form-content">
                    <span>￥{{ $balance }}</span>
                </div>
            </div>
        <form class="am-form am-form-horizontal" method='post' action='/home/userinfo_balance'>
            {{ csrf_field() }}
            <div class="am-form-group">
                <label for="user-new-password" class="am-form-label">充值金额</label>
                <div class="am-form-content">
                    <input type="text" name="balance" type="text" pattern="\d*">
                </div>
            </div>
            @if($errors->has('balance'))
                <div class="am-form-group">
                  
                    <div class="am-form-content">
                        <input type="text" disabled value="请正确填写充值的金额" style="color:red;" type="text" pattern="\d*">
                    </div>
                </div>
            @endif
            @if($errors->has('noyue'))
                <div class="am-form-group">
                  
                    <div class="am-form-content">
                        <input type="text" disabled value="没有余额,请尽快充值" style="color:red;" type="text" pattern="\d*">
                    </div>
                </div>
            @endif 
            @if($errors->has('success'))
                <div class="am-form-group">
                    <div class="am-form-content">
                        <input type="text" disabled value="充值成功" style="color:green;" type="text" pattern="\d*">
                    </div>
                </div>
            @endif 
            <div class="info-btn">
                <button class="am-btn am-btn-danger">立即充值</button>
            </div>

        </form>
        {{-- {{ dump($errors) }} --}}

    </div>
    
    
@endsection