<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>会员分组列表</title>
    <link rel="stylesheet" href="/Public/Admin/css/bootstrap.min.css">
    <link rel="stylesheet" href="/Public/Admin/css/component-min.css">
    <link rel="stylesheet" href="/Public/Admin/css/reset.css">
    <link rel="stylesheet" href="/Public/Admin/css/common.css">
    <link rel="stylesheet" href="/Public/Admin/css/groupLists.css">
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
                            <a href="http://fenxiao.qphvip.com/admin.php/Login/DelUser">退出</a>
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
            <h1 class="content-right-title">会员分组列表</h1>
            <div class="clearfix" style="height: 50px;">
                <a href="javascript:;" class="btn btn-success fl newGroup-hook">新建分组</a>
				<form action="/admin.php/Mgroup/lists" method="get" id="form1">
					<div class="tables-searchbox fr">
						<input placeholder="分组名称" class="input" name="title" value="<?php echo ($title); ?>" type="text">
						<button class="btn" id="sub"><i class="glyphicon glyphicon-search"></i>查询</button>
					</div>
				</form>
            </div>
            <table class="wxtables mgt15">
                <colgroup>
                    <col width="2%">
                    <col width="38%">
                    <col width="35%">
                    <col width="16%">
                </colgroup>
                <thead>
                    <tr>
                        <td><i class="glyphicon glyphicon-check"></i></td>
                        <td>分组名称</td>
                        <td>会员数量</td>
                        <td>操作</td>
                    </tr>
                </thead>
                <tbody>
					<?php if(is_array($list)): foreach($list as $k=>$val): ?><tr>
							<td>
								<input class="checkbox table-ckbs checkbox-hook" type="checkbox" name="checkbox" value="<?php echo ($val['id']); ?>">
							</td>
							<td><?php echo ($val['title']); ?></td>
							<td><?php echo ($val['cn']); ?></td>
							<td>
								<a href="javascript:;" class="btn btn-mini btn-primary edit-hook" title="编辑" dataid="<?php echo ($val['id']); ?>">编辑</a>
								<a href="javascript:;" class="btn btn-mini btn-danger del-hook" title="删除" dataid="<?php echo ($val['id']); ?>">删除</a>
								<a href="javascript:;" class="btn btn-mini btn-success syncWeixin-hook" title="同步微信">同步微信</a>
							</td>
						</tr><?php endforeach; endif; ?>
                </tbody>
            </table>
            <div class="tables-btmctrl clearfix">
                <div class="fl">
                    <a href="javascript:;" class="btn btn-primary selectAll-hook">全选</a>
                    <a href="javascript:;" class="btn btn-primary cancelAll-hook">取消</a>
                    <a href="javascript:;" class="btn btn-primary delAll-hook">批量删除</a> 
                </div>
            </div>
        </div>
    </div>
    <div class="footer"></div>

    <script type="text/javascript" src="/Public/Admin/js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="/Public/Admin/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/Public/Admin/js/bootbox.min.js"></script>
    <script type="text/javascript" src="/Public/Admin/js/common.js"></script>
    <script type="text/javascript" src="/Public/Admin/js/groupLists.js"></script>
</body>

</html>
<script type="text/javascript">
<!--
	$('#sub').click(function(){
			$('#form1').submit();
	});
//-->
</script>