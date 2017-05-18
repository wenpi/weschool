<?php 
$in_type            = $this->judePortType();
if($in_type['type']=='student'){
    $student_name       = "学生用户：".$in_type['info']['student_name'];
}else{
    $student_name       = "教师用户：".$in_type['info']['teacher_realname'];
}

$token              = $this->class_base->tokenForm();
$class_repair       = D("repair");
$class_department   = D("department");
$repair_list        = $class_department->getDeList(array(":repair_fix"=>1));
$title              = '教师请假';

if($_GPC['repair_title'] && $_GPC['token'] == $_COOKIE['form_token'] ){
    $in['repair_title']     = $_GPC['repair_title'];
    $in['repair_content']   = $_GPC['repair_content'];
    $img_arrs               = $_POST['img_value'];
     if($img_arrs){
        foreach ($img_arrs as $key => $value) {
             $img = $this->getWechatMedia($value);
             if($img){
                $img_in[] = $img;
             }else{
                $img_in[] = $up_file_name; 
             } 
        }
    }
   if($img_in){
        $in['repair_img'] = json_encode($img_in);
   }
   $in['department_id']   = $_GPC['department_id'];
   $id = $class_repair->addRepair($in);
   //发送新增报修的通知给主管
   $url = $_W['siteroot'].$this->createMobileUrl("SchoolAdminFixInfo",array("id"=>$id));
   C("repair")->class_base = $this->class_base;
   $mu_info = C("repair")->sendMsg($in['repair_title'],$in['repair_content'],$student_name);
   //获取部门主管
   $admin_list = D('department')->getDepartMainAdmin($in['department_id']);
   if($admin_list){
       $list = $admin_list['list'];
       foreach ($list as $key => $value) {
        if($value['teacher_id']){
            $openid = D('teacher')->getTeacherOpenid($value['teacher_id']);
        }elseif($value['school_admin_id']){
            $openid = D('schoolAdmin')->getOpenid($value['school_admin_id']);       
        }
        //执行发送
        $re = $this->class_base->sendTplNotice($openid,$mu_info['mu_id'],$mu_info['data'],$url);
       }
   }

   $this->myMessage("添加请假成功",$this->createMobileUrl('TeacherLeave'),'成功');
}
