<?php
    $time       = time();
    $begin      = $_GPC['begin_time'] ? $_GPC['begin_time'] : date("Y-m-d H:i",time()-3600*24);
    $end        = $_GPC['end_time']   ? $_GPC['end_time'] : date("Y-m-d H:i",time());
    $begin_time = strtotime($begin);
    $end_time   = strtotime($end);
    $params[":add_time"]     = $begin_time;
    $where[]                 = " add_time >= :add_time ";
    $params[":add_time_end"] = $end_time;
    $where[]                 = " add_time <= :add_time_end ";    
    $where_str   = implode(" and ",$where);
    $class_card  = D('card');
    $result      = $class_card->getAllCardList($where_str,$params,1,true);
    $list        = $result['list'];
    
