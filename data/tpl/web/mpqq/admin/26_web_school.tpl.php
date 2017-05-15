<?php defined('IN_IA') or exit('Access Denied');?>   <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/head', TEMPLATE_INCLUDEPATH)) : (include template('../admin/head', TEMPLATE_INCLUDEPATH));?>
        <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/header', TEMPLATE_INCLUDEPATH)) : (include template('../admin/header', TEMPLATE_INCLUDEPATH));?>
        <div class="page-container">
       <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/left', TEMPLATE_INCLUDEPATH)) : (include template('../admin/left', TEMPLATE_INCLUDEPATH));?>
            <div class="page-content-wrapper">
                <div class="page-content">
                    <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/sidebar', TEMPLATE_INCLUDEPATH)) : (include template('../admin/sidebar', TEMPLATE_INCLUDEPATH));?>
                    <h1 class="page-title"> <?php  echo $_SESSION['school_name'];?>
                            <small> 学校参数设置 </small>  
                    </h1>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="portlet light ">
                                <div class="portlet-title">
                                    <div class="caption font-green-haze">
                                        <i class="icon-settings font-green-haze"></i>
                                        <span class="caption-subject bold uppercase"> 学校参数设置</span>
                                    </div>
                                    <div class="actions">
                                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;" data-original-title="" title=""> </a>
                                    </div>
                                </div>
                                <div class="portlet-body form">
                                    <form action="" method="post" class="form-horizontal form" enctype="multipart/form-data" id="form1"  >
                                        <div class="form-body">
                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label"><span class="required" aria-required="true"> * </span>学校名</label>
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control"  placeholder="学校的名字" value="<?php  echo $result['school_name'];?>" name='school_name' required >
                                                    <div class="form-control-focus"> </div>
                                                </div>
                                            </div>
                                              <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label" ><span class="required" aria-required="true"> * </span>选择学校类型</label>
                                                <div class="col-md-10">
                                                    <select class="form-control" name='school_type' >
                                                    <?php  if(is_array($type_list)) { foreach($type_list as $row) { ?>
                                                            <option value='<?php  echo $row['id'];?>' <?php  if($row['id'] == $result['school_type']) { ?> selected <?php  } ?>><?php  echo $row['name'];?></option>
                                                        <?php  } } ?>
                                                   </select>
                                                    <div class="form-control-focus"> </div>
                                                </div>
                                            </div> 
                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label" for="form_control_1">学校logo</label>
                                                <div class="col-md-10">
                                                    <?php  echo tpl_form_field_image('school_logo',S("system",'getSetContent',array('school_logo',$_SESSION['school_id'])) );?>
                                                </div>
                                            </div>                                                                                     
                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label" for="form_control_1">手机端模板（不填写为默认）</label>
                                                <div class="col-md-10">
                                                    <input type="text" name="mu_str" id="mu_str" class="form-control" value='<?php  echo $result['mu_str'];?>'  placeholder="请设置为new"/>
                                                    <div class="form-control-focus"> </div>
                                                    <span class="help-block">此模板目录和template/mobile为同级目录.</span>
                                                </div>
                                            </div>
                                             <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label" for="form_control_1">微官网（不填写为默认）</label>
                                                <div class="col-md-10">
                                                    <input type="text" name="wap_teamplate" id="wap_teamplate" class="form-control" value='<?php  echo S("system",'getSchoolWapTemplate',array($_SESSION['school_id'])  );?>' />
                                                    <div class="form-control-focus"> </div>
                                                </div>
                                            </div>                      
                                        <div class="form-group form-md-radios form-md-line-input  ">
                                            <label class="col-md-2 control-label"  >学校状态</label>
                                            <div class="md-radio-inline">
                                                <div class="md-radio">
                                                    <input type="radio" name="status" id="radio6" class="md-radiobtn"  value='1' <?php  if($op=='new') { ?> checked <?php  } else { ?> <?php  if($result['status']==1) { ?> checked <?php  } ?> <?php  } ?> />
                                                    <label for="radio6">
                                                        <span></span>
                                                        <span class="check"></span>
                                                        <span class="box"></span>正常</label>
                                                </div>
                                                <div class="md-radio">
                                                  <input type="radio"   name="status" id='radio7' class="md-radiobtn" value='0' <?php  if($op=='edit') { ?> <?php  if($result['status']==0) { ?> checked <?php  } ?>  <?php  } ?>/>
                                                    <label for="radio7">
                                                        <span></span>
                                                        <span class="check"></span>
                                                        <span class="box"></span>注销</label>
                                                </div>
                                            </div>
                                        </div>
                                        
                                         <div class="form-group form-md-radios form-md-line-input  ">
                                            <label class="col-md-2 control-label"  >班级圈</label>
                                            <div class="md-radio-inline">
                                                <div class="md-radio">
                                                    <input type="radio"  id="radiol" class="md-radiobtn"  name="line_status"   value='1' <?php  if($result['line_status']==1) { ?> checked <?php  } ?>  />
                                                    <label for="radiol">
                                                        <span></span>
                                                        <span class="check"></span>
                                                        <span class="box"></span>不审核</label>
                                                </div>
                                                <div class="md-radio">
                                                  <input type="radio"   id='radiol1' class="md-radiobtn" name="line_status"   value='2' <?php  if($result['line_status']==2) { ?> checked <?php  } ?> />
                                                    <label for="radiol1">
                                                        <span></span>
                                                        <span class="check"></span>
                                                        <span class="box"></span>需审核</label>
                                                </div>
                                            </div>
                                        </div>

                                         <div class="form-group form-md-radios form-md-line-input  ">
                                            <label class="col-md-2 control-label"  >班级公告</label>
                                            <div class="md-radio-inline">
                                                <div class="md-radio">
                                                    <input type="radio" id="radion" class="md-radiobtn" name="class_notice_status"   value='1' <?php  if($result['class_notice_status']==1) { ?> checked <?php  } ?>   />
                                                    <label for="radion">
                                                        <span></span>
                                                        <span class="check"></span>
                                                        <span class="box"></span>不审核</label>
                                                </div>
                                                <div class="md-radio">
                                                  <input type="radio"    id='radion1' class="md-radiobtn" name="class_notice_status"   value='2' <?php  if($result['class_notice_status']==2) { ?> checked <?php  } ?>   />
                                                    <label for="radion1">
                                                        <span></span>
                                                        <span class="check"></span>
                                                        <span class="box"></span>需审核</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group  form-md-line-input  ">
                                                <label class= "col-md-2 control-label">班级圈类别</label>
                                                <div class="col-md-10">
                                                    <textarea name='line_type' class='form-control'><?php  if($result['line_type'] ) { ?><?php  echo $result['line_type'];?><?php  } else { ?>班级活动||班级公告||日常点滴||重要事务<?php  } ?></textarea>
                                                    <div class="form-control-focus"> </div>
                                                    <span class="help-block">每个不同的类别以||分开</span>
                                                </div>
                                            </div>
                                            <div class="form-group  form-md-line-input  ">
                                                <label class=" col-md-2 control-label">预约类别</label>
                                                <div class="col-md-10">
                                                    <textarea name='appointment' class='form-control'><?php  if($result['appointment'] ) { ?><?php  echo $result['appointment'];?><?php  } else { ?>课程预约||兴趣小组||集体活动<?php  } ?></textarea>
                                                    <div class="form-control-focus"> </div>
                                                    <span class="help-block">每个不同的类别以||分开</span>
                                                </div>
                                            </div>
                                            <div class="form-group form-md-line-input  ">
                                                <label class="col-md-2 control-label" for="host_url">学校微官网地址[不填写调用自带的]</label>
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control" name="host_url"  id="host_url"   value="<?php  echo $result['host_url'];?>"  >
                                                    <div class="form-control-focus"> </div>
                                                </div>
                                            </div>
                                             <div class="form-group form-md-line-input  ">
                                                <label class="col-md-2 control-label" for="parents">学生可绑定家长数[1-3人]</label>
                                                <div class="col-md-10">
                                                    <input type="number" class="form-control" id="parents" placeholder="学生可绑定家长数" value='<?php  echo $result['parents'];?>' name='parents' placeholder="3">
                                                    <div class="form-control-focus"> </div>
                                                </div>
                                            </div>                                           
                                            <div class="form-group form-md-line-input  ">
                                                <label class="col-md-2 control-label" for="on_school">在校时间</label>
                                                <div class="col-md-10">
                                                    <input type="number" class="form-control" id="on_school" placeholder="一周在校天数" value='<?php  echo $result['on_school'];?>' name='on_school' placeholder="5">
                                                    <div class="form-control-focus"> </div>
                                                </div>
                                            </div>
                                               <div class="form-group form-md-line-input  ">
                                                <label class="col-md-2 control-label" for="begin_dayon_school">周几课程开始</label>
                                                <div class="col-md-10">
                                                    <input type="number" class="form-control" id="begin_day" placeholder="周几开始上学" value='<?php  echo $result['begin_day'];?>' name='begin_day' placeholder="1">
                                                    <div class="form-control-focus"> </div>
                                                </div>
                                            </div>             
                                       <div class="form-group form-md-line-input ">
                                           <label class="col-md-2 control-label">课时配置</label>
                                            <div class="col-md-10 ">
                                                <div class="col-md-4">
                                                    <div class="form-group form-md-line-input  ">
                                                        <div class="input-icon col-md-4">
                                                            <input type="number"  name="am_much" class="form-control" value="<?php  echo $result['am_much'];?>"  >
                                                            <label for="am_much">上午课节数</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group form-md-line-input has-warning">
                                                        <div class="input-icon col-md-4">
                                                        <input type="number" name="pm_much" class="form-control" value="<?php  echo $result['pm_much'];?>">
                                                        <label for="pm_much">下午课节数</label>
                                                    </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group form-md-line-input has-error">
                                                        <div class="input-icon col-md-4">
                                                            <input type="number" name="ye_much" class="form-control" value="<?php  echo $result['ye_much'];?>" >
                                                            <label for="ye_much">晚上课节数</label>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>                                                          
                                        </div>        
                                        <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label" for="form_control_1">教师考核单位</label>
                                                <div class="col-md-10">
                                                    <input type="text" name="tea_check_unit" id="tea_check_unit" class="form-control" value='<?php  echo S("system",'TeacherCheckUnit',array($_SESSION['school_id'],'get' )  );?>' />
                                                    <div class="form-control-focus"> </div>
                                                </div>
                                        </div>

                                       <div class="form-group form-md-line-input ">
                                           <label class="col-md-2 control-label">作业考核配置</label>
                                            <div class="col-md-10 ">
                                                <div class="col-md-4">
                                                    <div class="form-group form-md-line-input  ">
                                                        <div class="input-icon col-md-4">
                                                            <input type="number"  name="day_work_much" class="form-control" value="<?php  echo S("system",'dayWorkMuch',array('get'));?>"  >
                                                            <label for="am_much">每日有效发送数</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group form-md-line-input has-warning">
                                                        <div class="input-icon col-md-4">
                                                        <input type="number" name="day_work_base" class="form-control" value="<?php  echo S("system",'dayWorkBase',array('get'));?>">
                                                        <label for="pm_much">每次作业的基数</label>
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>                                                          
                                        </div> 
                                       
                                       <div class="form-group form-md-line-input ">
                                           <label class="col-md-2 control-label">文章考核配置</label>
                                            <div class="col-md-10 ">
                                                <div class="col-md-4">
                                                    <div class="form-group form-md-line-input  ">
                                                        <div class="input-icon col-md-4">
                                                            <input type="number"  name="day_article_much" class="form-control" value="<?php  echo S("system",'getSetContent',array('day_article_much',$_SESSION['school_id']));?>"  >
                                                            <label for="am_much">每日有效发送数</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group form-md-line-input has-warning">
                                                        <div class="input-icon col-md-4">
                                                        <input type="number" name="day_article_base" class="form-control" value="<?php  echo S("system",'getSetContent',array('day_article_base',$_SESSION['school_id']));?>">
                                                        <label for="pm_much">每次文章的基数</label>
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>                                                          
                                        </div> 

                                          <div class="form-group form-md-line-input ">
                                           <label class="col-md-2 control-label">教师登录考核配置</label>
                                            <div class="col-md-10 ">
                                                <div class="col-md-4">
                                                    <div class="form-group form-md-line-input  ">
                                                        <div class="input-icon col-md-4">
                                                            <input type="number"  name="day_login_much" class="form-control" value="<?php  echo S("system",'getSetContent',array('day_login_much',$_SESSION['school_id']));?>"  >
                                                            <label for="am_much">每日有效登录数</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group form-md-line-input has-warning">
                                                        <div class="input-icon col-md-4">
                                                        <input type="number" name="day_login_base" class="form-control" value="<?php  echo S("system",'getSetContent',array('day_login_base',$_SESSION['school_id']));?>">
                                                        <label for="pm_much">每次登录的基数</label>
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>                                                          
                                        </div>    
 
                                          <div class="form-group form-md-line-input ">
                                           <label class="col-md-2 control-label">教师班级圈考核配置</label>
                                            <div class="col-md-10 ">
                                                <div class="col-md-4">
                                                    <div class="form-group form-md-line-input  ">
                                                        <div class="input-icon col-md-4">
                                                            <input type="number"  name="day_line_much" class="form-control" value="<?php  echo S("system",'getSetContent',array('day_line_much',$_SESSION['school_id']));?>"  >
                                                            <label for="am_much">每日有效发送数</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group form-md-line-input has-warning">
                                                        <div class="input-icon col-md-4">
                                                        <input type="number" name="day_line_base" class="form-control" value="<?php  echo S("system",'getSetContent',array('day_line_base',$_SESSION['school_id']));?>">
                                                        <label for="pm_much">每次发送的基数</label>
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>                                                          
                                        </div>  

                                        <div class="form-actions">
                                            <div class="row">
                                                <div class="col-md-offset-2 col-md-10">
                                                    <input type="submit" name="submit" class="btn blue" value="确认"></button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                    </div>
             </div>
             </div>
             </div>
         <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/right', TEMPLATE_INCLUDEPATH)) : (include template('../admin/right', TEMPLATE_INCLUDEPATH));?>
        </div>
     <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/footer', TEMPLATE_INCLUDEPATH)) : (include template('../admin/footer', TEMPLATE_INCLUDEPATH));?>
         </body>
    </html>
           