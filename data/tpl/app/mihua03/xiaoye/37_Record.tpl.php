<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../xiaoye/newHead', TEMPLATE_INCLUDEPATH)) : (include template('../xiaoye/newHead', TEMPLATE_INCLUDEPATH));?>
<div class="z_main">
    <div class="head">
        <?php  $width = 100/count($list);?>
        <?php  if(is_array($list)) { foreach($list as $row) { ?>
                <a href="<?php  echo $this->createMobileUrl('record',array('op'=>$row['class_id']));?>" style="width:<?php  echo $width;?>% !important"  <?php  if($class_id==$row['class_id']) { ?>class="pp"<?php  } ?>  ><p> <?php  echo $row['class_name'];?></p></a>
        <?php  } } ?>
    </div>
    <div class="MD">
          <?php  if(is_array($jilv_list)) { foreach($jilv_list as $row) { ?>
                <li class="dpl">
                    <div class="WX"> <a href="<?php  echo $this->createMobileUrl('record_article',array('wid'=>$row['work_id']));?>"><div  style="width:60px;height: 60px;border-radius: 50%;  background-image: url(<?php  echo D('teacher')->teacherImg($row['teacher_id']);?>)" class="background_img"></div></a></div>
                    <div class="WZ" >
                        <a href="<?php  echo $this->createMobileUrl('record_article',array('wid'=>$row['work_id']));?>" >
                            <p><span class="W-1"><?php  echo $row['word'];?></span></p>
                            <p class="W-3"><?php  echo $this->clear_html_short($row['content']);?></p>
                        </a>
                    </div>
                </li>
            <?php  } } ?> 
    </div>
</div>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../xiaoye/newStudentFooter', TEMPLATE_INCLUDEPATH)) : (include template('../xiaoye/newStudentFooter', TEMPLATE_INCLUDEPATH));?>
</body>
</html>