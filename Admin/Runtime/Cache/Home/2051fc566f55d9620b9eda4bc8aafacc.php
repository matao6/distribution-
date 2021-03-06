<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>用户列表</title>
    <link rel="stylesheet" href="/Public/Admin/css/bootstrap.min.css">
    <link rel="stylesheet" href="/Public/Admin/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" href="/Public/Admin/css/component-min.css">
    <link rel="stylesheet" href="/Public/Admin/css/reset.css">
    <link rel="stylesheet" href="/Public/Admin/css/common.css">
    <link rel="stylesheet" href="/Public/Admin/css/lists.css">
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
                </li> -->
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
            </dl> -->
        </div>
        <div class="info">
            <h1 class="title">会员列表</h1>
            <div class="nowHasUser alert alert-info disable-del">
                目前拥有 <span class="amount">test</span> 名会员
                <div class="removeParent glyphicon glyphicon-remove"></div>
            </div>
            <div class="form-wrapper">
                <form action="/admin.php/Members/lists" method="get" id="form1">
					<input type="hidden" name="p" id='p' value=''>
                    <div class="table-searchbox-v2 mgb10">
                        <div class="row clearfix">
                            <div class="col">
                                <span class="tbs-txt">姓名/ID：</span>
                                <input type="text" class="input" name="uid" id="uid" value="<?php echo ($uid); ?>">
                            </div>
                            <div class="col">
                                <span class="tbs-txt">所属分组：</span>
                                <select name="group" id="group" class="select">
									<option value=''>--请选择--</option>
                                    <?php if(is_array($group_list)): foreach($group_list as $k=>$v): ?><option value="<?php echo ($v['id']); ?>" <?php if($group == $v['id']): ?>selected<?php endif; ?>><?php echo ($v['title']); ?></option><?php endforeach; endif; ?>
                                </select>
                            </div>
                            <div class="col">
                                <span class="tbs-txt">所属等级：</span>
                                <select name="" id="" class="select">
                                    <option value="">test</option>
                                </select>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col">
                                <span class="tbs-txt">昵称/手机：</span>
                                <input class="input" name="phone" id="phone" value="<?php echo ($phone); ?>" type="text">
                            </div>
                            <div class="col">
                                <span class="tbs-txt">所属省市：</span>
                                <select name="" id="" class="J_province slect_province select mini"></select>
                                <select name="" id="" class="select mini s_city"></select>
                            </div>
                            <div class="col">
                                <span class="tbs-txt">会员状态：</span>
                                <select name="" class="select">
                                    <option value=''>--请选择--</option>
                                </select>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col">
                                <span class="tbs-txt">排序：</span>
                                <select name="sort_type" id="sort_type" class="select">
									<option value=''>--请选择--</option>
									<?php if(is_array($sort_type)): foreach($sort_type as $k=>$v): ?><option value="<?php echo ($k); ?>" <?php if($sort == $k): ?>selected<?php endif; ?>><?php echo ($v); ?></option><?php endforeach; endif; ?>
								</select>
                            </div>
                            <div class="col col-2">
                                <span class="tbs-txt">注册时间：</span>
                                <input name="starttime" placeholder="开始时间" size="16" id="start_date" class="input mini" type="text" autocomplete="off" value="<?php echo ($starttime); ?>">
                                <input name="endtime" placeholder="结束时间" id="end_date" class="input mini" type="text" autocomplete="off" value="<?php echo ($endtime); ?>">
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col">
                                <span class="tbs-txt"></span>
                                <button type="button" class="btn btn-primary" id="sub">
                                    <i class="glyphicon glyphicon-search icon_right"></i>查询
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
                <table class="wxtables">
                    <colgroup>
                        <col width="1%">
                        <col width="6%">
                        <col width="20%">
                        <col width="17%">
                        <col width="17%">
                        <col width="39%">
                    </colgroup>
                    <thead>
                        <tr>
                            <td></td>
                            <td>会员</td>
                            <td></td>
                            <td>统计</td>
                            <td>下级会员数</td>
                            <td>操作</td>
                        </tr>
                    </thead>
                    <tbody>
						<?php if(is_array($list)): foreach($list as $k=>$val): ?><tr>
								<td>
									<input type="checkbox" name="checkbox" class="checkbox-hook" value="<?php echo ($val['id']); ?>">
								</td>
								<td>
									<img src="<?php echo ($val['app_img']); ?>" alt="" width="60" height="60" style="vertical-align: top;">
								</td>
								<td>
									<p>id：<?php echo ($val['id']); ?></p>
									<p>编号：<?php echo ($val['number']); ?></p>
									<?php if($val['phone'] != ''): ?><p>账号/手机：<?php echo ($val['phone']); ?></p><?php endif; ?>
									<?php if($val['realname'] != ''): ?><p>姓名：<?php echo ($val['realname']); ?><img src="" alt=""></p><?php endif; ?>
									<p>昵称：<?php echo ($val['username']); ?></p>
									<p>等级：暂无数据</p>
									<p>注册时间：<?php echo (date('Y-m-d H:i:s',$val["createtime"])); ?></p>
									<?php if($val['superior_id'] != '0'): ?><p>上级：<?php echo ($val["superior_name"]); ?></p><?php endif; ?>
								</td>
								<td>
									<p>消费：￥<span>0.00</span></p>
									<p>余额：￥<span><?php echo ($val['account_balance']); ?></span></p>
									<p>积分：<span><?php echo ($val['integral']); ?></span></p>
								</td>
								<td>0</td>
								<td>
									<a href="/admin.php/Members/info/id/<?php echo ($val['id']); ?>" class="btn btn-mini btn-primary" target="blank">详情</a>
									<a href="javascript:;" class="btn btn-mini btn-primary listsEdit-hook" dataid="<?php echo ($val['id']); ?>">编辑</a>
									<a href="javascript:;" class="btn btn-mini btn-danger listsDelete-hook" dataid="<?php echo ($val['id']); ?>">删除</a>
									<a href="javascript:;" class="btn btn-mini btn-primary setFenBusiness-hook">设为分销商</a>
									<a href="javascript:;" class="btn btn-mini btn-primary setGrade-hook">设等级</a>
									<a href="javascript:;" class="btn btn-mini btn-warning setIntegral-hook" dataid="<?php echo ($val['id']); ?>">调整积分</a>
									<a href="/admin.php/Msuperior/lists/id/<?php echo ($val['id']); ?>" class="btn btn-mini btn-warning">设置上级</a>
									<a href="javascript:;" class="btn btn-mini btn-warning setBalance-hook" dataid="<?php echo ($val['id']); ?>">调整余额</a>
									<a href="javascript:;" class="btn btn-mini btn-warning sendDiscounts-hook">发放优惠券</a>
									<a href="javascript:;" class="btn btn-mini btn-success sendMoney-hook">发红包</a>
									<a href="javascript:;" class="btn btn-mini btn-success resetPassword-hook" dataid="<?php echo ($val['id']); ?>">重置支付密码</a>
									<a href="javascript:;" class="btn btn-mini btn-success sendMessage-hook">发送站内信</a>
									<a href="javascript:;" class="btn btn-mini btn-success">导出全部下级</a>
								</td>
							</tr><?php endforeach; endif; ?>
                    </tbody>
                </table>
                <div class="controlTable">
                    <a href="javascript:;" class="btn btn-primary selectAll-hook">全选</a>
                    <a href="javascript:;" class="btn btn-primary cancelAll-hook">取消</a>
                    <a href="javascript:;" class="btn btn-warning setManyGrade-hook">设置等级</a>
					<a href="javascript:;" class="btn btn-warning setManyGrade-group">设置分组</a>
                </div>
                <div class="mgt10">
                    <div class="paginate">
						<?php echo ($page); ?>
						<!--
                        <a href="javascript:;" class="prev disabled"></a>
                        <a class="cur">1</a>
                        <a href="/User/lists/p/2.html">2</a>
                        <a href="/User/lists/p/3.html">3</a>
                        <a href="/User/lists/p/4.html">4</a><span class="dotted mgr5 mgl5">...</span>
                        <a href="/User/lists/p/170.html">170</a>
                        <a href="/User/lists/p/2.html" class="next"></a>
                        <span class="mgr5 mgl5">到</span>
                        <input class="" type="text">
                        <a href="" class="goto">确定</a>
                        <span class="mgr5">页</span>
						-->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer"></div>

    <script type="text/javascript" src="/Public/Admin/js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="/Public/Admin/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/Public/Admin/js/bootstrap-datetimepicker.js"></script>
    <script type="text/javascript" src="/Public/Admin/js/bootstrap-datetimepicker.zh-CN.js" charset="UTF-8"></script>
    <script type="text/javascript" src="/Public/Admin/js/jquery.validate.min.js"></script>
    <script type="text/javascript" src="/Public/Admin/js/messages_zh.js"></script>
    <script type="text/javascript" src="/Public/Admin/js/jquery.form.js"></script>
    <script type="text/javascript" src="/Public/Admin/js/bootbox.min.js"></script>
    <script type="text/javascript" src="/Public/Admin/js/common.js"></script>
    <script type="text/javascript" src="/Public/Admin/js/lists.js"></script>
</body>
<script type="text/javascript">
<!--
	$('#sub').click(function(){
			$('#form1').submit();
	});
	
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
</html>