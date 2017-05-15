<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('school/app_header', TEMPLATE_INCLUDEPATH)) : (include template('school/app_header', TEMPLATE_INCLUDEPATH));?>
<body>
  <section class="w-section mobile-wrapper">
    <div class="page-content" id="main-stack">
      <div class="w-nav navbar" data-collapse="all" data-animation="over-left" data-duration="400" data-contain="1" data-easing="ease-out-quint" data-no-scroll="1">
        <div class="w-container">
            <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('school/app_left', TEMPLATE_INCLUDEPATH)) : (include template('school/app_left', TEMPLATE_INCLUDEPATH));?>
          <div class="wrapper-mask" data-ix="menu-mask"></div>
          <div class="navbar-title">首页</div>
          <div class="w-nav-button navbar-button left" id="menu-button" data-ix="hide-navbar-icons">
            <div class="navbar-button-icon home-icon">
              <div class="bar-home-icon top"></div>
              <div class="bar-home-icon middle"></div>
              <div class="bar-home-icon bottom"></div>
            </div>
          </div>
        </div>
      </div>
      <div class="body">
        <div class="home-content">
          <div class="text-new grey">
            <div class="separator-fields"></div>
            <h1 class="title-h1">学生到校率!</h1>
            <div class="separator-fields"></div>
              <p class="description-new">通过考勤设备进校的人数</p>
                <div class="index_people">
                  <?php  echo $morning_student_count;?>&nbsp;人
                </div>
            <div class="separator-fields"></div>
            <div class="separator-fields"></div>
          </div>

          <div class="text-new grey">
            <div class="separator-fields"></div>
            <h1 class="title-h1">学生离校率!</h1>
            <div class="separator-fields"></div>
              <p class="description-new">通过考勤设备出校的人数</p>
                <div  class="index_people">
                  <?php  echo $afternoon_student_count;?>&nbsp;人
                </div>
            <div class="separator-fields"></div>
            <div class="separator-fields"></div>
          </div>
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