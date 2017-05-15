<?php defined('IN_IA') or exit('Access Denied');?>
	 <link rel="stylesheet" href="<?php echo MODULE_URL;?>template/mobile/style/swiper-3.3.1.min.css">
    <script src="<?php echo MODULE_URL;?>template/mobile/style/swiper-3.3.1.min.js"></script> 
    <div id="header" class="swiper-container-horizontal swiper-container-free-mode">
    <div id="top-line"></div>
    <div class="swiper-wrapper">
    <div class="swiper-slide swiper-slide-active">
	<a href="<?php  echo $this->createMobileUrl('line')?>">
					<em class="line1">班级圈</em>
				</a>
				</div>
    <div class="swiper-slide swiper-slide-next"  >
	<a href="<?php  echo $this->createMobileUrl('line_other',array('op'=>'home_work'));?>">
					<em style="<?php  if($op=='home_work') { ?>color:#009ffb;<?php  } ?>">家庭作业</em>
				</a>
	</div>
    <?php  if(is_array($_W['line_type'])) { foreach($_W['line_type'] as $row) { ?>
              <div class="swiper-slide">
                    <a href="<?php  echo $this->createMobileUrl('line_other',array('op'=>$row));?>">
                        <em   style="<?php  if($op==$row) { ?>color:#009ffb;<?php  } ?>"><?php  echo $row;?></em>
                    </a>
                </li>
				 </div>
     <?php  } } ?>
    <div class="swiper-slide"><a href="<?php  echo $this->createMobileUrl('home')?>">
					<em>学生中心</em>
				</a></div>
  </div>
</div>
<script> 
var mySwiper = new Swiper('#header',{
    freeMode : true,
    slidesPerView : 'auto',
})
</script>
