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
                <div class='row'>
                     <div class="col-md-12">
                         <?php  if($ac=='list') { ?>
                         <?php  if($model !='someone') { ?>
                            <?php  if($model =='grade') { ?>
                                <?php  $page = '年级列表';?>
                                <?php  $intro ='请选择学生所在的年级'; ?>
                                <?php  $color ='green';?>
                            <?php  } else if($model =='class') { ?>
                                <?php  $page = '学生列表';?>
                                <?php  $intro ='请选择学生所在的班级'; ?>
                                <?php  $color ='yellow-casablanca';?>
                            <?php  } else if($model =='student') { ?>
                                <?php  $page = '学生列表';?>
                                <?php  $intro ='请选择具体的学生'; ?>
                                <?php  $color ='blue';?>
                            <?php  } ?>
                                <div class="note note-info">
                                    <h4 class="block"><?php  echo $page;?></h4>
                                    <p><?php  echo $intro;?></p>
                                </div> 
                              <div class="row">
                                <?php  if(is_array($result)) { foreach($result as $item) { ?>
                                <div class="col-md-2 col-sm-2 col-xs-6">
                                    <div class="color-demo tooltips" >
                                        <a href="<?php  echo $this->result_result($item,$model,'url','list');?>&aw=1">
                                            <div class="color-view bg-<?php  echo $color;?> bg-font-<?php  echo $color;?> bold uppercase"><?php  echo $this->result_result($item,$model,'name','list');?> </div>
                                            <div class="color-info bg-white c-font-14 sbold"> 点击选择 </div>
                                        </a>
                                    </div>
                                </div>
                                <?php  } } ?>                       
                             </div>                       
                         <?php  } ?>
                        <?php  if($model=='someone') { ?>
                                <div class="note note-info">
                                    <h4 class="block"><?php  echo $result['student_name'];?></h4>
                                    <p>添加新的记录</p>
                                </div>                   
                                 <div class="portlet light ">          
                                 <div class="portlet-body form ">
                                    <form action="" method="post" class="form-horizontal form" enctype="multipart/form-data" id="form1"  >
                                        <input type="hidden" name="sid"  class="form-control" value='<?php  echo $_GPC['sid'];?>' />
                                        <div class="form-body">
                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label"><span class="required" aria-required="true"> * </span>记录名</label>
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control" name='word' required autofocus >
                                                    <div class="form-control-focus"> </div>
                                                </div>
                                            </div>
                                              <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label" ><span class="required" aria-required="true"> * </span>记录分类</label>
                                                <div class="col-md-10">
                                                    <select class="form-control" name='jilv_class' >
                                                    <?php  if(is_array($class_list)) { foreach($class_list as $row) { ?>
                                                    		<option value='<?php  echo $row['class_id'];?>'  <?php  if($row['class_id'] == $result['jilv_class']) { ?>selected  <?php  } ?> ><?php  echo $row['class_name'];?></option>
                                                    <?php  } } ?>
                                                   </select>
                                                    <div class="form-control-focus"> </div>
                                                </div>
                                            </div>                                          
                
                                        <div class="form-group  form-md-line-input has-success">
                                                <label class= "col-md-2 control-label">内容</label>
                                                <div class="col-md-10">
                                                    <textarea name='content' class='form-control'></textarea>
                                                    <div class="form-control-focus"> </div>
                                                </div>
                                          </div>
                                        <div class="form-group">
                                            <label class="col-md-2 control-label"> 照片</label>
                                            <div class="col-sm-10">
                                                <?php  echo tpl_form_field_image('img',$result['img']);?>
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
                                <div class="row">
                                    <div class="col-md-12">
                                        <!-- BEGIN SAMPLE TABLE PORTLET-->
                                        <div class="portlet box green">
                                            <div class="portlet-title">
                                                <div class="caption">
                                                    <i class="fa fa-cogs"></i>记录列表</div>
                                                <div class="tools">
                                                    <a href="javascript:;" class="collapse"> </a>
                                                </div>
                                            </div>
                                            <div class="portlet-body flip-scroll">
                                                <table class="table table-bordered table-striped table-condensed flip-content">
                                                    <thead class="flip-content">
                                                        <tr>
                        
                                                            <th class="numeric">记录ID</th>
                                                            <th>记录名</th>
                                                            <th>记录类型</th>
                                                            <th>学生</th>
                                                            <th>教师</th>
                                                            <th>图片</th>
                                                            <th>内容</th>
                                                            <th>添加时间</th>                                                           
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php  if(is_array($list)) { foreach($list as $item) { ?>
                                                        <?php $teacher=$item['teacher_realname'] ? $item['teacher_realname'] :'管理员无法绑定教师';?>
                                                        <tr>
                                                            <td><?php  echo $item['work_id'];?></td>
                                                            <td><?php  echo $item['word'];?></td>
                                                            <td><?php  echo $item['class_name'];?></td>
                                                            <td><?php  echo $result['student_name'];?></td>
                                                            <td><?php  echo $teacher;?></td>
                                                            <td><img src="<?php  echo $this->imgFrom($item['img'])?>" style="width:80px;"></td>
                                                            <td><?php  echo $item['content'];?></td>
                                                            <td><?php  echo date("Y-m-d H:i:s",$item['addtime']);?></td>
                                                        </tr>
                                                        <?php  } } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>                             
                                </div>                          
                        <?php  } ?>
                        <?php  } else if($ac=='class' ) { ?>
                            <?php  if($op=='list') { ?>
                             <?php  $page = '分类列表';?>  
                            <?php  } else if($op=='edit' || $op=='new' ) { ?>
                             <?php  $page = '操作';?>  
                            <?php  } ?>
                                <div class="note note-info">
                                    <h4 class="block">记录分类</h4>
                                    <p><?php  echo $page;?></p>
                                </div>
                                    <?php  if($op=='list') { ?>
                                        <div class="panel panel-default">
                                            <div class="panel-body table-responsive">
                                                <table class="table table-hover">
                                                    <thead class="navbar-inner">
                                                        <tr>
                                                            <th>ID</th>
                                                            <th>记录名</th>
                                                            <th>状态</th>
                                                            <th>添加时间</th>
                                                            <th>编辑</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php  if(is_array($list)) { foreach($list as $item) { ?>
                                                        <tr>
                                                            <td><?php  echo $item['class_id'];?></td>
                                                            <td><?php  echo $item['class_name'];?></td>
                                                            <td><?php  if($item['class_status'] ==1 ) { ?>正常<?php  } else { ?>注销<?php  } ?></td>
                                                            <td><?php  echo date("Y-m-d H:i:s",$item['add_time']);?></td>
                                                            <td><a   class="btn btn-outline btn-circle dark btn-sm black"  href='<?php  echo $this->createWebUrl('student_record',array('ac'=>'class','class_id'=>$item['class_id'],'op'=>'edit','aw'=>1));?>'> <i class="fa fa-edit"></i>  编辑 </a></td>
                                                        </tr>
                                                        <?php  } } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                            </div>			
                                    <?php  } ?>
                                    <?php  if($op=='edit' || $op=='new' ) { ?>
                                        <div class="panel-body ">
                                        <form action="" method="post" class="form-horizontal form" enctype="multipart/form-data" id="form1">
                                            <div class="panel panel-default">
                                                <div class="panel-body">
                                                    <div class="tab-content">
                                                    <div class="form-group">
                                                        <label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span>名称</label>
                                                        <div class="col-sm-9 col-xs-8">
                                                            <input type="text" name="class_name" id="class_name" class="form-control" value='<?php  echo $result['class_name'];?>' />
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-xs-12 col-sm-3 col-md-2 control-label">状态</label>
                                                        <div class="col-sm-9 col-xs-8">
                                                            <input type='radio'  value='0' name='class_status'<?php  if($result['class_status']==0) { ?> checked<?php  } ?>  > &nbsp;&nbsp;注销 &nbsp;&nbsp; &nbsp;&nbsp;
                                                            <input type='radio' value='1' name='class_status' <?php  if($result['class_status']==1) { ?> checked<?php  } ?>  > &nbsp;&nbsp;正常								
                                                        </div>
                                                    </div>	
                                                    </div>
                                                </div>
                                            </div>		
                                            <div class="form-group col-sm-12">
                                                <input type="submit" name="submit" value="提交" class="btn btn-primary col-lg-1" />
                                            </div>
                                        </form>	
                                    </div>
                            <?php  } ?>
                        <?php  } ?>
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