<?php 
namespace myclass\src;

class system{
    public $school_admin_per =array(
        "lianhu_school_menu_teacher",       //教师管理
        "lianhu_school_menu_course",        //课程管理
        "lianhu_school_menu_student",       //学生管理
        "lianhu_school_menu_msg",           //消息管理
        "lianhu_school_menu_syllabus",      //课程管理
        "lianhu_school_menu_neimsg",        //站内信
        "lianhu_school_menu_line",          //班级圈
        "lianhu_school_menu_data_in",       //数据导入
        "lianhu_school_menu_data_out",      //数据统计
        "lianhu_school_menu_appointment",   //预约管理 
        "lianhu_school_menu_score_list",    //成绩录入
        "lianhu_school_menu_money",         //收费管理 
        "lianhu_school_menu_grade",         //年级管理
        "lianhu_school_menu_class",         //班级管理
        "lianhu_school_menu_student_record", //学生记录
        "lianhu_school_menu_leave",         //请假管理 
        "lianhu_school_menu_homework",      //作业管理 
        "lianhu_school_menu_cookbook",      //食谱管理
        "lianhu_school_menu_video",         //视频管理
        "lianhu_school_menu_course_scan",   //扫码记次 
        "lianhu_school_menu_device",        //设备管理
    );
    public $teacher_admin_per =array(
        "lianhu_school_menu_leave",
        "lianhu_school_menu_homework",
        "lianhu_school_menu_student",
        "lianhu_school_menu_msg",
        "lianhu_school_menu_syllabus",
        "lianhu_school_menu_line",
        "lianhu_school_menu_data_in",
        "lianhu_school_menu_data_out",
        "lianhu_school_menu_appointment",
        "lianhu_school_menu_score_list",
        "lianhu_school_menu_student_record",
    );
    public $student_admin_relation =array(
        '爸爸',
        '妈妈',
        '自己',
        '爷爷',
        '奶奶',
        '舅舅',
        '舅妈',
        '外公',
        '外婆',
        '其他'
    );
    //学校类型
    public  $school_type = array(
        array('id'=>1,'name'=>'幼儿园'),
        array('id'=>2,'name'=>'小学'),
        array('id'=>3,'name'=>'中学'),
        array('id'=>4,'name'=>'高中'),
        array('id'=>5,'name'=>'大学'),
        array('id'=>6,'name'=>'培训机构'),
        array('id'=>7,'name'=>'其他'),
    );
    //读取配置内容
    public static function getSetContent($key_word,$school_id=false){
        $params[":keyword"] = $key_word;
        if($school_id){
            $params[":school_id"] = $school_id;
        }
 		$where    = S("fun","composeParamsToWhere",array($params) );
        $content  = pdo_fetchcolumn("select content from ".tablename('lianhu_set')." where ".$where." ",$params);
        return $content;
    }
    //更新配置内容
    public static function updateSetContent($content,$key_word,$school_id=false){
            $params['keyword'] = $key_word;
            if($school_id){
                $params['school_id'] = $school_id;
                $in['school_id']     = $school_id;
            }
            pdo_delete("lianhu_set",$params);
            $in['keyword']   = $key_word;
            $in['content']   = $content;
            pdo_insert("lianhu_set",$in);  
    }
    //获取家云账号
    public static function getJiaYunPassport(){
        $passport = self::getSetContent('jia_yun_passport');
        return $passport;
    }
    //获取家云密码
    public static function getJiaYunPassword(){
        $password = self::getSetContent('jia_yun_password');
        return $password;
    }
    //更新家云账号
    public static function updateJiaYunPassport($passport){
        self::updateSetContent($passport,'jia_yun_passport');
    }
    //更新家云密码
    public static function updateJiaYunPassword($password){
        self::updateSetContent($password,'jia_yun_password');
    }
    //设置学校微官网
    public static function setSchoolWapTemplate($school_id,$template){
        self::updateSetContent($template,'school_template',$school_id);
    }
    public static function setSchoolPcTemplate($school_id,$template){
        self::updateSetContent($template,'pc_template',$school_id);
    }
    //获取学校微官网的模板
    public static function getSchoolWapTemplate($school_id){
        $content  = self::getSetContent('school_template',$school_id);
        if(!$content)
            $content = 'default';
        return $content;
    }
    //获取学校微官网的模板
    public static function getSchoolPcTemplate($school_id=false){
        if(!$school_id)
            $school_id =  getSchoolId();
        $content  = self::getSetContent('pc_template',$school_id);
        if(!$content)
            $content = 'default';
        return $content;
    }

    //获取学校教师考核单位
    public static function TeacherCheckUnit($school_id,$type,$content=false){
        $key_word = 'tea_check_unit';
        if($type=='get'){
            $content  = self::getSetContent($key_word,$school_id);
            if(!$content)
                $content = '积分';
            return $content;  
        }else{
            self::updateSetContent($content,$key_word,$school_id);
        }
    }
    //每日有效作业发送数
    public static function dayWorkMuch($type,$content=false,$sid=false){
        if(!$sid)
            $sid      =  getSchoolId();
        $key_word = 'day_work_much';
        if($type=='get'){
            $content  = self::getSetContent($key_word,$sid);
            if(!$content)
                $content = 2;
            return $content;  
        }else{
            self::updateSetContent($content,$key_word,$sid);
        }
    }
    //每次作业的考核基数
    public static function dayWorkBase($type,$content=false,$sid=false){
        if(!$sid)
            $sid      =  getSchoolId();
        $key_word = 'day_work_base';
        if($type=='get'){
            $content  = self::getSetContent($key_word,$sid);
            if(!$content)
                $content = 2;
            return $content;  
        }else{
            self::updateSetContent($content,$key_word,$sid);
        }       
    }
    //将数组根据add_time分天分组
    public static function ArrGroupAddTime($arr){
        $time_date = array();
        foreach ($arr as $key => $value) {
            $now_date = strtotime(date("Y-m-d",$value['add_time']));        
            $time_date[$now_date][] = $value;
        }
        return $time_date;
    }

}