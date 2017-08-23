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
    <link rel="stylesheet" href="/Public/Admin/css/membershiplevel.css">
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
                    <label><input name="is_rank_upgrade_status" type="radio" value="0"> 交易完成金额</label> &nbsp;&nbsp;
                    <span><input type="submit" class="btn btn-primary j-exchange" value="保存"></span>
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
    <div class="chooseGoods col-lg-8 col-md-8 col-sm-9 hide">
        <div class="mtBox_title">
            <span class="B_title">选择商品</span>
            <a href="javascript:;" class="glyphicon glyphicon-remove B_del B_del-hook"></a>
        </div>
        <div class="mtBox_content">
            <div class="">
                <input name="title" placeholder="请输入商品关键词" class="input xlarge" value="" type="text">
                <select name="status" class="select">  
                    <option value="">test</option>  
                </select>
                <select name="class_id" class="select small newselect">
                    <option value="" selected="">test</option>
                </select>
                <a href="javascript:;" class="btn btn-primary j-search"><i class="glyphicon glyphicon-search white mgr5"></i>查询</a>
            </div>
            <table class="wxtables mgt10 table-selectGoods">
                <colgroup>
                    <col width="5%">
                    <col width="28%">
                    <col width="5%">
                    <col width="28%">
                    <col width="5%">
                    <col width="28%">
                </colgroup>
                <thead>
                    <tr>
                        <td></td>
                        <td>商品</td>
                        <td></td>
                        <td>商品</td>
                        <td></td>
                        <td>商品</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="txtCenter">
                            <a href="javascript:;" class="icon-select select-hook " data-index="0"></a>
                            <input class="j-chkbox" data-index="0" data-itemid="1245980" style="display:none;" type="checkbox">
                        </td>
                        <td style="border-right: 1px solid #e7e7eb;">
                            <a href="http://m9.huiyuandao.com/Item/detail/id/1245980/sid/8001068.html" class="block" target="_blank" title="韩国JAYJUN水光维他命玻尿酸多重维生素药丸能量面膜10片">
                                <div class="table-item-img">
                                    <img src="http://image.supvip.cn/df/53/8001068/2017-08/5995581cdc93e.jpg" alt="韩国JAYJUN水光维他命玻尿酸多重维生素药丸能量面膜10片">
                                </div>
                                <div class="table-item-info">
                                    <p>韩国JAYJUN水光维他命玻尿酸多重维生素药丸能量面膜10片</p>
                                    <span class="price">现价 ¥test</span>
                                </div>
                            </a>
                        </td>
                        <td class="txtCenter">
                            <a href="javascript:;" class="icon-select j-select " data-index="1"></a>
                            <input class="j-chkbox" data-index="1" data-itemid="1245976" style="display:none;" type="checkbox">
                        </td>
                        <td style="border-right: 1px solid #e7e7eb;">
                            <a href="http://m9.huiyuandao.com/Item/detail/id/1245976/sid/8001068.html" class="block" target="_blank" title="JAYJUN植物干细胞紧致面膜10片 补水保湿舒缓水光面膜">
                                <div class="table-item-img">
                                    <img src="http://image.supvip.cn/df/53/8001068/2017-08/59955715d3b67.jpg" alt="JAYJUN植物干细胞紧致面膜10片 补水保湿舒缓水光面膜">
                                </div>
                                <div class="table-item-info">
                                    <p>JAYJUN植物干细胞紧致面膜10片 补水保湿舒缓水光面膜</p>
                                    <span class="price">现价 ¥test</span>
                                    <div class="label">已选择该商品</div>
                                </div>
                            </a>
                        </td>
                        <td class="txtCenter">
                            <a href="javascript:;" class="icon-select j-select " data-index="2"></a>
                            <input class="j-chkbox" data-index="2" data-itemid="1245966" style="display:none;" type="checkbox">
                        </td>
                        <td style="border-right: 1px solid #e7e7eb;">
                            <a href="http://m9.huiyuandao.com/Item/detail/id/1245966/sid/8001068.html" class="block" target="_blank" title="欧莱雅去屑调理洗发水250ml清洁头皮去油无硅油">
                                <div class="table-item-img">
                                    <img src="http://img.alicdn.com/bao/uploaded/i4/TB1aGH5KXXXXXbTXXXXXXXXXXXX_!!0-item_pic.jpg_80x80" alt="欧莱雅去屑调理洗发水250ml清洁头皮去油无硅油">
                                </div>
                                <div class="table-item-info">
                                    <p>欧莱雅去屑调理洗发水250ml清洁头皮去油无硅油</p>
                                    <span class="price">现价 ¥test</span>
                                </div>
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="mgt15 clearfix">
                <div class="fr paginate"><a href="javascript:;" class="prev disabled">上一页</a><a class="cur">1</a><a href="">2</a><a href="">3</a>
                    <a href="">4</a><a href="">5</a><span class="dotted">...</span><a href="" class="next">下一页</a></div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="/Public/Admin/js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="/Public/Admin/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/Public/Admin/js/bootbox.min.js"></script>
    <script type="text/javascript" src="/Public/Admin/js/common.js"></script>
    <script type="text/javascript" src="/Public/Admin/js/membershiplevel.js"></script>
</body>

</html>