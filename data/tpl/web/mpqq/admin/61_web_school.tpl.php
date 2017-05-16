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
                                                <label class="col-md-2 control-label">学校简介</label>
                                                <div class="col-md-10">
                                                    <input type="text"  class="form-control" name="school_info_intro" value="<?php  echo S("system",'getSetContent',array('school_info_intro',$school_id))?>">
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
                                                    <?php  echo upImg('care_img',S("system",'getSetContent',array('care_img',$school_id)) ,$this);?>
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
                                                    <?php  echo upImg('school_logo',S("system",'getSetContent',array('school_logo',$school_id)) ,$this);?>
                                                </div>
                                            </div>                                                                                     
                                            <div class="form-group form-md-line-input" onchange="usefun()">
                                                <label class="col-md-2 control-label" for="form_control_1">手机端模板（不填写为默认）</label>
                                                <div class="col-md-10">
                                                    <select name="mu_str" class="form-control" id='mu_str'>
                                                        <?php  if(is_array($template_file_list)) { foreach($template_file_list as $v) { ?>
                                                            <option value="<?php  echo $v;?>"  <?php  if($v == $result['mu_str']) { ?> selected <?php  } ?> ><?php  echo $v;?></option>
                                                        <?php  } } ?>
                                                    </select>
                                                    <div class="form-control-focus"> </div>
                                                    <span class="help-block">此模板目录和template/mobile为同级目录.</span>
                                                </div>
                                            </div>
                                            <div  class=" xiaoye_home form-group form-md-line-input" style="<?php  if($result['mu_str']!='xiaoye') { ?>display:none;<?php  } ?>">
                                                <label class="col-md-2 control-label" for="form_control_1">小烨模板家长端首页</label>
                                                <div class="col-md-10">
                                                    <select name="xiaoye_home" class="form-control">
                                                        <option value="0" <?php  if(S("system",'getSetContent',array('xiaoye_home',$school_id)) ==0 ) { ?> selected <?php  } ?>>功能块首页</option>
                                                        <option value="1" <?php  if(S("system",'getSetContent',array('xiaoye_home',$school_id)) ==1 ) { ?> selected <?php  } ?>>信息块首页</option>
                                                    </select>
                                                    <div class="form-control-focus"> </div>
                                                </div>
                                            </div>
                                            <div  class=" xiaoye_home form-group form-md-line-input" style="<?php  if($result['mu_str']!='xiaoye') { ?>display:none;<?php  } ?>">
                                                <label class="col-md-2 control-label" for="form_control_1">小烨模板家长端底部</label>
                                                <div class="col-md-10">
                                                    <select name="xiaoye_bottom" class="form-control">
                                                        <option value="0" <?php  if(S("system",'getSetContent',array('xiaoye_bottom',$school_id)) ==0 ) { ?> selected <?php  } ?>>固定</option>
                                                        <option value="1" <?php  if(S("system",'getSetContent',array('xiaoye_bottom',$school_id)) ==1 ) { ?> selected <?php  } ?>>自定义</option>
                                                    </select>
                                                    <div class="form-control-focus"> </div>
                                                </div>
                                            </div>

                                            <div  class=" xiaoye_home form-group form-md-line-input" style="<?php  if($result['mu_str']!='xiaoye') { ?>display:none;<?php  } ?>">
                                                <label class="col-md-2 control-label" for="form_control_1">小烨模板教师端底部</label>
                                                <div class="col-md-10">
                                                    <select name="xiaoye_tea_bottom" class="form-control">
                                                        <option value="0" <?php  if(S("system",'getSetContent',array('xiaoye_tea_bottom',$school_id)) ==0 ) { ?> selected <?php  } ?>>固定</option>
                                                        <option value="1" <?php  if(S("system",'getSetContent',array('xiaoye_tea_bottom',$school_id)) ==1 ) { ?> selected <?php  } ?>>自定义</option>
                                                    </select>
                                                    <div class="form-control-focus"> </div>
                                                </div>
                                            </div>
                                            
                                            <script>
                                                function usefun(){
                                                    va = $("#mu_str").val();
                                                    if(va=='xiaoye'){
                                                        $(".xiaoye_home").show();
                                                    }else{
                                                        $(".xiaoye_home").hide();
                                                    }
                                                }
                                            </script>
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
                                            <div class="col-md-10">
                                                 <input type="checkbox"  value='1'  <?php  if($op=='new') { ?> checked <?php  } else { ?> <?php  if($result['status']==1) { ?> checked <?php  } ?> <?php  } ?>  class="make-switch" name="status" data-on-text="正常" data-off-text="关闭">
                                             </div>
                                        </div>
                                        
                                         <div class="form-group form-md-radios form-md-line-input  ">
                                            <label class="col-md-2 control-label">家长发布班级圈</label>
                                              <div class="col-md-10">
                                                 <input type="checkbox"  value='1'  <?php  if($result['line_status']==1) { ?> checked <?php  } ?> class="make-switch" name="line_status" data-on-text="不审核" data-off-text="需审核">
                                             </div>
                                        </div>

                                        <div class="form-group form-md-radios form-md-line-input  ">
                                            <label class="col-md-2 control-label"  >班级圈视频</label>
                                            <div class="col-md-10">
                                                 <input type="checkbox"  value='1'  <?php  if(S("system",'getSetContent',array('line_video_status',$school_id)) == 1 ) { ?> checked <?php  } ?>  class="make-switch" name="line_video_status" data-on-text="开启" data-off-text="关闭">
                                             </div>
                                        </div>
                                        
                                         <!--<div class="form-group form-md-radios form-md-line-input  ">
                                            <label class="col-md-2 control-label"  >班级公告</label>
                                            <div class="col-md-10">
                                                 <input type="checkbox"  value='1'  <?php  if($result['class_notice_status']==1) { ?> checked <?php  } ?>  class="make-switch" name="class_notice_status" data-on-text="不审核" data-off-text="需审核">
                                             </div>
                                        </div>-->

                                        <div class="form-group form-md-line-input">
                                                    <label class="control-label col-md-2">多班级</label>
                                                    <div class="col-md-10">
                                                        <input type="checkbox"  value='1'  <?php  if(S("system",'getSetContent',array('much_class',$school_id)) ==1 ) { ?> checked <?php  } ?>  class="make-switch" name="much_class" data-on-text="开启" data-off-text="关闭">
                                                    </div>
                                          </div>
                                        <div class="form-group form-md-radios form-md-line-input  ">
                                            <label class="col-md-2 control-label"  >家长绑定时资料填写</label>
                                             <div class="col-md-10">
                                                 <input type="checkbox"  value='1'  <?php  if(S("system",'getSetContent',array('parents_info',$school_id)) ==1 ) { ?> checked <?php  } ?>  class="make-switch" name="parents_info" data-on-text="开启" data-off-text="关闭">
                                             </div>
                                        </div>   

                                        <div class="form-group form-md-radios form-md-line-input  ">
                                            <label class="col-md-2 control-label"  >家长对家长沟通</label>
                                            <div class="col-md-10">
                                                 <input type="checkbox"  value='1'  <?php  if(S("system",'getSetContent',array('parentsToparents',$school_id)) ==1 ) { ?> checked <?php  } ?>  class="make-switch" name="parentsToparents" data-on-text="开启" data-off-text="关闭">
                                             </div>
                                        </div>   
                                        
                                        <div class="form-group form-md-radios form-md-line-input  ">
                                            <label class="col-md-2 control-label">提醒教师第二天上课课程</label>
                                            <div class="col-md-10">
                                                 <input type="checkbox"  value='1'  <?php  if(S("system",'getSetContent',array('remindTeacher',$school_id)) ==1 ) { ?> checked <?php  } ?>  class="make-switch" name="remindTeacher" data-on-text="开启" data-off-text="关闭" >
                                             </div>
                                        </div>   
                                        
                                        <div class="form-group  form-md-line-input  ">
                                                <label class= "col-md-2 control-label">班级公告分类</label>
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control" name="line_type" value="<?php  if($result['line_type']) { ?><?php  echo $result['line_type'];?><?php  } else { ?>班级活动||班级公告||重要事务<?php  } ?>">
                                                    <div class="form-control-focus"> </div>
                                                    <span class="help-block">每个不同的类别以||分开【最佳三个分类】</span>
                                                </div>
                                            </div>
                                            <div class="form-group  form-md-line-input  ">
                                                <label class=" col-md-2 control-label">预约类别</label>
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control" name="appointment" value="<?php  if($result['appointment']) { ?><?php  echo $result['appointment'];?><?php  } else { ?>课程预约||兴趣小组||集体活动<?php  } ?>">
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
                                                <div class="col-md-4">
                                                    <select name="parents"  class="form-control">
                                                        <option value="1" <?php  if($result['parents'] ==1 ) { ?>selected<?php  } ?>>1</option>
                                                        <option value="2" <?php  if($result['parents'] ==2 ) { ?>selected<?php  } ?>>2</option>
                                                        <option value="3" <?php  if($result['parents'] ==3 ) { ?>selected<?php  } ?>>3</option>
                                                    </select>
                                                    <div class="form-control-focus"> </div>
                                                </div>
                                            </div>                                           
                                            <div class="form-group form-md-line-input  ">
                                                <label class="col-md-2 control-label" for="on_school">在校天数【一周的在校天数】</label>
                                                <div class="col-md-4">
                                                    <select name="on_school"  class="form-control">
                                                        <option value="1" <?php  if($result['on_school'] ==1 ) { ?>selected<?php  } ?>>1</option>
                                                        <option value="2" <?php  if($result['on_school'] ==2 ) { ?>selected<?php  } ?>>2</option>
                                                        <option value="3" <?php  if($result['on_school'] ==3 ) { ?>selected<?php  } ?>>3</option>
                                                        <option value="4" <?php  if($result['on_school'] ==4 ) { ?>selected<?php  } ?>>4</option>
                                                        <option value="5" <?php  if($result['on_school'] ==5 ) { ?>selected<?php  } ?>>5</option>
                                                        <option value="6" <?php  if($result['on_school'] ==6 ) { ?>selected<?php  } ?>>6</option>
                                                        <option value="7" <?php  if($result['on_school'] ==7 ) { ?>selected<?php  } ?>>7</option>
                                                    </select>
                                                </div>
                                            </div>
                                               <div class="form-group form-md-line-input  ">
                                                <label class="col-md-2 control-label" for="begin_dayon_school">周几课程开始</label>
                                                <div class="col-md-4">
                                                    <select name="begin_day"  class="form-control">
                                                        <option value="1" <?php  if($result['begin_day'] ==1 ) { ?>selected<?php  } ?>>1</option>
                                                        <option value="2" <?php  if($result['begin_day'] ==2 ) { ?>selected<?php  } ?>>2</option>
                                                        <option value="3" <?php  if($result['begin_day'] ==3 ) { ?>selected<?php  } ?>>3</option>
                                                        <option value="4" <?php  if($result['begin_day'] ==4 ) { ?>selected<?php  } ?>>4</option>
                                                        <option value="5" <?php  if($result['begin_day'] ==5 ) { ?>selected<?php  } ?>>5</option>
                                                        <option value="6" <?php  if($result['begin_day'] ==6 ) { ?>selected<?php  } ?>>6</option>
                                                        <option value="7" <?php  if($result['begin_day'] ==7 ) { ?>selected<?php  } ?>>7</option>
                                                    </select>
                                                </div>
                                            </div>       

                                       <div class="form-group form-md-line-input ">
                                           <label class="col-md-2 control-label">课时配置</label>
                                            <div class="col-md-10 ">
                                                <div class="col-md-4">
                                                    <div class="form-group form-md-line-input  ">
                                                        <div class="input-icon col-md-8">
                                                            <input type="number"  name="am_much" class="form-control" value="<?php  echo $result['am_much'];?>"  >
                                                            <label for="am_much">上午课节数</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group form-md-line-input has-warning">
                                                        <div class="input-icon col-md-8">
                                                        <input type="number" name="pm_much" class="form-control" value="<?php  echo $result['pm_much'];?>">
                                                        <label for="pm_much">下午课节数</label>
                                                    </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group form-md-line-input has-error">
                                                        <div class="input-icon col-md-8">
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
                                                            <input type="number"  name="day_homeWork_much" class="form-control" value="<?php  echo S("system",'getSetContent',array('day_homeWork_much',$school_id));?>"  >
                                                            <label for="am_much">每日有效发送数</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group form-md-line-input has-warning">
                                                        <div class="input-icon col-md-8">
                                                        <input type="number" name="day_homeWork_base" class="form-control" value="<?php  echo S("system",'getSetContent',array('day_homeWork_base',$school_id));?>">
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

                                        <div class="form-group form-md-line-input ">
                                           <label class="col-md-2 control-label">发送学生记录数考核配置</label>
                                            <div class="col-md-10 ">
                                                <div class="col-md-4">
                                                    <div class="form-group form-md-line-input  ">
                                                        <div class="input-icon col-md-8">
                                                            <input type="number"  name="day_work_much" class="form-control" value="<?php  echo S("system",'getSetContent',array('day_work_much',$school_id));?>"  >
                                                            <label for="am_much">每日有效发送数</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group form-md-line-input has-warning">
                                                        <div class="input-icon col-md-8">
                                                        <input type="number" name="day_work_base" class="form-control" value="<?php  echo S("system",'getSetContent',array('day_work_base',$school_id));?>">
                                                        <label for="pm_much">每次发送的计分</label>
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>                                                          
                                        </div>  

                                        <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label">访问统计</label>
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control"  placeholder="访问统计代码" value="<?php  echo S("system",'getSetContent',array('ask_url',$school_id));?>" name='ask_url'  >
                                                    <div class="form-control-focus"> </div>
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
            <script src="<?php echo MODULE_URL;?>/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
         <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/right', TEMPLATE_INCLUDEPATH)) : (include template('../admin/right', TEMPLATE_INCLUDEPATH));?>
        </div>
     <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/footer', TEMPLATE_INCLUDEPATH)) : (include template('../admin/footer', TEMPLATE_INCLUDEPATH));?>
         </body>
    </html>
           