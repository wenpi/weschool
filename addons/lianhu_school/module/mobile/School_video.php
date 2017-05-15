<?php 
    $class_admin        = D('admin');
    $have_school_admin  = $class_admin->mobileValidSchoolAdmin();
    $simple_title       = "视频列表";
    $title              = $_SESSION['school_name'].'-'.$simple_title;
    if(!$have_school_admin){
        header("Location:".$this->createMobileUrl("school_bangding"));
    }
    $list = C("video")->getVideoList();
    include $this->template("school/videos");
    exit();