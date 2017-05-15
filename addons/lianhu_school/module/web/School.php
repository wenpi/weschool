<?php 
		$this->checkAdminWeb();
		$admin_result = D('admin')->judeAdminType();
		$left_top     = 'school_base_set';
		$left_nav     = 'school_params';
		$title        = '学校参数设置';  
		$sidebar_list = array(
			array('fun_str'=>'adminindex','fun_name'=>'系统首页'),
			array('fun_str'=>'school','fun_name'=>'学校参数设置'),
		);
		$op 	     = $this->op;
		$class_school= D('school');
		$school_id   = getSchoolId();
		if(!$school_id && $op!='select'){
				$this->myMessage("请添加或者选择学校",$this->createWebUrl("school_new"),'错误');
		}
		$message_url = $this->createWebUrl('school',array('aw'=>1,'op'=>'edit','sid'=>$school_id ));
		$type_list 	 = S("school","schoolType",array());
		$config      = $this->module['config'] ;
		$template_file_list = C('template')->mobileTemplates();
		$wap_file_list 		= C('template')->wapTemplates();
		$web_file_list 		= C('template')->webTemplate();
		if($op == 'list'){
			$list = pdo_fetchall("select * from ".$this->table_pe."lianhu_school where uniacid={$_W['uniacid']}");
		}		
		if($op == 'edit' && $school_id){
			$result = pdo_fetch("select * from ".$this->table_pe."lianhu_school where school_id=:sid ",array(':sid'=>$school_id));
			if($_GPC['submit']){
				$up 							= "";
                $up['school_name']     		    = $_GPC['school_name'];
				$up['status']           		= $_GPC['status'];
                $up['mu_str']           		= $_GPC['mu_str'];	
                $up['line_status']      		= $_GPC['line_status'];	
                $up['school_type']      		= $_GPC['school_type'];	
                $up['class_notice_status']      = $_GPC['class_notice_status'];	
				$up['host_url'] 				= $_GPC['host_url'];
				$up['on_school'] 				= $_GPC['on_school'];
				$up['begin_day'] 				= $_GPC['begin_day'];
				$up['am_much'] 					= $_GPC['am_much'];
				$up['pm_much'] 				    = $_GPC['pm_much'];
				$up['ye_much'] 					= $_GPC['ye_much'];
				$up['line_type'] 				= $_GPC['line_type'];
				$up['parents'] 					= $_GPC['parents'];
				$up['appointment'] 				= $_GPC['appointment'];
				$middle_school     				= M("school");
				if($middle_school){
					$middle_school->school_name     = $up['school_name'];
					$middle_school->status          = 1;
					$middle_school->jia_school_id   = $school_id;
					$middle_school->dataEdit();
				}				
				pdo_update('lianhu_school',$up,array('school_id'=>$school_id));
				S("system",'setSchoolWapTemplate',array($school_id,$_GPC['wap_teamplate']));
				S("system",'setSchoolPcTemplate',array($school_id,$_GPC['pc_teamplate']));
				S("system",'TeacherCheckUnit',array($school_id,'in',$_GPC['tea_check_unit']));
				S("system",'dayWorkMuch',array('in',$_GPC['day_work_much']));
				S("system",'dayWorkBase',array('in',$_GPC['day_work_base']));
				if(!$_GPC['mobile_title']){
					$_GPC['mobile_title']='家长中心';
				}		
				$_GPC['care_img'] 	 = getImgToUrl($_GPC['care_img'],$this);
				$_GPC['school_logo'] = getImgToUrl($_GPC['school_logo'],$this);
				$class_school->setSchoolParams();
				$this->myMessage("学校参数更新成功",$message_url,'成功');
			}
		} 
		
		if($op=='select'){
			$result = pdo_fetch("select * from ".$this->table_pe."lianhu_school where school_id=:sid ",array(':sid'=>$_GPC['sid']));
			if($result){
				setSchoolId($result['school_id']);
				setcookie('school_id',$result['school_id'],TIMESTAMP+3600*24*7,'/');
				setcookie($_W['uniacid'].'_school_id',$result['school_id'],TIMESTAMP+3600*24*7,'/');
				if($_GPC['back_url']){
					 $this->myMessage("切换成功",$this->createWebUrl($_GPC['back_url']),'成功');
				}else{
					 $this->myMessage("切换成功",'','成功');
				}
			}else{
				$this->myMessage("切换失败",'','错误');
			}
		}
		include $this->template('../admin/web_school');
		exit();