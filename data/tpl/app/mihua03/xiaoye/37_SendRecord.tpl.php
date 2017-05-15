<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../xiaoye/newHead', TEMPLATE_INCLUDEPATH)) : (include template('../xiaoye/newHead', TEMPLATE_INCLUDEPATH));?>
<script>
    $( function(){
        $( 'audio' ).audioPlayer();
    });
</script>
<div class="z_main">
	<div class="TP">
		<p><?php  if($record_re['record_title']) { ?> <?php  echo $record_re['record_title'];?> <?php  } else { ?><?php  echo $record_re['record_intro'];?><?php  } ?></p>
			<p1> 发布时间:<?php  if($record_re['add_time']) { ?><?php  echo date("m-d H:i:s",$record_re['add_time'])?><?php  } else { ?><?php  echo date("m-d H:i:s",$record_re['addtime'])?><?php  } ?></p1>
	</div>
    <div class="head-solid" style="margin-bottom:5px;"></div>
      <div class="z_dp" >       
               <p><?php  if(!$record_re['record_content']) { ?> <?php  echo Htmlspecialchars_decode($record_re['record_intro']);?> <?php  } else { ?> <?php  echo Htmlspecialchars_decode($record_re['record_content']);?> <?php  } ?></p>
                <?php  if($record_re['voice']) { ?>
                    <div id="">
                        <audio preload="auto" controls  src="<?php  echo $this->imgFrom($record_re['voice']);?>">
                        </audio>
		            </div>
                <?php  } ?>   	
                <?php  $imgs =  $this->decodeLineImgsToArr($record_re['imgs']);?>
                 <?php  if($imgs) { ?>
                        <div class="z_dpt3" id="img_list">
                            <?php  if(is_array($imgs)) { foreach($imgs as $val) { ?>
                                <img src="<?php  echo $val;?>" onclick="displayImage('img_list','<?php  echo $val;?>')">
                            <?php  } } ?>
                        </div>            
                <?php  } ?>           
            <?php  $type = 1;?>
            <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../xiaoye/reply_new', TEMPLATE_INCLUDEPATH)) : (include template('../xiaoye/reply_new', TEMPLATE_INCLUDEPATH));?>
	</div>
    <?php  $footer_type = 'center';?>
     <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../xiaoye/newStudentFooter', TEMPLATE_INCLUDEPATH)) : (include template('../xiaoye/newStudentFooter', TEMPLATE_INCLUDEPATH));?>
    <?php  $not_hidden='yes';?>
    <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('jsweixin', TEMPLATE_INCLUDEPATH)) : (include template('jsweixin', TEMPLATE_INCLUDEPATH));?>
</div>
</body>
</html>
