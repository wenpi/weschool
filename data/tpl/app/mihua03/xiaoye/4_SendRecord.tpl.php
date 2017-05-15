<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../xiaoye/head', TEMPLATE_INCLUDEPATH)) : (include template('../xiaoye/head', TEMPLATE_INCLUDEPATH));?>
<script src="<?php echo MODULE_URL;?>/template/xiaoye/js/load.js"></script>
<script src="<?php echo MODULE_URL;?>/template/xiaoye/js/audioplayer.js"></script>
<script>
    $( function(){
        $( 'audio' ).audioPlayer();
    });
</script>
<body>

<div class="z_main">
	<div class="z_dp">
		<div class="z_dpt"><?php  if($record_re['record_title']) { ?> <?php  echo $record_re['record_title'];?> <?php  } else { ?><?php  echo $record_re['record_intro'];?><?php  } ?></div>
			<div class="z_dpt1"> 发布时间:<?php  if($record_re['add_time']) { ?><?php  echo date("m-d H:i:s",$record_re['add_time'])?><?php  } else { ?><?php  echo date("m-d H:i:s",$record_re['addtime'])?><?php  } ?></div>
            <div id="">
            <?php  if($record_re['voice']) { ?>
                	<audio preload="auto" controls  src="<?php  echo $this->imgFrom($record_re['voice']);?>">
	                </audio>
            <?php  } ?>   	
		    </div>
            <div class="z_dpt3" id="img_list">
                    <?php  $urls =  $this->decodeLineImgsToArr($record_re['imgs']);?>
                        <?php  if($urls) { ?>
                            <?php  if(is_array($urls)) { foreach($urls as $val) { ?>
                            <img src="<?php  echo $val;?>" style="margin-top:10px;" onclick="displayImage('img_list','<?php  echo $val;?>')">
                            <?php  } } ?>
                        <?php  } ?>           
            </div>            
            <div class="z_dpt4">
               <p><?php  echo myHtmlspecialchars_decode($record_re['record_content']);?></p>
            </div>
            <?php  $type = 1;?>
            <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../xiaoye/reply', TEMPLATE_INCLUDEPATH)) : (include template('../xiaoye/reply', TEMPLATE_INCLUDEPATH));?>
	</div>
    <?php  $footer_type = 'center';?>
     <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../xiaoye/newStudentFooter', TEMPLATE_INCLUDEPATH)) : (include template('../xiaoye/newStudentFooter', TEMPLATE_INCLUDEPATH));?>
    <?php  $not_hidden='yes';?>
    <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('jsweixin', TEMPLATE_INCLUDEPATH)) : (include template('jsweixin', TEMPLATE_INCLUDEPATH));?>
</div>
</body>
</html>
