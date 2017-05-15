<?php 
$this->checkAdminWeb();
$admin_result = D('admin')->judeAdminType();
$left_top     = 'system_set';
$left_nav     = 'schoolManage';
$title        = '学校管理';  
$sidebar_list = array(
    array('fun_str'=>'','fun_name'=>'系统设置'), 
    array('fun_str'=>'school_new','fun_name'=>'学校管理'),
);
if($_GPC['ac']=='delete'){
    
    $params["school_id"] = $_GPC['id'];
    $params["uniacid"]   = $_W['uniacid'];
    $up["status"]        = -1;
    D('school')->edit($params,$up);
    $this->myMessage('删除成功',$this->createWebUrl('school_new'),'成功');
}
$message_url = $this->createWebUrl('school_new');
$class_school= D('school');
$list        = $class_school->getUniacidSchoolList();

if($_GPC['submit']){
    $arr['school_name'] = $_GPC['school_name'];
    $class_school->addNewSchool($arr);
    $this->myMessage("新增成功",$message_url,'成功');
}
include $this->template('../admin/web_school_new');
exit();
            	