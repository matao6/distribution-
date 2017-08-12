$(function () {
    // 初始化左侧菜单，源码在--common.js
    choiceNavigation(mt_manage, memberaddhtml_data_id);

    var options = {
        type: 'POST',
        url: mt_network + 'Member/MemberAdd',
        dataType: 'json',
        success: showData
    }

    function showData(data) {
        if (data.code == 0) {
            bootbox.alert(data.message)
        } else if (data.code == 1) {
            bootbox.alert(data.message, function () {
                location.href = mt_network + 'Member/MemberListHtml';
            });
        }
    }

    // 提交表单时的验证
    $('#adminForm').validate({
        submitHandler: function (form) {
            $(form).ajaxSubmit(options);
        },
        rules: {
            name: 'required',
            mobile: {
                required: true,
                isMobile: true
            },
            pwd: {
                required: true,
                minlength: 6,
                maxlength: 12
            },
            pwds: {
                required: true,
                minlength: 6,
                maxlength: 12,
                equalTo: '#password'
            },
            group_id: 'required',
            store_id: 'required'
        },
        messages: {
            name: '请输入您的名字',
            mobile: '请输入您的手机号',
            pwd: {
                required: '请输入密码',
                minlength: '密码长度不能小于6位',
                maxlength: '密码长度不能大于12位'
            },
            pwds: {
                required: '请输入密码',
                minlength: '密码长度不能小于6位',
                maxlength: '密码长度不能大于12位',
                equalTo: '两次密码输入不一样'
            },
            group_id: '请选择权限组id',
            store_id: '请选择门店id'
        }
    });
    jQuery.validator.addMethod("isMobile", function (value, element) {
        var length = value.length;
        return this.optional(element) || (length == 11 && /^(((13[0-9]{1})|(15[0-9]{1})|(18[0-9]{1}))+\d{8})$/.test(value));
    }, "请正确填写您的手机号码。");
})