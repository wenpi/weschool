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
                <?php  if($ac =='edit'|| $ac=='new' ) { ?>
                     <div class="row">
                        <div class="col-md-12">
                             <div class="portlet light ">
                                <div class="portlet-title">
                                    <div class="caption font-green-haze">
                                        <i class="fa fa-edit font-green-haze"></i>
                                        <span class="caption-subject bold uppercase"> <?php  if($ac=='new') { ?>新增班级<?php  } else { ?>修改<?php  } ?> </span>
                                    </div>
                                    <div class="actions">
                                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;" data-original-title="" title=""> </a>
                                    </div>
                                </div>
                                  <div class="portlet-body form">
                                    <form action="" method="post" class="form-horizontal form" enctype="multipart/form-data" id="form1"  >
                                              <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label"><span class="required" aria-required="true"> * </span>班级名</label>
                                                    <div class="col-md-10">
                                                        <input type="text" class="form-control"  placeholder="班级名" value="<?php  echo $result['class_name'];?>" name='class_name' required >
                                                        <?php  if($ac=='edit') { ?>
                                                            <input type="hidden" name="id"  class="form-control" value='<?php  echo $result['class_id'];?>' />
                                                        <?php  } ?>
                                                        <div class="form-control-focus"> </div>
                                                    </div>
                                            </div>
                                               <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label"><span style='color:red'>*</span> 班级公告分类</label>
                                                    <div class="col-md-10">
                                                        <input type="text" class="form-control"  placeholder="班级公告||班级食谱||班级相册" value="<?php  echo $result['msg_class'];?>" name='msg_class' required  >
                                                        <div class="form-control-focus"> </div>
                                                        <span class="help-block">默认使用学校统一设置班级公告分类，每个不同的类别以||分开【最佳三个分类】</span>
                                                    </div>
                                            </div>       
                                             <div class="form-group form-md-line-input"  id='mutex_content'>
                                                    <label class=" col-md-2 control-label"><span style='color:red'>*</span>课程</label>
                                                    <div class="col-sm-10">
                                                        <?php  if($ac=='edit') { ?>
                                                            <?php  $result['course_arr'] = unserialize($result['course_ids']);?>
                                                        <?php  } ?>
                                                             <select name="course_s[]" id='pre-selected-options'  multiple="multiple" class="multi-select"  >
                                                                <?php  if(is_array($course_list)) { foreach($course_list as $vo) { ?>
                                                                       <?php  if(!in_array($vo['course_id'],$result['course_arr'])) { ?>
                                                                           <option value='<?php  echo $vo['course_id'];?>'> <?php  echo $vo['course_name'];?></option>
                                                                       <?php  } else { ?>
                                                                           <option value='<?php  echo $vo['course_id'];?>' selected> <?php  echo $vo['course_name'];?></option>
                                                                       <?php  } ?>
                                                                <?php  } } ?>
                                                          </select>
                                                    </div>
                                            </div>

                                     	    
                                            <div class='form-group form-md-line-input '>
                                                <label class="col-md-2 control-label"><span style='color:red'>*</span>监控视频</label>
                                                <div class="col-sm-10">
                                                    <?php  if($ac=='edit') { ?>
                                                        <?php  $result['video_arr']=unserialize($result['video_ids']);?>
                                                    <?php  } ?>
                                                    <select name="video_s[]" id='pre-selected-options-2'  multiple="multiple" class="multi-select"  >
                                                                <?php  if(is_array($video_list)) { foreach($video_list as $vo) { ?>
                                                                       <?php  if(!in_array($vo['video_id'],$result['video_arr'])) { ?>
                                                                           <option value='<?php  echo $vo['video_id'];?>'> <?php  echo $vo['video_name'];?></option>
                                                                       <?php  } else { ?>
                                                                           <option value='<?php  echo $vo['video_id'];?>' selected> <?php  echo $vo['video_name'];?></option>
                                                                       <?php  } ?>
                                                                <?php  } } ?>
                                                   </select>
                                                </div>	
                                            </div>        

                                            <div class='form-group form-md-line-input '>
                                                <label class="col-md-2 control-label"><span style='color:red'>*</span>选择年级</label>
                                                <div class="col-sm-10">
                                                <select name='grade_id' class="form-control">
                                                    <?php  if(is_array($grade_list)) { foreach($grade_list as $row) { ?>
                                                        <option value='<?php  echo $row['grade_id'];?>' <?php  if($row['grade_id'] ==$result['grade_id']) { ?> selected <?php  } ?>><?php  echo $row['grade_name'];?></option>
                                                    <?php  } } ?>
                                                </select>
                                                </div>	
                                            </div>
                                            <?php  if(Au('src/codeShop')->getCode('xuznfenqu1')  ) { ?>
                                                <?php  $num = Au("fenqu/action")->checkNoUseChannel();?>
                                                    <div class='form-group form-md-line-input '>
                                                        <label class="col-md-2 control-label">选择频道</label>
                                                        <div class="col-sm-10">
                                                        <select name='channel_id' class="form-control">
                                                            <?php  if($result['channel_id'] ) { ?>
                                                                <option value='<?php  echo $result['channel_id'];?>' selected><?php  echo $result['channel_id'];?></option>
                                                            <?php  } ?>
                                                            
                                                            <?php  if(is_array($num)) { foreach($num as $row) { ?>
                                                                <option value='<?php  echo $row;?>' ><?php  echo $row;?></option>
                                                            <?php  } } ?>
                                                        </select>
                                                        </div>	
                                                    </div>             
                                                    <div class="form-group form-md-line-input">
                                                        <label class="col-md-2 control-label">播报内容</label>
                                                            <div class="col-md-10">
                                                                <input type="text" class="form-control"  value="<?php  echo $result['channel_content'];?>" name='channel_content'  >
                                                                <div class="form-control-focus"> </div>
                                                            </div>
                                                    </div>
                                                    <div class="form-group form-md-line-input">
                                                        <label class="col-md-2 control-label">播报备注</label>
                                                            <div class="col-md-10">
                                                                <input type="text" class="form-control" value="<?php  echo $result['channel_intro'];?>" name='channel_intro'  >
                                                                <div class="form-control-focus"> </div>
                                                            </div>
                                                    </div>                                                                                                                                
                                            <?php  } ?>

                                            <?php  if($ac=='edit') { ?>
                                                <div class='form-group form-md-line-input '>
                                                <label class=" col-md-2 control-label"><span style='color:red'>*</span>班主任</label>
                                                <div class="col-sm-10">
                                                <select name='teacher_id' class="form-control" >
                                                    <?php  if(is_array($list_teacher)) { foreach($list_teacher as $row) { ?>
                                                        <option value='<?php  echo $row['teacher_id'];?>' <?php  if($row['teacher_id']==$result['teacher_id']) { ?> selected <?php  } ?>><?php  echo $row['teacher_realname'];?></option>
                                                    <?php  } } ?>
                                                </select>
                                                </div>							
                                                </div>
                                                <div class="form-group form-md-line-input">
                                                    <label class="col-md-2 control-label" for="form_control_1">班级圈页首图【980*400】</label>
                                                    <div class="col-md-10">
                                                        <?php  echo upImg('line_img',$result['line_img'] ,$this);?>
                                                    </div>
                                                </div>                                 
                                                <div class='form-group form-md-line-input ' >
                                                <label class=" col-md-2 control-label"><span style='color:red'>*</span>状态</label>
                                                <div class="col-sm-10 ">
                                                <select name='status' class="form-control" >
                                                        <option value='1' <?php  if(1 ==$result['status']) { ?> selected <?php  } ?>>正常</option>
                                                        <option value='3' <?php  if(3 ==$result['status']) { ?> selected <?php  } ?>>关闭</option>
                                                </select>
                                                </div>							
                                                </div>
                                            <?php  } ?>

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
                <?php  } ?>
                <?php  if($ac=='list') { ?>
                          <div class="portlet light bordered">
                                            <div class="portlet-title">
                                                <div class="caption">
                                                    <i class="fa fa-paper-plane font-red-sunglo"></i>
                                                    <span class="caption-subject font-red-sunglo bold uppercase">搜索</span>
                                                    <span class="caption-helper">给出条件，筛选班级</span>
                                                </div>
                                            </div>
                                            <div class="portlet-body form">
                                                <!-- BEGIN FORM-->
                                                <form action="./index.php" method="get" class="form-horizontal">
                                                    	<input type="hidden" name="c" value="site" />
                                                        <input type="hidden" name="a" value="entry" />
                                                        <input type="hidden" name="m" value="lianhu_school" />
                                                        <input type="hidden" name="do" value="class" />
                                                        <input type="hidden" name="ac" value="list" />
                                                        <input type="hidden" name="aw" value="1" />
                                                        <div class="form-group ">
                                                          <label class="control-label col-md-3">年级</label>
                                                             <div class="col-md-4">
                                                                        <select name="grade_id" class="form-control">
                                                                            <option value='0'>全部</option>
                                                                            <?php  if(is_array($grade_list)) { foreach($grade_list as $row) { ?>
                                                                                <option value='<?php  echo $row['grade_id'];?>' <?php  if($_GPC['grade_id'] ==$row['grade_id']) { ?> selected <?php  } ?>><?php  echo $row['grade_name'];?></option>
                                                                            <?php  } } ?>
                                                                         </select>
                                                             </div>
                                                        </div>
                                                         <div class="form-group last">
                                                          <label class="control-label col-md-3">状态</label>
                                                             <div class="col-md-4">
                                                                        <select name="status" class="form-control">
                                                                            <option value='0'>全部</option>
                                                                            <option value="1" <?php  if($_GPC['status'] == '1') { ?> selected<?php  } ?>>正常</option>
                                                                            <option value="3" <?php  if($_GPC['status'] == '3') { ?> selected<?php  } ?>>关闭</option>
                                                                        </select>
                                                             </div>
                                                        </div>                                                       
                                                    <div class="form-actions">
                                                            <div class="row">
                                                                <div class="col-md-offset-2 col-md-10">
                                                                    <input type="submit" name="submit" class="btn blue" value="确认搜索"></button>
                                                                </div>
                                                            </div>
                                                    </div>   
                                                </form>
                                              </div>
                             </div>
                 <div class="row">
                        <div class="col-md-12">
                            <div class="portlet box green-turquoise">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-cogs"></i>班级列表 </div>
                                    <div class="tools">
                                        <a href="javascript:;" class="collapse"> </a>
                                    </div>
                                </div>
                                <div class="portlet-body flip-scroll">
                                    <table class="table table-bordered table-striped table-condensed flip-content table-light"  id="sample_3">
                                        <thead class="flip-content">
                                            <tr>
                                                <th> 班级</th>
                                                <th> 班主任 </th>
                                                <th> 学生数 </th>
                                                <th> 有绑定的学生数（主） </th>
                                                <th> 年级 </th>
                                                <th> 状态 </th>
                                                <th>  </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                         <?php  $class_student= D('student');?>
                                         <?php  if(is_array($list)) { foreach($list as $item) { ?>
                                            <tr>
                                                <td>  <?php  echo $item['grade_name'];?>&nbsp;  <i class="fa fa-toggle-right"></i>&nbsp;<?php  echo $item['class_name'];?> </td>
                                                <td>  <span class="label label-sm label-info"><?php  echo $item['teacher_realname'];?></span>  </td>
                                                <td>  <?php  echo $this->classStudentNum($item['class_id']);?> </td>
                                                <?php  $class_student->_set('class_id',$item['class_id']);?>
                                                <?php  $info = $class_student->getGradeClassStudent();?>
                                                <td> <?php  echo $info['bangding_count'];?></td>
                                                <td> <a  class="label label-sm label-success" href="<?php  echo $this->createWebUrl('class',array('grade_id'=>$item['grade_id'],'aw'=>1 ))?>"><?php  echo $item['grade_name'];?></a> </td>
                                                <td> <span class='label label-sm label-warning'>	<?php  if($item['status'] ==1) { ?>正常<?php  } else { ?>关闭<?php  } ?> </span></td>
                                                <td>
                                                        <a  href="<?php  echo $this->createWebUrl('class', array('ac' => 'edit','id'=>$item['class_id'],'aw'=>1))?>" class="btn blue">
                                                                    <i class="fa fa-edit"></i> 编辑 </a>
                                                        <a href="<?php  echo $this->createWebUrl('class', array('ac' => 'delete','id'=>$item['class_id'] ,'aw'=>1 ))?>" 
                                                            onclick="return confirm('此操作不可恢复，确认删除？');"
                                                            class="btn red" title="删除"><i class="fa fa-trash-o"></i>
                                                            删除
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
        <?php  if($ac=='list') { ?>
            <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/table_script', TEMPLATE_INCLUDEPATH)) : (include template('../admin/table_script', TEMPLATE_INCLUDEPATH));?>         
        <?php  } else { ?>
            <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/mutilSelect', TEMPLATE_INCLUDEPATH)) : (include template('../admin/mutilSelect', TEMPLATE_INCLUDEPATH));?>
        <?php  } ?>
        </body>
    </html>