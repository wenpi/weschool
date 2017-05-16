<?php 
	$this->checkAdminWeb();
	$admin_result = D('admin')->judeAdminType();
	$left_top     = 'system_set';
	$left_nav     = 'funcgroup_admin';
	$title        = '微信用户组';  
	$sidebar_list = array(
        array('fun_str'=>'','fun_name'=>'系统设置'),
        array('fun_str'=>'device','fun_name'=>'微信用户组'),
	);
	$top_action = array(
        // array('action_name'=>'添加','action'=>'device','arr'=>array('aw'=>1,'ac'=>'new') ),
    );	
    Au("group/wechat")->access_token = $this->AccessToken();

    if($ac=='list'){
        $page_name   = '现有';
        $group_list  = Au("group/wechat")->ALlList();
        $list        = $group_list['groups'];
        $sschool_list = D("school")->getUniacidSchoolList();
        foreach ($sschool_list as $key => $value) {
            $have_in     = Au('group/group')->find($value['school_name']);
            if($have_in){
                continue;
            }
            $re          = Au("group/wechat")->create($value['school_name']);
            if($re['group']){
                Au('group/group')->dataAdd($re['group']['name'],$re['group']['id']);
            }else{
                var_dump($re);
            }
        }
        
    }
    include $this->template('../admin/group_admin');
    exit();
