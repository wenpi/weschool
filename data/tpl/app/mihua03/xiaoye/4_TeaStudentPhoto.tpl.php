<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../xiaoye/newTeaHead', TEMPLATE_INCLUDEPATH)) : (include template('../xiaoye/newTeaHead', TEMPLATE_INCLUDEPATH));?>
<body>
	<div class="main">
        <div class="bl">学生相册</div>
        <ul class="bll">
            <?php  if($model=='class') { ?>
                <?php  if(is_array($result)) { foreach($result as $item) { ?>
                    <li class="bjlb">
                        <div class="bl1"><a href="<?php  echo $this->result_result($item,$model,'url','teaStudentPhoto');?>"><p><?php  echo $this->classGradeName($item)?></p></a><a href="<?php  echo $this->result_result($item,$model,'url','teaStudentPhoto');?>"><p><?php  echo $this->className($item)?></p></a></div>
                        <div class="bl2"><a href="<?php  echo $this->result_result($item,$model,'url','teaStudentPhoto');?>"><img src="<?php echo MODULE_URL;?>/template/xiaoye/upimg/teacherimg//jt.png"></a></div>
                    </li>            
                <?php  } } ?>
            <?php  } else if($model=='student') { ?>
                <?php  if(is_array($result)) { foreach($result as $item) { ?>
                    <li class="bjlb">
                            <div class="bl1"><a href="<?php  echo $this->createMobileUrl("teaStudentPhoto",array("model"=>"someone","sid"=>$item['student_id']) ) ;?>"><p><?php  echo $this->result_result($item,$model,'name','work');?></p></a></div>
                            <div class="bl2"><a href="<?php  echo $this->createMobileUrl("teaStudentPhoto",array("model"=>"someone","sid"=>$item['student_id']) ) ;?>"><img src="<?php echo MODULE_URL;?>/template/xiaoye/upimg/teacherimg//jt.png"></a></div>
                    </li>  
                <?php  } } ?>
            <?php  } else { ?>
            <div class="fsnr">
                    <form method="post" >
                    <div class="fsgg">添加新的相册【<?php  echo $result['student_name'];?>】</div>
                    <div class="sfs1"><p> 记录名</p><input type="text" name="title" required></div>
                    <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../xiaoye/upTeaImgs', TEMPLATE_INCLUDEPATH)) : (include template('../xiaoye/upTeaImgs', TEMPLATE_INCLUDEPATH));?>
                    <input type="hidden" name="sid"  class="form-control" value='<?php  echo $_GPC['sid'];?>' />
                    <input type="hidden" value="<?php  echo $token;?>"  name='token'>
                    <div class="mf"><a href="#"><input type="submit"  name="submit" value="提交" /></a></div>
                    </form>	
            </div>
            <?php  } ?>
        </ul>    
    </div>
    <?php  $center_class = 'cde'?>
    <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../xiaoye/newTeaFooter', TEMPLATE_INCLUDEPATH)) : (include template('../xiaoye/newTeaFooter', TEMPLATE_INCLUDEPATH));?>
    <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('jsweixin', TEMPLATE_INCLUDEPATH)) : (include template('jsweixin', TEMPLATE_INCLUDEPATH));?>

</body>
</html>
