<?php 
//学生扫码教师签到
$student_re     =  $this->mobile_from_find_student();
$student_name   =  $student_re['student_name'];
$page_title     = '扫码签到';

$params["activity_id"] = $_GPC['id'];
$result = D("qdActivity")->edit($params);
if($result  && $result['endtime']>TIMESTAMP ){
    $student_ids  = explode(',',$result['student_ids']);
    $class_ids    = explode(',',$result['class_ids']);
    if(!in_array($student_re['student_id'],$student_ids)){
        $this->myMessage("您无扫码权限",$this->createMobileUrl("home"),"错误");
    }
    $where["activity_id"] = $result['activity_id'];
    $where["student_id"]  = $student_re['student_id'];
    D("qdPerson")->delete($where,true);
    $where['mobile_uid']  = getMemberUid();
    $where["class_id"]    = $student_re['class_id'];
    D("qdPerson")->add($where);
    $this->myMessage("签到成功",$this->createMobileUrl("scanTeaList"),"成功");
}elseif($result['endtime']<=TIMESTAMP ){
    $this->myMessage("该次签到已经过期，无法签到",$this->createMobileUrl("home"),"错误");
}
