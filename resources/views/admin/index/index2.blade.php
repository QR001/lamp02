<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>欢迎页面-L-admin1.0</title>
        <meta name="renderer" content="webkit">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
        <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
        <link rel="stylesheet" href="../css/font.css">
        <link rel="stylesheet" href="../css/xadmin.css">
    </head>
    <body>
    <div class="x-body layui-anim layui-anim-up">
        <blockquote class="layui-elem-quote">欢迎管理员：
            <span class="x-red">{{ Session::get('admin')->name }}</span>！当前时间:{{ date('Y-m-d G:i:s') }}</blockquote>
        <fieldset class="layui-elem-field">
            <legend>数据统计</legend>
            <div class="layui-field-box">
                <div class="layui-col-md12">
                    <div class="layui-card">
                        <div class="layui-card-body">
                            <div class="layui-carousel x-admin-carousel x-admin-backlog" lay-anim="" lay-indicator="inside" lay-arrow="none" style="width: 100%; height: 90px;">
                                <div carousel-item="">
                                    <ul class="layui-row layui-col-space10 layui-this">
                                        @foreach($num as $k => $v)
                                        <li class="layui-col-xs2">
                                            <a href="javascript:;" class="x-admin-backlog-body">
                                                <h3>{{ $k }}</h3>
                                                <p>
                                                    <cite>{{ $v }}</cite>
                                                </p>
                                            </a>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </fieldset>
        <fieldset class="layui-elem-field">
            <legend>系统通知</legend>
            <div class="layui-field-box">
                <table class="layui-table" lay-skin="line">
                    <tbody>
                        <tr>
                            <td >
                                <a class="x-a" target="_blank">累计 {{ $recard->r_num }} 次登录了哦</a>
                            </td>
                        </tr>
                        <tr>
                            <td >
                                <a class="x-a" href="/" target="_blank">登录IP为 {{ $recard->ip }} </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </fieldset>
        <fieldset class="layui-elem-field">
            <legend>系统信息</legend>
            <div class="layui-field-box">
                <table class="layui-table">
                    <tbody>
                        <tr>
                            <th>PHP程式版本</th>
                            <td><?PHP echo PHP_VERSION; ?></td></tr>
                        <tr>
                            <th>服务器端信息</th>
                            <td><?PHP echo $_SERVER ['SERVER_SOFTWARE']; ?> </td></tr>
                        <tr>
                            <th>服务器操作系统</th>
                            <td><?PHP echo PHP_OS; ?> </td></tr>
                        <tr>
                            <th>MYSQL版本</th>
                            <td>5.0.4</td></tr>
                        <tr>
                            <th>laravel</th>
                            <td>5.8</td></tr>
                        <tr>
                            <th>上传附件限制</th>
                            <td><?PHP echo get_cfg_var ("upload_max_filesize")?get_cfg_var ("upload_max_filesize"):"不允许上传附件"; ?> </td></tr>
                        <tr>
                            <th>执行时间限制</th>
                            <td><?PHP echo get_cfg_var("max_execution_time")."秒 "; ?></td></tr>
                        <tr>
                            <th>剩余空间</th>
                            <td>86015.2M</td></tr>
                    </tbody>
                </table>
            </div>
        </fieldset>
        <fieldset class="layui-elem-field">
            <legend>开发团队</legend>
            <div class="layui-field-box">
                <table class="layui-table">
                    <tbody>
                        <tr>
                            <th>版权所有</th>
                            <td>cdnuti(xuebingsi)
                                <a href="http://#/" class='x-a' target="_blank">访问官网</a></td>
                        </tr>
                        <tr>
                            <th>开发者</th>
                            <td>along(370946531@qq.com)</td></tr>
                    </tbody>
                </table>
            </div>
        </fieldset>
        <blockquote class="layui-elem-quote layui-quote-nm">感谢layui,百度Echarts,jquery,本系统由L-admin提供技术支持。</blockquote>
    </div>
   
    </body>
</html>