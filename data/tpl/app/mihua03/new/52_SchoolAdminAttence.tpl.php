<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('school/app_header', TEMPLATE_INCLUDEPATH)) : (include template('school/app_header', TEMPLATE_INCLUDEPATH));?>
<link rel="stylesheet" type="text/css" href="<?php echo MODULE_URL;?>/style/css/old_css.css">
<body>
  <style>
    .bg-gradient{
      background-color: rgba(51,203,213,0.8);
      background-image: none;
    }
  </style>
  <section class="w-section mobile-wrapper">
    <div class="page-content" id="main-stack">
      <div  class="w-nav navbar" data-collapse="all" data-animation="over-left" data-duration="400" data-contain="1" data-easing="ease-out-quint" data-no-scroll="1">
        <div class="w-container">
          <div class="wrapper-mask" data-ix="menu-mask"></div>
          <div class="navbar-title"><?php  echo $page_title;?></div>

          <div class="w-nav-button navbar-button left" id="menu-button" data-ix="hide-navbar-icons">
                <a  href="<?php  echo $this->createMobileUrl('school_home')?>">
                    <div class="navbar-button-icon smaller icon ion-ios-home-outline" style="color:#fff"></div>
                </a>
          </div>
          <a class="w-inline-block navbar-button right" href="<?php  echo $this->createMobileUrl('SchoolAdminAttence',array("ac"=>$do_ac))?>" data-load="1" data-ix="search-box">
                  <div class="navbar-button-icon smaller icon ion-ios-reverse-camera-outline"></div>
          </a>          
        </div>
      </div>
      <div class="body"  style="padding-top:45px;" >
            <?php  if($ac=='list') { ?>
               <?php  if(is_array($grade_list)) { foreach($grade_list as $row) { ?>
                    <div class="w-dropdown dropdown-container" data-delay="0" style="z-index: 1;width: 100%">
                        <div class="w-dropdown-toggle w-clearfix nav-menu-link dropdown" style="width: 100%">
                            <div class="nav-menu-titles line_list" ><span style='width:60%;display: inline-block;'> <?php  echo $row['grade_name'];?></span> <b class="all">总：<?php  echo $row['grade_num'];?></b> <b class='in'>到：<?php  echo $row['grade_in'];?></b>
                                <span class="w-icon-dropdown-toggle dropdown-icon" style="margin-left: 30px"></span>
                            </div>
                        </div>
                        <?php  if(is_array($row['second'])) { foreach($row['second'] as $item) { ?>
                            <nav class="w-dropdown-list drop-down-list"  style="width: 90%">
                                <div class="w-clearfix w-inline-block " style="width: 100%">
                                    <div class="nav-menu-titles" style="color:#666;width: 100%"><span style='width:55%;display: inline-block;'><?php  echo $item['class_name'];?></span>
                                        <b class="all">总：<?php  echo $item['class_num'];?></b> <b class='in'>到：<?php  echo $item['in_num'];?></b>
                                    </div>
                                </div>
                            </nav>
                        <?php  } } ?>
                    </div>   
                    <div class="clear:both"></div>
                <?php  } } ?>
            <?php  } else { ?>
                        <?php  $in_school=0?>
                        <?php  if(is_array($list)) { foreach($list as $row) { ?>
                            <?php  $up  = D("card")->teacherRecord($time,$row['teacher_id'],'in');?>
                            <?php  $low = D("card")->teacherRecord($time,$row['teacher_id'],'out');?>
                            <?php  if(!$up && !$low ) { ?>
                            <?php  $style="color:#ff0033"?>
                            <?php  $str ='未打卡'?>
                            <?php  } ?>
                            <?php  if($up && $low) { ?>
                                <?php  $style="color:rgb(51,203,213)"?>
                                <?php  $in_school++;?>
                                <?php  $str ='全打'?>
                            <?php  } ?>
                            <?php  if($up && !$low) { ?>
                                <?php  $style="color:rgb(51,203,213)"?>
                                <?php  $str ='到校'?>
                                <?php  $in_school++;?>
                            <?php  } ?>
                        <?php  } } ?> 
                        
                    <div class="w-dropdown dropdown-container" data-delay="0" style="z-index: 1;width: 100%">
                        <div class="w-dropdown-toggle w-clearfix nav-menu-link dropdown" style="width: 100%">
                            <div class="nav-menu-titles line_list" ><span style='width:60%;display: inline-block;'> 概览</span> <b class="all">总：<?php  echo count($list);?></b> <b class='in'>到：<?php  echo $in_school;?></b>
                                <span class="w-icon-dropdown-toggle dropdown-icon" style="margin-left: 30px"></span>
                            </div>
                        </div>
                        <?php  if(is_array($list)) { foreach($list as $row) { ?>
                            <?php  $up  = D("card")->teacherRecord($time,$row['teacher_id'],'in');?>
                            <?php  $low = D("card")->teacherRecord($time,$row['teacher_id'],'out');?>
                            <?php  if(!$up && !$low ) { ?>
                            <?php  $style="color:#ff0033"?>
                            <?php  $str ='未打卡'?>
                            <?php  } ?>
                            <?php  if($up && $low) { ?>
                                <?php  $style="color:rgb(51,203,213)"?>
                                <?php  $str ='全打'?>
                            <?php  } ?>
                            <?php  if($up && !$low) { ?>
                                <?php  $style="color:rgb(51,203,213)"?>
                                <?php  $str ='到校'?>
                                <?php  $in_school++;?>
                            <?php  } ?>
                            <?php  if(!$up && $low) { ?>
                                <?php  $style="color:rgb(51,203,213)"?>
                                <?php  $str ='离校'?>
                            <?php  } ?> 
                            <nav class="w-dropdown-list drop-down-list"  style="width: 90%">
                                        <div class="w-clearfix w-inline-block " style="width: 100%">
                                            <div class="nav-menu-titles" style="color:#666;width: 100%"><span style='width:55%;display: inline-block;'><?php  echo $row['teacher_realname'];?></span>
                                                <b class="all"><?php  echo $str;?></b>
                                            </div>
                                        </div>
                            </nav>
                        <?php  } } ?> 
                    </div>   
                    <div class="clear:both"></div>

     

            <?php  } ?>
        </div>
    </div>

  </section>
  <script>
      $(function(){
        var pager = 1;
        $(window).scroll(function(){
            if ($(document).height() - $(this).scrollTop() - $(this).height() < 100){
                if(pager==0) return false;
                pager++;       
                $.ajax({
                url:'<?php  echo $this->createMobileUrl('SchoolAdminFix')?>',
                type:'post',
                data:{page:pager,ac:'<?php  echo $ac;?>',ajax:1},
                dataType:'text',
                async:'false',
                success:function(html){
                        if(html =='done' ){
                            $("#add_msg").html("已经全部查看！");
                            pager=0;
                        }else{
                            $('#cotent').append(html);   
                        }
                    }
                });
            }
        });
      });
  </script>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('school/app_footer', TEMPLATE_INCLUDEPATH)) : (include template('school/app_footer', TEMPLATE_INCLUDEPATH));?>
</body>
</html>