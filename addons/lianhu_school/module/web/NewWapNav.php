<?php 
    $this->checkAdminWeb();
    $admin_result = D('admin')->judeAdminType();
    $left_top     = 'wap_admin';
    $left_nav     = 'newWapNav';
    $title        = '菜单管理';  
    $sidebar_list = array(
        array('fun_str'=>'','fun_name'=>'官网管理'),
        array('fun_str'=>'newWapNav','fun_name'=>'菜单管理'),
    );
    $top_action = array(
        array('action_name'=>'菜单管理','action'=>'newWapNav' ),
    );	
    $page_name    = '菜单管理';
    
    include $this->template('../admin/NewWapNav');
    exit();


