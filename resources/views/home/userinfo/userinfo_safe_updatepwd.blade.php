@extends('home.layouts.userinfo')

@section('content')
<div class="main-wrap">

        <div class="am-cf am-padding">
            <div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">修改密码</strong> / <small>Password</small></div>
        </div>
        <hr>
        <!--进度条-->
        <div class="m-progress">
            <div class="m-progress-list">
                <span class="step-1 step">
                    <em class="u-progress-stage-bg"></em>
                    <i class="u-stage-icon-inner">1<em class="bg"></em></i>
                    <p class="stage-name">重置密码</p>
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
        <form class="am-form am-form-horizontal" method='post' action='/home/userinfo_safe_exupdatepwd'>
            {{ csrf_field() }}
            <div class="am-form-group">
                <label for="user-old-password" class="am-form-label">原密码</label>
                <div class="am-form-content">
                    <input type="password" id="user-old-password" name='ypwd' placeholder="请输入原登录密码">
                </div>
            </div>
            @if($errors->has('ypwd'))
                <div class="am-form-group">
                    <label for="user-confirm-password" class="am-form-label"></label>
                    <div class="am-form-content">
                        <input type="text" style='color:red;' id="user-confirm-password" value='请正确填写原密码'  disabled>
                    </div>
                </div>
            @endif
            @if($errors->has('noypwd'))
                <div class="am-form-group">
                    <label for="user-confirm-password" class="am-form-label"></label>
                    <div class="am-form-content">
                        <input type="text" style='color:red;' id="user-confirm-password" value='原密码不正确'  disabled>
                    </div>
                </div>
            @endif
            <div class="am-form-group">
                <label for="user-new-password" class="am-form-label">新密码</label>
                <div class="am-form-content">
                    <input type="password" id="user-new-password" name='npwd' placeholder="由数字、字母组合">
                </div>
            </div>
            @if($errors->has('npwd'))
                <div class="am-form-group">
                    <label for="user-confirm-password" class="am-form-label"></label>
                    <div class="am-form-content">
                        <input type="text" style='color:red;' id="user-confirm-password" value='请正确填写现密码'  disabled>
                    </div>
                </div>
            @endif
            <div class="am-form-group">
                <label for="user-confirm-password" class="am-form-label">确认密码</label>
                <div class="am-form-content">
                    <input type="password" id="user-confirm-password" name='renpwd' placeholder="请再次输入上面的密码">
                </div>
            </div>
            @if($errors->has('renpwd'))
                <div class="am-form-group">
                    <label for="user-confirm-password" class="am-form-label"></label>
                    <div class="am-form-content">
                        <input type="text" style='color:red;' id="user-confirm-password" value='请正确填写确认密码'  disabled>
                    </div>
                </div>
            @endif
            {{-- 修改失败 --}}
            @if($errors->has('nomodify'))
                <div class="am-form-group">
                    <label for="user-confirm-password" class="am-form-label"></label>
                    <div class="am-form-content">
                        <input type="text" style='color:red;' id="user-confirm-password" value='修改失败'  disabled>
                    </div>
                </div>
            @endif
            <div class="info-btn">
                <button class="am-btn am-btn-danger">保存修改</button>
            </div>

        </form>
        {{-- {{ dump($errors) }} --}}

    </div>
    
    
@endsection