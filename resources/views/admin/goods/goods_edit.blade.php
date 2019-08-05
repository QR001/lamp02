<!DOCTYPE html>
<html>
  
  <head>
    <meta charset="UTF-8">
    <title>欢迎页面-L-admin1.0</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <link rel="shortcut icon" href="/admin/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="/admin/css/font.css">
    <link rel="stylesheet" href="/admin/css/xadmin.css">
    <script src="/admin/js/jquery.min.js"></script>
    <script type="text/javascript" src="/admin/lib/layui/layui.js" charset="utf-8"></script>
    <script type="text/javascript" src="/admin/js/xadmin.js"></script>
    <!-- 让IE8/9支持媒体查询，从而兼容栅格 -->
    <!--[if lt IE 9]>
      <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
      <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  
  <body>
    <div class="x-body">
        <form class="layui-form">
            {{ csrf_field() }}
          <div class="layui-form-item">
              <label for="g_name" class="layui-form-label">
                  <span class="x-red">*</span>商品名称
              </label>
              <div class="layui-input-inline">
                  <input type="text" id="g_name" name="g_name" value="{{ $goods->g_name }}" required lay-verify="g_name"
                  autocomplete="off" class="layui-input">
              </div>
          </div>
          <div class="layui-form-item">
              <label for="g_oprice" class="layui-form-label">
                  <span class="x-red">*</span>商品原价
              </label>
              <div class="layui-input-inline">
                  <input type="text" id="g_oprice" name="g_oprice" placeholder="￥" value="{{ $goods->g_oprice }}" required lay-verify="g_oprice"
                  autocomplete="off" class="layui-input">
              </div>
          </div>
          <div class="layui-form-item">
              <label for="g_nprice" class="layui-form-label">
                  <span class="x-red">*</span>商品现价
              </label>
              <div class="layui-input-inline">
                  <input type="text" id="g_nprice" name="g_nprice" value="{{ $goods->g_nprice }}" placeholder="￥" required lay-verify="g_nprice"
                  autocomplete="off" class="layui-input">
              </div>
          </div>
          <div class="layui-form-item">
              <label for="g_nprice" class="layui-form-label">
                  <span class="x-red">*</span>商品积分
              </label>
              <div class="layui-input-inline">
                  <input type="text" id="g_integral" name="g_integral" value="{{ $goods->g_integral }}" required lay-verify="g_integral"
                  autocomplete="off" class="layui-input">
              </div>
          </div>
          <div class="layui-form-item">
              <label for="g_nprice" class="layui-form-label">
                  <span class="x-red">*</span>商品库存
              </label>
              <div class="layui-input-inline">
                  <input type="text" id="g_stock" name="g_stock" value="{{ $goods->g_stock }}" required lay-verify="g_stock"
                  autocomplete="off" class="layui-input">
              </div>
          </div>
          <div class="layui-form-item">
              <label for="g_color[]" class="layui-form-label">
                    <span class="x-red">*</span>颜色
              </label>
              @if($goods->g_color)
                @foreach($goods->g_color as $v)
                <div class="layui-input-inline" style="width: 100px;">
                        <input type="checkbox" name="g_color[]" title="{{ $v }}" value="{{ $v }}" checked>   
                </div>
                @endforeach
              @else
                <div class="layui-input-inline" style="width: 100px;">
                        <input type="checkbox" name="g_color[]" title="图片色" value="图片色">   
                </div>
              @endif
              
              <a class="layui-btn" onclick="addColor(this)">其他颜色</a>
              
          </div>
          
          <div class="layui-form-item">
            <div class="layui-inline">
                <label class="layui-form-label">
                   <span class="x-red">*</span>尺寸(cm)
                </label>
              <div class="layui-input-inline" style="width: 100px;">
                <input type="text"  placeholder="长" name="g_size1" value="{{ $goods->g_size[0] ?? '' }}" required lay-verify="g_size1" autocomplete="off" class="layui-input">
              </div>
              <div class="layui-form-mid">x</div>
              <div class="layui-input-inline" style="width: 100px;">
                <input type="text"  placeholder="宽" name="g_size2" value="{{ $goods->g_size[1] ?? '' }}" required lay-verify="g_size2" autocomplete="off" class="layui-input">
              </div>
              <div class="layui-form-mid">x</div>
              <div class="layui-input-inline" style="width: 100px;">
                <input type="text"  placeholder="高" name="g_size3" value="{{ $goods->g_size[2] ?? '' }}" required lay-verify="g_size3" autocomplete="off" class="layui-input">
              </div>
            </div>
          </div>
          
          <div class="layui-form-item">
              <label for="bid" class="layui-form-label">
                  <span class="x-red">*</span>参与活动
              </label>
              <div class="layui-input-inline">
                  <select id="bid" name="bid" class="valid">
                    <option value="0">暂不参加</option>
                    @foreach($blog as $v)
                      @if($v->id == $goods->bid)
                        <option value="{{ $v->id }}" selected>{{ $v->b_title }}</option>
                      @else
                        <option value="{{ $v->id }}">{{ $v->b_title }}</option>

                      @endif
                    @endforeach
                  </select>
              </div>
          </div>

          <div class="layui-form-item">
              <label for="g_status" class="layui-form-label">
                  <span class="x-red">*</span>销售状态
              </label>
              <div class="layui-input-inline">
                  <select name="g_status">
                    @if($goods->g_status == '1')
                        <option value="1" selected >已上架</option>
                        <option value="2"  >已下架</option>
                    @else
                        <option value="1"  >已上架</option>
                        <option value="2" selected >已下架</option>
                    @endif
                  </select>
              </div>
          </div>
          
          <div class="layui-form-item layui-form-text">
              <label for="desc" class="layui-form-label">
                  特点
              </label>
              <div class="layui-input-block">
                  <textarea placeholder="请输入内容" id="desc" name="d_trait" required lay-verify="d_trait" class="layui-textarea">{{ $goods->details->d_trait }}</textarea>
              </div>
          </div>
          <div class="layui-form-item layui-form-text">
              <label for="desc" class="layui-form-label">
                  相关提示
              </label>
              <div class="layui-input-block">
                  <textarea placeholder="请输入内容" id="desc" name="d_prompt" required lay-verify="d_prompt" class="layui-textarea">{{ $goods->details->d_prompt }}</textarea>
              </div>
          </div>
          <div class="layui-form-item layui-form-text">
              <label for="desc" class="layui-form-label">
                  保养说明
              </label>
              <div class="layui-input-block">
                  <textarea placeholder="请输入内容" id="desc" name="d_explain" required lay-verify="d_explain" class="layui-textarea">{{ $goods->details->d_explain }}</textarea>
              </div>
          </div>

          <input type="hidden" name="id" value="{{ $goods->id }}">

          <div class="layui-form-item">
              <label for="L_repass" class="layui-form-label">
              </label>
              <button  class="layui-btn" lay-filter="add" lay-submit="">
                  修改
              </button>
          </div>
      </form>
    </div>
    <script>
        layui.use(['form','layer'], function(){
            $ = layui.jquery;
          var form = layui.form
          ,layer = layui.layer;

          
        
          //自定义验证规则
          form.verify({
            g_name: function(value){
              if(value.length < 2 || value.length > 20){
                return '商品名称请保持在 2 - 20 个字符内';
              }
              
              if($('#g_oprice')[0].value < $('#g_nprice')[0].value){
                return '商品定价不合理，请重新输入';
              }
              
            },
            d_trait: function(value){
              if(value.length < 10 || value.length > 200){
                return '商品特点请保持在 10 - 200 个字符内';
              }
            },
            d_prompt: function(value){
              if(value.length < 10 || value.length > 200){
                return '商品相关提示请保持在 10 - 200 个字符内';
              }
            },
            d_explain: function(value){
              if(value.length < 10 || value.length > 200){
                return '商品保养说明请保持在 10 - 200 个字符内';
              }
            }
            ,g_oprice: [/^[0-9]+$/, '请输入正确数据类型（提示：数字）且不可为空']
            ,g_nprice: [/^[0-9]+$/, '请输入正确数据类型（提示：数字）且不可为空']
            ,g_integral: [/^[0-9]+$/, '请输入正确数据类型（提示：数字）且不可为空']
            ,g_stock: [/^[0-9]+$/, '请输入正确数据类型（提示：数字）且不可为空']
            ,g_size1: [/^[0-9]*$/, '请输入正确数据类型（提示：数字）且不可为空']
            ,g_size2: [/^[0-9]*$/, '请输入正确数据类型（提示：数字）且不可为空']
            ,g_size3: [/^[0-9]*$/, '请输入正确数据类型（提示：数字）且不可为空']
            
          });

          //监听提交
          form.on('submit(add)', function(data){
            //发异步，把数据提交给php
            $.ajax({
                url:'/admin/goods/goods_update',
                data:data.field,
                type:'POST',
                success:function(data){
                    // console.log(data);
                    if(data == 'success'){
                        layer.alert("修改成功", {icon: 6},function () {
                            // 获得frame索引
                            var index = parent.layer.getFrameIndex(window.name);
                            //关闭当前frame
                            parent.layer.close(index);
                        });
                    }else{
                        layer.alert("修改失败", {icon: 5},function () {
                            // 获得frame索引
                            var index = parent.layer.getFrameIndex(window.name);
                            //关闭当前frame
                            parent.layer.close(index);
                        });
                    }
                },
                error:function(){
                    layer.alert("请求失败", {icon: 5},function () {
                        // 获得frame索引
                        var index = parent.layer.getFrameIndex(window.name);
                        //关闭当前frame
                        parent.layer.close(index);
                    });
                },
                async:true

            });
            
            return false;
          });
          
          
        });
        //添加其他颜色
        function addColor(obj){
            
            var res = layer.prompt('请输入要添加的颜色',function(data){
                if(data.length > 1 && data.length <5){
                    var ele = $('<div class="layui-input-inline" style="width: 100px;"><input type="checkbox" name="g_color[]" title="'+data+'" value="'+data+'" checked=""><div class="layui-unselect layui-form-checkbox layui-form-checked" lay-skin=""><span>'+data+'</span><i class="layui-icon"></i></div>   </div>');
                
                    $(obj).before(ele);
                    layer.msg('已添加!',{icon: 6,time:1000});
                }else{
                  layer.msg('请保持在 1 - 5 个字符内!',{icon: 5,time:1000});

                }

                $('.layui-layer-prompt').hide();
                $('.layui-layer-shade').hide();
                
            }); 
            
        }

       
    </script>
  </body>

</html>