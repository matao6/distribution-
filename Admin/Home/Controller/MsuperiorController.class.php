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
	*  设置上级用户列表
	* 2017-08-17 Aries
	* */
	public function lists(){
		$id = I('get.id','');
		$uid = I('get.uid','');
		$phone = I('get.phone','');
		$starttime = I('get.starttime','');
		$endtime = I('get.endtime','');
		$status = I('get.status','1');
		$p = I('get.p',1);
		$where = ' 1 AND a.id != '.$id;
		$order = ' ORDER BY a.id DESC';
		if (!empty($uid)){ $where .= " AND (a.id = '".$uid."' OR a.realname ='".$uid."')"; }
		if (!empty($phone)){ $where .= " AND ( a.phone = '".$phone."' OR b.wx_name = '".$phone."')"; }
		if (!empty($starttime)){ $where .= ' AND a.createtime >= '.strtotime($starttime.' 00:00:00'); }
		if (!empty($endtime)){ $where .= ' AND a.createtime <= '.strtotime($endtime.' 23:59:59'); }
		if (!empty($status)){ $where .= ' AND a.status = 1'; }
		$sql = "SELECT COUNT(*) AS num FROM qph_members AS a LEFT JOIN qph_members_wxinfo AS b ON b.uid = a.id WHERE ".$where;
		$Model = new \Think\Model();
		$result = $Model->getOne($sql);
		$list = array();
		if ($result['num'] > 0){
			$limit = 20;
			$Page = new \Think\Page($result['num'],$limit);
			$show = $Page->new_show();
			$_sql = "SELECT a.*, b.wx_name, b.wx_img, c.wx_name AS superior_name FROM qph_members AS a LEFT JOIN qph_members_wxinfo AS b ON b.uid = a.id LEFT JOIN qph_members_wxinfo AS c ON c.uid = a.superior_id WHERE ".$where.$order.' LIMIT '.$Page->firstRow.','.$Page->listRows;
			$list = $Model->query($_sql);
			$this->assign('page',$show);
		}
		$userinfo = $Model->getOne("SELECT a.id,a.phone,b.wx_name FROM qph_members AS a LEFT JOIN qph_members_wxinfo AS b ON b.uid = a.id WHERE a.id = ".$id);
		$this->assign('id',$id);
		$this->assign('list',$list);
		$this->assign('uid',$uid);
		$this->assign('phone',$phone);
		$this->assign('starttime',$starttime);
		$this->assign('endtime',$endtime);
		$this->assign('userinfo',$userinfo);
		$this->display();
	}
	
	/**
	*  设置顶级会员
	* 2017-08-17 Aries
	* */
	public function setTop(){
		$id = I('post.id','');
		if (empty($id)){ die(json_encode(array('status'=>'0','msg'=>'非法参数！')));exit; }
		$data['id'] = $id;
		$data['superior_id'] = 0;
		$result = M('Members')->save($data);
		if ($result === false){ die(json_encode(array('status'=>'0','msg'=>'设置失败！')));exit; }
		die(json_encode(array('status'=>'1','msg'=>'恭喜您，设置顶级会员成功！')));exit;
	}
	
	/**
	*  设置用户上级
	* 2017-08-17 Aries
	* */
	public function setSuperior(){
		$id = I('post.id','');
		$uid = I('post.uid','');
		if (empty($id) || empty($uid)){ die(json_encode(array('status'=>'0','msg'=>'非法参数！')));exit; }
		$data['id'] = $id;
		$data['superior_id'] = $uid;
		$result = M('Members')->save($data);
		if ($result === false){ die(json_encode(array('status'=>'0','msg'=>'设置失败！')));exit; }
		die(json_encode(array('status'=>'1','msg'=>'恭喜您，设置会员上级成功！')));exit;
	}

}
?>