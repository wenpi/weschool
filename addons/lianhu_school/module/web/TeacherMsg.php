<?php 
        $this->checkAdminWeb();
        $admin_result = D('admin')->judeAdminType();
        $left_top     = 'school_msg';
        $left_nav     = 'teacher_msg';
        $title        = '通知教师';  
        $sidebar_list = array(
            array('fun_str'=>'','fun_name'=>'学校信息'),
            array('fun_str'=>'teacherMsg','fun_name'=>'通知教师'),
        );
        $top_action = array(
            array('action_name'=>'新增发送','action'=>'teacherMsg' ),
            array('action_name'=>'消息发送记录','action'=>'teacherMsg','arr'=>array('op'=>'msg_record') ),
        );
        $page_name = '新增发送';
        if($op=='msg_record'){
            $page_name = '消息发送记录';
        }    
        $teacher_web            = 1;
        $que_num                = false;
        $class_msg              = D('msg');
        $class_sendRecord       = D('sendRecord');
        $class_teacher          = D('teacher');
        $school_id              = getSchoolId();
        $admin_name             = $this->getWebAdminName();
        if($op  == 'msg_record'){
            $params[':school_id']       = $school_id;
            $params[":student_teacher"] = 2;
            $page                   = $_GPC['page'];
            $record                 = $class_sendRecord->dataList($params,$page);
            $list                   = $record['list'];
            $pager                  = pagination($record['count'],$page,$class_sendRecord->each_page);
        }elseif($op  == 'record'){
            $params[':school_id'] = $school_id;
            $where                = "school_id =:school_id ";
            $total                = pdo_fetchcolumn("select count(*) num  from {$table_pe}lianhu_msg_queue where {$where} group by queue_num  ",$params);
            $list                 = pdo_fetchall("select *,count(*) num from {$table_pe}lianhu_msg_queue where {$where} group by queue_num order by add_time desc  {$sql_limit}  ",$params);
        }else{
            $teacher_list = D("teacher")->getTeacherList($school_id);
            if($_GPC['submit_weixin']){
                $teacher_id_arr = $_GPC['have']; 
                $in['record_type']      = 6;
                $in['class_ids']        = 0;
                $in['record_title']     = $_GPC['weixin_title'];
                $in['record_intro']     = $_GPC['content'];
                $in['record_content']   = $_GPC['record_content'];
                $in['student_teacher']  = 2;
                $in['teacher_ids']      = implode(',',$teacher_id_arr);
                $in['url']              = $_GPC['url'];
                $record_id              = $class_sendRecord->dataAdd($in);
                foreach ($teacher_id_arr as $key => $value) {
                    $record_url         = $_W['siteroot'].'app/'.$this->createMobileUrl("TeaSendRecord",array('record_id'=>$record_id,'teacher_id'=>$value));
                    $openid = $class_teacher->getTeacherOpenid($value);
                    //openid不存在的情况
                    if(!$openid){
                        $openid = 'sms';
                    }
                    if($openid){
                            $title   = $_GPC['weixin_title'];
                            $key2    = $admin_name;
                            $key4    = $_GPC['content'];
                            $remark  = $_GPC['remark'];                          
                            $mu_info = $this->decodeMsg($title,$key2,$key4,$remark); 
                            $que_num = $class_msg->insertMsgQueueMu($openid,$mu_info['data'],$mu_info['mu_id'],$record_url,$que_num);
                    } 
                }
                D('recordQueue')->add($record_id,$que_num);
                $this->myMessage("发布成功,消息将由后台自主发送给教师！",$this->createWebUrl("teacherMsg"),'成功');
                //$this->myMessage('添加成功，跳转往发送页面，请勿关闭',$this->createWebUrl('sendToMsg',array('que_num'=>$que_num,'teacher'=>1)),'成功');
            }            
        }
        if($op=='msg_record'){
            include $this->template('../admin/web_msg_record');
        }elseif($op=='record'){
            $pager=pagination($total,$page,$pagesize);
            include $this->template('../admin/web_record');
        }else{
            $we7_js = 'no';
            include $this->template('../admin/web_teachermsg');
        }       
		exit();
