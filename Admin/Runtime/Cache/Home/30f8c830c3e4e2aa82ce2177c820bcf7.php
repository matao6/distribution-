<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>分销商管理</title>
    <link rel="stylesheet" href="/Public/Admin/css/bootstrap.min.css">
    <link rel="stylesheet" href="/Public/Admin/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" href="/Public/Admin/css/component-min.css">
    <link rel="stylesheet" href="/Public/Admin/css/reset.css">
    <link rel="stylesheet" href="/Public/Admin/css/common.css">
    <link rel="stylesheet" href="/Public/Admin/css/toastr.min.css">
    <link rel="stylesheet" href="/Public/Admin/css/distributormanage.css">
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
            <h1 class="content-right-title">分销商管理</h1>
            <div class="nowHasUser alert alert-info disable-del">
                目前拥有 <span class="amount">test</span> 名分销商
                <div class="glyphicon glyphicon-remove removeParent removeParent-hook"></div>
            </div>
            <form action="" method="get" name="form1">
                <div class="table-searchbox-v2 mgb10">
                    <div class="row clearfix">
                        <div class="col">
                            <span class="tbs-txt">姓名/ID：</span>
                            <input class="input" name="name" value="" placeholder="" type="text">
                        </div>
                        <div class="col">
                            <span class="tbs-txt">所属分组：</span>
                            <select name="user_group_id" class="select">
                                <option value="-1" selected="">所有分组</option>
                            </select>
                        </div>
                        <div class="col">
                            <span class="tbs-txt">所属等级：</span>
                            <select name="agent_rank_id" class="select">
                                <option value="-1" selected="">所有等级</option>
                            </select>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col">
                            <span class="tbs-txt">昵称/手机：</span>
                            <input class="input" name="mobile" value="" placeholder="" type="text">
                        </div>
                        <div class="col">
                            <span class="tbs-txt">所属省市：</span>
                            <select name="province" class="J_province slect_province select mini">
                                <option value="0" selected="">所有省份</option>
                            </select>
                            <div class="J-city slect_diy">
                                <select name="city_id" class="select mini s_city">
                                    <option value="0" selected="">所有城市</option>
                                </select>
                                <span class="fi-help-text"></span>
                            </div>
                        </div>
                        <div class="col">
                            <span class="tbs-txt">注册时间：</span>
                            <input autocomplete="off" name="start_time" value="" placeholder="开始时间" class="input mini" type="text">
                            <input autocomplete="off" name="end_time" value="" placeholder="结束时间" class="input mini" type="text">
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col">
                            <span class="tbs-txt">排序：</span>
                            <select name="order" class="select">
                                <option value="-1">选择排序</option>
                            </select>
                        </div>
                        <div class="col">
                            <span class="tbs-txt">分销商时间：</span>
                            <input autocomplete="off" name="agent_time_start" value="" placeholder="开始时间" class="input mini" type="text">
                            <input autocomplete="off" name="agent_time_end" value="" placeholder="结束时间" class="input mini" type="text">
                        </div>
                        <div class="col">
                            <span class="tbs-txt">到期时间：</span>
                            <input autocomplete="off" name="expire_time_start" value="" placeholder="开始时间" class="input mini" type="text">
                            <input autocomplete="off" name="expire_time_end" value="" placeholder="结束时间" class="input mini" type="text">
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col">
                            <span class="tbs-txt"></span>
                            <button class="btn btn-primary"><i class="glyphicon glyphicon-search white mgr5"></i>查询</button>
                        </div>
                    </div>
                </div>
            </form>
            <table class="wxtables wxtables-hook">
                <colgroup>
                    <col width="1%">
                    <col width="3%">
                    <col width="10%">
                    <col width="10%">
                    <col width="10%">
                    <col width="10%">
                    <col width="9%">
                    <col width="11%">
                    <col width="36%">
                </colgroup>
                <thead>
                    <tr>
                        <td><i class="icon_check"></i></td>
                        <td colspan="2">分销商</td>
                        <td>总消费金额</td>
                        <td>下级会员数</td>
                        <td>注册时间</td>
                        <td>到期时间</td>
                        <td>成为分销商时间</td>
                        <td>操作</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <input class="checkbox table-ckbs" type="checkbox">
                        </td>
                        <td>
                            <img src="http://wx.qlogo.cn/mmopen/I0n26ibEtaEAsIF4Fic7oicFsYm8iah3zN3iaknq9FFcmUOpbb4aiczWyNe6Pv4zxCNPkz9uNTaaG5CPwgXnSXZfZRVMA6Hvohc2eh/96"
                                alt="" width="60" height="60">
                        </td>
                        <td>
                            <p>test</p>
                            <p> </p>
                            <p>姓名: test</p>
                            <p>分组：</p>
                            <p>等级：test</p>
                        </td>
                        <td>¥test</td>
                        <td>test</td>
                        <td>2017-08-13 15:41:57</td>
                        <td>--</td>
                        <td>2017-08-14</td>
                        <td>
                            <a href="/User/detail/id/3347583" target="_blank" class="btn btn-mini btn-primary">详情</a>
                            <a href="javascript:;" class="btn btn-mini btn-primary edit-hook">编辑</a>
                            <a href="javascript:;" class="btn btn-mini btn-primary agentLevel-hook">设等级</a>
                            <a href="javascript:;" class="btn btn-mini btn-primary gavePoint-hook">调整积分</a>
                            <a href="javascript:;" class="btn btn-mini btn-danger redPack-hook">发红包</a>
                            <a href="javascript:;" class="btn btn-mini btn-warning cancel-hook">取消分销资质</a>
                            <a href="javascript:;" class="btn btn-mini btn-warning agent_time-hook">设置到期时间</a>
                            <a href="javascript:;" class="btn btn-mini btn-warning balance-hook">调整余额</a>
                            <a href="javascript:;" class="btn btn-mini btn-warning commission-hook">调整佣金</a>
                            <a href="/User/agent_detail/id/3347583" target="_blank" class="btn btn-mini btn-success">查看下级</a>
                            <a href="/User/getAgentOrder/id/3347583" target="_blank" class="btn btn-mini btn-success">查看订单</a>
                            <a href="/User/getPie/id/3347583" target="_blank" class="btn btn-mini btn-success">财务报表</a>
                            <a href="javascript:;" class="btn btn-mini btn-success qrcode-hook" title="二维码" data-link="http%3A%2F%2Fm9.huiyuandao.com%2FUser%2Findex%2Fpid%2F3347583%2Fsid%2F8001068.html">二维码</a>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div id="qrcode" class="hide">
                <img src="http://wx.qlogo.cn/mmopen/I0n26ibEtaEAsIF4Fic7oicFsYm8iah3zN3iaknq9FFcmUOpbb4aiczWyNe6Pv4zxCNPkz9uNTaaG5CPwgXnSXZfZRVMA6Hvohc2eh/96">
                <a href="javascript:;" class="qrcode-btn j-closeQrcode"><i class="glyphicon glyphicon-remove" style="color: white;"></i></a>
            </div>
            <div class="tables-btmctrl">
                <div class="mgb10">
                    <a href="javascript:;" class="btn btn-primary btn_table_selectAll">全选</a>
                    <a href="javascript:;" class="btn btn-primary btn_table_Cancle">取消</a>
                    <a href="javascript:;" class="btn btn-warning j-setGroup-hook">批量设置分组</a>
                    <a href="javascript:;" class="btn btn-warning j-setAgentLevel-hook">批量设置等级</a>
                    <a href="javascript:;" class="btn btn-warning j-setAgentTime-hook">批量设置到期时间</a>
                    <a href="javascript:;" class="btn btn-warning j-setAgentStatus-hook">批量取消分销资质</a>
                </div>
            </div>
        </div>
    </div>
    <div class="footer"></div>

    <script type="text/javascript" src="/Public/Admin/js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="/Public/Admin/js/toastr.min.js"></script>
    <script type="text/javascript" src="/Public/Admin/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/Public/Admin/js/bootstrap-datetimepicker.js"></script>
    <script type="text/javascript" src="/Public/Admin/js/bootstrap-datetimepicker.zh-CN.js" charset="UTF-8"></script>
    <script type="text/javascript" src="/Public/Admin/js/jquery.validate.min.js"></script>
    <script type="text/javascript" src="/Public/Admin/js/messages_zh.js"></script>
    <script type="text/javascript" src="/Public/Admin/js/jquery.form.js"></script>
    <script type="text/javascript" src="/Public/Admin/js/bootbox.min.js"></script>
    <script type="text/javascript" src="/Public/Admin/js/common.js"></script>
    <script type="text/javascript" src="/Public/Admin/js/distributormanage.js"></script>
</body>
<script type="text/javascript">
    // <!--
    $('#sub').click(function () {
        $('#form1').submit();
    });

    $('#sele').click(function () {
        var page = parseInt($('#page').val());
        var last = parseInt($('#last').val());
        if (page > last) {
            alert('超出总页数');
            return false;
        }
        $('#p').val($('#page').val());
        $('#form1').submit();
    });

    function keyPress(ob) {
        if (!ob.value.match(/^[\+\-]?\d*?\.?\d*?$/)) {
            ob.value = '';
        } else {
            ob.t_value = ob.value;
        }
        if (ob.value.match(/^(?:[\+\-]?\d+(?:\.\d+)?)?$/)) ob.o_value = ob.value;
    }
    //-->
</script>

</html>