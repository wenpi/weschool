<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../xiaoye/head', TEMPLATE_INCLUDEPATH)) : (include template('../xiaoye/head', TEMPLATE_INCLUDEPATH));?>
<body>
	<div class="z_main">
		<div class="z_tx2">
        <?php  if(is_array($list)) { foreach($list as $row) { ?>
            <div id="firstpane<?php  echo $row['class_id'];?>" class="menu_list">
                <h3 class="menu_head current">
                    <div class="z_tx21"><img src="<?php echo MODULE_URL;?>/template/xiaoye/img/js.png"></div>
                    <div class="z_tx22"><?php  echo $row['class_name'];?></div>
                    <div class="z_tx23"><img src="<?php echo MODULE_URL;?>/template/xiaoye/img/jiantou.png"></div>
                </h3>
                <div  class="menu_body">
                    <ul class="z_txx">
                        <?php  if(is_array($row['course_list'])) { foreach($row['course_list'] as $val) { ?>
                            <li>
                                <div class="z_txx1"><img src="<?php  echo $this->imgFrom($val['img'])?>"></div>
                                <div class="z_txx2"><a href="<?php  echo $this->createMobileUrl('courseScanInfo',array('course_id'=>$val['course_id']))?>"  style="color:#666" ><?php  echo $val['course_name'];?></a></div>
                                <?php  if($val['use_num']) { ?>
                                    <div class="z_txx3" style="color:#999" >课时数：<?php  echo $val['use_num'];?></div>
                                <?php  } else if($val['buy_end']<$now_time) { ?>
                                    <div class="z_txx3" style="color:#999" >已过时</div>
                                <?php  } else if($val['max_student_num'] <= $val['have_in']) { ?>
                                    <div class="z_txx3" style="color:#999" >已满员</div>
                                <?php  } else { ?>
                                    <div class="z_txx3"><a href="<?php  echo $val['buy_url'];?>" style="color:#ff0033">[<?php  echo $val['price'];?>元]去购买</a></div>
                                <?php  } ?>
                            </li>
                        <?php  } } ?>
                    </ul>
                </div>
            </div>       
        <?php  } } ?>
<style>
    .z_txx2{
        width: 400px;
        overflow:hidden;
    }
    .z_txx3{
        width: 300px;
        text-align: center;
        font-weight: 700;
    }
</style>
<script>
    $(document).ready(function(){
        <?php  $g = 0;?>
        <?php  if(is_array($list)) { foreach($list as $row) { ?>
            <?php  if($g==0) { ?>
                $("#firstpane<?php  echo $row['class_id'];?> .menu_body:eq(0)").show();
            <?php  } ?>
            
            $("#firstpane<?php  echo $row['class_id'];?> h3.menu_head").click(function(){
                $(this).addClass("current").next("div.menu_body").slideToggle(300).siblings("div.menu_body").slideUp("slow");
                $(this).siblings().removeClass("current");
            });
            <?php  $g++;?>
        <?php  } } ?>
    });
</script>
</div>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../xiaoye/newStudentFooter', TEMPLATE_INCLUDEPATH)) : (include template('../xiaoye/newStudentFooter', TEMPLATE_INCLUDEPATH));?>
</body>
</html>
