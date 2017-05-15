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
                <?php  if($ac=='new' || $ac=='edit') { ?>
                        <div class="row">
                            <div class="col-md-12">
                                <!-- BEGIN SAMPLE FORM PORTLET-->
                                <div class="portlet light ">
                                    <div class="portlet-title">
                                        <div class="caption font-green-haze">
                                            <i class="icon-settings font-green-haze"></i>
                                            <span class="caption-subject bold uppercase"> <?php  if($ac=='new') { ?>新增<?php  } else { ?>修改<?php  } ?></span>
                                        </div>
                                        <div class="actions">
                                            <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;" data-original-title="" title=""> </a>
                                        </div>
                                    </div>
                                    <div class="portlet-body form">
                                        <form action="" method="post" class="form-horizontal form" enctype="multipart/form-data" id="form1"  >
                                            <div class="form-body">
                                                <div class="form-group form-md-line-input">
                                                    <label class="col-md-2 control-label"><span class="required" aria-required="true"> * </span>标题</label>
                                                    <div class="col-md-10">
                                                        <input type="text" class="form-control"  placeholder="标题" value="<?php  echo $result['line_title'];?>" name='line_title' required >
                                                        <div class="form-control-focus"> </div>
                                                    </div>
                                                </div>
                                                <div class="form-group form-md-line-input">
                                                    <label class="col-md-2 control-label" ><span class="required" aria-required="true"> * </span>类型</label>
                                                    <div class="col-md-10">
                                                        <select class="form-control" name='line_type' >
                                                        <?php  if(is_array($line_type_cfg)) { foreach($line_type_cfg as $key => $row) { ?>
                                                        	<option value='<?php  echo $key;?>' <?php  if($result['line_type']== $key) { ?> selected <?php  } ?>><?php  echo $row;?></option>
                                                        <?php  } } ?>
                                                    </select>
                                                        <div class="form-control-focus"> </div>
                                                    </div>
                                                </div>                                          
                                                <div class="form-group form-md-line-input">
                                                    <label class="col-md-2 control-label" for="form_control_1">消息内容）</label>
                                                    <div class="col-md-10">
                                                       <?php  echo tpl_ueditor('line_content',$result['line_content']);?>	
                                                        <div class="form-control-focus"> </div>
                                                    </div>
                                                </div>
                                                <?php  if($ac=='edit') { ?>
                                                    <div class='form-group form-md-line-input'>
                                                    <label class=" col-md-2 control-label"><span style='color:red'>*</span>状态</label>
                                                    <div class="col-sm-10">
                                                        <select name='status' class='form-control' >
                                                                <option value='1' <?php  if($result['status']==1) { ?> selected <?php  } ?>>正常</option>
                                                                <option value='0' <?php  if($result['status']==0) { ?> selected <?php  } ?>>关闭</option>
                                                        </select>
                                                    </div>							
                                                    </div>
                                                <?php  } ?>                        
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
                <?php  } ?>
                <?php  if($ac=='old' || $ac=='wait_to_pass') { ?>
                     <div class="row">
                         <div class="col-md-12">
                            <!-- BEGIN SAMPLE TABLE PORTLET-->
                            <div class="portlet box green">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-cogs"></i>记录 </div>
                                    <div class="tools">
                                        <a href="javascript:;" class="collapse"> </a>
                                    </div>
                                </div>
                                <div class="portlet-body flip-scroll">
                                    <table class="table table-bordered table-striped table-condensed flip-content">
                                        <thead class="flip-content">
                                              <tr>
                                                <th>班级</th>
                                                <th>标题</th>
                                                <th>发布老师</th>
                                                <th>类型</th>
                                                <th  class="numeric">查看数</th>
                                                <th>状态</th>
                                                <th  class="numeric"></th>
                                                <th>操作</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php  if(is_array($list)) { foreach($list as $item) { ?>
                                            <tr id="line_<?php  echo $item['line_id'];?>">
                                                <?php  $grade_id = D('classes')->getClassGradeId($item['class_id']);?>
                                                <td> <?php  echo $this->gradeName($grade_id) ?>&nbsp;➡&nbsp;<?php  echo $item['class_name'];?></td>
                                                <td><?php  echo $item['line_title'];?></td>
                                                <td><?php  if($item['teacher_realname']) { ?><?php  echo $item['teacher_realname'];?><?php  } else { ?>管理员<?php  } ?></td>
                                                <td><?php  echo $line_type_cfg[$item['line_type']];?></td>
                                                <td><?php  echo $item['line_look'];?></td>
                                                <td id="line_status_<?php  echo $item['line_id'];?>"><?php  if($item['status'] ==1) { ?>正常<?php  } else if($item['status']  == 2) { ?>审核中  <?php  } else { ?>关闭<?php  } ?></td>
                                                <td><?php  echo date("Y-m-d H:i:s",$item['addtime']);?></td>
                                                <td>
                                                <a href="<?php  echo $this->createWebUrl('line',array('ac'=>'edit','lid'=>$item['line_id'],'aw'=>1))?>"
                                                        class="btn btn-default btn-sm" data-toggle="tooltip" data-placement="top"  title=''
                                                        ><i class='fa fa-edit'></i>编辑</a>
                                                <?php  if($teacher !='teacher' && $item['status'] == 2 ) { ?>
                                                    <span class='btn red  btn-default btn-sm  queue_num '  data-queue="<?php  echo $item['queue_num'];?>" onclick="passThis('<?php  echo $item['line_id'];?>','line')"><i class='fa fa-check'></i>审核通过</span>
                                                <?php  } ?>
                                                <span class='btn btn-default btn-sm red '      onclick="deleteThis('<?php  echo $item['line_id'];?>','line')"  ><i class='fa fa-minus-square'></i>删除</span>
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
                <?php  if($ac=='list') { ?>
                 <div class="row">
                        <div class="col-md-12">
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
                                                <th width="20%"  > 班级</th>
                                                <th> 	班主任 </th>
                                                <th class="numeric"> 学生数 </th>
                                                <th > 年级 </th>
                                                <th > 状态 </th>
                                                <th class="numeric">  </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                         <?php  if(is_array($list)) { foreach($list as $item) { ?>
                                            <tr>
                                                <td>  <?php  echo $this->gradeName($item['grade_id']) ?>&nbsp;➡&nbsp;<?php  echo $item['class_name'];?> </td>
                                                <td>  <?php  echo $this->teacherName($item['teacher_id'])?>  </td>
                                                <td class="numeric"><?php  echo $this->classStudentNum($item['class_id']);?> </td>
                                                <td> <?php  echo $this->gradeName($item['grade_id']) ?></td>
                                                <td>	<?php  if($item['status'] ==1) { ?>正常<?php  } else { ?><span class='red'>关闭</span><?php  } ?></td>
                                                <td><a  href="<?php  echo $this->createWebUrl('line', array('ac' => 'new','cid'=>$item['class_id'],'aw'=>1))?>" class="btn btn-outline btn-circle btn-sm purple">
                                                            <i class="fa fa-plus-square"></i> 发布 </a>
                                                <a href="<?php  echo $this->createWebUrl('line', array('ac' => 'old','cid'=>$item['class_id'] ,'aw'=>1 ))?>" 
                                                    class="btn btn-outline btn-circle dark btn-sm black" title="查看"><i class="fa fa-eye"></i>
                                                    查看
                                                </a>               
                                                </td>                          
                                            </tr>
                                        <?php  } } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
                <?php  } ?>
        </div>
        </div>
         <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/right', TEMPLATE_INCLUDEPATH)) : (include template('../admin/right', TEMPLATE_INCLUDEPATH));?>
        </div>
     <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/footer', TEMPLATE_INCLUDEPATH)) : (include template('../admin/footer', TEMPLATE_INCLUDEPATH));?>
         </body>
    </html>