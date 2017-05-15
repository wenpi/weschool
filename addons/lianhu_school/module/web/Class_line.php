<?php 
	//新的后台只允许 1.站长；2.校长；3.教师；4.家校通登记在录人员
	$this->checkAdminWeb();
	$admin_result = D('admin')->judeAdminType();
	$left_top     = 'class_manage';
	$left_nav     = 'class_line';
	$title        = '班级圈';  
	$sidebar_list = array(
		array('fun_str'=>'','fun_name'=>'班级管理'),
		array('fun_str'=>'class_line','fun_name'=>'班级圈'),
	);
        $teacher        = $this->teacher_qx('no');
		$model          = $_GPC['model'] ? $_GPC['model'] :"class";
		$cid            = $_GPC['cid'];
		if($teacher == 'teacher'){
			//班主任
			$uid 		 = $_W['uid'];
			$t_id   	 =   getTeacherId();
			$t_name 	 =   $this->WebFindTeacherInfo('teacher_realname');
			$return_list =   D('teacher')->getTeacherClass($t_id);
			$list        =   $return_list['list'];
		}else{
			$list   = D('classes')->getThisAdminClassList();
			$t_name = "管理员";
		}
		if($_GPC['cid']){
			$class=pdo_fetch("select * from {$table_pe}lianhu_class where class_id=:cid  ",array(':cid'=>$_GPC['cid']));
			if(!$class)
				$this->myMessage('没有找到此班级',$this->createWebUrl('class_line',array('aw'=>$aw) ),'错误');
		}
        if($op=='delete'){
            $where["send_id"] = $_GPC['sid'];
            $up['send_status'] = 3;
            pdo_update("lianhu_send",$up,$where);
            $this->myMessage('删除成功',$this->createWebUrl('class_line',array('cid'=>$_GPC['cid'],'ac'=>'look','page'=>$_GPC['page'] ) ),'成功');
        }
         if($op=='pass'){
            $where["send_id"] = $_GPC['sid'];
            $up['send_status'] = 1;
            pdo_update("lianhu_send",$up,$where);
            $this->myMessage('审核成功',$this->createWebUrl('class_line',array('cid'=>$_GPC['cid'],'ac'=>'look' ,'page'=>$_GPC['page'] ) ),'成功');
        }
        if($ac == 'look'){
            $line_list = $this->getLineList($page,$pagesize,$class['class_id']);
            $total     = $this->getLineCount($class['class_id']);
        }
        $pager=pagination($total,$page,$pagesize);
		include $this->template('../admin/web_class_line');
		exit();