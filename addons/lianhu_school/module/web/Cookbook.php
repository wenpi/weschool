<?php 
	$aw = 1;
	//新的后台只允许 1.站长；2.校长；3.教师；4.家校通登记在录人员
	$this->checkAdminWeb();
	$admin_result = D('admin')->judeAdminType();
	$left_top     = 'school_msg';
	$left_nav     = 'student_cookbook';
	$title        = '学生食谱';  
	$sidebar_list = array(
	      array('fun_str'=>'','fun_name'=>'学校消息'),
	      array('fun_str'=>'cookbook','fun_name'=>'学生食谱'),
	);
	$mu_str     		= $this->school_info['mu_str'];
	$cookbook_class_arr = C('cookbook')->cookbookCLass();

	if($mu_str!='xiaoye'){
		$where["xiaoye"]    = 0;
		$where['school_id'] = getSchoolId();
		$result 			= C('cookbook')->use_class->edit($where);
		if($_GPC['submit']){
			$in['cookbooK_breakfast'] = $_GPC['cookBook'];
			C('cookbook')->use_class->add($in);
			$this->myMessage("更新成功",$this->createWebUrl('cookbook' ),'成功');
		}   
	}elseif($mu_str=='xiaoye'){
		$out_times 		= C('cookbook')->getTimeList();
		if($_GPC['submit']){
			$cookbool_info  	 = $_GPC['cookbook'];
			foreach ($cookbool_info as $key => $value) {
				$in['class_name'] = $key;
				$in['xiaoye']     = 1;
				foreach ($value as $k => $val) {
					$in['use_time']   			= $k;
					$in['cookbooK_breakfast'] 	= $val;
					$in['imgs'] = implode(',',$_GPC['img'][$key][$k]);
					C('cookbook')->use_class->add($in);
				}
			}
			$this->myMessage("更新成功",$this->createWebUrl('cookbook'),'成功');
		}
	}
	include $this->template('../admin/web_cookbook');
	exit();
   
