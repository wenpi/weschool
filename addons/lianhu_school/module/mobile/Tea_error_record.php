<?php
$teacher_info=$this->teacher_mobile_qx();
$_W['uid']=$teacher_info['fanid'];
		$model=$_GPC['model'] ? $_GPC['model'] :"grade";
		$result=$this->student_standard();	
		if($model=='someone'){
			if($_GPC['submit']){
				$in['teacher_id']=$teacher_info['teacher_id'];
				$in['student_id']=$result['student_id'];
				$in['class_id']=$result['class_id'];
				$in['grade_id']=$result['grade_id'];				
				$in['content']=$_GPC['content'];
				$in['content1']=$_GPC['content1'];
				$in['addtime']=TIMESTAMP;
				$in['course_name']='';
				$in['uniacid']=$_W['uniacid'];
				$in['school_id']=getSchoolId();
				pdo_insert('lianhu_weak',$in);
				$this->sendRecordMsg($result['student_id'],'弱项记录');
				message('新增弱项记录成功','refresh','success');
			}
			$list=pdo_fetchall("select weak.*,tea.teacher_realname from {$table_pe}lianhu_weak weak left join  {$table_pe}lianhu_teacher tea on tea.teacher_id=weak.teacher_id where weak.student_id=:id order by weak_id desc ",array(':id'=>$result['student_id']));
		}