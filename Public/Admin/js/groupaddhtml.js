$(function () {
    // 初始化左侧菜单，源码在--common.js
    choiceNavigation(mt_manage, groupaddhtml_data_id);

    function showData(data) {
        if (data.code == 0) {
            bootbox.alert(data.message)
        } else if (data.code == 1) {
            bootbox.alert(data.message, function () {
                location.href = mt_network + 'Member/GroupListHtml';
            });
        }
    }

    // form验证
    $('#form-hook').validate({
        submitHandler: function (form) {
            var state = $('#state-hook').val();
            var options = {
                type: 'POST',
                url: mt_network + 'Member/GroupAdd',
                data: {
                    state: state
                },
                dataType: 'json',
                success: showData
            }
            $(form).ajaxSubmit(options);
        },
        rules: {
            name: 'required'
        },
        messages: {
            name: '请输入权限组名称'
        }
    });

    // 点击父级按钮全选
    var nowState = true;
    function selectAllCheckbox() {
        $(this).parent().next().find('input:checkbox').prop('checked', nowState);
        nowState = !nowState;
    }
    $('#navi-hook').click(selectAllCheckbox);
    $('#link-hook').click(selectAllCheckbox);

    // 初始化bootstrap-switch开关
    $('#state-hook').bootstrapSwitch({
        size: 'mini',
        onColor: 'success',
        offColor: 'danger',
        onText: '正常',
        offText: '禁用',
        onSwitchChange: function (event, state) {
            if (state == true) {
                $(this).val("1");
            } else {
                $(this).val("0");
            }
        }
    })
})