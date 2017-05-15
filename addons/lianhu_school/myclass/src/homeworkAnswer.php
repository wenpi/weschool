<?php
namespace myclass\src;

class homeworkAnswer extends common{
    public $answer_id;
    public $homework_id;
    public $teacher_id;
    public $answer_imgs;
    public $answer_voice;
    public $answer_text;
    public $status;

    public function __construct(){
            $this->setTable('lianhu_homewor_answer');
            $this->setGlobal();
    }
    //获取某次家庭作业的答案记录
    public function answerList($homework_id){
        $this->each_page = 1000;
        $where[":homework_id"] = $homework_id;
        $where[":status"]      = 1;
        $re = $this->getList($where);
        return $re;//[count,list]
    }


}