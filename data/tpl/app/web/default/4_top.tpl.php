<?php defined('IN_IA') or exit('Access Denied');?>					<div class="top-header">
						<div class="container">
						<div class="logo">
							<a href="<?php  echo $this->createMobileUrl('pcHome',array('school_id'=>$_SESSION['school_id']))?>"><h1><?php  echo $_SESSION['school_name'];?></h1></a>
						</div>
					<div class="top-menu">
							<span class="menu"> </span>
								<ul class="cl-effect-16">
								<?php  $class_pc=D(pc);?>
								<?php  $nav_list = $class_pc->getNav();?>
								<?php  if(is_array($nav_list)) { foreach($nav_list as $row) { ?>
									<li><a <?php  if($top_nav == $row['info_name']) { ?>class="active" <?php  } ?> 
										href="<?php  echo $row['out_href'];?>" data-hover="<?php  echo $row['info_name'];?>"><?php  echo $row['info_name'];?></a></li>
								<?php  } } ?>
    							  <div class="clearfix"></div>
								</ul>
							</div>
							<!-- script-for-menu -->
								<script>
									$("span.menu").click(function(){
										$(".top-menu ul").slideToggle("slow" , function(){
										});
									});
								</script>
								<!-- script-for-menu -->
							<div class="clearfix"> </div>
					</div>
				</div>