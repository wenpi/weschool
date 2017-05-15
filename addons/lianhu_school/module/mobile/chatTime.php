<?php 
    // 互动聊天的历史记录
    // 聊天面板
    $in_type            = $this->judePortType();
    if($in_type['type']=='student'){
        $student_name       = $in_type['info']['student_name'];
    }else{
        $student_name       = $in_type['info']['teacher_realname'];
    }

