@extends('home.layouts.userinfo')
    <link href="/home/css/appstyle.css" rel="stylesheet" type="text/css">
@section('content')
<div class="main-wrap">

        <div class="user-comment">
            <!--标题 -->
            <div class="am-cf am-padding">
                <div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">发表评论</strong> / <small>Make&nbsp;Comments</small></div>
            </div>
            <hr/>

            <div class="comment-main">
                <div class="comment-list">
                    <div class="item-pic">
                        <a href="#" class="J_MakePoint">
                            <img src="/uploads/goods/{{ $img }}" class="itempic">
                        </a>
                    </div>

                    <div class="item-title">

                        <div class="item-name">
                            <a href="#">
                                <p class="item-basic-info">{{ $good->g_name }}</p>
                            </a>
                        </div>
                        <div class="item-info">
                            <div class="info-little">
                                <span>颜色：{{ $good->g_color }}</span>
                                <br/>
                                <span>尺寸：{{ $good->g_size }}</span>
                            </div>
                            <div class="item-price">
                                价格：<strong>￥{{ $good->g_nprice }}</strong>
                            </div>										
                        </div>
                    </div>
                    <div class="clear"></div>
                    {{-- 发表评论 --}}
                    <form method='POST' action='/home/userinfo/excomment' enctype='multipart/form-data'>
                        {{ csrf_field() }}
                        <div class="item-comment">
                            <textarea name='c_content' placeholder="请写下对宝贝的感受吧，对他人帮助很大哦！最少填写10个词"></textarea>
                        </div>
                        <div class="filePic">
                            <input type="file" name='c_img[]' multiple class="inputPic" allowexts="gif,jpeg,jpg,png,bmp" accept="image/*" >
                            <span>晒照片(0/5)</span>
                            
                        </div>
                        <div class="item-opinion">
                            <li><i class="op1"></i>好评</li>
                            <li><i class="op2"></i>中评</li>
                            <li><i class="op3"></i>差评</li>
                        </div>
                        {{-- 用户的评分 --}}
                        <input type="hidden" name='c_score' id='pf'>
                        {{-- 评论的商品id --}}
                        <input type="hidden" name='gid' value='{{ $good->id }}'>

                        <div class="info-btn">
                            <button class="am-btn am-btn-danger">发表评论</button>
                            {{-- 错误提示 --}}
                            @if($errors->has('c_content'))
                                <div class="am-btn am-btn-warning">请正确填写评论信息</div>
                            @endif
                            
                            @if($errors->has('c_score'))
                                <div class="am-btn am-btn-warning">请对此商品做出评分</div>
                            @endif
                        </div>

                    </form>
                    
                </div>
                
                							
                <script type="text/javascript">
                    $(document).ready(function() {
                        $(".comment-list .item-opinion li").click(function() {	
                            $(this).prevAll().children('i').removeClass("active");
                            $(this).nextAll().children('i').removeClass("active");
                            $(this).children('i').addClass("active");
                        });

                        // 获得用户的评分
                        
                        $(".comment-list .item-opinion li").click(function() {	
                            // 点击的是哪个获得评分
                            var pft=$(this).children('i').attr('class');
                            // 获得评分
                            var pf='';
                            if(pft=='op1 active'){
                                pf=1;
                            }else if(pft=='op2 active'){
                                pf=2;
                            }else if(pft=='op3 active'){
                                pf=3;
                            }
                            $('#pf').val(pf);
                        });
                    })
                    
                </script>					
        
                                    
                
            </div>

        </div>

    </div>
@endsection