<?php
/**
 * Member  用于后台管理员相关操作
 * 2017-07-24
 * Angus
 * P:15011165711
 * */
namespace Home\Controller;
use Think\Controller;
class MemberController extends AdminController {
    /**
     * 管理员信息列表页
     * 2017-07-24 Angus
     * */
    public function MemberListHtml(){
        $GroupList = D('Member') ->GroupListC();
        $this ->assign('group', $GroupList);
        $this-> display();
    }

    /**
     * 管理员信息列表
     * 2017-07-24 Angus
     * */
    public function MemberList(){
        $Data = I('get.');
        $UserList = D('Member') ->UserList($Data);
        echo json_encode(array('code'=>'1', 'message'=>'成功', 'data'=>$UserList));
    }

    /**
     * 管理员添加页面
     * 2017-08-07 Angus
     * */
    public function MemberAddHtml(){
        $GroupList = D('Member') ->GroupListC();
        $this ->assign('group', $GroupList);

        $StoreList = D('Member') ->StoreList();
        $this ->assign('store', $StoreList);

        $this-> display();
    }

    /**
     * 管理员添加
     * 2017-07-24 Angus
     * */
    public function MemberAdd(){
        $UserInfo = I('post.');
        if(empty($UserInfo['name'])){echo json_encode(array('code'=>'0', 'message'=>'管理员姓名为空，为方便管理请填写真实姓名'));exit;}
        if(empty($UserInfo['mobile'])){echo json_encode(array('code'=>'0', 'message'=>'手机号为空'));exit;}
        if(!preg_match('/^1(3|4|5|7|8)(\d{9})$/', $UserInfo['mobile'])){echo json_encode(array('code'=>'0', 'message'=>'手机号码格式不正确'));exit;}
        if(strlen($UserInfo['pwd']) < 6){echo json_encode(array('code'=>'0', 'message'=>'密码长度小于6位'));exit;}
        if(strlen($UserInfo['pwd']) > 15){echo json_encode(array('code'=>'0', 'message'=>'密码长度大于15位'));exit;}
        if($UserInfo['pwd'] != $UserInfo['pwds']){echo json_encode(array('code'=>'0', 'message'=>'密码不一致'));exit;}
        unset($UserInfo['pwds']);
        $UserInfo['pwd'] = md5($UserInfo['pwd']);
        $UserAdd = D('Member') ->UserAdd($UserInfo);
        if($UserAdd){
            $Json = json_encode(array('code'=>'1', 'message'=>'管理员添加成功'));
        }else{
            $Json = json_encode(array('code'=>'0', 'message'=>'管理员添加失败'));
        }
        echo $Json;
    }

    /**
     * 管理员信息（名称、密码、手机号）修改
     * 2017-07-24 Angus
     * */
    public function MemberSave(){
        $UserInfo = I('post.');
        if(md5($UserInfo['pwdold']) != $_SESSION['User']['pwd']){echo json_encode(array('code'=>'0', 'message'=>'旧密码错误'));exit;}
        if(empty($UserInfo['mobile'])){echo json_encode(array('code'=>'0', 'message'=>'手机号为空'));exit;}
        if(empty($UserInfo['name'])){echo json_encode(array('code'=>'0', 'message'=>'管理员姓名为空，为方便管理请填写真实姓名'));exit;}
        if(!preg_match('/^1(3|4|5|7|8)(\d{9})$/', $UserInfo['mobile'])){echo json_encode(array('code'=>'0', 'message'=>'手机号码格式不正确'));exit;}
        if($UserInfo['pwd'] != $UserInfo['pwds']){echo json_encode(array('code'=>'0', 'message'=>'密码不一致'));exit;}
        $Data['pwd'] = md5($UserInfo['pwd']);
        $Data['name'] = $UserInfo['name'];
        $Data['mobile'] = $UserInfo['mobile'];
        $Id = $_SESSION['User']['uid'];
        $UserSave = D('Member') ->UserSave($Data, $Id);
        if($UserSave){
            $Json = json_encode(array('code'=>'1', 'message'=>'管理员信息修改成功'));
        }else{
            $Json = json_encode(array('code'=>'0', 'message'=>'管理员信息修改失败'));
        }
        echo $Json;
    }

    /**
     * 管理员信息修改
     * 2017-08-07 Angus
     * */
    public function MemberEditHtml(){
        $Id = I('id');
        if(empty($Id)){
            die('空id');
        }
        $UserInfo = D('Member') ->UserInfo($Id);
        $this ->assign('user', $UserInfo);

        $GroupList = D('Member') ->GroupListC();
        $this ->assign('group', $GroupList);

        $StoreList = D('Member') ->StoreList();
        $this ->assign('store', $StoreList);

        $this-> display();
    }

    /**
     * 管理员状态（门店、权限组、状态）信息修改
     * 2017-07-24 Angus
     * */
    public function MemberStateSave(){
        $UserInfo = I('post.');
        $Id = $UserInfo['id'];
        unset($UserInfo['id']);
        $Karray = array('group_id', 'store_id', 'state', 'name');
        foreach($UserInfo as $k => $v){
            if(!in_array($k, $Karray)){
                unset($UserInfo[$k]);
            }
            if($k == 'name'){
                if(empty($UserInfo['name'])){echo json_encode(array('code'=>'0', 'message'=>'管理员姓名为空，为方便管理请填写真实姓名'));exit;}
            }
        }
        if(empty($UserInfo)){echo json_encode(array('code'=>'0', 'message'=>'修改失败'));exit;}
        $UserSave = D('Member') ->UserSave($UserInfo, $Id);
        if($UserSave){
            $Json = json_encode(array('code'=>'1', 'message'=>'修改成功'));
        }else{
            $Json = json_encode(array('code'=>'0', 'message'=>'修改失败'));
        }
        echo $Json;
    }

    /**
     * 权限组列表
     * @param State 1:正常 0：禁用
     * 2017-07-24 Angus
     * */
    public function GroupList(){
        $State = I('T');
        $GroupList= D('Member') ->GroupList($State);
        echo json_encode(array('code'=>'1', 'message'=>'成功', 'data'=>$GroupList));
    }

    /**
     * 权限组列表页面
     * @param State 1:正常 0：禁用
     * 2017-07-24 Angus
     * */
    public function GroupListHtml(){
        $GroupList= D('Member') ->GroupList(1);
        $this ->assign('group', $GroupList);
        $this ->display();
    }

    /**
     * 权限组信息修改
     * 2017-07-24 Angus
     * */
    public function GroupSave(){
        $GroupInfo = I('post.');
        $Id = $GroupInfo['id'];
        unset($GroupInfo['id']);
        $GroupList= D('Member') ->GroupSave($GroupInfo, $Id);
        if($GroupList){
            $Json = json_encode(array('code'=>'1', 'message'=>'修改成功'));
        }else{
            $Json = json_encode(array('code'=>'0', 'message'=>'修改失败'));
        }
        echo $Json;
    }

    /**
     * 权限组添加
     * 2017-07-24 Angus
     * */
    public function GroupAdd(){
        $Data = I('post.');
        $GroupInfo['add_time'] = time();
        $GroupInfo['name'] = $Data['name'];
        $GroupInfo['creator'] = $_SESSION['User']['uid'];
        $GroupId = D('Member') ->GroupAdd($GroupInfo);
        if($GroupId){
            if(!empty($Data['pid'])){
                D('Member') ->PowerAddAll($GroupId, $Data['pid']);
            }
            $Json = json_encode(array('code'=>'1', 'message'=>'添加成功'));
        }else{
            $Json = json_encode(array('code'=>'0', 'message'=>'添加失败'));
        }
        echo $Json;
    }

    /**
     * 权限组添加页面
     * 2017-07-24 Angus
     * */
    public function GroupAddHtml(){
        $NavigaList = D('Member') ->Nlist(1, 1);
        $this-> assign('naviga', $NavigaList);

        $NoNavigaList = D('Member') ->Linklist(1);
        $this-> assign('nonaviga', $NoNavigaList);
        $this->display();
    }

    /**
     * 权限组权限列表（区分已选权限 未选权限）
     * 2017-07-24 Angus
     * */
    public function PowerList(){
        $Id = I('id');
        $NavigaList = D('Member') ->NavigaList();
        $PowerList = D('Member') ->PowerList($Id);
        $Yarray = array();//拥有权限
        $Narray = array();//未拥有权限
        foreach($NavigaList as $k => $v){
            if(in_array($v['id'], $PowerList)){
                $Yarray[] = $v;
            }else{
                $Narray[] = $v;
            }
        }
        echo json_encode(array('code'=>'1', 'message'=>'成功', 'Y'=>$Yarray, 'N'=>$Narray));
    }

    /**
     * 权限组权限增加
     * 2017-07-24 Angus
     * */
    public function PowerAdd(){
        $Data = I('post.');
        $Data['add_time'] = time();
        $Data['creator'] = $_SESSION['User']['uid'];
        $PowerAdd = D('Member') ->PowerAdd($Data);
        if($PowerAdd){
            $Json = json_encode(array('code'=>'1', 'message'=>'添加成功'));
        }else{
            $Json = json_encode(array('code'=>'0', 'message'=>'添加失败'));
        }
        echo $Json;
    }

    /**
     * 权限组权限删除
     * 2017-07-24 Angus
     * */
    public function PowerDel(){
        $Gid = I('Gid');
        $Nid = I('Nid');
        $PowerDe = D('Member') ->PowerDel($Gid, $Nid);
        if($PowerDe){
            $Json = json_encode(array('code'=>'1', 'message'=>'删除成功'));
        }else{
            $Json = json_encode(array('code'=>'0', 'message'=>'删除失败'));
        }
        echo $Json;
    }

    /**
     * 导航新增
     * 2017-07-24 Angus
     * */
    public function NavigaAdd(){
        $NavigaInfo = I('post.');
        if(empty($NavigaInfo['name'])){echo json_encode(array('code'=>'0', 'message'=>'导航名称为空'));exit;}
        $NavigaInfo['add_time'] = time();
        $NavigaAdd = D('Member') ->NavigaAdd($NavigaInfo);
        if($NavigaAdd){
            $Json = json_encode(array('code'=>'1', 'message'=>'添加成功'));
        }else{
            $Json = json_encode(array('code'=>'0', 'message'=>'添加失败'));
        }
        echo $Json;
    }

    /**
     * 导航新增页面
     * 2017-07-24 Angus
     * */
    public function NavigaAddHtml(){
        $List = D('Member') ->Nlist(1, 1);
        $this-> assign('list', $List);
        $this ->display();
    }

    /**
     * 导航状态修改
     * 2017-07-24 Angus
     * */
    public function NavigaStateSave(){
        $Id = I('id');
        $State = I('state');
        $NavigaStateSave = D('Member') ->NavigaStateSave($Id, $State);
        $M = '禁用';
        if($State == 1){ $M = '启用'; }
        if($NavigaStateSave){
            $Json = json_encode(array('code'=>'1', 'message'=>$M.'成功'));
        }else{
            $Json = json_encode(array('code'=>'0', 'message'=>$M.'失败'));
        }
        echo $Json;
    }

    /**
     * 导航列表页面
     * 2017-07-24 Angus
     * */
    public function NavigaListHtml(){
        $NavigaList = D('Member') ->Nlist(1, 2);
        $this-> assign('naviga', $NavigaList);
        $this-> display();
    }

    /**
     * 导航列表
     * 2017-07-24 Angus
     * */
    public function NavigaList(){
        $State = empty(I('S'))?2:I('S');
        $Type = empty(I('T'))?2:I('T');
        $List = D('Member') ->Nlist($Type, $State);
        echo json_encode(array('code'=>'1', 'message'=>'成功', 'data'=>$List));
    }

    /**
     * 导航信息编辑页
     * 2017-07-24 Angus
     * */
    public function NavigaEditHtml(){
        $Id = I('id');
        $NavigaInfo = D('Member') ->NavigaInfo($Id);
        $this ->assign('naviga', $NavigaInfo);

        $List = D('Member') ->Nlist(1, 1);
        $this-> assign('list', $List);
        $this ->display();
    }

    /**
     * 导航信息编辑
     * 2017-07-24 Angus
     * */
    public function NavigaSave(){
        $Data = I('post.');
        $NavigaSave = D('Member') ->NavigaSave($Data, $Data['id']);
        $Json = json_encode(array('code'=>'1', 'message'=>'编辑成功'));
        if($NavigaSave === 'false'){
            $Json = json_encode(array('code'=>'0', 'message'=>'编辑失败'));
        }
        echo $Json;
    }

    /**
     * 导航列表查找
     * 2017-07-24 Angus
     * */
    public function NavigaListSel(){
        $Name = I('name');
        $Type = I('type');
        $List = D('Member') ->NSlist($Name, $Type);
        echo json_encode(array('code'=>'1', 'message'=>'成功', 'data'=>$List));
    }
}