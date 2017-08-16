$(function () {
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



    // fadeOut父节点
    function removeParent() {
        $(this).parent().fadeOut();
    }
    $('.removeParent').click(removeParent)

    // 编辑列表按钮
    $('.listsEdit-hook').click(function () {
		var uid = this.getAttribute('dataid');
		$.ajax({
            url: mt_network+'Members/getInfo',
            type: 'POST',
            async: false,
            data:{id: uid},
            success: function (data){
                data = JSON.parse(data);
                if (data.status != 1) { alert(data.msg); return false; }
				bootbox.confirm({
					title: '编辑会员',
					message: '<div class="edit-wrapper"><input type="hidden" name="mid" id="mid" value="'+data.info.id+'">'+
									'<div class="formitems">'+
										'<label class="fi-name">买家姓名：</label>'+
										'<div class="form-controls">'+
											'<input name="realname" id="realnames" class="input" value="'+data.info.realname+'" type="text">'+
										'</div>'+
									'</div>'+
									'<div class="formitems">'+
										'<label class="fi-name">手机号：</label>'+
										'<div class="form-controls">'+
											'<input name="phone" id="phones" class="input" value="'+data.info.phone+'" type="text">'+
										'</div>'+
									'</div>'+
									'<div class="formitems">'+
										'<label class="fi-name">密码：</label>'+
										'<div class="form-controls">'+
											'<input name="password" class="input" type="password" id="password">'+
										'</div>'+
									'</div>'+
									'<div class="formitems">'+
										'<label class="fi-name">邮箱：</label>'+
										'<div class="form-controls">'+
											'<input name="email" class="input" value="'+data.info.email+'" type="text" id="email">'+
										'</div>'+
									'</div>'+
									'<div class="formitems">'+
										'<label class="fi-name">生日：</label>'+
										'<div class="form-controls">'+
											'<input name="birthday" value="'+data.info.birthday+'" id="birthday" class="input" type="text">'+
										'</div>'+
									'</div>'+
									'<div class="formitems">'+
										'<label class="fi-name">备注：</label>'+
										'<div class="form-controls">'+
											'<input name="note" class="input" value="'+data.info.note+'" type="text" id="note">'+
										'</div>'+
									'</div>'+
								'</div>',
					buttons: {
						confirm: {
							label: '确定'
						},
						cancel: {
							label: '取消'
						}
					},
					callback: function (result) {
						var status = true;
						if (result) {
							$.ajax({
								url: mt_network+'Members/save',
								type: 'POST',
								async: false,
								data:{id: $('#mid').val(),realname:$('#realnames').val(),password:$('#password').val(),phone:$('#phones').val(),email:$('#email').val(),birthday:$('#birthday').val(),note:$('#note').val()},
								success: function (datas){
										datas = JSON.parse(datas);
										if (datas.status == 2) {
											location.href=mt_network+'Members/lists';
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
				});
				$('#birthday').datetimepicker({
					format: 'yyyy-mm-dd',
					autoclose: true,
					todayBtn: true,
					endDate: date, // 结束时间--今天
					minView: 2, // 选完日后，不在出现下级时间选择
					language: 'zh-CN',
					forceParse: true, // 强制解析
					pickerPosition: 'bottom-left' // 选择框位置
				});
            }
        })
    });

    // 删除列表按钮
    $('.listsDelete-hook').click(function() {
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
            title: '删除会员',
            message: '除非必要，请不要随意删除会员，删除了会员后，此会员将访问不了您的店铺！您确定要删除此会员吗？',
            callback: function (result) {
                if (result) {
                    $.ajax({
						url: mt_network+'Members/del',
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

    // 设为分销商
    $('.setFenBusiness-hook').click(function(){
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
                    alert('传到后台。。')
                }
            }
        })
    });

    // 设置等级
    $('.setGrade-hook').click(function(){
        bootbox.confirm({
            buttons: {
                confirm: {
                    label: '确定'
                },
                cancel: {
                    label: '取消'
                }
            },
            title: '设置会员等级',
            message: '<div>'+
                        '<div class="formitems inline">'+
                            '<label class="fi-name">会员昵称：</label>'+
                            '<div class="form-controls pdt3"></div>'+
                        '</div>'+
                        '<div class="formitems inline">'+
                            '<label class="fi-name">会员等级：</label>'+
                            '<div class="form-controls">'+
                                '<select name="rank" class="select">'+
                                    '<option value="">test</option>'+
                                '</select>'+
                            '</div>'+
                        '</div>'+
                    '</div>',
            callback: function (result) {
                if (result) {
                    alert('chuan~')
                }
            }
        })
    });

    // 设置积分验证
    $(document).on('blur', '#integral', function(){
            var st = /^[-+]?[0-9]+(\.[0-9]+)?$/;
            var thisSt = $(this).val();
            if (!st.test(thisSt)) {
                $(this).val('');
            }
    	})

    // 设置积分
    $('.setIntegral-hook').click(function(){
		var uid = this.getAttribute('dataid');
		$.ajax({
            url: mt_network+'Members/getInfo',
            type: 'POST',
            async: false,
            data:{id: uid},
            success: function (data){
                data = JSON.parse(data);
                if (data.status != 1) { alert(data.msg); return false; }
					bootbox.confirm({
						buttons: {
							confirm: {
								label: '确定'
							},
							cancel: {
								label: '取消'
							}
						},
						title: '调整积分',
						message: '<div class="jbox-container" style="height: 229px;">'+
									'<div>'+
										'<div class="formitems inline">'+
											'<label class="fi-name">会员姓名：</label>'+
											'<div class="form-controls pdt3">'+data.info.wx.wx_name+'</div>'+
										'</div>'+
										'<div class="formitems inline">'+
											'<label class="fi-name">当前积分：</label>'+
											'<div class="form-controls pdt3">'+data.info.integral+'</div>'+
										'</div>'+
										'<div class="formitems inline">'+
											'<label class="fi-name"><span class="colorRed">*</span>增加或减少积分：</label>'+
											'<div class="form-controls">'+
												'<input name="integral" class="input mini" id="integral" type="text">'+
												'<span>分</span>'+
												'<span class="fi-help-text"></span>'+
											'</div>'+
										'</div>'+
										'<div class="formitems inline">'+
											'<label class="fi-name">备注：</label>'+
											'<div class="form-controls">'+
												'<textarea name="note" id="note" class="textarea" style="width:270px;height:120px;"></textarea>'+
											'</div>'+
										'</div>'+
									'</div>'+
								'</div>',
						callback: function (result) {
							var status = true;
							if (result) {
								var st = /^[-+]?[0-9]+(\.[0-9]+)?$/;
								var thisSt = $('#integral').val();
								if (!st.test(thisSt)) {
									$('#integral').val('');
									alert('输入格式有误！');
									status = false;
								}else{
									$.ajax({
										url: mt_network+'Members/setIntegral',
										type: 'POST',
										async: false,
										data:{id: uid,integral:$('#integral').val(),note:$('#note').val()},
										success: function (datas){
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
							}
							return status;
						}
					});
			}
		});
    });

    // 设置余额
    $('.setBalance-hook').click(function(){

		var uid = this.getAttribute('dataid');
		$.ajax({
            url: mt_network+'Members/getInfo',
            type: 'POST',
            async: false,
            data:{id: uid},
            success: function (data){
                data = JSON.parse(data);
                if (data.status != 1) { alert(data.msg); return false; }
					bootbox.confirm({
						buttons: {
							confirm: {
								label: '确定'
							},
							cancel: {
								label: '取消'
							}
						},
						title: '设置余额',
						message: '<div class="jbox-container" style="height: 229px;">'+
										'<div>'+
											'<div class="formitems inline">'+
												'<label class="fi-name">会员姓名：</label>'+
												'<div class="form-controls pdt3">'+data.info.wx.wx_name+'</div>'+
											'</div>'+
											'<div class="formitems inline">'+
												'<label class="fi-name">当前余额：</label>'+
												'<div class="form-controls pdt3">'+data.info.account_balance+'</div>'+
											'</div>'+
											'<div class="formitems inline">'+
												'<label class="fi-name"><span class="colorRed">*</span>增加或减少余额：</label>'+
												'<div class="form-controls">'+
													'<input name="account_balance" id="account_balance" class="input mini" type="text">'+
													'<span class="fi-help-text"></span>'+
												'</div>'+
											'</div>'+
											'<div class="formitems inline">'+
												'<label class="fi-name">备注：</label>'+
												'<div class="form-controls">'+
													'<textarea name="account_note" id="account_note" class="textarea" style="width:270px;height:120px;"></textarea>'+
												'</div>'+
											'</div>'+
										'</div>'+
									'</div>',
						callback: function (result) {
							var status = true;
							if (result) {
								var st = /^[-+]?[0-9]+(\.[0-9]+)?$/;
								var thisSt = $('#account_balance').val();
								if (!st.test(thisSt)) {
									$('#account_balance').val('');
									alert('输入格式有误！');
									status = false;
								}else{
									$.ajax({
										url: mt_network+'Members/setAccountBalance',
										type: 'POST',
										async: false,
										data:{id: uid,account_balance:$('#account_balance').val(),note:$('#account_note').val()},
										success: function (datas){
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
							}
							return status;
						}
					});
			}
		});
    });

    // 发放优惠券
    $('.sendDiscounts-hook').click(function(){
        bootbox.confirm({
            buttons: {
                confirm: {
                    label: '确定'
                },
                cancel: {
                    label: '取消'
                }
            },
            title: '送优惠券',
            message: '<div class="jbox-container" style="height: 129px;">'+
                        '<div>'+
                            '<div class="formitems inline">'+
                                '<label class="fi-name">会员等级：</label>'+
                                '<div class="form-controls">'+
                                    '<select name="rank_id" class="select">'+
                                        '<option value="">test</option>'+
                                    '</select>'+
                                    '<span class="fi-help-text">选择会员等级时会按会员等级发放，不选按选中会员发放</span>'+
                                '</div>'+
                            '</div>'+
                            '<div class="formitems inline">'+
                                '<label class="fi-name">选择优惠券：</label>'+
                                '<div class="form-controls">'+
                                    '<select name="coupon_id" class="select">'+
                                        '<option value="">test</option>'+
                                    '</select>'+
                                '</div>'+
                            '</div>'+
                            '<div class="formitems inline">'+
                                '<label class="fi-name">数量：</label>'+
                                '<div class="form-controls">'+
                                    '<input name="coupon_num" class="input mini" value="1" type="text">'+
                                    '<span class="fi-help-text"></span>'+
                                '</div>'+
                            '</div>'+
                        '</div>'+
                    '</div>',
            callback: function (result) {
                if (result) {
                    alert('传到后台。。')
                }
            }
        })
    });

    // 发红包
    $('.sendMoney-hook').click(function(){
        bootbox.confirm({
            buttons: {
                confirm: {
                    label: '确定'
                },
                cancel: {
                    label: '取消'
                }
            },
            title: '发红包',
            message: '<div class="jbox-container" style="height: 121px;">'+
                        '<div>'+
                            '<div class="formitems inline">'+
                                '<label class="fi-name">会员昵称：</label>'+
                                '<div class="form-controls pdt3">test</div>'+
                            '</div>'+
                            '<div class="formitems inline">'+
                                '<label class="fi-name"><span class="colorRed">*</span>红包金额：</label>'+
                                '<div class="form-controls">'+
                                    '<input name="total_amount" class="input mini" type="text">'+
                                    '<span>元</span>'+
                                    '<span class="fi-help-text">红包金额介于[1.00元，200.00元]之间</span>'+
                                '</div>'+
                            '</div>'+
                            '<div class="formitems inline">'+
                                '<label class="fi-name"><span class="colorRed">*</span>祝福语：</label>'+
                                '<div class="form-controls">'+
                                    '<input name="wishing" class="input large">'+
                                    '<span class="fi-help-text"></span>'+
                                '</div>'+
                            '</div>'+
                        '</div>'+
                    '</div>',
            callback: function (result) {
                if (result) {
                    alert('传到后台。。')
                }
            }
        })
    });

    // 重置支付密码
    $('.resetPassword-hook').click(function(){
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
            title: '重置支付密码',
            message: '<div class="jbox-container" style="height: 76px;">'+
                        '<div>'+
                            '<div class="formitems inline">'+
                                '<label class="fi-name">密码：</label>'+
                                '<div class="form-controls pdt3"><input type="text" name="password" id="paypwd" class="input" value=""></div>'+
                            '</div>'+
                        '</div>'+
                    '</div>',
            callback: function (result) {
				var status = true;
                if (result) {
                    $.ajax({
						url: mt_network+'Members/setPaypwd',
						type: 'POST',
						async: false,
						data:{id:uid,paypwd:$('#paypwd').val() },
						success: function (datas){
								datas = JSON.parse(datas);
								if (datas.status == 2) {
									location.href=mt_network+'Members/lists';
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
    });

    // 发送站内信
    $('.sendMessage-hook').click(function(){
        bootbox.confirm({
            buttons: {
                confirm: {
                    label: '确定'
                },
                cancel: {
                    label: '取消'
                }
            },
            title: '发送站内信',
            message: '<div class="jbox-container" style="height: 125px;">'+
                        '<div>'+
                            '<div class="formitems">'+
                                '<label class="fi-name">发送内容：</label>'+
                                '<div class="form-controls">'+
                                    '<textarea name="content" id="" class="textarea small"></textarea>'+
                                '</div>'+
                            '</div>'+
                        '</div>'+
                    '</div>',
            callback: function (result) {
                if (result) {
                    alert('传到后台。。')
                }
            }
        })
    });

    // 全选按钮
    $('.selectAll-hook').click(function(){
        $('.checkbox-hook').prop('checked', true);
    })

    // 取消全选按钮
    $('.cancelAll-hook').click(function(){
        $('.checkbox-hook').prop('checked', false);
    })

    // 批量设置等级
    $('.setManyGrade-hook').click(function(){
        if ($('.checkbox-hook:checkbox:checked').length <= 0) {
            bootbox.alert('请选择需要设置的会员');
            return false;
        } else {
            bootbox.confirm({
                buttons: {
                    confirm: {
                        label: '确定'
                    },
                    cancel: {
                        label: '取消'
                    }
                },
                title: '批量设置用户等级',
                message: '<div class="jbox-container" style="height: 76px;"><div>'+
                            '<div class="formitems inline">'+
                                '<label class="fi-name">会员等级：</label>'+
                                '<div class="form-controls">'+
                                    '<select name="rank" class="select">'+
                                        '<option value="">test</option>'+
                                    '</select>'+
                                '</div>'+
                            '</div>'+
                        '</div></div>',
                callback: function(result){
                    if (result) {
                        alert('这次可以传~~~传~~~传~~~')
                    }
                }
            })
        }
    });

	// 批量设置分组
    $('.setManyGrade-group').click(function(){
        if ($('.checkbox-hook:checkbox:checked').length <= 0) {
            bootbox.alert('请选择需要设置的会员');
            return false;
        } else {
			var id = new Array();
			$('.checkbox-hook:checkbox:checked').each(function(){ id.push($(this).val()); });
			var str_id = id.join(',');
			$.ajax({
				 url: mt_network + 'Members/getMgroup',
				 type: 'POST',
				 async: false,
				 data: {id:str_id},
				 success: function (datas) {
						datas = JSON.parse(datas);
						var option = '';
						for (var i=0;i<datas.info.length;i++){ option += '<option value="'+datas.info[i]['id']+'">'+datas.info[i]['title']+'</option>'; }
						bootbox.confirm({
							buttons: {
								confirm: {
									label: '确定'
								},
								cancel: {
									label: '取消'
								}
							},
							title: '批量设置用户组',
							message: '<div class="jbox-container" style="height: 76px;"><div>'+
										'<div class="formitems inline">'+
											'<label class="fi-name">会员用户组：</label>'+
											'<div class="form-controls">'+
												'<select name="mgroups" class="select" id="mgroups">'+option+
												'</select>'+
											'</div>'+
										'</div>'+
									'</div></div>',
							callback: function(result){
									var gid = $('#mgroups').val();
									var status = true;
									if (result) {
										$.ajax({
											url: mt_network+'Members/setMgroup',
											type: 'POST',
											async: false,
											data:{id:str_id,gid:gid },
											success: function (datas){
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
						});
				 }
			 });
        }
    })

})