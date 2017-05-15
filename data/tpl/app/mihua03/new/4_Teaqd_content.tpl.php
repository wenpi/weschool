<?php defined('IN_IA') or exit('Access Denied');?>        <?php  if(is_array($list)) { foreach($list as $row) { ?>
        <div class="weui_panel_bd" style="border-bottom: 1px solid #eee;">
            <a href="<?php  echo $this->createMobileUrl('TeaqdInfo', array('id' => $row['activity_id']))?>">
                <div class="weui_media_box weui_media_text">
                    <p class="weui_media_desc">活动：<?php  echo $row['activity_name'];?></p>
                    <p class="weui_media_desc">  地点：<?php  echo $row['activity_address'];?></p>
                    <p class="weui_media_desc">  扫码截止时间： <?php  echo date("m-d H:i",$row['endtime'])?></p>
                    <a  class='weui_qrcode' style="color:#ff0033" href="<?php  echo $this->createMobileUrl("TeaqdInfo",array("id"=>$row['activity_id'] ) )?>">
                            <i class=" fa fa-info">扫码详情</i>
                    </a>
                    <?php  if($row['endtime']>TIMESTAMP) { ?>
                        <a  class='weui_qrcode' href="<?php  echo $this->createMobileUrl("TeaqdQrcode",array("id"=>$row['activity_id'] ) )?>">
                            <i class=" fa fa-qrcode">二维码</i>
                        </a>
                    <?php  } ?>
                </div>
            </a>
        </div>
        <?php  } } ?>