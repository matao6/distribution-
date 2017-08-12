<?php
/**
 * 管理员模型
 * 2017-07-19 Angus
 * */
namespace Home\Model;
use Think\Model;

class MemberModel extends Model{
    /**
     * 查找管理员相关信息
     * 2017-07-21 Angus
     * */
    public function UserList($Where = ''){
        if(isset($Where['name'])){
            $Where['name'] = array('like', '%'.$Where['name'].'%');
        }
        $Where['state'] = 1;
        $UserList = M('Admin') ->field('uid, name, mobile, add_time, last_login_time, group_id, store_id') ->where($Where) ->select();
        $GroupList = M('Group') ->field('id, name') ->select();
        foreach($UserList as $k => $v){
            if($v['group_id'] == 0){
                $UserList[$k]['group_id'] = '总管理';
                continue;
            }
            foreach($GroupList as $ke => $va){
                if($v['group_id'] == $va['id']){
                    $UserList[$k]['group_id'] = $va['name'];
                }
            }
        }
        return $UserList;
    }

    /**
     * 管理员信息添加
     * 2017-07-21 Angus
     * */
    public function UserAdd($Data){
        $Data['add_time'] = time();
        $Data['last_login_time'] = time();
        $Data['last_login_ip'] = D('Login') ->GetIP();
        $UserAdd = M('Admin') ->add($Data);
        return $UserAdd;
    }

    /**
     * 管理员编辑信息
     * 2017-07-21 Angus
     * */
    public function UserInfo($Id){
        $UserInfo = M('Admin') ->field('name, mobile, uid, group_id, store_id, state') ->where(array('uid'=>$Id)) ->find();
        return $UserInfo;
    }

    /**
     * 管理员信息(名称、密码、手机号)修改
     * 2017-07-21 Angus
     * */
    public function UserSave($Data, $Id){
        $UserSave = M('Admin') ->where(array('uid'=>$Id)) ->save($Data);
        return $UserSave;
    }

    /**
     * 查找管理员相关信息
     * 2017-07-21 Angus
     * */
    public function GroupList($State){
        $GroupList = M('Group') ->field('qph_group.id, qph_group.name, qph_group.add_time, qph_admin.name as Uname') ->join('qph_admin on qph_group.creator = qph_admin.uid') ->select();
        return $GroupList;
    }

    /**
     * 管理员信息下拉列表
     * 2017-08-07 Angus
     * */
    public function GroupListC(){
        $GroupList = M('Group') ->field('id, name') ->where(array('state'=>1)) ->select();
        return $GroupList;
    }

    /**
     * 门店信息列表
     * 2017-08-07 Angus
     * */
    public function StoreList(){
        $StoreList = M('Store') ->field('id, name') ->select();
        return $StoreList;
    }

    /**
     * 权限组信息修改
     * 2017-07-21 Angus
     * */
    public function GroupSave($Data, $Id){
        $GroupSave = M('Group') ->where(array('id'=>$Id)) ->save($Data);
        return $GroupSave;
    }

    /**
     * 权限组添加
     * 2017-07-21 Angus
     * */
    public function GroupAdd($Data){
        $GroupAdd = M('Group') ->add($Data);
        return $GroupAdd;
    }

    /**
     * 权限导航列表
     * 2017-07-24 Angus
     * */
    public function NavigaList(){
        $NavigaList = M('Navigation') ->field('id, name, url') ->where(array('url'=>array('neq',''))) ->select();
        return $NavigaList;
    }

    /**
     * 权限列表
     * 2017-07-24 Angus
     * */
    public function PowerList($Id){
        $PowerList = M('Power') ->where(array('group_id'=>$Id)) ->getField('id, n_id');
        return $PowerList;
    }

    /**
     * 权限组权限增加
     * 2017-07-24 Angus
     * */
    public function PowerAdd($Data){
        $PowerAdd = M('Power') ->add($Data);
        return $PowerAdd;
    }

    /**
     * 权限组权限批量增加
     * 2017-07-24 Angus
     * */
    public function PowerAddAll($Id, $Pid){
        $A = array();
        $Time = time();
        foreach($Pid as $k => $v){
            $A[$k]['add_time'] = $Time;
            $A[$k]['group_id'] = $Id;
            $A[$k]['n_id'] = $v;
            $A[$k]['creator'] = $_SESSION['User']['uid'];;
        }
        $PowerAdd = M('Power') ->addAll($A);
        return $PowerAdd;
    }

    /**
     * 权限组权限删除
     * 2017-07-24 Angus
     * */
    public function PowerDel($Gid, $Nid){
        $PowerAdd = M('Power') ->where(array('group_id'=>$Gid, 'n_id'=>$Nid)) ->delete();
        return $PowerAdd;
    }

    /**
     * 导航新增
     * 2017-07-24 Angus
     * */
    public function NavigaAdd($Data){
        $NavigaAdd = M('Navigation') ->add($Data);
        return $NavigaAdd;
    }

    /**
     * 导航删除
     * 2017-07-24 Angus
     * */
    public function NavigaStateSave($Id, $State){
        $NavigaStateSave = M('Navigation') ->where(array('id'=>$Id)) ->save(array('state'=>$State));
        return $NavigaStateSave;
    }

    /**
     * 导航列表
     * 2017-07-24 Angus
     * */
    public function Nlist($Type, $State){
        if($State != 2){$Where['state'] = $State;}
        if($Type != 2){$Where['type'] = $Type;}
        $NavigationList = M('Navigation') ->field('id, url, name, fid, state') ->where($Where) ->select();
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
                                    $va['list'][] = $val;
                            }
                        }
                        $v['list'][] = $va;
                    }
                }
                $Left[] = $v;
            }
        }
        return $Left;
    }

    /**
     * 连接列表
     * 2017-07-24 Angus
     * */
    public function Linklist($State){
        if($State != 2){$Where['state'] = $State;}
        $Where['type'] = 0;
        $NavigationList = M('Navigation') ->field('id, url, name, fid, state') ->where($Where) ->select();
        return $NavigationList;
    }

    /**
     * 导航列表查找
     * 2017-07-24 Angus
     * */
    public function NSlist($Name, $Type){
        $Where['state'] = 1;
        $Where['type'] = $Type;
        $Where['name'] = array('like', '%'.$Name.'%');
        $NavigationList = M('Navigation') ->field('id, url, name, fid, state') ->where($Where) ->select();
        return $NavigationList;
    }

    /**
     * 导航编辑
     * 2017-07-24 Angus
     * */
    public function NavigaSave($Data, $Id){
        $NavigaSave = M('Navigation') ->where(array('id'=>$Id)) ->save($Data);
        return $NavigaSave;
    }

    /**
     * 导航编辑单条信息
     * 2017-07-24 Angus
     * */
    public function NavigaInfo($Id){
        $NavigaInfo = M('Navigation') ->where(array('id'=>$Id)) ->find();
        return $NavigaInfo;
    }
}