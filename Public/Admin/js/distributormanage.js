$(function () {
    // 初始化左侧菜单，源码在--common.js
    choiceNavigation(mt_vip, distributormanage_data_id);

    // 初始化弹出框
    toastr.options = {
        closeButton: false,  
        debug: false,  
        progressBar: false,  
        positionClass: "toast-top-center",  
        onclick: null,  
        showDuration: "500",  
        hideDuration: "500",  
        timeOut: "1000",  
        extendedTimeOut: "1000",  
        showEasing: "swing",  
        hideEasing: "linear",  
        showMethod: "fadeIn",  
        hideMethod: "fadeOut"  
    };  
    // fadeOut父节点
    function removeParent() {
        $(this).parent().fadeOut();
    }
    $('.removeParent-hook').click(removeParent);

    // 初始化时间选择器，源码在--common.js
    // 注册时间 
    var date = new Date();
    mt_timeFun('input[name="start_time"]', 'bottom-left', 'input[name="end_time"]', 'bottom-right');
    // 分销商时间
    mt_timeFun('input[name="agent_time_start"]', 'bottom-left', 'input[name="agent_time_end"]', 'bottom-right');
    // 到期时间
    mt_timeFun('input[name="expire_time_start"]', 'bottom-left', 'input[name="expire_time_end"]', 'bottom-right');

    // 编辑按钮
    $('.wxtables-hook').on('click', '.edit-hook', function () {
        bootbox.confirm({
            title: '编辑会员',
            buttons: {
                confirm: {
                    label: '确定'
                },
                cancel: {
                    label: '取消'
                }
            },
            message: '<div class="jbox-container" style="height: 176px;">'+
                        '<div class="formitems">'+
                            '<label class="fi-name">买家姓名：</label>'+
                            '<div class="form-controls">'+
                                '<input name="name" class="input mini" value="" type="text">'+
                            '</div>'+
                        '</div>'+
                        '<div class="formitems">'+
                            '<label class="fi-name">手机号：</label>'+
                            '<div class="form-controls">'+
                                '<input name="mobile" class="input mini" value="" type="text">'+
                            '</div>'+
                        '</div>'+
                        '<div class="formitems">'+
                            '<label class="fi-name">密码：</label>'+
                            '<div class="form-controls">'+
                                '<input name="password" class="input mini" type="password">'+
                            '</div>'+
                        '</div>'+
                        '<div class="formitems">'+
                            '<label class="fi-name">邮箱：</label>'+
                            '<div class="form-controls">'+
                                '<input name="email" class="input" value="" type="text">'+
                            '</div>'+
                        '</div>'+
                    '</div>',
            callback: function (result) {
                if (result) {
                    alert('福尔摩斯')
                }
            }
        })
    });

    // 设置等级
    $('.wxtables-hook').on('click', '.agentLevel-hook', function () {
        bootbox.confirm({
            title: '设置分销商等级',
            buttons: {
                confirm: {
                    label: '确定'
                },
                cancel: {
                    label: '取消'
                }
            },
            message: '<div class="jbox-container" style="height: 74px;">'+
                        '<div class="formitems inline">'+
                            '<label class="fi-name">分销商昵称：</label>'+
                            '<div class="form-controls pdt3">test</div>'+
                        '</div>'+
                        '<div class="formitems inline">'+
                            '<label class="fi-name">分销商等级：</label>'+
                            '<div class="form-controls">'+
                                '<select name="agent_rank_id" class="select">'+
                                    '<option value="" selected="">test</option>'+
                                '</select>'+
                            '</div>'+
                        '</div>'+
                    '</div>',
            callback: function (result) {
                if (result) {
                    alert('小罗伯特-唐尼')
                }
            }
        })
    });

    // 设置积分验证
    $(document).on('blur', '#integral', function(){
        var st = /^[-+]?[0-9]+(\.[0-9]+)?$/;
        var thisSt = $(this).val();
        if (!st.test(thisSt)) {
            $(this).val('');
        }
    });

    // 调整积分
    $('.wxtables-hook').on('click', '.gavePoint-hook', function () {
        bootbox.confirm({
            title: '调整积分',
            buttons: {
                confirm: {
                    label: '确定'
                },
                cancel: {
                    label: '取消'
                }
            },
            message: '<div class="jbox-container" style="height: 229px;">'+
                        '<div>'+
                            '<div class="formitems inline">'+
                                '<label class="fi-name">会员姓名：</label>'+
                                '<div class="form-controls pdt3"></div>'+
                            '</div>'+
                            '<div class="formitems inline">'+
                                '<label class="fi-name">当前积分：</label>'+
                                '<div class="form-controls pdt3"></div>'+
                            '</div>'+
                            '<div class="formitems inline">'+
                                '<label class="fi-name"><span class="colorRed">*</span>增加或减少积分：</label>'+
                                '<div class="form-controls">'+
                                    '<input name="integral" class="input mini" id="integral" type="text">'+
                                    '<span>分</span>'+
                                    '<span class="fi-help-text"></span>'+
                                '</div>'+
                            '</div>'+
                            '<div class="formitems inline">'+
                                '<label class="fi-name">备注：</label>'+
                                '<div class="form-controls">'+
                                    '<textarea name="note" id="note" class="textarea" style="width:270px;height:120px;"></textarea>'+
                                '</div>'+
                            '</div>'+
                        '</div>'+
                    '</div>',
            callback: function (result) {
                var status = true;
                if (result) {
                    var st = /^[-+]?[0-9]+(\.[0-9]+)?$/;
                    var thisSt = $('#integral').val();
                    if (!st.test(thisSt)) {
                        $('#integral').val('');
                        alert('输入格式有误！');
                        status = false;
                    }else{
                        $.ajax({
                            url: mt_network+'Members/setIntegral',
                            type: 'POST',
                            async: false,
                            data:{id: uid,integral:$('#integral').val(),note:$('#note').val()},
                            success: function (datas){
                                    datas = JSON.parse(datas);
                                    if (datas.status != 1) {
                                        alert(datas.msg);
                                        status = false; 
                                    }else{
                                        alert(datas.msg);
                                        location.reload();
                                    }
                            }
                        });
                    }
                }
                return status;
            }
        })
    });

    // 发红包
    $('.redPack-hook').click(function(){
        bootbox.confirm({
            buttons: {
                confirm: {
                    label: '确定'
                },
                cancel: {
                    label: '取消'
                }
            },
            title: '发红包',
            message: '<div class="jbox-container" style="height: 121px;">'+
                        '<div>'+
                            '<div class="formitems inline">'+
                                '<label class="fi-name">会员昵称：</label>'+
                                '<div class="form-controls pdt3">test</div>'+
                            '</div>'+
                            '<div class="formitems inline">'+
                                '<label class="fi-name"><span class="colorRed">*</span>红包金额：</label>'+
                                '<div class="form-controls">'+
                                    '<input name="total_amount" class="input mini" type="text">'+
                                    '<span>元</span>'+
                                    '<span class="fi-help-text">红包金额介于[1.00元，200.00元]之间</span>'+
                                '</div>'+
                            '</div>'+
                            '<div class="formitems inline">'+
                                '<label class="fi-name"><span class="colorRed">*</span>祝福语：</label>'+
                                '<div class="form-controls">'+
                                    '<input name="wishing" class="input large">'+
                                    '<span class="fi-help-text"></span>'+
                                '</div>'+
                            '</div>'+
                        '</div>'+
                    '</div>',
            callback: function (result) {
                if (result) {
                    alert('~~~')
                }
            }
        })
    });

    // 取消分销资质
    $('.cancel-hook').click(function(){
        bootbox.confirm({
            size: 'small',
            buttons: {
                confirm: {
                    label: '确定'
                },
                cancel: {
                    label: '取消'
                }
            },
            title: '取消分销商资格',
            message: '取消资格后将不可恢复，是否继续？',
            callback: function (result) {
                if (result) {
                    alert('传到后台。。')
                }
            }
        })
    });

    // 设置分销商到期时间
    $('.agent_time-hook').click(function(){
        bootbox.confirm({
            buttons: {
                confirm: {
                    label: '确定'
                },
                cancel: {
                    label: '取消'
                }
            },
            title: '设置分销商到期时间',
            message: '<div class="jbox-container" style="height: 50px;">'+
                        '<div class="formitems">'+
                            '<label class="fi-name">到期时间：</label>'+
                            '<div class="form-controls">'+
                                '<input type="text" placeholder="到期时间" class="input" id="expire_time" name="agent_time" value="">'+
                            '</div>'+
                        '</div>'+
                    '</div>',
            callback: function (result) {
                if (result) {
                    alert('传到后台。。')
                }
            }
        });
        $('#expire_time').datetimepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            todayBtn: true,
            endDate: date, // 结束时间--今天
            minView: 2, // 选完日后，不在出现下级时间选择
            language: 'zh-CN',
            forceParse: true, // 强制解析
            pickerPosition: 'bottom-left' // 选择框位置
        });
    });

    // 设置余额
    $('.balance-hook').click(function(){
        var uid = this.getAttribute('dataid');
        $.ajax({
            url: mt_network+'Members/getInfo',
            type: 'POST',
            async: false,
            data:{id: uid},
            success: function (data){
                data = JSON.parse(data);
                // if (data.status != 1) { alert(data.msg); return false; }
                bootbox.confirm({
                    buttons: {
                        confirm: {
                            label: '确定'
                        },
                        cancel: {
                            label: '取消'
                        }
                    },
                    title: '设置余额',
                    message: '<div class="jbox-container" style="height: 229px;">'+
                                    '<div>'+
                                        '<div class="formitems inline">'+
                                            '<label class="fi-name">会员姓名：test</label>'+
                                            '<div class="form-controls pdt3"></div>'+
                                        '</div>'+
                                        '<div class="formitems inline">'+
                                            '<label class="fi-name">当前余额：test</label>'+
                                            '<div class="form-controls pdt3"></div>'+
                                        '</div>'+
                                        '<div class="formitems inline">'+
                                            '<label class="fi-name"><span class="colorRed">*</span>增加或减少余额：</label>'+
                                            '<div class="form-controls">'+
                                                '<input name="account_balance" id="account_balance" class="input mini" type="text">'+
                                                '<span class="fi-help-text"></span>'+
                                            '</div>'+
                                        '</div>'+
                                        '<div class="formitems inline">'+
                                            '<label class="fi-name">备注：</label>'+
                                            '<div class="form-controls">'+
                                                '<textarea name="account_note" id="account_note" class="textarea" style="width:270px;height:120px;"></textarea>'+
                                            '</div>'+
                                        '</div>'+
                                    '</div>'+
                                '</div>',
                    callback: function (result) {
                        var status = true;
                        if (result) {
                            var st = /^[-+]?[0-9]+(\.[0-9]+)?$/;
                            var thisSt = $('#account_balance').val();
                            if (!st.test(thisSt)) {
                                $('#account_balance').val('');
                                alert('输入格式有误！');
                                status = false;
                            }else{
                                $.ajax({
                                    url: mt_network+'Members/setAccountBalance',
                                    type: 'POST',
                                    async: false,
                                    data:{id: uid,account_balance:$('#account_balance').val(),note:$('#account_note').val()},
                                    success: function (datas){
                                            datas = JSON.parse(datas);
                                            if (datas.status != 1) {
                                                alert(datas.msg);
                                                status = false; 
                                            }else{
                                                alert(datas.msg);
                                                location.reload();
                                            }
                                    }
                                });
                            }
                        }
                        return status;
                    }
                });
            }
        });
    });

    // 调整佣金
    $('.commission-hook').click(function(){
        var uid = this.getAttribute('dataid');
        $.ajax({
            url: mt_network+'Members/getInfo',
            type: 'POST',
            async: false,
            data:{id: uid},
            success: function (data){
                data = JSON.parse(data);
                // if (data.status != 1) { alert(data.msg); return false; }
                bootbox.confirm({
                    buttons: {
                        confirm: {
                            label: '确定'
                        },
                        cancel: {
                            label: '取消'
                        }
                    },
                    title: '修改佣金',
                    message: '<div class="jbox-container" style="height: 135px;">'+
                                    '<div>'+
                                        '<div class="formitems inline">'+
                                            '<label class="fi-name">会员姓名：test</label>'+
                                            '<div class="form-controls pdt3"></div>'+
                                        '</div>'+
                                        '<div class="formitems inline">'+
                                            '<label class="fi-name">当前佣金：test</label>'+
                                            '<div class="form-controls pdt3"></div>'+
                                        '</div>'+
                                        '<div class="formitems inline">'+
                                            '<label class="fi-name"><span class="colorRed">*</span>增加或减少余额：</label>'+
                                            '<div class="form-controls">'+
                                                '<input name="account_balance" id="account_balance" class="input mini" type="text">'+
                                                '<span class="fi-help-text"></span>'+
                                            '</div>'+
                                        '</div>'+
                                        '<div class="formitems inline">'+
                                            '<label class="fi-name">备注：</label>'+
                                            '<div class="form-controls">'+
                                                '<input name="remark" value="" class="input" type="text">'+
                                            '</div>'+
                                        '</div>'+
                                    '</div>'+
                                '</div>',
                    callback: function (result) {
                        var status = true;
                        if (result) {
                            var st = /^[-+]?[0-9]+(\.[0-9]+)?$/;
                            var thisSt = $('#account_balance').val();
                            if (!st.test(thisSt)) {
                                $('#account_balance').val('');
                                alert('输入格式有误！');
                                status = false;
                            }else{
                                $.ajax({
                                    url: mt_network+'Members/setAccountBalance',
                                    type: 'POST',
                                    async: false,
                                    data:{id: uid,account_balance:$('#account_balance').val(),note:$('#account_note').val()},
                                    success: function (datas){
                                            datas = JSON.parse(datas);
                                            if (datas.status != 1) {
                                                alert(datas.msg);
                                                status = false; 
                                            }else{
                                                alert(datas.msg);
                                                location.reload();
                                            }
                                    }
                                });
                            }
                        }
                        return status;
                    }
                });
            }
        });
    });
    // 二维码
    $('.qrcode-hook').click(function(){
        $('#qrcode').removeClass('hide');
    });
    $('#qrcode').click(function(){
        $(this).addClass('hide');
    });

    // 全选
    $('.btn_table_selectAll').click(function(){
        $('input:checkbox').prop('checked', true);
    });

    // 反选
    $('.btn_table_Cancle').click(function(){
        $('input:checkbox').prop('checked', false);
    });

    // 批量设置分组
    $('.j-setGroup-hook').click(function(){
        if ($('input:checkbox:checked').length) {
            alert('~~~')
        }else{
            toastr.warning("对不起，请选择需要设置的会员！");  
        }
    });
    
    // 批量设置等级
    $('.j-setAgentLevel-hook').click(function(){
        if ($('input:checkbox:checked').length) {
            alert('~~~')
        }else{
            toastr.warning("对不起，请选择需要设置的会员！");  
        }
    });

    // 批量设置到期时间
    $('.j-setAgentTime-hook').click(function(){
        if ($('input:checkbox:checked').length) {
            alert('~~~')
        }else{
            toastr.warning("对不起，请选择需要设置的会员！");  
        }
    });
    // 批量取消分销资质
    $('.j-setAgentStatus-hook').click(function(){
        if ($('input:checkbox:checked').length) {
            alert('~~~')
        }else{
            toastr.warning("对不起，请选择需要设置的会员！");  
        }
    });
})