<?php 
$in_type            = $this->judePortType();
if($in_type['type']=='teacher'){
    $title              = $in_type['info']['teacher_realname'].'-在线报修';
}else{
    $title              = $in_type['info']['student_name'].'-在线报修';
}
$class_repair       = D("repair");
$class_repair->every_page = 300;
if($in_type['type']=='student'){
    $params[":student_id"] = $in_type["info"]["student_id"];
}else{
    $params[":teacher_id"] = $in_type["info"]["teacher_id"];
}
$params[":status"]         = 1;
$result = $class_repair->getList($params,0);
$list   = $result['list'];
if($list){
    foreach ($list as $key => $value) {
        if($value['repair_img']){
            $imgs = json_decode($value['repair_img'],1);
            $list[$key]['img_list'] = $imgs;
        }
        $reply_list      = $class_repair->getRepairReply($value['repair_id']);
        $list[$key]['do_admin_name']     = $reply_list[0]['admin_name'];
        $list[$key]['do_partname']       = $reply_list[0]['department_name'];
        $list[$key]['do_add_time']       = $reply_list[0]['reply_time'];
        $list[$key]['do_status']         = $class_repair->reply_status[$reply_list[0]['status']];
    }
}