<?php 
    //新的后台只允许 1.站长；2.校长；3.教师；4.家校通登记在录人员
    $this->checkAdminWeb(false);
    $class_admin  = D('admin');
    $class_power  = D('power');
    $admin_result = $class_admin->judeAdminType();
    $left_top     = 'system_set';
    $left_nav     = 'change_weixin';
    $sidebar_list = array(
        array('fun_str'=>'','fun_name'=>'系统设置'),
        array('fun_str'=>'adminloginCheck','fun_name'=>'切换公众号'),
    );
    if($_GPC['_data_group_id']){
        $admin_group_result  =  $class_power->getDataInfo($_GPC['_data_group_id']);

    }
    if(!$admin_result){
        $this->myMessage("不在可登录的用户范围之内",$this->createMobileUrl("adminlogin"),'错误');
    }else{
        //站长切换
        if($_GPC['ac']=='change'  ){
            setWebLogin($_GPC['in_uniacid'],$_W['uid']);  
            $_SESSION['could_in'] = 1;
            if(count($admin_group_result['school'])==1){
                setSchoolId($admin_group_result['school'][0]);
            }elseif($_COOKIE[$_GPC['in_uniacid'].'_school_id']){
                setSchoolId($_COOKIE[$_GPC['in_uniacid'].'_school_id']);
            }else{
                $list = S('school','getSchoolByUniacid',array($_GPC['in_uniacid']) );
                setcookie($_GPC['in_uniacid'].'_school_id',$list[0]['school_id'],7*3600*24,'/');
                setSchoolId($list[0]['school_id']);
            }
            $school_info              = D('school')->getSchoolInfo();
            $_SESSION['uniacid']      = $_GPC['in_uniacid'];
            $_SESSION['school_name']  = $school_info['school_name'];
            if(pdo_tableexists('lianhu_login_log')){
                D('loginlog')->addPcLogin();
            }
            header("Location:".$this->createWebUrl("adminindex") );    
            exit();
        }
        //非站长人员
        //系统原有的教师账户，学校管理人员账户
        if($admin_result['admin']!='top'){
            setWebLogin($admin_result['uniacid'],$_W['uid']);    
            setSchoolId($admin_result['school_id']);
            $_SESSION['uniacid']      = $admin_result['uniacid'];
            $_SESSION['could_in']     = 1;
            $school_info              = D('school')->getSchoolInfo();
            $_SESSION['school_name']  = $school_info['school_name'];
            if(pdo_tableexists('lianhu_login_log')){
                D('loginlog')->addPcLogin();
            }
            header("Location:".$this->createWebUrl("adminindex") );    
        }else{
            //系统账户
            //登录
            $title               = "选择需要管理公众号！";
            $list                = D('platform')->getAllPlatform();
            if($_GPC['_data_group_id']){
                if(count($admin_group_result['platform'])==1){
                    header("Location:".$this->createWebUrl('adminloginCheck',array('ac'=>'change','in_uniacid'=>$admin_group_result['platform'][0] ) ));
                }
                foreach ($list as $key => $value) {
                    if(!in_array($value['uniacid'],$admin_group_result['platform']) ){
                        unset($list[$key]);
                    }
                }
            }
        }
    }
    $template = '../admin/weixinList'; //从tempalte/
	include $this->template($template);	
    exit();