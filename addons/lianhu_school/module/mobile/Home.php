<?php 
    $result            = $this->mobile_from_find_student();
    addgroup($_SESSION['school_name'],$this->AccessToken());
    $school_id         = getSchoolId();
    $student_name      = $result['student_name'];
    $page_title        = S("system",'getSetContent',array('mobile_title',$school_id));
    $class_student     = D('student');
    $class_ctl_student = C('student');
    $msg_list          = $this->web_msg();
    $msg_re            = $msg_list[0];
    for ($i=0; $i <3 ; $i++) { 
    		if($ji_lv_class[$i]){
                $out[$i]['list']  = $this->get_info($ji_lv_class[$i]['class_id'],$result['student_id']);
                $out[$i]['name']  = $ji_lv_class[$i]['class_name'];            
                $out[$i]['count'] = count($out[$i]['list']);
                $out[$i]['id']    = $ji_lv_class[$i]['class_id'];
            }
    }
    $class_ctl_student->student_id = $result['student_id'];
    $class_id_list = $class_ctl_student->getStudentClass();
    $class_list    = C('classes')->findInfoForClassList($class_id_list);
    $now_class_id  = getClassId();
    $grade_name    = $this->classGradeName($now_class_id);
    $class_name    = D('classes')->className($now_class_id);
    $class_mobile  = D("mobile");
    $new_list     = $class_mobile->getNewIndexNav();
    if(!$new_list){
        $class_mobile->addMobileNewIndexNav();
        $new_list = $class_mobile->getNewIndexNav();
    }
    
    //调取今日餐，周末调用下周一餐
    $cookbook_class_arr = C('cookbook')->cookbookCLass();
    C("cookbook")->use_class->each_page = count($cookbook_class_arr);
    $cook_list          = C("cookbook")->getToday();
    //获取最新一条班级圈
    $now_class_id   = getClassId();
    $list           = $this->getLineList(1,1,$now_class_id);
    $line_re        = $list[0];
    if($line_re['student_send']==1 && $line_re['student_id']==0){
        $fanid          = $this->class_base->mobileGetFanidByUid($line_re['send_uid']);
        $teacher_result = $this->findTeacherInfoByMobileUid($line_re['send_uid']);
        $student_id     = $class_student->getStudentIdByFanid($fanid,$now_class_id);
        $student_info   = $class_student->getStudentInfo($student_id);
    }elseif($line_re['student_send']==1 && $line_re['student_id']>0){
        unset($teacher_result);
        $student_info = $class_student->getStudentInfo($line_re['student_id']);
    }elseif( $line_re['student_send']==0 && $line_re['teacher_id']>0 ){
        $teacher_result = D('teacher')->getTeacherInfo($line_re['teacher_id']);
    }
    //学校公告
    if($msg_re['db_admin_id']){
        $admin_info = D('admin')->getAdminInfo($msg_re['db_admin_id']);
        $admin_name = $admin_info['admin_name'];
    }else{
        $admin_name = '管理员';
    }
    //班级公告
    $class_re = C("lianhuLine")->lastLine($now_class_id);
    //点评
    $params[":student_id"] = $result['student_id'];
    D("work")->each_page   = 1;
    $list = D("work")->get(1,$params);
    $work_re = $list['list'][0];
    //
    $studentlist = $this->mobile_student_list();
