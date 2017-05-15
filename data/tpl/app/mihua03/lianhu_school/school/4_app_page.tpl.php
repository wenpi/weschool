<?php defined('IN_IA') or exit('Access Denied');?>      <div class="w-clearfix options-new less-padding-sides-blog border-top">
        <?php  if($now_page>1) { ?>
            <a class="w-clearfix w-inline-block small-button icon-only " href="<?php  echo $this->createMobileUrl($page_controller,array('page'=>$now_page-1 ))?>">
            <div class="icon-button">
                <div class="icon ion-ios-arrow-left bigger"></div>
            </div>
            </a>
        <?php  } else { ?>
          <a class="w-clearfix w-inline-block small-button icon-only grey" href="#">
            <div class="icon-button">
                <div class="icon ion-ios-arrow-left bigger"></div>
            </div>
            </a>         
        <?php  } ?>
        <?php  if($now_page>=$max_page) { ?>
           <a class="w-clearfix w-inline-block small-button grey last right" href="#">
            <div class="icon-button bigger">
                <div class="icon ion-ios-arrow-right"></div>
            </div>
            <div class="text-button">下一页</div>
            </a>
        <?php  } else { ?>
            <a class="w-clearfix w-inline-block small-button  last right" href="<?php  echo $this->createMobileUrl($page_controller,array('page'=>$now_page+1 ))?>">
            <div class="icon-button bigger">
                <div class="icon ion-ios-arrow-right"></div>
            </div>
            <div class="text-button">下一页</div>
            </a>
        <?php  } ?>
        <span class='page_count'><?php  echo $now_page;?>/<?php  echo $max_page;?></span>

      </div>