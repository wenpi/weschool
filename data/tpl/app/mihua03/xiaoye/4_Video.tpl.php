<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../xiaoye/head', TEMPLATE_INCLUDEPATH)) : (include template('../xiaoye/head', TEMPLATE_INCLUDEPATH));?>
<script src="<?php echo MODULE_URL;?>style/js/jq.getVideo.min.js" ></script>
<body>
    <div class="z_main">
        <div class="b4t">
            <li class="b4-t"> <div style=" background-image: url(<?php  echo $img;?>);width:136px;height:136px;border-radius: 50%" class="background_img" ></div> </li>
            <li class="btw1">
                <p><?php  echo $student_name;?><span> <?php  echo $class_name;?> </span></p>
            </li>
        </div>
            <?php  if($out_time_list && !$video_list) { ?>
                    <div style="width:100%;text-align:center">抱歉，请在每天的<code><?php  echo $out_time_list[0]['begin_time'];?></code>——<code><?php  echo $out_time_list[0]['end_time'];?></code>观看
                    </div>
            <?php  } ?>

        <div class="spp">
            <?php  if(is_array($video_list)) { foreach($video_list as $row) { ?>
                <li class="ps" style="margin-top:10px;">
                    <?php  if($row['video_type']==1) { ?>
                        <video width="908" height="454" controls poster="<?php  echo $_W['attachurl'];?>/<?php  echo $row['video_img'];?>" src="<?php  echo $row['video_url'];?>" >
                        </video>
                    <?php  } else if($row['video_type']==2) { ?>
                    <div style="min-height: 454px;">
                        <?php  echo htmlspecialchars_decode($row['html_content']); ?>
                    </div>
                    <?php  } else if($row['video_type']==3) { ?>
                        <div class="w-embed w-video" >
                            <div id="yst-video-box<?php  echo $row['video_id'];?>" class="video-box">
                            </div>
                        </div>
                            <script type='text/javascript'>
                                +(function($) {
                                $('#yst-video-box<?php  echo $row['video_id'];?>').getVideo({
                                    type: 0,  
                                    geturl: 'http://insytone.com/getvideo.php', 
                                    vid: '4',  
                                    code: 0,  
                                    ip: '<?php  echo $row['ip_addr'];?>', 
                                    port: '2005',  
                                    user: '<?php  echo $row['passport'];?>',  
                                    password: '<?php  echo $row['password'];?>',  
                                    dev: '', 
                                    src: '', 
                                    player: 0, 
                                    swfPath: 'js/', 
                                    res: 0, 
                                    ratio: '0', 
                                    auto: 1, 
                                    delay: 30000,
                                    duration: 0, 
                                    control: 0,
                                    list: 0, 
                                });
                                })(jQuery);
                            </script>  
                    <?php  } ?>
                    <li class="spwz"><p><?php  echo $row['video_name'];?></p></li>
                </li>
            <?php  } } ?>
       </div>
 </div>
 <script>
    var dos =0;
    function flushPage(){
        if(dos==1){
                location.href='<?php  echo $this->createMobileUrl('video')?>';
        }else{
            dos =1;
        }
    }
    $(function(){
        setInterval("flushPage()",600000);//十分钟
    });
 </script>
 <?php  if($_SESSION['teacher_mobile']) { ?>
    <link href="<?php echo MODULE_URL;?>style/css/weui.min.css" rel="stylesheet" type="text/css" />
    <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../new/tea_footer', TEMPLATE_INCLUDEPATH)) : (include template('../new/tea_footer', TEMPLATE_INCLUDEPATH));?>
 <?php  } else { ?>
    <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../xiaoye/footer', TEMPLATE_INCLUDEPATH)) : (include template('../xiaoye/footer', TEMPLATE_INCLUDEPATH));?>
 <?php  } ?>
</body>
</html>