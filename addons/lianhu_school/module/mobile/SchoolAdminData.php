<?php 
    $school_admin  = D('admin')->mobileValidSchoolAdmin();
    if(!$school_admin){
        header("Location:".$this->createMobileUrl("school_bangding"));
    }
    $student_name       = $school_admin['info']['admin_name'];
    $page_title         = '我的资料';
    if($_GPC['submit']){
        $up['admin_name'] = $_GPC['admin_name'];
        if(!strstr($_GPC['img_value'],'images') && $_GPC['img_value']){
            $up['admin_img']  = $this->getWechatMedia($_POST['img_value'],1,false);  
	    }
        foreach ($up as $key => $value) {
            D('admin')->updateJiaAdmin($school_admin['db_admin_id'],$key,$value);
        }
        $this->myMessage('修改成功',$this->createMobileUrl('schoolAdminData'),'成功');
    }


