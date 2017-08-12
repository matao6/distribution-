<?php
/**
 * Goods 控制器用于商品层面操作
 * 2017-07-20
 * Angus
 * P:15011165711
 * */
namespace Home\Controller;
use Think\Controller;
class GoodsController extends AdminController {
    /**
     * 商品标签列表
     * 2017-07-25 Angus
     * */
    public function LabelList(){
        $State = I('S');
        $LabelList = D('Goods') ->LabelList($State);
        echo json_encode(array('code'=>'1', 'message'=>'成功', 'data'=>$LabelList));
    }

    /**
     * 商品标签添加
     * 2017-07-25 Angus
     * */
    public function LabelAdd(){
        $Data = I('post.');
        if(empty($Data['name'])){echo json_encode(array('code'=>'0', 'message'=>'标签名字为空'));exit;}
        if(strlen($Data['name']) > 12){echo json_encode(array('code'=>'0', 'message'=>'便签限定4个中文字体'));exit;}
        $LabelAdd = D('Goods') ->LabelAdd($Data);
        if($LabelAdd){
            echo json_encode(array('code'=>'1', 'message'=>'添加成功'));
        }else{
            echo json_encode(array('code'=>'0', 'message'=>'添加失败'));
        }
    }

    /**
     * 商品标签编辑
     * 2017-07-25 Angus
     * */
    public function LabelSave(){
        $Data = I('post.');
        if(isset($Data['name'])){
            if(empty($Data['name'])){echo json_encode(array('code'=>'0', 'message'=>'标签名字为空'));exit;}
            if(strlen($Data['name']) > 12){echo json_encode(array('code'=>'0', 'message'=>'便签限定4个中文字体'));exit;}
        }
        $LabelSave = D('Goods') ->LabelSave($Data);
        if($LabelSave){
            echo json_encode(array('code'=>'1', 'message'=>'编辑成功'));
        }else{
            echo json_encode(array('code'=>'0', 'message'=>'编辑失败'));
        }
    }

    /**
     * 商品标签编辑详情
     * 2017-07-25 Angus
     * */
    public function LabelOnce(){
        $Id = I('id');
        $LabelOnce = D('Goods') ->LabelOnce($Id);
        echo json_encode(array('code'=>'1', 'message'=>'成功', 'data'=>$LabelOnce));
    }

    /**
     * 商品品类添加
     * 2017-07-25 Angus
     * */
    public function CategoryAdd(){
        $Data = I('post.');
        if($Data['sort'] == 0){unset($Data['sort']);}
        $upload = $this ->UploadOne($_FILES['img']);
        if($upload['code'] == 0){echo json_encode($upload);exit;}
        $Data['img'] = substr($upload['data']['savepath'], 2).$upload['data']['savename'];
        $CategoryAdd = D('Goods') ->CategoryAdd($Data);
        if($CategoryAdd){
            echo json_encode(array('code'=>'1', 'message'=>'添加成功'));
        }else{
            echo json_encode(array('code'=>'0', 'message'=>'添加失败'));
        }
    }

    /**
     * 商品品类查找
     * 2017-07-26 Angus
     * */
    public function CategoryList(){
        $CategoryList = D('Goods') ->CategoryList();
        echo json_encode(array('code'=>'1', 'message'=>'成功', 'data'=>$CategoryList));
    }

    /**
     * 商品品牌列表
     * 2017-07-31 Angus
     * */
    public function BrandList(){
        $BrandList = D('Brand') ->BrandList();
        $this->assign('Brand', $BrandList);
    }
    
}