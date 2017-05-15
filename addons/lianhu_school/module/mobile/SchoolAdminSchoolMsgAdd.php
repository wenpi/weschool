<?php
    $doac = $_SERVER['HTTP_ACCEPT'];
    if(!stristr($doac,"text/html")){
        exit();
    }
    $token         = $this->class_base->tokenForm();
    $school_admin  = D('admin')->mobileValidSchoolAdmin();
    if(!$school_admin){
        header("Location:".$this->createMobileUrl("school_bangding"));
    }
    $title = $page_title = '学校公告';
    $class_neiMsg   = D('neiMsg');
    $class_student  = D('student');	
    if($_GPC['submit'] && $_GPC['token'] == $_COOKIE['form_token']  ){
			$img_arrs	= $_POST['img_value'];
            if($img_arrs){
                foreach ($img_arrs as $key => $value) {
                    $img = $this->getWechatMedia($value);
                    if($img){
                        $img_in[]= $img;
                    }else{
                        $img_in[]= $up_file_name; 
                    }
                }
            }   
            if(!$img_in[0]){
                $this->myMessage("请至少上传一张图片作为公告封面",$this->createMobileUrl('schoolAdminSchoolMsgAdd'),'错误');
            }
			$in['msg_title'] 	= $_GPC['title'];
			$in['msg_content'] 	= $_GPC['content'];
			$in['addtime'] 		= TIMESTAMP;
			$in['img'] 	 		= end($img_in);
			$in['images'] 		= serialize($img_in);                
			$in['db_admin_id']  = getDbAdminId();
			$data_in 			= getNewUpdateData($in,$class_neiMsg);
			$msg_id 			= $class_neiMsg->add($data_in);
			//发送模板消息
			$class_msg   		= D("msg");
			$student_list 		= $class_student->getStudentlist();
			foreach ($student_list as $key => $value) {
				$student_ids[] = $value['student_id'];
			}
			$admin_name     	    = $school_admin['info']['admin_name'];
			//记录
			$in['record_type']      = 10;
			$in['class_ids']        = 0;
			$in['record_title']     = "学校通知";
			$in['record_intro']     = $in['msg_title'];
			$in['record_content']   = $in['msg_content'];
			$in['student_teacher']  = 1;
			$in['url']              = $_W['siteroot'].'app/'.$this->createMobileUrl("msg_content",array('id'=>$msg_id));
			$in['student_ids'] 		= implode(',',$student_ids);
			$record_id              = D('sendRecord')->dataAdd($in);
			//end 记录
			foreach ($student_list as $key => $value) {
				  $openids   = $class_student->returnEfficeOpenid($value,3);
			      $title     = "学校通知";
				  $key2 	 = $admin_name; 
				  $key4   	 = $in['msg_title'];
				  $remark 	 = "点击查看详情";
				  $class_msg->msg_student_id = $value['student_id'];
                    foreach ($openids as $key => $v) {
                        if($v){
                           $mu_info = $this->decodeMsg($title,$key2,$key4,$remark);   
						   $url     = $_W['siteroot'].'app/'.$this->createMobileUrl("msg_content",array('id'=>$msg_id,'student_id'=>$value['student_id'],'record_id'=>$record_id) );
                           $que_num = $class_msg->insertMsgQueueMu($v,$mu_info['data'],$mu_info['mu_id'],$url,$que_num);
                        }
                    }
			}
			D('recordQueue')->add($record_id,$que_num);
			$this->myMessage("发布成功,消息将由后台自主发送给家长！",$this->createMobileUrl("schoolAdminSchoolMsg"),'成功');
			// $this->myMessage('添加成功，跳转往发送页面，请勿关闭',$this->createWebUrl('sendToMsg',array('que_num'=>$que_num,'teacher'=>1)),'成功');
	}	


