<?php 
	$this->checkAdminWeb();
	$admin_result = D('admin')->judeAdminType();
	$left_top     = 'school_base_set';
	$left_nav     = 'student_set';
	$title        = '学生设置';  
	$sidebar_list = array(
		array('fun_str'=>'adminindex','fun_name'=>'系统首页'),
		array('fun_str'=>'student','fun_name'=>'学生设置'),
	);
	$top_action = array(
		array('action_name'=>'学生列表','action'=>'student' ),
	);
    $student_id   = $_GPC['id'];
    $student_info = D('student')->edit(array('student_id'=>$student_id,'school_id'=>$this->school_info['school_id']));
    if($student_info){
        $get_time                = $_GPC['get_time'] ? strtotime($_GPC['get_time']):time();
        $arr         = explode('-',date("Y-m-d",$get_time) );
        $arr['year'] = $arr[0];
        $arr['month']= $arr[1];
        $arr['date'] = $arr[2];

        $class_locus             = C('locus');
        $class_locus->student_id = $student_info['student_id'];
        $class_locus->year       = $arr['year'];
        $class_locus->month      = $arr['month'];
        $class_locus->date       = $arr['date'];
        $re                      = $class_locus->getStudentLocus();
        $locus_list              = $class_locus->decodeLocus($re['locus_info']);
        //点击学生证
        $class_studentCard       = Au("studentCard/login");
        if($class_studentCard){
            $result = $class_studentCard->findByStudent($student_id);
            if($result){
                //添加一次
                Au("studentCard/gps")->insertIn($result['id']);
            }
            
        }
    }
    include $this->template('../admin/Locus');
    exit();

