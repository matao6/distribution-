$(function(){
    // 初始化左侧菜单，源码在--common.js
    choiceNavigation(mt_goods, attributeadd_data_id);

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
                url: mt_network + 'Goods/AttrValueAddApi',
                data: {
                    state: state
                },
                dataType: 'json',
                success: showData
            }
            $(form).ajaxSubmit(options);
        },
        rules: {
            // fid: {
            //     required: true
            // },
            // name: 'required',
            // sort: {
            //     required: true
            // }
        },
        messages: {
            fid: '请选择分类',
            name: '请选择名称',
            sort: {
                required: '请输入排序'
            }
        }
    });

    // 初始化bootstrap-switch开关
    $('#state-hook').bootstrapSwitch({
        size: 'mini',
        onColor: 'success',
        offColor: 'danger',
        onText: '是',
        offText: '否',
        onSwitchChange: function (event, state) {
            if (state == true) {
                $(this).val("1");
            } else {
                $(this).val("0");
            }
        }
    });

    // 点击规格是弹出是否可变规格属性
    $('.spec-hook').click(function(){
        $('.isChange-hook').slideDown();
    });
    $('.attr-hook').click(function(){
        $('.isChange-hook').slideUp();
    })
    
    // 点击添加值的按钮
    $('.addValue-hook').click(function(){
        var addValueNode = $(this).prev();
        var ParentNode = $(this).parent();
        if(addValueNode.val() != '') {
            var addStr = '<span class="addNode mgt10 mgr5">'+
                            '<input type="button" class="btn btn-warning nodeValue" name="value[]" value="'+addValueNode.val()+'"><a href="javascript:;" class="btn btn-danger nodeDel nodeDel-hook"><i class="glyphicon glyphicon-remove"></i></a>'+
                        '</span>';
            ParentNode.append($(addStr));
            addValueNode.val('');
        }else{
            toastr.warning('请输入值!')
        }
    });

    // 添加值后面的删除按钮
    $('.parent-hook').on('click', '.nodeDel-hook', function(){
        $(this).parent().remove();
    })
})