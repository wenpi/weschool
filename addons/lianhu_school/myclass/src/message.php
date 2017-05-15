<?php 
namespace myclass\src;

class message{
    public $message_table;
    public $content_table;
    public $school_id;

    public function __construct(){
        $this->message_table  = tablename('lianhu_admin_message');
        $this->content_table  = tablename('lianhu_message_content');
        $this->school_id      = getSchoolId();
    }
    //获取学校级别的留言列表
    public function getSchoolMessageList($handle = 'all',$type,$sql_limit){
        $params[":school_id"] = $this->school_id;
        $params[":status"]    = 1;
        if($handle == 'do'){
            $params[":handle_status"] = 1;
        }elseif($handle == 'not_do'){
            $params[":handle_status"] = 0;
        }
        $where  = S("fun","composeParamsToWhere",array($params) );
        if($type=='teacher'){
            $where .= " and teacher_id > 0 ";
        }elseif($type=='student'){
            $where .= " and student_id > 0 ";
        }
        $count = pdo_fetchcolumn("select count(message_id) from ".$this->message_table." where ".$where." ",$params);
        $list  = pdo_fetchall("select *  from ".$this->message_table." where ".$where." order  by message_id desc  {$sql_limit}  ",$params);
        return array('count'=>$count,'list'=>$list);
    }
    //留言详情
    public function getMessageInfo($message_id){
        $where[':message_id'] = $message_id;
        $result              = pdo_fetch(" select * from ".$this->message_table."  where message_id=:message_id ",$where );
        return $result;
    }
    //获取回复详情
    public function getContentInfo($content_id){
        $where[':content_id'] = $content_id;
        $result               = pdo_fetch(" select * from ".$this->content_table."  where content_id=:content_id ",$where );
        return $result;
    }   
    //获取某个学生的留言列表
    public function getStudentList($student_id){
        $params[':student_id'] = $student_id;
        $params[":status"]     = 1;
        $where                 = S("fun","composeParamsToWhere",array($params) );
        $list                  = pdo_fetchall("select * from ".$this->message_table." where ".$where." order by  add_time desc ",$params);
        return $list;
    }
    //获取留言的处理
    public function getMessageHandle($message_id){
        $params[":message_id"] = $message_id;
        $params[":status"]     = 1;
        $where                 = S("fun","composeParamsToWhere",array($params) );
        $list                  = pdo_fetchall("select * from ".$this->content_table." where ".$where." order by  add_time asc ",$params);
        return $list;
    }
    //新增留言
    public function addMessage($arr){
        global $_W;
        $in['uniacid']      = $_W['uniacid'];
        $in['school_id']    = getSchoolId();
        $in['student_id']   = $arr['student_id'] ? $arr['student_id'] :0;
        $in["teacher_id"]   = $arr['teacher_id'] ? $arr['teacher_id'] :0;
        $in['send_uid']     = $arr['send_uid'];
        $in['message_content'] = $arr['msg_content'];
        $in['title']           = $arr['title'];
        $in["add_time"]        = time();
        $in['imgs']            = $arr['imgs'];
        pdo_insert("lianhu_admin_message",$in);
        return pdo_insertid();
    }
    //编辑留言
    public function editMessage($message_id,$up){
        pdo_update("lianhu_admin_message",$up,array("message_id"=>$message_id) );
    }
    //新增回复

    
    public function addMessageContent($arr){
        $in['message_id'] = $arr['message_id'];
        $in['teacher_id'] = $arr['teacher_id'] ? $arr['teacher_id'] :0;
        $in['student_id'] = $arr['student_id'] ? $arr['student_id'] :0;
        $in['admin_uid']  = $arr['admin_uid']  ? $arr['admin_uid'] :0;
        $in['send_uid']   = $arr['send_uid'];
        $in['type']       = $arr['type'];
        $in['add_time']   = time();
        $in['content']    = $arr['content'];
        pdo_insert("lianhu_message_content",$in);
        if($arr['type']==1)
            $this->editMessage($arr['message_id'],array('handle_status'=>1));
        return pdo_insertid();
    }
}
