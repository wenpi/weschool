<?php
    $this->checkAdminWeb();
    $admin_result = D('admin')->judeAdminType();
    $left_top     = 'scoreAdmin';
    $left_nav     = 'scoreClasses';
    $title        = '考试记录';  
    $sidebar_list = array(
        array('fun_str'=>'','fun_name'=>'学校信息'),
        array('fun_str'=>'scoreClasses','fun_name'=>'班级评比'),
    );
	$top_action = array(
		array('action_name'=>'班级评比' ,'action'=>'scoreClasses'),
	);
	$page_name = '班级评比';
    $we7_js     = 'no';
    $order_self = '[0,"desc"]';
    $grade  = D("grade")->getSchoolList();
    $gid    = $_GPC['gid'] ? $_GPC['gid'] : $grade[0]['grade_id'];
    C("scoreJilv")->grade_id = $gid;
    $score_jilv_list 		 = C("scoreJilv")->getGradeAll();
    $score_jilv_list 		 = $score_jilv_list['list'];
   
    if($gid){
        $where[":grade_id"] = $gid;
        $course_list   = C("course")->getGradeAllCourse($gid);
    }
    if($jilv_id){ 
        $where[":ji_lv_id"] = $jilv_id;
    }
	if($ac=='list'){
        $where_str =  S("fun",'composeParamsToWhere',array($where));
        $list      = pdo_fetchall("select * from ".tablename('lianhu_scorelist')." where ".$where_str,$where);
        foreach ($list as $key => $value) {
            $out_list[$value['class_id']][$value['course_id']] += $value['score'];
        }
        $class_student = D("student");
        foreach ($out_list as $key => $value) {
            $class_id = $key;
            //平均分   
            $class_student->class_id = $class_id;
            $student_list = $class_student->getClassStudentList();
            $count        = count($student_list);
            $count        = $count==0 ? 1: $count;
            foreach ($value as $k => $val) {
                $score_list[$class_id][$k] = round($val/$count,1);
            }
        }
	}   
    include $this->template('../admin/ScoreClasses');
	exit();