<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:74:"F:\php\WWW\tp5\tp\public/../application/index/view/logandreg/register.html";i:1558100384;}*/ ?>
﻿<!DOCTYPE html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<link rel="stylesheet" href="../../../.././vendor/csslog/bootstrap.css" />
		<link rel="stylesheet" href="../../../.././vendor/csslog/register.css" />
		<script type="text/javascript" src="../../../.././vendor/js/jquery-1.9.1.js" ></script>
		<script type="text/javascript" src="../../../.././vendor/js/bootstrap.js" ></script>
		<script type="text/javascript" src="../../../.././vendor/js/templet.js" ></script>
		<script type="text/javascript"	src="../../../.././vendor/js/check.js"></script>
		<title></title>

	</head>
	<body>
	<div id="main">
		<nav class=" navbar-inverse" id="daohang">
				<div class="daohang">
					<div class="navbar-header clearfix">
					</div>
					<div class="collapse navbar-collapse" id="daohangtiao">

					</div>						
				</div>
				<div id="box">
					<div class="box1 col-sm-2 col-xs-2">
					</div>
					<div class="box2 col-sm-10 col-xs-10" >
						<ul id="ul1" class="clearfix">

						</ul>
						<div id="wd1">
							<ul>

							</ul>
						</div>
						<div id="gy1" >
							<ul id="ul2">

							</ul>
						</div>
						<div id="gc" >
							<ul >

							</ul>
						</div>
					</div>
				</div>
			</nav>
		<br><br><br>
		<div class="main">
			<div class="container  ">
				<div class="c2">
					<a href=""></a><span>
						<img src="../../../.././vendor/img/qifeiye.png" />
					</span></a>
					<p>欢迎注册在线刷题神器</p>
				</div>
				<div class="c3">
					<form method="post" action="http://127.0.0.1:8090/public/index.php/index/index/checkregister" onsubmit="return checksubs();">
						<div class="form-group">
    						<label for="username">用户名 *</label>
    						<input type="text" class="form-control" id="username" name="username" value="">
    						<span class="pp hide">此项必须填写</span>
  						</div>
  						<div class="form-group">
    						<label for="password">密码 <img class="help" src="../../../.././vendor/img/help.png" title="最少8位"/>*</label>
    						<input type="password" class="form-control" id="password" name="password" value="">
  							<span class="pp hide">此项必须填写</span>
  						</div>
  						<div class="form-group">
    						<label for="password">再次输入密码 </label>
    						<input type="password" class="form-control" id="password2" value="">
  						</div>
  						<div class="form-group">
							<label for="email">邮箱 *</label>
							<input type="text" class="form-control" id="email" name="email" value="">
							<span class="pp hide">此项必须填写</span>
  						</div>
						<div class="form-group">
							<label for="phone">电话号码 *</label>
							<input type="text" class="form-control" id="phone" name="phone" value="">
							<span class="pp hide">此项必须填写</span>
						</div>
						<div class="form-group">
							<label for="school">学校 *</label>
							<input type="text" class="form-control" id="school" name="school" value="">
							<span class="pp hide">此项必须填写</span>
						</div>
  						<div class="checkbox">
    						<label>
     		 					<input type="checkbox"> 我已经阅读并同意<a>服务条款</a>以及<a>法律声明</a>。我不会创建含有低俗内容及有碍社会安定内容的网站。
    						</label>
  						</div>
  						<div class="c3-1">
							<button type="submit" class="btn btn-default btn1">注册</button>  
							<a href="http://127.0.0.1:8090/public/index.php" type="button" class="btn btn-default btn2">已经有账号了?请登录</a>
						</div>
						<div class="c3-2 clearfix">

						</div>
					</form>
				</div>
			</div>
		</div>
		<ul class="cbl" >
			<li><a href="#">
				<div class="icon d1"><i class="i1"></i><span class="title"></span></div>
			</a></li>
			<i class="clearfix"></i>
			<li><a href="#">
				<div class="icon d2"><i class="i2"></i><span class="title"></span></div>
			</a></li>
			<i class="clearfix"></i>
			<li><a  href="#">
				<div class="icon"><i class="i3"></i><span class="title"></span></div>
			</a></li>
			<i class="clearfix"></i>
			<li ><a  href="#">
			</a></li>
		</ul>
	</div>
	</body>
	<script type="text/javascript" src="../../../.././vendor/js/hp.js" ></script>
	<script type="text/javascript">
		/*$(function(){
			$("#dhbtn1").click(function(){
			//	console.log(1);
				$(".dhkuang").show();
				$(".dhneirong").animate("left","679px")
			})
		})*/
	</script>
	
</html>
