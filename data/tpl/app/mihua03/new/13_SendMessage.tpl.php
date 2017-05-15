<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('school/app_header', TEMPLATE_INCLUDEPATH)) : (include template('school/app_header', TEMPLATE_INCLUDEPATH));?>
<body>
  <section class="w-section mobile-wrapper">
    <div class="page-content" id="main-stack">
      <div class="w-nav navbar" style="height:45px;padding-top:0"   data-collapse="all" data-animation="over-left" data-duration="400" data-contain="1" data-easing="ease-out-quint" data-no-scroll="1">
        <div class="w-container">
          <div class="wrapper-mask" data-ix="menu-mask"></div>
          <div class="navbar-title">发送给校长</div>
          <a href="<?php  echo $this->createMobileUrl('message')?>">
          <div class="w-nav-button navbar-button left" id="menu-button" data-ix="hide-navbar-icons">
            <div class="navbar-button-icon home-icon">
              <div class="bar-home-icon top"></div>
              <div class="bar-home-icon middle"></div>
              <div class="bar-home-icon bottom"></div>
            </div>
          </div>
          </a>
        </div>
      </div>
      <div class="body padding"  style="padding-top:45px;">
        <div class="w-form">
          <form  method="post" action="<?php  echo $this->createMobileUrl('sendMessage')?>">
            <div class="separator-button-input"></div>
            <div>
              <label class="label-form" for="full-name-field">主题</label>
              <input class="w-input input-form" id="full-name-field" type="text" name="message_title" data-name="message_title" required="required">
              <div class="separator-fields"></div>
            </div>
            <div>
              <label class="label-form" for="message">内容</label>
              <textarea class="w-input input-form textarea" id="message" name="message_content" data-name="message_content"></textarea>
            </div>
            <div class="separator-button-input"></div>
             <input type="hidden" value="<?php  echo $token;?>"  name='token'>
             <input class="w-button action-button" type="submit" value="发送" data-wait="Please wait...">
          </form>
        </div>
      </div>
    </div>
    <div class="page-content loading-mask" id="new-stack">
      <div class="loading-icon">
        <div class="navbar-button-icon icon ion-load-d"></div>
      </div>
    </div>
  </section>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('school/app_footer', TEMPLATE_INCLUDEPATH)) : (include template('school/app_footer', TEMPLATE_INCLUDEPATH));?>
</body>
</html>