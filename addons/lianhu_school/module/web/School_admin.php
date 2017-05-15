<?php 
	$this->checkAdminWeb();
	$admin_result = D('admin')->judeAdminType();
	$left_top     = 'school_base_set';
	$left_nav     = 'school_admin';
	$title        = '学校管理人员';  
	$sidebar_list = array(
		array('fun_str'=>'adminindex','fun_name'=>'系统首页'),
		array('fun_str'=>'school_admin','fun_name'=>'学校管理人员'),
	);
	$top_action = array(
		array('action_name'=>'管理员列表','action'=>'school_admin' ),
		array('action_name'=>'添加管理员','action'=>'school_admin','arr'=>array('ac'=>'new') ),
	);
	$page_name    = '管理员列表';
	if($ac=='new'){
		$page_name    = '添加管理员';
	}		
	$we7_js = 'no';
    load()->model('user');
	$class_system    = D('system');
	$class_admin     = D('admin');
	$power           = implode("|",$class_system->school_admin_per);
	$school_id 		 = getSchoolId();
	if($ac=='list'){
		$have_up  = pdo_fetch("select * from ".tablename('lianhu_school_admin')." where have_up=0 ");
		$list 	  = $class_admin->getSchoolAdminList($school_id);
	}
    if($ac=='new'){
        if($_GPC['submit']){
            $passport=$_GPC['passport'];
            $password=$_GPC['password'];
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
			$user_in['admin_img']     = getImgToUrl($_GPC['admin_img'],$this);
			$user_in['admin_name']    = $_GPC['admin_name'];
			$user_id 				  = $class_admin->addJiaAdmin($user_in); 
			$in['db_admin_id'] 		  = $user_id;
            $in['uniacid']            = $_W['uniacid'];            
            $in['school_id']          = $school_id;            
            $in['uid']                = $user_id;
            $in['status']             = 1;
			$in['have_up'] 			  = 1;
            pdo_insert('lianhu_school_admin',$in);
			$school_admin_id = pdo_insertid();
			$class_admin->updateJiaAdmin($user_id,'school_admin_id',$school_admin_id);
            $this->myMessage('新增成功',$this->createWebUrl('school_admin',array('aw'=>$aw) ),'成功');
        }
    }
        if($ac=='edit'){
            $result = pdo_fetch("select admin.*,db_admin.* from {$table_pe}lianhu_school_admin admin
            left join ".tablename('lianhu_db_admin')." db_admin on db_admin.school_admin_id=admin.admin_id
            where admin.admin_id=:admin_id",array(':admin_id'=>$_GPC['admin_id']));
			if(!$result){
                $this->myMessage('非法访问','','错误');
			}
  			if($_GPC['submit']){
				$up['status'] = $_GPC['status'];
				if($_GPC['password']){ 
						$class_admin->updateJiaAdmin($result['admin_id'],'password',$_GPC['password']);
				}
				$class_admin->updateJiaAdmin($result['admin_id'],'admin_name',$_GPC['admin_name']);
				$class_admin->updateJiaAdmin($result['admin_id'],'admin_img',getImgToUrl($_GPC['admin_img'],$this) );
				$class_admin->updateJiaAdmin($result['admin_id'],'admin_status',$_GPC['status']);
				$up['status']  = $_GPC['status'];
				pdo_update('lianhu_school_admin',$up,array('admin_id'=>$_GPC['admin_id']));
				$this->myMessage('修改成功',$this->createWebUrl('school_admin' ),'成功');
			}
		}    
		//解绑
		if($ac=='unbundling'){
				$up['mobile_uid'] = 0;
				pdo_update('lianhu_school_admin',$up,array('admin_id'=>$_GPC['admin_id']));
				$this->myMessage('解绑成功',$this->createWebUrl('school_admin' ),'成功');
		}
		if($ac=='up_to_new'){
			$str  = "select school_admin.*,admin.username,admin.password,admin.salt from {$table_pe}lianhu_school_admin school_admin left join ".tablename('users')." admin on  admin.uid=school_admin.uid where  have_up=0 ";
			$list = pdo_fetchall($str);
			$in['db_group_id']   = 0;
			$in['data_group_id'] = 0;
			foreach ($list as $key => $value) {
				$in['school_admin_id']= $value['admin_id'];
				$in['admin_status']  = $value['status'];
				$in['passport']      = $value['username'];
				$in['password']      = $value['password'];
				$in['salt']    		 = $value['salt'];
				$admin_id 			 = $class_admin->addJiaAdmin($in);
				pdo_update('lianhu_school_admin',array('db_admin_id'=>$admin_id,'have_up'=>1),array('admin_id'=>$value['admin_id']) );
			}
			$this->myMessage('学校管理人员升级成功',$this->createWebUrl('school_admin'),'成功');
		} 
		include $this->template('../admin/web_school_admin');
		exit();
        