<?php 
namespace myclass\src;

class teacherTag extends common{
    public $tag_id   = 'tag_id';
    public $tag_name = 'tag_name';

    public function __construct(){
        $this->setTable('lianhu_teacher_tag');
        $this->setGlobal();
    }


}