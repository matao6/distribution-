<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>添加导航</title>
	<link rel="stylesheet" href="/Public/Admin/css/bootstrap.min.css">
    <link rel="stylesheet" href="/Public/Admin/css/component-min.css">
    <link rel="stylesheet" href="/Public/Admin/css/reset.css">
	<link rel="stylesheet" href="/Public/Admin/css/bootstrap-switch.min.css">    
    <link rel="stylesheet" href="/Public/Admin/css/common.css">
    <link rel="stylesheet" href="/Public/Admin/css/navigaaddhtml.css">
</head>
<body class="body-wrapper">
    <div class="header clearfix">
        <div class="h-left">
            <div class="logo">
                <a href="#">
                    <img src="/Public/Admin/image/logo.png" alt="侨品汇">
                </a>
            </div>
            <div class="text">
                <div class="title">侨品汇</div>
                <div class="des">海外购物平台</div>
            </div>
        </div>
        <div class="h-right clearfix">
            <ul class="nav-wrapper nav-wrapper-hook clearfix">
                 <!-- <li class="right-nav right-nav-hook">
                    <a href="#">test</a>
                </li>    -->
            </ul>
            <div class="user-wrapper">
                <span class="name">test</span>
                <div class="message">
                    <a href="###" class="glyphicon glyphicon-envelope"></a>
                </div>
                <div class="account account-hook">
                    <a href="javascript:;" class="btn btn-primary user">
                        <i class="glyphicon glyphicon-user icon_right"></i>账户
                    </a>
                    <ul class="user-part user-part-hook hide">
                        <li class="exit">
                            <a href="">退出</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="content clearfix">
        <div class="slidebar slidebar-hook">
             <!-- <dl class="bar-wrapper">
                <dt class="list">
                    <i class="glyphicon glyphicon-home"></i>
                    <span>test</span>
                </dt>
                <dd class="list-child list-child-hook">
                    <a href="#">test-child--lalal</a>
                </dd>
            </dl>   -->
        </div>
        <div class="info">
            <h1 class="title">添加导航</h1>
            <div class="form-wrapper">
                <form action="" method="POST" id="adminForm" enctype="multipart/form-data">
                    <div class="m_formPart">
                        <label class="m_label" for="">
                            <span class="red">*</span>导航名称：
                        </label>
                        <div class="form-controls">
                            <input type="text" class="input m_name" name="name">
                        </div>
                    </div>
                    <div class="m_formPart">
                        <label class="m_label" for="">
                            <span class="red">*</span>父级：
                        </label>
                        <div class="form-controls">
                            <select class="select" name="fid">
                                <option value="">--请选择--</option>
                                <?php if(is_array($list)): foreach($list as $key=>$v): ?><option value="<?php echo ($v["id"]); ?>"><?php echo ($v["name"]); ?></option>
                                    <?php if(is_array($v['list'])): foreach($v['list'] as $key=>$vo): ?><option value="<?php echo ($vo["id"]); ?>">--<?php echo ($vo["name"]); ?></option><?php endforeach; endif; endforeach; endif; ?>
                            </select>
                        </div>
                    </div>
                    <div class="m_formPart">
                        <label class="m_label" for="">
                            <span class="red">*</span>URL：
                        </label>
                        <div class="form-controls">
                            <input type="text" class="input" name="url">
                        </div>
                    </div>
                    <div class="m_formPart">
                        <label class="m_label" for="">
                            <span class="red">*</span>权重：
                        </label>
                        <div class="form-controls">
                            <input type="text" class="input" name="sort">
                        </div>
                        <div class="form-controls tit">数字越小排位越靠前</div>
                    </div>
                    <div class="m_formPart">
                        <label class="m_label" for="">
                            <span class="red">*</span>是否导航：
                        </label>
                        <div class="form-controls naviPadding">
                            <label><input type="radio" class="" name="type" value="1" checked>开启</label>
                            <label><input type="radio" class="" name="type" value="0">关闭</label>
                        </div>
                    </div>
                    <div class="m_formPart">
                        <label class="m_label" for="">
                            <span class="red">*</span>状态：
                        </label>
                        <div class="form-controls" style="padding-top: 4px;">
                            <input type="checkbox" name="state" id="state-hook" value="1" checked />
                        </div>
                    </div>
                    <div class="form-controls">
                        <input type="submit" class="btn btn-primary" value="保存">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="footer"></div>

    <script type="text/javascript" src="/Public/Admin/js/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="/Public/Admin/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="/Public/Admin/js/bootstrap-switch.min.js"></script>
	<script type="text/javascript" src="/Public/Admin/js/jquery.validate.min.js"></script>
	<script type="text/javascript" src="/Public/Admin/js/messages_zh.js"></script>
	<script type="text/javascript" src="/Public/Admin/js/jquery.form.js"></script>
	<script type="text/javascript" src="/Public/Admin/js/bootbox.min.js"></script>
	<script type="text/javascript" src="/Public/Admin/js/common.js"></script>
	<script type="text/javascript" src="/Public/Admin/js/navigaaddhtml.js"></script>
</body>
</html>