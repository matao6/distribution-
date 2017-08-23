$(function(){
    // 初始化左侧菜单，源码在--common.js
    choiceNavigation(mt_goods, customclass_data_id);

    // 初始化弹出框
    toastr.options = {
        closeButton: false,  
        debug: false,  
        progressBar: false,  
        positionClass: "toast-top-center",  
        onclick: null,  
        showDuration: "500",  
        hideDuration: "500",  
        timeOut: "1000",  
        extendedTimeOut: "1000",  
        showEasing: "swing",  
        hideEasing: "linear",  
        showMethod: "fadeIn",  
        hideMethod: "fadeOut"  
    };  
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
            toastr.warning('请选择要删除的数据');
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
    });

    // 添加类目
    $('.newGroup-hook').click(function(){

    })

    // 选择商品中弹框中--关闭按钮
    $('.B_del-hook').click(function(){
        $('.chooseGoods').addClass('hide');
    })

    // 指定商品点击--显示选择商品弹框
    $(document).on('click', '.addGoods-hook', function(){
        $('.chooseGoods').removeClass('hide');
    })
})