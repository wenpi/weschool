<?php
		$teacher_info = $this->teacher_mobile_qx(); 
		$student_name = $teacher_info['teacher_realname'];
		$page_title   = '学生记录';
		$classes_list = D("teacher")->getTeacherClass($teacher_info['teacher_id'],'all');
		$classes_list = $classes_list['list_all'];

		$class_record = D('record');
		$class_work   = D('work');
		$class_teacher= D('teacher');
		$class_admin  = D('admin');
		$class_work->workUp();
		$class_student = D('student');
		$class_list   = $class_record->getRecordClass();
		$model 	      = $_GPC['model'] ? $_GPC['model'] :"class";
		$do_in 	 	  = 1;
		if($model=='class'){
			$result=$this->student_standard("no");	 
		}else{
			$result=$this->student_standard();	 
		}

		if($model=='someone'){
			if($_GPC['token'] != $_COOKIE['form_token'] && $_GPC['submit']){
				$do_in = 0;
			}
 			$token        = $this->class_base->tokenForm();
			if($_GPC['submit'] && $do_in==1){
				if(!strstr($_GPC['img_value'],'images') && $_GPC['img_value']){
						$in['img']          = $this->getWechatMedia($_POST['img_value'],1,true); 
				}
				if($_POST['voice_value']){
						$in['voice']        = $this->getWechatMedia($_POST['voice_value'],2,false);
				}
				$in['student_id']   = $result['student_id'];
				$in['class_id']     = $result['class_id'];
				$in['grade_id']     = $result['grade_id'];
				$in['word']         = $_GPC['word'];
				$in['content']      = $_GPC['content'];
				$in['jilv_class']   = $_GPC['jilv_class'];
				$in_id 				= $class_work->add($in);
                $this->sendRecordMsg($result['student_id'],'记录','',$_W['siteroot'].'app/'.$this->createMobileUrl('line_article',array('wid'=>$in_id )) );
				$this->myMessage('新增记录成功',$this->createMobileUrl('tea_work_record'),'成功');
			}
			$class_work->each_page = 100000;
			$params[":student_id"] = $result['student_id'];
			$work_re 		 	   = $class_work->get(1,$params);
			$list 				   = $work_re['list'];
			if($list){
				foreach ($list as $key => $value) {
					$list[$key] = $class_work->addInfoToWork($value);
				}
			}
		} 