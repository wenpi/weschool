<?php defined('IN_IA') or exit('Access Denied');?>  <?php  if($_GPC["_db_group_id"]) { ?>
    <?php  $fun_info = D('power')->getFunInfo($_GPC["_db_group_id"]);?>
  <?php  } else { ?>
    <?php  $fun_info['top'] = false;?>
    <?php  $fun_info['low'] = false;?>
  <?php  } ?>
            <div class="page-sidebar-wrapper">
                <div class="page-sidebar navbar-collapse collapse">
                 <div class="slimScrollDiv" >   
                    <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="false" data-slide-speed="200">
                        <li class="nav-item" id='system_index'>
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="icon-home"></i>
                                <span class="title">系统首页</span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item  "  id='system_index_nav'>
                                    <a href="<?php  echo $this->createWebUrl("adminindex")?>" class="nav-link ">
                                        <i class="icon-bulb"></i>
                                        <span class="title">系统首页</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                <?php  if($admin_result['admin'] != 'teacher' ) { ?>
                        <li class="nav-item  "  id='school_base_set' <?php  checkLeft('school_base_set',$fun_info['top']);?>>
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="fa fa-building"></i>
                                <span class="title">学校基本设置</span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                 <li class="nav-item  "  id='school_params' <?php  checkLeft('school',$fun_info['low']);?> > 
                                    <a href="<?php  echo $this->createWebUrl('school',array('aw'=>1,'op'=>'edit' ))?>" class="nav-link ">
                                        <span class="title"><i class="icon-settings"></i> 学校参数</span>
                                    </a>
                                </li>
                               <li class="nav-item  "  id='student_mobile' <?php  checkLeft('student_mobile',$fun_info['low']);?>>
                                    <a href="<?php  echo $this->createWebUrl('student_mobile')?>" class="nav-link ">
                                        <span class="title"><i class="fa fa-vimeo"></i> 家长端设置</span>
                                    </a>
                                </li>   
                               <li class="nav-item  "  id='teacher_mobile' <?php  checkLeft('teacher_mobile',$fun_info['low']);?>>
                                    <a href="<?php  echo $this->createWebUrl('teacher_mobile')?>" class="nav-link ">
                                        <span class="title"><i class="fa fa-wikipedia-w"></i> 教师端设置</span>
                                    </a>
                                </li> 

                                <li class="nav-item  "  id='grade_set' <?php  checkLeft('grade',$fun_info['low']);?>>
                                    <a href="<?php  echo $this->createWebUrl('grade',array('aw'=>1 ))?>" class="nav-link ">
                                        <span class="title"><i class="fa fa-cubes"></i> 年级管理</span>
                                    </a>
                                </li>
                                <li class="nav-item  "  id='class_set' <?php  checkLeft('class',$fun_info['low']);?>>
                                    <a href="<?php  echo $this->createWebUrl('class',array('aw'=>1 ))?>" class="nav-link ">
                                        <span class="title"><i class="fa fa-cube"></i> 班级管理</span>
                                    </a>
                                </li>
                                <li class="nav-item  "  id='student_set' <?php  checkLeft('student',$fun_info['low']);?>>
                                    <a href="<?php  echo $this->createWebUrl('student',array('aw'=>1 ))?>" class="nav-link ">
                                        <span class="title"><i class="fa fa-users"></i> 学生管理</span>
                                    </a>
                                </li>
                                <li class="nav-item  "  id='teacher_set' <?php  checkLeft('teacher',$fun_info['low']);?>>
                                    <a href="<?php  echo $this->createWebUrl('teacher',array('aw'=>1 ))?>" class="nav-link ">
                                        <span class="title"><i class="fa fa-user"></i> 教师管理</span>
                                    </a>
                                </li>
                               <li class="nav-item  "  id='course_set' <?php  checkLeft('course',$fun_info['low']);?>>
                                    <a href="<?php  echo $this->createWebUrl('course',array('aw'=>1 ))?>" class="nav-link ">
                                        <span class="title"><i class="fa fa-star"></i> 课程管理</span>
                                    </a>
                                </li> 
                               <li class="nav-item  "  id='attenceSet' <?php  checkLeft('attenceSet',$fun_info['low']);?>>
                                    <a href="<?php  echo $this->createWebUrl('attenceSet')?>" class="nav-link ">
                                        <span class="title"><i class="fa fa-fax"></i> 考勤时间设置</span>
                                    </a>
                                </li>  
                               <li class="nav-item  "  id='update_school_grade_class_student' <?php  checkLeft('update_school_grade_class_student',$fun_info['low']);?>>
                                    <a href="<?php  echo $this->createWebUrl('systemfix',array('op'=>'update_school_grade_class_student'))?>" class="nav-link ">
                                        <span class="title"><i class="fa fa-circle-o-notch"></i> 考勤数据更新</span>
                                    </a>
                                </li>                                                                    
                                <?php  if($admin_result['admin'] != 'school' ) { ?>
                                    <li class="nav-item  "  id='school_admin' <?php  checkLeft('school_admin',$fun_info['low']);?>>
                                        <a href="<?php  echo $this->createWebUrl('school_admin',array('aw'=>1 ))?>" class="nav-link ">
                                            <span class="title"><i class="fa fa-user-secret"></i> 学校管理员</span>
                                        </a>
                                    </li> 
                                <?php  } ?>
                                <li class="nav-item  "  id='adv_admin' <?php  checkLeft('adv_admin',$fun_info['low']);?>>
                                    <a href="<?php  echo $this->createWebUrl('adv_admin')?>" class="nav-link ">
                                        <span class="title"><i class="fa fa-flag"></i> 占位符管理</span>
                                    </a>
                                </li> 

                            </ul>
                        </li>
                    <?php  } ?>
                        <li class="nav-item  "  id='class_manage'  <?php  checkLeft('class_manage',$fun_info['top']);?>>
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="icon-puzzle"></i>
                                <span class="title">班级事务</span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                 <li class="nav-item  "  id='leave' <?php  checkLeft('leave',$fun_info['low']);?>>
                                    <a href="<?php  echo $this->createWebUrl('leave',array('aw'=>1 ))?>" class="nav-link ">
                                        <span class="title"><i class="fa fa-adjust"></i> 请假管理</span>
                                    </a>
                                </li>
                                  <li class="nav-item  "  id='homework' <?php  checkLeft('homework',$fun_info['low']);?>>
                                    <a href="<?php  echo $this->createWebUrl('homework',array('aw'=>1 ))?>" class="nav-link ">
                                        <span class="title"><i class="fa fa-bookmark"></i> 作业管理</span>
                                    </a>
                                </li>                              

                                <li class="nav-item  "  id='syllabus' <?php  checkLeft('syllabus',$fun_info['low']);?>>
                                    <a href="<?php  echo $this->createWebUrl('syllabus',array('aw'=>1 ))?>" class="nav-link ">
                                        <span class="title"><i class="fa fa-book"></i> 课程表</span>
                                    </a>
                                </li>
                                 <li class="nav-item  "  id='class_notice' <?php  checkLeft('line',$fun_info['low']);?>>
                                    <a href="<?php  echo $this->createWebUrl('line',array('aw'=>1 ))?>" class="nav-link ">
                                        <span class="title"><i class="fa fa-bullhorn"></i> 班级公告</span>
                                    </a>
                                </li>     
                                  <li class="nav-item"  id='class_line' <?php  checkLeft('class_line',$fun_info['low']);?>>
                                    <a href="<?php  echo $this->createWebUrl('class_line',array('aw'=>1)) ?>" class="nav-link ">
                                        <span class="title"><i class="fa fa-circle-thin"></i> 班级圈</span>
                                    </a>
                                </li>                                                              
                                <li class="nav-item  "  id='student_record' <?php  checkLeft('student_record',$fun_info['low']);?>>
                                    <a href="<?php  echo $this->createWebUrl('student_record',array('aw'=>1)) ?>" class="nav-link ">
                                        <span class="title"><i class="fa fa-navicon"></i> 学生记录</span>
                                    </a>
                                </li>
                                  <li class="nav-item  "  id='score_out' <?php  checkLeft('score_list',$fun_info['low']);?>>
                                    <a href="<?php  echo $this->createWebUrl('score_list',array('aw'=>1)) ?>" class="nav-link ">
                                        <span class="title"><i class="fa fa-pencil"></i> 成绩发布</span>
                                    </a>
                                </li>
                                  <li class="nav-item  "  id='class_msg' <?php  checkLeft('msg',$fun_info['low']);?>>
                                    <a href="<?php  echo $this->createWebUrl('msg',array('aw'=>1)) ?>" class="nav-link ">
                                        <span class="title"><i class="fa fa-edit"></i> 消息发送</span>
                                    </a>
                                </li>
                                   <li class="nav-item  "  id='attence' <?php  checkLeft('attence',$fun_info['low']);?>>
                                    <a href="<?php  echo $this->createWebUrl('attence' ) ?>" class="nav-link ">
                                        <span class="title"><i class="fa fa-bus"></i> 考勤管理</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                <?php  if($admin_result['admin'] != 'teacher' ) { ?>
                        <li class="nav-item  "  id='school_msg'  <?php  checkLeft('school_msg',$fun_info['top']);?>>
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="fa fa-envelope-o"></i>
                                <span class="title">校务管理</span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                            <li class="nav-item  "  id='department' <?php  checkLeft('department',$fun_info['low']);?>>
                                    <a href="<?php  echo $this->createWebUrl('department') ?>" class="nav-link ">
                                        <span class="title"><i class="fa fa-opera"></i> 学校部门</span>
                                    </a>
                                </li>
                              <li class="nav-item  "  id='schoolMessage' <?php  checkLeft('schoolMessage',$fun_info['low']);?>>
                                    <a href="<?php  echo $this->createWebUrl('schoolMessage') ?>" class="nav-link ">
                                        <span class="title"><i class="fa fa-envelope-o"></i> 校长信箱</span>
                                    </a>
                                </li> 
                              <li class="nav-item  "  id='repairFix' <?php  checkLeft('repairFix',$fun_info['low']);?>>
                                    <a href="<?php  echo $this->createWebUrl('repairFix') ?>" class="nav-link ">
                                        <span class="title"><i class="fa fa-bug"></i> 报修管理</span>
                                    </a>
                                </li> 
                                <!--
                                <li class="nav-item  "  id='signUp'>
                                    <a href="<?php  echo $this->createWebUrl('signUp') ?>" class="nav-link ">
                                        <span class="title"><i class="fa fa-child"></i> 报名管理</span>
                                    </a>
                                </li>
                                -->
                                <li class="nav-item  "  id='appointment' <?php  checkLeft('appointment',$fun_info['low']);?>>
                                        <a href="<?php  echo $this->createWebUrl('appointment',array('aw'=>1)) ?>" class="nav-link ">
                                            <span class="title"><i class="fa fa-balance-scale"></i> 活动预约</span>
                                        </a>
                                </li>
                                 <li class="nav-item  "  id='booking' <?php  checkLeft('booking',$fun_info['low']);?>>
                                        <a href="<?php  echo $this->createWebUrl('booking') ?>" class="nav-link ">
                                            <span class="title"><i class="fa fa-futbol-o"></i> 校外报名</span>
                                        </a>
                                </li>       
                                                        
                                 <li class="nav-item  "  id='money' <?php  checkLeft('money',$fun_info['low']);?>>
                                    <a href="<?php  echo $this->createWebUrl('money',array('aw'=>1)) ?>" class="nav-link ">
                                        <span class="title"><i class="fa fa-money"></i> 收费管理</span>
                                    </a>
                                </li> 
                                 <li class="nav-item  "  id='data_in' <?php  checkLeft('data_in',$fun_info['low']);?>>
                                    <a href="<?php  echo $this->createWebUrl('data_in',array('aw'=>1)) ?>" class="nav-link ">
                                        <span class="title"><i class="fa fa-cloud-upload"></i> 数据导入</span>
                                    </a>
                                </li> 
                                 <li class="nav-item  "  id='data_out' <?php  checkLeft('data_out',$fun_info['low']);?>>
                                    <a href="<?php  echo $this->createWebUrl('data_out',array('aw'=>1)) ?>" class="nav-link ">
                                        <span class="title"><i class="fa fa-sliders"></i> 数据统计</span>
                                    </a>
                                </li>                                                                 
                                 <li class="nav-item  "  id='student_cookbook' <?php  checkLeft('cookbook',$fun_info['low']);?>>
                                    <a href="<?php  echo $this->createWebUrl('cookbook',array('aw'=>1)) ?>" class="nav-link ">
                                        <span class="title"><i class="fa fa-beer"></i> 学生食谱</span>
                                    </a>
                                </li>                               
                                <li class="nav-item  "  id='school_notice' <?php  checkLeft('neimsg',$fun_info['low']);?>>
                                    <a href="<?php  echo $this->createWebUrl('neimsg',array('aw'=>1)) ?>"   class="nav-link ">
                                        <span class="title"><i class="fa fa-bell-o"></i> 学校公告</span>
                                    </a>
                                </li>
                                  <li class="nav-item  "  id='teacher_msg' <?php  checkLeft('teacherMsg',$fun_info['low']);?>>
                                    <a href="<?php  echo $this->createWebUrl('teacherMsg',array('aw'=>1)) ?>" class="nav-link ">
                                        <span class="title"><i class="fa fa-comment-o"></i> 通知教师</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item  "  id='wap_admin'  <?php  checkLeft('wap_admin',$fun_info['top']);?>>
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="fa fa-chrome"></i>
                                <span class="title">官网管理</span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                 <li class="nav-item  "  id='wap_index' <?php  checkLeft('wap_index',$fun_info['low']);?>>
                                    <a href="<?php  echo $this->createWebUrl('wap_index') ?>" class="nav-link ">
                                        <span class="title"><i class="fa fa-bookmark"></i> wap管理</span>
                                    </a>
                                </li>                               
                               <!--<li class="nav-item  "  id='web_nav' <?php  checkLeft('web_nav',$fun_info['low']);?>>
                                    <a href="<?php  echo $this->createWebUrl('web_nav') ?>" class="nav-link ">
                                        <span class="title"><i class="fa fa-bookmark"></i> web导航</span>
                                    </a>
                                </li>                                 
                                   <li class="nav-item  "  id='web_pc_index' <?php  checkLeft('web_pc_index',$fun_info['low']);?>>
                                    <a href="<?php  echo $this->createWebUrl('web_pc_index') ?>" class="nav-link ">
                                        <span class="title"><i class="fa fa-bookmark"></i> web首页</span>
                                    </a>
                                </li> -->

                                <li class="nav-item  "  id='article_class' <?php  checkLeft('article_class',$fun_info['low']);?>>
                                    <a href="<?php  echo $this->createWebUrl('article_class') ?>"   class="nav-link ">
                                        <span class="title"><i class="fa fa-book"></i> 文章分类</span>
                                    </a>
                                </li>
                                  <li class="nav-item  "  id='article_list' <?php  checkLeft('article_list',$fun_info['low']);?>>
                                    <a href="<?php  echo $this->createWebUrl('article_list') ?>" class="nav-link ">
                                        <span class="title"><i class="fa fa-book"></i> 文章列表 </span>
                                    </a>
                                </li>
                            </ul>
                        </li>         
                        <li class="nav-item  "  id='line_edu'  <?php  checkLeft('line_edu',$fun_info['top']);?>>
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="fa fa-mortar-board"></i>
                                <span class="title">在线课堂</span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                 <li class="nav-item  "  id='edu_video_class' <?php  checkLeft('edu_video_class',$fun_info['low']);?>>
                                    <a href="<?php  echo $this->createWebUrl('edu_video_class') ?>" class="nav-link ">
                                        <span class="title"><i class="fa fa-navicon"></i> 视频分类</span>
                                    </a>
                                </li>                               

                                <li class="nav-item  "  id='edu_video_list' <?php  checkLeft('edu_video_list',$fun_info['low']);?>>
                                    <a href="<?php  echo $this->createWebUrl('edu_video_list') ?>"   class="nav-link ">
                                        <span class="title"><i class="fa fa-cloud"></i> 视频管理</span>
                                    </a>
                                </li>
                            </ul>
                        </li> 
                        
                        <li class="nav-item  "  id='school_hardware'  <?php  checkLeft('school_hardware',$fun_info['top']);?>>
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="fa fa-cutlery"></i>
                                <span class="title">学校硬件</span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                 <li class="nav-item  "  id='class_video' <?php  checkLeft('video',$fun_info['low']);?>>
                                    <a href="<?php  echo $this->createWebUrl('video',array('aw'=>1)) ?>" class="nav-link ">
                                        <span class="title"><i class="fa fa-video-camera"></i> 教室监控</span>
                                    </a>
                                </li>                               
                                <li class="nav-item  "  id='hardware_card' <?php  checkLeft('device',$fun_info['low']);?>>
                                    <a href="<?php  echo $this->createWebUrl('device',array('aw'=>1)) ?>" class="nav-link ">
                                        <span class="title"><i class="fa fa-taxi"></i> 考勤&校车</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                         <li class="nav-item"  id='system_data'  <?php  checkLeft('system_data',$fun_info['top']);?>>
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="fa fa-gg"></i>
                                <span class="title">系统数据</span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                 <li class="nav-item"  id='school_data' <?php  checkLeft('school_data',$fun_info['low']);?>>
                                    <a href="<?php  echo $this->createWebUrl('school_data') ?>" class="nav-link ">
                                        <span class="title"><i class="fa fa-calculator"></i> 学校数据</span>
                                    </a>
                                </li> 
                                  <li class="nav-item"  id='repairData' <?php  checkLeft('repairData',$fun_info['low']);?>>
                                    <a href="<?php  echo $this->createWebUrl('repairData') ?>" class="nav-link ">
                                        <span class="title"><i class="fa fa-cogs"></i> 报修数据</span>
                                    </a>
                                </li>                                    
                                <li class="nav-item"  id='teacher_his_data' <?php  checkLeft('teacher_his_data',$fun_info['low']);?>>
                                    <a href="<?php  echo $this->createWebUrl('teacher_his_data') ?>" class="nav-link ">
                                        <span class="title"><i class="fa fa-opencart"></i> 教师数据</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <!--lalala-->

                    <?php  } ?>
                   <?php  if($admin_result['admin'] == 'top'  ||  $left_nav =='system_parameter') { ?>
                        <li class="nav-item" id='system_set' <?php  checkLeft('system_set',$fun_info['top']);?> >
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="icon-settings"></i>
                                <span class="title">系统设置</span>
                                <span class="selected"></span>
                                <span class="arrow open"></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item" id='change_weixin' <?php  checkLeft('adminloginCheck',$fun_info['low']);?>>
                                    <a href="<?php  echo $this->createWebUrl('adminloginCheck') ?>" class="nav-link">
                                        <span class="title"><i class="fa fa-folder-o"></i> 切换公众号</span>
                                    </a>
                                </li>   
                               <li class="nav-item  "  id='schoolManage' <?php  checkLeft('school_new',$fun_info['low']);?>>
                                    <a href="<?php  echo $this->createWebUrl('school_new',array('aw'=>1)) ?>" class="nav-link ">
                                        <span class="title"><i class="fa fa-sitemap"></i> 学校管理</span>
                                    </a>
                                </li>    
                               <li class="nav-item  "  id='systemParams' <?php  checkLeft('systemParams',$fun_info['low']);?>>
                                    <a href="<?php  echo $this->createWebUrl('systemParams') ?>" class="nav-link ">
                                        <span class="title"><i class="fa fa-registered"></i> 系统设置</span>
                                    </a>
                                </li>                                                            
                                <li class="nav-item  "  id='system_parameter' <?php  checkLeft('system_parameter',$fun_info['low']);?>>
                                    <a href="<?php  echo $_W['siteroot'];?>/web/index.php?c=profile&a=module&do=setting&m=lianhu_school&aw=1" class="nav-link ">
                                        <span class="title"><i class="fa fa-object-ungroup"></i> 系统参数</span>
                                    </a>
                                </li>
                               <li class="nav-item  "  id='system_update' <?php  checkLeft('systemfix',$fun_info['low']);?>>
                                    <a href="<?php  echo $this->createWebUrl('systemfix',array('aw'=>1)) ?>" class="nav-link ">
                                        <span class="title"><i class="fa fa-retweet"></i> 系统维护</span>
                                    </a>
                                </li>
                           <li class="nav-item  "  id='user_group' <?php  checkLeft('group',$fun_info['low']);?>>
                                    <a href="<?php  echo $this->createWebUrl('group') ?>" class="nav-link ">
                                        <span class="title"><i class="fa fa-users"></i> 用户组</span>
                                    </a>
                                </li>

                             <li class="nav-item  "  id='user'  <?php  checkLeft('user',$fun_info['low']);?>>
                                    <a href="<?php  echo $this->createWebUrl('user') ?>" class="nav-link ">
                                        <span class="title"><i class="fa fa-user"></i> 用户管理</span>
                                    </a>
                             </li> 

                            </ul>
                        </li>
                   <?php  } ?>
                    </ul>
                    </ul>
                </div>
            </div>
            <script>
                $(function(){
                    $("#<?php  echo $left_top;?>").addClass("open");
                    $("#<?php  echo $left_top;?>").find('.arrow').addClass("open");
                    $("#<?php  echo $left_top;?>").addClass("active");
                    $("#<?php  echo $left_nav;?>").addClass("active");
                    $("#<?php  echo $left_nav;?>").addClass("open");
                    // $(".sub-menu").find('.nav-link').prepend("<b>....</b>");
                });
            </script>
