<?php 
namespace myclass\src;

class school{
    public $school_id;
    public $school_type_id;
    public $uniacid;
    //学校参数
    public $school_params = array(
        'day_article_much',
        'day_article_base',
        'day_login_much',
        'day_login_base',
        'day_line_much',
        'day_line_base',
        'day_work_base',
        'day_work_much',
        'day_homeWork_much',
        'day_homeWork_base',
        'school_logo',
        'mobile_title',
        'much_class',
        'cookbook_class',
        'care_str',
        'care_img',
        'line_video_status',
        'parents_info',
        'school_info_intro',
        'parentsToparents',
        'xiaoye_home',
        'xiaoye_bottom',
        'ask_url',
        'xiaoye_tea_bottom',
        'remindTeacher',
    );
    public function __construct(){
        $this->school_id =  getSchoolId();
    }
    //有效的学校
    public function getActiveSchool(){
        global $_W;
        $where[":uniacid"] = $_W['uniacid'];
        $where[":status"]  = 1;
        $list  = pdo_fetchall("select school_id from ".tablename("lianhu_school")." where uniacid =:uniacid and status=:status ",$where);
        return $list;
    }
    //需要发送通知教师第二天上课的学校
    public function needSendMsgToTeacher($list){
        foreach ($list as $key => $value) {
            $send_yes = S("system",'getSetContent',array('remindTeacher',$value['school_id']));
            if($send_yes==1){
                $school_ids[] = $value['school_id'];
            }
        }
        return $school_ids;
    }
    //该公众号下的学校列表
    public function getUniacidSchoolList(){
        global $_W;
        $list = pdo_fetchall("select * from ".tablename('lianhu_school')." where uniacid = :uniacid and status!=-1",array(":uniacid"=>$_W['uniacid']));
        return $list;
    }
    //新增基本学校
    public function addNewSchool($arr){
        global $_W;
        $in['school_name'] = $arr['school_name'];
        $in['uniacid']     = $_W['uniacid'];
        $in['add_time']    = time();
        pdo_insert('lianhu_school',$in);
        $school_id         = pdo_insertid();
        $middle_school     = M("school");
        if($middle_school){
            $middle_school->school_name     = $in['school_name'];
            $middle_school->status          = 1;
            $middle_school->jia_school_id   = $school_id;
            $middle_school->dataAdd();
        }
        return $school_id;
    }
    //设置学校参数
    public function setSchoolParams(){
        global $_GPC;
        $school_id = getSchoolId();
        foreach ($this->school_params as  $value) {
            S("system",'updateSetContent',array($_GPC[$value],$value,$school_id ));    
        }
    }
    //获取现前学校的某个参数
    public function getSchoolParams($params_name){
        $school_id = getSchoolId();
        $result    = S("system",'getSetContent',array($params_name,$school_id ));
        return     $result;
    }
    //根据uniacid 
    public static function getSchoolByUniacid($uniacid){
        $params[":uniacid"] = $uniacid;
        $params[":status"]  = 1; 
        $where              = S("fun","composeParamsToWhere",array($params) );
        $list               = pdo_fetchall("select * from ".tablename("lianhu_school")." where ".$where." ",$params);
        return $list;
    }
    //学校类型
    public static function schoolType(){
        $all_types = D('system')->school_type;
        return $all_types;
    }
    //根据type 获取类型名
    public static function getSchoolTypeName($id){
        $all_types = D('system')->school_type;
        foreach ($all_types as $key => $value) {
            if($value['id']==$id)
                return $value['name'];
        }
        return '未知';
    }
    public function edit($where,$up=false){
        if($up){
            pdo_update("lianhu_school",$up,$where);
        }
        $g = 0;
        foreach ($where as $key => $value) {
            $params[":".$key] = $value;
            if(is_array($value)){
                $in_params[":".$key] = $value[1];
            }else{
                $in_params[":".$key] = $value;
            }
        }
        $where_str      = S("fun",'composeParamsToWhere',array($params));
        $result         = pdo_fetch("select * from ".tablename("lianhu_school")." where ".$where_str ." order by add_time desc",$in_params);
        $middle_school  = M('school');
        if($middle_school && $up){
            $middle_school->jia_school_id = $result['school_id'];
            $middle_school->school_name   = $result['school_name'];
            $middle_school->status        = $result['status']<0 ? 0:1 ;
            $re = $middle_school->dataEdit();
        }
        return $result;
    }

    //检测该排序在该学校类型是否已经存在
    //存在 true :
    public function vaildThisSortHave($sort){
        $where  = "school_type=:stype and grade_sort=:gsort";
        $params[':stype'] = $this->school_type_id;
        $params[':gsort'] = $sort;
        $result           = pdo_fetch("select * from ".tablename('lianhu_grade_type')." where ".$where." ",$params);
        return $result;
    }
    //新增学校类型
    public function addSchoolType($arr){
        $in['school_type'] = $this->school_type_id;
        $in['grade_sort']  = $arr['grade_sort'];
        $in['grade_name']  = $arr['grade_name'];
        $in['add_time']    = time();
        pdo_insert('lianhu_grade_type',$in);
    }
    //更新学校类型
    public function updateSchoolType($arr,$type_id){
        $up['grade_sort']  = $arr['grade_sort'];
        $up['grade_name']  = $arr['grade_name'];
        $up['school_type'] = $this->school_type_id;
        pdo_update('lianhu_grade_type',$up,array("type_id"=>$type_id) );
    }
    //获取现有学校类型年级列表
    public function getSchoolTypeGradeList(){
        $where                      = '1=1';
        $params                     = false;
        if($this->school_type_id){
            $params[":school_type"] = $this->school_type_id;
            $where                 .= " and school_type=:school_type ";
            $list   = pdo_fetchall("select * from ".tablename('lianhu_grade_type')." where  ".$where."  order by school_type desc,grade_sort desc",$params);
        }else 
            $list   = pdo_fetchall("select * from ".tablename('lianhu_grade_type')." where  ".$where."  order by school_type desc,grade_sort desc");

        return $list;
    }
    //根据type_id 获取一个学校类型的详细信息
    public function getSchoolTypeInfo($type_id){
        $result = pdo_fetch("select * from ".tablename('lianhu_grade_type')." where type_id=:type_id ",array(":type_id"=>$type_id));
        return $result;
    }
    //本校的信息
    public function getSchoolInfo($field=false){
        $where[':sid'] = $this->school_id;
        if(!$field){
            $out_field = '*';
        }else{
            $out_field = $field;
        }
        $result        = pdo_fetch("select ".$out_field." from ".tablename('lianhu_school')." where school_id=:sid ",$where); 
        if($field){
            $out = $result[$field];
        }else{
            $out = $result;
        }
        return $out;
    }
    //本校的年级升级处理
    public function upgradeSchoolGrade($school_id){
        $this->school_id        = $school_id;
        $school_info            = $this->getSchoolInfo();
        list($now_year,$month)  = explode('-',date("Y-m",time() ));
        if($school_info['school_type']>0 && ($month>6 && $month<9) ){
            $this->school_type_id   = $school_info['school_type'];
            $this_type_list         = $this->getSchoolTypeGradeList();
            $class_grade            = D("grade");
            $class_grade->school_id = $school_id;
            $school_grade_list      = $class_grade->getSchoolList();
            foreach ($school_grade_list as $key => $value) {
                $years = $now_year-$value['in_school_year'];
                if(!isset($min_years) || $years<$min_years)
                    $min_years = $years;
                foreach ($this_type_list as $k => $v) {
                    if($v['grade_sort']==0)
                        $grade_name_zero = $v['grade_name'];
                    if($v['grade_sort']==$years){
                        $class_grade->updateGradeName($value['grade_id'],$v['grade_name']);
                        continue;
                    }
                }
                //超过年限的
                if($years > $this_type_list[0]['grade_sort'])
                    $class_grade -> resoveEndGrade($value['grade_id']);
            }
            //新增今年的
            if($min_years > 0 ){
                $class_grade->addGrade($now_year,$grade_name_zero);
            }
            $up_school_name = $school_info['school_name'];
        }
        return $up_school_name;
    }
    //生成学校关注的渠道二维码
    public function createSchoolNoticeQr($school_id){
        $where["school_id"] = $school_id;
        $re                 = D('careChannel')->edit($where);
        $scene_str          = 'schoolid'.$school_id;
        if(!$re){
            $ticket       = D('base')->createCardTicket($school_id);
            $re['ticket'] = $ticket;
            D('careChannel')->school_id = $school_id;
            D('careChannel')->add($re);
        }
        $wq_re    = D('base')->actionTicket($re['ticket'],$school_id);
        $rule_re  = D('base')->actionRule('学校渠道二维码');
        $rule_key = D('base')->actionRuleInfo($rule_re['id'],'lianhu_school_channel');
        return $wq_re;
    }



}