<?php
		$aw = 1;
		//新的后台只允许 1.站长；2.校长；3.教师；4.家校通登记在录人员
		$this->checkAdminWeb();
		$admin_result = D('admin')->judeAdminType();
		$left_top     = 'wap_admin';
		$left_nav     = 'web_pc_index';
		$title        = 'pc首页';  
		$sidebar_list = array(
				array('fun_str'=>'','fun_name'=>'官网管理'),
				array('fun_str'=>'web_pc_index','fun_name'=>'pc首页'),
		);
		$class_pc 	  = D("pc");  
		$class_wap 	  = D("wap");  
		if($ac=='edit'){
			$result   = $class_wap->editInfo($_GPC['id']);
			if($op == 'lunbo'){
			}
		}
		if($ac=='new'){
			$key_word = $op;
			if($_GPC['submit']){
				$in['key_word'] = $key_word;
				$in['content']  = $_GPC['content'];
				$in['sort']  	= $_GPC['sort'];
				$in['status']  	= $_GPC['status'];
				$in['info_name']= $_GPC['info_name'];
				$in['info_url'] = $_GPC['info_url'];
				$in['fun_name'] = $_GPC['fun_name'];
				$class_pc->add($in);
				$this->myMessage('新增成功',$this->createWebUrl('web_pc_index'),'成功');
			}
		}
		if($ac=='edit'){
			$id 	= $_GPC['id'];
			$result = $class_wap->editInfo($id);
			$key_word = $op;
			if($_GPC['submit']){
				$in['key_word'] = $key_word;
				$in['content']  = $_GPC['content'];
				$in['sort']  	= $_GPC['sort'];
				$in['status']  	= $_GPC['status'];
				$in['info_name']= $_GPC['info_name'];
				$in['info_url'] = $_GPC['info_url'];
				$in['fun_name'] = $_GPC['fun_name'];
				$class_wap->editInfo($id,$in);
				$this->myMessage('编辑成功',$this->createWebUrl('web_pc_index'),'成功');
			}
		}
		include $this->template('../admin/web_pc_index');
		exit();