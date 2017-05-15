<?php defined('IN_IA') or exit('Access Denied');?><?php  $title = "添加签到活动-".$_SESSION['school_name']?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('school/app_header', TEMPLATE_INCLUDEPATH)) : (include template('school/app_header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('tea_common', TEMPLATE_INCLUDEPATH)) : (include template('tea_common', TEMPLATE_INCLUDEPATH));?>
<link rel="stylesheet" type="text/css" href="<?php echo MODULE_URL;?>/style/css/style.css">
<link href="<?php echo MODULE_URL;?>/style/new/bottom.css" rel="stylesheet" type="text/css" />
<link href="<?php echo MODULE_URL;?>style/css/weui.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo MODULE_URL;?>style/css/new_style.css" rel="stylesheet" type="text/css" />
<link href="<?php echo MODULE_URL;?>style/css/weui2.css" rel="stylesheet" type="text/css" />
<link href="<?php echo MODULE_URL;?>style/css/weui_example.css" rel="stylesheet" type="text/css" />
<link href="<?php echo MODULE_URL;?>style/css/line_css.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="<?php echo MODULE_URL;?>template/mobile/style/style_nav.css">

<body>
  <div class="body" style="padding-top:0px;padding-bottom:60px;background-color:#fff;">
        <div class="w-tabs" data-duration-in="400" data-duration-out="400" data-easing="ease-out-quint">
            <div class="teaqd_head">
                <span>添加签到活动</span>
                <a href="<?php  echo $this->createMobileUrl("Teaqd")?>">列表</a>
            </div>

            <div class="w-tab-content tabs-content" style="background-color:#fff;padding-top:20px;">
                <div class="w-tab-pane  w--tab-active tab-pane" data-w-tab="Tab 1">
                    <form enctype="multipart/form-data" id="new_article" method="post" class="post-form" > 
                        <div class="w-clearfix portfolio-gallery home_word_class_list " id='home_word_class_list' >
                            <?php  if(is_array($result)) { foreach($result as $item) { ?>
                                <input type='checkbox' style="padding-left:2%;display:none" name='class_list[]' value='<?php  echo $item;?>' id='class_id_<?php  echo $item;?>'>
                                <a class="w-lightbox w-inline-block portfolio-item grid-3-columns" href="javascript:;" data-load="1" data-id='<?php  echo $item;?>' onclick="selectClass(this)" >
                                    <div class="group-image">
                                        <div><?php  echo $this->classGradeName($item)?></div>
                                        <div><?php  echo $this->className($item);?></div>
                                        <div class="font_img">  </div>
                                    </div>
                                </a>
                            <?php  } } ?>
                        </div>
                        <div class='select_course w-clearfix clear'>
                            <div class="select_span">
                            <div class="left_title">扫码有效时间</div>
                            <div class='right_select'>
                                <select name='endtime'>
                                    <option value="10">10分钟</option>
                                    <option value="30">30分钟</option>
                                    <option value="60">60分钟</option>
                                    <option value="120">120分钟</option>
                                    <option value="180">180分钟</option>
                                </select>
                            </div>
                            </div>
                        </div>


                        <div class="weui-cell form-group ">
                            <div class="weui-cell__bd input_weui_label" >
                                <input class="weui-input" type="text" name="activity_name"  placeholder="活动名称" >
                            </div>
                        </div> 

                        <div class='form-group in_text clear' >
                                <textarea name="activity_address" maxlength="1000" rows="5" placeholder="活动地址"  ></textarea>
                        </div>
                        
                        <div class="article_sub" >
                                    <input  type="hidden" value="<?php  echo $token;?>"  name='token'>
                                    <button type="submit" class="button button-action  button-rounded button-small " style="color:#fff; border:none; line-height:40px;">马上发布</button>
                        </div>
                        </form>                   
                </div>
		    </div>
	</div>
</div>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('jsweixin', TEMPLATE_INCLUDEPATH)) : (include template('jsweixin', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../new/tea_footer', TEMPLATE_INCLUDEPATH)) : (include template('../new/tea_footer', TEMPLATE_INCLUDEPATH));?>