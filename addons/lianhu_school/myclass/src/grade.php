<?php 
namespace myclass\src;

class grade extends common{
    public $school_id;

    public function __construct(){
        $this->setTable('lianhu_grade');
        $this->setGlobal();
    }
    //一个学校下面的年级数
    public static function gradeCount($school_id){
        $params[":school_id"] = $school_id;
        $params[":status"]    = 1;
        $where                = S("fun","composeParamsToWhere",array($params) );
        $count                = pdo_fetchcolumn( "select count(grade_id)  num from ".tablename('lianhu_grade')." where ".$where." ",$params );
        return $count;
    }
    public function edit($where,$up=false){
        $where['school_id'] = $this->school_id;
        $re                 = parent::edit($where,$up);
        return $re;
    }
    public function getSchoolList(){
        $where                  = " status=:status and school_id=:school_id";
        $params[":status"]      = 1;
        $params[":school_id"]   = $this->school_id;
        $list                   = pdo_fetchall("select * from ".$this->table." where ".$where." ",$params); 
        return $list;
    }
    //更新年级展示名
    public function updateGradeName($grade_id,$new_name){   
        $where['grade_id'] = $grade_id;
        $up['grade_name']  = $new_name;
        $this->edit($where,$up);
    }
    //处理超过年限
    public function resoveEndGrade($grade_id){
        $class_classes            = D("classes");
        $class_classes->grade_id  = $grade_id;
        $where['grade_id']        = $grade_id;
        $up['grade_name']         = '毕业';
        $up['status']             = 2;
        $this->dataEdit($where,$up);
        
        unset($up['grade_name']);
        pdo_update('lianhu_scorejilv',$up,$where);
        $class_classes -> resoveEndClass();
        D('student')->resoveEndStudent($grade_id);
    }
    //新增
    public function addGrade($in_school_year,$grade_name){
        $in['grade_name']          = $grade_name;
        $in['in_school_year']      = $in_school_year;
        $add_id = $this->add($in);
        $middle_grade              = M('grade');
        if($middle_grade){
            $middle_grade->grade_name   = $grade_name;
            $middle_grade->school_id    = $this->school_id;
            $middle_grade->jia_grade_id = $add_id;
            $middle_grade->status       = 1;
            $middle_grade->dataEdit();
        }
    }
    public function dataEdit($where,$up){
        $re = $this->edit($where,$up);
        $middle_grade   = M('grade');
        if($middle_grade && $up['grade_name']){
                $middle_grade->grade_name       = $up['grade_name'];
                $middle_grade->school_id        = $this->school_id;
                $middle_grade->jia_grade_id     = $re['grade_id'];
                if($up['status']){
                    $middle_grade->status       = $up['status'];
                }else{
                    $middle_grade->status       = 1;
                }
                $middle_grade->dataEdit();
        }
    }
    //获取一个年级的信息
    public function getGradeInfo($grade_id){
        $params['grade_id'] = $grade_id;
        $re                 = $this->edit($params);
        return $re;
    }
    //该用户可以查看到的年级
    public function getThisAdminGradeList($all=false){
        global $_GPC;
        if(!$all){
            $params[":status"] = 1;
        }
        $params[":school_id"]  = getSchoolId();
        $where                 = S("fun","composeParamsToWhere",array($params) );
        $list                  = pdo_fetchall("select * from ".$this->table." where ".$where." order by in_school_year desc ",$params);
        if($_GPC['_data_group_id']){
            $data_group        = D('power')->getDataInfo($_GPC['_data_group_id']);
            if($data_group['grade']){
                foreach ($list as $key => $value) {
                    if(!in_array($value['grade_id'],$data_group['grade']) ){
                        unset($list[$key]);
                    }
                }
            }
        }
        return $list;
    }
    //联动
	public function gradeClass(){
		global $_W,$_GPC;
        $grades = $this->getThisAdminGradeList();
        foreach ($grades as $key => $value) {
            $grades[$key]['second'] = pdo_fetchall("select * from ".tablename('lianhu_class')." where grade_id={$value['grade_id']} and status=1 ");
        }
		return $grades;
	}    
}