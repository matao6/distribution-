$(function(){
    // 初始化左侧菜单，源码在--common.js
    choiceNavigation(mt_manage, grouplisthtml_data_id);
    
    // 点击父级按钮全选
    var nowState = true;
    function selectAllCheckbox() {
        $(this).parent().next().find('input:checkbox').prop('checked', nowState);
        nowState = !nowState;
    }
    $('#navi-hook').click(selectAllCheckbox);
    $('#link-hook').click(selectAllCheckbox);

    // 编辑权限组权限
    $('.save-hook').click(function(){
        // 权限组名称和状态
        var name = $('#powerName').val(); // 权限组名称
        var id = location.href.split('/');
        id = id[id.length - 1] // 权限组id
        var state = $('#state-hook').val(); // 权限组状态
        $.ajax({
            url: mt_network+'Member/GroupSave',
            type: 'POST',
            async: false,
            data: {
                name: name,
                id: id,
                state: state
            },
            dataType: 'json',
            success: function(data){

            }
        })
        // 权限组权限增加
        var Addchecked = $('.notHave input:checkbox:checked'); // 未拥有权限中选中的checkbox
        var checkedStr = '';
        Addchecked.each(function(index, element){
            if (index != Addchecked.length-1){
                checkedStr += $(this).attr('id')+',';
            }else{
                checkedStr += $(this).attr('id');
            }
        })
        $.ajax({
            url: mt_network+'Member/PowerAdd',
            type: 'POST',
            async: false,
            data: {
                group_id: id,
                n_id: checkedStr
            },
            dataType: 'json',
            success: function(data){

            }

        })
        // 权限组权限删除
        var Delchecked = $('.alreadyHas input:checkbox:checked'); // 以拥有权限中选中的checkbox
        var DelStr = '';
        Delchecked.each(function(index, element){
            if (index != Delchecked.length-1){
                DelStr += $(this).attr('id')+',';
            }else{
                DelStr += $(this).attr('id');
            }
        })

        $.ajax({
            url: mt_network+'Member/PowerDel',
            type: 'POST',
            async: false,
            data: {
                group_id: id,
                n_id: DelStr
            },
            dataType: 'json',
            success: function(data){

            }

        });
        
        location.href = mt_network + 'Member/GroupListHtml';
    })

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