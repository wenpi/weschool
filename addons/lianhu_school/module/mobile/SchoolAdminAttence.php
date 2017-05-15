<?php 
    $school_admin  = D('admin')->mobileValidSchoolAdmin();
    if(!$school_admin){
        header("Location:".$this->createMobileUrl("school_bangding"));
    }
    $student_name        = $school_admin['info']['admin_name'];
    if($ac!='teacher'){
        $page_title          = $title = "学生到校详情";
        $do_ac               = 'teacher';
    }else{
        $page_title          = $title = "教师到校详情";
        $do_ac               = 'list';
    }
    if($ac=='list'){
        $grade_list          = D("grade")->gradeClass();
        foreach ($grade_list as $key => $value) {
            D("student")->class_id = 0;
            D('student')->grade_id = $value['grade_id'];
            $result = D('student')->getGradeClassStudent();
            $grade_list[$key]['grade_num']  = $result['count'];

            $where  = " grade_id = ".$value['grade_id'];
            D('card')->where = $where;
            $grade_list[$key]['grade_in']   = D("card")->countStudentPlayCard("morning");
            $grade_list[$key]['grade_in']   = $grade_list[$key]['grade_in'] ? $grade_list[$key]['grade_in'] :0;
            foreach ($value['second'] as $k => $v) {
                    D('student')->grade_id = 0;
                    D("student")->class_id = $v['class_id'];
                    $result = D('student')->getGradeClassStudent();
                    $grade_list[$key]['second'][$k]['class_num']  = $result['count'];
                    $where  = " class_id = ".$v['class_id'];
                    D('card')->where = $where;
                    $grade_list[$key]['second'][$k]['in_num']   = D("card")->countStudentPlayCard("morning");
                    $grade_list[$key]['second'][$k]['in_num']   = $grade_list[$key]['second'][$k]['in_num'] ?$grade_list[$key]['second'][$k]['in_num']:0;
            }
        }
    }else{
        $list = D("teacher")->getTeacherList($this->school_info['school_id']);
        list($time['year'],$time['month'],$time['day'])=explode('-',date('Y-m-d',time() ) );
    }

