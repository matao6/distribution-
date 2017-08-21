$(function () {
    // 初始化左侧菜单，源码在--common.js
    choiceNavigation(mt_vip, membershiplevel_data_id);

    // 删除
    $(document).on('click', '.del-hook', function () {
        bootbox.confirm({
            small: 'size',
            title: '删除会员等级',
            buttons: {
                confirm: {
                    label: '确定'
                },
                cancel: {
                    label: '取消'
                }
            },
            message: '确认要删除吗？',
            callback: function (result) {
                if (result) {
                    alert('who else!')
                }
            }
        })
    });

    // 添加会员等级
    $('.addLevel-hook').click(function () {
        bootbox.confirm({
            title: '添加会员等级',
            buttons: {
                confirm: {
                    label: '确定'
                },
                cancel: {
                    label: '取消'
                }
            },
            message: '<div class="jbox-container" style="height: 480px; overflow: auto;">'+
                        '<div>'+
                            '<div class="formitems">'+
                                '<label class="fi-name">等级权重：</label>'+
                                '<div class="form-controls">'+
                                    '<input type="text" name="level" class="input mini">'+
                                    '<span class="fi-help-text">会员等级权重，值越大越重要</span>'+
                                '</div>'+
                            '</div>'+
                            '<div class="formitems">'+
                                '<label class="fi-name">等级名称：</label>'+
                                '<div class="form-controls">'+
                                    '<input type="text" name="alias" class="input">'+
                                '</div>'+
                            '</div>'+
                            '<div class="formitems">'+
                                '<label class="fi-name">交易额：</label>'+
                                '<div class="form-controls">'+
                                    '<input type="text" name="amount" class="input mini">'+
                                    '<span class="fi-help-text">满足条件之一：交易额</span>'+
                                '</div>'+
                            '</div>'+
                            '<div class="formitems">'+
                                '<label class="fi-name">交易次数：</label>'+
                                '<div class="form-controls">'+
                                    '<input type="text" name="count" class="input mini">'+
                                    '<span class="fi-help-text">满足条件之一：交易次数</span>'+
                                '</div>'+
                            '</div>'+
                            '<div class="formitems">'+
                                '<label class="fi-name">总积分：</label>'+
                                '<div class="form-controls">'+
                                    '<input type="text" name="total_point" class="input mini">'+
                                    '<span class="fi-help-text">满足条件之一：总积分</span>'+
                                '</div>'+
                            '</div>'+
                            '<div class="formitems">'+
                                '<label class="fi-name">指定商品:</label>'+
                                '<div class="form-controls">'+
                                    '<ul class="img-list clearfix">'+
                                        '<li class="img-list-add addGoods-hook">+</li>'+
                                    '</ul>'+
                                    '<input type="hidden" id="item_id" name="automaic_item_id">'+
                                    '<span class="fi-help-text">满足条件之一：购买指定商品</span>'+
                                '</div>'+
                            '</div>'+
                            '<div class="formitems">'+
                                '<label class="fi-name">会员折扣：</label>'+
                                '<div class="form-controls">'+
                                    '<input type="text" name="discount" class="input mini">'+
                                    '<span>折</span>'+
                                    '<span class="fi-help-text">请输入0.1~10之间的数字,值为空代表不设置折扣</span>'+
                                '</div>'+
                            '</div>'+
                            '<div class="formitems">'+
                                '<label class="fi-name">消费送积分：</label>'+
                                '<div class="form-controls">'+
                                    '<input type="text" name="point" class="input mini">'+
                                    '<span>（积分/元）</span>'+
                                    '<span class="fi-help-text">每消费1元可获得多少积分，请输入大于0.01的数值</span>'+
                                '</div>'+
                            '</div>'+
                            '<div class="formitems">'+
                                '<label class="fi-name">规定时间：</label>'+
                                '<div class="form-controls">'+
                                    '<input type="text" name="specified_time" class="input mini">'+
                                    '<span>天</span>'+
                                    '<span class="fi-help-text">规定多少天内消费未满规定金额，则自动降级</span>'+
                                '</div>'+
                            '</div>'+
                            '<div class="formitems">'+
                                '<label class="fi-name">规定金额：</label>'+
                                '<div class="form-controls">'+
                                    '<input type="text" name="specified_money" class="input mini">'+
                                    '<span>元</span>'+
                                    '<span class="fi-help-text">规定时间内消费未满规定金额，则自动降级</span>'+
                                '</div>'+
                            '</div>'+
                        '</div>'+
                    '</div>',
            callback: function (result) {
                if (result) {
                    alert('who else!')
                }
            }
        })
    });

    // 编辑
    $(document).on('click', '.edit-hook', function () {
        bootbox.confirm({
            title: '编辑会员等级',
            buttons: {
                cancel: {
                    label: '取消'
                },
                confirm: {
                    label: '确定'
                }
            },
            message: '<div class="jbox-container" style="height: 480px; overflow: auto;">'+
                        '<div>'+
                            '<div class="formitems">'+
                                '<label class="fi-name">等级权重：</label>'+
                                '<div class="form-controls">'+
                                    '<input type="text" name="level" class="input mini">'+
                                    '<span class="fi-help-text">会员等级权重，值越大越重要</span>'+
                                '</div>'+
                            '</div>'+
                            '<div class="formitems">'+
                                '<label class="fi-name">等级名称：</label>'+
                                '<div class="form-controls">'+
                                    '<input type="text" name="alias" class="input">'+
                                '</div>'+
                            '</div>'+
                            '<div class="formitems">'+
                                '<label class="fi-name">交易额：</label>'+
                                '<div class="form-controls">'+
                                    '<input type="text" name="amount" class="input mini">'+
                                    '<span class="fi-help-text">满足条件之一：交易额</span>'+
                                '</div>'+
                            '</div>'+
                            '<div class="formitems">'+
                                '<label class="fi-name">交易次数：</label>'+
                                '<div class="form-controls">'+
                                    '<input type="text" name="count" class="input mini">'+
                                    '<span class="fi-help-text">满足条件之一：交易次数</span>'+
                                '</div>'+
                            '</div>'+
                            '<div class="formitems">'+
                                '<label class="fi-name">总积分：</label>'+
                                '<div class="form-controls">'+
                                    '<input type="text" name="total_point" class="input mini">'+
                                    '<span class="fi-help-text">满足条件之一：总积分</span>'+
                                '</div>'+
                            '</div>'+
                            '<div class="formitems">'+
                                '<label class="fi-name">指定商品:</label>'+
                                '<div class="form-controls">'+
                                    '<ul class="img-list clearfix">'+
                                        '<li class="img-list-add addGoods-hook">+</li>'+
                                    '</ul>'+
                                    '<input type="hidden" id="item_id" name="automaic_item_id">'+
                                    '<span class="fi-help-text">满足条件之一：购买指定商品</span>'+
                                '</div>'+
                            '</div>'+
                            '<div class="formitems">'+
                                '<label class="fi-name">会员折扣：</label>'+
                                '<div class="form-controls">'+
                                    '<input type="text" name="discount" class="input mini">'+
                                    '<span>折</span>'+
                                    '<span class="fi-help-text">请输入0.1~10之间的数字,值为空代表不设置折扣</span>'+
                                '</div>'+
                            '</div>'+
                            '<div class="formitems">'+
                                '<label class="fi-name">消费送积分：</label>'+
                                '<div class="form-controls">'+
                                    '<input type="text" name="point" class="input mini">'+
                                    '<span>（积分/元）</span>'+
                                    '<span class="fi-help-text">每消费1元可获得多少积分，请输入大于0.01的数值</span>'+
                                '</div>'+
                            '</div>'+
                            '<div class="formitems">'+
                                '<label class="fi-name">规定时间：</label>'+
                                '<div class="form-controls">'+
                                    '<input type="text" name="specified_time" class="input mini">'+
                                    '<span>天</span>'+
                                    '<span class="fi-help-text">规定多少天内消费未满规定金额，则自动降级</span>'+
                                '</div>'+
                            '</div>'+
                            '<div class="formitems">'+
                                '<label class="fi-name">规定金额：</label>'+
                                '<div class="form-controls">'+
                                    '<input type="text" name="specified_money" class="input mini">'+
                                    '<span>元</span>'+
                                    '<span class="fi-help-text">规定时间内消费未满规定金额，则自动降级</span>'+
                                '</div>'+
                            '</div>'+
                        '</div>'+
                    '</div>',
            callback: function (result) {
                if (result) {
                    alert('who else!')
                }
            }
        })
    });

    // 选择商品中弹框中--关闭按钮
    $('.B_del-hook').click(function(){
        $('.chooseGoods').addClass('hide');
    })

    // 指定商品点击--显示选择商品弹框
    $(document).on('click', '.addGoods-hook', function(){
        $('.chooseGoods').removeClass('hide');
    })
})