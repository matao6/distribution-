<?php
/**
 * Login 用于后台登录
 * 2017-07-20
 * Angus
 * P:15011165711
 * */
namespace Home\Controller;
use Think\Controller;
class LoginController extends Controller {
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
     * 2017-07-20 Angus
     * */
    public function PostLogin(){
        $Phone = I('P');
        $Pwd = I('M');

        $LoginInfo = D('Login') ->Login($Phone, $Pwd);
        echo json_encode($LoginInfo);
    }

    /**
     * 后台管理员核实登录
     * @param Phone 电话号
     * @param Pwd 密码(md5)
     * @param Code 验证码
     * 2017-07-20 Angus
     * */
    public function CheckLogin(){
        $Phone = I('P');
        $Pwd = I('M');
        $Code = I('C');

        $LoginInfo = D('Login') ->CheckLogin($Phone, $Pwd, $Code);
        echo json_encode($LoginInfo);
    }

    /**
     * 注销登录
     * 2017-07-20 Angus
     * */
    public function DelUser(){
        session('User', '');
        $this->redirect('Login/Login');
    }

    /**
     * 验证码
     * @param Phone 电话号
     * 2017-07-20 Angus
     * */
    public function SendCode(){
        $Phone = I('P');
        if(empty($Phone)){echo json_encode(array('code'=>0, 'message'=>'手机号为空'));die;}
        $Json = array('code'=>'0', 'message'=>'请核实您的手机号码');
        if($this->phone($Phone)){
            $Rand = rand(100000, 999999);//验证
            $Msg = "尊敬的管理员，您本次的验证码是".$Rand."，请正确输入，注意保密哦!";
            $Send = sendClapiHome($Phone, $Msg);
            $Json['message'] = '验证码发送失败';
            if($Send){
                session('AdminCode', $Rand);
                $Json = array('code'=>'1', 'message'=>'验证码已发送');
            }
        }
        echo json_encode($Json);
    }

    /**
     * 校验手机号码
     * @param number $subject
     * @return number 0|1
     */
    public function phone($subject){
        return preg_match('/^1(3|4|5|7|8)(\d{9})$/', $subject);
    }

    /**
     * 导航列表
     * 2017-07-21 Angus
     * */
    public function Naviga(){
//        if(!empty($_SESSION['Naviga'])){echo json_encode(array('code'=>1, 'message'=>'成功', 'data'=>$_SESSION['Naviga']));exit;}
        $NavigaList = D('Login') ->Naviga();
        $Json = array('code'=>'0', 'message'=>'请联系总管理员给您分配权限哦~');
        if($NavigaList){
            $Json = array('code'=>1, 'message'=>'成功', 'data'=>$NavigaList);
        }
        echo json_encode($Json);
    }
}