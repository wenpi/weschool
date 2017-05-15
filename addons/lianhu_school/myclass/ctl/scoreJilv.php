<?php 
namespace myclass\ctl;
class scoreJilv extends common{
    public $grade_id;
    public $scorejilv_id;


    public function __construct(){
        $this->use_class = D('scoreJilv');
    }
    //根据年级获取所有的考试记录
    public function getGradeAll(){
        $params[":grade_id"]        = $this->grade_id;
        $this->use_class->each_page = 10000;
        $re = $this->use_class->getList($params);
        return $re;
    }
    //获取记录名
    public function getJilvInfo($field_arr){
        $field_str = implode(',',$field_arr);
        $this->use_class->field_str = $field_str;
        $params['scorejilv_id'] = $this->scorejilv_id;
        $result = $this->use_class->edit($params);
        return $result;
    }
    //考试记录按年分
    public function partScoreJilv($list){
        //按时间从小到大排序
        $list       = sortArr($list,'addtime','max');
        $out_list   = array();
        $g          = 0;
        foreach ($list as $key => $value) {
            if($key==0){
                $begin_year = strtotime(date("Y-01-01",$value['addtime']));
            }
            $add_year       = date("Y",$value['addtime'])+1;
            $this_end_year  = strtotime( $add_year.'-01-01') ;
            if($this_end_year > $old_end_year){
                $g++;
                $old_end_year = $this_end_year;
            }
            $out_list[$g]['records'][]  = $value;

            $out_list[$g]['begin']      = date("Y",$value['addtime']);
            $out_list[$g]['end']        = date("Y",$value['addtime'])+1;            
        }
        return $out_list;
    }




}