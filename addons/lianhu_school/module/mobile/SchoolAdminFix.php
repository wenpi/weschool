<?php 
    $school_admin  = D('admin')->mobileValidSchoolAdmin();
    if(!$school_admin){
        header("Location:".$this->createMobileUrl("school_bangding"));
    }
    $student_name       = $school_admin['info']['admin_name'];
    $page_title = $title= "报修管理";
    $page       = $_GPC['page'] ? (int)$_GPC['page']:1;
    D('repair')->every_page =10;
    $result = D('repair')->getList(false,$page);
    if($result['list']){
        foreach ($result['list'] as $key => $value) {
                $list[$key] = $value;
                $reply_list = D('repair')->getRepairReply($value['repair_id']);
                $list[$key]['do_admin_name']     = $reply_list[0]['admin_name'];
                $list[$key]['do_partname']       = $reply_list[0]['department_name'];
                $list[$key]['do_add_time']       = $reply_list[0]['reply_time'];
                $list[$key]['do_status']         = D('repair')->reply_status[$reply_list[0]['status']];
        }
    }
    if($_GPC['ajax']){
        if(!$list){
            echo 'done';
        }else{
            $template = $this->selectTemplate("SchoolAdminFix_content");
            include $this->template($template);	
        }
        exit();          
    }    

    