<?php
namespace myclass\ctl;

class chatMessage extends common{
    public $student_id;
    public $to_id;
    public $teacher_id;
    public $mobile_uid;

    public $split_str = '^__^';
    public $voice_str = 'voice_splice:';
    public $text_str  = 'text_splice:';
    public $img_str   = 'img_splice:';

    public function __construct(){
        $this->use_class = D('chatMessage');
    }
    public function dataAdd($arr){
        $arr['mobile_uid'] = getMemberUid();
        return $this->use_class->add($arr);
    }
    //聊天面板
    public function getLineHistoryList(){
        if($this->student_id){
            $params[":student_id"] = $this->student_id;
            $sql = " student_id=:student_id or to_student_id=:student_id ";
            $this->use_class->group_by = " to_teacher_id ,teacher_id ";
        }elseif($this->teacher_id){
            $params[":teacher_id"] = $this->teacher_id;
            $sql = " teacher_id=:teacher_id or to_teacher_id=:teacher_id ";
            $this->use_class->group_by = " to_student_id ,student_id ";
        }
        $this->use_class->each_page = 40;
        $result    = $this->use_class->getSqlList($params,$sql,1);     
        return $result['list'];
    }
    //获取历史聊天数据
    public function getHistoryList($pager,$new_id=0){
        if($this->to_id){
            if($this->student_id){
                $params[":student_id"] = $this->student_id;
                $params[":to_student_id"] = $this->to_id;
                if(!$new_id){
                    $where_str = "  (to_student_id=:to_student_id and student_id=:student_id) or (to_student_id=:student_id and student_id=:to_student_id)  ";   
                }else{
                    $where_str = "  ((to_student_id=:to_student_id and student_id=:student_id) or (to_student_id=:student_id and student_id=:to_student_id) ) and id>:id   ";
                    $params[":id"] = $new_id;   
                }

            }elseif($this->teacher_id){
                $params[":to_teacher_id"] = $this->to_id;
                $params[":teacher_id"] = $this->teacher_id;
                if(!$new_id){
                    $where_str = " ( to_teacher_id=:to_teacher_id and teacher_id=:teacher_id ) or (to_teacher_id=:teacher_id and teacher_id=:to_teacher_id )  ";   
                }else{
                    $where_str = "  (( to_teacher_id=:to_teacher_id and teacher_id=:teacher_id ) or (to_teacher_id=:teacher_id and teacher_id=:to_teacher_id)) and id>:id   ";
                    $params[":id"] = $new_id;   
                }
            }
        }else{
            $params[":teacher_id"] = $this->teacher_id;
            $params[":student_id"] = $this->student_id;
            if(!$new_id){
                $where_str = " ( student_id=:student_id and to_teacher_id=:teacher_id ) or ( teacher_id=:teacher_id and to_student_id=:student_id )   ";   
            }else{
                $where_str = "( ( student_id=:student_id and to_teacher_id=:teacher_id ) or ( teacher_id=:teacher_id and to_student_id=:student_id ) ) and id>:id   ";
                $params[":id"] = $new_id;   
            }
        }
        $this->use_class->each_page = 5;
        $result    = $this->use_class->getSqlList($params,$where_str,$pager);     
        $list      = krsort($result['list']);   
        return $result['list'];
    }
    //解析聊天记录赋予称谓等
    public function decodeLine($result,$main){
        $result['display_content'] = $this->decodeLineContent($result['content']);
         if( ($main=='teacher' && $result['teacher_id']==$this->teacher_id) || ($main=='student' && $result['student_id']==$this->student_id) ){
            $result['type'] = 'main';
        }else{
            $result['type'] = 'other';
        }       
        if($result['student_id']){
            $fanid = D('base')->mobileGetFanidByUid($result['mobile_uid']);
            $result['relation'] = D('student')->getRelation($result['student_id'],$fanid);
        }
        if($result['to_student_id']){
            
        }
        return $result;
    }
    //解析聊天内容
    // voice_splice:http://xxx.xxx/v.mp3 ^__^ text_splice:你好boy ^__^ img_splice:http:/asd.png
    public function decodeLineContent($content){
        $arr = explode($this->split_str,$content);
        foreach ($arr as $key => $value) {
            if(stristr($value,$this->voice_str)){
                $out['voice'] = str_ireplace($this->voice_str,'',$value);
            }elseif(stristr($value,$this->text_str)){
                $out['text']  = str_ireplace($this->text_str,'',$value);
            }elseif(stristr($value,$this->img_str)){
                $out['img']   = str_ireplace($this->img_str,'',$value);
            }
        }
        return $out;
    }
    //增加内容
    public function addLineContent(){

    }




}