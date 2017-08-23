// 存储域名
localStorage.setItem('mt_network', 'http://fenxiao.qphvip.com/admin.php/');
var mt_network = localStorage.getItem('mt_network');

// {number} 会员id, 管理id, --后续还有各种--id
var mt_vip = 45, mt_manage = 16, mt_goods = 60;

// 1-导航列表active值, 2-导航增加active, 3-管理员列表, 4-管理员增加 --初始active的值--data-id
var navigalisthtml_data_id = 20, navigaaddhtml_data_id = 18, memberlisthtml_data_id = 38, info_data_id = 47;
var memberaddhtml_data_id = 25, grouplisthtml_data_id = 50, groupaddhtml_data_id = 52, membersLists_data_id = 46, grouplist = 48;
var membershiplevel_data_id=58, distributormanage_data_id = 59, attributeadd_data_id = 62, attributelist_data_id = 63;

/**
 * 
 * 选择导航
 * @param {Number} id 顶部导航id 
 * @param {Number} leftActive 左侧导航active
 */
function choiceNavigation(id, leftActive) {
    $(document).ajaxComplete(function() {
        // 初始化左侧菜单栏数据
        $('.bar-wrapper').each(function(index, element) {
            if ($(element).attr('data-fid') != id) {
                $(element).css('display', 'none')
            }
        });
        // 初始化顶部导航栏active
        $('.right-nav-hook').each(function(index, element) {
            if ($(element).attr('data-id') == String(id)) {
                $(this).addClass('active');
            }
        });
        // 初始化左侧菜单active
        if (leftActive) {
            $('.list-child-hook a').each(function(){
                if ($(this).attr('data-id') == leftActive) {
                    $(this).parent().addClass('active');
                }
            })
        }
    });
}
/**
 * 
 * 选时间的公共方法
 * @param {String} firstTime 起始时间
 * @param {String} FTposition 起始时间弹出款位置
 * @param {String} secondTime 结束时间
 * @param {String} STposition 结束时间弹出框位置
 */
function mt_timeFun(firstTime, FTposition, secondTime, STposition){
    var date = new Date();
    // 注册时间配置
    $(firstTime).datetimepicker({
        format: 'yyyy-mm-dd',
        autoclose: true,
        todayBtn: true,
        endDate: date, // 结束时间--今天
        minView: 2, // 选完日后，不在出现下级时间选择
        language: 'zh-CN',
        forceParse: true, // 强制解析
        pickerPosition: FTposition // 选择框位置
    }).on('hide', function () {
        if ($(firstTime).val() > $(secondTime).val() && $(secondTime).val() != '') {
            var diffDate = $(secondTime).val().valueOf();
            $(firstTime).val(diffDate);
        }
    });
    // 注册时间配置
    $(secondTime).datetimepicker({
        format: 'yyyy-mm-dd',
        autoclose: true,
        todayBtn: true,
        endDate: date, // 结束时间--今天
        minView: 2, // 选完日后，不在出现下级时间选择
        language: 'zh-CN',
        forceParse: true, // 强制解析
        pickerPosition: STposition // 选择框位置
    }).on('hide', function () {
        if ($(secondTime).val() < $(firstTime).val()) {
            var diffDate = $(firstTime).val().valueOf();
            $(secondTime).val(diffDate);
        }
    });
    
    // 初始哈弹出框
    toastr.options = {  
        closeButton: false,  
        debug: false,  
        progressBar: false,  
        positionClass: "toast-top-center",  
        onclick: null,  
        showDuration: "300",  
        hideDuration: "1000",  
        timeOut: "2000",  
        extendedTimeOut: "2000",  
        showEasing: "swing",  
        hideEasing: "linear",  
        showMethod: "fadeIn",  
        hideMethod: "fadeOut"  
    }; 
}

$(function () {
    function init() {
        $.ajax({
            url: "http://fenxiao.qphvip.com/admin.php/Login/Naviga",
            type: "GET",
            dataType: "json",
            success: function (data) {
                var myData = data.data;
                // 初始化加载顶部导航栏数据
                myData.forEach(function (val, index) {
                    var topList = $('<li class="right-nav">' +
                                        '<a href="javascript:;" data-id="' + val.id + '" data-fid="' + val.fid + '" class="right-nav-hook">' + val.name + '</a>' +
                                    '</li>');
                    $(".nav-wrapper-hook").append(topList);

                    // 初始化左侧菜单栏数据
                    var leftList = val.list;
                    leftList.forEach(function (val, index) {
                        var father_id = val.id;
                        var dtList = $('<dl class="bar-wrapper bar-wrapper-'+father_id+'" data-fid="'+val.fid+'" data-id="'+val.id+'">'+
                                            '<dt class="list">'+
                                                '<i class="glyphicon glyphicon-home"></i>'+
                                                '<span>'+val.name+'</span>'+
                                            '</dt>'+
                                        '</dl>');
                        $(".slidebar-hook").append(dtList);

                        // 初始化左侧菜单栏子级数据
                        var leftListChild = val.list;
                        leftListChild.forEach(function(val, index) {
                            var ddList = $('<dd class="list-child list-child-hook">'+
                                                '<a href="'+mt_network+val.url+'" data-id="'+val.id+'" data-fid="'+val.fid+'">'+val.name+'</a>'+
                                            '</dd>');
                            $(".slidebar-hook").find(".bar-wrapper-"+father_id).append(ddList);
                        })
                    })
                });

            }
        });

    };

    init();

    // 鼠标移入账户，显示相关选项
    $('.account-hook').on({
        mouseover: function() {
            $('.user-part-hook').removeClass('hide');
            $('.user').css('color', '#000').css('backgroundColor', '#fff');
            $(this).find('.user').css('borderBottom', 0)
        },
        mouseout: function(){
            $('.user-part-hook').addClass('hide');
            $('.user').css('color', '#fff').css('backgroundColor', '#2e6da4');
            $(this).find('.user').css('border', '1px solid #2e6da4');
        }
    });

    // 退出按钮的链接地址
    $('.user-part .exit a').attr('href', mt_network + 'Login/DelUser');
    
    // 点击顶部导航切换--左侧导航
    $('.nav-wrapper-hook').on('click', '.right-nav-hook', function(){
        var whichOne = $(this).attr('data-id');

        $('.bar-wrapper').each(function(index, element) {
            if ($(element).attr('data-fid') != whichOne) {
                $(element).css('display', 'none')
            } else {
                $(element).css('display', 'block')
            }
        });

        // 顶部导航栏增加active
        $(this).parent().siblings().find('a').removeClass('active');
        $(this).addClass('active');
    })

    // 点击左侧菜单栏，toggleSlide
    $('.slidebar-hook').on('click', '.list', function(){
        $(this).siblings().slideToggle();
    })
})

