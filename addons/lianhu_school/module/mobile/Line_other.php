<?php 
	$school_info  = $this->school_info;
    $line_type    = $school_info['line_type'];
    if($line_type){
        $line_type_cfg=explode("||", $line_type );
        foreach ($line_type_cfg as $key => $value) {
            if($value){
                $line_types[]=$value;
            }
        }
        $_W['line_type']=$line_types;
    }

    $student_info= $this->mobile_from_find_student();
    $now_class_id  = getClassId();
    $class_name    = D('classes')->className($now_class_id);
    #作业
    if($op=='home_work'){
        $news_list = pdo_fetchall("select home.*,tea.teacher_realname from {$table_pe}lianhu_homework home 
                                   left join {$table_pe}lianhu_teacher tea on tea.teacher_id=home.teacher_id
                                   where home.class_id={$now_class_id} and home.status=1 order by home.add_time desc limit 0,20");
    }else{
        $type = array_search($op, $_W['line_type']);
        if(!$type){
            $type=0;
        }
        $total=pdo_fetchcolumn("select count(*) num from {$table_pe}lianhu_line where class_id=:cid and status=1 and  line_type={$type}",array(':cid'=>$now_class_id));
        $news_list=pdo_fetchall("select line.*,tea.teacher_realname from {$table_pe}lianhu_line line left join {$table_pe}lianhu_teacher tea on tea.teacher_id=line.teacher_id  where line.class_id=:cid and line.status=1 and  line_type={$type} order by line.addtime desc {$sql_limit}",array(':cid'=>$now_class_id ));  
    }



