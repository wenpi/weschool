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
                <script>
                    $(function(){
                        $("#checkAction").click(function(){
                            obj=$(".class_ids");
                            if(obj.prop("checked"))
                                obj.prop('checked',false);
                            else 
                                obj.prop('checked',true);
                        });
                    });
                </script>
                <?php  if($ac=='list') { ?>
                 <div class="row">
                   <form action="" method="post"  enctype="multipart/form-data" id="form1">
                        <div class="col-md-5">
                            <div class="note note-success">
                                <p> 作业列表 </p>
                            </div>
                            <!-- BEGIN SAMPLE TABLE PORTLET-->
                            <div class="portlet box green">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-cogs"></i>班级列表 </div>
                                    <div class="tools">
                                        <a href="javascript:;" class="collapse"> </a>
                                    </div>
                                </div>
                                <div class="portlet-body flip-scroll">
                                    <table class="table table-bordered table-striped table-condensed flip-content">
                                        <thead class="flip-content">
                                            <tr>
                                            <th>选择班级</th>
                                            <th ><span id='checkAction' class='red'>全选/取消</span> &nbsp;&nbsp;操作</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php  if(is_array($list)) { foreach($list as $item) { ?>
                                            <tr>
                                                <td><a href="<?php  echo  $this->createWebUrl('homework',array('ac'=>'new','cid'=>$item['class_id'],'aw'=>1))?>">
                                                    【<?php  echo $this->gradeName($item['grade_id']);?>】<?php  echo $item['class_name'];?></a></td>
                                                <td> 
                                                    <input type='checkbox' name='class_ids[]' class='class_ids' value='<?php  echo $item['class_id'];?>'>
                                                    &nbsp;&nbsp;
                                                    <a href="<?php  echo $this->createWebUrl('homework',array('ac'=>'old','cid'=>$item['class_id'],'aw'=>1 ))?>"  
                                                        class="btn btn-outline btn-circle dark btn-sm black"  title='查看以往'><i class='fa fa-clock-o'></i>查看以往
                                                    </a>
                                                </td>
                                            </tr>
                                            <?php  } } ?>                                                                                                                             
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        新增
                                    </div>
                                    <div class="panel-body form">
                                             <div class="form-body">
                                        <div class="form-group form-md-line-input ">
                                            <label class=" col-md-2 control-label"><span style='color:red'>*</span>内容</label>
                                            <div class="col-sm-10">
                                                <?php  echo tpl_ueditor('content',$result['content']);?>	
                                            </div>
                                        </div>	
                                        <div class="form-group form-md-line-input ">
                                            <label class=" col-md-2 control-label"><span style='color:red'>*</span>图片组</label>
                                            <div class="col-sm-10">
                                            <?php  echo tpl_form_field_multi_image('img', $images);?>
                                            </div>
                                        </div>               
                                         <div class="form-group form-md-radios form-md-line-input ">
                                            <label class="col-md-2 control-label"  >选择课程</label>
	                                        <div class="md-radio-inline">
                                              <?php  if(is_array($course_list)) { foreach($course_list as $row) { ?>
                                                <div class="md-radio">
                                                    <input type="radio" id="radion<?php  echo $row['course_id'];?>" class="md-radiobtn" name="course_id"   value='<?php  echo $row['course_id'];?>'  />
                                                    <label for="radion<?php  echo $row['course_id'];?>">
                                                        <span></span>
                                                        <span class="check"></span>
                                                        <span class="box"></span><?php  echo $row['course_name'];?></label>
                                                </div>
                                              <?php  } } ?>  
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                        <div class="form-actions">
                                            <div class="row">
                                                <div class="col-md-offset-2 col-md-10">
                                                    <input type='hidden' name='ac' value='new'>
                                                    <input type="submit" name="submit" class="btn blue" value="确认"></button>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                </div>		
                            </div>                            
                        </form>
                    </div>
                <?php  } ?>
    	<?php  if($ac=='old') { ?>
             <div class="row">
                 <div class="col-md-12">
                       <div class="note note-success">
                           <p> 作业记录 </p>
                       </div>
                <div class="portlet box green">
                    <div class="portlet-title">
                      <div class="caption">
                          <i class="fa fa-cogs"></i><?php  echo $class['class_name'];?>*作业记录 </div>
                         <div class="tools">
                               <a href="javascript:;" class="collapse"> </a>
                          </div>
                       </div>
                       <div class="portlet-body flip-scroll">
                       <table class="table table-bordered table-striped table-condensed flip-content">
                           <thead class="flip-content">
                                <tr>
                                    <th>班级</th>
                                    <th>发布老师</th>
                                    <th>科目</th>
                                    <th>时间</th>
                                    <th>状态</th>
                                    <th>操作</th>
                                </tr>                
                            </thead>
                            <tbody>
                        <?php  if(is_array($list)) { foreach($list as $item) { ?>
                        <tr>
                            <td><?php  echo $class['class_name'];?></td>
                            <td><?php  echo $t_name;?></td>
                            <td><?php  echo $this->courseName($item['course_id']);?></td>
                            <td><?php  echo date("Y-m-d H:i:s",$item['add_time']);?></td>
                            <td><?php  if($item['status'] ==1) { ?>正常<?php  } else { ?>关闭<?php  } ?></td>
                            <td>
                                <a href="<?php  echo $this->createWebUrl('homework',array('ac'=>'edit','hid'=>$item['homework_id'],'aw'=>1))?>"
                                    class="btn btn-default btn-sm" 
                                    ><i class='fa fa-edit'></i>编辑</a>
                            </td>
                        </tr>
                        <?php  } } ?>
			            </tbody>
		            </table>
		        <?php  echo $pager;?>
	            </div>
	            </div>
	            </div>
	            </div>
	    <?php  } ?>
        <?php  if($ac=='new' || $ac=='edit') { ?>
            <form action="" method="post" class="form-horizontal form" enctype="multipart/form-data" id="form1">
                <input type="hidden" name="cid"   value='<?php  echo $class['class_id'];?>' />
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <?php  if($ac=='new') { ?>新增<?php  } else { ?>修改<?php  } ?>
                    </div>
                    <div class="panel-body">
                        <div class="tab-content">
                        <div class="form-group">
                            <label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span>内容</label>
                            <div class="col-sm-9 col-xs-8">
                                <?php  echo tpl_ueditor('content',$result['content']);?>	
                            </div>
                        </div>	
                        <div class="form-group">
                            <label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span>图片组</label>
                            <div class="col-sm-9 col-xs-8">
                            <?php  echo tpl_form_field_multi_image('img', $images);?>
                            </div>
                        </div>               

                        <div class="form-group form-md-radios form-md-line-input ">
	                        <label class="col-md-2 control-label"  >选择课程</label>
	                                <div class="md-radio-inline">
	                                    <?php  if(is_array($course_list)) { foreach($course_list as $row) { ?>
                                                <div class="md-radio">
                                                    <input type="radio" id="radion<?php  echo $row['course_id'];?>" class="md-radiobtn" name="course_id"  <?php  if($row['course_id']==$result['course_id']) { ?> checked  <?php  } ?> value='<?php  echo $row['course_id'];?>'  />
                                                    <label for="radion<?php  echo $row['course_id'];?>">
                                                        <span></span>
                                                        <span class="check"></span>
                                                        <span class="box"></span><?php  echo $row['course_name'];?></label>
                                                </div>
                                              <?php  } } ?>  
	                                </div>
                        </div>                       
                        <?php  if($ac=='edit') { ?>
                            <div class='form-group'>
                            <label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span>状态</label>
                            <div class="col-sm-9 col-xs-8">
                            <select name='status' class="form-control">
                                    <option value='1' <?php  if($result['status']==1) { ?> selected <?php  } ?>>正常</option>
                                    <option value='0' <?php  if($result['status']==0) { ?> selected <?php  } ?>>关闭</option>
                            </select>
                            </div>							
                            </div>
                        <?php  } ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
                    <div class="col-sm-9 col-xs-8">
                        <input type="submit" name="submit" value="提交" class="btn btn-primary col-lg-1" />
                    </div>
                    </div>
                </div>		
            </form>		
         <?php  } ?>   
        </div>
        </div>
         <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/right', TEMPLATE_INCLUDEPATH)) : (include template('../admin/right', TEMPLATE_INCLUDEPATH));?>
        </div>
     <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/footer', TEMPLATE_INCLUDEPATH)) : (include template('../admin/footer', TEMPLATE_INCLUDEPATH));?>
         </body>
    </html>