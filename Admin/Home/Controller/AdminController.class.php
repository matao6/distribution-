<?php
/**
 * Index 后台共用控制器
 * 2017-07-20
 * Angus
 * P:15011165711
 * */
namespace Home\Controller;
use Think\Controller;
class AdminController extends Controller {

    /**
     * 后台控制器初始化
     * 2017-07-20
     * Angus
     */
    protected function _initialize(){

        //判断用户登录 不存在跳转 存在重新赋值
        if(!isset($_SESSION['User'])){
            $this->redirect('Login/Login');
        }

        //当有用户操作时  没10分钟重新存储一下session  防止过期
        if(time() - $_SESSION['User']['last_login_time'] > 600){
            $User = $_SESSION['User'];
            $User['last_login_time'] = time();
            session('User', $_SESSION['User']);
        }

        //权限控制
        if(in_array($_SERVER['PATH_INFO'], $_SESSION['User']['Power']['All']) && !in_array($_SERVER['PATH_INFO'], $_SESSION['User']['Power']['Self'])){
            $this->error('您没有权限');
        }

    }

    public function UploadOne($Files){
        $config = array(
            'maxSize'    =>    3145728,
            'savePath'   =>    './admin/',
            'saveName'   =>    array('uniqid',''),
            'exts'       =>    array('jpg', 'gif', 'png', 'jpeg'),
            'autoSub'    =>    true,
            'subName'    =>    array('date','Ymd'),
        );
        $upload=new \Think\Upload($config);
        $info=$upload->uploadOne($Files);
        if(!$info){
            $Return = array('code'=>'0', 'message'=>$upload->getError());
        }else{
            $Return = array('code'=>'1', 'message'=>'成功', 'data'=>$info);
        }
        return $Return;
    }
}