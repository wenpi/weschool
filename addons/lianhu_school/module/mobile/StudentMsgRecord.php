<?php
	$student_info 	  = $this->mobile_from_find_student();
    $student_name     = $student_info['student_name'];
    $page_title       = "消息记录";
    $page             = $_GPC['page'] ? $_GPC['page']:1;
    D('sendAlone')->each_page = 10;
    $params[":student_id"] = $student_info['student_id'];
    $re 	 	       = D('sendAlone')->getList($params,false,$page);
    $alone_list        = $re['list'];
    $class_sendRecord  =  D("sendRecord");
    $class_admin       = D("admin");
    foreach ($alone_list as $key => $value) {
        $result = $class_sendRecord->dataEdit($value['record_id']);
        if($result['db_admin_id']){
            $db_admin_info  = $class_admin->dbAdminInfo($result['db_admin_id']);
            $result['admin_name'] = $db_admin_info['admin_name'];
            $result['admin_img']  = $this->imgFrom($db_admin_info['admin_img']);
        }else{
            $result['admin_name'] = '管理员';
            $result['admin_img']  = $this->imgFrom(S("system",'getSetContent',array('school_logo',$this->school_info['school_id'])));
        }
        $result['time_date'] = date("Y-m H",$result['add_time']);
        $list[$key] = $result;
    }
    if($ac=='ajax'){
        if($list){
            $template = $this->selectTemplate("StudentMsgRecord_content");
            include $this->template($template);
        }else{
            echo "done";
        }
        exit();
    }