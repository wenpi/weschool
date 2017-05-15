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
                          <div class="col-md-12 col-sm-12">
                            <!-- BEGIN EXAMPLE TABLE PORTLET-->
                            <div class="portlet box red">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-cogs"></i>请选择需要发送消息的教师 </div>
                                </div> 
                                <div class="portlet-body">
                                    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_3">
                                        <thead>
                                            <tr>
                                                      <th class="table-checkbox">
                                                        <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                                            <input type="checkbox" class="group-checkable" data-set="#sample_3 .checkboxes" onclick="checkBox()"/>
                                                            <span></span>
                                                        </label>
                                                    </th>
                                                <th> 教师名 </th>
                                                <th> 授课 </th>
                                                <th> 班级 </th>
                                                <th> 班主任 </th>
                                            </tr>
                                        </thead>
                                        <tbody>
 
                                            <?php  if(is_array($teacher_list)) { foreach($teacher_list as $item) { ?>
                                                <tr class="odd gradeX">
                                                     <td>
                                                        <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                                          <input type='checkbox' class='teacher_checkbox' value='<?php  echo $item['teacher_id'];?>' name='have[]'>
                                                            <span></span>
                                                        </label>
                                                    </td>
                                                    <td><?php  echo $item['teacher_realname'];?> </td>
                                                    <td><?php  echo $this->teacherCourse($item['teacher_id'],'echo');?></td>
                                                    <?php  $class_list = D('teacher')->getTeacherClass($item['teacher_id'],true);?>
                                                    <td>
                                                        <?php  if(is_array($class_list['list_all'])) { foreach($class_list['list_all'] as $row) { ?>
                                                            <?php  echo $row['grade_name'];?>-
                                                            <?php  echo $row['class_name'];?>,
                                                        <?php  } } ?>
                                                    </td>
                                                    <td><?php  if($result=$this->classHead($item['teacher_id'])) { ?>
                                                        <a class='a_use_title' href='' title="<?php  echo $this->echoArrOne($result,'class_name');?>">班主任</a>
                                                        <?php  } else { ?>否
                                                        <?php  } ?>
                                                    </td>
                                                </tr>                                           
                                            <?php  } } ?>
 
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>                       

                       <div style="clear:both"></div>
                              <div class="col-md-12 ">
                                <div class="portlet box green ">
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
                                                    <label class="col-md-3 control-label">标题</label>
                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control input-lg"  name='weixin_title'  placeholder="" > </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label"><span style='color:red'>*</span>内容说明</label>
                                                    <div class="col-sm-9 ">
                                                        <textarea name='content' class='form-control'  ></textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class=" col-md-3 control-label"><span style='color:red'>*</span>详细说明【会自动生成访问地址】</label>
                                                    <div class="col-sm-9 ">
                                                        <?php  echo tpl_ueditor('record_content','');?>
                                                        <span class="help-block">图片只可粘贴进来</span>	
                                                    </div>
                                                </div>	                                                 
                                                <div class="form-group">
                                                    <label class=" col-md-3 control-label"><span style='color:red'>*</span>备注信息</label>
                                                    <div class="col-sm-9 ">
                                                        <textarea name='remark' class='form-control'></textarea>
                                                    </div>
                                                </div>	
                                                <div class="form-group">
                                                    <label class=" col-md-3 control-label"><span style='color:red'>*</span>链接地址（https:// 或者http://）</label>
                                                    <div class="col-sm-9 ">
                                                        <textarea name='url' class='form-control'></textarea>
                                                    </div>
                                                </div>     
                                            </div>
                                            <div class="form-actions ">
                                                	<input type="submit" name="submit_weixin" value="提交" class="btn green" />
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
    <script>
        function checkBox(){
            $(".teacher_checkbox").prop("checked",true);
        }
    </script>
    <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/right', TEMPLATE_INCLUDEPATH)) : (include template('../admin/right', TEMPLATE_INCLUDEPATH));?>
    </div>
     <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/footer', TEMPLATE_INCLUDEPATH)) : (include template('../admin/footer', TEMPLATE_INCLUDEPATH));?>
     <!--筛选表格-->
     <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/table_script', TEMPLATE_INCLUDEPATH)) : (include template('../admin/table_script', TEMPLATE_INCLUDEPATH));?>         
    </body>
    </html>