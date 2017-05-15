<?php defined('IN_IA') or exit('Access Denied');?><!DOCTYPE html>
<html>
<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1,user-scalable=no" />  
		<title><?php  if($student_name) { ?><?php  echo $student_name;?>-<?php  } ?><?php  if($teacher_name) { ?> <?php  echo $teacher_name;?>-<?php  } ?> <?php  echo $page_title;?>-<?php  echo $_SESSION['school_name'];?></title>
		<link rel="stylesheet" type="text/css" href="<?php echo MODULE_URL;?>/template/xiaoye/css/content_css.css?<?php  echo time();?>">
		<script src="<?php echo MODULE_URL;?>/style/js/jquery.min.js"></script>
        <script src="<?php echo MODULE_URL;?>/template/xiaoye/js/load.js"></script>
</head>
<body>
	<div class="z_main">
		<div class="z_tx1">
            <div class="z_tx11">
                <form method="post"  action="<?php  echo $this->createMobileUrl('personer_list')?>">
                    <input type="text"  placeholder="请输入你要搜索的联系人" name="search_name" value="<?php  echo $_GPC['search_name'];?>">
                    <input name="submit" type="submit" class="z_bxx" value=" " > 
                </form>
            </div>
		</div>
		<div class="z_tx2">
		<div id="firstpane" class="menu_list">
            <h3 class="menu_head current">
                <div class="z_tx21"><img src="<?php echo MODULE_URL;?>/template/xiaoye/img/js.png"></div>
                <div class="z_tx22">教师组</div>
                <div class="z_tx23"><img src="<?php echo MODULE_URL;?>/template/xiaoye/img/jiantou.png"></div>
            </h3>
            <div style="display:block" class="menu_body">
                <ul class="z_txx">
                    <?php  if(is_array($teacher_list)) { foreach($teacher_list as $key => $row) { ?>
                        <li>
                            <div class="z_txx1"><img src="<?php  echo D('teacher')->teacherImg($row['teacher_id']);?>"></div>
                            <div class="z_txx2"  style="margin-top: 0px;"><?php  echo $row['teacher_realname'];?><span>(<?php  echo $this->courseName($row['course_id'])?>)</span></div>
                            <div class="z_txx3"><a href="<?php  echo $this->createMobileUrl('chatMessage',array('t_id'=>$row['teacher_id'],'type'=>'teacher'))?>"><img src="<?php echo MODULE_URL;?>/template/xiaoye/upimg/xx.png"></a></div>
                            <?php  if($row['teacher_telphone']) { ?>
                                <div class="z_txx3"><a href="tel:<?php  echo $row['teacher_telphone'];?>"><img src="<?php echo MODULE_URL;?>/template/xiaoye/upimg/Z_DH.png"></a></div>
                            <?php  } ?>
                        </li>
                    <?php  } } ?>
                </ul>
            </div>
        </div>
       <?php  if(S("system",'getSetContent',array('parentsToparents',$this->school_info['school_id'])) ==1 ) { ?>  
		<div id="sec" class="menu_list">
            <h3 class="menu_head current">
                <div class="z_tx21"><img src="<?php echo MODULE_URL;?>/template/xiaoye/img/js.png"></div>
                <div class="z_tx22">家长组</div>
                <div class="z_tx23"><img src="<?php echo MODULE_URL;?>/template/xiaoye/img/jiantou.png"></div>
            </h3>
            <div style="display:block" class="menu_body">
                <ul class="z_txx">
                    <?php  if(is_array($student_list)) { foreach($student_list as $key => $val) { ?>
                            <li>
                                <div class="z_txx1"><img src="<?php  echo C('student')->studentImg($val['student_id']);?>"></div>
                                <div class="z_txx2"><?php  echo $val['student_name'];?></div>
                                <div class="z_txx3"><a href="<?php  echo $this->createMobileUrl('chatMessage',array('o_id'=>$val['student_id'],'type'=>'student','in_type'=>'as_student' ))?>"><img src="<?php echo MODULE_URL;?>/template/xiaoye/upimg/xx.png"></a></div>
                                <?php  if($val['parent_phone']) { ?>
                                    <div class="z_txx3"><a href="tel:<?php  echo $val['parent_phone'];?>"><img src="<?php echo MODULE_URL;?>/template/xiaoye/upimg/Z_DH.png"></a></div>
                                <?php  } ?>
                            </li>
                    <?php  } } ?>
                </ul>
            </div>
        </div>
    <?php  } ?> 
<script>
    $(document).ready(function(){
        $("#firstpane .menu_body:eq(0)").show();
        $("#firstpane h3.menu_head").click(function(){
            $(this).addClass("current").next("div.menu_body").slideToggle(300).siblings("div.menu_body").slideUp("slow");
            $(this).siblings().removeClass("current");
        });
        $("#sec h3.menu_head").click(function(){
            $(this).addClass("current").next("div.menu_body").slideToggle(300).siblings("div.menu_body").slideUp("slow");
            $(this).siblings().removeClass("current");
        });

    });
</script>
</div>
<?php  $footer_center='cdb'?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../xiaoye/newStudentFooter', TEMPLATE_INCLUDEPATH)) : (include template('../xiaoye/newStudentFooter', TEMPLATE_INCLUDEPATH));?>
</body>
</html>
