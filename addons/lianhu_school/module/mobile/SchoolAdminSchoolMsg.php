<?php
    $school_admin  = D('admin')->mobileValidSchoolAdmin();
    if(!$school_admin){
        header("Location:".$this->createMobileUrl("school_bangding"));
    }
    $student_name   = $school_admin['info']['admin_name'];
    $title          = '学校公告';
    $page           = $_GPC['page'] ? $_GPC['page']:1;
    D('neiMsg')->each_page = 10;
    $list 	 	           = D('neiMsg')->getAll(1,$page);
    
    foreach ($list as $key => $value) {
		if($value['db_admin_id']){
    		$admin_info = D('admin')->getAdminInfo($value['db_admin_id']);
    		$admin_name = $admin_info['admin_name'];
		}else{
			$admin_name = '管理员';
		}
		$list[$key]['admin_name'] = $admin_name;
	}

    if($ac=='ajax'){
        if($list){
            $template = $this->selectTemplate("SchoolAdminSchoolMsg_content");
            include $this->template($template);
        }else{
            echo "done";
        }
        exit();
    }