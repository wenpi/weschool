<?php 
if($_GPC['student_name']){
    $class_name   = $_GPC['class_name'];
    $student_name = $_GPC['student_name'];    
    if(!$student_name )
        $this->myMessage("请填写学生名字",'','错误');
    if($class_name){
        $class_result = pdo_fetchall("select * from {$table_pe}lianhu_class where class_name=:class_name  and status =1 and uniacid =:uniacid ",array(":class_name"=>$class_name ,':uniacid'=>$_W['uniacid']) );
        if(!$class_result)
                $this->myMessage("没有找到班级信息",'','错误');
        foreach ($class_result as $key => $value) {
                $class_ids[]=$value['class_id'];
        }
        $class_id_str = implode(',',$class_ids);        
        $where = " and   class_id in ({$class_id_str}) ";
    }
     $student_result = pdo_fetchall("select * from {$table_pe}lianhu_student where  student_name like :student_name and status=1 {$where}  and uniacid =:uniacid ",array(":student_name"=>$student_name."%",':uniacid'=>$_W['uniacid']) );
     if(!$student_result){
        $this->myMessage("没有找到学生信息",'','错误');  
     }else {
         $class_school = D('school');
         foreach ($student_result as $key => $value) {
             $class_school->school_id = $value['school_id'];
             $school_info = $class_school->getSchoolInfo();
             $out_list[$key]['school_name'] = $school_info['school_name'];
             $out_list[$key]['xuehao']      = $value['xuehao'];
             $out_list[$key]['passport']    = $value['student_passport'];
         }
         $template = $this->selectTemplate("Xuehao_list");
         include $this->template($template);	
          exit();         
      }
}