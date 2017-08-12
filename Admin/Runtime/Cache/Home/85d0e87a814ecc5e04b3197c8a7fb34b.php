<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>权限组</title>
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
            <h1 class="content-right-title">权限组</h1>
            <div class="tables-searchbox">
                <a href="javascript:;" class="btn btn-success add-hook">添加权限组</a>
            </div>
            <table class="wxtables table-hook">
                <colgroup>
                    <col width="10%">
                    <col width="75%">
                    <col width="15%">
                </colgroup>
                <thead>
                    <tr>
                        <td>权限组ID</td>
                        <td>名称</td>
                        <td>操作</td>
                    </tr>
                </thead>
                <tbody>
                <?php if(is_array($group)): foreach($group as $key=>$v): ?><tr>
                        <td><?php echo ($v["id"]); ?></td>
                        <td><?php echo ($v["name"]); ?></td>
                        <td>
                            <a href="javascript:;" class="btn btn-mini btn-primary edit-hook" data-id="<?php echo ($v["id"]); ?>" data-name="<?php echo ($v["name"]); ?>">编辑</a>
                            <a href="javascript:;" class="btn btn-mini btn-danger del-hook" data-id="<?php echo ($v["id"]); ?>" data-name="<?php echo ($v["name"]); ?>">删除</a>
                        </td>
                    </tr><?php endforeach; endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="footer"></div>

    <script type="text/javascript" src="/Public/Admin/js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="/Public/Admin/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/Public/Admin/js/bootbox.min.js"></script>
    <script type="text/javascript" src="/Public/Admin/js/common.js"></script>
    <script type="text/javascript" src="/Public/Admin/js/grouplisthtml.js"></script>
</body>

</html>