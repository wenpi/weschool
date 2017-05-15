<?php 
		$this->checkAdminWeb();
		$admin_result = D('admin')->judeAdminType();
		$left_top     = 'school_base_set';
		$left_nav     = 'teacher_set';
		$title        = '教师设置';  
		$sidebar_list = array(
			array('fun_str'=>'adminindex','fun_name'=>'系统首页'),
			array('fun_str'=>'teacher','fun_name'=>'教师设置'),
		);
		$top_action = array(
			array('action_name'=>'教师列表','action'=>'teacher'),
			array('action_name'=>'添加教师','action'=>'teacher','arr'=>array('ac'=>'new') ),
		);
		$page_name    = '教师列表';
		if($ac=='new'){
			$page_name    = '添加教师';
		}		
		load()->model('user');
		$class_classes  = D('classes');
		$class_course   = D('course');
		$class_system 	= D('system');
		$class_admin 	= D('admin');
		$school_id 		= getSchoolId();
		$tagre 	 		= C('teacherTag')->getList();
		$tag_list 		= $tagre['list'];
		$class_list   	= $class_classes->getThisAdminClassList();
		$course_list 	= $class_course->getCourseList();
		$grades       	= $this->grade_class();
		$power_str    	= implode("|",$class_system->teacher_admin_per); 

        if($ac=='list'){
			$we7_js = 'no';
			if($_GPC['teacher_realname']){
				$teacher_realname  				= $_GPC['teacher_realname'];
				$params[":teacher_realname"]    = array("like","%{$teacher_realname}%");
				$in_params[":teacher_realname"] = $params[":teacher_realname"][1];
			}
			if($_GPC['status']){
				if($_GPC['status']==2){
					$params[':status'] = 0;
				}else{
					$params[':status'] = $_GPC['status'];
				}
				$in_params[":status"]  = $params[":status"];
			}
			if($params){
				$where_str 		    = " and ".S('fun','composeParamsToWhere',array($params,'tea'));
			}
			$have_up  			  	= pdo_fetch("select * from ".tablename('lianhu_teacher')." where have_up=0 ");
			$school_uniacid_table 	= "   tea.school_id={$school_id} ";
			$str  = "select tea.* ,admin.passport username,fan.nickname from {$table_pe}lianhu_teacher tea left join ".tablename('lianhu_db_admin')." admin on  admin.admin_id=tea.admin_id 
								left join ".tablename('mc_members')." fan on fan.uid=tea.uid  where  {$school_uniacid_table} ".$where_str;
			$list = pdo_fetchall($str,$in_params);
			$num  = count($list);
		}
		if($ac=='new'){
			if($_GPC['submit']){
				$class_s 					= $_GPC['class_s'];
				$in['teacher_other_power'] 	= implode(',', $class_s);
				$in['teacher_realname'] 	= $_GPC['teacher_realname'];
				$in['teacher_telphone'] 	= $_GPC['teacher_telphone'];
				$in['teacher_email'] 		= $_GPC['teacher_email'];
				$in['teacher_img'] 			= $_GPC['teacher_img'];
				$in['sms_send'] 			= $_GPC['sms_send'];
				$in['teacher_introduce'] 	= $_GPC['teacher_introduce'];
                if($_GPC['course_id']){
    				$in['course_id'] = implode(',',$_GPC['course_id']);
				}
				$in['weixin_code']   = $_GPC['weixin_code'];
				$group_id  			 = $this->class_base->getTeacherGroupId();
				$passport  			 = $_GPC['passport'];
				$password  			 = $_GPC['password'];
				if(!$_GPC['passport'] || !$_GPC['password']){
					$this->myMessage('系统账号信息必填','','错误');
				}
				$jia_admin = $class_admin->getJiaAdmin($passport);
				if($jia_admin){
					$this->myMessage('该账号已经存在','','错误');
				}				
				$user_in['passport'] 	  = $passport;
				$user_in['password']      = $password;
				$user_in['db_group_id']   = 0;
				$user_in['data_group_id'] = 0;
				$user_in['admin_img']     = $_GPC['teacher_img'];
				$user_in['admin_name']    = $_GPC['teacher_realname'];
				$user_id 				  = $class_admin->addJiaAdmin($user_in);
				$in['admin_id'] 		  = $user_id;
				$in['have_up'] 		 	  = 1;
				$in['rfid'] 		      = $_GPC['rfid'];
				if($_GPC['teacher_tags']){
    				$in['teacher_tags']   = implode(',',$_GPC['teacher_tags']);
				}
				$teacher_id 			  = D('teacher')->add($in);
				$class_admin->updateJiaAdmin($user_id,'teacher_id',$teacher_id);
				header("Location:".$this->createWebUrl('teacher',array('aw'=>1,'ac'=>'new','text'=>$_GPC['teacher_realname'].'新增成功')));
			}
		}

		if($ac=='edit'){
			$id 				  = (int)$_GPC['id'];
			$school_uniacid_table = " and tea.uniacid={$_W['uniacid']} and tea.school_id={$school_id} ";
			$result 			  = pdo_fetch("select tea.* ,admin.* from {$table_pe}lianhu_teacher tea left join ".tablename('lianhu_db_admin')." admin on  admin.admin_id=tea.admin_id where tea.teacher_id={$id} {$school_uniacid_table} ");
			$result['class_s'] 	  = explode(',',$result['teacher_other_power']);
            $result['course_ids'] = explode(',',$result['course_id']);
			$result['teacher_tags']= explode(',',$result['teacher_tags']);
			if(!$result){
				$this->myMessage('非法访问','','错误');
			}
			if($_GPC['submit']){
				$class_s      = $_GPC['class_s'];
				$up['status'] = $_GPC['status'];
				if($_GPC['password']){ 
						$class_admin->updateJiaAdmin($result['admin_id'],'password',$_GPC['password']);
				}
				$class_admin->updateJiaAdmin($result['admin_id'],'admin_name',$_GPC['teacher_realname']);
				$class_admin->updateJiaAdmin($result['admin_id'],'admin_img',$_GPC['teacher_img']);
				$class_admin->updateJiaAdmin($result['admin_id'],'admin_status',$_GPC['status']);
				$up['teacher_other_power'] = implode(',', $class_s);
				$up['teacher_realname']    = $_GPC['teacher_realname'];
				$up['teacher_telphone']    = $_GPC['teacher_telphone'];
				$up['teacher_email'] 	   = $_GPC['teacher_email'];
				$up['teacher_img'] 		   = $_GPC['teacher_img'];
				$up['sms_send'] 			= $_GPC['sms_send'];
				$up['teacher_introduce']   = $_GPC['teacher_introduce'];		
				$up['rfid'] 		       = $_GPC['rfid'];
                if($_GPC['course_id']){
    				$up['course_id']=implode(',',$_GPC['course_id']);
				}
				if($_GPC['teacher_tags']){
    				$up['teacher_tags']=implode(',',$_GPC['teacher_tags']);
				}
				$up['weixin_code'] 		   = $_GPC['weixin_code'];		
				D('teacher')->edit(array('teacher_id'=>$id),$up);
				$this->myMessage('修改成功',$this->createWebUrl('teacher',array('aw'=>1)),'成功');
			}
		}
		if($ac=='unbundling'){
			$id 		= (int)$_GPC['id'];
			$up['uid'] 	= 0;
			D('teacher')->edit(array('teacher_id'=>$_GPC['id']),$up);
			$this->myMessage('解绑成功',$this->createWebUrl('teacher',array('aw'=>1) ),'成功');
		}
		if($ac=='delete'){
			$teacher_info = D("teacher")->edit(array("teacher_id"=>$_GPC['id']));
			
			$class_mteacher = M('teacher');
			if($class_mteacher){
				$class_mteacher->deleteStatus($_GPC['id']);
				M("teacherCourse")->deleteTeacher($_GPC['id']);
				M("teacherClass")->deleteTeacher($_GPC['id']);
			}
			pdo_delete('lianhu_teacher',array('teacher_id'=>$_GPC['id']));
			$this->myMessage('删除成功',$this->createWebUrl('teacher',array('aw'=>1)),'成功');
		}
		if($ac=='up_to_new'){
			$str  = "select tea.*,admin.username,admin.password,admin.salt from {$table_pe}lianhu_teacher tea left join ".tablename('users')." admin on  admin.uid=tea.fanid where  have_up=0 ";
			$list = pdo_fetchall($str);
			$in['db_group_id']   = 0;
			$in['data_group_id'] = 0;
			foreach ($list as $key => $value) {
				$in['teacher_id']    = $value['teacher_id'];
				$in['admin_img']     = $value['teacher_img'];
				$in['admin_name']    = $value['teacher_realname'];
				$in['admin_status']  = $value['status'];
				$in['passport']      = $value['username'];
				$in['password']      = $value['password'];
				$in['salt']    		 = $value['salt'];
				$admin_id 			 = $class_admin->addJiaAdmin($in);
				pdo_update('lianhu_teacher',array('admin_id'=>$admin_id,'have_up'=>1),array('teacher_id'=>$value['teacher_id']) );
			}
			$this->myMessage('教师账户升级成功',$this->createWebUrl('teacher'),'成功');
		}
		$pager  = pagination($total,$page,$pagesize);
		include $this->template('../admin/web_teacher');
		exit();


		