<?php
    $teacher_info          = $this->teacher_mobile_qx();
    $student_name          = $teacher_info['teacher_realname'];
    $page_title            = '消息发送记录';
    $class_sendRecord      = D('sendRecord');
    $class_look            = D('look');
    $pager                 = $_GPC['pager'];
    $params[":record_type"]= 4;
    $params[":mobile_uid"] = getMemberUid();
    $result                = $class_sendRecord->dataList($params,$pager);
    $list                  = $result['list'];
     if($ac=='ajax'){
         if($list){
            $template = $this->selectTemplate("Tea_msgHistory_ajax");
            include $this->template($template);
         }else{
             echo 'done';
         }
         exit();
     }
