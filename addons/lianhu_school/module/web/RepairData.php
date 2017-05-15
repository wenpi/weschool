<?php 
	$this->checkAdminWeb();
    $class_admin  = D('admin');
	$admin_result = $class_admin->judeAdminType();
	$left_top     = 'system_data';
	$left_nav     = 'repairData';
	$title        = '报修管理';  
	$sidebar_list = array(
		array('fun_str'=>'','fun_name'=>'系统数据'),
		array('fun_str'=>'repairData','fun_name'=>'报修管理'),
	);
     $begin_time      = $_GPC['begin_time'] ? strtotime($_GPC['begin_time']) :strtotime("-1 day");
     $end_time        = $_GPC['end_time']   ? strtotime($_GPC['end_time'])   :strtotime("+1 day");
     $class_department = D('department');
     $class_repair     = D('repair');
     $repair_list      = $class_department->getDeList(array(":repair_fix"=>1));
     if($repair_list){
            foreach ($repair_list as $key => $value) {
                $repair_list[$key]['admin_list'] = $class_department->getDepartmentAdminList($value['department_id']);
            }
     }
     if($_GPC['submit']){
         $admin_ids = $_GPC['my_multi_select2'];
         if(!$admin_ids){
                $this->myMessage('请选择需要统计的员工',$this->createWebUrl('repairData' ),'错误');
         }
         $where = " and reply_time >= ".$begin_time." and reply_time <= ".$end_time." ";
         foreach ($admin_ids as $key => $value) {
             list($department_id,$admin_id) = explode("_",$value);
             $admin_info                    = $class_admin->getAdminInfo($admin_id);
             $department_info               = $class_department->edit($department_id);
             $out_list[$key]['admin_name']       = $admin_info['admin_name'];
             $out_list[$key]['department_name']  = $department_info['department_name'];
             $out_list[$key]['count']            = $class_repair->countReply(array(":repair_admin_id"=>$admin_id),$where);
         }
     }
     include $this->template('../admin/web_repair_data');
     exit();   