<?php
$student_info = $this->mobile_from_find_student();
$student_name = $student_info['student_name'];
$page_title   = '预约活动';
$token        = $this->class_base->tokenForm();
$class_name   = $student_info['class_name'];
$line_id      = intval($op);
$where        = " appointment_type_limit=0 || (appointment_type_limit=1 && appointment_grade_class like '%{$student_info['grade_id']}%' ) || (appointment_type_limit=2 && appointment_grade_class like '%{$student_info['class_id']}%' ) ";
$result       = pdo_fetch("select * from {$table_pe}lianhu_appointment where ({$where} ) and appointment_id=:id ",array(':id'=>$op));
if(empty($result)){
	$this->myMessage('没有找到此预约','','错误');
}
$where_list=" student_id={$student_info['student_id']} and appointment_id={$result['appointment_id']} ";
$app_course_list=unserialize($result['appointment_mutex']);
$course_id_str=implode(',',$app_course_list);
if(!$course_id_str){
	$this->myMessage('没有设置具体的预约活动','','错误');
}
$course_list=pdo_fetchall("select * from {$table_pe}lianhu_appointment_course where course_id in({$course_id_str}) and status=1");

foreach ($course_list as $key => $value) {
        $course_list[$key]['time']      = unserialize($value['course_time']);
        $course_list[$key]['acount']    = pdo_fetchcolumn("select count(*) num from {$table_pe}lianhu_applist where status!=2 and 
        appointment_id=:appointment_id and content=:content  ",array(':appointment_id'=>$result['appointment_id'],':content'=>$value['course_id'].'a') );
        $course_list[$key]['bcount']    = pdo_fetchcolumn("select count(*) num from {$table_pe}lianhu_applist where status!=2 and 
        appointment_id=:appointment_id and content=:content  ",array(':appointment_id'=>$result['appointment_id'],':content'=>$value['course_id'].'b') );
}
$you_result = pdo_fetch("select * from {$table_pe}lianhu_applist where {$where_list} ");
#查找此预约的限制，报名情况等
if($_POST['submit'] && !$you_result ){
     $in['appointment_id']  = $_POST['appointment_id'];
     $in['student_id']      = $student_info['student_id'];
     $in['addtime']         = time();
     $course_ids            = $_POST['course'];
     foreach ($course_ids as $key => $value) {
         $course_re=pdo_fetch("select * from {$table_pe}lianhu_appointment_course where course_id=:id and status=1",array(':id'=>$key));
         if($value=='a'){
             $acount=pdo_fetchcolumn("select count(*) num from {$table_pe}lianhu_applist where status!=2 and 
                appointment_id=:appointment_id and content=:content  ",array(':appointment_id'=>$result['appointment_id'],':content'=>$key.'a') );    
            $in['content']=$key.'a';
         }else{
              $bcount=pdo_fetchcolumn("select count(*) num from {$table_pe}lianhu_applist where status!=2 and 
                appointment_id=:appointment_id and content=:content  ",array(':appointment_id'=>$result['appointment_id'],':content'=>$key.'b') );    
            $in['content']=$key.'b';
         }
         if($acount>=$course_re['course_num'] ||  $bcount>=$course_re['course_num']){
             $this->myMessage($course_re['course_name'].'预约已满，请刷新','','error');
         }
        $in['school_id'] = $student_info['school_id'];
        $in['uniacid']   = $student_info['uniacid'];
        pdo_insert('lianhu_applist',$in);
        $re = true;
     }
     if($re){
         $new_appointment_join_num=$result['appointment_join_num']+1;
         pdo_update('lianhu_appointment',array('appointment_join_num'=>$new_appointment_join_num),array('appointment_id'=>$result['appointment_id']));
         $this->myMessage('预约成功',$this->createMobileUrl('applist_result'),'成功');
     }
     if(!$course_ids){
         $this->myMessage('您没有选择具体的活动',$this->createMobileUrl('appointment_article',array('op'=>$_POST['appointment_id']) ),'错误');
     }
}


