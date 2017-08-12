<?php
/**
 * 用户模型
 * 2017-07-19 Angus
 * */
namespace Home\Model;
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
		$User = M('Admin') ->field('uid, name, last_login_ip, group_id, state, pwd') ->where(array('mobile'=>$Phone, 'pwd'=>$Pwd)) ->find();

		if(empty($User)){
			return array('code'=>'0', 'message'=>'账号或密码有误');
		}

		if($User['state'] == 0){
			return array('code'=>'0', 'message'=>'该账号已禁用，请联系总管理员');
		}

		$Ip = $this->GetIP();
		if($Ip != $User['last_login_ip']){
			$Rand = rand(100000, 999999);//验证
			$Msg = "尊敬的管理员，您本次的验证码是".$Rand."，请正确输入，注意保密哦!";
			$Send = sendClapiHome($Phone, $Msg);
			if($Send){
				session('AdminIp', $Ip);
				session('AdminCode', $Rand);
				return array('code'=>'3', 'message'=>'检测到您登录地址与上次登录地址不同，请进行身份核实登录');
			}else{
				return array('code'=>'0', 'message'=>'检测到您登录异常,请用常用设备登录');
			}
		}

		$Power = $this->Power($User['group_id']);

		$Save['last_login_time'] = time();
		M('Admin') ->where(array('mobile'=>$Phone, 'pwd'=>$Pwd)) ->Save($Save);
		unset($User['state']);
		$User['last_login_time'] = time();
		$User['Power'] = $Power;
		session('User', $User);
		return array('code'=>'1', 'message'=>'登录成功', 'Name'=>$User['name']);
	}

	/**
	 * 用户登录
	 * @param Phone 电话
	 * @param Pwd 密码(md5)
	 * @param Code 验证码
	 * 2017-07-20 Angus
	 * */
	public function CheckLogin($Phone, $Pwd, $Code){
		$Scode = session('AdminCode');
		if(empty($Code) || $Code != $Scode){
			return array('code'=>'0', 'message'=>'验证码有误');
		}

		if(empty($Phone) || empty($Pwd)){
			return array('code'=>'0', 'message'=>'账号或密码有误');
		}

		$Pwd = md5($Pwd);
		$User = M('Admin') ->field('uid, name, last_login_ip, group_id, state') ->where(array('mobile'=>$Phone, 'pwd'=>$Pwd)) ->find();

		if(empty($User)){
			return array('code'=>'0', 'message'=>'账号或密码有误');
		}

		if($User['state'] == 0){
			return array('code'=>'0', 'message'=>'该账号已禁用，请联系总管理员');
		}

		$Ip = session('AdminIp');
		if(empty($Ip)){
			$Ip = $this->GetIP();
		}
		
		$Save['last_login_time'] = time();
		if($Ip != 'Unknow' && $Ip != $User['last_login_ip']){
			$Save['last_login_ip'] = $Ip;
		}

		$Power = $this->Power($User['group_id']);

		M('Admin') ->where(array('mobile'=>$Phone, 'pwd'=>$Pwd)) ->Save($Save);
		unset($User['state']);
		$User['last_login_time'] = time();
		$User['Power'] = $Power;
		session('User', $User);
		return array('code'=>'1', 'message'=>'登录成功', 'Name'=>$User['name']);
	}

	/**
	 * 获取当前登录ip
	 * 2017-07-19 Angus
	 * */
	public function GetIP(){
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

	/**
	 * 权限获取
	 * @param Gid 权限组id
	 * 2017-07-21 Angus
	 * */
	public function Power($Gid){
		$PowerAll = M('Navigation') ->where(array('state'=>1, 'url'=>array('neq', ''))) ->getField('id, url');
		$PowerSelf = array();
		if($Gid == 0){
			$PowerSelf = $PowerAll;
		}else{
			$PowerList = M('Power') ->where(array('group_id'=>$Gid)) ->getField('id, n_id');
			foreach($PowerList as $k => $v){
				if(isset($PowerAll[$v])){
					$PowerSelf[$k] = $PowerAll[$v];
				}
			}
		}
		return array('All'=>$PowerAll, 'Self'=>$PowerSelf);
	}

	/**
	 * 导航列表
	 * @param Gid 权限组id
	 * 2017-07-21 Angus
	 * */
	public function Naviga(){
		$GroupId = $_SESSION['User']['group_id'];
		$NavigationList = M('Navigation') ->field('id, url, name, fid') ->where(array('state'=>1, 'type'=>1)) ->order('sort asc') ->select();
		if($GroupId != 0){
			$PowerList = M('Power') ->where(array('group_id'=>$GroupId)) ->getField('id, n_id');
		}
		$Left = array();
		foreach($NavigationList as $k => $v){
			if($v['fid'] == 0){
				unset($NavigationList[$k]);
				unset($v['url']);
				foreach($NavigationList as $ke => $va){
					if($va['fid'] == $v['id']){
						unset($NavigationList[$ke]);
						unset($va['url']);
						foreach($NavigationList as $key => $val){
							if($val['fid'] == $va['id']){
								if($GroupId == 0 || in_array($val['id'], $PowerList)){
									$va['list'][] = $val;
								}
							}
						}
						if(!empty($va['list'])){
							$v['list'][] = $va;
						}
					}
				}
				if(!empty($v['list'])){
					$Left[] = $v;
				}
			}
		}
		session('Naviga', $Left);
		return $Left;
	}
}