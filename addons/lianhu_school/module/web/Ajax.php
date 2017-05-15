<?php
defined('IN_IA') || exit('Access Denied');
set_time_limit(0);
$uid 		= $_W['uid']; 
//获取年级列表
if($ac=='get_grade_list'){
	$class_grade = D('grade');
	$class_grade->school_id = $_GPC['school_id'];
	$grade_list  = $class_grade->getSchoolList();
	$out['errcode'] = 0;
	$out['list'] 	= $grade_list;
	outJson($out);
}
//获取学校列表
if($ac=='get_school_list'){
	$class_school = D('school');
	$school_list  = $class_school->getSchoolByUniacid($_GPC['uniacid']);
	$out['errcode'] = 0;
	$out['list'] 	= $school_list;
	outJson($out);
}
if($ac=='schoole_message_list'){
	$class_message = D("message");
	$message_id    = $_GPC['message_id'];
	$handle_list   = $class_message->getMessageHandle($message_id);
	if(!$handle_list){
		$handle_list['errcode'] = 0;
	}
	outJson($handle_list);
}
if($ac=='look_info'){
	$look_id = $_GPC['look_id'];
	$result  = pdo_fetch("select * from ".tablename('lianhu_look')." where look_id=:lid ",array(":lid"=>$look_id) );
	if($result['voice']){
		$out['voice'] = $this->echoVoiceUrl($result['voice']);
	}
	if($result['images']){
		$out['imgs'] = $this->decodeLineImgs($result['images'],1);
	}
	$out['text']    = $result['content'];
	$out['errcode'] = 0;
	outJson($out);
}
//校长回复校长信箱
if($ac=='handle_message'){
	$message_id = $_GPC['message_id'];
	$content    = $_GPC['content'];
	if(!$message_id ||!$content){
		outJson(array('errcode'=>1,'msg'=>'传递错误'));
	}else{
		$arr['message_id'] = $message_id;
		$arr['admin_uid'] = $uid;
		$arr['send_uid']  = $uid;
		$arr['content']	  = $content;
		$arr['type']      = 1;
		D('message')->addMessageContent($arr);
		outJson(array('errcode'=>0,'msg'=>'success'));
	}
}
//删除校长信箱
if($ac=='delete_message'){
	$message_id = $_GPC['message_id'];
	if(!$message_id){
		outJson(array('errcode'=>1,'msg'=>'传递错误'));
	}else{
		D('message')->editMessage($message_id,array("status"=>2) );
		outJson(array('errcode'=>0,'msg'=>'success'));
	}
}
//更新学生数据
if($ac=='update_school_grade_class_student'){
	$_SESSION['school_grade_class_up']    = 0;
	if(!$_SESSION['school_grade_class_up']){

		$school_list = $this->class_base->getSchoolList();
		$grade_list  = $this->class_base->getGradeList();
		$class_list  = $this->class_base->getAllClassList();
		$device_list = $this->class_base->getDeviceList();
		//构造请求
		$all_list    = array(array('school'=>$school_list,'grade'=>$grade_list,'class'=>$class_list,'device'=>$device_list));
		$arr         = $this->updateDate($all_list,'school_grade_class_up');
		if(isset($arr['errcode'])&& $arr['errcode']==1){
			echo json_encode($arr);
		}
		$_SESSION['school_grade_class_up'] =1;
	}
	if($_GPC['class_id']){
		if($_GPC['class_id']!='tea_class'){
			$arr = explode('-',$_GPC['class_id']);
			if($arr[0]=='building_id'){
				$building_id = $arr[1];
				$student_list= Au("room/roomStudent")->buildingStudentList($building_id);
				$arr		 = $this->updateDate($student_list,'building');
			}else{
				$student_list = $this->class_base->getStundentList($_GPC['class_id']);	
				foreach ($student_list as $key => $value) {
					$student_list[$key]['student_img'] = $_W['attachurl'].$value['student_img'];
				}
				$arr	= $this->updateDate($student_list,'student');
			}
		}else{
			$teacher_list = C('teacherRfid')->getTeacherList();
			foreach ($teacher_list as $key => $value) {
				$teacher_list[$key]['teacher_img'] = $_W['attachurl'].$value['teacher_img'];
			}
			$arr	= $this->updateDate($teacher_list,'teacher');
		}
		if(isset($arr['errcode'])&& $arr['errcode']==1){
			echo json_encode($arr);
		}else{
			echo json_encode(array("errcode"=>0,'add_time'=>date("H:i:s",TIMESTAMP)));
		}
	}
	exit();
}
if($ac=='send_msg_line'){
    $queue_ids = $_GPC['queue_ids'];
    if(!$queue_ids){
		return false;
	}
	$queue_id_arr = explode(',',$queue_ids);
	$end_time 	  = date("H:i:s",time());		
	foreach ($queue_id_arr as $key => $value) {
		if($value){
			$result   = $this->sendAllMsg($value);
			$out_list[$value] = array("end_time"=>$end_time,'status'=>2,'result'=>$result);
		}
	}
	outJson($out_list);
}
if($ac=='course_list' && $_GPC['cid']){
		$course_list=$this->get_class_course($_GPC['cid']);
		if($course_list){
			echo json_encode(array('success'=>'yes','list'=>$course_list));
		}else{
			echo '1';
		}
}
if($ac=='class_list' && $_GPC['gid']){
		$class_list=$this->grade_class_num($_GPC['gid'],false);
		if($class_list){
			echo json_encode(array('success'=>'yes','list'=>$class_list));
		}
}	
if($ac=='jilv_list'){
	if($_GPC['cid']){
		$gid=pdo_fetchcolumn("select grade_id from {$table_pe}lianhu_class where class_id=:id",array(':id'=>$_GPC['cid']));
		$jilv_list=$this->get_grade_sroce_jilv($gid,TIMESTAMP-3600*24*30*2);
		if($jilv_list){
			echo json_encode(array('success'=>'yes','list'=>$jilv_list));
		}else{
			echo '1';
		}
	}
	if($_GPC['gid']){
			$jilv_list = $this->get_grade_sroce_jilv($_GPC['gid'],1);
				if($jilv_list){
					echo json_encode(array('success'=>'yes','list'=>$jilv_list));
				}else{
					echo '1';
				}			
	}
}
if($ac=='student_score_list'){
	$class_id=$_GPC['cid'];
	$course_id=$_GPC['course_id'];
	$scorejilv_id=$_GPC['scorejilv_id'];
	$list=pdo_fetchall("select * from {$table_pe}lianhu_scorelist where course_id=:course_id and ji_lv_id=:ji_lv_id and class_id=:class_id",array(':course_id'=>$course_id,':ji_lv_id'=>$scorejilv_id,':class_id'=>$class_id));
    echo json_encode(array('status'=>"yes",'student_score_list'=>$list));
}
if($ac=='teacher_class_change'){
    $class_id_str=trim($_GPC['class_str'],',');
    $arr=explode(',',$class_id_str);
    foreach ($arr as $key => $value) {
        $arr[$key]=intval($value);
    }
    $class_id_str=implode(',',$arr);
    $list=pdo_fetchall("select course_ids from {$table_pe}lianhu_class where class_id in ({$class_id_str})");
    $course_arr=array();
   foreach($list as $key=>$value){
       $course_arr=array_merge($course_arr,unserialize($value['course_ids']));
   } 
   $course_arr=array_unique($course_arr);
   $course_id_str=implode(',',$course_arr);
   $out_list=pdo_fetchall("select * from {$table_pe}lianhu_course where course_id in ({$course_id_str})");
   echo json_encode(array('status'=>"success",'list'=> $out_list));
}
//审核通过操作
if($ac=='pass'){
	$id   = $_GPC['id'];
	$type = $_GPC['type'];
	//班级记录
	if($type=='line'){
		pdo_update("lianhu_line",array('status'=>1) ,array("line_id"=>$id) );
	}
	echo json_encode(array('errcode'=>0));
}
//教师的删除操作
if($ac=='tea_delete'){
     $type          = $_GPC['type'];
     if($type=='line'){
         pdo_delete("lianhu_line",array("line_id"=>$_GPC['id']));
     }
    echo json_encode(array('errcode'=>0));
    exit();
}
exit();