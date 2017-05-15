<?php
    $this->checkAdminWeb();
    $admin_result = D('admin')->judeAdminType();
    $left_top     = 'system_data';
    $left_nav     = 'school_data';
    $title        = '学校数据';  
    $we7_js       = 'no';
    $sidebar_list = array(
        array('fun_str'=>'','fun_name'=>'系统数据'),
        array('fun_str'=>'school_data','fun_name'=>'学校数据'),
    );
    if($admin_result['admin']=='top'){
        $school_list    =  S('school','getSchoolByUniacid',array($_W['uniacid']) );
            //过滤掉没有权限的学校
            $data_group = D('power')->getDataInfo($_GPC['_data_group_id']);
            if($data_group['school']){
                foreach ($school_list as $key => $value) {
                    if(!in_array($value['school_id'],$data_group['school'])){
                        unset($school_list[$key]);
                    }    
                }
            }        
    }else{
        $school_list[]  =  D("school")->getSchoolInfo();
    }
    $out_list       = array();
    $begin_time     = $_GPC['begin_time'] ? strtotime($_GPC['begin_time']) :strtotime("-1 day");
    $end_time       = $_GPC['end_time']   ? strtotime($_GPC['end_time'])   :strtotime("+1 day");
    $class_student  = D('student');
    $class_teacher  = D('teacher');
    $class_classes  = D("classes");
    $class_homework = D("homework");
    $class_article  = D("article");
    $class_sendRecord  = D("sendRecord");
    foreach ($school_list as $key => $value) {
        $out_list[$key]['school_info'] = $value;
        //学生绑定率
        $class_student->_set('school_id',$value['school_id']);  
        $student_list                  = $class_student->getStudentlist();
        $student_count                 = count($student_list);
        if($student_count>0){
            $have_bd_student_count         = $class_student->getBdStudentCount($student_list);
            $student_bi_lv                 = number_format($have_bd_student_count/$student_count,1)*100 .'%';
            $out_list[$key]['student_count']            = $student_count;
            $out_list[$key]['have_bd_student_count']    = $have_bd_student_count;
            $out_list[$key]['student_bi_lv']            = $student_bi_lv;
        }
        //教师绑定率
        $teacher_list                   = $class_teacher->getTeacherList($value['school_id']);
        $teacher_count                  = count($teacher_list);
        $have_bd_teacher_count          = $class_teacher->getBdTeacherCount($teacher_list);
        if($teacher_count>0){
            $teacher_bi_lv                  = number_format($have_bd_teacher_count/$teacher_count,1)*100 .'%';
            $out_list[$key]['teacher_count']            = $teacher_count;
            $out_list[$key]['have_bd_teacher_count']    = $have_bd_teacher_count;
            $out_list[$key]['teacher_bi_lv']            = $teacher_bi_lv; 
        }   
        //班级数
        $classes_count                  = $class_classes->getClassCount($value['school_id']);
        if($classes_count){
            $out_list[$key]['classes_count']            = $classes_count;
            //班级作业发送比率【发送量/班级数】
            $class_homework->teacher_id     = 0;
            $class_homework->school_id      = $value['school_id'];
            $homework_count                 = $class_homework->getHomeworkCount($begin_time,$end_time);
            $homework_bi_lv                 = number_format($homework_count/$classes_count,1)*100 .'%';
            $out_list[$key]['homework_count']           = $homework_count;
            $out_list[$key]['homework_bi_lv']           = $homework_bi_lv;      
            //班级公告发送比率【发送量/班级数】
            $class_send_count               = $class_sendRecord->getClassMsgCount($value['school_id'],$begin_time,$end_time,2);
            $class_send_bi_lv               = number_format($class_send_count/$classes_count,1)*100 .'%';
            $out_list[$key]['class_send_count']         = $class_send_count;      
            $out_list[$key]['class_send_bi_lv']         = $class_send_bi_lv;      
            //学校公告发送量
            $school_send_count              = $class_sendRecord->getClassMsgCount($value['school_id'],$begin_time,$end_time,1);
            $school_send_bi_lv              = number_format($school_send_count/$classes_count,1)*100 .'%';
            $out_list[$key]['school_send_count']        = $school_send_count;      
            $out_list[$key]['school_send_bi_lv']        = $school_send_bi_lv;
        }
        //文章发布量
        $class_article->school_id       = $value['school_id'];
        $article_send_count             = $class_article->getArticleCount($begin_time,$end_time);    
        $out_list[$key]['article_send_count']  = $article_send_count;      
    }
	include $this->template('../admin/web_school_data');
	exit();
