<?php
/**
 * Mgroup  用于后台会员等级相关操作
 * 2017-08-21
 * Aries
 * P:15010221225
 * */
namespace Home\Controller;
use Think\Controller;
class MgradeController extends AdminController {


	/**
	*  会员等级列表
	* 2017-07-28 Aries
	* */
	public function lists(){
		$where = ' b.status != 2 ';
		$Model = new \Think\Model();
		$list = array();
		$sql = "SELECT b.id, b.title, IFNULL(a.cn,0) AS cn FROM qph_mgrade b LEFT JOIN (SELECT COUNT(1) cn,t.grade_m_id FROM qph_members  t GROUP BY t.grade_m_id) a on a.grade_m_id = b.id  WHERE ".$where."  ORDER BY b.id DESC";
		$list = $Model->query($sql);
		$this->assign('list',$list);
		$this->display();
	}

	/**
	*  添加会员等级
	* 2017-07-28 Aries
	* */
	public function add(){
		$title = I('post.title','');
		$title = I('post.title','');
		$title = I('post.title','');
		$title = I('post.title','');
		$title = I('post.title','');
		$title = I('post.title','');
		$title = I('post.title','');
		$title = I('post.title','');
		$title = I('post.title','');
		$title = I('post.title','');
		$title = I('post.title','');
	}

	/**
	*  编辑保存会员等级
	* 2017-07-28 Aries
	* */
	public function save(){
	
	}

	/**
	*  会员等级详情
	* 2017-07-28 Aries
	* */
	public function getInfo(){
	
	}

}
?>