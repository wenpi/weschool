<?php 
namespace myclass\ctl;

class im extends common{
    public $school_id;
    //admin
    public $admin = [
        'username'=>'总管理员',
        'id'=>'1000000',
        'status'=>'online',
        'sign'=>'总管理员无',
        'avatar'=>'http://zl.loveli.name/addons/lianhu_school//admin/layui/css/modules/layim/skin/1.jpg'
    ];

    public function __construct(){
        $this->school_id = getSchoolId();
    }
    //部门=》好友
    //只获取部门人员
    //所以只要加入部门人员合理即可
    public function getAdminList(){
        $class_department  = D('department');
        $list              = $class_department->getDeList($params);
        if($list){
            foreach ($list as $key => $value) {
                $list[$key]['member_list'] = $class_department->getDepartmentAdminList($value['department_id']);

            }
        }
        return $list;
    }   


}