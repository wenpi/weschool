<?php 
//控制器
$class_admin        = D('admin');
$have_school_admin  = $class_admin->mobileValidSchoolAdmin();
$simple_title       = "学校公告";
$title              = $_SESSION['school_name'].'-'.$simple_title;
if(!$have_school_admin)
    header("Location:".$this->createMobileUrl("school_bangding"));
$msg_id             = $_GPC['id'];
$result             = D('notice')->getNoticeInfo($msg_id);
include $this->template("school/notice_content");
exit(); 