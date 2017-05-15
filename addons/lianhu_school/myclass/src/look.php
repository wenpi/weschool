<?php 
namespace myclass\src;
class look{
    public $table;
    public $record_id;
    
    public function __construct(){
        $this->table = tablename('lianhu_look');
    }
    public function lookType($type){
        $arr = array(
            1=>'web_send_msg',
            2=>'web_homework',
            3=>'mobile_send_msg',
            4=>'mobile_homework',
        );
        return $arr[$type];
    }
    //该学生是否查看
    public function studentHaveLook($student_id){
        $params[":record_id"] = $this->record_id;
        $params[":student_id"]= $student_id;       
       	$where  = S("fun","composeParamsToWhere",array($params) );
        $list   = pdo_fetch("select * from ".tablename('lianhu_look')." where ".$where." ",$params);    
        return $list;
    }
    //该教师是否查看
    public function teacherHaveLook($teacher_id){
        $params[":record_id"] = $this->record_id;
        $params[":teacher_id"]= $teacher_id;       
       	$where  = S("fun","composeParamsToWhere",array($params) );
        $list   = pdo_fetch("select * from ".tablename('lianhu_look')." where ".$where." ",$params);    
        return $list;
    }
    //look info 
    public function lookInfo($record_id,$student_id=0,$teacher_id=0){
        $params[":record_id"] = $record_id;
        $params[":student_id"]= $student_id;
        $params[":teacher_id"]= $teacher_id;
       	$where  = S("fun","composeParamsToWhere",array($params) );
        $result = pdo_fetch("select * from ".tablename('lianhu_look')." where ".$where." ",$params);    
        return $result;
    }
    //查看记录
    public function getLookInfo($look_id){
        $params[":look_id"] = $look_id;
       	$where  = S("fun","composeParamsToWhere",array($params) );
        $result = pdo_fetch("select * from ".tablename('lianhu_look')." where ".$where." ",$params);    
        return $result;
    }
    //增加查看记录
    public function addLookRecord($arr){
        $in['look_type']  = $arr['look_type'];
        $in['record_id']  = $this->record_id;
        $in['student_id'] = $arr['student_id'] ? $arr['student_id']:0;
        $in['teacher_id'] = $arr['teacher_id'] ? $arr['teacher_id']:0 ;
        $in['images']     = $arr['images']? $arr['images']:0;
        $in['content']    = $arr['content']? $arr['content']:0;
        $in['voice']      = $arr['voice']? $arr['voice']:0;
        $result           = $this->lookInfo($in['record_id'],$in['student_id'],$in['teacher_id']);
        if($result){
            $in['images']     = $arr['images']? $arr['images']:$result['images'];
            $in['content']    = $arr['content']? $arr['content']:$result['content'];
            $in['voice']      = $arr['voice']? $arr['voice']:$result['voice'];
            pdo_update("lianhu_look",$in,array("look_id"=>$result['look_id']) );
            $look_id = $result['look_id'];
        }else{
            $in['add_time']   = time();
            pdo_insert("lianhu_look",$in);
            $look_id = pdo_insertid();
        }
        return $look_id;
    }
    //record_id 查看数
    public function recordLookNum(){
        $params[":record_id"] = $this->record_id;
       	$where               = S("fun","composeParamsToWhere",array($params) );
        $count               = pdo_fetchcolumn("select count(look_id) num  from ".tablename('lianhu_look')." where ".$where." ",$params);    
        $list                = pdo_fetchall("select *   from ".tablename('lianhu_look')." where ".$where." order by look_id desc",$params);    
        return array('list'=>$list,'count'=>$count); 
    }
    //record_id 有回复数
    public function recordReplyNum(){
        $params[":record_id"] = $this->record_id;
       	$where                = S("fun","composeParamsToWhere",array($params) );
        $sql                  = " and  (images  !='0' or content !='0' or voice !='0' ) ";
        $count                = pdo_fetchcolumn("select count(look_id) num  from ".tablename('lianhu_look')." where ".$where." ".$sql,$params);    
        $list                 = pdo_fetchall("select *   from ".tablename('lianhu_look')." where ".$where." ".$sql." order by look_id desc",$params);    
        return array('list'=>$list,'count'=>$count); 
    }

}