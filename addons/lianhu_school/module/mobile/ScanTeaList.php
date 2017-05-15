<?php 
//学生扫码教师签到
    $student_re     =  $this->mobile_from_find_student();
    $student_name   =  $student_re['student_name'];
    $page_title     = '我的扫码历史';
    D("qdPerson")->each_page = 1000;
    $where[":student_id"]    = $student_re['student_id'];
    $list = D("qdPerson")->getList($where);
    $list = $list['list'];
    foreach ($list as $key => $value) {
        $params["activity_id"] = $value['activity_id'];
        $list[$key]['info']     = D("qdActivity")->edit($params);
    }