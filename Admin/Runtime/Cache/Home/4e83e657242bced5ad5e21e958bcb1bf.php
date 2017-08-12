<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>导航列表</title>
	<link rel="stylesheet" href="/Public/Admin/css/bootstrap.min.css">
    <link rel="stylesheet" href="/Public/Admin/css/component-min.css">
	<link rel="stylesheet" href="/Public/Admin/css/reset.css">
    <link rel="stylesheet" href="/Public/Admin/css/common.css">
    <link rel="stylesheet" href="/Public/Admin/css/navigalisthtml.css">
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
            <div class="title">
                <p class="text content-right-title">导航设置</p>
            </div>
            <div class="add">
                <a href="javascript:;" class="btn btn-primary add_naviga-hook">添加导航</a>
            </div>
            <div class="search">
                <form action="" method="post">
                    <!-- <select class="select">
                        <option value="test">test</option>
                    </select> -->
                    <input type="text" class="input navigaName-hook" placeholder="导航名称">
                    <button type="button" class="btn btn-default search-hook">
                        <i class="glyphicon glyphicon-search icon_right"></i>查询
                    </button>
                </form>
            </div>
            <div class="infomation">
                <table class="wxtables mgt15 table-hook">
                     <thead>
                        <tr>
                            <td>导航名称</td>
                            <td></td>
                            <td></td>
                            <td>状态</td>
                            <td>操作</td>
                        </tr> 
                    </thead> 
                    <tbody>
                        <?php if(is_array($naviga)): foreach($naviga as $key=>$v): ?><tr>
                                <td><?php echo ($v["name"]); ?></td>
                                <td></td>
                                <td></td>
                                <?php if($v["state"] == 1 ): ?><td>正常</td>
                                    <?php else: ?>
                                    <td>禁用</td><?php endif; ?>
                                <td>
                                    <a href="javascript:;" data-id="<?php echo ($v["id"]); ?>" class="btn btn-mini btn-primary edit-hook">编辑</a>
                                    <?php if($v["state"] == 1 ): ?><a href="javascript:;" data-id="<?php echo ($v["id"]); ?>" class="btn btn-mini btn-danger Unuse-hook">禁用</a>
                                        <?php else: ?>
                                        <a href="javascript:;" data-id="<?php echo ($v["id"]); ?>" class="btn btn-mini btn-danger use-hook">启用</a><?php endif; ?>
                                </td>
                            </tr>
                            <?php if(is_array($v['list'])): foreach($v['list'] as $key=>$va): ?><tr>
                                    <td></td>
                                    <td><?php echo ($va["name"]); ?></td>
                                    <td></td>
                                    <?php if($va["state"] == 1 ): ?><td>正常</td>
                                        <?php else: ?>
                                        <td>禁用</td><?php endif; ?>
                                    <td>
                                        <a href="javascript:;" data-id="<?php echo ($va["id"]); ?>" class="btn btn-mini btn-primary edit-hook">编辑</a>
                                        <?php if($va["state"] == 1 ): ?><a href="javascript:;" data-id="<?php echo ($va["id"]); ?>" class="btn btn-mini btn-danger Unuse-hook">禁用</a>
                                            <?php else: ?>
                                            <a href="javascript:;" data-id="<?php echo ($va["id"]); ?>" class="btn btn-mini btn-danger use-hook">启用</a><?php endif; ?>
                                    </td>
                                </tr>
                                <?php if(is_array($va['list'])): foreach($va['list'] as $key=>$val): ?><tr>
                                        <td></td>
                                        <td></td>
                                        <td><?php echo ($val["name"]); ?></td>
                                        <?php if($val["state"] == 1 ): ?><td>正常</td>
                                            <?php else: ?>
                                            <td>禁用</td><?php endif; ?>
                                        <td>
                                            <a href="javascript:;" data-id="<?php echo ($val["id"]); ?>"  class="btn btn-mini btn-primary edit-hook">编辑</a>
                                            <?php if($val["state"] == 1 ): ?><a href="javascript:;" data-id="<?php echo ($val["id"]); ?>" class="btn btn-mini btn-danger Unuse-hook">禁用</a>
                                                <?php else: ?>
                                                <a href="javascript:;" data-id="<?php echo ($val["id"]); ?>" class="btn btn-mini btn-danger use-hook">启用</a><?php endif; ?>
                                        </td>
                                    </tr><?php endforeach; endif; endforeach; endif; endforeach; endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="footer"></div>

    <script type="text/javascript" src="/Public/Admin/js/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="/Public/Admin/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="/Public/Admin/js/bootbox.min.js"></script>
	<script type="text/javascript" src="/Public/Admin/js/common.js"></script>
	<script type="text/javascript" src="/Public/Admin/js/navigalisthtml.js"></script>
</body>
</html>