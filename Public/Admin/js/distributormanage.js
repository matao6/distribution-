$(function(){
    // 初始化左侧菜单，源码在--common.js
    choiceNavigation(mt_vip, distributormanage_data_id);
    
    // fadeOut父节点
    function removeParent() {
        $(this).parent().fadeOut();
    }
    $('.removeParent-hook').click(removeParent);

    // 初始化时间选择器，源码在--common.js
    // 注册时间 
    mt_timeFun('input[name="start_time"]', 'bottom-left', 'input[name="end_time"]', 'bottom-right');
    // 分销商时间
    mt_timeFun('input[name="agent_time_start"]', 'bottom-left', 'input[name="agent_time_end"]', 'bottom-right');
    // 到期时间
    mt_timeFun('input[name="expire_time_start"]', 'bottom-left', 'input[name="expire_time_end"]', 'bottom-right');

    // 
    $('.wxtables-hook').on('click', '.edit-hook', function(){
        
    })
})