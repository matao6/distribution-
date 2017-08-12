$(function () {
    // 初始化左侧菜单，源码在--common.js
    choiceNavigation(mt_manage, memberlisthtml_data_id);

    var options = {
        type: 'POST',
        url: mt_network + 'Member/MemberStateSave',
        dataType: 'json',
        success: showData
    }

    // 显示返回的数据
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
            group_id: 'required',
            store_id: 'required'
        },
        messages: {
            name: '请输入您的名字',
            group_id: '请选择权限组id',
            store_id: '请选择门店id'
        }
    });
})