$(function(){
    // 选择导航, 源码在common.js
    choiceNavigation(mt_vip, info_data_id);

    // 消费能力，积分明细等。。。的变化
    $('.tabs_a').click(function(){
        $(this).siblings().removeClass('active');
        $(this).addClass('active');

        var index = $(this).index();

        $('.tc').addClass('hide');
        $('.tc').eq(index).removeClass('hide');
    })

    $('.down-hook').click(function(){
        $('.togg').slideToggle();
    })
})