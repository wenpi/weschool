<?php 
    $this->checkAdminWeb();
    $admin_result = D('admin')->judeAdminType();
    $left_top     = 'system_set';
    $left_nav     = 'ourShop';
    $title  = $page_title      = '插件商城';  
    $sidebar_list = array(
        array('fun_str'=>'','fun_name'=>'系统设置'),
        array('fun_str'=>'ourShop','fun_name'=>'插件商城'),
    );
    $top_action = array(
    );
    $class_module = C('module');
    if($ac=='list'){
        $base_url           = $class_module->ask_yun;
        $params['key_word'] = 'module_list';
        $arr         	    = $this->askCenter($base_url,$params);
        $list               = $arr['arr']['module_list'];
        $arr                = $this->askCenter($class_module->my_module,$params);
        $my_module_list     = $arr['arr']['module_list'];

        if($my_module_list){
            foreach ($my_module_list as $key => $value) {
                $my_ids[] = $value['shop_id'];
            }
        }
        C("codeShop")->begin($list,$my_ids);
    }
	include $this->template('../admin/OurShop');
	exit();   
