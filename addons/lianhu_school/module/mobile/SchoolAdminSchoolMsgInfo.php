<?php
    $school_admin  = D('admin')->mobileValidSchoolAdmin();
    if(!$school_admin){
        header("Location:".$this->createMobileUrl("school_bangding"));
    }
    $student_name   = $school_admin['info']['admin_name'];
    $title          = '学校公告详情';
    $msg_id         = $_GPC['id'];
    $result         = D('notice')->getNoticeInfo($msg_id);
    if($result['db_admin_id']){
        $admin_info = D('admin')->getAdminInfo($result['db_admin_id']);
        $admin_name = $admin_info['admin_name'];
    }else{
        $admin_name = '管理员';
    }
    if($ac=='delete'){
        $where["msg_id"] = $msg_id;
        $up["status"]    = -1;
        D('neiMsg')->edit($where,$up);
        $this->myMessage("删除成功",$this->createMobileUrl("schoolAdminSchoolMsg"),'成功');
    }
    if($ac=='edit'){
        
    }