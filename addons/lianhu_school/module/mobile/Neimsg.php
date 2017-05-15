<?php 
	$student 	  = $this->mobile_from_find_student();
	$list 	 	  = D('neiMsg')->getAll();
	$student_name = $student['student_name'];
	$page_title     = '学校公告';  

    $page           	   = $_GPC['page'] ? $_GPC['page']:1;
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
            $template = $this->selectTemplate("Neimsg_content");
            include $this->template($template);
        }else{
            echo "done";
        }
        exit();
    }