<?php 
namespace myclass\src;
//班级公告等

class lianhuLine extends common{
    public $line_id;
    public $class_id;
    public $teacher_id;
    public $line_title;
    public $line_content;
    public $status;
    public $line_type;
    public $teacher_intro;
    public $line_look;
    public $imgs;
    public $voice;

    public function __construct(){
        $this->setTable('lianhu_line');
        $this->setGlobal();
    }

}
