<?php 
    $this->checkAdminWeb();
    $admin_result = D('admin')->judeAdminType();
    $left_top     = 'school_base_set';
    $left_nav     = 'teacherTag';
    $title        = '教师标签';  
    $sidebar_list = array(
        array('fun_str'=>'adminindex','fun_name'=>'系统首页'),
        array('fun_str'=>'teacherTag','fun_name'=>'教师标签'),
    );
    if($ac=='new' && $_GPC['tag_name']){
        $in['tag_name'] = $_GPC['tag_name'];
        C('teacherTag')->use_class->add($in);
        $out_msg = '新增标签【'.$in['tag_name'].'】成功';
    }
    if($ac=='delete' && $_GPC['id']){
        $where['tag_id'] = $_GPC['id'];
        $in = C('teacherTag')->use_class->edit($where);
        C('teacherTag')->use_class->delete($where);
        $out_msg = '删除标签【'.$in['tag_name'].'】成功';
    }
    if($ac=='edit' && $_GPC['id'] && $_GPC['change_val']){
        $where['tag_id'] = $_GPC['id'];
        $up['tag_name']  = $_GPC['change_val'];
        $re = C('teacherTag')->use_class->edit($where,$up);
        $out_msg = array('errcode'=>0,'msg'=>'更新成功');
        outJson($out_msg);
    }
    $re     = C('teacherTag')->getList();
    $list   = $re['list'];
    include $this->template('../admin/TeacherTag');
    exit();
