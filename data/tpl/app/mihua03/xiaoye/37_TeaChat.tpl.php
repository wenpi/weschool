<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../xiaoye/newHead', TEMPLATE_INCLUDEPATH)) : (include template('../xiaoye/newHead', TEMPLATE_INCLUDEPATH));?>
<body>
	<div class="z_main">
		<div class="z_tx1">
            <div class="z_tx11">
                <form method="post"  action="<?php  echo $this->createMobileUrl('teaChat')?>">
                    <input type="text"  placeholder="请输入你要搜索的联系人" name="search_name" value="<?php  echo $_GPC['search_name'];?>">
                    <input name="submit" type="submit" class="z_bxx" value=" " > 
                </form>
            </div>
		</div>
		<div class="z_tx2">
        <?php  if(is_array($all_list)) { foreach($all_list as $key => $row) { ?>
            <div id="class_name_<?php  echo $key;?>" class="menu_list">
                <h3 class="menu_head current">
                    <div class="z_tx21"><img src="<?php echo MODULE_URL;?>/template/xiaoye/img/js.png"></div>
                    <div class="z_tx22"><?php  echo $row['class_name'];?></div>
                    <div class="z_tx23"><img src="<?php echo MODULE_URL;?>/template/xiaoye/img/jiantou.png"></div>
                </h3>
                <div style="display:none" class="menu_body">
                    <ul class="z_txx">
                        <?php  if(is_array($row['student_list'])) { foreach($row['student_list'] as $k => $val) { ?>
                            <li>
                                <div class="z_txx1"><img src="<?php  echo C('student')->studentImg($val['student_id']);?>"></div>
                                <div class="z_txx2" style="margin-top: 0px;width:40%" ><?php  echo $val['student_name'];?></div>
                                <div class="z_txx3"><a href="<?php  echo $this->createMobileUrl('chatMessage',array('s_id'=>$val['student_id'],'type'=>'student','in_type'=>'as_teacher' ))?>"><img src="<?php echo MODULE_URL;?>/template/xiaoye/upimg/xx_tea.png"></a></div>
                                <?php  if($val['parent_phone']) { ?>
                                <div class="z_txx3"><a href="tel:<?php  echo $val['parent_phone'];?>"><img src="<?php echo MODULE_URL;?>/template/xiaoye/upimg/Z_tea.png"></a></div>
                                <?php  } ?>
                            </li>
                        <?php  } } ?>
                    </ul>
                </div>
            </div>
        <?php  } } ?>
		<div id="class_name_end" class="menu_list">
            <h3 class="menu_head current">
                <div class="z_tx21"><img src="<?php echo MODULE_URL;?>/template/xiaoye/img/js.png"></div>
                <div class="z_tx22">教师组</div>
                <div class="z_tx23"><img src="<?php echo MODULE_URL;?>/template/xiaoye/img/jiantou.png"></div>
            </h3>
            <div class="menu_body" style="display:none">
                <ul class="z_txx">
                    <?php  if(is_array($teacher_list)) { foreach($teacher_list as $key => $row) { ?>
                        <li>
                            <div class="z_txx1"><img src="<?php  echo D('teacher')->teacherImg($row['teacher_id']);?>"></div>
                            <div class="z_txx2"  style="margin-top: 0px;width:40%"><?php  echo $row['teacher_realname'];?><span>(<?php  echo $this->courseName($row['course_id'])?>)</span></div>
                            <div class="z_txx3"><a href="<?php  echo $this->createMobileUrl('chatMessage',array('o_id'=>$row['teacher_id'],'type'=>'teacher','in_type'=>'as_teacher' ))?>"><img src="<?php echo MODULE_URL;?>/template/xiaoye/upimg/xx_tea.png"></a></div>
                            <?php  if($row['teacher_telphone']) { ?>
                                <div class="z_txx3"><a href="tel:<?php  echo $row['teacher_telphone'];?>"><img src="<?php echo MODULE_URL;?>/template/xiaoye/upimg/Z_tea.png"></a></div>
                            <?php  } ?>
                        </li>
                    <?php  } } ?>
                </ul>
            </div>
        </div>

<script>
    $(document).ready(function(){
        $("#class_name_0 .menu_body:eq(0)").show();
        $("h3.menu_head").click(function(){
            $(".menu_body").hide();
            $(this).addClass("current").next("div.menu_body").slideToggle(300).siblings("div.menu_body").slideUp("slow");
            $(this).siblings().removeClass("current");

        });
    });
</script>
</div>
<link href="<?php echo MODULE_URL;?>/template/xiaoye/css/teacher.css" rel="stylesheet">
<?php  $center_class = 'cdb'?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../xiaoye/newTeaFooter', TEMPLATE_INCLUDEPATH)) : (include template('../xiaoye/newTeaFooter', TEMPLATE_INCLUDEPATH));?>
</body>
</html>