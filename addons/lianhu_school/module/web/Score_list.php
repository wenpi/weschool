<?php
		$this->checkAdminWeb();
		$admin_result = D('admin')->judeAdminType();
		$left_top     = 'class_manage';
		$left_nav     = 'score_out';
		$title        = '发布成绩';  
		$sidebar_list = array(
			array('fun_str'=>'','fun_name'=>'班级管理'),
			array('fun_str'=>'score_list','fun_name'=>'发布成绩'),
		);
		$top_action = array(
			array('action_name'=>'成绩发布' ,'action'=>'score_list' ),
			array('action_name'=>'新建考试记录 ','action'=>'data_in','arr'=>array('ac'=>'score_list_jilv','op'=>'create' )),
			array('action_name'=>'考试记录列表 ','action'=>'data_in','arr'=>array('ac'=>'score_list_jilv')),
			array('action_name'=>'导入成绩' ,'action'=>'data_in','arr'=>array('ac'=>'score' ) ),
		);
		$page_name    = '成绩发布';
		
		$teacher  = $this->teacher_qx('no');
		if($teacher=='teacher'){
			$model=$_GPC['model'] ? $_GPC['model'] :"class";
			if($model=='class'){
				$result=$this->teacher_standard('no');
			}else{
				$result=$this->student_standard();		
			}
		}else{
			$model=$_GPC['model'] ? $_GPC['model'] :"grade";
			$result=$this->student_standard();		
		}
		
        if($model=='student'){
			$re=pdo_fetch("select * from {$table_pe}lianhu_class where class_id=:cid",array(':cid'=>$_GPC['cid']));
			$course_id_arr=unserialize($re['course_ids']);
			if(!$course_id_arr)
				$this->myMessage("请先给这个班级设置课程",$this->createWebUrl("score_list",array('aw'=>$aw) ),'错误');
			$in_str=implode(',',$course_id_arr);
			$course_list=$this->get_class_course($_GPC['cid']);
			$jilv_list=$this->get_grade_sroce_jilv($re['grade_id'],TIMESTAMP-3600*24*30);
		}
		if($_GPC['submit']){
            $course_id  = $_GPC['course_id'];
			$re         = pdo_fetch("select * from {$table_pe}lianhu_class where class_id=:cid",array(':cid'=>$_GPC['class_id']));
			$teahcer_re = pdo_fetch("select * from {$table_pe}lianhu_teacher where 
           							(course_id ={$course_id} or course_id like '{$course_id},%' or course_id like '%,{$course_id},%' or course_id like '%,{$course_id}') 
            						and teacher_other_power like :power ",array(":power"=>"%{$_GPC['class_id']}%"));
			$score=$_GPC['score'];
			$in['course_id'] = $_GPC['course_id'];
			$in['class_id']  = $_GPC['class_id'];
			$in['ji_lv_id']  = $_GPC['scorejilv_id'];
			$in['teacher_id']= $teahcer_re['teacher_id'];
			$in['addtime']   = TIMESTAMP;
			$in['uid']       = $_W['uid'];
			$in['grade_id']  = $re['grade_id'];
			foreach ($score as $key => $value) {
				$in['student_id'] = $key;
				$in['score'] 	  = $value;
				$scorelist_re = pdo_fetch("select scorelist_id from {$table_pe}lianhu_scorelist where course_id=:course_id and class_id=:class_id and student_id=:student_id and 
								ji_lv_id=:ji_lv_id ",array(':course_id'=>$in['course_id'],':class_id'=>$in['class_id'],':student_id'=>$in['student_id'],
								':ji_lv_id'=>$_GPC['scorejilv_id']));
				if($scorelist_re){
					pdo_update('lianhu_scorelist',$in,array('scorelist_id'=>$scorelist_re['scorelist_id']));
				}else{
					$in['school_id']=getSchoolId();
					$in['uniacid']=$_W['uniacid'];
					pdo_insert('lianhu_scorelist',$in);

				}
			}
			$this->myMessage('新增成功','','成功');
		}
	include $this->template('../admin/web_score_list');
	exit();
