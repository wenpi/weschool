<?php 
		$aw = 1;
		$this->checkAdminWeb();
		$admin_result = D('admin')->judeAdminType();
		$left_top     = 'system_set';
		$left_nav     = 'money';
		$title        = '系统设置';  
		$sidebar_list = array(
			array('fun_str'=>'','fun_name'=>'系统设置'),
			array('fun_str'=>'','fun_name'=>'消息队列处理'),
		);
        if($_GPC['que_num']){
            $list           = pdo_fetchall("select * from {$table_pe}lianhu_msg_queue
                                        where queue_num=:num 
                                        order by queue_status desc ,end_time desc ",
                                        array(":num"=>$_GPC['que_num']) );
                                        
            $not_send_list = pdo_fetchall("select * from {$table_pe}lianhu_msg_queue
                                        where queue_num=:num and queue_status=1  
                                        order by queue_status desc ,end_time desc ",
                                        array(":num"=>$_GPC['que_num']) );      
            $count = count($not_send_list);
        }
		include $this->template('../admin/web_sendtomsg');
		exit();