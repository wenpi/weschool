<?php
$student_info = $this->mobile_from_find_student();
$student_name = $student_info['student_name'];
$page_title   = '我的预约';
$class_name   = $student_info['class_name'];
$list         = pdo_fetchall("select alist.* from {$table_pe}lianhu_applist  alist
                                left join ".tablename('lianhu_appointment')." ament on ament.appointment_id = alist.appointment_id  
                                where alist.student_id={$student_info['student_id']} and ament.status=1  order by addtime desc" );
foreach ($list as $key => $value) {
    if($value['content']){
            $course_id = intval($value['content']);    
            preg_match('/\w$/',$value['content'],$matchs);
            $course_name=pdo_fetchcolumn("select course_name from {$table_pe}lianhu_appointment_course where course_id=".$course_id);
            $list[$key]['my_course']=$course_name.':'.$matchs[0].'课时';
     }
}
            