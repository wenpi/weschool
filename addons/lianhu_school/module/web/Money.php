<?php
	$this->checkAdminWeb();
	$admin_result = D('admin')->judeAdminType();
	$left_top     = 'school_msg';
	$left_nav     = 'money';
	$title        = '收费管理';  
	$sidebar_list = array(
		array('fun_str'=>'','fun_name'=>'学校信息'),
		array('fun_str'=>'money','fun_name'=>'收费管理'),
	);
	$top_action = array(
		array('action_name'=>'收费管理','action'=>'money' ),
		array('action_name'=>'新增收费' ,'action'=>'money','arr'=>array('ac'=>'new') ),
		array('action_name'=>'收费组' ,'action'=>'moneyGroup' ),
	);
	$page_name    = '收费管理';
	if($ac=='new'){
		$page_name    = '新增收费';
	}
	$money_group_list  = D("moneyGroup")->allUseList();

	$appointment_limit = $this->appointment_limit;
	$cclass_moneyLimit = C('moneyLimit');
	$student_fun_list  = D('mobile')->getStudentFunc();
	$limit_type_arr    = $cclass_moneyLimit->limit_type;
	$count 			   = count($student_fun_list);
	$student_fun_list[$count]['name']   = '其他收费';
	$student_fun_list[$count]['key']    = 'othersf';
	$student_fun_list[$count+1]['name'] = '家长中心';
	$student_fun_list[$count+1]['key']  = 'bangding';
	$class_grade	= D('grade');
	$class_grade->school_id = $use_school_id;
	$grade_list 	= $class_grade->getSchoolList();
	$class_re   	= C('classes')->getSchoolClass();
	$class_list 	= $class_re['list'];
	if($ac=='delete'){
		if($_GPC['id']){
			$params["limit_id"]  = $_GPC['id'];
			$params["school_id"] = $this->school_info['school_id'];
			$up["status"]   	  = -1;
			$cclass_moneyLimit->use_class->edit($params,$up);
			$this->myMessage('删除成功',$this->createWebUrl('money'),'成功');
		}
	}
	if($ac=='edit'){
		if(empty($_GPC['id'])){
			$this->myMessage('非法访问','','错误');
		}
		$where['limit_id'] = $_GPC['id'];
		if($_GPC['submit']){
			if($_GPC['school_limit_type']==0){
				$_GPC['class_ids'] = NULL;
				$_GPC['grade_ids'] = NULL;
			}
			if($_GPC['school_limit_type']==1){
				$_GPC['class_ids'] = NULL;
				$_GPC['grade_ids'] = implode(',',$_GPC['grades']);				
			}
			if($_GPC['school_limit_type']==2){
				$_GPC['class_ids'] = implode(',',$_GPC['class']);	
				$_GPC['grade_ids'] = NULL;
			}			
			$_GPC['limit_module'] = implode(',',$_GPC['limit_module']);
			$up = getNewUpdateData($_GPC,$cclass_moneyLimit->use_class);
			$cclass_moneyLimit->use_class->edit($where,$up);
			$this->myMessage('修改成功，请注意对于已经缴费过的用户本有效期内，这次修改不会起效，是否缴费是以ID值鉴别的；',$this->createWebUrl('money'),'成功');
		}	
		$result = $cclass_moneyLimit->use_class->edit($where);
		$result['limit_module'] = explode(',',$result['limit_module']);
		$result['class_ids'] = explode(',',$result['class_ids']);
		$result['grade_ids'] = explode(',',$result['grade_ids']);
	}
	if($ac=='new'){
		if($_GPC['submit']){
			if($_GPC['school_limit_type']==0){
				$_GPC['class_ids'] = NULL;
				$_GPC['grade_ids'] = NULL;
			}
			if($_GPC['school_limit_type']==1){
				$_GPC['class_ids'] = NULL;
				$_GPC['grade_ids'] = implode(',',$_GPC['grades']);				
			}
			if($_GPC['school_limit_type']==2){
				$_GPC['class_ids'] = implode(',',$_GPC['class']);	
				$_GPC['grade_ids'] = NULL;
			}	
			$_GPC['limit_module'] = implode(',',$_GPC['limit_module']);

			$up = getNewUpdateData($_GPC,$cclass_moneyLimit->use_class);
			$cclass_moneyLimit->use_class->add($up);
			$this->myMessage('新增成功',$this->createWebUrl('money'),'成功');
		}
	}
	if($ac=='list'){
		$cclass_moneyLimit->use_class->each_page = 10000;
		$params[":status"] = array("!=",-1);
		$re   = $cclass_moneyLimit->use_class->getList($params);
		$list = $re['list'];
	}
	include $this->template('../admin/web_money');
	exit();