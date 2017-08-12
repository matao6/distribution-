<?php
/**
 * 商品模型
 * 2017-07-19 Angus
 * */
namespace Home\Model;
use Think\Model;

class GoodsModel extends Model{
    /**
     * 商品标签列表
     * 2017-07-25 Angus
     * */
    public function LabelList($State){
        $LabelList = M('GoodsLabel') ->field('id, name') ->where(array('state'=>$State)) ->select();
        return $LabelList;
    }

    /**
     * 商品标签添加
     * 2017-07-25 Angus
     * */
    public function LabelAdd($Data){
        $LabelAdd = M('GoodsLabel') ->add($Data);
        return $LabelAdd;
    }

    /**
     * 商品标签编辑
     * 2017-07-25 Angus
     * */
    public function LabelSave($Data){
        $LabelSave = M('GoodsLabel') ->where(array('id'=>$Data['id'])) ->save($Data);
        return $LabelSave;
    }

    /**
     * 商品标签编辑详情
     * 2017-07-25 Angus
     * */
    public function LabelOnce($Id){
        $LabelOnce = M('GoodsLabel') ->field('id, name, state') ->where(array('id'=>$Id)) ->find();
        return $LabelOnce;
    }

    /**
     * 商品品类添加
     * 2017-07-26 Angus
     * */
    public function CategoryAdd($Data){
        $CategoryAdd = M('GoodsCategory') ->add($Data);
        return $CategoryAdd;
    }

    /**
     * 商品品类查找
     * 2017-07-26 Angus
     * */
    public function CategoryList(){
        $CategoryList = M('GoodsCategory') ->field('id, name, fid, img, spec_id, show_state') ->where(array('state'=>'1')) ->order('sort asc') ->select();
        return $this->CategoryRecursion($CategoryList, 0);
    }

    /**
     * 无限极商品分类递归
     * 2017-07-26 Angus
     * */
    public function CategoryRecursion($List, $Id){
        $Array = array();
        foreach($List as $k => $v){
            if($v['fid'] == $Id){
                unset($List[$k]);
                $re = $this->CategoryRecursion($List, $v['id']);
                if(!empty($re)){
                    $v['list'] = $re;
                }
                $Array[] = $v;
            }
        }
        return $Array;
    }
}