<?php 	
        $this->checkAdminWeb();
        $admin_result = D('admin')->judeAdminType();
        $left_top     = 'class_manage';
        $left_nav     = 'class_msg';
        $title        = '消息发送';  
        $sidebar_list = array(
            array('fun_str'=>'','fun_name'=>'班级管理'),
            array('fun_str'=>'msg','fun_name'=>'消息发送'),
        );
        $top_action = array(
            array('action_name'=>'发送消息','action'=>'msg' ),
            array('action_name'=>'消息发送记录','action'=>'msg','arr'=>array('op'=>'msg_record') ),
        );
        $page_name    = '发送消息';
        if($op=='msg_record'){
            $page_name    = '消息发送记录';
        }	
        $class_msg          = D("msg");
        $class_student      = D('student');
        $class_sendRecord   = D('sendRecord');
        $teacher            = $this->teacher_qx('no'); 
        $school_id          = getSchoolId();
        
        if($op    == 'msg_record'){
            $params[':school_id']   = $school_id;
            $t_id                   = getTeacherId(); 
            // if($t_id){
            //  $course_list = $this->teacherCourse($t_id);
            //   $params[':school_id']   = $school_id;
            // }
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
            //发送界面
            C("deleteMsgQueue")->Deleteing();
            $admin_name       = $this->getWebAdminName();
            if($teacher   == 'teacher'){
                    $model  = $_GPC['model'] ? $_GPC['model'] : "class";
                    if($model  == 'class'){
                        $result = $this->teacher_standard('no');
                    }else{
                        $result = $this->student_standard();		
                    }
            }else{
                    $model  = $_GPC['model'] ? $_GPC['model'] :"grade";
                    $result = $this->student_standard();		
            }
            if($_GPC['submit_weixin'] || $_GPC['submit_sms'] || $_GPC['submit_kf']){
                if(!$_GPC['content'] && $_GPC['submit_weixin']=='提交' ){
                    $this->myMessage('请填写内容','','错误');
                }
                $have = $_GPC['have'];
                if(!$have){
                    $this->myMessage('请选择需要发送消息的用户或者群组','','错误');
                }
                foreach ($have as $key => $value) {
                    $value = intval($value);
                    if(!$value){
                        unset($have[$key]);
                    }else{
                        $have[$key] = $value;
                    }
                }
                $where_common = " and status=1"  ;
                if($model == 'grade'){
                    $grade_id_str = implode(',', $have);
                    $student_list = pdo_fetchall("select * from {$table_pe}lianhu_student where grade_id in({$grade_id_str}) ".$where_common );
                    $class_list   = pdo_fetchall("select * from {$table_pe}lianhu_class where grade_id in({$grade_id_str}) " );
                    foreach ($class_list as $key => $value) {
                        $class_ids[] = $value['class_id'];
                    }
                    $class_id_str    = implode(',', $class_ids);
                    $in['class_ids'] = $class_id_str;
                }			
                if($model == 'class'){
                    $_GPC['model'] = 'student';
                    $need_do_student_ids = array();
                    foreach ($have as $key => $value) {
                        $_GPC['cid']  = $value;
                        $student_list = $this->student_standard();
                        foreach ($student_list as $k => $v) {
                            if(in_array($v['student_id'],$need_do_student_ids)){
                                continue;
                            }else{
                                $real_student_list[]    = $v;
                                $need_do_student_ids[]  = $v['student_id'];
                            }
                        }
                    }
                    $student_list    = $real_student_list;
                    $class_id_str    = implode(',', $have);
                    $in['class_ids'] = $class_id_str;
                }
                if($model=='student'){
                    $student_id_str = implode(',', $have);
                    $student_list   = pdo_fetchAll("select * from {$table_pe}lianhu_student where student_id in({$student_id_str})".$where_common);	
                }
                $que_num = false;
                #微信发送
                if($_GPC['submit_weixin']){
                    $mu_id                 = $_GPC['mu_id'];
                    $in['record_type']     = 1;
                    $in['record_title']    = $_GPC['weixin_title'];
                    $in['record_intro']    = $_GPC['intro'];
                    $in['record_content']  = $_GPC['real_content'];
                    $url                   = $_GPC['url'];
                    $in['url']             = $url;
                    foreach ($student_list as $key => $value) {
                        $student_ids[] = $value['student_id'];
                    }
                    
                    $in['student_ids'] = implode(',',$student_ids);
                    $record_id         = $class_sendRecord->dataAdd($in);
                    unset($in);
                    foreach ($student_list as $key => $value) {
                        $record_url    = $_W['siteroot'].'app/'.$this->createMobileUrl("sendRecord",array('record_id'=>$record_id,'student_id'=>$value['student_id']) );
                        D("sendAlone")->studentAdd($value['student_id'],$record_id);
                        #遍历and发送
                        $openids       = $class_student->returnEfficeOpenid($value,3);
                        $set_title     = false;
                        if($_GPC['weixin_title']){
                            $title     = $_GPC['weixin_title'];
                            $title     = str_ireplace('[学生姓名]',$value['student_name'],$title);
                            $set_title = true;
                        }
                        $key2    = $admin_name;
                        $key4    = $_GPC['intro'];
                        $remark  = $_GPC['remark'];
                        $class_msg->msg_student_id = $value['student_id'];
                        foreach ($openids as $key => $v) {
                            if($v){
                                if($set_title){
                                        $first = $title;
                                }else{
                                        $first_end = $class_student->rebackHeadEndTextByRelation($v,$value['student_id']);
                                        $first     = $first_end['first']."有新的通知";
                                }
                                $mu_info = $this->decodeMsg($first,$key2,$key4,$remark);   
                                //设置了url 并且没有设置详细内容的话
                                if(!$url && !$_GPC['real_content']){
                                        $url = $_W['siteroot'].'app/'.$this->createMobileUrl("home");
                                }else{
                                        $url = $record_url; 
                                }
                                $que_num = $class_msg->insertMsgQueueMu($v,$mu_info['data'],$mu_info['mu_id'],$url,$que_num);
                            }
                        }
                    }                
                }
                #客服消息
                if($_GPC['submit_kf']=='客服消息'){
                    $url_kf      =$_GPC['url_kf'];
                    if(!$_GPC['url_kf'])
                        $url_kf  =$_W['siteroot'].'app/'.$this->createMobileUrl("home");
                    $content_kf  =$_GPC['content_kf'];
                    $title_kf    =$_GPC['title_kf'];
                    foreach ($student_list as $key => $value) {
                        #遍历and发送
                        $class_msg->msg_student_id = $value['student_id'];
                        $openids  = $class_student->returnEfficeOpenid($value,3);
                        foreach ($openids as $key => $v) {
                            if($v){
                                $data=array('title'=>$title_kf,'url'=>$url_kf,'content'=>$content_kf);
                                $que_num=$class_msg->insertMsgQueueKe($v,$data,$que_num);
                            }
                        }                   
                    }
                }
                if($_GPC['submit_sms']=='发送短信'){
                    $in['record_type']     = 3;
                    $in['record_title']    = $_GPC['sms_head'];
                    $in['record_content']  = $_GPC['sms_content'];
                    foreach ($student_list as $key => $value) {
                        $student_ids[] = $value['student_id'];
                        $data          = array('head'=>$_GPC['sms_head'],'content'=>$_GPC['sms_content']);
                        #遍历and发送
                        $class_msg->msg_student_id = $value['student_id'];
                        if($value['parent_phone']){
                            $phone = $this->sendSms($value['parent_phone']);
                            if($phone)
                                $que_num = $class_msg->insertMsgQueueSms($phone,$data,$que_num);
                        }
                    }       
                    $in['student_ids'] = implode(',',$student_ids);
                    $record_id         = $class_sendRecord->dataAdd($in);
                }            
                D('recordQueue')->add($record_id,$que_num);
                $this->myMessage("发布成功,消息将由后台自主发送给家长！",$this->createWebUrl("msg"),'成功');
                // $this->myMessage('添加成功，跳转往发送页面，请勿关闭',$this->createWebUrl('sendToMsg',array('que_num'=>$que_num,'aw'=>$aw)),'成功');
            }		
        }
    //测试后台
        if($op=='msg_record'){
            include $this->template('../admin/web_msg_record');
        }elseif($op=='record'){
            $pager=pagination($total,$page,$pagesize);
            include $this->template('../admin/web_record');
        }else{
            include $this->template('../admin/web_msg');
        }
	    exit();