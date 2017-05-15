<?php 
    $result            = $this->mobile_from_find_student();
    addgroup($_SESSION['school_name'],$this->AccessToken());
    $school_id         = getSchoolId();
    $student_name      = $result['student_name'];
    $page_title        = "全部功能";
    $msg_list          = $this->web_msg();
    $ji_lv_class       = D('record')->getRecordClass();
    $class_student     = D('student');
    $class_ctl_student = C('student');
    for ($i=0; $i <3 ; $i++) { 
    		if($ji_lv_class[$i]){
                $out[$i]['list']  = $this->get_info($ji_lv_class[$i]['class_id'],$result['student_id']);
                $out[$i]['name']  = $ji_lv_class[$i]['class_name'];            
                $out[$i]['count'] = count($out[$i]['list']);
                $out[$i]['id']    = $ji_lv_class[$i]['class_id'];
            }
    }
    $need_money    = $this->MoneyGive();
    $list          = $this->mobile_student_list();
    $class_ctl_student->student_id = $result['student_id'];
    $class_id_list = $class_ctl_student->getStudentClass();
    $class_list    = C('classes')->findInfoForClassList($class_id_list);
    $now_class_id  = getClassId();
    $grade_name    = $this->classGradeName($now_class_id);
    $class_name    = D('classes')->className($now_class_id);