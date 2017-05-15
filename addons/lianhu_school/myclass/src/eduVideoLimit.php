<?php
namespace myclass\src;

class eduVideoLimit extends common{

    public $limit_id    = 'limit_id';
    public $class_id    = 'class_id';
    public $grade_id    = 'grade_id';
    public $classes_id  = 'classes_id';

    public function __construct(){
        $this->setTable('lianhu_edu_video_limit');
        $this->setGlobal();
    }
    


}