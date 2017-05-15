<?php 
$in_type    = $this->judePortType();
if(empty($in_type)){
      $this->myMessage('您还未绑定',$this->createMobileUrl('home'),'错误');
}
$now_class_id   = getClassId();
if($in_type['type'] !='teacher'){
    $result       = $this->mobile_from_find_student();
    $student_name = $result['student_name'];
    $class_id     = $now_class_id;
    $in['student_id'] = $result['student_id'];
}else{
    $class_id           = $_GPC['class_id'];
    $in['student_send'] = 0;
    $in['teacher_id']   = $in_type['info']['teacher_id'];
    $student_name       = $in_type['info']['teacher_realname'];
}
$page_title = '班级圈发布';

if($_POST['submit']){
    if($_POST['content']){
        #解析图片
        $img_arrs = $_POST['img_value'];
        if($img_arrs){
            foreach ($img_arrs as $key => $value) {
                    $img_in[] = $this->getWechatMedia($value); 
            }
        }
        $in['uniacid']      = $_W['uniacid'];
        $in['school_id']    = getSchoolId();
        $in['class_id']     = $class_id;
        $in['send_uid']     = $uid;
        $in['send_content'] = $_POST['content'];
        $in['sendvideo']    = $_POST['hdvideo'] ? $_POST['hdvideo']:'';
        
        if($img_in){
            $in['send_image']   = serialize($img_in);
        }
        if($this->getSchoolLineStatus()==0 && $in_type['type'] !='teacher'){
            $in['send_status']  = 2;
        }else{
            $in['send_status']  = 1;
        }
        $in['add_time']         = time();
        pdo_insert('lianhu_send',$in);
        if($in_type['type'] !='teacher')
               header("Location:".$this->createMobileUrl('line'));
        else 
            header("Location:".$this->createMobileUrl('line',array('class_id'=>$class_id) ));
    }else{
         $this->myMessage("没有分享内容", $this->createMobileUrl('line',array('class_id'=>$class_id)),'错误');
    }
}
$video = S("system",'getSetContent',array('line_video_status',$this->school_info['school_id']));
if($video == 0){
    $video='no';
}