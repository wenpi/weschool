<?php
		$teacher_info = $this->teacher_mobile_qx(); 
		$class_star   = D('star');
		$model 	      = $_GPC['model'] ? $_GPC['model'] :"class";
		if($model=='class'){
			$result=$this->student_standard('no');	
		}else{
			$result=$this->student_standard();	 
		}
		if($model=='someone'){
			if($_GPC['submit']){
				$in['student_id']   = $result['student_id'];
				$in['class_id']     = $result['class_id'];
				$in['grade_id']     = $result['grade_id'];
				$in['star_title']   = $_GPC['content'];
				$in['star_num']     = $_GPC['star_num'];
				$in['teacher_id']   = $teacher_info['teacher_id'];
				$in_id 				= $class_star->add($in);
                $this->sendRecordMsg($result['student_id'],'有新的星星的评级啦','',$_W['siteroot'].'app/'.$this->createMobileUrl('star') );
				$this->myMessage('新增星星的评级',$this->createMobileUrl('tea_star'),'成功');
			}
		}
