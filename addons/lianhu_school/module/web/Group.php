<?php
ini_set("display_errors",1);
error_reporting(E_ALL^E_NOTICE);
    $class_admin        = D('admin');
    $class_power        = D('power');
    $admin_result       = $class_admin->judeAdminType();
    $type_list          =   $class_power->group_type;

    //新的后台只允许 1.站长；2.校长；3.教师；4.家校通登记在录人员
    $this->checkAdminWeb();
    $admin_result = D('admin')->judeAdminType();
    $left_top     = 'system_set';
    $left_nav     = 'user_group';
    $title        = '功能组';  
    $sidebar_list = array(
        array('fun_str'=>'','fun_name'=>'系统首页'),
        array('fun_str'=>'group','fun_name'=>'功能组'),
    );
    $top_action = array(
        array('action_name'=>'列表','action'=>'group' ),
        array('action_name'=>'添加功能组','action'=>'group','arr'=>array('ac'=>'new','db'=>1) ),
        array('action_name'=>'添加数据组','action'=>'group','arr'=>array('ac'=>'new','data'=>1) ),
    );
    $page_name    = '列表';
    if($_GPC['db']==1){
        $page_name    = '添加功能组';
    } 
    if($_GPC['data']==1){
        $page_name    = '添加数据组';
    }  

     if($ac=='list'){
        $db_list   = $class_admin->getDbGroup(true);
        $data_list = $class_admin->getDataGroup(true);
    }
    if($ac=='new'){
        if($_GPC['submit']){
            $in['type']     = $_GPC['type'];
            $in['add_time'] = time();
            $in['group_name'] = $_GPC['group_name'];
            if($_GPC['db']){
                pdo_insert('lianhu_db_group',$in);
            }elseif($_GPC['data']){
                if($in['type']=='mp'){
                    $in['data']         = implode(',',$_GPC['platform_list']);
                }elseif($in['type']=='school'){
                    $in['data']         = $_GPC['school_mp'];
                    $in['school_data']  = implode(',',$_GPC['school_list']); 
                }elseif($in['type']=='grade'){
                    $in['data']         = $_GPC['grade_mp'];
                    $in['school_data']  =  $_GPC['grade_school'];
                    $in['grade_data']   = implode(',',$_GPC['grade_list']); 
                }
                pdo_insert('lianhu_data_group',$in);
            }
            $this->myMessage('新增用户组成功',$this->createWebUrl('group'),'成功');
        }
    }
    if($ac=='edit'){
         if($_GPC['db']){
             $result            = pdo_fetch("select * from ".tablename('lianhu_db_group')." where group_id=:gid ",array(":gid"=>$_GPC['gid']));
             $power_list        = $class_power->getDbGroup($_GPC['gid']);
             $fun_key_word_list = S('fun','zuHeArr',array($power_list,'low_list') );
             if($_GPC['submit']){
                $in['type']         = $_GPC['type'];
                $in['group_name']   = $_GPC['group_name'];
                $in['status']       = $_GPC['status']; 
                pdo_update('lianhu_db_group',$in,array('group_id'=>$_GPC['gid'] ) );
                $power_list         = $_GPC['fun_list'];
                $class_power->updateDbGroup($_GPC['gid'],$power_list);
                $this->myMessage('编辑用户组成功',$this->createWebUrl('group'),'成功');
             }
        }else{
             $re                  = $class_admin->getDataInfo($_GPC['gid']);
             $result              = $re['result'];
             $group_platform_list = $re['platform_list'];

             if($result['type']!='mp'){
                 $school_list     = D('school')->getSchoolByUniacid($result['data']);
             }
             if($result['type']=='grade'){
                 $class_grade            = D('grade');
                 $class_grade->school_id = $result['school_data'];
                 $grade_list             = $class_grade->getSchoolList();
                 $re_grade_list          = explode(',',$re['result']['grade_data']);
             }
             if($_GPC['submit']){
                $in['type']         = $_GPC['type'];
                $in['group_name']   = $_GPC['group_name'];
                $in['status']       = $_GPC['status'];
                if($in['type']=='mp'){
                    $in['data']         = implode(',',$_GPC['platform_list']);
                    $in['school_data']  ='';
                    $in['grade_data']  ='';
                }elseif($in['type']=='school'){
                    $in['data']         = $_GPC['school_mp'];
                    $in['school_data']  = implode(',',$_GPC['school_list']); 
                }elseif($in['type']=='grade'){
                      $in['data']        = $_GPC['grade_mp'];
                      $in['school_data'] =  $_GPC['grade_school'];
                      $in['grade_data']  = implode(',',$_GPC['grade_list']); 
                }
                pdo_update('lianhu_data_group',$in,array('group_id'=>$_GPC['gid'] ) );                 
                $this->myMessage('编辑用户组成功',$this->createWebUrl('group'),'成功');
             }
         }
    }
	$pager=pagination($total,$page,$pagesize);
	include $this->template('../admin/web_group');
	exit();