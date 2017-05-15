<?php 
	$this->checkAdminWeb();
	$admin_result = D('admin')->judeAdminType();
	$left_top     = 'school_base_set';
	$left_nav     = 'class_set';
	$title        = '班级设置';  
	$sidebar_list = array(
		array('fun_str'=>'adminindex','fun_name'=>'系统首页'),
		array('fun_str'=>'class','fun_name'=>'班级设置'),
	);
	$top_action = array(
		array('action_name'=>'班级列表','action'=>'class' ),
		array('action_name'=>'新增班级','action'=>'class','arr'=>array('ac'=>'new') ),
	);
    $page_name    = '班级列表';
    if($ac=='new'){
         $page_name    = '新增班级';
    }
	$we7_js = 'no';
	$class_grade 			  = D('grade');
	$class_grade->school_id   = getSchoolId();
	$grade_list  = $class_grade->getThisAdminGradeList();
	$course_list = D('course')->getCourseList();
	$video_list  = C('video')->getVideoList();

	if($ac=='list'){
		if($_GPC['grade_id']){
			$params[':grade_id'] = $_GPC['grade_id'];
		}
		if($_GPC['status']){
			$params[':status']   = $_GPC['status'];
		}
		$list  = D('classes')->getThisAdminClassList(true,$params);
		foreach ($list as $key => $value) {
			$list[$key]['grade_name']   	= $this->gradeName($value['grade_id']);	
			$list[$key]['teacher_realname'] = $this->teacherName($value['teacher_id']);	
		}
		$num = count($list);
	}

	if($ac=='new'){
		$base_class = D('course')->getAllBasicList();
		foreach ($base_class as $key => $value) {
			$course_ids[$key] = $value['course_id'];
		}
		if($_GPC['submit']){
			$where['class_name']= $_GPC['class_name'];
			$where['grade_id']  = $_GPC['grade_id'];
			$result = D('classes')->edit($where);
			if($result){
				$this->myMessage('此班级名已经存在',$this->createWebUrl('class' ),'错误');
			}
			$in['class_name']  = $_GPC['class_name'];
			$in['grade_id']    = $_GPC['grade_id'];
			$in['student_in_send'] = $_GPC['student_in_send'];
			$in['line_img']    = getImgToUrl($_GPC['line_img'],$this);
			$in['course_ids']  = serialize($_GPC['course_s']);
			$in['video_ids']   = serialize($_GPC['video_s']);
			$in['msg_class']   = $_GPC['msg_class'];
			if(Au('src/codeShop')->getCode('xuznfenqu1')){
				$in['channel_id']        = $_GPC['channel_id'];
				$in['channel_content']   = $_GPC['channel_content'];
				$in['channel_intro'] 	 = $_GPC['channel_intro'];				
			}
			D('classes')->add($in);
			$this->myMessage('新增成功',$this->createWebUrl('class',array('aw'=>$aw) ),'成功');
		}
	}

	if($ac=='edit'){
		$id 				= (int)$_GPC['id'];
		$where['class_id']  = $id;
		$result 		= D('classes')->edit($where);
		$list_teacher   = C('teacher')->getClassTeacherList($id);
		if($_GPC['submit']){                  
			$in['class_name'] 	= $_GPC['class_name'];
			$in['grade_id'] 	= $_GPC['grade_id'];
			$in['line_img']     = getImgToUrl($_GPC['line_img'],$this);
			$in['teacher_id']   = $_GPC['teacher_id'];
			$in['status'] 	    = $_GPC['status'];
			$in['student_in_send'] = $_GPC['student_in_send'];
			$in['course_ids']   = serialize($_GPC['course_s']);
			$in['video_ids']    = serialize($_GPC['video_s']);
			$in['msg_class']    = $_GPC['msg_class'];
			if(Au('src/codeShop')->getCode('xuznfenqu1')){
				$in['channel_id']        = $_GPC['channel_id'];
				$in['channel_content']   = $_GPC['channel_content'];
				$in['channel_intro'] 	 = $_GPC['channel_intro'];				
			}
			D('classes')->edit($where,$in);
			$this->myMessage('修改成功',$this->createWebUrl('class',array('aw'=>$aw)),'成功');					
		}
	}

	if($ac=='delete'){
		$id 		   			 = $_GPC['id'];
		$class_student 			 = D('student');
		$class_student->class_id = $id;
		$student_list  			 = $class_student->getClassStudentList(); 
		if($student_list){
			$this->myMessage('无法删除,该班级下已有学生','','错误');
		}else{
			$classes_mclass = M("classes");
			if($classes_mclass){
				$classes_mclass->deleteStatus($id);
			}
			D('classes')->delete(array('class_id'=>$id));
			$this->myMessage('删除成功',$this->createWebUrl('class',array('aw'=>$aw)),'成功');		
		}
	}	

	include $this->template('../admin/web_class');
	exit();