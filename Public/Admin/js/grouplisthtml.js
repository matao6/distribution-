$(function(){
    // 初始化左侧菜单，源码在--common.js
    choiceNavigation(mt_manage, grouplisthtml_data_id);

    // 权限组列表删除
    $('.table-hook').on('click', '.del-hook', function () {
        var id = $(this).attr('data-id');
        var name = $(this).attr('data-name');
        var state = 0;

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
            title: '提示',
            message: '删除该角色会一起删除角色下的管理员，确认删除吗？',
            callback: function (result) {
                if (result) {
                    deleteUrl(id, name, state)
                }
            }
        })
    })

    function deleteUrl(id, name, state) {
        // alert('测试回掉函数---当期删除的id是'+id);
        $.ajax({
            url: mt_network + 'Member/GroupSave',
            type: 'POST',
            data: {
                id: id,
                name: name,
                state: state
            },
            success: function (data) {
                data = JSON.parse(data);
                if (data.code == 1) {
                    bootbox.alert(data.message, function () {
                        location.href = mt_network + 'Member/GroupListHtml';
                    })
                } else if (data.code == 0) {
                    bootbox.alert(data.message);
                }
            },
            error: function (data) {
                alert(data)
            }
        })
    };

    // 增加权限组
    $('.add-hook').click(function(){
        location.href=mt_network + 'Member/GroupAddHtml';
    })

    // 编辑权限组
    $('.edit-hook').click(function(){
        var id = $(this).attr('data-id');

        location.href = mt_network + 'Member/PowerList/id/' + id;
    })

})