$(function () {

    // 选择导航 源码在common.js
    choiceNavigation(mt_vip,grouplist);

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

    // 新建分组
    $('.newGroup-hook').click(function () {
        bootbox.confirm({
            buttons: {
                confirm: {
                    label: '确定'
                },
                cancel: {
                    label: '取消'
                }
            },
            title: '添加分组',
            message: '<div class="jbox-container" style="height: 76px;">'+
                        '<div class="formitems inline">'+
                            '<label class="fi-name"><span class="red">*</span>分组名称：</label>'+
                            '<div class="form-controls">'+
                                '<input class="input" name="title" id="title" type="text">'+
                            '</div>'+
                        '</div>'+
                    '</div>',
            callback: function (result) {
				if ($('#title').val() == ''){
					return false;
				}
				var status = true;
                if (result) {
                     $.ajax({
                         url: mt_network + 'Mgroup/add',
                         type: 'POST',
                         async: false,
                         data: { title: $('#title').val()},
                         success: function (datas) {
							datas = JSON.parse(datas);
							if (datas.status != 1) {
								alert(datas.msg);
								status = false; 
							}else{
								alert(datas.msg);
								location.reload();
							}
                         }
                     });
                }
				return status;
            }
        })
    })

    // 编辑分组
    $('.edit-hook').click(function () {
		var uid = this.getAttribute('dataid');
		$.ajax({
			 url: mt_network + 'Mgroup/getInfo',
			 type: 'POST',
			 async: false,
			 data: { id: uid},
			 success: function (datas) {
				datas = JSON.parse(datas);
				if (datas.status != 1) {
					alert(datas.msg);
					status = false; 
				}else{
		
					bootbox.confirm({
						buttons: {
							confirm: {
								label: '确定'
							},
							cancel: {
								label: '取消'
							}
						},
						title: '编辑分组',
						message: '<div class="jbox-container" style="height: 76px;">'+
									'<div class="formitems inline">'+
										'<label class="fi-name"><span class="red">*</span>分组名称：</label>'+
										'<div class="form-controls">'+
											'<input class="input" name="title" id="title" type="text" value="'+datas.info.title+'">'+
										'</div>'+
									'</div>'+
								'</div>',
						callback: function (result) {
							var status = true;
							if (result) {
								 $.ajax({
								     url: mt_network + 'Mgroup/save',
								     type: 'POST',
								     async: false,
								     data: { id: uid,title:$('#title').val() },
								     success: function (datas) {
								         datas = JSON.parse(datas);
								         if (datas.status == 2) {
											location.href=mt_network+'Mgroup/lists';
										}else if (datas.status != 1) {
											alert(datas.msg);
											status = false; 
										}else{
											alert(datas.msg);
											location.reload();
										}
								     }
								 });
							}
							return status;
						}
					})
				}
			 }
		 });
  
    })

    // 删除分组
    $('.del-hook').click(function () {
		var uid = this.getAttribute('dataid');
        bootbox.confirm({
            buttons: {
                confirm: {
                    label: '确定'
                },
                cancel: {
                    label: '取消'
                }
            },
            title: '提示',
            message: '删除后将不可恢复，是否继续？',
            callback: function (result) {
                if (result) {
                    $.ajax({
						url: mt_network+'Mgroup/del',
						type: 'POST',
						async: false,
						data:{id: uid},
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

    $('.syncWeixin-hook').click(function(){
        alert()
    })

})