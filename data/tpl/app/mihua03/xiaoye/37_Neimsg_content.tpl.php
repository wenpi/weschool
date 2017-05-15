<?php defined('IN_IA') or exit('Access Denied');?>    <?php  if(is_array($list)) { foreach($list as $row) { ?>
        <div class="tzz">
                <div class="top">
                    <div class="t-rq">
                        <p><?php  if($row['add_time']) { ?> <?php  echo date("m-d",$row['add_time'])?> <?php  } else { ?><?php  echo date("m-d",$row['addtime'])?><?php  } ?></p>
                    </div>
                        <div class="t-fb">
                            <p1>发布者：<?php  echo $row['admin_name'];?></p1>
                        </div>
                </div>
                    <div class="tz-nr">
                        <a href="<?php  echo $this->createMobileUrl("msg_content",array('id'=>$row['msg_id']));?>">
                            <p class="p"><?php  echo $row['msg_title'];?></p>
                        </a>
                    </div>
                      <a href="<?php  echo $this->createMobileUrl("msg_content",array('id'=>$row['msg_id']));?>">
                            <div class="tz-nn">
                                <p class="p"><?php  echo S('fun','formatLimitContent',array($row['msg_content'],50));?>...</p>
                            </div>
                         <?php  if($row['img']) { ?>
                            <div class="tz-tp">
                                <div class="wx_img_list" data-src="<?php  echo $this->imgFrom($row['img'])?>" style="margin:auto;margin-bottom:1%;width: 92%;height:200px;background-image: url( <?php  echo $this->imgFrom($row['img'])?> );	background-size: cover;background-position: center;" >
                                </div>
                            </div>                   
                            <div class="tz-mm"></div>
                         <?php  } else { ?>
                           <div class="tz-mm" style="margin-top:10px;"></div>
                         <?php  } ?>
                      </a>
           </div>
    <?php  } } ?>