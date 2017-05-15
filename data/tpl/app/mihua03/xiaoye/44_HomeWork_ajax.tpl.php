<?php defined('IN_IA') or exit('Access Denied');?>  <script>
        $(function(){
            $('.voice_<?php  echo $page;?>' ).audioPlayer();
            home_width_con = $(".homework_img_list_control<?php  echo $page;?>");
            $.each(home_width_con,function(i,e){
                img_num = $(this).find('.homework_img_list').length;
                if(img_num){
                    if(img_num==2){
                        this_width  = '120px';
                        this_height = '120px';
                    }else if(img_num==1){
                        this_width  = '200px';
                        this_height = '300px';
                    }
                    if(img_num<3){
                        $(this).find('.homework_img_list').css('height',this_height); 
                        $(this).find('.homework_img_list').css('width',this_width); 
                    }
                }
            });
        });
 </script>
    <?php  if(is_array($list)) { foreach($list as $row) { ?>
        <div class="zy">
        <div class="zy-tp">
            <div style="width:60px;height:60px;border-radius:50%;background-image: url(<?php  echo D('teacher')->teacherImg($row['teacher_id']);?>)" class="background_img"></div>
        </div>
        <div class="zy-t">
            <p><?php  if($row['teacher_realname']) { ?><?php  echo $row['teacher_realname'];?><?php  } else { ?>管理员<?php  } ?></p>
            <p><span>(<?php  echo $this->courseName($row['course_id']);?>)</span></p>
        </div>
        <div class="zy-tt">
             <a href="<?php  echo $this->createMobileUrl('homeWork_info',array('id'=>$row['homework_id']));?>">
                <p><?php  echo $this->clear_html_short($row['content']);?>......</p>
            </a>
        </div>
        <?php  $urls =  $this->decodeLineImgsToArr($row['img']);?>
                <?php  if($urls) { ?>
                    <div class="zy-t-t homework_img_list_control<?php  echo $page;?>">
                    <a href="<?php  echo $this->createMobileUrl('homeWork_info',array('id'=>$row['homework_id']));?>" >
                        <?php  if(is_array($urls)) { foreach($urls as $val) { ?>
                        <div class="homework_img_list background_img" style='background-image:url(<?php  echo $val;?>)'></div>
                        <?php  } } ?>
                    </a>
                    </div>
        <?php  } ?>
        <?php  if($row['voice']) { ?>
            <div class="zy-yyy">
                <div>
                    <audio preload="auto" controls class='voice_<?php  echo $page;?>'>
                        <source src="<?php  echo $this->imgFrom($row['voice'])?>">
                    </audio>
                  </div>                
            </div>
        <?php  } ?>
        <div style="clear: both"></div>
            <div class="zy-b">
                    <p><?php  echo date("Y-m-d",$row['add_time']);?>&nbsp;</p>
                    <p><?php  echo date("H:i:s",$row['add_time']);?></p>
            </div>

        </div>
    <?php  } } ?>