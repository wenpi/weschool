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
              <p class="description-new">此处统计为上午有打卡行为的学生，只是粗略的统计</p>
                <div id="pieChart">
                  <svg id="pieChartSVG">
                    <defs>
                      <filter id='pieChartInsetShadow'>
                        <feOffset dx='0' dy='0'/>
                        <feGaussianBlur stdDeviation='3' result='offset-blur' />
                        <feComposite operator='out' in='SourceGraphic' in2='offset-blur' result='inverse' />
                        <feFlood flood-color='black' flood-opacity='1' result='color' />
                        <feComposite operator='in' in='color' in2='inverse' result='shadow' />
                        <feComposite operator='over' in='shadow' in2='SourceGraphic' />
                      </filter>
                      <filter id="pieChartDropShadow">
                        <feGaussianBlur in="SourceAlpha" stdDeviation="3" result="blur" />
                        <feOffset in="blur" dx="0" dy="3" result="offsetBlur" />
                        <feMerge>
                          <feMergeNode />
                          <feMergeNode in="SourceGraphic" />

                        </feMerge>
                      </filter>
                    </defs>
                  </svg>
                </div>
            <div class="separator-fields"></div>
            <div class="separator-fields"></div>
          </div>

          <div class="text-new grey">
            <div class="separator-fields"></div>
            <h1 class="title-h1">学生离校率!</h1>
            <div class="separator-fields"></div>
              <p class="description-new">此处统计为下午有打卡行为的学生，只是粗略的统计</p>
                <div id="pieChart2">
                  <svg >
                    <defs>
                      <filter id='pieChartInsetShadow'>
                        <feOffset dx='0' dy='0'/>
                        <feGaussianBlur stdDeviation='3' result='offset-blur' />
                        <feComposite operator='out' in='SourceGraphic' in2='offset-blur' result='inverse' />
                        <feFlood flood-color='black' flood-opacity='1' result='color' />
                        <feComposite operator='in' in='color' in2='inverse' result='shadow' />
                        <feComposite operator='over' in='shadow' in2='SourceGraphic' />
                      </filter>
                      <filter id="pieChartDropShadow">
                        <feGaussianBlur in="SourceAlpha" stdDeviation="3" result="blur" />
                        <feOffset in="blur" dx="0" dy="3" result="offsetBlur" />
                        <feMerge>
                          <feMergeNode />
                          <feMergeNode in="SourceGraphic" />
                        </feMerge>
                      </filter>
                    </defs>
                  </svg>
                </div>
            <div class="separator-fields"></div>
            <div class="separator-fields"></div>
          </div>
          <div class="text-new grey">
            <div class="separator-button"></div><a class="w-button action-button" href="<?php  echo $this->createMobileUrl("school_card_list")?>">查看详细</a>
          </div>
        </div>
      </div>
    </div>
  <!--加载控件-->
    <div class="page-content loading-mask" id="new-stack">
      <div class="loading-icon">
        <div class="navbar-button-icon icon ion-load-d"></div>
      </div>
    </div>
  </section>
 <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('school/app_footer', TEMPLATE_INCLUDEPATH)) : (include template('school/app_footer', TEMPLATE_INCLUDEPATH));?>
 <script>
    var   data = {
        pieChart  : [
          {
            color       : 'red',
            description : '学生到校率',
            title       : 'online',
            value       : <?php  echo $arrive;?>
          },
          {
            color       : 'blue',
            description : '未到校',
            title       : 'retail',
            value       : <?php  echo $not_arrive;?>
          }
        ],
        pieChart2  : [
          {
            color       : 'red',
            description : '学生离校率',
            title       : 'online',
            value       : <?php  echo $leave;?>
          },
          {
            color       : 'blue',
            description : '未离校',
            title       : 'retail',
            value       : <?php  echo $not_leave;?>
          }
        ]   
  };
 </script>
  <script type="text/javascript" src="<?php echo MODULE_URL;?>/style/app/js/chart.js"></script>
</body>
</html>