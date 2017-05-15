<?php 
	$this->checkAdminWeb();
	$admin_result = D('admin')->judeAdminType();
	$left_top     = 'class_manage';
	$left_nav     = 'student_record';
	$title        = '学生记录';  
	$sidebar_list = array(
		array('fun_str'=>'','fun_name'=>'班级管理'),
		array('fun_str'=>'student_record','fun_name'=>'学生记录'),
	);
	$top_action = array(
		array('action_name'=>'学生记录','action'=>'student_record'),
		array('action_name'=>'记录分类','action'=>'student_record','arr'=>array('ac'=>'class') ),
		array('action_name'=>'新增分类','action'=>'student_record','arr'=>array('ac'=>'class','op'=>'edit') ),
	);
	$page_name    = '学生记录';
	if($ac=='class'){
		$page_name    = '记录分类';
	}	
	if($op=='edit'){
		$page_name    = '新增分类';
	}
	$model  = $_GPC['model'] ? $_GPC['model'] :"grade";
	$result = $this->student_standard();
	$uid 	= $_W['uid'];
	$this->teacher_qx('no');
	$school_id      = getSchoolId();
	#作业管理
	if($ac=='work' || $ac=='list'){
		$class_work = D('work');
		$class_list = D('record')->getRecordClass();
		if($model == 'someone'){
			if($_GPC['submit']){
				$in['student_id'] = $result['student_id'];
				$in['class_id']   = $result['class_id'];
				$in['grade_id']   = $result['grade_id'];
				$in['word']       = $_GPC['word'];
				$in['img']        = $_GPC['img'];
				$in['content']    = $_GPC['content'];
				$in['jilv_class'] = $_GPC['jilv_class'];
				#调用七牛处理
				$filePath = ATTACHMENT_ROOT.$_GPC['img'];
				if(file_exists($filePath)){
					$img=$this->upToQiniu($_GPC['img']);
				}
				if($img){
					$in['img']= $img;
				}
				$id = $class_work->add($in);
				$url= $_W['siteroot'].'app/'.$this->createMobileUrl("line_article",array('wid'=>$id));
				$this->sendRecordMsg($result['student_id'],'记录',false,$url);
				$this->myMessage('新增记录成功',$this->createWebUrl('student_record',array('ac'=>$ac,'gid'=>$result['grade_id']) ),'成功');
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
	}
	if($ac == 'class'){
		$this->teacher_qx();
		$list  = D('record')->getRecordClass(true);
		if($op == 'edit'){
			$result=pdo_fetch("select * from {$table_pe}lianhu_jilv_class where class_id=:cid",array(':cid'=>$_GPC['class_id']) );
		}
		if($_GPC['submit']){
			if(!$_GPC['class_name']){
				$this->myMessage('分类名必须填写',$this->createWebUrl('student_record',array('ac'=>$ac) ),'错误');
			}
			if($_GPC['class_id']){
				$in['class_name']   = $_GPC['class_name'];
				$in['class_status'] = $_GPC['class_status'];
				$in['school_id']   	= $school_id;
				$in['uniacid'] 		= $_W['uniacid'];
				pdo_update('lianhu_jilv_class',$in,array('class_id'=>$_GPC['class_id']) );				
				$this->myMessage('编辑成功',$this->createWebUrl('student_record',array('ac'=>$ac) ),'成功');
			}else{
				$in['class_name']   = $_GPC['class_name'];
				$in['class_status'] = $_GPC['class_status'];
				$in['add_time']     = TIMESTAMP;
				$in['school_id']   	= $school_id;
				$in['uniacid'] 		= $_W['uniacid'];
				pdo_insert('lianhu_jilv_class',$in);
				$this->myMessage('新增成功',$this->createWebUrl('student_record',array('ac'=>$ac) ),'成功');
			}
		}
	}
	include $this->template('../admin/web_student_record');
	exit();