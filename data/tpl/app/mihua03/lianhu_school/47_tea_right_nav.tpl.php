<?php defined('IN_IA') or exit('Access Denied');?>
	 <link rel="stylesheet" href="<?php echo MODULE_URL;?>template/mobile/style/swiper-3.3.1.min.css">
    <script src="<?php echo MODULE_URL;?>template/mobile/style/swiper-3.3.1.min.js"></script> 
    <div id="header" class="swiper-container-horizontal swiper-container-free-mode">
    <div id="top-line"></div>
    <div class="swiper-wrapper">
    <div class="swiper-slide swiper-slide-active">
	<a href="<?php  echo $this->createMobileUrl('line',array("class_id"=>$_GPC['class_id'] ))?>">
					<em class="line1">班级圈</em>
				</a>
				</div>
    <div class="swiper-slide swiper-slide-next"  >
	<a href="<?php  echo $this->createMobileUrl('teacenter',array('op'=>'teacenter'));?>">
					<em style="<?php  if($op=='home_work') { ?>color:#009ffb;<?php  } ?>">教师中心</em>
				</a>
	</div>

  </div>
</div>
<script> 
var mySwiper = new Swiper('#header',{
    freeMode : true,
    slidesPerView : 'auto',
})
</script>
