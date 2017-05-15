<?php
    $this->checkAdminWeb();
    $admin_result = D('admin')->judeAdminType();
    $left_top     = 'wap_admin';
    $left_nav     = 'wapBlock';
    $title        = '移动端积木';  
    $sidebar_list = array(
        array('fun_str'=>'','fun_name'=>'官网管理'),
        array('fun_str'=>'wapBlock','fun_name'=>'移动端积木'),
    );
    $top_action = array(
        array('action_name'=>'积木列表','action'=>'WapBlock'),
        array('action_name'=>'新增积木分类','action'=>'WapBlockClass','arr'=>array('ac'=>'new')),
        array('action_name'=>'新增积木','action'=>'WapBlock','arr'=>array('ac'=>'new')),
    );		
    $page_name    = '积木列表';
    if($ac=='new'){
        $page_name    = '新增积木';
    }		
    

    $we7_js = 'no';
    $class_block= C('block');
    $class_list = C('blockClass')->getOutList();
    if($class_list){
        foreach ($class_list as $key => $value) {
            $class_block->class_id = $value['class_id'];
            $class_list[$key]['list'] = $class_block->getOutList();
        }
    }
    if($ac=='edit'){
        $id     = $_GPC['id'];
        $result = $class_block->use_class->edit(array('block_id'=>$id));
        $result['block_html'] = $result['block_html'] ? base64_decode($result['block_html']):'';
        $result['block_js']   = $result['block_js'] ? base64_decode($result['block_js']):'';
        $result['block_css']  = $result['block_css'] ? base64_decode($result['block_css']):'';
        if($_GPC['submit'] && $result){
            if($_GPC['block_html']){
                $_GPC['block_html'] = base64_encode($_GPC['block_html']);
            }
            if($_GPC['block_js']){
                $_GPC['block_js'] = base64_encode($_GPC['block_js']);
            }        
            if($_GPC['block_css']){
                $_GPC['block_css'] = base64_encode($_GPC['block_css']);
            }   
            $arr = getNewUpdateData($_GPC,$class_block->use_class);            
            $class_block->use_class->edit(array('block_id'=>$id),$arr);
            $this->myMessage("编辑成功",$this->createWebUrl('wapBlock',array('ac'=>'edit','id'=>$id)),'成功');
        }
    }
    if($ac=='new' && $_GPC['submit']){
        if($_GPC['block_html']){
            $_GPC['block_html'] = base64_encode($_GPC['block_html']);
        }
        if($_GPC['block_js']){
            $_GPC['block_js'] = base64_encode($_GPC['block_js']);
        }        
        if($_GPC['block_css']){
            $_GPC['block_css'] = base64_encode($_GPC['block_css']);
        }   
        $arr = getNewUpdateData($_GPC,$class_block->use_class);
        $class_block->use_class->add($arr);
        $this->myMessage("新增成功",$this->createWebUrl('wapBlock'),'成功');
    }

    include $this->template('../admin/WapBlock');
    exit();