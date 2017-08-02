<?php
/**
 * 用户模型
 * 2017-07-19 Angus
 * */
namespace Admin\Model;
use Think\Model;

class LoginModel extends Model{
	/**
	 * 用户登录
	 * @param Phone 电话
	 * @param Pwd 密码(md5)
	 * 2017-07-19 Angus
	 * */
	public function Login($Phone, $Pwd){
		if(empty($Phone) || empty($Pwd)){
			return array('code'=>'0', 'message'=>'账号或密码有误');
		}

		$Pwd = md5($Pwd);
		$User = M('Admin') ->field('uid, name, last_login_ip, group_id, state') ->where(array('mobile'=>$Phone, 'pwd'=>$Pwd)) ->find();

		if(empty($User)){
			return array('code'=>'0', 'message'=>'账号或密码有误');
		}

		if($User['state'] == 0){
			return array('code'=>'2', 'message'=>'该账号已禁用，请联系总管理员');
		}

		$Ip = $this->GetIP();
		if($Ip != $User['last_login_ip']){
			session('AdminLogin', 1);//管理员登录信息核实状态
			session('AdminPhone', $Phone);
			session('AdminIp', $Ip);
			return array('code'=>'3', 'message'=>'检测到您登录地址与上次登录地址不同，请进行身份核实登录');
		}

		unset($User['state']);
		session(array('AdminInfo'=>$User, 'expire'=>3600));
		return array('code'=>'1', 'message'=>'登录成功', 'Name'=>$User['name']);
	}

	/**
	 * 获取当前登录ip
	 * 2017-07-19 Angus
	 * */
	function GetIP(){
		global $ip;
		if (getenv("HTTP_CLIENT_IP"))
			$ip = getenv("HTTP_CLIENT_IP");
		else if(getenv("HTTP_X_FORWARDED_FOR"))
			$ip = getenv("HTTP_X_FORWARDED_FOR");
		else if(getenv("REMOTE_ADDR"))
			$ip = getenv("REMOTE_ADDR");
		else $ip = "Unknow";
		return $ip;
	}
}