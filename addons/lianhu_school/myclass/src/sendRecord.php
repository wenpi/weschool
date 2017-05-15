<?php 
namespace  myclass\src;

class sendRecord extends common{
    public function __construct(){
        $this->setTable('lianhu_send_record');
        $this->setGlobal();
    }
	public function msgSendType($key){
		$arr = array(
			"1"=>"消息发送-模板消息",
			"2"=>"消息发送-模板消息",
			"3"=>"消息发送-短信消息",
			"4"=>'教师端-消息发送',
			"5"=>'教师端-作业发送',
			"6"=>'发送消息给教师',
			"7"=>'PC端--作业发送',
			"8"=>'PC端--学校公告',
			"9"=>'PC端--班级公告',
			"10"=>'管理端--学校公告',
			"11"=>'教师端--班级公告',
			'12'=>'教师端--通知教师',
			'13'=>'管理端--通知教师'
		);
		return $arr[$key];
	}
    public function dataAdd($arr){
		$member_uid 		    = getMemberUid(); 
        $in['mobile_uid']       = $member_uid;      
 		$in['record_type']      = $arr['record_type'];
		$in['class_ids'] 	    = $arr['class_ids'];
		$in['student_ids']      = $arr['student_ids']?$arr['student_ids']:0;
  		$in['record_title'] 	= $arr['record_title'];
		$in['record_intro'] 	= $arr['record_intro'];
		$in['record_content']   = $arr['record_content'];
		$in['student_teacher']  = $arr['student_teacher']?$arr['student_teacher']:1;
		$in['teacher_ids']      = $arr['teacher_ids']?$arr['teacher_ids']:0;
 		$in['imgs'] 			= $arr['imgs'];
		$in['voice'] 			= $arr['voice'];
		$in['url'] 				= $arr['url'];             
        $in['teacher_id']       = getTeacherId();
        $in['db_admin_id']      = getDbAdminId();
        return parent::add($in);
    }
    public function dataEdit($record_id,$up=false){
        $where["record_id"] = $record_id;
        $result             = parent::edit($where,$up);
        return $result;
    }
    public function dataList($params,$pages,$where =false){
      $this->_set('each_page',20);
      return parent::getList($params,$where,$pages);
    }
 	//获取班级公告发送量
	public function getClassMsgCount($school_id,$begin_time,$end_time,$type){
		$params[":school_id"] 	= $school_id;
		$params[":record_type"] = $type;
		$where                  = "  add_time <= ".intval($end_time)." and add_time >= ".intval($begin_time)." ";
        $result                 =  parent::getList($params,$where);
        $count          	    = $result['count'];
		return $count;
	} 
	//删除
	public function deleteSendRecord($record_id){
		$where["record_id"] = $record_id;
		$this->delete($where);
	}
	
}