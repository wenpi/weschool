<?php 
$in_type            = $this->judePortType();
if($in_type['type']=='teacher'){
    $student_name = $in_type['info']['teacher_realname'];
}else{
    $student_name = $in_type['info']['student_name'];
    $grade_id     = $in_type['info']['grade_id'];
}

$page_title       = '课堂在线';
$class_eduClass   = D('eduVideoClass'); 
$cclass_eduClass  = C('eduVideoClass'); 
$params[":status"]= 1;
if($_GPC['cid']){
    $page_title             = $class_eduClass->className($_GPC['cid']);
    $params[":pid"]         = $_GPC['cid'];
    $params[":class_level"] = 2;
    $video_class_list       = $class_eduClass->dataList($params);
    $list                   = $video_class_list['list'];
}else{
    $params[":status"]      = 1;
    $params[":class_level"] = 1;
    if($in_type['type']=='student'){
        $params[":limit_display"] = array("!=",2);
    }
    $video_class_list       = $class_eduClass->dataList($params);
    $list                   = $video_class_list['list'];   

    foreach ($list as $key => $value) {
        if($value['limit_display']==1 && $in_type['type']=='student' ){
            $arr = explode(',',$value['limit_content']);
            if(!in_array($grade_id,$arr)){
                unset($list[$key]);
                continue;
            }
        }
        $params[":class_level"] = 2;
        $params[":pid"]         = $value['class_id'];
        $re                     = $class_eduClass->dataList($params);
        $list[$key]['sec']      = $re['list'];
     }
}
 