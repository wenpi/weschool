<?php 
//im 群组
    $class_im    = C('im');
    $group_id    = $_GPC['id'];
    $db_admin_id = getDbAdminId();
    if($db_admin_id==0){
        $owner = $class_im->admin;
    }else{
        $info = D('admin')->getAdminInfop($db_admin_id);
        $owner = [
            'username' => $info['admin_name'],
            'id'       => $info['admin_id'],
            'status'   => 'online',
            'sign'     => $info['admin_name'],
            'avatar'   => $_W['attachurl'].$info['admin_img']
        ];
    }
    //分组列表
    $member_list = D('department')->getDepartmentAdminList($group_id);
    foreach ($member_list as $val) {
        $out_list[] = [
            'username'=> $val['admin_name'],
            'id'      => $val['admin_id'],
            'avatar'  => $_W['attachurl'].$val['admin_img'],
            'sign'   => $info['admin_name'],
        ];
    }
    $out = [
        'code'=>0,
        'msg'=>'',
        'data'=>[
            'owner'   => $mine,
            'list'    => $out_list
        ],
    ];
    outJson($out);