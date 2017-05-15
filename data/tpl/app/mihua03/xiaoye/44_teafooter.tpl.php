<?php defined('IN_IA') or exit('Access Denied');?><div style="height:120px; overflow:hidden; width:100%;"></div>
<div class="caidan">
    <ul>
    <?php  $class_mobile = D('mobile');?>
    <?php  $button_list  = $class_mobile->getButtonNav(false,false); ?>
    <?php  if(is_array($button_list)) { foreach($button_list as $row) { ?>
           <li> <a href="<?php  if($row['keyword']=='school_home') { ?>
                        <?php  if($this->school_info['host_url'] ) { ?><?php  echo $this->school_info['host_url'];?><?php  } else { ?><?php  echo $this->createMobileUrl('wapHome',array('school_id'=>$this->school_info['school_id'] ) )?> <?php  } ?> 
                    <?php  } else if(!$row['url']) { ?>
                        <?php  echo $this->createMobileUrl($row['keyword'])?>
                    <?php  } else { ?>
                        <?php  echo $row['url'];?>
                    <?php  } ?> " class="weui_tabbar_item weui_bar_item_on">
                    <img src="<?php  echo $row['xiaoyeimg'];?>">
            </a></li>        
      <?php  } } ?>
    </ul>
</div>