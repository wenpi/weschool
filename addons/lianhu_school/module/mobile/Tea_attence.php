<?php 
    $teacher_info = $this->teacher_mobile_qx();
    $student_name = $teacher_info['teacher_realname'];
    $page_title   = '班级考勤';
    $class_card   = D('card');
    $class_student= D('student');
    $t_id 		  = $teacher_info['teacher_id'];
    $alist 		  = D('teacher')->getTeacherClass($t_id);
    $list  		  = $alist['list'];
    $time_date    = $_GPC['time_date'] ? $_GPC['time_date'] : date("Y-m-d",time());
    $class_card->in_time = strtotime($time_date);
    if($list){
            foreach($list as $key=>$value){
                 $class_card->_set('where'," class_id=".$value['class_id'] );
                 $list[$key]['up']      = $class_card->countStudentPlayCard('morning');
                 $list[$key]['low']     = $class_card->countStudentPlayCard('afternoon');
                 $list[$key]['other']   = $class_card->countStudentPlayCard('other');
            }
    }
