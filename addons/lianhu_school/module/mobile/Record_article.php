<?php
    $student_info = $this->mobile_from_find_student();
    $wid          = $_GPC['wid'];
    $class_work   = D('work');
    $re           = $class_work->edit($wid);
    $result       = $class_work->addInfoToWork($re);
    $page_title   = "学生记录";
    


