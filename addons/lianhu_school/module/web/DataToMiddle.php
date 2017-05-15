<?php
	$this->checkAdminWeb();
    
	$admin_result   = D('admin')->judeAdminType();
    $title          = '系统维护';  
    if($op=='update_school_grade_class_student'){
        $left_top     = 'school_base_set';
	    $left_nav     = 'update_school_grade_class_student';
        $sidebar_list = array(
                array('fun_str'=>'','fun_name'=>'系统设置'),
                array('fun_str'=>'','fun_name'=>'系统维护'),
        );
    }else{
        $left_top     = 'system_set';
	    $left_nav     = 'system_update';
        $sidebar_list = array(
                array('fun_str'=>'','fun_name'=>'系统设置'),
                array('fun_str'=>'systemfix','fun_name'=>'系统维护'),
        );
	    $top_action = array(
			    array('action_name'=>'系统维护','action'=>'systemfix','arr'=>array('aw'=>1,'op'=>'list' ) ),
				array('action_name'=>'系统参数设置','action'=>'systemfix','arr'=>array('aw'=>1,'ac'=>'system_params_set' ,'op'=>'list') ),
				array('action_name'=>'学校类型设置','action'=>'systemfix','arr'=>array('aw'=>1,'ac'=>'school_type_set' ,'op'=>'list') ),
        );
    }
    //同步学校数据
    $middle_school  = M("school");
    $middle_grade   = M('grade');
    $middle_classes = M('classes');
    $middle_student = M('student');
    $middle_course  = M('course');
    $middle_teacher = M('teacher');
    $middle_teacherClass  = M('teacherClass');
    $middle_teacherCourse = M('teacherCourse');
    $middle_classCourse   = M('classCourse');

    $class_grade    = D('grade');
    D('classes')->each_page = 100000;
    D('student')->each_page = 100000;
    D('teacher')->each_page = 100000;
    $school_list            = D('school')->getUniacidSchoolList();

    foreach ($school_list as $key => $value) {
        $middle_school->school_name     = $value['school_name'];
        $middle_school->jia_school_id   = $value['school_id'];
        $middle_school->status          = $value['status'];
        $middle_school->dataEdit();
        //同步年级数据
        $class_grade->school_id = $value['school_id'];
        $grade_list = $class_grade->getSchoolList();
        if($grade_list){
            foreach ($grade_list as $val) {
                $middle_grade->school_id    = $value['school_id'];
                $middle_grade->jia_grade_id = $val['grade_id'];
                $middle_grade->grade_name   = $val['grade_name'];
                $middle_grade->status       = $val['status'];
                $middle_grade->dataEdit();
            }
        }
        //同步班级数据
        D('classes')->school_id = $value['school_id'];
        $class_re   = D('classes')->getList(false);
        $class_list = $class_re['list'];
        if($class_list){
            foreach ($class_list as $val) {
                $middle_classes->action($val['class_id'],$val);
                //同步班主任
                if($val['teacher_id']){
                    $middle_teacherClass->teacher_id = $val['teacher_id'];
                    $middle_teacherClass->class_id   = $val['class_id'];
                    $_up['major'] = 1;
                    $add          = $middle_teacherClass->dataEdit($_up);
                    if(!$add){
                        $middle_teacherClass->major = 1;
                        $middle_teacherClass->dataAdd();
                    }
                }
                //同步班级与课程的关系
                $course_id_arr      = unserialize($val['course_s']);
                $middle_classCourse->action($val['teacher_id'],$course_id_arr);
            }
        }
        //同步学生数据
        D('student')->school_id = $value['school_id'];
        $student_re = D('student')->getList(false);
        $student_list = $student_re['list'];
        if($student_list){
         foreach ($student_list as  $val) {
                $openids        = D('student')->returnEfficeOpenid($val,3);
                $val['openid1'] = $openids['f_openid'] ? $openids['f_openid']:"N";
                $val['openid2'] = $openids['s_openid'] ? $openids['s_openid']:"N";
                $val['openid3']        = $openids['t_openid'] ? $openids['t_openid']:"N";
                $val['student_img']    = $_W['attachurl'].$val['student_img'];            
                $val['openid_student'] = $val['student_uid'] ? S("base","uid2openid",array($val['student_uid'])) :"N";
                $val['parent_mobile']  = $val['parent_phone']; 
                $val['system_number']  = $val['student_passport']; 
                $middle_student->action($val['student_id'],$val);
            }
        }
        //同步课程数据
        $course_list = D('course')->getCourseList(true);
        if($course_list){
            foreach ($course_list as $val) {
                $middle_course->action($val['course_id'],$val);
            }
        }
  
        //同步教师数据
        D('teacher')->school_id = $value['school_id'];
        $teacher_re   = D('teacher')->getList(false);
        $teacher_list = $teacher_re['list'];
        if($teacher_list){
            foreach ($teacher_list as  $val ) {
                $val['teacher_img']  = $_W['attachurl'].$val['teacher_img'];
                $val['weixin_code']  = $_W['attachurl'].$val['weixin_code'];
                $val['teacher_name'] = $val['teacher_realname'];
                if($val['uid']){
                    $val['openid'] = S('base','uid2openid',array($val['uid']));
                }else{
                    $val['openid'] = 'N';
                }
                $admin_info          = D('admin')->dbAdminInfo($val['admin_id']);
                $val['passport']      = $admin_info['passport'];
                $val['password']      = $admin_info['password'];
                $val['salt']          = $admin_info['salt'];
                $middle_teacher->action($val['teacher_id'],$val);
                //同步教师班级数据
                $class_ids  = explode(',',$val['teacher_other_power']);
                if($class_ids){
                    $middle_teacherClass->action($val['teacher_id'],$class_ids);
                }
                //同步教师课程数据
                $course_id            = explode(',',$val['course_id']);
                if($course_id){
                    $middle_teacherCourse->action($val['teacher_id'],$course_id);
                }
            }
        }
    }
    $this->myMessage("同步成功",$this->createWebUrl('systemfix'),'成功');
    exit();

