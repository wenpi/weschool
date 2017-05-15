<?php
    $teacher_info = $this->teacher_mobile_qx();
    $student_name = $teacher_info['teacher_realname'];
    $page_title   = '独立课程';
    C('courseTeacher')->use_class->each_page = 1000;
    $params[":teacher_id"] = $teacher_info['teacher_id'];
    $re     = C('courseTeacher')->use_class->getList($params);
    $list   = $re['list'];
    if($list){
        foreach ($list as $key => $value) {
            $course_info = C('courseScan')->edit($value['course_id']);
            $list[$key]['course_info'] = $course_info;
        }
    }