<?php 
		$this->checkAdminWeb();
		$admin_result = D('admin')->judeAdminType();
		$left_top     = 'school_base_set';
		$left_nav     = 'adv_admin';
		$title        = '占位符管理';  
		$sidebar_list = array(
				array('fun_str'=>'adminindex','fun_name'=>'学校基本设置'),
				array('fun_str'=>'adv_admin','fun_name'=>'占位符管理'),
		);
		$we7_js = 'no';
		$class_adv = D('adv');
		$class_adv->school_id = getSchoolId();
		$class_adv-> InKeyWord();
        if($ac=='list'){
			$list = $class_adv->getAdvList();
        }
        if($ac=='edit'){
			$adv_id = $_GPC['adv_id'];
			$result = $class_adv->getAdvInfo($adv_id);
			if($_GPC['submit']){
				$where['adv_id'] 	= $_GPC['adv_id'];
				$up['status']       = $_GPC['status'];
				$up['adv_content']  = getImgToUrl($_GPC['adv_content'],$this);
				pdo_update("lianhu_adv",$up,$where);
				$this->myMessage("更新成功",$this->createWebUrl('adv_admin'),'成功');
			}
        }
    	include $this->template('../admin/web_adv_admin');
	    exit();    