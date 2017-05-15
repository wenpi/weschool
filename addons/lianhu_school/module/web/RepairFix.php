<?php 
	$this->checkAdminWeb();
    $class_admin  = D('admin');
	$admin_result = $class_admin->judeAdminType();
	$left_top     = 'school_msg';
	$left_nav     = 'repairFix';
	$title        = '报修管理';  
	$sidebar_list = array(
		array('fun_str'=>'','fun_name'=>'学校信息'),
		array('fun_str'=>'repairFix','fun_name'=>'报修管理'),
	);
 
	$class_repair     = D('repair');
	$class_department = D('department');
    $pagesize         = $class_repair->every_page;

    if($ac=='list'){
        $page   = $_GPC['page'];
        $result = $class_repair->getList(false,$page);
        $total  = $result['count'];
        $list   = $result['list'];
        if($list){
            foreach ($list as $key => $value) {
                $reply_list      = $class_repair->getRepairReply($value['repair_id']);
                $list[$key]['do_admin_name']     = $reply_list[0]['admin_name'];
                $list[$key]['do_partname']       = $reply_list[0]['department_name'];
                $list[$key]['do_add_time']       = $reply_list[0]['reply_time'];
                $list[$key]['do_status']         = $class_repair->reply_status[$reply_list[0]['status']];
            }
        }
        $pager  = pagination($total,$page,$pagesize);
    }
    if($ac=='add'){
        $repair_list    = $class_department->getDeList(array(":repair_fix"=>1));
        if($repair_list){
            foreach ($repair_list as $key => $value) {
                $repair_list[$key]['admin_list'] = $class_department->getDepartmentAdminList($value['department_id']);
            }
        }
        $result         = $class_repair->updateRepair($_GPC['id']);
        $his_list       = $class_repair->getRepairReply($result['repair_id']);
        if($_GPC['submit']){
            list($department_id,$admin_id) = explode("_",$_GPC['admin_id']);
            $up['replay_time']          = time();
            $up['repair_id']            = $_GPC['id'];
            $up['department_id']        = $department_id;
            $up['repair_admin_id']      = $admin_id;
            $up['reply_content']        = $_GPC['reply_content'];
            if($_GPC['reply_img'])
                $up['reply_img']        = json_encode($_GPC['reply_img']);
            $up['status']               = $_GPC['status'];
            $class_repair->addRepairReply($up);
            $this->myMessage('添加回复成功',$this->createWebUrl('repairFix',array('ac'=>'add','id'=>$result['repair_id']) ),'成功');
        }
    }
    //编辑回复
    if($ac=='delete_reply'){
        $class_repair->deleteReply($_GPC['reply_id']);
        $this->myMessage('删除回复成功',$this->createWebUrl('repairFix',array('ac'=>'add','id'=>$_GPC['repair_id']) ),'成功');
    }
    if($ac=='delete_repair'){
        $class_repair->deleteRepair($_GPC['id']);
        $this->myMessage('删除报修成功',$this->createWebUrl('repairFix'),'成功');
    }
    if($ac=='print_reply'){
        $item           = $class_repair->updateRepair($_GPC['repair_id']);
        $reply_result   = $class_repair->updateReply($_GPC['reply_id']);
    }
    include $this->template('../admin/web_repairFix');
    exit();   
