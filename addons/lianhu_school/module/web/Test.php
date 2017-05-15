<?php 
		$uid=$_W['uid'];
		$this->teacher_qx('no');
		$t_id 			= getTeacherId();	
		$model 			= $_GPC['model'] ? $_GPC['model'] :"grade";
		$result 		= $this->student_standard();	
		$school_id 		= getSchoolId();
		if($model=='someone'){
			if($_GPC['submit']){
				$in['teacher_id'] = $t_id;
				$in['student_id'] = $result['student_id'];
				$in['class_id']   = $result['class_id'];
				$in['grade_id']   = $result['grade_id'];				
				$in['word']       = $_GPC['word'];
				$in['img'] 		  = $_GPC['img'];
				$in['score']      = $_GPC['score'];
				$in['content']    = $_GPC['content'];
				$in['addtime']    = TIMESTAMP;
				$in['course_name']='';
				$in['uniacid']    = $_W['uniacid'];
				$in['school_id']=$school_id;
				
				$filePath=ATTACHMENT_ROOT.$_GPC['img'];
				if(file_exists($filePath))
               		 $img=$this->upToQiniu($_GPC['img']);
                if($img)
                	$in['img']= $img;                
				pdo_insert('lianhu_test',$in);
				$this->sendRecordMsg($result['student_id'],'考试记录');
				message('新增考试记录成功','refresh','success');
			}
			$school_uniacid_test=" and test.uniacid={$_W['uniacid']} and test.school_id={$school_id} ";
			$list=pdo_fetchall("select test.*,tea.teacher_realname from {$table_pe}lianhu_test test left join  {$table_pe}lianhu_teacher tea on tea.teacher_id=test.teacher_id where test.student_id=:id {$school_uniacid_test} order by test_id desc ",array(':id'=>$result['student_id']));
		}				