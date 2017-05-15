<?php 
    $school_admin  = D('admin')->mobileValidSchoolAdmin();
    if(!$school_admin){
        header("Location:".$this->createMobileUrl("school_bangding"));
    }
    $title = $page_title = '视频编辑';
    $video_id = $_GPC['id'];
    if($video_id){
        $result = D('video')->edit(array("video_id"=>$video_id));
        if($_GPC['submit']){
            $in['video_name']   = $_GPC['video_name'];
            $in['begin_time']   = $_GPC['begin_time'];
            $in['end_time']     = $_GPC['end_time'];
            $in['status']       = $_GPC['status'];
            C('video')->use_class->edit(array('video_id'=>$video_id),$in);
            $this->myMessage('修改成功',$this->createMobileUrl('schoolAdminVideo'),'成功');	
        }

    }