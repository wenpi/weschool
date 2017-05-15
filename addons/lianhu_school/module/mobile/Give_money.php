<?php 
$result         = $this->mobile_from_find_student();
$student_name   = $result['student_name'];
$page_title     = '缴费';
if($_GPC['limit_module']){
    $info        = "该项目需要缴费才能使用";
    $class_money = new money($_GPC['limit_module']);
    $list = $class_money->get_money_limit(true);
    foreach ($list as $key => $value) {
        $out_list[$num]['name'] 	    = $value['limit_name'];
        $out_list[$num]['money'] 	    = $value['limit_much'];
        $out_list[$num]['limit_id']     = $value['limit_id'];
        $out_list[$num]['limit_module'] = $value['limit_module'];
        $num++;
    }
    $arr = $out_list;
}else{
    $info = '待缴费列表';
    $arr  = $this->MoneyGive(true);
}




