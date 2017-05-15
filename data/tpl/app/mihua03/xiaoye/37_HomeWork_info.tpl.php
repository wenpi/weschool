<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../xiaoye/newHead', TEMPLATE_INCLUDEPATH)) : (include template('../xiaoye/newHead', TEMPLATE_INCLUDEPATH));?>
<script>
    $( function(){
        $( 'audio' ).audioPlayer();
    });
</script>
    <div class="z_main">
        <div class="TP">
                <p><?php  echo date("Y-m-d",$re['add_time']);?>日<?php  echo $this->courseName($re['course_id']);?>作业</p>
                <p1>发布:<?php  if($re['teacher_realname']) { ?><?php  echo $re['teacher_realname'];?><?php  } else { ?>管理员<?php  } ?></p1>
        </div>
        <div class="head-solid"></div>
        <div class="z_dp">
                <?php  if($re['voice']) { ?>
                    <div id="">
                        <audio preload="auto" controls src="<?php  echo $this->imgFrom($re['voice'])?>">
                        </audio>
                    </div>                
                <?php  } ?>
                <div>
                    <p><?php  echo myHtmlspecialchars_decode($re['content'])?></p>
                </div>
                <div class="z_dpt3" id="img_list">
                    <?php  $urls =  $this->decodeLineImgsToArr($re['img']);?>
                        <?php  if($urls) { ?>
                            <?php  if(is_array($urls)) { foreach($urls as $val) { ?>
                            <img src="<?php  echo $val;?>"  onclick="displayImage('img_list','<?php  echo $val;?>')">
                            <?php  } } ?>
                        <?php  } ?>           
                </div>

        </div>
    </div>
    <?php  $footer_type = 'center';?>
     <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../xiaoye/newStudentFooter', TEMPLATE_INCLUDEPATH)) : (include template('../xiaoye/newStudentFooter', TEMPLATE_INCLUDEPATH));?>
    <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('jsweixin', TEMPLATE_INCLUDEPATH)) : (include template('jsweixin', TEMPLATE_INCLUDEPATH));?>
</body>
</html>
