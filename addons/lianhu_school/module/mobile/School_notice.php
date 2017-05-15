<?php 
//控制器
$class_admin        = D('admin');
$have_school_admin  = $class_admin->mobileValidSchoolAdmin();
$simple_title       = "学校公告";
$title              = $_SESSION['school_name'].'-'.$simple_title;
if(!$have_school_admin){
    header("Location:".$this->createMobileUrl("school_bangding"));
}
//主内容
$now_page           = $_GPC['page'] ? $_GPC['page']:1;
$result             = D("notice")->getNoticeList($now_page);
extract($result,EXTR_SKIP);
include $this->template("school/notice");
exit();