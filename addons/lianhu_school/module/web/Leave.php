<?php 
    $this->checkAdminWeb();
    $admin_result = D('admin')->judeAdminType();
    $left_top     = 'class_manage';
    $left_nav     = 'leave';
    $title        = '请假管理';  
    $sidebar_list = array(
        array('fun_str'=>'','fun_name'=>'班级管理'),
        array('fun_str'=>'leave','fun_name'=>'请假管理'),
    );
    $top_action = array();
    #班主任权限
    $admin          = $this->teacher_qx('no');
    $class_list     = $this->teacher_main();
    $grades         = $this->grade_class();
    $class_classes  = D('classes'); 
    $class_grade    = D('grade'); 
    $cclass_student = C('student'); 
    $cclass_leave   = C('leave');
    if($admin!='teacher'){
        $class_list = $class_classes->getThisAdminClassList();
    }
    #组合class_id
    foreach ($class_list as $key => $value) {
        $class_ids[$key] = $value['class_id'];
    }
    $class_id_str = implode(",",$class_ids);
    if($ac == 'list'){
        $where        = " class_id in (".$class_id_str.")  and school_id=:a ";
        $params[':a'] = getSchoolId();

        if($_GPC['class_id']){
            $where          .= " and class_id=:cid";
            $params[':cid']  = $_GPC['class_id'];
        }
        if($_GPC['student_name']){
            $cclass_student->student_name = $_GPC['student_name'];
            $out_where                    = $cclass_student->composeFindSql();
            if($out_where){
                $where          .= " and ".$out_where;
            }
        }
        if($_GPC['status']){
            $where                    .= " and leave_status=:leave_status";
            $params[':leave_status']   = $_GPC['status'];
        }    
        $total  = pdo_fetchcolumn("select count(add_time) from ".$table_pe."lianhu_leave where {$where} ",$params);
        $list   = pdo_fetchall("select * from ".$table_pe."lianhu_leave where {$where} order by add_time desc {$sql_limit}",$params);
        $pager  = pagination($total,$page,$pagesize);
    }
    if($ac=='edit'){
        if($_GPC['teacher_text']){
                $up['teacher_text'] =$_GPC['teacher_text'];
            if($_GPC['submit']=='准许'){
                $up['leave_status'] =2;
            }else{
                $up['leave_status'] =3;
            } 
        }
        $result = $cclass_leave->use_class->edit(array("leave_id"=>$_GPC['id']),$up);
        if($up){
            $cclass_leave->leave_id      = $_GPC['id'];
            $cclass_leave->in_class_base = $this->class_base; 
            $cclass_leave->sendLeaveMsg();
            $this->myMessage("处理成功",$this->createWebUrl('leave'),'成功');
        }
    }
    include $this->template('../admin/web_leave');
    exit();

