$(function () {
    function init() {
        // 如果状态为禁用，背景变色
        $('.use-hook').parent().parent().css('backgroundColor', '#ccc');
    }

    init();

    // 初始化左侧菜单，源码在--common.js
    choiceNavigation(mt_manage, navigalisthtml_data_id);
    
    // 点击禁用
    $('.table-hook').on('click', '.Unuse-hook', function () {
        var id = $(this).attr('data-id');
        var state = 0; // 禁用状态

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
            message: '确认禁用吗？',
            callback: function (result) {
                if (result) {
                    Unuse(id, state)
                }
            }
        })
    })

    // 点击启用
    $('.table-hook').on('click', '.use-hook', function () {
        var id = $(this).attr('data-id');
        var state = 1; // 启用状态

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
            message: '确认启用吗？',
            callback: function (result) {
                if (result) {
                    Unuse(id, state)
                }
            }
        })
    })

    function Unuse(id, state) {
        // alert('测试回掉函数---当期删除的id是'+id);
        $.ajax({
            url: mt_network + 'Member/NavigaStateSave',
            type: 'POST',
            async: false,
            data: {
                id: id,
                state: state
            },
            success: function (data) {
                data = JSON.parse(data);
                if (data.code == 1) {
                    bootbox.alert(data.message, function () {
                        location.href = mt_network + 'Member/NavigaListHtml';
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

    // 点击编辑
    $('.table-hook').on('click', '.edit-hook', function () {
        var id = $(this).attr('data-id');
        location.href = mt_network + 'Member/NavigaEditHtml/id/' + id;
    })

    // 点击添加导航--跳转
    $('.add_naviga-hook').click(function () {
        location.href = mt_network + 'Member/NavigaAddHtml';
    })

    // 导航名称查询
    $('.search-hook').click(function () {
        var name = $('.navigaName-hook').val();
        var type = 1;

        if (name != '') {
            $.ajax({
                url: mt_network + "Member/NavigaListSel",
                type: "POST",
                data: {
                    type: type,
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
                            list += val.state == "1" ? '<tr>' : '<tr class="list-active">';
                                        list += val.fid == "0" && val.url == "" ? '<td>'+ val.name +'</td>' : '<td></td>';
                                        list += val.fid != "0" && val.url == "" ? '<td>'+ val.name +'</td>' : '<td></td>';
                                        list += val.fid != "0" && val.url ? '<td>'+ val.name +'</td>' : '<td></td>';
                                        list += val.state == "1" ? '<td>正常</td><td><a href="javascript:;" data-id="'+val.id+'" class="btn btn-mini btn-primary edit-hook">编辑</a><a href="javascript:;" data-id="'+val.id+'" class="btn btn-mini btn-danger Unuse-hook">禁用</a></td>'
                                        : '<td>禁用</td><td><a href="javascript:;" data-id="'+val.id+'" class="btn btn-mini btn-primary edit-hook">编辑</a><a href="javascript:;" data-id="'+val.id+'" class="btn btn-mini btn-danger use-hook">启用</a></td>'
                            list += '</tr>';
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