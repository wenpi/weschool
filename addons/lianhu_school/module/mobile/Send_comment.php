<?php 
	$school_info    = $this->school_info;
    $student_info   = $this->mobile_from_find_student();
    $line_type      = $school_info['line_type'];
    $op             = $_GPC['op'] ? $_GPC['op']:'list';
    if($line_type){
        $line_type_cfg=explode("||", $line_type );
        foreach ($line_type_cfg as $key => $value) {
            if($value){
                $line_types[]=$value;
            }
        }
        $_W['line_type']=$line_types;
    }
    $send_id       = $_GPC['send_id'];
    $where[":sid"] = $send_id;
    $row           = pdo_fetch("select {$table_pe}lianhu_send.*,mc_members.nickname,mc_members.avatar from {$table_pe}lianhu_send left join ".tableName('mc_members')." mc_members 
                                on mc_members.uid={$table_pe}lianhu_send.send_uid where send_status=1 and send_id=:sid ",$where);
    $list          = pdo_fetchall("select {$table_pe}lianhu_send_comment.*,mc_members.nickname from {$table_pe}lianhu_send_comment 
                                    left join ".tableName('mc_members')." mc_members on mc_members.uid={$table_pe}lianhu_send_comment.comment_uid
                                    where send_id=:sid and comment_status=1",$where);   
    if($op=='post' && $_GPC['comment_text'] ){
        $in['send_id']          =$send_id;
        $in['comment_uid']      =$uid;
        $in['comment_text']     =$_GPC['comment_text'];
        $in['add_time']         =time();
        pdo_insert('lianhu_send_comment',$in);
        $this->myMessage('评论成功',$this->createMobileUrl('send_comment',array('send_id'=>$send_id)),'成功');
    }
    