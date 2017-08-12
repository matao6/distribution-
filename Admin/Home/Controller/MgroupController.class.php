<?php
/**
 * Mgroup  用于后台用户组相关操作
 * 2017-08-10
 * Aries
 * P:15010221225
 * */
namespace Home\Controller;
use Think\Controller;
class MgroupController extends AdminController {


	/**
	*  用户组列表
	* 2017-07-28 Aries
	* */
	public function lists(){
		$title = I('get.title','');
		$where = ' b.status != 2 ';
		if (!empty($title)){ $where .= " AND b.title LIKE '%".$title."%'"; }
		$Model = new \Think\Model();
		$list = array();
		$sql = "SELECT b.id, b.title, IFNULL(a.cn,0) AS cn FROM qph_mgroup b LEFT JOIN (SELECT COUNT(1) cn,t.m_group_id FROM qph_members  t GROUP BY t.m_group_id) a on a.m_group_id = b.id  WHERE ".$where."  ORDER BY b.id DESC";
		$list = $Model->query($sql);
		$this->assign('list',$list);
		$this->assign('title',$title);		
		$this->display();
	}
	
	/**
	* 添加新用户组
	* 2017-08-10 Aries
	* */
	public function add(){
		$title = trim(I('post.title',''));
		if(empty($title)){ die(json_encode(array('status'=>'0','msg'=>'请输入名称！')));exit; }
		$result = M('Mgroup')->where("`title`='".$title."' AND `status` != 2")->find();
		if (!empty($result)){ die(json_encode(array('status'=>'0','msg'=>'用户分组['.$title.']已经存在！')));exit; }
		$data['title'] = $title;
		$data['status'] = '1';
		$data['createtime'] = time();
		$data['createuserid'] = $_SESSION['User']['uid'];
		if (!M('Mgroup')->add($data)){ die(json_encode(array('status'=>'0','msg'=>'添加数据失败！')));exit; }
		die(json_encode(array('status'=>'1','msg'=>'恭喜您，会员用户组添加成功！')));exit;
	}

	/**
	* 编辑保存用户组
	* 2017-07-28 Aries
	* */
	public function save(){
		$id = I('post.id','');
		$title = I('post.title','');
		if (empty($id) || empty($title)){ die(json_encode(array('status'=>'0','msg'=>'非法参数！')));exit; }
		$info = M('Mgroup')->where('`id`='.$id.' AND `status` != 2')->find();
		if (empty($info)){ die(json_encode(array('status'=>'2','msg'=>'用户组不存在或已删除！')));exit; }
		$rel = M('Mgroup')->where('`id` !='.$id." AND `status` != 2 AND title='".$title."'")->find();
		if (!empty($rel)){ die(json_encode(array('status'=>'0','msg'=>'用户分组['.$title.']已经存在！')));exit;}
		$data['id'] = $id;
		$data['title'] = $title;
		$result = M('Mgroup')->save($data);
		if ($result === false){ die(json_encode(array('status'=>'0','msg'=>'编辑用户组更新失败')));exit; }
		die(json_encode(array('status'=>'1','msg'=>'恭喜您，编辑用户组成功！')));exit;
	}
	
	/**
	*  删除用户组
	* 2017-08-10 Aries
	* */
	public function del(){
		$id = I('post.id','');
		if (empty($id)){ die(json_encode(array('status'=>'0','msg'=>'非法参数！')));exit; }
		$info = M('Mgroup')->where('`id`='.$id.' AND `status` != 2')->find();
		if (empty($info)){ die(json_encode(array('status'=>'0','msg'=>'用户组不存在或已删除！')));exit; }
		$result = M('Members')->where('m_group_id='.$id)->select();
		if (!empty($result)){ die(json_encode(array('status'=>'0','msg'=>'此用户组有会员，无法删除！')));exit; }
		$data['id'] = $id;
		$data['status'] = 2;
		$result = M('Mgroup')->save($data);
		if ($result > 0){ die(json_encode(array('status'=>'1','msg'=>'恭喜您，删除用户组成功！')));exit; }
		die(json_encode(array('status'=>'0','msg'=>'删除用户组失败！')));exit;
	}

	/**
	*  批量删除用户组
	* 2017-08-11 Aries
	* */
	public function batchDel(){
		$id = I('post.id','');
		if (empty($id)){ die(json_encode(array('status'=>'0','msg'=>'非法参数！')));exit; }
		$info = M('Mgroup')->where('`id` in ('.$id.') AND `status` = 2')->select();
		if (!empty($info)){ die(json_encode(array('status'=>'0','msg'=>'有用户组不存在或已删除！')));exit; }
		$sql = "SELECT * FROM qph_members WHERE m_group_id in (".$id.')';
		$Model = new \Think\Model();
		$result = $Model->query($sql);
		if (!empty($result)){ die(json_encode(array('status'=>'0','msg'=>'有用户组存在有会员，无法批量删除！请先清空用户组！')));exit; }
		$rel = M('Mgroup')->where('id in ('.$id.')')->delete();
		if ($rel === false){ die(json_encode(array('status'=>'0','msg'=>'批量删除用户组失败！')));exit; }
		die(json_encode(array('status'=>'1','msg'=>'恭喜您，批量删除用户组成功！')));exit;
	}

	/**
	* 获取用户组信息
	* 2017-08-10 Aries
	* */
	public function getInfo(){
		$id = I('post.id','');
		if (empty($id)){ die(json_encode(array('status'=>'0','msg'=>'非法参数！')));exit; }
		$info = M('Mgroup')->where('id='.$id.' AND status != 2')->find();
		if (empty($info)){ die(json_encode(array('status'=>'0','msg'=>'用户组不存在或已删除！')));exit; }
		die(json_encode(array('status'=>'1','info'=>$info)));exit;
	}



}
?>