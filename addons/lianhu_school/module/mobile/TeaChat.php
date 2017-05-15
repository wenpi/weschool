<?php
		$teacher_info = $this->teacher_mobile_qx(); 
        $teacher_name = $teacher_info['teacher_realname'];
        $page_title   = '通讯录';
        //
        $class_student = C('classes');
        $class_list    = D('teacher')->getTeacherClass($teacher_info['teacher_id'],true);
        $all_list      = $class_list['list_all'];
        $search_name   = $_GPC['search_name'];
        $teacher_list  = D('teacher')->getTeacherList($this->school_info['school_id']);

        foreach ($all_list as $key => $value) {
            $class_student->class_id = $value['class_id'];
            $student_list = $class_student->getClassStudent();
            if($search_name){
                foreach ($student_list as $k=> $v) {
                    if($v['student_name'] != $search_name){
                        unset($student_list[$k]);
                    }
                }
            }
            $all_list[$key]['student_list'] = $student_list;
        }
    foreach ($teacher_list as $key => $value) {
        if($_GPC['search_name']){
            if(stripos($value['teacher_realname'],$_GPC['search_name'])===FALSE){
                unset($teacher_list[$key]);
            }
        }
        if($value['teacher_id']==$teacher_info['teacher_id']){
            unset($teacher_list[$key]);
        }
    }

