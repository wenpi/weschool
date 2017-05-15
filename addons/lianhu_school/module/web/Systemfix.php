<?php 
	$this->checkAdminWeb();
	$admin_result   = D('admin')->judeAdminType();
    $title          = '系统维护';  
    if($op=='update_school_grade_class_student'){
        $left_top     = 'school_base_set';
	    $left_nav     = 'update_school_grade_class_student';
        $sidebar_list = array(
                array('fun_str'=>'','fun_name'=>'系统设置'),
                array('fun_str'=>'','fun_name'=>'系统维护'),
        );
    }else{
        $left_top     = 'system_set';
	    $left_nav     = 'system_update';
        $sidebar_list = array(
                array('fun_str'=>'','fun_name'=>'系统设置'),
                array('fun_str'=>'systemfix','fun_name'=>'系统维护'),
        );
	    $top_action = array(
			    array('action_name'=>'系统维护','action'=>'systemfix' ),
				array('action_name'=>'系统参数设置','action'=>'systemfix','arr'=>array('ac'=>'system_params_set' ) ),
				array('action_name'=>'学校类型设置','action'=>'systemfix','arr'=>array('ac'=>'school_type_set' ) ),
				array('action_name'=>'调用支付设置','action'=>'setPay' ),
        );
        $page_name    = '系统维护';
        if($ac=='system_params_set'){
            $page_name    = '系统参数设置';
        } 
        if($ac=='school_type_set'){
            $page_name    = '学校类型设置';
        }  
    }
    $count = pdo_fetchcolumn("select count(*) num from ".tablename('lianhu_file')."  ");
    // 家云账号
    if($op == 'list' && $ac=='system_params_set'){
        $config = $this->module['config'];
        $jiayun_passport = S('system','getJiaYunPassport',false);
        $jiayun_password = S('system','getJiaYunPassword',false);
        if( $config['jia_passport'] && !$jiayun_passport)
            $jiayun_passport = $config['jia_passport'];
        if( $config['jia_password'] && !$jiayun_password)
            $jiayun_password = $config['jia_password'];
        if($_GPC['submit']){
            if($_GPC['jia_passport']){
                S('system','updateJiaYunPassport',array($_GPC['jia_passport']));
            }
            if($_GPC['jia_password']){
                S('system','updateJiaYunPassword',array($_GPC['jia_password']));
            }
           $this->myMessage("更新成功",$this->createWebUrl('systemfix',array('aw'=>$aw) ),'成功');
        }
    }
    //学校类型
    if($op=='list' && $ac == 'school_type_set'){
        $class_school = D("school");
        $method       = $_GPC['method'] ? $_GPC['method'] : 'list';
        $type_list    = S("school","schoolType",array());
        if($method=='list'){
            if($_GPC['school_type_id'])
                $class_school->school_type_id = $_GPC['school_type_id'];
            $list   =  $class_school->getSchoolTypeGradeList(); 
        }
        if($_GPC['method'] =='new' && $_GPC['submit'] ){
            $grade_sort    = $_GPC['grade_sort'];
            $grade_name    = $_GPC['grade_name'];
            $school_type   = $_GPC['school_type_id'];
            S("fun","checkValueTrue()",array($grade_sort,'年级排序'));
            S("fun","checkValueTrue()",array($grade_name,'年级名字'));
            S("fun","checkValueTrue()",array($school_type,'学校类型'));
            $class_school -> school_type_id = $school_type;
            $have                           = $class_school -> vaildThisSortHave($grade_sort);
            if($have)
                $this->myMessage("该学校类型已经存在该排序的年级",' ','error');
            $class_school ->addSchoolType(array('grade_sort'=>$grade_sort,'grade_name'=>$grade_name));
            $this->myMessage("新增成功",$this->createWebUrl("systemfix",array("ac"=>'school_type_set','aw'=>$aw)),'成功');
        }
        if($_GPC['method']=='edit'){
            $result = $class_school->getSchoolTypeInfo($_GPC['id']);
            if($_GPC['submit']){
                $grade_sort    = $_GPC['grade_sort'];
                $grade_name    = $_GPC['grade_name'];
                $school_type   = $_GPC['school_type_id'];  
                S("fun","checkValueTrue()",array($grade_sort,'年级排序'));
                S("fun","checkValueTrue()",array($grade_name,'年级名字'));
                S("fun","checkValueTrue()",array($school_type,'学校类型'));                    
                $class_school -> school_type_id = $school_type;
                if($grade_sort != $result['grade_sort']){
                     $have = $class_school -> vaildThisSortHave($grade_sort);
                     if($have)
                        $this->myMessage("该学校类型已经存在该排序的年级",'referer','error');
                }
                $class_school -> updateSchoolType(array('grade_sort'=>$grade_sort,'grade_name'=>$grade_name),$result['type_id']);
                $this->myMessage("修改成功",$this->createWebUrl("systemfix",array("ac"=>'school_type_set','aw'=>$aw)),'成功');
            }
        }
    }
    if($op=='fix_table'){
        $this->updateDatabase();
    }
    if($op=='fix_file'){
        $_SESSION['time_str'] = '';
        pdo_run("delete  from ".tablename('lianhu_file_cache')." where 1=1 ");
        $count = pdo_fetchcolumn("select count(*) num from ".tablename('lianhu_file')."  ");
        if($count>3000){
             pdo_run("delete  from ".tablename('lianhu_file')." where 1=1 ");
        }
    }
    if($op=='init_file'){
        $this->initFile();
    }
    if($op=='update_school_grade_class_student'){
        $class_re     = C('classes')->getSchoolClass();
        $class_list   = $class_re['list'];
        $class_list[] = C('teacherRfid')->tea_class;
        $room_re      = Au('src/codeShop')->getCode('room');
        if($room_re){
            $build_re        = Au('room/building')->getList($where);
            $building_list   = $build_re['list'];
        }
    }
    if($op=='up_school_admin'){
        $all_school_admin = $this->class_base->getAllSchoolAdminList();
        $class_system     = D('system');
        $school_group_per = $class_system->school_admin_per;
        foreach ($all_school_admin as $key => $value) {
            $peimission = $this->class_base->getUidPermission($value['uid']);
            $peimission_arr = explode("|",$peimission); 
            foreach ($school_group_per as $k => $v) {
                if(!in_array($v,$peimission_arr))
                    $peimission_arr[]=$v;
            }
            $perimission = implode("|",$peimission_arr);
            pdo_update("users_permission",array("permission"=>$perimission),array("uid"=>$value['uid']));
        }
        $this->myMessage("更新成功",$this->createWebUrl("systemfix",array('aw'=>$aw)),'成功');
    }
    if($op=='up_teacher'){
        $all_teacher      = $this->class_base->getAllTeacherList();
        $class_system     = D('system');
        $teacher_per      = $class_system->teacher_admin_per;
        foreach ($teacher_per as $key => $value) {
            $peimission = $this->class_base->getUidPermission($value['uid']);
            $peimission_arr = explode("|",$peimission); 
            foreach ($teacher_per as $k => $v) {
                if(!in_array($v,$peimission_arr))
                    $peimission_arr[]=$v;
            }
            $perimission = implode("|",$peimission_arr);
            pdo_update("users_permission",array("permission"=>$perimission),array("uid"=>$value['uid']));
        }
        $this->myMessage("更新成功",$this->createWebUrl("systemfix",array('aw'=>$aw)),'成功');  
    }
    //升年级
    if($op=='up_grade'){
        $school_list  = $this->class_base->getSchoolList(true);
        $class_school = D("school");
        foreach ($school_list as $key => $value) {
            $up_school_name = $class_school->upgradeSchoolGrade($value['school_id']);
            if($up_school_name)
                $up_school_names[] = $up_school_name; 
        }
        $this->myMessage("升级的学校有：".implode(',',$up_school_names),'','成功');
    }
    if($op=='list' && $ac=='list'){
        // //检测云端是否有数据库需要更新
        $base_url           = 'check/databaseUp';
        $ver_list           = $this->getAllVersion();
        $params["last_ver"] = $ver_list[0]['version']; 
        $params["uniacid"]  = $_W['uniacid']; 
        $arr         	    = $this->askCenter($base_url,$params);
        if($arr['errcode']==0){
            if($arr['arr']){
                $database_new_version = $arr['arr']['newer_version'];
                $database_much_num    = $arr['arr']['database_much_num'];
                $last_up_info         = $arr['arr']['info'];
            }
        }	
        //检测云端是否有文件需要更新
        $base_url               = 'check/fileUp';
        $params['last_up_time'] = pdo_fetchcolumn("select last_up_time from ".tablename("lianhu_file")." where 1=1 order by last_up_time desc limit 1"); 
        $arr         	        = $this->askCenter($base_url,$params);
        if($arr['errcode']==0){
            if($arr['arr']['need']==1){
                $file_up_need = 1;
            }
        }	
    }
    include $this->template('../admin/web_systemfix');
    exit();
  
