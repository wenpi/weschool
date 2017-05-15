<?php 
	$this->checkAdminWeb();
	$admin_result = D('admin')->judeAdminType();
	$left_top     = 'school_base_set';
	$left_nav     = 'grade_set';
	$title        = '年级设置';  
	$sidebar_list = array(
		array('fun_str'=>'adminindex','fun_name'=>'系统首页'),
		array('fun_str'=>'grade','fun_name'=>'年级设置'),
	);
	$top_action = array(
		array('action_name'=>'年级列表','action'=>'grade' ),
		array('action_name'=>'新增年级','action'=>'grade','arr'=>array('ac'=>'new') ),
	);
    $page_name    = '年级列表';
    if($ac=='new'){
         $page_name    = '新增年级';
    }
	$class_grade = D('grade');
	$we7_js = 'no';
	if($ac == 'list'){
		$list = $class_grade->getThisAdminGradeList(true);
	}
	if($ac=='delete'){
		$id 	= (int)$_GPC['id'];
		$result = pdo_fetch("select * from {$table_pe}lianhu_class where grade_id={$id}");
		if($result){
			$this->myMessage('下面已经绑定班级，无法删除',$this->createWebUrl('grade'),'错误');
		}
		$class_mgrade = M('grade');
		if($class_mgrade){
			$class_mgrade->deleteStatus($id);
		}
		$de_re  = $class_grade->delete(array('grade_id'=>$id));
		$this->myMessage("删除成功",$this->createWebUrl('grade'),'成功');
	}
	if($ac=='new'){
		if($_GPC['submit']){
			$where['grade_name']  = $_GPC['grade_name'];
			$result 			  = $class_grade->edit($where);
			if($result){
				$this->myMessage('此年级名已经存在',$this->createWebUrl('grade',array("aw"=>$aw) ),'错误');
			}
			$class_grade->addGrade($_GPC['in_school_year'],$_GPC['grade_name']);
			$this->myMessage('新增成功',$this->createWebUrl('grade',array("aw"=>$aw)),'成功');
		}
	}
	if($ac=='edit'){
		$id 	= $_GPC['id'];
		$result = $class_grade->edit(array('grade_id'=>$id));
		if($_GPC['submit']){        
			$in['grade_name'] 		= $_GPC['grade_name'];
			$in['in_school_year']	= $_GPC['in_school_year'];	
			$class_grade->dataEdit(array('grade_id'=>$id),$in);
			$this->myMessage('修改成功',$this->createWebUrl('grade',array("aw"=>$aw)),'成功');					
		}
	}
	include $this->template('../admin/web_grade');
	exit();