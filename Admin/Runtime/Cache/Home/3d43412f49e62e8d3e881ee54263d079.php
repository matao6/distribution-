<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>设置上级</title>
    <link rel="stylesheet" href="/Public/Admin/css/bootstrap.min.css">
    <link rel="stylesheet" href="/Public/Admin/css/bootstrap-datetimepicker.min.css">
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
            <h1 class="content-right-title">设置上级</h1>
            <ul class="info-table mgl15">
                <li class="">
                    <span class="ftblod">微信昵称/手机号码：</span>
                    <span><?php echo ($userinfo['wx_name']); ?>/<?php echo ($userinfo['phone']); ?></span>
                </li>
            </ul>
            <form action="/admin.php/Msuperior/lists" method="get" id="form1">
				<input type="hidden" name="id" id='id' value='<?php echo ($id); ?>'>
				<input type="hidden" name="p" id='p' value=''>
                <div class="tables-searchbox">
                    <input class="input" name="uid" value="<?php echo ($uid); ?>" id="uid" placeholder="姓名/ID" type="text">
                    <input class="input" name="phone" value="<?php echo ($phone); ?>" id="phone" placeholder="手机号码/微信昵称" type="text">
                    <input autocomplete="off" name="start_time" id="start_date" value="" placeholder="注册时间" class="input Wdate" type="text" readonly>
                    <span class="mgr5">至</span>
                    <input autocomplete="off" name="end_time" id="end_date" value="" placeholder="注册时间" class="input Wdate" type="text" readonly>
                    <button class="btn btn-primary"><i class="glyphicon glyphicon-search icon_right"></i>查询</button>
                    <a href="javascript:;" class="btn btn-warning fr" id="top-hook">设为顶级会员</a>
                </div>
            </form>
            <table class="wxtables">
                <colgroup>
                    <col width="12%">
                    <col width="11%">
                    <col width="9%">
                    <col width="10%">
                    <col width="9%">
                    <col width="10%">
                    <col width="35%">
                </colgroup>
                <thead>
                    <tr>
                        <td>微信头像</td>
                        <td>昵称/手机</td>
                        <td>会员等级</td>
                        <td>总消费金额</td>
                        <td>上级</td>
                        <td>注册时间</td>
                        <td>操作</td>
                    </tr>
                </thead>
                <tbody>
					<?php if(is_array($list)): foreach($list as $k=>$val): ?><tr>
							<td>
								<img src="<?php echo ($val['wx_img']); ?>" alt="" width="50" height="50">
							</td>
							<td>
								<p><?php echo ($val['wx_name']); ?></p>
								<p><?php echo ($val['phone']); ?></p>
							</td>
							<td><?php echo ($val['id']); ?></td>
							<td>¥test</td>
							<td>
								<p><?php echo ($val['superior_name']); ?></p>
								<p></p>
							</td>
							<td><?php echo (date('Y-m-d H:i:s',$val["createtime"])); ?></td>
							<td>
								<p>
									<a href="javascript:;" class="btn setHigherUp-hook" dataid="<?php echo ($val['id']); ?>">设为上级</a>
								</p>
							</td>
						</tr><?php endforeach; endif; ?>
                </tbody>
            </table>
			<div class="mgt10">
				<div class="paginate">
					<?php echo ($page); ?>
				</div>
			</div>
        </div>
    </div>
    <div class="footer"></div>

    <script type="text/javascript" src="/Public/Admin/js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="/Public/Admin/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/Public/Admin/js/bootstrap-datetimepicker.js"></script>
    <script type="text/javascript" src="/Public/Admin/js/bootstrap-datetimepicker.zh-CN.js" charset="UTF-8"></script>
    <script type="text/javascript" src="/Public/Admin/js/bootbox.min.js"></script>
    <script type="text/javascript" src="/Public/Admin/js/common.js"></script>
    <script type="text/javascript" src="/Public/Admin/js/Msuperiorlists.js"></script>
</body>

</html>
<script type="text/javascript">
<!--
	$('#sele').click(function(){
			var page = parseInt($('#page').val());
			var last = parseInt($('#last').val());
			if (page > last){ alert('超出总页数'); return false; }
			$('#p').val($('#page').val());
			$('#form1').submit();
	});

	function keyPress(ob) {
		if (!ob.value.match(/^[\+\-]?\d*?\.?\d*?$/)){
			ob.value = '';
		}else{
			ob.t_value = ob.value;
		}
		if (ob.value.match(/^(?:[\+\-]?\d+(?:\.\d+)?)?$/)) ob.o_value = ob.value;
	}
//-->
</script>