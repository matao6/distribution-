<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>登录页模板</title>
	<link rel="stylesheet" href="/Public/Admin/css/reset.css">
	<link rel="stylesheet" href="/Public/Admin/css/bootstrap.min.css">
	<link rel="stylesheet" href="/Public/Admin/css/login.css">
</head>

<body>
	<div class="logo_box">
		<h3>侨品汇欢迎你</h3>
		<div>
			<div class="input_outer">
				<span class="u_user"></span>
				<input type="text" name="logname" class="text name" placeholder="请输入手机号" autocomplete="off">
			</div>
			<div class="input_outer">
				<span class="us_uer"></span>
				<input type="password" name="logpass" class="text pwd" placeholder="请输入密码" required autocomplete="off">
			</div>
			<div class="input_outer display">
				<span class="check_user"></span>
				<input name="logname" class="text verification" placeholder="请输入验证码" value="" type="text" autocomplete="off">
				<input type="button" class="request" value="获取验证码">
			</div>
			<div class="mb2">
				<input class="act-but submit" id="submit" type="button" value="登录">
				<input class="act-but submit display" id="checkLogin_submit" type="button" value="登录">
			</div>
			<div>
				<input name="savesid" value="0" id="check-box" class="checkbox" type="checkbox"><span>记住用户名</span>
			</div>
		</div>
	</div>

	<script type="text/javascript" src="/Public/Admin/js/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="/Public/Admin/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="/Public/Admin/js/bootbox.min.js"></script>
	<script type="text/javascript" src="/Public/Admin/js/login.js"></script>
</body>

</html>