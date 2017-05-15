<?php
		$teacher_info = $this->teacher_mobile_qx();
		$student_name = $teacher_info['teacher_realname'];
		$page_title   = '发布成绩';
		$_W['uid']    = $teacher_info['fanid'];
		$model 		  = $_GPC['model'] ? $_GPC['model'] :"class";
        if($model=='class'){
            $result=$this->teacher_standard('no');
		}else{
            $result=$this->student_standard();	
		}
		if($model=='student'){
			$re 			= pdo_fetch("select * from {$table_pe}lianhu_class where class_id=:cid",array(':cid'=>$_GPC['cid']));
			$course_id_arr  = unserialize($re['course_ids']);
			$in_str         = implode(',',$course_id_arr);
			//教师的课程
			$teacher_course = $this->teacherCourse($teacher_info['teacher_id'],'');
			foreach ($teacher_course as $key => $value) {
				if(in_array($value['course_id'],$course_id_arr) ){
					$course_list[]=$value;
				}
			}
			if(!$course_list){
				$this->myMessage("没有课程，无法发布成绩",$this->createMobileUrl('tea_score_in'),"错误");
			}			
			$jilv_list      = pdo_fetchall("select * from  {$table_pe}lianhu_scorejilv where grade_id=:gid  and status=1 order by addtime desc ",array(':gid'=>$re['grade_id']));
			if(!$jilv_list){
				$this->myMessage("没有设置考试记录无法发布成绩",$this->createMobileUrl('tea_score_in'),"错误");
			}	
		}
		if($_GPC['submit']){
            $course_id = $_GPC['course_id'];
			$re        = pdo_fetch("select * from {$table_pe}lianhu_class where class_id=:cid",array('cid'=>$_GPC['class_id']));
			$teahcer_re= pdo_fetch("select * from {$table_pe}lianhu_teacher where
             						(course_id ={$course_id} or course_id like '{$course_id},%' or course_id like '%,{$course_id},%' or course_id like '%,{$course_id}') 
             						and teacher_other_power like :power ",array(":power"=>"%{$_GPC['class_id']}%"));
			$score 	   		 = $_GPC['score'];
			$in['course_id'] = $_GPC['course_id'];
			$in['class_id']  = $_GPC['class_id'];
			$in['ji_lv_id']  = $_GPC['scorejilv_id'];
			$in['teacher_id']= $teahcer_re['teacher_id'];
			$in['addtime']   = TIMESTAMP;
			$in['uid']       = $_W['uid'];
			$in['grade_id']  = $re['grade_id'];
			foreach ($score as $key => $value) {
				$in['student_id']=$key;
				$in['score']=$value;
				$scorelist_re=pdo_fetch("select scorelist_id from {$table_pe}lianhu_scorelist where course_id=:course_id and class_id=:class_id and student_id=:student_id and 
								teacher_id=:teacher_id and grade_id=:gid and ji_lv_id=:ji_lv_id ",array(':course_id'=>$in['course_id'],':class_id'=>$in['class_id'],':student_id'=>$in['student_id'],
								':teacher_id'=>$in['teacher_id'],':gid'=>$in['grade_id'],":ji_lv_id"=>$_GPC['scorejilv_id'] ));
				if($scorelist_re){
					pdo_update('lianhu_scorelist',$in,array('scorelist_id'=>$scorelist_re['scorelist_id']));
				}else{
					$in['uniacid']=$_W['uniacid'];
					$in['school_id']=getSchoolId();	
					pdo_insert('lianhu_scorelist',$in);
				}
			}
			$this->myMessage('操作成功',$this->createMobileUrl("tea_score_in"),'成功');
}