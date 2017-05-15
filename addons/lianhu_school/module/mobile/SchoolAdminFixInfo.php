<?php 
    $school_admin  = D('admin')->mobileValidSchoolAdmin();
    if(!$school_admin){
        header("Location:".$this->createMobileUrl("school_bangding"));
    }
    $student_name        = $school_admin['info']['admin_name'];
    $page_title = $title = "处理报修";
    $result              = D("repair")->updateRepair($_GPC['id']);
    $repair_admin_list   = D('department')->getDepartmentAdminList($result['department_id']);
    
    if($_GPC['submit']){
        $img_arrs           = $_POST['img_value'];
        if($img_arrs){
            foreach ($img_arrs as $key => $value) {
                $img = $this->getWechatMedia($value,1,false);
                if($img) 
                    $img_in[]= $img;
                else 
                    $img_in[]= $up_file_name; 
            }
        }
        $up['replay_time']          = time();
        $up['repair_id']            = $_GPC['id'];
        $up['department_id']        = $result['department_id'];
        $up['repair_admin_id']      = $_GPC['admin_id'];
        $up['reply_content']        = $_GPC['reply_content'];
        if($img_in){
            $up['reply_img']        = json_encode($img_in);
        }
        $up['status']               = $_GPC['status'];
        D("repair")->addRepairReply($up);
        $this->myMessage('添加回复成功',$this->createMobileUrl('schoolAdminFix' ),'成功');       
    }
	

