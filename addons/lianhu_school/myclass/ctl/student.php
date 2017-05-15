<?php 
namespace myclass\ctl;

class student extends common {
    public  $class_student;
    public  $student_id;
    public  $student_name;

    public function __construct(){ 
        $this->class_student = D('student');
        $this->setGlobal();
    }
    
    //组合成查询语句
    public function composeFindSql(){
        $re = $this->searchStudent();
        if($re['count']){
            foreach ($re['list'] as $key => $value) {
                $student_id_arr[$key]=$value['student_id'];
            }
            $student_id_str  = implode(",",$student_id_arr);
            $where           = " student_id in (".$student_id_str.") ";
            return $where;
        }else{
            return false;
        }
    }
    //学生头像
    public function studentImg($s_id){
        global $_W;
        if($s_id){
            $img = pdo_fetchcolumn("select student_img from ".$this->class_student->table." where student_id=:sid ",array(":sid"=>$s_id) );
        }
        if(!$img){
           $img =  S("system",'getSetContent',array('school_logo',getSchoolId()));
        }
        return $_W['attachurl'].$img;
    }
    //根据学生名返回出可能得student_ids 
    public function searchStudent(){
        $this->class_student->each_page = 1000;
        $where[":student_name"]     = $this->student_name;
        $re = $this->class_student->getList($where);
        return $re;
    }
    //给学生添加副班级
    public function addFuClass($fu_class_ids){
        if($fu_class_ids){
            $class_classStudent = D('classStudent');
            $in['student_id'] 	= $this->student_id;
            $class_classStudent->delete($in);       
            foreach ($fu_class_ids as $key => $value) {
                $in['class_id']   = $value;
                $class_classStudent->dataAdd($in);
            }   
        }
    }
    //获取学生的班级class_id
    public function getStudentClass(){
        $student_id    = $this->student_id;
        $student_info  = $this->class_student->getStudentInfo($student_id);
        $class_list[0] = $student_info['class_id'];
        $class_classStudent         = D('classStudent');
        $where[":student_id"] 		= $student_id; 
        $find_re 			        = $class_classStudent->dataList($where);
        if($find_re['count']>0){
            foreach ($find_re['list'] as $key => $value) {
                $class_list[++$key] = $value['class_id'];
            }
        }
        return $class_list;
    }
    //schoolid and activerfid find
    public function findStudentBySidArfid($school_id,$ativerfid){
        $params["school_id"]   = $school_id;
        $params["active_rfid"] = $ativerfid;
        $re                    = $this->class_student->edit($params);
        return $re;
    }
    //学生有没有绑定
    public function checkStudentHaveBd($student_id){
        $student_info  = $this->class_student->getStudentInfo($student_id);
        $openids       = $this->class_student->returnEfficeOpenid($student_info);      
        if($openids['f_openid']=='sms'){
            $out['sms'] = true;
            $out['bd']  = false;
        }elseif( !$openids['f_openid']  ){
            $out['bd']  = false;
        }else{
            $out['bd']      = true;
            $out['openids'] = $openids;
        }
        return $out;
    }
    //学生卡查找出学生
    public function cardFindStudent($rfid){
        $sql             = " status = 1 and  ( rfid = :rfid or rfid1=:rfid or rfid2=:rfid ) ";
        $params[":rfid"] = $rfid;
        $re              = $this->class_student->getSqlList($params,$sql);
        $result          = $re['list'][0];
        return $result;
    }   
    


}