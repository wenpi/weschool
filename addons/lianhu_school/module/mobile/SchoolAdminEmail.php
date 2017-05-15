<?php 
    $school_admin  = D('admin')->mobileValidSchoolAdmin();
    if(!$school_admin){
        header("Location:".$this->createMobileUrl("school_bangding"));
    }
    $student_name       = $school_admin['info']['admin_name'];
    $title              = $page_title         = '来信处理';
	$class_message      = D('message');
    $pagesize           = 20;
    $s_n_page         	= $_GPC['s_n_page'] ? $_GPC['s_n_page']:1;
    $s_n_start_num 		= ($s_n_page-1)*$pagesize;
    $s_n_sql_limit 		= "limit {$s_n_start_num},{$pagesize} ";
    if($ac=='new'){
	    $list        	= $class_message->getSchoolMessageList('do','student',$s_n_sql_limit);
    }
    //默认所以是未处理的
    if($ac=='list'){
	    $list           = $class_message->getSchoolMessageList('not_do','student',$s_n_sql_limit);
    }
    $list           = $list['list'];
    if($_GPC['ajax']){
        if(!$list){
            echo 'done';
        }else{
            $template = $this->selectTemplate("SchoolAdminEmail_content");
            include $this->template($template);	
        }
        exit();          
    }    

    