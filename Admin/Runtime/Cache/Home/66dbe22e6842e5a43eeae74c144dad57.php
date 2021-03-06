<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>用户详情</title>
    <link rel="stylesheet" href="/Public/Admin/css/bootstrap.min.css">
    <link rel="stylesheet" href="/Public/Admin/css/component-min.css">
    <link rel="stylesheet" href="/Public/Admin/css/reset.css">
    <link rel="stylesheet" href="/Public/Admin/css/common.css">
    <link rel="stylesheet" href="/Public/Admin/css/info.css">
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
            <h1 class="content-right-title">订货商详情</h1>
            <div class="personInfo">
                <ul class="info-dis mgl15 info-table">
                    <li class="lang widthAuto">
                        <span class="ftblod"> 收货地址：</span>
                        <div class="addAddress-hook">
                            <div>添加地址~消费啊~消费</div>
                            <div class="togg" style="display: none;">
                                <div>添加地址~消费啊~消费</div>
                                <div>添加地址~消费啊~消费</div>
                            </div>
                            <a href="javascript:;" class="glyphicon glyphicon-menu-down down-hook"></a>
                        </div>
                    </li>
                </ul>
                <ul class="info-dis mgl15 info-table">
                    <li class="fl">
                        <span class="ftblod">ID：</span><?php echo ($info['id']); ?>
                    </li>
                    <li class="fl">
                        <span class="ftblod">姓名：</span><?php echo ($info['realname']); ?>
                    </li>
                    <li class="fl">
                        <span class="ftblod">手机号码：</span><?php echo ($info['phone']); ?>
                    </li>
                    <li class="fl">
                        <span class="ftblod">微信昵称：</span><?php echo ($wxinfo['wx_name']); ?>
                    </li>
                    <li class="fl">
                        <span class="ftblod">生日：</span><?php echo ($info['birthday']); ?>
                    </li>
                    <li class="fl">
                        <span class="ftblod">直属上级：</span>
                    </li>
                    <li class="fl">
                        <span class="ftblod">账户余额：</span><?php echo ($info['account_balance']); ?>
                    </li>
                    <li class="fl">
                        <span class="ftblod">创建时间：</span><?php echo (date('Y-m-d H:i:s',$info['createtime'])); ?>
                    </li>
                    <li class="fl">
                        <span class="ftblod">备注：</span><?php echo ($info['note']); ?>
                    </li>
                </ul>
                <ul class="info-dis mgl15 info-table">
                    <li class="lang">
                        <span class="ftblod">微信OpenID：</span><?php echo ($wxinfo['openid']); ?>
                    </li>
                </ul>
                <ul class="info-dis mgl15 info-table">
                    <li class="lang">
                        <span class="ftblod">用户等级：</span>
                    </li>
                </ul>
                <ul class="info-dis mgl15 info-table">
                    <li class="lang">
                        <span class="ftblod">来源链接：</span>
                    </li>
                </ul>
            </div>
            <div class="tabs clearfix mgt10">
                <a href="javascript:;" class="active tabs_a fl">消费能力</a>
                <a href="javascript:;" class="tabs_a fl">积分明细</a>
                <a href="javascript:;" class="tabs_a fl">签到记录</a>
                <a href="javascript:;" class="tabs_a fl">持有的优惠券</a>
                <a href="javascript:;" class="tabs_a fl">余额变动记录</a>
                <a href="javascript:;" class="tabs_a fl">佣金记录</a>
            </div>
            <div class="tabs-content" data-origin="user">
                <!--消费能力 -->
                <div class="tc">
                    <table class="wxtables data">
                        <colgroup>
                            <col width="25%">
                            <col width="25%">
                            <col width="25%">
                            <col width="25%">
                        </colgroup>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="dataItems">总计订单（笔）</div>
                                    <div class="dataItems">
                                        <span class="num1">0</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="dataItems">总消费金额（元）</div>
                                    <div class="dataItems">
                                        <span class="num1">¥0.00</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="dataItems">本月订单（笔）</div>
                                    <div class="dataItems">
                                        <span class="num1">0</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="dataItems">本月消费金额（元）</div>
                                    <div class="dataItems">
                                        <span class="num1">¥0.00</span>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <table class="wxtables mgt15" id="j-table-order">
                        <colgroup>
                            <col width="16%">
                            <col width="16%">
                            <col width="16%">
                            <col width="16%">
                            <col width="16%">
                            <col width="20%">
                        </colgroup>
                        <thead>
                            <tr>
                                <td>订单编号</td>
                                <td>收货人</td>
                                <td>商品数量</td>
                                <td>商品总价</td>
                                <td>实付金额</td>
                                <td>交易完成时间</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="txtCenter" colspan="6">暂无数据</td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="mgt10">
                        <div class="paginate">
                            <a href="javascript:;" class="prev disabled"></a>
                            <a class="cur">1</a>
                            <a href="">2</a>
                            <a href="">3</a>
                            <a href="">4</a>
                            <span class="dotted mgr5 mgl5">...</span>
                            <a href="">122</a>
                            <a href="" class="next"></a>
                            <span class="mgr5">页</span>
                        </div>
                    </div>
                </div>

                <!-- 积分明细 -->
                <div class="tc hide">
                    <table class="wxtables mgt15" id="j-table-point">
                        <colgroup>
                            <col width="25%">
                            <col width="12%">
                            <col width="12%">
                            <col width="12%">
                            <col width="17%">
                            <col width="22%">
                        </colgroup>
                        <thead>
                            <tr>
                                <td class="txtCenter">来源/用途</td>
                                <td class="txtCenter">积分变化前</td>
                                <td class="txtCenter">积分变化</td>
                                <td class="txtCenter">积分变化后</td>
                                <td class="txtCenter">日期</td>
                                <td class="txtCenter">备注</td>
                            </tr>
                        </thead>
                        <tbody id="integral_lists">
                        </tbody>
                    </table>

                    <div class="mgt10">
                        <div style="float:right;" id="integral_ul_lists">
                        </div>
                    </div>
                </div>

                <!-- 签到记录 -->
                <div class="tc hide">
                    <table class="wxtables mgt15" id="j-table-checkin">
                        <colgroup>
                            <col width="25%">
                            <col width="25%">
                            <col width="25%">
                            <col width="25%">
                        </colgroup>
                        <thead>
                            <tr>
                                <td class="txtCenter" >动作</td>
                                <td class="txtCenter" >获得积分</td>
                                <td class="txtCenter" >额外获得积分</td>
                                <td class="txtCenter" >签到时间</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="txtCenter" >暂无数据</td>
								<td class="txtCenter" >暂无数据</td>
								<td class="txtCenter">暂无数据</td>
								<td class="txtCenter">暂无数据</td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="mgt10">
                        <div class="paginate">
                            <a href="javascript:;" class="prev disabled"></a>
                            <a class="cur">1</a>
                            <a href="">2</a>
                            <a href="">3</a>
                            <a href="">4</a>
                            <span class="dotted mgr5 mgl5">...</span>
                            <a href="">122</a>
                            <a href="" class="next"></a>
                            <span class="mgr5">页</span>
                        </div>
                    </div>
                </div>

                <!-- 持有的优惠券 -->
                <div class="tc hide">
                    <table class="wxtables" id="j-table-coupon">
                        <colgroup>
                            <col width="20%">
                            <col width="10%">
                            <col width="10%">
                            <col width="35%">
                            <col width="15%">
                            <col width="10%">
                        </colgroup>
                        <thead>
                            <tr>
                                <td>优惠券名称</td>
                                <td>面值</td>
                                <td>所需积分</td>
                                <td>有效期</td>
                                <td>兑换时间</td>
                                <td>操作</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="txtCenter" colspan="6">暂无数据</td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="mgt10">
                        <div class="paginate">
                            <a href="javascript:;" class="prev disabled"></a>
                            <a class="cur">1</a>
                            <a href="">2</a>
                            <a href="">3</a>
                            <a href="">4</a>
                            <span class="dotted mgr5 mgl5">...</span>
                            <a href="">122</a>
                            <a href="" class="next"></a>
                            <span class="mgr5">页</span>
                        </div>
                    </div>
                </div>

                <!-- 余额变动记录 -->
                <div class="tc hide">
                    <table class="wxtables" id="j-table-balance">
                        <colgroup>
                            <col width="20%">
                            <col width="10%">
                            <col width="10%">
                            <col width="30%">
                            <col width="20%">
                            <col width="10%">
                        </colgroup>
                        <thead>
                            <tr>
                                <td class="txtCenter">变动前</td>
                                <td class="txtCenter">变动金额</td>
                                <td class="txtCenter">变动后</td>
                                <td class="txtCenter">类型</td>
                                <td class="txtCenter">创建时间</td>
                                <td class="txtCenter">备注</td>
                            </tr>
                        </thead>
                        <tbody id="money_lists">
                        </tbody>
                    </table>

                    <div class="mgt10">
                        <div style="float:right;" id="money_ul_lists">
                        </div>
                    </div>
                </div>

                <!-- 佣金记录 -->
                <div class="tc hide">
                    <table class="wxtables" id="">
                        <colgroup>
                            <col width="20%">
                            <col width="10%">
                            <col width="10%">
                            <col width="30%">
                            <col width="20%">
                            <col width="10%">
                        </colgroup>
                        <thead>
                            <tr>
                                <td>佣金记录</td>
                                <td>佣金记录</td>
                                <td>佣金记录</td>
                                <td>佣金记录</td>
                                <td>佣金记录</td>
                                <td>佣金记录</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="txtCenter" colspan="5">暂无数据</td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="mgt10">
                        <div class="paginate">
                            <a href="javascript:;" class="prev disabled"></a>
                            <a class="cur">1</a>
                            <a href="">2</a>
                            <a href="">3</a>
                            <a href="">4</a>
                            <span class="dotted mgr5 mgl5">...</span>
                            <a href="">122</a>
                            <a href="" class="next"></a>
                            <span class="mgr5">页</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer"></div>

    <script type="text/javascript" src="/Public/Admin/js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="/Public/Admin/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/Public/Admin/js/bootbox.min.js"></script>
    <script type="text/javascript" src="/Public/Admin/js/common.js"></script>
    <script type="text/javascript" src="/Public/Admin/js/info.js"></script>
</body>

</html>
<script type="text/javascript">
<!--
	var url = 'http://fenxiao.qphvip.com/admin.php/';
	var page_cur = 1; 
	var total_num, page_size, page_total_num;
	var uid = "<?php echo ($info['id']); ?>";
	function getIntegralLog(page) {
		$.ajax({ 
			type: 'GET', 
			url: url+'Members/getIntegralLog', 
			data: { 'page': page - 1 ,uid:uid}, 
			success: function(data) {
				$("#integral_lists").empty(); 
				datas = JSON.parse(data);
				total_num = datas.total_num; //总记录数 
				page_size = datas.page_size; //每页数量 
				page_cur = page; //当前页 
				page_total_num = datas.page_total_num; //总页数 
				var li = ""; 
				var list = datas.list; 
				$.each(list, 
				function(index, array) {
						var cla = 'txtCenter red';
						var str = array['change'].substring(0,1);
						if (str != '-'){
							array['change'] = '+'+array['change'];
						}else{
							cla = 'txtCenter green';
						}
						li += '<tr><td class="txtCenter" >'+array['types']+'</td><td class="txtCenter" >'+array['original']+'</td><td class="'+cla+'">'+array['change']+'</td><td class="txtCenter" >'+array['last']+'</td><td class="txtCenter" >'+array['createtime']+'</td><td class="txtCenter" >'+array['note']+'</td></tr>';
				}); 
				$("#integral_lists").append(li); 
			}, 
			complete: function() { 
				getIntegralPage(); //js生成分页，可用程序代替 
			}, 
			error: function() { 
				alert("数据异常,请检查是否json格式"); 
			} 
		}); 
	}

	function getIntegralPage() {
		if (page_cur > page_total_num) page_cur = page_total_num; //当前页大于最大页数 
		if (page_cur < 1) page_cur = 1; //当前页小于1 
		page_str = "<span>共" + total_num + "条</span><span>" + page_cur + "/" + page_total_num + "</span>"; 
		if (page_cur == 1) { //若是第一页 
			page_str += "&nbsp;<span>首页</span>&nbsp;<span>上一页</span>"; 
		} else { 
			page_str += "&nbsp;<span><a href='javascript:void(0)' data-page='1'>首页</a></span>&nbsp;<span><a href='javascript:void(0)' data-page='" + (page_cur - 1) + "'>上一页</a></span>"; 
		} 
		if (page_cur >= page_total_num) { //若是最后页 
			page_str += "&nbsp;<span>下一页</span>&nbsp;<span>尾页</span>"; 
		} else { 
			page_str += "&nbsp;<span><a href='javascript:void(0)' data-page='" + (parseInt(page_cur) + 1) + "'>下一页</a></span>&nbsp;<span><a href='javascript:void(0)' data-page='" + page_total_num + "'>尾页</a></span>"; 
		} 
		$("#integral_ul_lists").html(page_str); 
	}
	$("#integral_ul_lists").on('click', 'a',function() {
		var page = $(this).attr("data-page");
		getIntegralLog(page);
	});
	getIntegralLog(1);

	var money_page = 1; 
	var money_total_num, money_page_size, money_page_total_num;
	function getMondyLog(page) {
		$.ajax({ 
			type: 'GET', 
			url: url+'Members/getMoneyLog', 
			data: { 'page': page - 1 ,uid:uid}, 
			success: function(data) {
				$("#money_lists").empty(); 
				datas = JSON.parse(data);
				money_total_num = datas.total_num;
				money_page_size = datas.page_size;
				money_page = page;
				money_page_total_num = datas.page_total_num;
				var li = ""; 
				var list = datas.list;
				if (list==''){
					li += '<tr><td class="txtCenter" colspan="6">暂无数据</td></tr>';
				}else{
					$.each(list, 
						function(index, array) {
								var cla = 'txtCenter red';
								var str = array['money'].substring(0,1);
								if (str != '-'){
									array['money'] = '+'+array['money'];
								}else{
									cla = 'txtCenter green';
								}
								li += '<tr><td class="txtCenter" >'+array['original']+'</td><td class="'+cla+'">'+array['money']+'</td><td class="txtCenter" >'+array['last']+'</td><td class="txtCenter" >'+array['types']+'</td><td class="txtCenter" >'+array['createtime']+'</td><td class="txtCenter" >'+array['note']+'</td></tr>';
						}); 
				}
				$("#money_lists").append(li); 
			}, 
			complete: function() { 
				getMoneyPage(); //js生成分页，可用程序代替 
			}, 
			error: function() { 
				alert("数据异常,请检查是否json格式"); 
			} 
		}); 
	}

	function getMoneyPage() {
		if (money_page > money_page_total_num) money_page = money_page_total_num;
		if (money_page < 1) money_page = 1; 
		page_str = "<span>共" + money_total_num + "条</span><span>" + money_page + "/" + money_page_total_num + "</span>"; 
		if (money_page == 1) {
			page_str += "&nbsp;<span>首页</span>&nbsp;<span>上一页</span>"; 
		} else { 
			page_str += "&nbsp;<span><a href='javascript:void(0)' data-page='1'>首页</a></span>&nbsp;<span><a href='javascript:void(0)' data-page='" + (money_page - 1) + "'>上一页</a></span>"; 
		} 
		if (money_page >= money_page_total_num) {
			page_str += "&nbsp;<span>下一页</span>&nbsp;<span>尾页</span>"; 
		} else { 
			page_str += "&nbsp;<span><a href='javascript:void(0)' data-page='" + (parseInt(money_page) + 1) + "'>下一页</a></span>&nbsp;<span><a href='javascript:void(0)' data-page='" + money_page_total_num + "'>尾页</a></span>"; 
		} 
		$("#money_ul_lists").html(page_str); 
	}
	$("#money_ul_lists").on('click', 'a',function() {
		var page = $(this).attr("data-page");
		getMondyLog(page);
	});

	getMondyLog(1);
	
//-->
</script>