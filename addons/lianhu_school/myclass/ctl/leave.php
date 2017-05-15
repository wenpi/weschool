<?php 
namespace myclass\ctl;
class leave extends common{
    public $leave_id;
    public $leave_type = array(
        1=>'事假',
        2=>'病假',
        3=>'其他',
    );

    public function __construct(){
        $this->use_class = D('leave');
    }
    public function add($in){
        $in_data = getNewUpdateData($in,$this->use_class);
        return $this->use_class->add($in_data);
    }
    //给学生发送请假处理消息
    public function sendLeaveMsg(){
		global $_W;
        $leave_id     = $this->leave_id;
		$leave_result = $this->use_class->edit(array("leave_id"=>$leave_id));
        
        if($leave_result){
            $cclass_student = C('student');
            $class_msg      = D('msg');
            $class_msg->in_class_base = $this->in_class_base;
            $stu_result     = $cclass_student->class_student->edit(array('student_id'=>$leave_result['student_id']));
    		$class_name     = C('classes')->class_classes->className($leave_result['class_id']);
		    $admin_name     = D('teacher')->teacherName($leave_result['teacher_id']);
		    if(!$admin_name){
                $admin_name = '管理员';
            }
		    $openids 		= $cclass_student->class_student->returnEfficeOpenid($stu_result,3);	
            if($leave_result['leave_status']==2){
                $word='同意了此次请假'."[".date("Y-m-d",$leave_result['time_date_begin'])."--".date("Y-m-d",$leave_result['time_date_begin'])."]";
            }else{
                $word='不同意此次请假'."[".date("Y-m-d",$leave_result['time_date_begin'])."--".date("Y-m-d",$leave_result['time_date_begin'])."]";
            }
            $this->in_class_base->student_id = $leave_result['student_id'];
            foreach ($openids as $key => $value) {
                if($value){
                    $first_end = $cclass_student->class_student->rebackHeadEndTextByRelation($value,$stu_result['student_id']);
                    $first 	   = $first_end['first'].'您的请假申请，老师回复了';
                    $key2      = $admin_name;
                    $key4      = $word;
                    $remark    = '备注：'.$leave_result['teacher_text'].'；请假理由：'.$leave_result['leave_reason'];
                    $mu_info   = $class_msg->decodeMsg1($first,$class_name,$key2,$key4 ,$remark );
                    $this->in_class_base->sendTplNotice($value,$mu_info['mu_id'],$mu_info['data'],$url);         
                }
            } 
        }
    }    


}