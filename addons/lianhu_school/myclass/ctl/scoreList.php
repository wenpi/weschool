<?php 
namespace myclass\ctl;

class scoreList extends common{
    public $student_id;
    public $ji_lv_id;
    public $score_to_img = array(
        array('min'=>90,'max'=>100000,'img'=>'cj4.png' ),
        array('min'=>80,'max'=>89,'img'=>'cj6.png' ),
        array('min'=>70,'max'=>79,'img'=>'cj7.png' ),
        array('min'=>60,'max'=>69,'img'=>'cj9.png' ),
        array('min'=>50,'max'=>59,'img'=>'cj3.png' ),
        array('min'=>40,'max'=>49,'img'=>'cj3.png' ),
        array('min'=>0,'max'=>39,'img'=>'cj2.png' ),
    );

    public function __construct(){
        $this->use_class = D('scoreList');
    }
    //显示
    public function echoScoreImg($score){
      $score_to_img = $this->score_to_img;
      foreach ($score_to_img as $key => $value) {
          if($value['min']<=$score && $value['max']>=$score){
              return $value['img'];
          }
      }
      return 0;  
    } 
    //获取一个记录下学生的总分
    public function getAllScore(){
        $this->use_class->ji_lv_id      = $this->ji_lv_id;
        $this->use_class->student_id    = $this->student_id;
        $all_score  = $this->use_class->sumScore();
        return $all_score;
    }
    //获取一个考试的平均分
    public function  getAverageScore(){
        $this->use_class->ji_lv_id      = $this->ji_lv_id;
        $all_score_list                 = $this->use_class->getAllSumScore();
        foreach ($all_score_list as $key => $value) {
            $sum_score += $value['num'];
        }       
        $count         = count($all_score_list);
        $average_score = $sum_score/$count;
        $average_score = number_format($average_score,1);
        return $average_score;
    }
    //获取一个考试一个科目的平均分
    public function getCourseAverageScore($course_id){
        $this->use_class->course_id     = $course_id;
        $this->use_class->ji_lv_id      = $this->ji_lv_id;
        $re = $this->use_class->getCourseScore();
        foreach($re['list'] as $val){
            $all_score += $val['score'];
        }
        $average_score = $all_score/$re['count'];
        $average_score = number_format($average_score,1);
        return $average_score;
    }


}