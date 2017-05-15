<?php 
    $this->checkAdminWeb();
    $admin_result = D('admin')->judeAdminType();
    $left_top     = 'school_msg';
    $left_nav     = 'booking';
    $title        = '校外活动报名';  
    $sidebar_list = array(
            array('fun_str'=>'','fun_name'=>'校务管理'),
            array('fun_str'=>'booking','fun_name'=>'校外报名'),
    );
    $top_action = array(
            array('action_name'=>'活动列表','action'=>'booking'),
            array('action_name'=>'新增活动','action'=>'booking','arr'=>array('ac'=>'new') ),
    );
	$page_name    = '活动列表';
	if($ac=='new'){
		$page_name    = '新增活动';
	}

    $class_booking      = D('booking');
    $cclass_bookinglist = C('bookingList');
    if($ac=='list'){
        $we7_js = 'no';
        $list   = $class_booking->dataList(false);
        $list   = $list['list'];
        foreach ($list as $key => $value) {
               $cclass_bookinglist->booking_id = $value['booking_id'];
               $result = $cclass_bookinglist->getBooKingPeopleList();
               $list[$key]['up_num'] = $result['count'];
        }
    }
    if($ac=='new'){
        if($_GPC['submit']){
            $_GPC['begin_time'] = strtotime($_GPC['begin_time']);
            $_GPC['end_time']   = strtotime($_GPC['end_time']);
            $in = getNewUpdateData($_GPC,$class_booking);
            $class_booking->dataAdd($in);
            $this->myMessage("添加成功",$this->createWebUrl("booking"),'成功');
        }                
    }
    if($ac=='edit'){
        $id = $_GPC['id'];
        if($_GPC['submit'] && $id ){
            $_GPC['begin_time'] = strtotime($_GPC['begin_time']);
            $_GPC['end_time']   = strtotime($_GPC['end_time']);
            $in                 = getNewUpdateData($_GPC,$class_booking);
            $class_booking->dataEdit($id,$in);  
            $this->myMessage("编辑成功",$this->createWebUrl("booking"),'成功');
        }
        $result = $class_booking->dataEdit($id);
        $result['begin_time'] = date("Y-m-d H:i",$result['begin_time']);
        $result['end_time']   = date("Y-m-d H:i",$result['end_time']);
    }
    if($ac=='delete'){
        $id = $_GPC['id'];
        $where["booking_id"] = $id;
        $class_booking->statusDelete($where);
        $this->myMessage("删除成功",$this->createWebUrl("booking"),'成功');
    }
    include $this->template('../admin/booking');
    exit();