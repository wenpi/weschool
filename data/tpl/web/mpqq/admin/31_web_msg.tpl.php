<?php defined('IN_IA') or exit('Access Denied');?>   <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/head', TEMPLATE_INCLUDEPATH)) : (include template('../admin/head', TEMPLATE_INCLUDEPATH));?>
        <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/header', TEMPLATE_INCLUDEPATH)) : (include template('../admin/header', TEMPLATE_INCLUDEPATH));?>
        <div class="page-container">
        <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/left', TEMPLATE_INCLUDEPATH)) : (include template('../admin/left', TEMPLATE_INCLUDEPATH));?>
            <div class="page-content-wrapper">
                <div class="page-content">
                <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/sidebar', TEMPLATE_INCLUDEPATH)) : (include template('../admin/sidebar', TEMPLATE_INCLUDEPATH));?>
                    <h1 class="page-title"> <?php  echo $_SESSION['school_name'];?>
                            <small> <?php  echo $title;?> </small>
                    </h1>
            <!--结束公共头部-->
                <div class='row'>
                    <form action="" method="post" class="form-horizontal form" enctype="multipart/form-data" id="form1"  >
                 	 <input type='hidden' value='<?php  echo $model;?>' name='model'>
                     <div class="col-md-12">
                            <?php  if($model =='grade') { ?>
                                <?php  $page = '年级列表';?>
                                <?php  $intro ='请选择学生所在的年级'; ?>
                                <?php  $color ='green';?>
                            <?php  } else if($model =='class') { ?>
                                <?php  $page = '班级列表';?>
                                <?php  $intro ='请选择学生所在的班级'; ?>
                                <?php  $color ='yellow-casablanca';?>
                            <?php  } else if($model =='student') { ?>
                                <?php  $page = '学生列表';?>
                                <?php  $intro ='填写具体的分数'; ?>
                                <?php  $color ='blue';?>
                            <?php  } ?>
                                <div class="note note-info">
                                    <h4 class="block"><?php  echo $page;?></h4>
                                    <p><?php  echo $intro;?></p>
                                </div> 
                                <?php  if(is_array($result)) { foreach($result as $item) { ?>
                                <div class="col-md-2 col-sm-2 col-xs-6">
                                    <div class="color-demo tooltips" >
                                        <?php  if($model !='student') { ?>
                                            <a href="<?php  echo $this->result_result($item,$model,'url','msg');?>&aw=1">
                                        <?php  } ?>
                                             <div onclick="check_this(<?php  echo $item['student_id'];?>)" class="color-view bg-<?php  echo $color;?> bg-font-<?php  echo $color;?> bold uppercase"><?php  echo $this->result_result($item,$model,'name','msg');?> </div>
                                        <?php  if($model !='student') { ?>
                                            </a>
                                        <?php  } ?>
                                        <div class=" bg-white c-font-14 sbold">
                                              &nbsp;&nbsp; <input id="chebox_<?php  echo $item['student_id'];?>" type='checkbox' value='<?php  if($model!='student') { ?><?php  echo $item;?><?php  } else { ?><?php  echo $item['student_id'];?><?php  } ?>' name='have[]'>选择
                                       </div>
                                    </div>
                                </div>
                                <?php  } } ?>                       
                       </div>
                       <div style="clear:both"></div>
                             <div class="row">
                           
                              <!--<div class="col-md-6 ">
                                <div class="portlet box yellow ">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-gift"></i> 添加发送内容【客服消息】</div>
                                        <div class="tools">
                                            <a href="" class="collapse"> </a>
                                        </div>
                                    </div>
                                    <div class="portlet-body form">
                                            <div class="form-body">
                                                <div class="form-group">
                                                <label class="  col-md-3 control-label"><span style='color:red'>*</span>标题</label>
                                                <div class="col-sm-9 col-xs-8">
                                                    <textarea name='title_kf' class='form-control' placeholder="发送标题"></textarea>
                                                </div>
                                                <div style='clear:both'></div>
                                            </div>   
                                            <div class="form-group">
                                                <label class="  col-md-3 control-label"><span style='color:red'>*</span>内容说明</label>
                                                <div class="col-sm-9 col-xs-8">
                                                    <textarea name='content_kf' class='form-control' placeholder="请尽量减少群发消息，以免账号被封！"></textarea>
                                                </div>
                                                <div style='clear:both'></div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label class="  col-md-3 control-label"><span style='color:red'>*</span>链接地址（https:// 或者http://）</label>
                                                <div class="col-sm-9 col-xs-8">
                                                    <textarea name='url_kf' class='form-control'></textarea>
                                                </div>
                                                <div style='clear:both'></div>
                                            </div>                                              
                                            </div>
                                            <div class="form-actions right1">
                                            			<input type="submit" name="submit_kf" value="客服消息" class="btn green" />
                                            </div>
                                    </div>
                                </div>
                            </div>-->

                              <div class="col-md-6 ">
                                <div class="portlet box blue ">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-gift"></i> 	添加发送内容【微信模板机制】 </div>
                                        <div class="tools">
                                            <a href="" class="collapse"> </a>
                                        </div>
                                    </div>
                                    <div class="portlet-body form">
                                            <div class="form-body">
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">标题【不填写为默认】</label>
                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control input-lg"  name='weixin_title'  placeholder="[学生姓名]你好，这是个新的消息" > </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label"><span style='color:red'>*</span>内容说明</label>
                                                    <div class="col-sm-9 ">
                                                        <textarea name='intro'  maxlength="50" class='form-control' placeholder="请尽量减少群发消息，以免账号被封！(30字以内)"></textarea>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class=" col-md-3 control-label"><span style='color:red'>*</span>备注信息</label>
                                                    <div class="col-sm-9 ">
                                                        <textarea name='remark'  maxlength="30" class='form-control'></textarea>
                                                    </div>
                                                </div>	
 
                                                <div class="form-group">
                                                    <label class=" col-md-3 control-label"><span style='color:red'>*</span>详细说明【会自动生成访问地址】</label>
                                                    <div class="col-sm-9 ">
                                                        <?php  echo tpl_ueditor('real_content','');?>	
                                                    </div>
                                                </div>	                               
                                                                
                                                <div class="form-group">
                                                    <label class=" col-md-3 control-label"><span style='color:red'>*</span>详情地址（https:// 或者http://）</label>
                                                    <div class="col-sm-9 ">
                                                        <input name='url' type="text" class="form-control input-lg" >
                                                    </div>
                                                </div>     
                                            </div>
                                            <div class="form-actions right1">
                                                	<input type="submit" name="submit_weixin" value="发送模板消息" class="btn green" />
                                            </div>
                                    </div>
                                </div>

                            </div>

                            <div class="col-md-6 ">
                                <div class="portlet box purple ">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-gift"></i>添加发送内容【短信机制】</div>
                                        <div class="tools">
                                            <a href="" class="collapse"> </a>
                                        </div>
                                    </div>
                                    <div class="portlet-body form">
                                            <div class="form-body">
                                                <div class="form-group">
                                                    <label class=" col-md-3 control-label"><span style='color:red'>*</span>抬头(3～10个字符)</label>
                                                    <div class="col-sm-9  ">
                                                        <input name='sms_head' value='<?php  echo $_SESSION['school_name'];?>' class='form-control'>
                                                    <br>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="  col-md-3 control-label"><span style='color:red'>*</span>内容说明（控制字数）</label>
                                                    <div class="col-sm-9  ">
                                                        <textarea name='sms_content' class='form-control' ></textarea>
                                                    </div>
                                                </div>                                               
                                            </div>
                                            <div class="form-actions right1">
                                      			<input type="submit" name="submit_sms" value="发送短信" class="btn green" />
                                            </div>
                                    </div>
                                </div>
                            </div>
                          </div>
                    </form>
                    </div>
                </div>
            <!--开始公共尾部-->
              </div>
            </div>
         <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/right', TEMPLATE_INCLUDEPATH)) : (include template('../admin/right', TEMPLATE_INCLUDEPATH));?>
        </div>
     <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/footer', TEMPLATE_INCLUDEPATH)) : (include template('../admin/footer', TEMPLATE_INCLUDEPATH));?>
    </body>
    </html>