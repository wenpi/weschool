<?php 
    $in_type   = $this->judePortType();
    if($in_type['type']=='student'){
        $in['student_id']       = $in_type['info']['student_id'];
        $url = $this->createMobileUrl('home');
    }else{
        $in['teacher_id']       = $in_type['info']['teacher_id'];    
        $url = $this->createMobileUrl('teaIn');
    }
    $class_look            = D('look');
    $class_look->record_id = $_GPC['id'];
    $img_arrs              = $_POST['img_value'];
     if($img_arrs){
        foreach ($img_arrs as $key => $value) {
             $img=$this->getWechatMedia($value);
             if($img) 
                $img_in[]= $img;
             else 
                $img_in[]= $up_file_name; 
        }
    }   
   if($img_in)
        $in['images'] = serialize($img_in);
   if($_POST['voice_value'])
        $in['voice']  = $this->getWechatMedia($_POST['voice_value'],2,false);    
    if($_POST['content'])
        $in['content']= $_POST['content'];
    $in['look_type']  = $_GPC['type'];
    $class_look->addLookRecord($in);
    $this->myMessage("添加回复成功",$url,'成功');