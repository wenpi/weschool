<?php 
		$this->checkAdminWeb();
		$admin_result = D('admin')->judeAdminType();
		$left_top     = 'class_manage';
		$left_nav     = 'class_notice';
		$title        = '班级公告';  
		$sidebar_list = array(
			array('fun_str'=>'','fun_name'=>'班级管理'),
			array('fun_str'=>'line','fun_name'=>'班级公告'),
		);
		$top_action = array(
			array('action_name'=>'班级公告','action'=>'line' ),
			array('action_name'=>'审核列表','action'=>'line','arr'=>array('ac'=>'wait_to_pass') ),
		);
		$page_name    = '班级公告';
		if($ac=='wait_to_pass'){
			$page_name    = '审核列表';
		}	

		$mu_str = $this->school_info['mu_str'];
		$school_info  	= $this->school_info;
		$school_id 		= getSchoolId();
		

		$class_student  = D('student');
		$teacher        = $this->teacher_qx('no');
		$model          = $_GPC['model'] ? $_GPC['model'] :"class";
		$cid            = $_GPC['cid'];
		
		if($teacher == 'teacher'){
			//班主任
			$uid = $_W['uid'];
			$t_id   	 =   getTeacherId();
			$t_name 	 =   $this->WebFindTeacherInfo('teacher_realname');
			$return_list =   D('teacher')->getTeacherClass($t_id);
			$list        =   $return_list['list'];
		}else{
			$list    = D('classes')->getThisAdminClassList();
			$t_name  = "管理员";
		}
		if($ac=='list'){
			$we7_js = 'no';
		}
		if($_GPC['cid']){
			$class = pdo_fetch("select * from {$table_pe}lianhu_class where class_id=:cid  ",array(':cid'=>$_GPC['cid']));
			if(!$class)
				$this->myMessage('没有找到此班级',$this->createWebUrl('line',array('aw'=>$aw) ),'错误');
		}
        if($ac=='new'){
			 $admin_name     = $this->getWebAdminName();
			if($_GPC['submit']){
				$in['class_id']      = $_GPC['cid'];
				$in['line_title']    = $_GPC['line_title'];
				$in['line_content']  = $_GPC['line_content'];
				$in['line_type']     = $_GPC['line_type'];
				$in['addtime']       = TIMESTAMP;
				$in['teacher_id']    = $t_id;
				$in['teacher_intro'] = $t_name."添加";
				$in['school_id'] 	 = getSchoolId();
				$in['uniacid']  	 = $_W['uniacid'];
				$in['status'] 		 = $school_info['class_notice_status'];
				pdo_insert('lianhu_line',$in);
				$line_id 			 = pdo_insertid();
				$student_list 		 = $this->classStudentNum($_GPC['cid'],false);
				foreach ($student_list as $key => $value) {
					$student_ids[] = $value['student_id'];
				}				
				$class_msg 			 = D('msg');
				$class_name 		 = $this->className($_GPC['cid'] );
				//记录
				$in['record_type']      = 9;
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
					$title  				   = '您好，您有一个班级通知，请查看';
					$openids 				   = $class_student->returnEfficeOpenid($value,3);
					$key2 					   = $admin_name;
					$key4   			  	   = $_GPC['line_title'];
					$remark 				   = "点击查看详细";
					$mu_info    			   = $this->decodeMsg1($title,$class_name,$key2,$key4 ,$remark);     
					if($mu_str=='xiaoye'){
						$url 	  				   = $_W['siteroot'].'app/'.$this->createMobileUrl("classArticle",array('id'=>$line_id,'class_id'=>$_GPC['cid'],'student_id'=>$value['student_id'],'record_id'=>$record_id ) );
					}else{
						$url 	  				   = $_W['siteroot'].'app/'.$this->createMobileUrl("line_article",array('aid'=>$line_id,'class_id'=>$_GPC['cid'],'student_id'=>$value['student_id'],'record_id'=>$record_id ) );
					}
					foreach ($openids as $key => $v) {
							if($v){
								$que_num = $class_msg->insertMsgQueueMu($v,$mu_info['data'],$mu_info['mu_id'],$url,$que_num);
							}
                       }  
				} 
				D('recordQueue')->add($record_id,$que_num);
				pdo_update('lianhu_line',array('queue_num'=>$que_num),array('line_id'=>$line_id));
				if($school_info['class_notice_status']==2){
					$this->myMessage('添加成功，等待审核成功',$this->createWebUrl('line',array('ac'=>'old','cid'=>$_GPC['cid'] ,'aw'=>$aw )),'成功');
				}else{
					$this->myMessage("发布成功,消息将由后台自主发送给家长！",$this->createWebUrl("line"),'成功');
					
					// $this->myMessage('添加成功，跳转往发送页面，请勿关闭',$this->createWebUrl('sendToMsg',array('que_num'=>$que_num,'aw'=>1)),'成功');
				}
			}
		}
		if($ac=='edit'){
			$lid = $_GPC['lid'];
			if($_GPC['submit']){
				$result           	= pdo_fetch("select * from {$table_pe}lianhu_line where line_id=:lid",array(':lid'=>$lid));
				$in['line_title'] 	= $_GPC['line_title'];
				$in['line_content'] = $_GPC['line_content'];
				$in['line_type']    = $_GPC['line_type'];
				$in['teacher_id']   = $t_id;
				$in['status']       = $_GPC['status'];
				$in['teacher_intro']=$t_name."编辑";
				pdo_update('lianhu_line',$in,array('line_id'=>$lid));
				$this->myMessage('编辑成功',$this->createWebUrl('line',array('ac'=>'old','cid'=>$result['class_id'],'aw'=>$aw )),'成功');				
			}
			$result=pdo_fetch("select * from {$table_pe}lianhu_line where line_id=:lid",array(':lid'=>$lid));
			$_GPC['cid'] = $result['class_id'];
		}
		if($ac=='old'){
			$we7_js = 'no';
			$everP  = 20;
			$school_uniacid_line    = " and line.uniacid={$_W['uniacid']} and line.school_id={$school_id} ";
			$list 					= pdo_fetchall(" 
													 select line.*,class.class_name,tea.teacher_realname 
													 from {$table_pe}lianhu_line line 
													 left join {$table_pe}lianhu_class class on class.class_id=line.class_id
			 										 left join {$table_pe}lianhu_teacher tea on line.teacher_id=tea.teacher_id 
													 where line.class_id=:cid {$school_uniacid_line} 
													 order by addtime desc ",array(':cid'=>$cid)
													);
		}
		if($ac=='wait_to_pass'){
			$we7_js = 'no';
			$everP  = 20;
			$school_uniacid_line    = " and line.uniacid={$_W['uniacid']} and line.school_id={$school_id} ";
			$list 					= pdo_fetchall(" 
													 select line.*,class.class_name,tea.teacher_realname 
													 from {$table_pe}lianhu_line line 
													 left join {$table_pe}lianhu_class class on class.class_id=line.class_id
			 										 left join {$table_pe}lianhu_teacher tea on line.teacher_id=tea.teacher_id 
													 where line.status=2  {$school_uniacid_line} 
													 order by addtime desc "
													);
		}
		if($_GPC['cid']){
			$line_type_cfg = C('classes')->msgClass($_GPC['cid']);
		}
		include $this->template('../admin/web_line');
		exit();