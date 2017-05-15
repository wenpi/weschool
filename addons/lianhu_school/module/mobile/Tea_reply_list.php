<?php 
$teacher_info = $this->teacher_mobile_qx();
$student_name = $teacher_info["teacher_realname"];
$page_title   = '发送记录';
$rid          = $_GPC['rid'];
$look         = $_GPC['look'];
$teacher_id   = $teacher_info['teacher_id'];
$class_sendRecord     = D('sendRecord');
$class_look           = D('look');
$class_student        = D('student');
$class_look->record_id = $rid;
//开始处理；
$look         = $look ? $look : 0;
if($look==0){
    $title = '未查看详细';
}else{
    $title = '查看详情';
}
$record_re    = $class_sendRecord->dataEdit($rid);
$student_arr  = explode(',',$record_re['student_ids']);
foreach($student_arr as $key=>$student_id){
    $student_info = $class_student->getStudentInfo($student_id);
    $look_info    = $class_look->studentHaveLook($student_id);
    if($look==1 && $look_info){
        $list[$key]['student_name'] = $student_info['student_name'];
        $list[$key]['student_img']  = $student_info['student_img'];
        $list[$key]['student_id']   = $student_id;

        $list[$key]['status']       = $look_info ? " <span class='label label-sm label-success'>已查看</span>":"未查看";
        $list[$key]['add_time']     = $look_info['add_time'] ? date("Y-m-d H:i:s",$look_info['add_time']):"未有查看时间";
        $list[$key]['look_id']      = $look_info['look_id'];
        if($look_info['images']!='0' || $look_info['content']!='0' || $look_info['voice']!='0'){
            $list[$key]['look_content'] = true;
        }
    }elseif($look==0 && !$look_info){
        $list[$key]['student_name'] = $student_info['student_name'];
        $list[$key]['student_img']  = $student_info['student_img'];
        $list[$key]['student_id']   = $student_id;
    }
}