<?php 
namespace myclass\src;
 
class teacher extends common{ 
    public $tablename;
    public $teacher_data=array(
            array('key'=>'teacher_realname','name'=>'教师姓名'),
            array('key'=>'teacher_telphone','name'=>'电话'),
            array('key'=>'teacher_email','name'=>'教师邮箱'),
            array('key'=>'rfid','name'=>'ID卡'),
            array('key'=>'teacher_tag','name'=>'教师标签【多个标签以英文逗号分隔】'),
    );

    public function __construct(){
        $this->tablename = tablename('lianhu_teacher');
        $this->setTable('lianhu_teacher');
        $this->setGlobal();      
    }

    public function add($arr){
        global $_W;
        $add_id = parent::add($arr);
        $middle_teacher = M('teacher');
        if($middle_teacher){
            $in['teacher_img']   = $_W['attachurl'].$arr['teacher_img'];
            $in['weixin_code']   = $_W['attachurl'].$arr['weixin_code'];
            $in['teacher_name']  = $arr['teacher_realname'];
            $in['school_id']     = $this->school_id;
            $teacher_info        = $this->edit(array("teacher_id"=>$add_id));
            $admin_info          = D('admin')->dbAdminInfo($teacher_info['admin_id']);
            $in['passport']      = $admin_info['passport'];
            $in['password']      = $admin_info['password'];
            $in['salt']          = $admin_info['salt'];

            //教师班级
            $middle_teacherClass = M('teacherClass'); 
            $class_ids           = explode(',',$arr['teacher_other_power']);
            if($class_ids){
                $middle_teacherClass->action($add_id,$class_ids);
            }
            //教师课程
            $middle_teacherCourse = M('teacherCourse');
            $course_id            = explode(',',$arr['course_id']);
            if($course_id){
                $middle_teacherCourse->action($add_id,$course_id);
            }

            $middle_teacher->action($add_id,$in);
        }
        return $add_id;
    }
    
    public function edit($where,$up=false){
        global $_W;
        $result = parent::edit($where,$up);
        $middle_teacher = M('teacher');
        if($middle_teacher && $up && $result){
            $in['teacher_img']  = $_W['attachurl'].$result['teacher_img'];
            $in['teacher_name'] = $result['teacher_realname'];
            $in['weixin_code']  = $_W['attachurl'].$result['weixin_code'];
            if($result['uid']){
                $in['openid'] = S('base','uid2openid',array($result['uid']));
            }else{
                $in['openid'] = 'N';
            }
            //教师班级
            $middle_teacherClass = M('teacherClass'); 
            $class_ids           = explode(',',$result['teacher_other_power']);
            if($class_ids){
                $middle_teacherClass->action($result['teacher_id'],$class_ids);
            }       
            //教师课程
            $middle_teacherCourse = M('teacherCourse');
            $course_id            = explode(',',$result['course_id']);
            if($course_id){
                $middle_teacherCourse->action($result['teacher_id'],$course_id);
            }
            $admin_info          = D('admin')->dbAdminInfo($result['admin_id']);
            $in['passport']      = $admin_info['passport'];
            $in['password']      = $admin_info['password'];
            $in['salt']          = $admin_info['salt'];
            $middle_teacher->action($result['teacher_id'],$in);
        }
        return $result;
    }
    //兼容以前的账户系统
    // 系统uid=>教师信息
    public function uidGet($uid){
        $params[':fanid'] = $uid;
        $result         = pdo_fetch("select * from ".$this->tablename." where fanid =:fanid ",$params);
        return  $result;        
    }
    //微信uid 
    public function wechatUidGet($uid){
        $result = pdo_fetch("select * from ".$this->tablename." where uid=:uid",array(":uid"=>$uid));
        return $result;
    }
    //获取教师的头像
    public function teacherImg($t_id){
        global $_W;
        $school_id = getSchoolId();
        if($t_id){
            $img       =  pdo_fetchcolumn("select teacher_img from ".$this->tablename." where teacher_id=:tid ",array(":tid"=>$t_id));
        }
        if(!$img){
           $img =  S("system",'getSetContent',array('school_logo',$school_id));
        }
        return $_W['attachurl'].$img;
    }
    //获取教师名字
    public function teacherName($t_id){
       $t_name= pdo_fetchcolumn("select teacher_realname from ".$this->tablename." where teacher_id={$t_id} ");
       return $t_name;
    }
    //teacher_id获取用户信息
    public function getTeacherInfo($teacher_id){
        $params[':tid'] = $teacher_id;
        $result         = pdo_fetch("select * from ".$this->tablename." where teacher_id =:tid ",$params);
        return  $result;
    }
    //获取教师的数量
    public function getTeacherCount($school_id){
        $params[":school_id"] = $school_id;
        $params[':status']    = 1;
        $where                = S("fun","composeParamsToWhere",array($params) );        
        $count                = pdo_fetchall("select  * from ".$this->tablename." where ".$where." ",$params);
        $count = count($count);
        return $count;       
    }
    //获取教师列表
    public function getTeacherList($school_id){
        $params[":school_id"] = $school_id;
        $params[':status']    = 1;
        $where                = S("fun","composeParamsToWhere",array($params) );        
        $list                = pdo_fetchall("select *  from ".$this->tablename." where ".$where." ",$params);
        return $list;       
    }
    //获取教师绑定人数
    public function getBdTeacherCount($teacher_list){
        $num = 0;
        foreach ($teacher_list as $key => $value) {
            if( $value['uid']>0 ){
                $num++;
            }
        }
        return $num;       
    }
    //teacher_id获取绑定的openid
    public function getTeacherOpenid($teacher_id){
        $result = $this->getTeacherInfo($teacher_id);
        if($result['uid']){
            $fans = pdo_fetch("select openid from ".tablename("mc_mapping_fans")." where uid=:uid ",array(":uid"=>$result['uid']));
            return $fans['openid'];
        }
        return false;
    }
    //教师移动端验证
    public function teacherMobile(){
        global $_GPC,$_W;
		$uid    = getMemberUid();
		$result = pdo_fetch("select * from ".tablename('lianhu_teacher')." where uid={$uid} and uniacid = {$_W['uniacid']} ");
        if(!$result || $result['status']==0) {
           return false;            
        }else{
            return $result;
        }
    }
    #获取教师授课的详情
     public function getTeacherClass($teacher_id,$get_all=false){
        if(empty($teacher_id)){
            return false;
        }
        #是班主任的列表
        $list=pdo_fetchall("select class.*,grade.grade_name from ".tablename('lianhu_class')." class 
                            left join ".tablename('lianhu_grade')." grade on grade.grade_id=class.grade_id  
                            where class.status=1 and class.teacher_id=:tid",array(':tid'=>$teacher_id));
		#返回所有的班级
        if($get_all){
                $class_ids = pdo_fetchcolumn("select teacher_other_power from  ".tablename('lianhu_teacher')." where teacher_id=:tid ",array(':tid'=>$teacher_id) );
                if($class_ids){
                    $cid_arr   =explode(',',$class_ids);
                    $class_ids =implode(',',$cid_arr);
                    $list_all=pdo_fetchall("select class.*, grade.grade_name from ".tablename('lianhu_class')." class 
                                        left join ".tablename('lianhu_grade')." grade on grade.grade_id=class.grade_id  
                                        where class.status=1 and class.class_id in ({$class_ids})" );
                  }
            }
        return array('list'=>$list,'list_all'=>$list_all);    
    }   

}