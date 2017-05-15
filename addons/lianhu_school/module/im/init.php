<?php 
//im 初始化
    $class_im    = C('im');
    $db_admin_id = getDbAdminId();
    if($db_admin_id==0){
        $mine = $class_im->admin;
    }else{
        $info = D('admin')->getAdminInfop($db_admin_id);
        $mine = [
            'username'=>$info['admin_name'],
            'id'=>$info['admin_id'],
            'status'=>'online',
            'sign'=>$info['admin_name'],
            'avatar'=>$_W['attachurl'].$info['admin_img']
        ];
    }
    //分组列表
    $list = $class_im->getAdminList();
    foreach ($list as $key=> $value) {
        $out_list    = [];
        $member_list = $value['member_list'];
        foreach ($member_list as $val) {
            $out_list[] = [
                'username'=> $val['admin_name'],
                'id'      => $val['admin_id'],
                'avatar'  => $_W['attachurl'].$val['admin_img'],
                 'sign'   => $info['admin_name'],
            ];
        }
        $friend[$key] = [
            'groupname'  => $value['department_name'],
            'id'         => $value['department_id'],
            'online'     => $value['department_id'],
            'list'       => $out_list
        ];
        $group[$key] = [
            'groupname'=>$value['department_name'],
            'id'       =>$value['department_id'],
            "avatar"    =>"http://tp2.sinaimg.cn/2211874245/180/40050524279/0"
        ];
    }
    $out = [
        'code'=>0,
        'msg'=>'',
        'data'=>[
            'mine'   => $mine,
            'friend' => $friend,
            'group'  => $group
        ],
    ];
    outJson($out);