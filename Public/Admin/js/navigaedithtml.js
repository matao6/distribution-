$(function () {
    // 初始化左侧菜单，源码在--common.js
    choiceNavigation(mt_manage, navigalisthtml_data_id);

    // 获取到返回的数据
    function showData(data) {
        if (data.code == 0) {
            bootbox.alert(data.message);
        } else if (data.code == 1) {
            bootbox.alert(data.message, function () {
                location.href = mt_network + 'member/NavigaListHtml';
            });
        }
    }

    $('#adminForm').validate({
        submitHandler: function (form) {
            var state = $('#state-hook').val();
            var options = {
                type: 'POST',
                url: mt_network + 'Member/NavigaSave',
                dataType: 'json',
                success: showData
            }
            $(form).ajaxSubmit(options);
        },
        rules: {
            name: 'required',
            fid: {
                required: true
            },
            // url: {
            //     required: true
            // },
            weight: {
                required: true
            },
            type: 'required',
            store_id: 'required'
        },
        messages: {
            name: '请输入导航名称',
            fid: '请选择父级',
            // url: {
            //     required: '请输入URL'
            // },
            weight: {
                required: '请输入权重'
            },
            group_id: '请选择权限组id',
            store_id: '请选择门店id'
        }
    });

    // 初始化bootstrap-switch开关
    $('#state-hook').bootstrapSwitch({
        size: 'mini',
        onColor: 'success',
        offColor: 'danger',
        onSwitchChange: function (event, state) {
            if (state == true) {
                $(this).val("1");
            } else {
                $(this).val("0");
            }
        }
    })
})