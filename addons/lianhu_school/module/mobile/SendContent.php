<?php 
    //教师端查看：作业，记录等内容
    $teacher_info = $this->teacher_mobile_qx(); 
    $page_title   = '详细内容查看';
    $type         = $_GPC['type'];
    $id           = $_GPC['id'];
    if($type=='work_record'){
        $class_work = D('work');
        $info       = $class_work->edit($id);
        $result['title']   = $info['word'];
        $result['img']     = $info['img'];
        $result['content'] = $info['content'];
        $result['add_time'] = $info['addtime'];
    }
    if($type=='record'){
         $class_look         = D("look"); 
         $record_re          = D('sendRecord')->dataEdit($id);
         $result['title']    = $record_re['record_intro'];
         $result['imgs']     = $record_re['imgs'];
         $result['content']  = $record_re['record_content'];
         $result['add_time'] = $record_re['add_time'];        
         $result['voice']    = $record_re['voice'];        
    }

