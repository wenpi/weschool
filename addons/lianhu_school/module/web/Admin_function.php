<?php
 #只有管理员可以进入
 $this->teacher_qx();
 
 $list=pdo_fetchall("select * from {$table_pe}modules_bindings where module in ('lianhu_school','lianhu_school_display')   ");
 if($ac=='edit'){
    $id=$_GPC['eeid'];    
    $result=pdo_fetch("select * from {$table_pe}modules_bindings where eid=:eid ",array(':eid'=>$id));
    if($_GPC['change']){
        pdo_update('modules_bindings',array('module'=>$_GPC['change']),array('eid'=>$id));
        message('更新成功',$this->createWebUrl('admin_function'),'success');
    }
 }
 if($ac=='new'){
        pdo_update('modules_bindings',array('module'=>'lianhu_school'),array('module'=>'lianhu_school_display'));
        message('还原成功',$this->createWebUrl('admin_function'),'success');   
 }
 
 
