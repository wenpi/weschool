<?php 
	$abc = $_SERVER['HTTP_ACCEPT'];
    if(!stristr($abc,"text/html")){
        exit();
    }
    $token         = $this->class_base->tokenForm();

    $this->checkAdminWeb();
	$admin_result = D('admin')->judeAdminType();
	$left_top     = 'school_msg';
	$left_nav     = 'money';
	$title        = '收费管理';  
	$sidebar_list = array(
		array('fun_str'=>'','fun_name'=>'学校信息'),
		array('fun_str'=>'money','fun_name'=>'收费管理'),
	);
	$top_action = array(
		array('action_name'=>'收费管理','action'=>'money' ),
		array('action_name'=>'新增收费' ,'action'=>'money','arr'=>array('ac'=>'new') ),
		array('action_name'=>'收费组' ,'action'=>'moneyGroup' ),
	);

    if($_GPC['submit'] &&  $_GPC['token'] == $_COOKIE['form_token'] ){
        $params["group_name"] = $_GPC['group_name'];
        $params["school_id"]  = $this->school_info['school_id'];
        $result = D("moneyGroup")->edit($params); 
        if($result){
            $this->myMessage("该收费组已经存在",$this->createWebUrl("moneyGroup"),'错误');
        }
        D("moneyGroup")->add($params);
        $this->myMessage("添加成功",$this->createWebUrl("moneyGroup"),'成功');
    }

	$page_name                 = '收费组';
    $where[":status"]          = array("!=",-1);
    D("moneyGroup")->each_page = 10000;
    $re                        = D("moneyGroup")->getList($where);
    $list = $re['list'];
    


    include $this->template('../admin/MoneyGroup');
	exit();