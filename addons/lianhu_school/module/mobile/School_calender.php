<?php 
//控制器
$class_admin        = D('admin');
$have_school_admin  = $class_admin->mobileValidSchoolAdmin();
$simple_title       = "日历";
$title              = $_SESSION['school_name'].'-'.$simple_title;
if(!$have_school_admin)
    header("Location:".$this->createMobileUrl("school_bangding"));

include $this->template("school/calendar");
exit();
