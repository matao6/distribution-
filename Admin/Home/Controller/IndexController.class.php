<?php
/**
 * Index 控制器用于后台首页数据操作（包括登录）
 * 2017-07-19
 * Angus
 * P:15011165711
 * */
namespace Home\Controller;
use Think\Controller;
class IndexController extends AdminController {
    /**
     * 后台首页
     * 2017-07-19 Angus
     * */
    public function index(){
        $this->display();
    }

    /**
     * 跳转-后台登录页
     * 2017-07-19 Angus
     * */
    public function Login(){
        $this->display();
    }

    /**
     * 后台管理员登录
     * @param Phone 电话号
     * @param Pwd 密码(md5)
     * */
    public function PostLogin(){
        $Phone = I('P');
        $Pwd = I('M');

        $LoginInfo = D('Login') ->Login($Phone, $Pwd);
        print_r($LoginInfo);
    }
}