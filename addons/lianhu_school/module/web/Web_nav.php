<?php 
		$aw = 1;
		//新的后台只允许 1.站长；2.校长；3.教师；4.家校通登记在录人员
		$this->checkAdminWeb();
		$admin_result = D('admin')->judeAdminType();
		$left_top     = 'wap_admin';
		$left_nav     = 'web_nav';
		$title        = 'pc导航';  
		$sidebar_list = array(
				array('fun_str'=>'','fun_name'=>'官网管理'),
				array('fun_str'=>'web_nav','fun_name'=>'pc导航'),
		);
		$top_action = array(
			array('action_name'=>'添加新的信息','action'=>'web_nav','arr'=>array('ac'=>'new') ),
		);
        $class_pc   = D('pc');
        $class_wap  = D('wap');
        $list       = $class_pc->getNav();
        if($ac=='new'){
            if($_GPC['submit']){
 				$in['status'] 		= $_GPC['status'];
                $in['sort'] 		= $_GPC['sort'];
				$in['info_name'] 	= $_GPC['info_name'];
				$in['fun_name'] 	= $_GPC['fun_name'];
				$in['info_url'] 	= $_GPC['info_url'];      
                $class_pc->addNav($in); 
                $this->myMessage('新增成功',$this->createWebUrl('web_nav'),'成功');
            }
        }
		if($ac=='edit'){
			$id 	= $_GPC['id']; 
			$result = $class_wap->editInfo($id,false);
			if($_GPC['submit']){
				$in['sort'] 		= $_GPC['sort'];
				$in['status'] 		= $_GPC['status'];
				$in['info_name'] 	= $_GPC['info_name'];
				$in['fun_name'] 	= $_GPC['fun_name'];
				$in['info_url'] 	= $_GPC['info_url'];	
				$result = $class_wap->editInfo($id,$in);
				$this->myMessage('编辑成功',$this->createWebUrl('web_nav'),'成功');
			}
		}
		include $this->template('../admin/web_pc_nav');
		exit();