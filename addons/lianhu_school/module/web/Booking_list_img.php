<?php 
    $this->checkAdminWeb();
    $admin_result = D('admin')->judeAdminType();
    $left_top     = 'school_msg';
    $left_nav     = 'booking';
    $title        = '详情';  
    $sidebar_list = array(
            array('fun_str'=>'','fun_name'=>'校务管理'),
            array('fun_str'=>'booking','fun_name'=>'校外报名'),
    );
    $top_action = array(
            array('action_name'=>'活动列表','action'=>'booking' ),
            array('action_name'=>'详情','action'=>'' ),
    );
    $id     = $_GPC['id'];
    $result = D("bookingList")->dataEdit($id);
    if($_GPC['submit']){
        $up['re_time']      = time();
        $up['re_content']   = $_GPC['content'];
        $up["pass_status"]  = $_GPC['pass_status'];
        D("bookingList")->dataEdit($id,$up);
        $title   = "您的报名申请校方审核了！";
        $key2    = $admin_result['info']['admin_name'] ? $admin_result['info']['admin_name'] :"管理员";
        $key4    = $_GPC['pass_status']==1 ? "审核通过":"未通过";
        $remark  = $_GPC['content'];
        $mu_info = $this->decodeMsg($title,$key2,$key4,$remark); 
        $openid  = $this->class_base->uid2openid($result['uid']);
        $record_url = $_W['siteroot'].'app/'.$this->createMobileUrl("booking",array("school_id"=>getSchoolId()) );
        $que_num    = D('msg')->insertMsgQueueMu($openid,$mu_info['data'],$mu_info['mu_id'],$record_url,$que_num);
        $this->myMessage("回复成功",$this->createWebUrl('booking_list',array("id"=>$result['booking_id'])),'成功');
    }   
    include $this->template('../admin/Booking_list_img');
    exit();
    