<?php 
$in_type            = $this->judePortType();
if($in_type['type']=='teacher'){
    $student_name = $in_type['info']['teacher_realname'];
}else{
    $student_name = $in_type['info']['student_name'];
}
$class_eduClass   = D('eduVideoClass'); 
$class_eduList    = D('eduVideoList'); 
$result           = $class_eduClass->className($_GPC['cid']);
$page_title       = $result;
$params[":class_id"] = $_GPC['cid'];
$params[":status"]   = 1;
$result              = $class_eduList->dataList($params);
$list = $result['list'];   
 