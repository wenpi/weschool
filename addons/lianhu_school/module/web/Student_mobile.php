<?php
$aw = 1;
$this->checkAdminWeb();
$admin_result = D('admin')->judeAdminType();
$left_top     = 'school_base_set';
$left_nav     = 'student_mobile';
$title        = '家长端设置';  
$sidebar_list = array(
    array('fun_str'=>'adminindex','fun_name'=>'系统首页'),
    array('fun_str'=>'student_mobile','fun_name'=>'家长端设置'),
);
$wet_js = 'no';
$mu_str = $this->school_info['mu_str'];
//修复一个bug
pdo_query("update ".tablename('lianhu_mobile_display')." set dis_three='' where dis_three='{\"op\":\"home_work\"}' and keyword !='line_other'   ");

$class_mobile = D('mobile');
$button_list  = $class_mobile->getButtonNav(true,true);
$index_list   = $class_mobile->getIndexNav(true,true);
$new_list     = $class_mobile->getNewIndexNav();
if(!$new_list){
    $class_mobile->addMobileNewIndexNav();
    $new_list = $class_mobile->getNewIndexNav();
}
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
        $this->myMessage('修改成功',$this->createWebUrl('student_mobile'),'成功');
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
        $up['type']     = 2 ;
        if(!$_GPC['xiaoyeimg']){
            $up['img']      = getImgToUrl($_GPC['img'],$this);
        }

        if($mu_str == 'xiaoye'){
            $up['xiaoyeimg']      = getImgToUrl($_GPC['xiaoyeimg'],$this);
        }
        $class_mobile->add($up);
        $this->myMessage('新增成功',$this->createWebUrl('student_mobile'),'成功');
    }
}
if($op=='delete'){
    $this->myMessage('禁止删除',$this->createWebUrl('student_mobile'),'成功');
    if($_GPC['id']){
        $class_mobile->delete($_GPC['id']);
        $this->myMessage('删除成功',$this->createWebUrl('student_mobile'),'成功');
    }
}
include $this->template('../admin/web_student_mobile');
exit();
