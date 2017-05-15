<?php
$this->checkAdminWeb();
$admin_result = D('admin')->judeAdminType();
$left_top     = 'school_base_set';
$left_nav     = 'schoolAdmin_mobile';
$title        = '管理端设置';  
$sidebar_list = array(
    array('fun_str'=>'adminindex','fun_name'=>'系统首页'),
    array('fun_str'=>'schoolAdmin_mobile','fun_name'=>'管理端设置'),
);
$we7_js = 'no';
$class_mobile = D('mobile');
$class_mobile->do_schoolAdmin = true;
$button_list  = $class_mobile->getButtonNav(false,true);
$index_list   = $class_mobile->getIndexNav(false,true);
$mu_str       = $this->school_info['mu_str'];


if ($op=='edit' ){
    $result = $class_mobile->get($_GPC['id']);
    if($_GPC['submit']){
        $up['name']     = $_GPC['name'];
        $up['keyword']  = $_GPC['keyword'];
        $up['url']      = $_GPC['url'];
        if(!$_GPC['xiaoyeimg']){
             $up['img']      = getImgToUrl($_GPC['img'],$this);
        }
        if($mu_str == 'xiaoye'){
             $up['xiaoyeimg']      = getImgToUrl($_GPC['xiaoyeimg'],$this);
        }
        $up['status']   = $_GPC['status'];
        $up['sort']     = $_GPC['sort'];
        
        if($_GPC['dis_one']){
             $up['dis_one']  = $_GPC['dis_one'];
        }
        if($_GPC['dis_two']){
            $up['dis_two']   = $_GPC['dis_two'];
        }
        $class_mobile->update($_GPC['id'],$up);
        $this->myMessage('修改成功',$this->createWebUrl('schoolAdmin_mobile'),'成功');
    }
}
if($op=='new'){
    if($_GPC['submit']){
        $up['name']     = $_GPC['name'];
        $up['keyword']  = $_GPC['keyword'];
        $up['url']      = $_GPC['url'];
        $up['status']   = $_GPC['status'];
        $up['sort']     = $_GPC['sort'];
        $up['dis_one']  = $_GPC['id'];
        $up['dis_two']  = $_GPC['dis_two'];
        $up['type']     = 22 ;
        if(!$_GPC['xiaoyeimg']){
             $up['img']      = getImgToUrl($_GPC['img'],$this);
        }
        if($mu_str == 'xiaoye'){
             $up['xiaoyeimg']      = getImgToUrl($_GPC['xiaoyeimg'],$this);
        }
        $class_mobile->add($up);
        $this->myMessage('修改成功',$this->createWebUrl('schoolAdmin_mobile'),'成功');
    }
}
include $this->template('../admin/SchoolAdmin_mobile');
exit();
