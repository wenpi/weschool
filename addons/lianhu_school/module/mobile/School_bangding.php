<?php 
$title              = $_W['uniaccount']['name'].'-家校互通';
$class_admin        = D('admin');
$have_school_admin  = $class_admin->mobileValidSchoolAdmin();
if($have_school_admin)
    header("Location:".$this->createMobileUrl("school_home"));
if($_GPC['submit']){
    $passport = $_GPC['passport']; 
    $password = $_GPC['password']; 
    $check_result = $class_admin->findSchoolAdminByPassport($passport);
    if($check_result['errcode']==1)
        $this->myMessage($check_result['msg'],$this->createMobileUrl('school_bangding'),'错误');
    $school_re = $check_result['school_re'];
    $user      = $check_result['user'];
    $password_re  = S("fun","checkEqPassword",array($password,$user['password'],$user['salt'])); 
    if(!$password_re)
        $this->myMessage('密码错误',$this->createMobileUrl('school_bangding'),'错误');
    $class_admin->mobileBindingSchoolAdmin($uid ,$school_re['admin_id']);
    $this->myMessage('绑定成功',$this->createMobileUrl('school_home'),'成功');
}
include $this->template("school/login");
exit();
 