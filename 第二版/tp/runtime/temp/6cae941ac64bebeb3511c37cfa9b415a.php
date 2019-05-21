<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:67:"F:\php\WWW\tp5\tp\public/../application/admin/view/login/login.html";i:1558354996;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>管理员 - Login</title>
    <meta name="description" content="">
    <meta name="author" content="templatemo">

    <link href='http://fonts.useso.com/css?family=Open+Sans:400,300,400italic,700' rel='stylesheet' type='text/css'>
    <link href="../../../.././vendor/css/font-awesome.min.css" rel="stylesheet">
    <link href="../../../.././vendor/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../../.././vendor/css/templatemo-style.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="light-gray-bg">
<div class="templatemo-content-widget templatemo-login-widget white-bg" style="margin-top:100px">
    <header class="text-center">
        <div class="square"></div>
        <h1>管理员登录</h1>
    </header>
    <form action="http://127.0.0.1:8090/public/index.php/admin/index/login" class="templatemo-login-form" method="post">
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-user fa-fw"></i></div>
                <label for="username"></label>
                <input type="text" class="form-control" value="" id="username" name="username">
            </div>
        </div>
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-key fa-fw"></i></div>
                <label for="password"></label>
                <input type="password" class="form-control" id="password" value="" name="password">
            </div>
        </div>
        <div class="form-group">
            <div class="checkbox squaredTwo">
                <input type="checkbox" id="c1" name="cc" />
                <label for="c1"><span></span>Remember me</label>
            </div>
        </div>
        <div class="form-group">
            <button type="submit" class="templatemo-blue-button width-100">登录</button>
        </div>
    </form>
</div>
<div class="templatemo-content-widget templatemo-login-widget templatemo-register-widget white-bg" style="margin-top:10px">
    <p>bugless 倾情制作 <strong>欢迎指正!</strong></p>
</div>
</body>
</html>