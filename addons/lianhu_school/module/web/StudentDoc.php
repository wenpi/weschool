<?php 
	$this->checkAdminWeb();
	$admin_result = D('admin')->judeAdminType();
	$left_top     = 'school_base_set';
	$left_nav     = 'student_set';
	$title        = '学生档案';  
	$sidebar_list = array(
		array('fun_str'=>'adminindex','fun_name'=>'系统首页'),
		array('fun_str'=>'student','fun_name'=>'学生设置'),
	);
	$top_action = array(
		array('action_name'=>'学生列表','action'=>'student' ),
		array('action_name'=>'添加学生','action'=>'student','arr'=>array('ac'=>'new') ),
	);
	$where["student_id"] = $_GPC['sid'];
	$where["school_id"]  = $this->school_info['school_id'];
	$student = D("student")->edit($where);
	//调班记录
	$change_class_list = D("changeClassRecord")->getAll($where['student_id']);
	

    include $this->template('../admin/StudentDoc');
    exit();