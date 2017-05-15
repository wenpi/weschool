<?php 
	$this->checkAdminWeb();
	$admin_result = D('admin')->judeAdminType();
	$left_top     = 'school_msg';
	$left_nav     = 'department';
	$title        = '部门机构';  
	$sidebar_list = array(
		array('fun_str'=>'','fun_name'=>'学校信息'),
		array('fun_str'=>'department','fun_name'=>'部门机构'),
	);
	$top_action = array(
		array('action_name'=>'部门列表' ,'action'=>'department' ),
		array('action_name'=>'新增部门' ,'action'=>'department','arr'=>array('ac'=>'new','op'=>'department' ) ),
	);  
    $page_name    = '部门列表';
    if($op=='department'){
        $page_name    = '新增部门';
    }	
   
    $school_id        = getSchoolId();
	$class_department = D('department');
    $school_all_list  = D('admin')->getSchoolAllAdminList($school_id);
    if($ac=='list'){    
        $list = $class_department->getDeList();
        if($list){
            foreach ($list as $key => $value) {
                $list[$key]['property']   = $class_department->getDepartProperty($value['department_id']);
                $main_admin               = $class_department->getDepartMainAdmin($value['department_id']);
                $list[$key]['main_admin'] = $main_admin['admin_name_str'];
            }
        }
        if($op=='add_admin'){
                $result = $class_department->edit($_GPC['id']);
                $list   = $class_department->getDepartmentAdminList($_GPC['id']);
        }
        $we7_js  = 'no';
    }
    if($ac=='new'){
        if($op=='add_admin'){
            $result             = $class_department->edit($_GPC['id']);
            $depart_admin_list  = $class_department->getDepartmentAdminList($_GPC['id']);
            $depart_admin_id_arr= S("fun","zuHeArr",array($depart_admin_list,"db_admin_id") );
        }
        if($_GPC['submit']){
            if($op=='department'){
                $in['department_name'] = $_GPC['department_name'];
                $in['repair_fix']      = $_GPC['repair_fix'];
                $class_department->add($in);
            }
            if($op=='add_admin'){
                $db_admin_ids        = $_GPC['db_admin_id'];
                if($db_admin_ids){
                    foreach ($db_admin_ids as $key => $value) {
                        $in['department_id'] = $_GPC['id'];
                        $in['db_admin_id']   = $value;
                        $in['level']         = $_GPC['level'];
                        $class_department->addAdminDe($in);
                    }
                }else{
                   $this->myMessage('请选择雇员',$this->createWebUrl('department'),'错误');
                }
               $this->myMessage('新增成功',$this->createWebUrl('department',array('op'=>'add_admin','id'=>$_GPC['id'])),'成功');
            }
           $this->myMessage('新增成功',$this->createWebUrl('department'),'成功');
        }
    }
    if($ac=='edit'){
            $result = $class_department->edit($_GPC['id']);
            if($op=='department'){
                if($_GPC['submit']){
                     $in['department_name'] = $_GPC['department_name'];
                     $in['repair_fix']      = $_GPC['repair_fix'] ? $_GPC['repair_fix']:0;
                     $class_department->edit($_GPC['id'],$in);
                     $this->myMessage('编辑成功',$this->createWebUrl('department'),'成功');
                }
            }
            if($op=='add_admin'){
                $department_id = $_GPC['id'];
                $peadmin_id    = $_GPC['peadmin_id'];
                $admin_re = $class_department->editAdminDe($peadmin_id);
                $admin_re = D('admin')->getAdminInfo($admin_re['db_admin_id']);
                if($_GPC['submit']){
                    $up['level']   = $_GPC['level'];
                    $class_department->editAdminDe($peadmin_id,$up);
                    $this->myMessage('编辑成功',$this->createWebUrl('department',array('op'=>'add_admin','id'=>$department_id)),'成功');
                }
            }
    }
    if($ac=='delete'){
        if($op=='department'){
            $class_department->delete($_GPC['id']);
            $this->myMessage('删除成功',$this->createWebUrl('department'),'成功');
        }
        if($op=='add_admin'){
            $class_department->deleteAd($_GPC['peadmin_id']);
            $this->myMessage('删除成功',$this->createWebUrl('department',array('op'=>'add_admin','id'=>$department_id)),'成功');
        }        
    }
    include $this->template('../admin/web_department');
    exit();   
