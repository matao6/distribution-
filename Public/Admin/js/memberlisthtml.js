$(function () {
    function init() {
        $.ajax({
            url: mt_network + "Member/MemberList",
            type: "GET",
            dataType: "json",
            success: function (data) {
                var myData = data.data;
                var list = '';
                myData.forEach(function (val, index) {
                    list += '<tr>' +
                        '<td>' + val.name + '</td>' +
                        '<td>' + val.group_id + '</td>' +
                        '<td>' + val.mobile + '</td>' +
                        '<td>' +
                        '<a href="#" class="btn btn-mini btn-primary adminListEdit-hook" data-uid="' + val.uid + '" data-state="' + val.state + '" data-group_id="' + val.group_id + '" data-store_id="' + val.store_id + '">编辑</a>' +
                        '<a href="#" class="btn btn-mini btn-danger adminListDelete-hook" data-uid="' + val.uid + '" data-state="' + val.state + '" data-group_id="' + val.group_id + '" data-store_id="' + val.store_id + '">删除</a>' +
                        '</td>' +
                        '</tr>';

                });
                $('.table-hook tbody').html($(list));
            }
        });
    };

    init();

    // 初始化左侧菜单，源码在--common.js
    choiceNavigation(mt_manage, memberlisthtml_data_id);

    // 管理员列表删除
    $('.table-hook').on('click', '.adminListDelete-hook', function () {
        var id = $(this).attr('data-uid');
        var state = 0;
        var group_id = $(this).attr('data-group_id');
        var store_id = $(this).attr('data-store_id');

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
            message: '删除后将不可恢复，确认删除吗？',
            callback: function (result) {
                if (result) {
                    deleteUrl(id, state, group_id, store_id)
                }
            }
        })
    })

    function deleteUrl(id, state, group_id, store_id) {
        // alert('测试回掉函数---当期删除的id是'+id);
        $.ajax({
            url: mt_network + 'Member/MemberStateSave',
            type: 'POST',
            async: false,
            data: {
                id: id,
                state: state,
                group_id: group_id,
                store_id: store_id
            },
            success: function (data) {
                data = JSON.parse(data);
                if (data.code == 1) {
                    bootbox.alert(data.message, function () {
                        location.href = mt_network + 'Member/MemberListHtml';
                    })
                } else if (data.code == 0) {
                    bootbox.alert(data.message);
                }
            },
            error: function (data) {
                alert(data)
            }
        })
    }

    // 管理员列表编辑
    $('.table-hook').on('click', '.adminListEdit-hook', function () {
        var id = $(this).attr('data-uid');

        location.href = mt_network + 'Member/MemberEditHtml/id/' + id;
    })

    // 点击添加管理员--跳转
    $('.add_admin-hook').click(function () {
        location.href = mt_network + 'Member/MemberAddHtml';
    })

    // 管理员查询
    $('.search-hook').click(function () {
        var group = $('.group-hook').val();
        var name = $('.linkman-hook').val();

        if (group != '' || name != '') {
            $.ajax({
                url: mt_network + "Member/MemberList",
                type: "GET",
                data: {
                    group_id: group,
                    name: name
                },
                dataType: "json",
                success: function (data) {
                    var myData = data.data;
                    if (myData == null) {
                        $('.table-hook tbody').html('');
                    } else {
                        var list = '';
                        myData.forEach(function (val, index) {
                            list += '<tr>' +
                                '<td>' + val.name + '</td>' +
                                '<td>' + val.group_id + '</td>' +
                                '<td>' + val.mobile + '</td>' +
                                '<td>' +
                                '<a href="#" class="btn btn-mini btn-primary adminListEdit-hook" data-uid="' + val.uid + '" data-state="' + val.state + '" data-group_id="' + val.group_id + '" data-store_id="' + val.store_id + '">编辑</a>' +
                                '<a href="#" class="btn btn-mini btn-danger adminListDelete-hook" data-uid="' + val.uid + '" data-state="' + val.state + '" data-group_id="' + val.group_id + '" data-store_id="' + val.store_id + '">删除</a>' +
                                '</td>' +
                                '</tr>';
                        });
                        $('.table-hook tbody').html($(list));
                    }
                }
            })
        } else {
            bootbox.alert('请选择查询条件')
        }

    })

})