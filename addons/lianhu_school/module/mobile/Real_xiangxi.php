<?php 
$result        = $this->mobile_from_find_student();
$student_name  = $result['student_name']; 
$page_title    = '学生资料';
$class_student = D("student"); 
$my_relation   = $class_student->getRelation($result['student_id'],$result['in_fanid']);
#更新
if($_GPC['img_value'] || $_GPC['parent_phone'] || $_GPC['parent_name']){
    $up['address']       = $_GPC['address'];
    $up['student_link']  = $_GPC['student_link'];
    $up['parent_name']   = $_GPC['parent_name'];
    $up['parent_phone']  = $_GPC['parent_phone'];
    $relation            = $_GPC['relation'];
    if($my_relation != $relation){
        $find_result = $class_student->validStduentRelation($result['student_id'],$relation);
        if($find_result['errcode']==1){
                $this->myMessage("更新失败此关系已经绑定！",$this->createMobileUrl('real_xiangxi'),'错误');
        }
        if($my_relation){
            $class_student->updateRelation($result['student_id'],$result['in_fanid'],$relation);
        }else{
            $class_student->insertStudentRelation($result['student_id'],$relation,$result['in_fanid']);
        }
    }
    if( ! strstr($_GPC['img_value'],'images') ){
        $up['student_img'] = $this->getWechatMedia($_GPC['img_value'],1,false);
    }
    $class_student->edit(array('student_id'=>$result['student_id']),$up);
    $this->myMessage("更新成功",$this->createMobileUrl('real_xiangxi'),'成功');
}