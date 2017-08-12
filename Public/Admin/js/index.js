$(function () {
    // fadeOut父节点
    function removeParent() {
        $(this).parent().fadeOut();
    }
    $('.removeParent').click(removeParent);

    // 初始化左侧导航，源码在---common.js
    choiceNavigation(mt_vip);
})