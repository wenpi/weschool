<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../new/head', TEMPLATE_INCLUDEPATH)) : (include template('../new/head', TEMPLATE_INCLUDEPATH));?>
<script type='text/javascript' src='<?php echo MODULE_URL;?>/style/js/jquery.min.js'></script>
<body ontouchstart >
<div class="container" id="container">
    <div class="article">
    <div class="bd">
        <article class="weui_article"> 
            <h1><?php  echo $info['booking_title'];?></h1>
            <h3 style="color:#777">发布时间：<?php  echo date("Y-m-d H:i:s",$info['add_time'])?></h3>
            <?php  $img_src =S("fun",'imgFrom',array($info['booking_img'] ,$this->module['config']['qiniu_url'] )); ?>
            <img src='<?php  echo $img_src;?>' style="width:90%;margin-left:5%;margin-top:10px;">
            <section>
                    <?php  echo htmlspecialchars_decode($info['booking_content']);?>
            </section>
       </article>
        <form method="post" action="<?php  echo $this->createMobileUrl("booking_list");?>">
           <input type="hidden" name="id"   value="<?php  echo $id;?>">
                <div class="weui_cells_title">基本信息</div>
                <div class="weui_cells weui_cells_form">
                    <div class="weui_cell">
                        <div class="weui_cell_hd"><label class="weui_label">报&nbsp;名&nbsp;人</label></div>
                        <div class="weui_cell_bd weui_cell_primary">
                            <input class="weui_input" type="text" name="my_name"  placeholder="请输入您的姓名" >
                        </div>
                    </div>
                     <?php  if($info['ask_name']) { ?>
                        <div class="weui_cell">
                            <div class="weui_cell_hd"><label class="weui_label">孩子姓名</label></div>
                            <div class="weui_cell_bd weui_cell_primary">
                                <input class="weui_input" type="text" name="list_name"  placeholder="请填写的孩子姓名" required>
                            </div>
                        </div>                  
                    <?php  } ?>
                     <?php  if($info['ask_phone']) { ?>
                        <div class="weui_cell">
                            <div class="weui_cell_hd"><label class="weui_label">联系电话</label></div>
                            <div class="weui_cell_bd weui_cell_primary">
                                <input class="weui_input" type="text" name="list_phone"  placeholder="您的联系电话" required>
                            </div>
                        </div>                  
                    <?php  } ?>       
                     <?php  if($info['ask_id']) { ?>
                        <div class="weui_cell">
                            <div class="weui_cell_hd"><label class="weui_label">身份证号</label></div>
                            <div class="weui_cell_bd weui_cell_primary">
                                <input class="weui_input" type="text" name="list_people_id"  placeholder="请填写您的身份证号"  required>
                            </div>
                        </div>                  
                    <?php  } ?> 
                </div>
                <div class="weui_cells_title">报名备注</div>
                <div class="weui_cells weui_cells_form">
                        <div class="weui_cell">
                            <div class="weui_cell_bd weui_cell_primary">
                                <textarea class="weui_textarea" placeholder="请输入一些基本情况" rows="3" name="list_content" required ></textarea>
                                <div class="weui_textarea_counter"></div>
                            </div>
                        </div>
                 </div>
                 <div class="weui_btn_area">
                    <input type="submit" name="submit" class="weui_btn weui_btn_primary" value="点击提交">
                </div>
            </form>
    </div>
    </div>
    </div>
    <div class="page-content loading-mask" id="new-stack">
      <div class="loading-icon">
        <div class="navbar-button-icon icon ion-load-d"></div>
      </div>
    </div>