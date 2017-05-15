<?php defined('IN_IA') or exit('Access Denied');?><script src="<?php echo MODULE_URL;?>/style/js/jquery.min.js"></script>
<link href="<?php echo MODULE_URL;?>assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
<script>
        $(function(){
            home_width_con = $(".homework_img_list_control<?php  echo $page;?>");
            $.each(home_width_con,function(i,e){
                img_num = $(this).find('.homework_img_list').length;
                if(img_num){
                    if(img_num==2){
                        this_width  = '45%';
                        this_height = '150px';
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
        function  selectPicTo(obj,pic_url){
            val = $(obj).attr('data-do');
            if(val==0){
                $(obj).attr('data-do',1);
                $(obj).css('color','#ff6f90');
                $(obj).find('.no_select').hide();
                $(obj).find('.select').show();
                $.ajax({
                    url:"<?php  echo $this->createMobileUrl('sendStudentPhoto')?>",
                    type:'post',
                    data:{pic_url:pic_url},
                    success:function(content){
                        // 回调
                    }
                });
            }
            event.stopPropagation();
        }
 </script>
<?php  if(is_array($list)) { foreach($list as $row) { ?>
    <li class="z_bj" id="list_id_<?php  echo $row['send_id'];?>">
        <div class="z_bj1">
            <img src="<?php  echo $row['member_img'];?>">
        </div>
        <div class="z_bj11">
            <div class="z_bjt12"><?php  echo $row['member_name'];?><span style="padding-left:0px;"><?php  if($row['member_name_other']) { ?>(<?php  echo $row['member_name_other'];?>)<?php  } ?></span>
            <div class="z_bjt121">
               <?php  if($uid == $row['send_uid']  || $in_type['type']=='teacher' ) { ?>
                <?php  if($in_type['type']=='teacher' && $row['send_status']==2) { ?>
                    <div  class="pass " data-send='<?php  echo $row['send_id'];?>' id="pass<?php  echo $row['send_id'];?>" >
                        <i class="fa fa-check" aria-hidden="true" style="color:#00ff00;position:relative;top:10px;" ></i>
                    </div>                            
                <?php  } ?>
                    <div  data-send='<?php  echo $row['send_id'];?>' class="delete"   >
                        <img src="<?php echo MODULE_URL;?>template/xiaoye/upimg/delete.png">
                    </div>
                <?php  } ?>
            </div></div>
            <div class="z_bjt13"><?php  echo $row['send_content'];?>
                <?php  if($in_type['type']!='teacher') { ?>
                    <span class='no_pass'><?php  if($row['send_status']==2) { ?>审核中<?php  } ?></span>
                <?php  } ?>
            </div>
            <?php  $urls =  $this->decodeLineImgsToArr($row['send_image']);?>
            <?php  if($urls) { ?>
                <div class="z_bjt14 homework_img_list_control<?php  echo $page;?> " id="img_list_<?php  echo $row['send_id'];?>">
                <?php  if(is_array($urls)) { foreach($urls as $val) { ?>
                       <?php  $getre = D('lineStudentPhoto')->getEdit($in_type['info']['student_id'],$val);?>
                        <div class="homework_img_list wx_img_list" data-src="<?php  echo $val;?>" style='background-image:url(<?php  echo $val;?>)' onclick="displayImage('img_list_<?php  echo $row['send_id'];?>','<?php  echo $val;?>')">
                            <?php  if($in_type['type']!='teacher') { ?>
                            <div class="on_select" onclick=" return selectPicTo(this,'<?php  echo $val;?>')" <?php  if($getre) { ?>  data-do='1' style="color:#ff6f90" <?php  } else { ?> data-do='0' <?php  } ?> >
                                <i class="fa fa-star-o  no_select" aria-hidden="true"  <?php  if($getre) { ?>   style="display: none" <?php  } ?> ></i>
                                <i class="fa fa-star    select   " aria-hidden="true"  <?php  if(!$getre) { ?>   style="display: none" <?php  } ?> ></i>
                            </div>
                            <?php  } ?>
                            
                        </div>
                <?php  } } ?>
                </div>
            <?php  } ?> 
            <!--视频-->
            <?php  if($row['sendvideo']) { ?>
            <div class="z_bjt13" style="height:200px;">
                <video src="<?php  echo tomedia($row['sendvideo'])?>" preload='none' controls="controls" style="width: 100%; heigth:200px;" height="200"  webkit-playsinline></video>
            </div>
            <?php  } ?>

            <div class="z_bjt15">
                    <p><?php  echo date("m-d H:i",$row['add_time']);?></p>
                    <?php  $zan_have = $this->zanLine($row['send_id']);?>
                    <p class="z_bbt"><a href="javascript:;" class="zan" id="zan_<?php  echo $row['send_id'];?>" data-send='<?php  echo $row['send_id'];?>'> <img src="<?php  if($zan_have==1) { ?><?php echo MODULE_URL;?>/template/xiaoye/img/dz.png<?php  } else { ?><?php echo MODULE_URL;?>/template/xiaoye/img/dz-h.png<?php  } ?>"></a>
                    <a href="javascript:;" class="huifu" data-id='<?php  echo $row['send_id'];?>' ><img src=" <?php  if($in_type['type']!='teacher') { ?><?php echo MODULE_URL;?>/template/xiaoye/img/pl.png<?php  } else { ?><?php echo MODULE_URL;?>/template/xiaoye/upimg/teacherimg/pl.png<?php  } ?>"></a></p>
            </div>
            <!--评论点赞-->
            <?php  $zan_content =  D('line')->getLineZanName($row['send_id']);?>
            <?php  $comment_list = D('line')->getLineComment($row['send_id']);?>
            <div class="z_bjt16" id="people_<?php  echo $row['send_id'];?>" style="<?php  if(!$zan_content && !$comment_list) { ?>display:none;<?php  } ?>">
                <div class="z_bjt161"></div>
                    <div class="z_bjt164">
                        <div class="z_bjt162 like_name" id="like_num_<?php  echo $row['send_id'];?>"  style="color:#33cbd5;<?php  if(!$zan_content) { ?>display:none;<?php  } ?>" >
                            <?php  echo $zan_content;?>
                        </div>
                        <div class="z_bjt163 comment_list_line"  id="comment_list_line<?php  echo $row['send_id'];?>"  style="color:#33cbd5;<?php  if(!$comment_list) { ?>display:none;<?php  } ?>" >
                            <?php  if($comment_list ) { ?>
                                    <?php  if(is_array($comment_list)) { foreach($comment_list as $val) { ?>
                                        <p onclick="deleteComment(<?php  echo $val['comment_uid'];?>,<?php  echo $val['comment_id'];?>)" id="comment_<?php  echo $val['comment_id'];?>"><?php  echo $val['nickname'];?>：<?php  echo $val['comment_text'];?></p>
                                    <?php  } } ?>
                            <?php  } ?>                   
                        </div>
                </div>
            </div>
        </div>
    </li>
<?php  } } ?>


