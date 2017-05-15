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
            <div class="z_dpt"><?php  echo date("Y-m-d",$re['add_time']);?>日<?php  echo $this->courseName($re['course_id']);?>家庭作业</div>
                <div class="z_dpt1">发布：<?php  if($re['teacher_realname']) { ?><?php  echo $re['teacher_realname'];?><?php  } else { ?>管理员<?php  } ?></div>
                <?php  if($re['voice']) { ?>
                    <div id="">
                        <audio preload="auto" controls >
                            <source src="<?php  echo $this->imgFrom($re['voice'])?>" />
                        </audio>
                    </div>                
                <?php  } ?>
                <div class="z_dpt3" id="img_list">
                    <?php  $urls =  $this->decodeLineImgsToArr($re['img']);?>
                        <?php  if($urls) { ?>
                            <?php  if(is_array($urls)) { foreach($urls as $val) { ?>
                            <img src="<?php  echo $val;?>" style="margin-top:10px;" onclick="displayImage('img_list','<?php  echo $val;?>')">
                            <?php  } } ?>
                        <?php  } ?>           
                </div>
                <div class="z_dpt4">
                    <p><?php  echo htmlspecialchars_decode($re['content'])?></p>
                </div>
        </div>
    </div>
    <?php  $footer_type = 'center';?>
    <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../xiaoye/footer', TEMPLATE_INCLUDEPATH)) : (include template('../xiaoye/footer', TEMPLATE_INCLUDEPATH));?>
    <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('jsweixin', TEMPLATE_INCLUDEPATH)) : (include template('jsweixin', TEMPLATE_INCLUDEPATH));?>
</body>
</html>
