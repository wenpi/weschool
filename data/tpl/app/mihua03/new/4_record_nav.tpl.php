<?php defined('IN_IA') or exit('Access Denied');?>	<link rel="stylesheet" href="<?php echo MODULE_URL;?>template/mobile/style/swiper-3.3.1.min.css">
    <script src="<?php echo MODULE_URL;?>template/mobile/style/swiper-3.3.1.min.js"></script> 
    <div id="header" class="swiper-container-horizontal swiper-container-free-mode">
    <div id="top-line"></div>
    <div class="swiper-wrapper">
    <?php  if(is_array($list)) { foreach($list as $row) { ?>
              <div class="swiper-slide">
                    <a href="<?php  echo $this->createMobileUrl('record',array('op'=>$row['class_id']));?>">
                        <span   style="<?php  if($class_id==$row['class_id']) { ?>color:#009ffb;<?php  } ?>"> <?php  echo $row['class_name'];?> </span>
                    </a>
                </li>
				 </div>
     <?php  } } ?>
  </div>
</div>
<script> 
var mySwiper = new Swiper('#header',{
    freeMode : true,
    slidesPerView : 'auto',
})
</script>
