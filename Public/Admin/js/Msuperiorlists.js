$(function(){
    // 初始化左侧菜单，源码在--common.js
    choiceNavigation(mt_vip, info_data_id);

    var date = new Date();
    // 开始时间配置
    $('#start_date').datetimepicker({
        format: 'yyyy-mm-dd',
        autoclose: true,
        todayBtn: true,
        endDate: date, // 结束时间--今天
        minView: 2, // 选完日后，不在出现下级时间选择
        language: 'zh-CN',
        forceParse: true, // 强制解析
        pickerPosition: 'bottom-left' // 选择框位置
    }).on('hide', function () {
        if ($('#start_date').val() > $('#end_date').val() && $('#end_date').val() != '') {
            var diffDate = $('#end_date').val().valueOf();
            $('#start_date').val(diffDate);
        }
    });
    // 结束时间配置
    $('#end_date').datetimepicker({
        format: 'yyyy-mm-dd',
        autoclose: true,
        todayBtn: true,
        endDate: date, // 结束时间--今天
        minView: 2, // 选完日后，不在出现下级时间选择
        language: 'zh-CN',
        forceParse: true, // 强制解析
        pickerPosition: 'bottom-right' // 选择框位置
    }).on('hide', function () {
        if ($('#end_date').val() < $('#start_date').val()) {
            var diffDate = $('#start_date').val().valueOf();
            $('#end_date').val(diffDate);
        }
    });

    // 设为顶级会员
    $('#top-hook').click(function(){
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
            title: '设为顶级会员',
            message: '确认要将此会员设置为顶级会员吗？',
            callback: function(result) {
                if (result) {
                    $.ajax({
						url: mt_network+'Msuperior/setTop',
						type: 'POST',
						async: false,
						data:{id: $('#id').val()},
						success: function (datas){
								datas = JSON.parse(datas);
								alert(datas.msg);
								location.reload();
						}
					});
                }
            }
        })
    });

    // 设为上级
    $('.setHigherUp-hook').click(function(){
		var uid = this.getAttribute('dataid');
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
            title: '设为上级',
            message: '确认要将此会员设为上级吗？',
            callback: function(result) {
                if (result) {
					$.ajax({
						url: mt_network+'Msuperior/setSuperior',
						type: 'POST',
						async: false,
						data:{id: $('#id').val(),uid: uid},
						success: function (datas){
								datas = JSON.parse(datas);
								alert(datas.msg);
								location.reload();
						}
					});
                }
            }
        })
    })
})