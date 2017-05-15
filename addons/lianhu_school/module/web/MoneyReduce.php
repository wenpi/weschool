<?php
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
		array('action_name'=>'学生减免' ,'action'=>'moneyReduce','arr'=>array('ac'=>'new') ),
	);
	$page_name    = '学生减免';
 	$where["limit_id"] = $_GPC['limit_id'];
    $where["school_id"]= $this->school_info['school_id'];
    $result = D("moneyLimit")->edit($where);
    D('moneySpec')->limit_id = $result['limit_id'];
    if($result){
        $list =  D('moneySpec')->getAllList();
        foreach ($list as $key => $value) {
            $list[$key]['info'] = D('student')->getStudentInfo($value['student_id']);
        }
    }else{
        $this->myMessage("没有找到有效的收费",$this->createWebUrl("money"),'错误');
    }
    if($ac=='add'){
        if($_GPC['submit']){
            $student_ids = $_GPC['student_id'];
            $reduce_money= $_GPC['reduce_money'];
            $in['reduce_money'] = $reduce_money;
            foreach ($student_ids as $key => $value) {
                $in['student_id']  = $value;
                $in['db_admin_id'] = getDbAdminId();
                $in['limit_id']    = $_GPC['limit_id'];
                D("moneySpec")->add($in);
            }
            $this->myMessage("设置成功",$this->createWebUrl("moneyReduce",array("limit_id"=>$_GPC['limit_id'])),'成功');
        }
        $student_list = D('student')->getStudentlist();
        $do_list      = D('moneySpec')->getAllList();
        $do_student_ids = S("fun","zuHeArr",array($do_list,'student_id'));
    }
    if($ac=='delete'){
        D("moneySpec")->deleteStatus($_GPC['id']);
        $this->myMessage("删除成功",$this->createWebUrl("moneyReduce",array("limit_id"=>$_GPC['limit_id'])),'成功');
    }
    include $this->template('../admin/MoneyReduce');
	exit();   