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
            fid: {
                required: true
            },
            name: 'required',
            // url: {
            //     required: true
            // },
            sort: {
                required: true
            }
        },
        messages: {
            fid: '请选择分类',
            name: '请选择名称',
            // url: {
            //     required: '请输入URL'
            // },
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
        var addValue = $(this).prev().val();
        var ParentNode = $(this).parent();
        if(addValue != '') {
            var 
        }
    })
})