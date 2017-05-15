<?php 
		$this->checkAdminWeb();
		$admin_result = D('admin')->judeAdminType();
		$left_top     = 'system_set';
		$left_nav     = 'user';
		$title        = '用户管理';  
		$sidebar_list = array(
				array('fun_str'=>'adminindex','fun_name'=>'系统设置'),
				array('fun_str'=>'adv_admin','fun_name'=>'用户管理'),
		);
        $top_action = array(
            array('action_name'=>'列表','action'=>'user'),
            array('action_name'=>'添加账号','action'=>'user','arr'=>array('ac'=>'new') ),
        );       
        $page_name    = '列表';
        if($ac=='new'){
            $page_name    = '添加账号';
        } 
       
        //实例化class
        $class_admin = D('admin');
        $wq_group_id = $class_admin->wqGroup(3);
        if($ac=='list'){
            $we7_js  = 'no';
            $params  = false;
            if($_GPC['admin_name']){
                $params[":admin_name"] = $_GPC['admin_name'];
            }
            if($_GPC['passport']){
                $params[":passport"] = $_GPC['passport'];
            }
            if($_GPC['admin_status']){
                $params[":admin_status"] = $_GPC['admin_status'];
            }
            $out     = $class_admin->getAdminList($page,$params);
            $total   = $out['count'];
            $list    = $out['list'];
            $pager   = pagination($total,$page,$class_admin->every_page);
        }else{
            $db_group_list   = $class_admin->getDbGroup();
            $data_group_list = $class_admin->getDataGroup();
        }
        if($ac=='new'){
            if($_GPC['submit']){
                $passport       = $_GPC['passport'];
                $password       = $_GPC['password'];
                $admin_name     = $_GPC['admin_name'];
                $admin_img      = $_GPC['admin_img'];
                $db_group_id    = $_GPC['db_id'];
                $data_group_id  = $_GPC['data_id'];
                if(!$passport || !$password || !$admin_name){
                    $this->myMessage("请填写所有资料",$this->createWebUrl('user',array('ac'=>'new')),'错误');
                }
                $have_re = $class_admin->getJiaAdmin($passport);
                if($have_re){
                    $this->myMessage("此系统账号已经在系统中存在",$this->createWebUrl('user',array('ac'=>'new')),'错误');
                }
                //添加微擎账号
                $in['passport'] = $passport;
                $in['password'] = $password;
                //添加系统账号
                $in['db_group_id']   = $db_group_id;
                $in['data_group_id'] = $data_group_id;
                $in['admin_img']  = $admin_img;
                $in['admin_name'] = $admin_name;
                $class_admin->addJiaAdmin($in);
                $this->myMessage("新增成功",$this->createWebUrl('user',array('ac'=>'list')),'成功');
            }
        }
        if($ac=='edit'){
            $admin_id = $_GPC['id'];
            $result   = $class_admin->getAdminInfo($admin_id);
            if($_GPC['submit']){
                if($_GPC['password']){
                    $class_admin->updateJiaAdmin($result['admin_id'],'password',$_GPC['password']);
                }
                    $admin_name          = $_GPC['admin_name'];
                    $admin_img           = $_GPC['admin_img'];
                    $db_group_id         = $_GPC['db_id'];
                    $data_group_id       = $_GPC['data_id'];                   
                    $admin_status        = $_GPC['admin_status'];   
                    $in['db_group_id']   = $db_group_id;
                    $in['data_group_id'] = $data_group_id;
                    $in['admin_img']     = $admin_img;
                    $in['admin_name']    = $admin_name;                
                    $in['admin_status']  = $admin_status;     
                    foreach ($in as $key => $value) {
                        $class_admin->updateJiaAdmin($result['admin_id'],$key,$value);
                    }
                    $this->myMessage("编辑成功",$this->createWebUrl('user',array('ac'=>'list')),'成功');
            }
        }
        if($ac=='delete'){
            $admin_id = $_GPC['id'];
            $result   = $class_admin->getAdminInfo($admin_id);
            $class_admin->deleteAdmin($admin_id);
            if($result['school_admin_id']){
                $class_admin->deleteSchoolAdmin($result['school_admin_id']);
            }
            if($result['teacher_id']){
                $class_admin->deleteTeacherAdmin($result['teacher_id']);
            }
           $this->myMessage("删除成功",$this->createWebUrl('user',array('ac'=>'list')),'成功');
        }
        include $this->template('../admin/web_user');
        exit();
