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
                                    <div class="caption">
                                        <span > 学校参数设置</span>
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
                                                <label class="col-md-2 control-label"><span class="required" aria-required="true"> * </span>家长端title</label>
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control"  placeholder="家长端title" value="<?php  echo S("system",'getSetContent',array('mobile_title',$school_id))?>" name='mobile_title' required >
                                                    <div class="form-control-focus"> </div>
                                                </div>
                                            </div>  

                                             <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label">渠道二维码关注欢迎语</label>
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control"  placeholder="渠道二维码关注欢迎语" value="<?php  echo S("system",'getSetContent',array('care_str',$school_id))?>" name='care_str'  >
                                                    <div class="form-control-focus"> </div>
                                                </div>
                                             </div>                                                
                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label">渠道二维码关注图片</label>
                                                <div class="col-md-10">
                                                    <?php  echo tpl_form_field_image('care_img',S("system",'getSetContent',array('care_img',$school_id)) );?>
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
                                                    <?php  echo tpl_form_field_image('school_logo',S("system",'getSetContent',array('school_logo',$school_id)) );?>
                                                </div>
                                            </div>                                                                                     
                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label" for="form_control_1">手机端模板（不填写为默认）</label>
                                                <div class="col-md-10">
                                                    <select name="mu_str" class="form-control">
                                                        <?php  if(is_array($template_file_list)) { foreach($template_file_list as $v) { ?>
                                                            <option value="<?php  echo $v;?>"  <?php  if($v == $result['mu_str']) { ?> selected <?php  } ?> ><?php  echo $v;?></option>
                                                        <?php  } } ?>
                                                    </select>
                                                    <div class="form-control-focus"> </div>
                                                    <span class="help-block">此模板目录和template/mobile为同级目录.</span>
                                                </div>
                                            </div>
                                             <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label" for="form_control_1">微官网模板（不填写为默认）</label>
                                                <div class="col-md-10">
                                                    <select name="wap_teamplate" class="form-control">
                                                        <?php  $wap_template =  S("system",'getSchoolWapTemplate',array($school_id)  );?>
                                                        <?php  if(is_array($wap_file_list)) { foreach($wap_file_list as $v) { ?>
                                                            <option value="<?php  echo $v;?>"  <?php  if($v == $wap_template) { ?> selected <?php  } ?> ><?php  echo $v;?></option>
                                                        <?php  } } ?>
                                                    </select>
                                                    <div class="form-control-focus"> </div>
                                                </div>
                                            </div>  
                                              <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label" for="form_control_1">PC官网模板（不填写为默认）</label>
                                                <div class="col-md-10">
                                                    <select name="pc_teamplate" class="form-control">
                                                        <?php  $web_template =  S("system",'getSchoolPcTemplate',array($school_id)  );?>
                                                        <?php  if(is_array($web_file_list)) { foreach($web_file_list as $v) { ?>
                                                            <option value="<?php  echo $v;?>"  <?php  if($v == $web_template) { ?> selected <?php  } ?> ><?php  echo $v;?></option>
                                                        <?php  } } ?>
                                                    </select>                                                    
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
                                            <label class="col-md-2 control-label"  >班级圈视频</label>
                                            <div class="md-radio-inline">
                                                <div class="md-radio">
                                                    <input type="radio"  id="sradiol" class="md-radiobtn"  name="line_video_status"   value='0' <?php  if(S("system",'getSetContent',array('line_video_status',$school_id)) ==0 ) { ?> checked <?php  } ?>  />
                                                    <label for="sradiol">
                                                        <span></span>
                                                        <span class="check"></span>
                                                        <span class="box"></span>开启(默认)</label>
                                                </div>
                                                <div class="md-radio">
                                                  <input type="radio"   id='sradiol1' class="md-radiobtn" name="line_video_status"   value='2' <?php  if(S("system",'getSetContent',array('line_video_status',$school_id)) ==2 ) { ?> checked <?php  } ?> />
                                                    <label for="sradiol1">
                                                        <span></span>
                                                        <span class="check"></span>
                                                        <span class="box"></span>关闭</label>
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
 
                                         <div class="form-group form-md-radios form-md-line-input  ">
                                            <label class="col-md-2 control-label"  >多班级</label>
                                            <div class="md-radio-inline">
                                                <div class="md-radio">
                                                    <input type="radio" id="radion_much_class" class="md-radiobtn" name="much_class"   value='1' <?php  if(S("system",'getSetContent',array('much_class',$school_id)) ==1 ) { ?> checked <?php  } ?>   />
                                                    <label for="radion_much_class">
                                                        <span></span>
                                                        <span class="check"></span>
                                                        <span class="box"></span>开启</label>
                                                </div>
                                                <div class="md-radio">
                                                  <input type="radio"    id='radion1_much_class' class="md-radiobtn" name="much_class"   value='0' <?php  if(S("system",'getSetContent',array('much_class',$school_id)) ==0 ) { ?> checked <?php  } ?>   />
                                                    <label for="radion1_much_class">
                                                        <span></span>
                                                        <span class="check"></span>
                                                        <span class="box"></span>关闭</label>
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="form-group form-md-radios form-md-line-input  ">
                                            <label class="col-md-2 control-label"  >家长绑定时资料填写</label>
                                            <div class="md-radio-inline">
                                                <div class="md-radio">
                                                    <input type="radio" id="radion_parents_info" class="md-radiobtn" name="parents_info"   value='1' <?php  if(S("system",'getSetContent',array('parents_info',$school_id)) ==1 ) { ?> checked <?php  } ?>   />
                                                    <label for="radion_parents_info">
                                                        <span></span>
                                                        <span class="check"></span>
                                                        <span class="box"></span>开启</label>
                                                </div>
                                                <div class="md-radio">
                                                  <input type="radio"    id='radion1_parents_info' class="md-radiobtn" name="parents_info"   value='0' <?php  if(S("system",'getSetContent',array('parents_info',$school_id)) ==0 ) { ?> checked <?php  } ?>   />
                                                    <label for="radion1_parents_info">
                                                        <span></span>
                                                        <span class="check"></span>
                                                        <span class="box"></span>关闭</label>
                                                </div>
                                            </div>
                                        </div>   
                                                                              
                                        <div class="form-group  form-md-line-input  ">
                                                <label class= "col-md-2 control-label">班级公告分类</label>
                                                <div class="col-md-10">
                                                    <textarea name='line_type' class='form-control'><?php  if($result['line_type'] ) { ?><?php  echo $result['line_type'];?><?php  } else { ?>班级活动||班级公告||重要事务<?php  } ?></textarea>
                                                    <div class="form-control-focus"> </div>
                                                    <span class="help-block">每个不同的类别以||分开【最佳三个分类】</span>
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

                                             <div class="form-group  form-md-line-input  ">
                                                <label class=" col-md-2 control-label">学校餐</label>
                                                <div class="col-md-10">
                                                    <?php  $school_cookbook_class = S('system','getSetContent',array('cookbook_class',$school_id) )?>
                                                    <input name='cookbook_class' class='form-control' value="<?php  if($school_cookbook_class) { ?> <?php  echo $school_cookbook_class;?><?php  } else { ?>早餐||中餐||下午茶<?php  } ?>">
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
                                                    <input type="text" class="form-control" id="parents" placeholder="学生可绑定家长数" value='<?php  echo $result['parents'];?>' name='parents' placeholder="3">
                                                    <div class="form-control-focus"> </div>
                                                </div>
                                            </div>                                           
                                            <div class="form-group form-md-line-input  ">
                                                <label class="col-md-2 control-label" for="on_school">在校天数</label>
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control" id="on_school" placeholder="一周在校天数" value='<?php  echo $result['on_school'];?>' name='on_school' placeholder="5">
                                                    <div class="form-control-focus"> </div>
                                                    <span class="help-block">一周的在校天数</span>
                                                </div>
                                            </div>
                                               <div class="form-group form-md-line-input  ">
                                                <label class="col-md-2 control-label" for="begin_dayon_school">周几课程开始</label>
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control" id="begin_day" placeholder="周几开始上学" value='<?php  echo $result['begin_day'];?>' name='begin_day' placeholder="1">
                                                    <div class="form-control-focus"> </div>
                                                    <span class="help-block">一周的周几开始上课</span>
                                                </div>
                                            </div>       
                                       <div class="form-group form-md-line-input ">
                                           <label class="col-md-2 control-label">课时配置</label>
                                            <div class="col-md-10 ">
                                                <div class="col-md-4">
                                                    <div class="form-group form-md-line-input  ">
                                                        <div class="input-icon col-md-8">
                                                            <input type="text"  name="am_much" class="form-control" value="<?php  echo $result['am_much'];?>"  >
                                                            <label for="am_much">上午课节数</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group form-md-line-input has-warning">
                                                        <div class="input-icon col-md-8">
                                                        <input type="text" name="pm_much" class="form-control" value="<?php  echo $result['pm_much'];?>">
                                                        <label for="pm_much">下午课节数</label>
                                                    </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group form-md-line-input has-error">
                                                        <div class="input-icon col-md-8">
                                                            <input type="text" name="ye_much" class="form-control" value="<?php  echo $result['ye_much'];?>" >
                                                            <label for="ye_much">晚上课节数</label>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>                                                          
                                        </div>        
                                        <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label" for="form_control_1">教师考核单位</label>
                                                <div class="col-md-10">
                                                    <input type="text" name="tea_check_unit" id="tea_check_unit" class="form-control" value='<?php  echo S("system",'TeacherCheckUnit',array($school_id,'get' )  );?>' />
                                                    <div class="form-control-focus"> </div>
                                                </div>
                                        </div>

                                       <div class="form-group form-md-line-input ">
                                           <label class="col-md-2 control-label">作业考核配置</label>
                                            <div class="col-md-10 ">
                                                <div class="col-md-4">
                                                    <div class="form-group form-md-line-input  ">
                                                        <div class="input-icon col-md-8">
                                                            <input type="number"  name="day_work_much" class="form-control" value="<?php  echo S("system",'dayWorkMuch',array('get'));?>"  >
                                                            <label for="am_much">每日有效发送数</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group form-md-line-input has-warning">
                                                        <div class="input-icon col-md-8">
                                                        <input type="number" name="day_work_base" class="form-control" value="<?php  echo S("system",'dayWorkBase',array('get'));?>">
                                                        <label for="pm_much">每次作业的计分</label>
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
                                                        <div class="input-icon col-md-8">
                                                            <input type="number"  name="day_article_much" class="form-control" value="<?php  echo S("system",'getSetContent',array('day_article_much',$school_id));?>"  >
                                                            <label for="am_much">每日有效发送数</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group form-md-line-input has-warning">
                                                        <div class="input-icon col-md-8">
                                                        <input type="number" name="day_article_base" class="form-control" value="<?php  echo S("system",'getSetContent',array('day_article_base',$school_id));?>">
                                                        <label for="pm_much">每次文章的计分</label>
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
                                                        <div class="input-icon col-md-8">
                                                            <input type="number"  name="day_login_much" class="form-control" value="<?php  echo S("system",'getSetContent',array('day_login_much',$school_id));?>"  >
                                                            <label for="am_much">每日有效登录数</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group form-md-line-input has-warning">
                                                        <div class="input-icon col-md-8">
                                                        <input type="number" name="day_login_base" class="form-control" value="<?php  echo S("system",'getSetContent',array('day_login_base',$school_id));?>">
                                                        <label for="pm_much">每次登录的计分</label>
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
                                                        <div class="input-icon col-md-8">
                                                            <input type="number"  name="day_line_much" class="form-control" value="<?php  echo S("system",'getSetContent',array('day_line_much',$school_id));?>"  >
                                                            <label for="am_much">每日有效发送数</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group form-md-line-input has-warning">
                                                        <div class="input-icon col-md-8">
                                                        <input type="number" name="day_line_base" class="form-control" value="<?php  echo S("system",'getSetContent',array('day_line_base',$school_id));?>">
                                                        <label for="pm_much">每次发送的计分</label>
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>                                                          
                                        </div>  

                                        <div class="form-actions">
                                            <div class="row">
                                                <div class="col-md-offset-2 col-md-10">
                                                    <input type="submit" name="submit" class="btn blue" value="确认">
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
           