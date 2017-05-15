<?php defined('IN_IA') or exit('Access Denied');?><script src="<?php echo MODULE_URL;?>/style/js/jquery.min.js"></script>
  <script>
        $(function(){
            home_width_con = $(".homework_img_list_control<?php  echo $page;?>");
            $.each(home_width_con,function(i,e){
                img_num = $(this).find('.homework_img_list').length;
                if(img_num){
                    if(img_num==2){
                        this_width  = '45%';
                        this_height = '130px';
                    }else if(img_num==1){
                        this_width  = '250px';
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
    <li class="z_bj" id="list_id_<?php  echo $row['photo_id'];?>">
        <div class="z_bj1">
            <i class="fa fa-clock-o" aria-hidden="true"></i>
        </div>
        <div class="z_bj11">
            <div class="z_bjt12" style="font-size: 16px;" ><?php  echo date("m-d H:i",$row['add_time']);?></div>
            <?php  $urls =  $this->decodeLineImgsToArr($row['photo_list']);?>
            <?php  if($urls) { ?>
                <div class="z_bjt14 homework_img_list_control<?php  echo $page;?> " id="img_list_<?php  echo $row['photo_id'];?>">
                <?php  if(is_array($urls)) { foreach($urls as $val) { ?>
                        <div class="homework_img_list wx_img_list" data-src="<?php  echo $val;?>" style='background-image:url(<?php  echo $val;?>)' onclick="displayImage('img_list_<?php  echo $row['photo_id'];?>','<?php  echo $val;?>')"></div>
                <?php  } } ?>
                </div>
            <?php  } ?> 
             <div class="z_bjt15" >
                    <p style="font-size:16px;">来自<?php  echo $row['sendname'];?><?php  if($row['title']) { ?>:<?php  echo $row['title'];?><?php  } ?></p>
            </div>
        </div>
    </li>
<?php  } } ?>