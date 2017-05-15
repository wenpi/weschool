<?php 
	//新的后台只允许 1.站长；2.校长；3.教师；4.家校通登记在录人员
	$this->checkAdminWeb();
	$admin_result = D('admin')->judeAdminType();
    $left_top     = 'system_set';
	$left_nav     = 'systemParams';
	$title        = '系统设置';  
	$sidebar_list = array(
			array('fun_str'=>'','fun_name'=>'系统设置'),
			array('fun_str'=>'systemParams','fun_name'=>'系统设置'),
	);
    if($_GPC['submit']){
        $params['uniacid'] = $_W['uniacid'];
        if($_GPC['name']){
            $params['keyword']  = 'name';
            $data['content'] = $_GPC['name'];
            S("base",'saveKeywordContent',array($params,$data));
        }
        if($_GPC['copyright']){
            $params['keyword']  = 'copyright';
            $data['content'] = $_GPC['copyright'];
            S("base",'saveKeywordContent',array($params,$data));
        }
        if($_GPC['logo']){
            $params['keyword']  = 'logo';
            $data['content'] = $_GPC['logo'];
            S("base",'saveKeywordContent',array($params,$data));
        }
        if($_GPC['yeas']){
            $params['keyword']  = 'yeas';
            $data['content'] = $_GPC['yeas'];
            S("base",'saveKeywordContent',array($params,$data));
        }
    }
	include $this->template('../admin/web_systemParams');
	exit();