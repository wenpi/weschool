<?php defined('IN_IA') or exit('Access Denied');?><?php  $page_title = '我的资料';?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../new/head', TEMPLATE_INCLUDEPATH)) : (include template('../new/head', TEMPLATE_INCLUDEPATH));?>
  <link rel="apple-touch-icon"  href="<?php echo MODULE_URL;?>/style/app/images/logo.ico">
  <link rel="stylesheet" href="<?php echo MODULE_URL;?>template/mobile/style/style_nav.css">
  <script type='text/javascript' src='<?php echo MODULE_URL;?>/style/js/jquery.min.js'></script>
<body>
<div class="container" id="container">
    <div class="cell">
    <div class="hd">
        <h1 class="page_title">我的资料</h1>
    </div>
    </div>
      <form class="form-signin" action=" " method="POST">
            <div class="weui_cells weui_cells_form">
                    <div class="weui_cell weui_cell_warn">
                        <div class="weui_cell_hd"><label for="" class="weui_label">手机</label></div>
                        <div class="weui_cell_bd weui_cell_primary">
                            <input type="mobile" id="inputMobile" name='mobile' class="weui_input" placeholder="手机号码" value='<?php  echo $my_info['mobile'];?>' required autofocus>
                        </div>
                        <div class="weui_cell_ft">
                        </div>
                    </div>
                    <div class="weui_cell">
                        <div class="weui_cell_hd"><label for="" class="weui_label">昵称</label></div>
                        <div class="weui_cell_bd weui_cell_primary">
                         <input type="text" id="inputPassword" name='nickname' class="weui_input" placeholder="昵称"  value='<?php  echo $my_info['nickname'];?>' required>
                        </div>
                    </div>
                </div>
                <input type='hidden' value='1' name='submit' >
                <button class="weui_btn weui_btn_primary" style="padding:0px;width:96%" type="submit" ><i class="fa fa-user"></i>&nbsp;&nbsp;提交</button>
      </form>
</div>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('jsweixin', TEMPLATE_INCLUDEPATH)) : (include template('jsweixin', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../new/footer', TEMPLATE_INCLUDEPATH)) : (include template('../new/footer', TEMPLATE_INCLUDEPATH));?>