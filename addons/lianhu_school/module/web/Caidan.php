<?php
    $this->checkAdminWeb();
    $admin_result = D('admin')->judeAdminType();
    $left_top     = 'school_base_set';
    $left_nav     = 'caidan';
    $title        = '独立菜单';  
    $sidebar_list = array(
        array('fun_str'=>'','fun_name'=>'学校基本设置'),
        array('fun_str'=>'caidan','fun_name'=>'独立菜单'),
    );
    $top_action = array(
        array('action_name'=>'菜单列表','action'=>'caidan'),
        array('action_name'=>'新增菜单','action'=>'caidan','arr'=>array('ac'=>'new')),
        array('action_name'=>'菜单分类列表','action'=>'caidanClass'),
        array('action_name'=>'新增菜单分类','action'=>'caidanClass','arr'=>array('ac'=>'new')),
    );		
    $page_name    = '菜单列表';
    if($ac=='new'){
         $page_name    = '新增菜单';
    }
    $we7_js       = 'no';
    $class_caidan = C('caidan');
    $class_list   = $class_caidan->getClassListOut();
    
    if($ac=='edit'){
        $id     = $_GPC['id'];
        $result = $class_caidan->use_class->edit(array('caidan_id'=>$id));
        if($_GPC['submit'] && $result){
            $arr = getNewUpdateData($_GPC,$class_caidan->use_class);            
            $class_caidan->use_class->edit(array('caidan_id'=>$id),$arr);
            $this->myMessage("编辑成功",$this->createWebUrl('caidan'),'成功');
        }
    }

    if($ac=='new' && $_GPC['submit']){
       
        $arr = getNewUpdateData($_GPC,$class_caidan->use_class);
        $class_caidan->use_class->add($arr);
        $this->myMessage("新增成功",$this->createWebUrl('caidan'),'成功');
    }
    include $this->template('../admin/Caidan');
    exit();