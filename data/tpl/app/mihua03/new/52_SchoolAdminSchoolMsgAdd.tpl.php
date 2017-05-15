<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('school/app_header', TEMPLATE_INCLUDEPATH)) : (include template('school/app_header', TEMPLATE_INCLUDEPATH));?>
<link rel="stylesheet" type="text/css" href="<?php echo MODULE_URL;?>/style/css/style.css">
<link rel="stylesheet" type="text/css" href="<?php echo MODULE_URL;?>/style/css/old_css.css">
<body>
  <section class="w-section mobile-wrapper">
    <div class="page-content" id="main-stack">
      <div class="w-nav navbar" style="height:45px;padding-top:0"   data-collapse="all" data-animation="over-left" data-duration="400" data-contain="1" data-easing="ease-out-quint" data-no-scroll="1">
        <div class="w-container">
          <div class="wrapper-mask" data-ix="menu-mask"></div>
          <div class="navbar-title">发布公告</div>
          <a href="<?php  echo $this->createMobileUrl('SchoolAdminSchoolMsg',array("id"=>$student_id))?>">
            <div class="w-nav-button navbar-button left" id="menu-button" data-ix="hide-navbar-icons">
                <div class="navbar-button-icon smaller icon ion-reply"></div>
            </div>
          </a>
        </div>
      </div>
      <div class="body padding"  style="padding-top:45px;">
        <div class="w-form">
          <form  method="post" action="<?php  echo $this->createMobileUrl('schoolAdminSchoolMsgAdd',array('id'=>$student_id))?>">
            <div class="separator-button-input"></div>
            <div>
              <label class="label-form" for="full-name-field">标题</label>
                <input class="w-input input-form" id="full-name-field" type="text" name="title" data-name="title" required>
              <div class="separator-fields"></div>
            </div>
            <div>
              <label class="label-form" for="message">内容</label>
              <textarea class="w-input input-form textarea" id="content" name="content" data-name="content"></textarea>
            </div>
              <!--照片域-->
             <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../new/upImages', TEMPLATE_INCLUDEPATH)) : (include template('../new/upImages', TEMPLATE_INCLUDEPATH));?>
            <div class="separator-button-input"></div>
             <input type="hidden" value="<?php  echo $token;?>"  name='token'>
             <input class="w-button action-button" type="submit" name="submit" value="发布" data-wait="Please wait...">
          </form>
        </div>
      </div>
    </div>
    

  </section>
  <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('jsweixin', TEMPLATE_INCLUDEPATH)) : (include template('jsweixin', TEMPLATE_INCLUDEPATH));?>
  <link href="<?php echo MODULE_URL;?>style/css/weui.min.css" rel="stylesheet" type="text/css" />
  <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('school/app_footer', TEMPLATE_INCLUDEPATH)) : (include template('school/app_footer', TEMPLATE_INCLUDEPATH));?>
</body>
</html>