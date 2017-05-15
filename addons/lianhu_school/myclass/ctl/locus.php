<?php 
namespace myclass\ctl;

class locus extends common{
    public $student_id;
    public $year;
    public $month;
    public $date;

    public function __construct(){
        $this->use_class = D('locus');
    }
    //获取学生的某天轨迹
    public function getStudentLocus(){
        $params["year"]  = $this->year;
        $params["month"] = $this->month;
        $params["date"]  = $this->date;
        $params["student_id"] = $this->student_id;
        $re = $this->use_class->edit($params);
        return $re;
    }
    // 解析轨迹
    public function decodeLocus($info){
        $arr = explode(',',$info);
        foreach ($arr as $key => $value) {
            if($value){
                list($decode_arr[$key]['time'],$decode_arr[$key]['info']) = explode('=>',$value);
            }
        }
        return $decode_arr;
    }
    

}
