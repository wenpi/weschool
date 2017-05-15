<?php 
    $school_admin  = D('admin')->mobileValidSchoolAdmin();
    if(!$school_admin){
        header("Location:".$this->createMobileUrl("school_bangding"));
    }
    $title         = '学生记录';
    $grade_list    = D("grade")->gradeClass();

        if(!$_GPC['cid']){
            foreach ($grade_list as $key => $value) {
                if($value['second'][0]['class_id']){
                    $class_id = $value['second'][0]['class_id'];
                    break;
                }
            }
        }else{
            $class_id = $_GPC['cid'];
        }
        if($class_id){
            $class_name = D('classes')->className($class_id);
            $grade_id   = D('classes')->getClassGradeId($class_id);
            $grade_name = $this->gradeName($grade_id);
            D('student')->class_id = $class_id;
            $list =  D('student')->getClassStudentList();
        }

