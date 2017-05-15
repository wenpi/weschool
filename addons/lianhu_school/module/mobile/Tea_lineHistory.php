<?php
    $asc = $_SERVER['HTTP_ACCEPT'];
    if(!stristr($asc,"text/html")){
        exit();
    }	
    $teacher_info   = $this->teacher_mobile_qx();
	$student_name 	= $teacher_info['teacher_realname'];
	$page_title 	= '班级公告';
    $pagesize = 20;
    $page     = $_GPC['page']?$_GPC['page']:1;
    $start    = ($page-1)*$pagesize;
    $cid      = intval($_GPC['cid']);
 	$line_type_cfg  = C('classes')->msgClass($_GPC['cid']);
    $total    = pdo_fetchcolumn("select count(*) num from  {$table_pe}lianhu_line where class_id=:cid",array(':cid'=>$cid));
    $list     = pdo_fetchall("select line.*,class.class_name,tea.teacher_realname from {$table_pe}lianhu_line line left join {$table_pe}lianhu_class class on class.class_id=line.class_id
		left join {$table_pe}lianhu_teacher tea on line.teacher_id=tea.teacher_id where line.class_id=:cid order by addtime desc limit {$start},{$pagesize}",array(':cid'=>$cid));
    $pager 	  = pagination($total, $page+1, $pagesize);    
    if($ac=='ajax'){
         if($list){
            $template = $this->selectTemplate("Tea_lineHistory_ajax");
            include $this->template($template);
         }else{
             echo 'done';
         }
         exit();
     }