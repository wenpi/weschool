<?php 
$in_type            = $this->judePortType();
if($in_type['type']=='teacher'){
    $title              = $in_type['info']['teacher_realname'].'-报修详情';
}else{
    $title              = $in_type['info']['student_name'].'-报修详情';
}
$class_repair       = D("repair");
$repair_id          = $_GPC['id'];
$result             = $class_repair->updateRepair($repair_id);
$reply_list         = $class_repair->getRepairReply($repair_id);
