
<!DOCTYPE html>
<html lang="zh">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>后台登录</title>
<link rel="stylesheet" type="text/css" href="/admin/css/login.css">
</head>
<body>

<div id="wrapper" class="login-page">
    <div id="login_form" class="form">
    @if (isset($error))
        <script>alert("{{ $error }}")</script>
    @endif
    <form class="login-form" action="/admin/login/dologin" method="post">
        {{ csrf_field() }}
        <h2>管理登录</h2>
        <input type="text" placeholder="用户名" name="name"  id="user_name" />
        <input type="password" placeholder="密码" name="password" id="password" />
        <button id="login">登　录</button>
    </form>
    </div>
</div>

<script src="/admin/js/jquery.min.js"></script>
</body>
</html>