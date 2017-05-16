<?php
    $asc = $_SERVER['HTTP_ACCEPT'];
    if(!stristr($asc,"text/html")){
        exit();
    }

	$teacher_info   = $this->teacher_mobile_qx();
	$student_name 	= $teacher_info['teacher_realname'];
	$page_title 	= '班级公告';
	$mu_str 		= $this->school_info['mu_str'];
	$school_info  	= $this->school_info;
	$token          = $this->class_base->tokenForm();
	$uid  			= $teacher_info['fanid'];
	$t_id 		    = $teacher_info['teacher_id'];
	$line_type_cfg  = C('classes')->msgClass($_GPC['cid']);
	$alist 			= D('teacher')->getTeacherClass($t_id);
	$list  			= $alist['list'];
	$cid   			= $_GPC['cid'];
	$class_student  = D('student');
	if($cid){
		$class=pdo_fetch("select * from {$table_pe}lianhu_class where class_id=:cid",array(':cid'=>$_GPC['cid']));
		if(!$class){
			message('没有找到此班级',$this->createMobileUrl('Tea_line'),'error');
		}
	}
	if( $ac=='new' || $ac=='edit' ){
			if(!strstr($_GPC['voice_value'],'images') && $_GPC['voice_value'])
				$in['voice']   = $this->getWechatMedia($_POST['voice_value'],2,false);	
			#解析图片 
			$img_arrs = $_POST['img_value'];
			if($img_arrs){
				foreach ($img_arrs as $key => $value) {
					if(!strstr($value,'images') && $value)
						$img_in[]=$this->getWechatMedia($value,1,true);
					else 
						$img_in[]=$value; 
				}
			}		
			if($img_in){
				$in['imgs']   = json_encode($img_in);
			}
	}
	if($ac=='new'){
		if($_GPC['submit'] && $_GPC['token'] == $_COOKIE['form_token'] ){
			if($mu_str=='xiaoye'){
				$class_ids   = $_GPC['have'];
			}else{
				$class_ids[] = $_GPC['cid'];
			}
			if(!$class_ids){
				$this->myMessage('请选择需要发送的班级',$this->createMobileUrl("teain"),'错误');	
			} 
			foreach ($class_ids as $cid) {
				$in['class_id'] 	= $cid;
				$in['line_title'] 	= $_GPC['line_title'];
				$in['line_content'] = $_GPC['line_content'];
				$in['line_type'] 	= $_GPC['line_type'];
				$in['addtime'] 		= TIMESTAMP;
				$in['teacher_id'] 	= $t_id;
				$in['teacher_intro']= $t_name."添加";
				$in['uniacid']      = $_W['uniacid'];
				$in['school_id']    = getSchoolId();
				$in['status']  		= $school_info['class_notice_status'];
				pdo_insert('lianhu_line',$in);
				$line_id 			 = pdo_insertid();

				$class_student->_set('class_id',$cid);
				$list_result 		 = $class_student->getGradeClassStudent();
				$student_list 		 = $list_result['list'];		
				foreach ($student_list as $key => $value) {
					$student_ids[] = $value['student_id'];
				}	
				$class_msg 		     = D('msg');
				//记录
				$in['record_type']      = 11;
				$in['class_ids']        = 0;
				$in['record_title']     = "班级公告";
				$in['record_intro']     = $_GPC['line_title'];
				$in['record_content']   = $_GPC['line_content'];
				$in['student_teacher']  = 1;
				$in['url']              = $_W['siteroot'].'app/'.$this->createMobileUrl("classArticle",array('id'=>$line_id,'class_id'=>$_GPC['cid']));
				$in['student_ids'] 		= implode(',',$student_ids);
				$record_id              = D('sendRecord')->dataAdd($in);
				//end 记录
				foreach ($student_list as $key => $value) {
							$class_msg->msg_student_id = $value['student_id'];
							$title  = '您好，您有一个班级通知，请查看';
							$openids= $class_student->returnEfficeOpenid($value,3);
							$key2 	= $teacher_info['teacher_realname'];
							$key4   = $_GPC['line_title'];
							$remark = "点击查看详细";
							$class_name = $this->className($cid );
							$mu_info    = $this->decodeMsg1($title,$class_name,$key2,$key4 ,$remark);     
							if($mu_str=='xiaoye'){
								$url = $_W['siteroot'].'app/'.$this->createMobileUrl("classArticle",array('id'=>$line_id,'student_id'=>$value['student_id'],'record_id'=>$record_id ) );
							}else{
								$url = $_W['siteroot'].'app/'.$this->createMobileUrl("line_article",array('aid'=>$line_id,'student_id'=>$value['student_id'],'record_id'=>$record_id ) );
							}					
							foreach ($openids as $key => $v) {
									if($v){
										$que_num = $class_msg->insertMsgQueueMu($v,$mu_info['data'],$mu_info['mu_id'],$url,$que_num);
									}
							}  
				} 
				D('recordQueue')->add($record_id,$que_num);
				pdo_update('lianhu_line',array('queue_num'=>$que_num),array('line_id'=>$line_id));			
			}
			if($school_info['class_notice_status']==2){
				$this->myMessage('添加成功，等待审核成功',$this->createMobileUrl('Tea_line',array('ac'=>'old','cid'=>$_GPC['cid']  )),'成功');
			}else{
				$this->myMessage("公告发布成功,消息将由后台自主发送给家长！",$this->createMobileUrl("teain"),'成功');
				// $this->myMessage('添加成功，跳转往发送页面，请勿关闭',$this->createMobileUrl('sendToMsg',array('que_num'=>$que_num)),'成功');
			}
		}
	}
	if($ac=='edit'){
		$lid = $_GPC['lid'];
		if($_GPC['submit'] && $_GPC['token'] == $_COOKIE['form_token'] ){
			$result 			 = pdo_fetch("select * from {$table_pe}lianhu_line where line_id=:lid",array(':lid'=>$lid));
			$in['line_title'] 	 = $_GPC['line_title'];
			$in['line_content']  = $_GPC['line_content'];
			$in['line_type'] 	 = $_GPC['line_type'];
			$in['teacher_id'] 	 = $t_id;
			$in['status'] 		 = $_GPC['status'];
			$in['teacher_intro'] = $t_name."编辑";
			pdo_update('lianhu_line',$in,array('line_id'=>$lid));
			if($mu_str =='xiaoye'){
				$this->myMessag('编辑成功',$this->createMobileUrl('Tea_lineHistory',array('cid'=>$result['class_id'])),'成功');				
			}else{
				$this->myMessag('编辑成功',$this->createMobileUrl('Tea_line',array('ac'=>'old','cid'=>$result['class_id'])),'成功');				
			}
		}
		$result = pdo_fetch("select * from {$table_pe}lianhu_line where line_id=:lid",array(':lid'=>$lid));
	}
	if($ac=='old'){
		$pagesize = 20;
		$page     = $_GPC['page']?$_GPC['page']:1;
		$start    = ($page-1)*$pagesize;
		$total    = pdo_fetchcolumn("select count(*) num from  {$table_pe}lianhu_line where class_id=:cid",array(':cid'=>$cid));
		$list     = pdo_fetchall("select line.*,class.class_name,tea.teacher_realname from {$table_pe}lianhu_line line left join {$table_pe}lianhu_class class on class.class_id=line.class_id
		left join {$table_pe}lianhu_teacher tea on line.teacher_id=tea.teacher_id where line.class_id=:cid order by addtime desc limit {$start},{$pagesize}",array(':cid'=>$cid));
		$pager 	  = pagination($total, $page+1, $pagesize);
	}