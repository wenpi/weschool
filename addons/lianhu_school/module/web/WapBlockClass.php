<?php
    $this->checkAdminWeb();
    $admin_result = D('admin')->judeAdminType();
    $left_top     = 'wap_admin';
    $left_nav     = 'WapBlockClass';
    $title        = '移动端积木分类';  
    $sidebar_list = array(
        array('fun_str'=>'','fun_name'=>'官网管理'),
        array('fun_str'=>'WapBlockClass','fun_name'=>'移动端积木分类'),
    );
    $top_action = array(
        array('action_name'=>'积木列表','action'=>'WapBlock'),
        array('action_name'=>'新增积木分类','action'=>'WapBlockClass','arr'=>array('ac'=>'new')),
        array('action_name'=>'新增积木','action'=>'WapBlock','arr'=>array('ac'=>'new')),
    );	
    $page_name    = '新增积木分类';

    $class_blockClass = D('blockClass');	
    if($ac=='new' && $_GPC['submit']){
        $arr = getNewUpdateData($_GPC,$class_blockClass);
        $class_blockClass->add($arr);
        $this->myMessage("新增成功",$this->createWebUrl('wapBlock'),'成功');
    }
    if($ac=='edit'){
        $id = $_GPC['id'];
        $re = $class_blockClass->edit(array('class_id'=>$id));
        $result = $re;
        if($re && $_GPC['submit']){
            $arr = getNewUpdateData($_GPC,$class_blockClass);
            $re = $class_blockClass->edit(array('class_id'=>$id),$arr);
            $this->myMessage("编辑成功",$this->createWebUrl('wapBlock'),'成功');
        }
    }
    if($ac=='delete'){
        $id = $_GPC['id'];
        $re = $class_blockClass->edit(array('class_id'=>$id),array('status'=>'-1'));
        $this->myMessage("删除成功",$this->createWebUrl('wapBlock'),'成功');
    }

    include $this->template('../admin/WapBlockClass');
    exit();