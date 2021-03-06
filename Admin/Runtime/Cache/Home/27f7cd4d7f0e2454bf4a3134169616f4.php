<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>首页</title>
	<link rel="stylesheet" href="/Public/Admin/css/bootstrap.min.css">
    <link rel="stylesheet" href="/Public/Admin/css/component-min.css">
	<link rel="stylesheet" href="/Public/Admin/css/reset.css">
    <link rel="stylesheet" href="/Public/Admin/css/common.css">
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
            <h1 class="content-right-title">会员等级</h1>
            <form action="" method="post">
                <div class="mgb10">
                    <label>升级条件：</label>
                    <label><input name="is_rank_upgrade_status" type="radio" value="1" checked="checked"> 已付款金额</label>　　
                    <label><input name="is_rank_upgrade_status" type="radio" value="0"> 交易完成金额</label>
                    &nbsp;&nbsp;<span><input type="submit" class="btn btn-primary j-exchange" value="保存"></span>
                </div>
            </form>
            <div>
                <a href="javascript:;" class="btn btn-success addLevel-hook">添加会员等级</a>
            </div>
            <table class="wxtables mgt15">
                    <colgroup>
                        <col width="20%">
                        <col width="15%">
                        <col width="15%">
                        <col width="15%">
                        <col width="22%">
                        <col width="13%">
                    </colgroup>
                    <thead>
                        <tr>
                            <td>等级名称</td>
                            <td>交易额</td>
                            <td>或 交易次数</td>
                            <td>会员折扣</td>
                            <td>会员数量</td>
                            <td>操作</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>test</td>
                            <td>test</td>
                            <td>test</td>
                            <td>test</td>
                            <td>test</td>
                            <td>
                                <a href="javascript:;" class="btn btn-mini btn-primary edit-hook">编辑</a>
                                <a href="javascript:;" class="btn btn-mini btn-danger del-hook">删除</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
        </div>
    </div>
    <div class="footer"></div>

    <script type="text/javascript" src="/Public/Admin/js/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="/Public/Admin/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="/Public/Admin/js/bootbox.min.js"></script>
	<script type="text/javascript" src="/Public/Admin/js/common.js"></script>
	<script type="text/javascript" src="/Public/Admin/js/membershiplevel.js"></script>
</body>
</html>