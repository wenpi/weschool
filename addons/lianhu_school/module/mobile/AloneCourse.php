<?php 

    $result = $this->mobile_from_find_student();

    $student_name = $result['student_name'];
    $page_title   = '独立课程';
    $list   = C('courseClass')->getAllList();
    $now_time = time();
    foreach ($list as $key => $value) {
        C('courseScan')->class_id             = $value['class_id'];
        C('courseScan')->use_class->each_page = 1000;
        $re                                   = C('courseScan')->getList();
        foreach ($re['list'] as $k=> $val) {
            C('courseStudent')->course_id = $val['course_id'];
            $use_num        = C('courseStudent')->getNum($result['student_id']);
            $val['use_num'] = $use_num ?  $use_num :0;
            $re['list'][$k] = $val;
            if(!$val['buy_url']){
                $val['buy_url'] = $this->createMobileUrl('aloneCoursePay',array('course_id'=>$val['course_id']));
            }
            $val['have_in'] = count(C('courseStudent')->getCourseList());
            $re['list'][$k] = $val;
        }
        $list[$key]['course_list']= $re['list'];
    }
