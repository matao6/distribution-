<?php
/**
 * Members  用于后台用户相关操作
 * 2017-07-28
 * Aries
 * P:15010221225
 * */
namespace Home\Controller;
use Think\Controller;
class MsuperiorController extends Controller {

	public $sex = array(
		'0'=>'',
		'1'=>'男',
		'2'=>'女'
	);

	public $source_type = array(
		'1'=>'微商城',
		'2'=>'APP',
		'3'=>'PC电脑'
	);

	public $sort_type = array(
		'1'=>'总积分排序',
		'2'=>'总消费金额排序',
		'3'=>'下级会员数排序'
	);


	/**
	*  用户列表
	* 2017-07-28 Aries
	* */
	public function lists(){

		$this->display();
	}
	
	/**
	* 编辑保存用户
	* 2017-07-28 Aries
	* */
	public function save(){
		$id = I('post.id','');
		$password = I('post.password','');
		$phone = I('post.phone','');
		if (empty($id)){ die(json_encode(array('status'=>'0','msg'=>'非法参数！')));exit; }
		$userinfo = M('Members')->where('`id`='.$id.' AND `status` != 3')->find();
		if (empty($userinfo)){ die(json_encode(array('status'=>'2','msg'=>'用户不存在或已删除！')));exit; }
		$data['id'] = $id;
		if (!empty($password)){ $data['password'] = md5($password);}
		if (!empty($phone)){
			$rel = M('Members')->where('`id` !='.$id." AND `status` != 3 AND phone='".$phone."'")->find();
			if (!empty($rel)){ die(json_encode(array('status'=>'0','msg'=>'手机号已经注册过！')));exit;}
			$data['phone'] = I('post.phone','');
		}
		$data['realname'] = I('post.realname','');
		$data['email'] = I('post.email','');
		$data['birthday'] = I('post.birthday','');
		$data['note'] = I('post.note','');
		$result = M('Members')->save($data);
		if ($result === false){ die(json_encode(array('status'=>'0','msg'=>'编辑更新失败')));exit; }
		die(json_encode(array('status'=>'1','msg'=>'恭喜您，编辑成功！')));exit;
	}
	
	/**
	*  修改支付密码
	* 2017-08-09 Aries
	* */
	public function setPaypwd(){
		$id = I('post.id','');
		$paypwd = I('post.paypwd','');
		if (empty($id) || empty($paypwd)){ die(json_encode(array('status'=>'0','msg'=>'非法参数！')));exit; }
		if (strlen($paypwd) < 6){ die(json_encode(array('status'=>'0','msg'=>'密码不能少于6位！')));exit; }
		$userinfo = M('Members')->where('`id`='.$id.' AND `status` != 3')->find();
		if (empty($userinfo)){ die(json_encode(array('status'=>'0','msg'=>'用户不存在或已删除！')));exit; }
		$data['id'] = $id;
		$data['paypwd'] = $paypwd;
		$result = M('Members')->save($data);
		if ($result === false){ die(json_encode(array('status'=>'0','msg'=>'修改密码失败')));exit; }
		die(json_encode(array('status'=>'1','msg'=>'恭喜您，重置支付密码成功！')));exit;
	}

	/**
	*  删除用户
	* 2017-08-09 Aries
	* */
	public function del(){
		$id = I('post.id','');
		if (empty($id)){ die(json_encode(array('status'=>'0','msg'=>'非法参数！')));exit; }
		$userinfo = M('Members')->where('`id`='.$id.' AND `status` != 3')->find();
		if (empty($userinfo)){ die(json_encode(array('status'=>'0','msg'=>'用户不存在或已删除！')));exit; }
		$data['id'] = $id;
		$data['status'] = 3;
		$result = M('Members')->save($data);
		if ($result > 0){ die(json_encode(array('status'=>'1','msg'=>'恭喜您，删除用户成功！')));exit; }
		die(json_encode(array('status'=>'0','msg'=>'删除失败！')));exit;
	}

	/**
	*  获取用户信息
	* 2017-08-09 Aries
	* */
	public function getInfo(){
		$id = intval(I('post.id',''));
		if (empty($id)){ die(json_encode(array('status'=>'0','msg'=>'非法参数！')));exit; }
		$userinfo = M('Members')->where('id='.$id.' AND status!=3')->find();
		if(empty($userinfo)){ die(json_encode(array('status'=>'0','msg'=>'用户不存在或已删除！')));exit; }
		die(json_encode(array('status'=>'1','info'=>$userinfo)));exit;
	}




}
?>