<?php 
namespace myclass\ctl;

class studentPhoto extends common{
    public $student_id;

    public function __construct(){
        $this->use_class = D('studentPhoto');
    }
    //encode
    public function encodePhotos($arr){
        $out = implode(',',$arr);
        return $out;
    }
    //decode 
    public function decodePhotos($str){
        $arr = explode(',',$str);
        return $arr;
    }
    //查找该学生改学生年份
    public function getList($page=1){
        global $_W;
        $params[":student_id"] = $this->student_id;
        $params[":status"]     = 1;
        $this->use_class->each_page = 10;
        $re     = $this->use_class->getList($params,false,$page);
        $list   = $re['list'];
        $school_id  = getSchoolId();
        $sendimg    = S("system",'getSetContent',array('school_logo',$school_id));
        $sendimg    = $_W['attachurl'].$sendimg;
        if($list){
            foreach ($list as $key => $value) {
                if($value['db_admin_id']==0 && $value['do_myself']==0){
                    $value['sendname']   = '管理员';
                    $value['sendimg']    = $sendimg;
                }elseif($value['db_admin_id']){
                    $admin_info = D('admin')->dbAdminInfo($value['db_admin_id']);
                    $value['sendname']   = $admin_info['admin_name'];
                    $value["sendimg"]    = $_W['attachurl'].$admin_info['admin_img'];
                }else{
                    $student_info        = D('student')->edit(array('student_id'=>$value['student_id']));
                    $value['sendname']   = $student_info['student_name'];
                    $value["sendimg"]    = C('student')->studentImg($value['student_id']);
                }
                $list[$key] = $value;
            }
        }
        return $list;
    }

}