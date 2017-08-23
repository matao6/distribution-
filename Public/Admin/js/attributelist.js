$(function(){
    // 初始化左侧菜单，源码在--common.js
    choiceNavigation(mt_goods, attributelist_data_id);

    // 全选按钮
    $('.selectAll-hook').click(function () {
        $('.checkbox-hook').prop('checked', true);
    })

    // 取消全选按钮
    $('.cancelAll-hook').click(function () {
        $('.checkbox-hook').prop('checked', false);
    })

    // 批量删除
    $('.delAll-hook').click(function () {
        if ($('.checkbox-hook:checkbox:checked').length <= 0) {
            bootbox.alert('请选择要删除的数据');
            return false;
        } else {
			if (confirm("确认要删除？")) {
				var id = new Array();
				$('.checkbox-hook:checkbox:checked').each(function (){
						id.push($(this).val());
				});
				var str_id = id.join(',');
				$.ajax({
					 url: mt_network + 'Mgroup/batchDel',
					 type: 'POST',
					 async: false,
					 data: { id: str_id},
					 success: function (datas) {
							datas = JSON.parse(datas);
							alert(datas.msg);
							location.reload();
					 }
				 });

			}
        }
    })
})