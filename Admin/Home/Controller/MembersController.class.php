<?php
/**
 * Members  用于后台用户相关操作
 * 2017-07-28
 * Aries
 * P:15010221225
 * */
namespace Home\Controller;
use Think\Controller;
class MembersController extends AdminController {

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

	public $integral_type = array(
		'1'=>'赠送积分',
		'2'=>'卖家调整'
	);

	public $money_type = array(
		'1'=>'卖家调整余额'
	);


	/**
	*  用户列表
	* 2017-07-28 Aries
	* */
	public function lists(){
		$uid = I('get.uid','');
		$phone = I('get.phone','');
		$starttime = I('get.starttime','');
		$endtime = I('get.endtime','');
		$group = I('get.group','');
		$status = I('get.status','1');
		$sort = I('get.sort_type','');
		$p = I('get.p',1);
		$group_list = M('Mgroup')->where('status=1')->select();
		$where = ' 1 ';
		$order = ' ORDER BY a.id DESC';
		if (!empty($uid)){ $where .= " AND (a.id = '".$uid."' OR a.realname ='".$uid."')"; }
		if (!empty($phone)){ $where .= " AND (a.phone = '".$phone."' OR a.username = '".$phone."')"; }
		if (!empty($starttime)){ $where .= ' AND a.createtime >= '.strtotime($starttime.' 00:00:00'); }
		if (!empty($endtime)){ $where .= ' AND a.createtime <= '.strtotime($endtime.' 23:59:59'); }
		if (!empty($group)){ $where .= ' AND a.m_group_id = '.$group; }
		if (!empty($status)){ $where .= ' AND a.status != 3'; }
		if (!empty($sort)){ if ($sort == '1'){ $order = ' ORDER BY a.integral DESC';  } }
		$sql = "SELECT COUNT(*) AS num FROM qph_members AS a WHERE ".$where;
		$Model = new \Think\Model();
		$result = $Model->getOne($sql);
		$list = array();
		if ($result['num'] > 0){
			$limit = 20;
			$Page = new \Think\Page($result['num'],$limit);
			$show = $Page->new_show();
			$_sql = "SELECT a.*, b.wx_name AS superior_name FROM qph_members AS a LEFT JOIN qph_members_wxinfo AS b ON a.superior_id = b.uid WHERE ".$where.$order.' , a.id DESC LIMIT '.$Page->firstRow.','.$Page->listRows;
			$list = $Model->query($_sql);
			$this->assign('page',$show);
		}
		$this->assign('list',$list);
		$this->assign('uid',$uid);
		$this->assign('group_list',$group_list);
		$this->assign('group',$group);
		$this->assign('phone',$phone);
		$this->assign('starttime',$starttime);
		$this->assign('endtime',$endtime);
		$this->assign('status',$status);
		$this->assign('sort',$sort);


		$this->assign('sort_type',$this->sort_type);

		$this->display();
	}

	/**
	*  用户详情
	* 2017-08-10 Aries
	* */
	public function info(){
		$id = I('get.id','');
		if (empty($id)){ die(json_encode(array('status'=>'0','msg'=>'非法参数！')));exit; }
		$userinfo = M('Members')->where('id='.$id.' AND status != 3')->find();
		if (empty($userinfo)){ die(json_encode(array('status'=>'0','msg'=>'用户不存在或已删除！')));exit; }
		$wxinfo = M('MembersWxinfo')->where('uid='.$id)->find();
		$this->assign('wxinfo',$wxinfo);
		$this->assign('info',$userinfo);
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
	*  修改用户积分
	* 2017-08-10 Aries
	* */
	public function setIntegral(){
		$id = intval(I('post.id',''));
		if (empty($id)){ die(json_encode(array('status'=>'0','msg'=>'非法参数！')));exit; }
		$userinfo = M('Members')->where('id='.$id.' AND status!=3')->find();
		if(empty($userinfo)){ die(json_encode(array('status'=>'0','msg'=>'用户不存在或已删除！')));exit; }
		$integral = I('post.integral','');
		$note = I('post.note','');
		if (($userinfo['integral'] + $integral ) < 0){ die(json_encode(array('status'=>'0','msg'=>'用户积分不够！')));exit; }
		$str = substr($integral,0,1);
		$type = 1;
		if ($str === '-'){ $type = 2; }
		$data['uid'] = $id;
		$data['type'] = $type;
		$data['original'] = $userinfo['integral'];
		$data['last'] = $userinfo['integral'] + $integral;
		$data['change'] = $integral;
		$data['note'] = $note;
		$data['createtime'] = time();
		$data['createuserid'] = $_SESSION['User']['uid'];
		$trans = new \Think\Model();
                $trans->startTrans();
		if (!M('IntegralLog')->add($data)){ die(json_encode(array('status'=>'0','msg'=>'用户积分变更日志添加失败！')));exit; }
		$datainfo['id'] = $id;
		$datainfo['integral'] = $data['last'];
		if(!M('Members')->save($datainfo)){
			$trans->rollback();
			die(json_encode(array('status'=>'0','msg'=>'更新用户积分失败！')));exit;
		}
		$trans->commit();
		die(json_encode(array('status'=>'1','msg'=>'恭喜您，积分调整成功！')));exit;
	}

	/**
	*  修改用户余额
	* 2017-08-14 Aries
	* */
	public function setAccountBalance(){
		$id = intval(I('post.id',''));
		if (empty($id)){ die(json_encode(array('status'=>'0','msg'=>'非法参数！')));exit; }
		$userinfo = M('Members')->where('id='.$id.' AND status!=3')->find();
		if(empty($userinfo)){ die(json_encode(array('status'=>'0','msg'=>'用户不存在或已删除！')));exit; }
		$account_balance = I('post.account_balance','');
		$note = I('post.note','');
		if (($userinfo['account_balance'] + $account_balance ) < 0){ die(json_encode(array('status'=>'0','msg'=>'用户余额不够！')));exit; }
		$data['uid'] = $id;
		$data['type'] = 1;
		$data['original'] = $userinfo['account_balance'];
		$data['last'] = $userinfo['account_balance'] + $account_balance;
		$data['money'] = $account_balance;
		$data['note'] = $note;
		$data['createtime'] = time();
		$data['createuserid'] = $_SESSION['User']['uid'];
		$trans = new \Think\Model();
                $trans->startTrans();
		if (!M('MoneyLog')->add($data)){ die(json_encode(array('status'=>'0','msg'=>'用户余额变更日志添加失败！')));exit; }
		$datainfo['id'] = $id;
		$datainfo['account_balance'] = $data['last'];
		if(!M('Members')->save($datainfo)){
			$trans->rollback();
			die(json_encode(array('status'=>'0','msg'=>'更新用户余额失败！')));exit;
		}
		$trans->commit();
		die(json_encode(array('status'=>'1','msg'=>'恭喜您，用户余额调整成功！')));exit;
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
		$wxinfo = M('MembersWxinfo')->where('uid='.$id)->find();
		$userinfo['wx'] = $wxinfo;
		die(json_encode(array('status'=>'1','info'=>$userinfo)));exit;
	}

	/**
	*  获取用户分组
	* 2017-08-09 Aries
	* */
	public function getMgroup(){
		$id = I('post.id','');
		if (empty($id)){ die(json_encode(array('status'=>'0','msg'=>'请先选择用户！')));exit; }
		$list = M('Mgroup')->where('status=1')->select();
		die(json_encode(array('status'=>'1','info'=>$list)));exit;
	}

	/**
	*  批量设置用户分组
	* 2017-08-09 Aries
	* */
	public function setMgroup(){
		$id = I('post.id','');
		$gid = I('post.gid','');
		if (empty($id) || empty($gid)){ die(json_encode(array('status'=>'0','msg'=>'非法参数！')));exit; }
		$info = M('Mgroup')->where('`id` = '.$gid.') AND `status` = 1')->find();
		if (!empty($info)){ die(json_encode(array('status'=>'0','msg'=>'有用户组不存在或已删除！')));exit; }
		$data['m_group_id'] = $gid;
		if (!M('Members')->where('id in('.$id.')')->save($data)){ die(json_encode(array('status'=>'0','msg'=>'用户设置分组失败！')));exit; }
		die(json_encode(array('status'=>'1','msg'=>'恭喜您，用户设置分组成功！')));exit;
	}

	/**
	*  用户详情积分变动日志
	* 2017-08-14 Aries
	* */
	public function getIntegralLog(){
		$page = intval($_GET['page']);
		$uid = intval($_GET['uid']);
		$Model = new \Think\Model();
		$sql = "SELECT COUNT(*) AS num FROM qph_integral_log WHERE uid=".$uid;
		$result = $Model->getOne($sql);
		$total_num = $result['num'];
		$page_size = 10;
		$page_total = ceil($total_num / $page_size);
		$page_start = $page * $page_size; 
		$arr = array("total_num" =>$total_num, "page_size" =>$page_size, "page_total_num" =>$page_total); 
		$query = $Model->query("SELECT `type`, `original`, `last`, `change`, note, createtime FROM qph_integral_log WHERE uid =".$uid." ORDER BY id DESC LIMIT $page_start,$page_size"); 
		foreach($query as $k=>$v){
			$v['types'] = $this->integral_type[$v['type']];
			$v['createtime'] = date('Y-m-d H:i:s',$v['createtime']);
			$arr['list'][] = $v; 
		}
		die( json_encode($arr) );exit;
	}

	/**
	*  用户详情余额变动日志
	* 2017-08-14 Aries
	* */
	public function getMoneyLog(){
		$page = intval($_GET['page']);
		$uid = intval($_GET['uid']);
		$Model = new \Think\Model();
		$sql = "SELECT COUNT(*) AS num FROM qph_money_log WHERE uid=".$uid;
		$result = $Model->getOne($sql);
		$total_num = $result['num'];
		$page_size = 10;
		$page_total = ceil($total_num / $page_size);
		$page_start = $page * $page_size; 
		$arr = array("total_num" =>$total_num, "page_size" =>$page_size, "page_total_num" =>$page_total); 
		$query = $Model->query("SELECT `type`, `original`, `last`, `money`, note, createtime FROM qph_money_log WHERE uid =".$uid." ORDER BY id DESC LIMIT $page_start,$page_size"); 
		foreach($query as $k=>$v){
			$v['types'] = $this->money_type[$v['type']];
			$v['createtime'] = date('Y-m-d H:i:s',$v['createtime']);
			$arr['list'][] = $v; 
		}
		die( json_encode($arr) );exit;
	}




}
?>