<?php
namespace myclass\src;

class line{
    public $line_table;
    public $like_table;
    public $comment_table;
    public $school_id;
    public $day_much;
    public $day_base;

    public function __construct(){
        $this->line_table    = tablename('lianhu_send');
        $this->like_table    = tablename('lianhu_send_like');
        $this->comment_table = tablename('lianhu_send_comment');
    }
    public function setBase(){
        $school_id  = $this->school_id;
        $this->day_much =   S("system",'getSetContent',array('day_line_much',$school_id ));
        $this->day_base =   S("system",'getSetContent',array('day_line_base',$school_id ));
    }
    //教师时间段内积分数
    public function getTeacherHomeworkJiFen($teacher_id,$begin_time,$end_time){
        $list           = $this->getTeacherLineList($teacher_id,$begin_time,$end_time);
        $time_date_list = S("system",'ArrGroupAddTime',array($list));
        foreach($time_date_list as  $row){
            $count = count($row);
            if($count>$this->day_much){
                $num += $this->day_much;
            }else{
                $num += $count;
            }
        }
        
        return $num;
    }
    #获取班级圈赞的人
    public function getLineZanName($send_id){
        if(!$send_id) return false;
        $list = pdo_fetchall("select member.nickname,send_like.* from  ".$this->like_table." send_like
                              left join ".tablename('mc_members')." member  on member.uid=send_like.uid where send_id=:send_id",array(":send_id"=>$send_id) );
       
        if($list){
            $class_student =  D("student");
            $class_base    =  D("base");
            $class_teacher =  D("teacher");
           foreach ($list as $key => $value) {
               if($value['student_id'] || $value['teacher_id'] ){
                   if($value['student_id']){
                       $info     =   $class_student->getStudentInfo($value['student_id']);
                       $fanid    =   $class_base->mobileGetFanidByUid($value['uid']);
                       $relation =   $class_student->getRelation($value['student_id'],$fanid);
                       if($relation!='自己' && $relation)
                            $str.= $info['student_name']."(".$relation."),";
                       else 
                            $str.= $info['student_name'].",";
                   }elseif($value['teacher_id']){
                       $info     = $class_teacher->getTeacherInfo($value['teacher_id']);
                       $str     .= $info['teacher_realname'].",";
                   }
               }else{
                if($value['nickname'])
                        $str.= $value['nickname'].",";
               }
           }
           $str  = trim($str,',');
        }
        return $str;
    }
    #获取班级圈评论的人
    public function getLineComment($send_id){
      if(!$send_id) 
	  	return false;
      $list = pdo_fetchall("select comment.*,mc_members.nickname from ".$this->comment_table." comment
                         left join ".tableName('mc_members')." mc_members on mc_members.uid = comment.comment_uid
                         where send_id=:sid and comment_status=1",array(":sid"=>$send_id));    
      if($list){
           $class_student =  D("student");
           $class_base    =  D("base");
           $class_teacher =  D("teacher");
          foreach ($list as $key => $value) {
                   if($value['student_id']){
                       $info     =   $class_student->getStudentInfo($value['student_id']);
                       $fanid    =   $class_base->mobileGetFanidByUid($value['comment_uid']);
                       $relation =   $class_student->getRelation($value['student_id'],$fanid);
                       if($relation!='自己' && $relation)
                            $list[$key]['student_name'] = $info['student_name']."(".$relation.")";
                       else 
                            $list[$key]['student_name']  = $info['student_name'];
                   }elseif($value['teacher_id']){
                       $info     = $class_teacher->getTeacherInfo($value['teacher_id']);
                       $list[$key]['teacher_realname']  = $info['teacher_realname'];
                   }
                   if($list[$key]['teacher_realname'])
                    $list[$key]['nickname'] =  $list[$key]['teacher_realname'];
                  if($list[$key]['student_name'])
                    $list[$key]['nickname'] =  $list[$key]['student_name'];                   
               }             
      }
      return $list;
    }
    //获取教师的发送班级圈
    public function getTeacherLineList($teacher_id,$begin_time,$end_time){
        $params[":teacher_id"]  = $teacher_id;
        $params[":send_status"] = 1;
        $where  = S("fun","composeParamsToWhere",array($params) );
        $where .= " and add_time <= :end_time and add_time >= :begin_time ";
        $params[":end_time"]    = $end_time;
        $params[":begin_time"]  = $begin_time;       
        $list = pdo_fetchall("select * from ".$this->line_table." where ".$where." ",$params); 
        return $list;
    }


}