<?php 
	$this->checkAdminWeb();
	$admin_result = D('admin')->judeAdminType();
	$left_top     = 'school_msg';
	$left_nav     = 'appointment';
	$title        = '课程活动预约';  
	$sidebar_list = array(
		array('fun_str'=>'','fun_name'=>'学校信息'),
		array('fun_str'=>'appointment','fun_name'=>'课程活动预约'),
	);
	$top_action = array(
		array('action_name'=>'具体可预约列表（课程）','action'=>'appointment','arr'=>array('ac'=>'ac_list') ),
		array('action_name'=>'新增可预约列表','action'=>'appointment','arr'=>array('ac'=>'ac_new') ),
		array('action_name'=>'预约活动列表（一次选课活动）','action'=>'appointment' ),
		array('action_name'=>'新增预约活动','action'=>'appointment','arr'=>array('ac'=>'new' ) ),
	);
	$page_name    = '预约活动列表（一次选课活动）';
	if($ac=='new'){
		$page_name    = '新增预约活动';
	}elseif($ac=='ac_new'){
		$page_name    = '新增可预约列表';
	}elseif($ac=='ac_list'){
		$page_name    = '具体可预约列表（课程）';
	}elseif($ac=='ac_edit'){
		$page_name    = '具体可预约列表（课程）';
	}

	$appointment_limit = $this->appointment_limit;
	$school_info  	  = $this->school_info;
	$appointment_type = $school_info['appointment'];
	if($appointment_type){
		$appointment_cfg = explode("||", $appointment_type);
		foreach ($appointment_cfg as $key => $value) {
			if($value){
				$appointment[]=$value;
			}
		}
	}
	$teacher        	  = $this->teacher_qx('no');
	$school_uniacid 	  = " and school_id = ".$this->school_info['school_id'];
	$aid            	  = intval($_GPC['aid']);
	$school_id 			  = getSchoolId();
	$school_uniacid_class = " and class.uniacid={$_W['uniacid']} and class.school_id={$school_id} ";
	if($teacher=='teacher'){
		$uid   = $_W['uid'];
		$t_id  = getTeacherId();
		$class_list = pdo_fetchall("select class.* from {$table_pe}lianhu_class class  where class.status=1 and class.teacher_id={$t_id} ");
	}else{
		$grade_list = pdo_fetchall("select * from {$table_pe}lianhu_grade where status=1 {$school_uniacid}");
		$class_list = pdo_fetchall("select class.* from {$table_pe}lianhu_class class  where class.status=1 {$school_uniacid_class} ");
		$t_id = 0;
	}
	if(!$class_list){
		$this->myMessage('您不是管理员或者班主任，或者没有设置年级和班级','','错误');		
	} 
	if($ac=='list'){
		$total = pdo_fetchcolumn("select count(*) num from {$table_pe}lianhu_appointment where status!=3 {$school_uniacid}");			
		$list  = pdo_fetchall("select * from {$table_pe}lianhu_appointment  where status!=3 {$school_uniacid} order by appointment_id desc");
		$we7_js = 'no';
	}
	$list_max = pdo_fetchall("select * from {$table_pe}lianhu_appointment_course where course_type=1   {$school_uniacid} and status!=3");
	$list_min = pdo_fetchall("select * from {$table_pe}lianhu_appointment_course where course_type=2   {$school_uniacid} and status!=3");
	if($ac=='new'){
			if($_GPC['submit']){
				if($_GPC['aname']){
					$limit_list = '';
					if($_GPC['limit_type']==0){
					}elseif($_GPC['limit_type']==1){
						$limit_list = $_GPC['grades'];
					}elseif($_GPC['limit_type']==2){
						$limit_list = $_GPC['class'];
					}
                    $in['appointment_mutex'] 	  = serialize($_POST['appointment_mutex']);
					$in['appointment_limit'] 	  = serialize(array('type'=>$_GPC['limit_type'],'list'=>$limit_list));
					$in['appointment_type_limit'] = $_GPC['limit_type'];
					if($limit_list){
						$in['appointment_grade_class'] = implode(',', $limit_list);
					}
					$in['appointment_name'] 	= $_GPC['aname'];
					$in['appointment_intro'] 	= $_GPC['aintro'];
					$in['appointment_content'] 	= $_GPC['acontent'];
					$in['appointment_start'] 	= strtotime($_GPC['atime']['start']);
					$in['appointment_end'] 		= strtotime($_GPC['atime']['end']);
					$in['appointment_addtime'] 	= TIMESTAMP;
					$in['appointment_type'] 	= $_GPC['atype'];
					$in['appointment_max_num']  = $_GPC['amax_num'];
					$in['teacher_id'] 			= $t_id;
					$in['status']  				= 1; 
					$in['uniacid'] 				= $_W['uniacid'];
					$in['school_id'] 			= $school_id;
					pdo_insert('lianhu_appointment',$in);
					$this->myMessage('新增成功',$this->createWebUrl('appointment',array('aw'=>$aw)),'成功');
				}else{
					$this->myMessage('请输入预约名称',$this->createWebUrl('appointment',array('aw'=>$aw)),'错误');
				}
			}
	}
	if($ac=='edit'){
			if($_GPC['submit']){
				if($_GPC['aname']){
					$limit_list='';
					if($_GPC['limit_type']==1){
						$limit_list=$_GPC['grades'];
					}elseif($_GPC['limit_type']==2){
						$limit_list=$_GPC['class'];
					}
                    $in['appointment_mutex'] 		= serialize($_POST['appointment_mutex']);
					$in['appointment_limit'] 		= serialize(array('type'=>$_GPC['limit_type'],'list'=>$limit_list));
					$in['appointment_type_limit'] 	= $_GPC['limit_type'];
					if($limit_list){
						$in['appointment_grade_class'] = implode(',', $limit_list);
					}
					$in['appointment_name'] 		   = $_GPC['aname'];
					$in['appointment_intro'] 		   = $_GPC['aintro'];
					$in['appointment_content'] 		   = $_GPC['acontent'];
					$in['appointment_start'] 		   = strtotime($_GPC['atime']['start']);
					$in['appointment_end']             = strtotime($_GPC['atime']['end']);
					$in['appointment_type']            = $_GPC['atype'];
					$in['status']                      = $_GPC['status'];
					$in['appointment_max_num']         = $_GPC['amax_num'];
					$in['teacher_id']=$t_id;
					pdo_update('lianhu_appointment',$in,array('appointment_id'=>$aid));
					$this->myMessage('更新成功',$this->createWebUrl('appointment',array('aw'=>$aw)),'成功');
				}else{
					$this->myMessage('请输入预约名称',$this->createWebUrl('appointment',array('aw'=>$aw)),'错误');
				}				
			}
			$result  	= pdo_fetch("select * from {$table_pe}lianhu_appointment where appointment_id=:aid",array(':aid'=>$aid));
			$limit 		= unserialize($result['appointment_limit']);
			$limit_type = $limit['type'];
			$limit_arr  = $limit['list'];
            $result['appointment_mutex']=unserialize($result['appointment_mutex']);
	}
	#可预约的课程
	if($ac=='ac_new'){
            if($_GPC['submit']){
                $in['school_id']   		= $school_id;
                $in['uniacid']     		= $_W['uniacid'];   
                $in['course_name'] 		= $_GPC['course_name'];
                $in['course_type'] 		= $_GPC['course_type'];
                $in['course_num']  		= $_GPC['course_num'];
                $in['course_content'] 	= $_GPC['course_content'];
                $in['status'] 			= $_GPC['status'];
                $time['a'] 				= $_POST['timea'];
                $time['b'] 				= $_POST['timeb'];
                if($time){
                    $in['course_time']  = serialize($time);
                }
               pdo_insert("lianhu_appointment_course",$in);
                $this->myMessage("新增成功",$this->createWebUrl('appointment',array('ac'=>'ac_list','aw'=>$aw)),'成功');
            }
	}
	if($ac=='ac_edit'){
            $aid    = $_GPC['aid'];
            $result = pdo_fetch("select * from {$table_pe}lianhu_appointment_course where course_id=:aid",array(':aid'=>$aid));
            $time   = unserialize($result['course_time']);
            if($_GPC['submit']){
                $in['course_name'] 		= $_GPC['course_name'];
                $in['course_type'] 		= $_GPC['course_type'];
                $in['course_num'] 		= $_GPC['course_num'];
                $in['course_content']   = $_GPC['course_content'];
                $in['status'] 			= $_GPC['status'];
                $time['a'] 				= $_POST['timea'];
                $time['b'] 				= $_POST['timeb'];
                if($time){
                    $in['course_time']=serialize($time);
                }     
                pdo_update('lianhu_appointment_course',$in,array('course_id'=>$aid));
                $this->myMessage("更新成功",$this->createWebUrl('appointment',array('ac'=>'ac_list','aw'=>$aw)),'成功');
            }
	}
	if($ac=='ac_list'){
           $where = " school_id = ".$this->school_info['school_id'];
           $list  = pdo_fetchall("select * from {$table_pe}lianhu_appointment_course where {$where} order by course_id desc");
	}
	include $this->template('../admin/web_appointment');
	exit();
	