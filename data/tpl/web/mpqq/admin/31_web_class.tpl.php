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
                                        <i class="icon-settings font-green-haze"></i>
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
                                            <div class='form-group form-md-line-input '>
                                                <label class="col-md-2 control-label"><span style='color:red'>*</span>其绑定的课程</label>
                                                <div class="col-md-10">
                                                    <?php  if($ac=='edit') { ?>
                                                    <?php  $result['course_arr']=unserialize($result['course_ids']);?>
                                                    <?php  } else { ?>
                                                    <?php  $result['course_arr']=$course_ids;?>
                                                    <?php  } ?>
                                                    <?php  if(is_array($course_list)) { foreach($course_list as $row) { ?>
                                                    <?php  $i++;?>
                                                    <input type='checkbox' value='<?php  echo $row['course_id'];?>' name='course_s[<?php  echo $i;?>]' <?php  if(@in_array($row['course_id'],$result['course_arr'])) echo 'checked' ;?>>&nbsp;<?php  echo $row['course_name'];?>
                                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                                    <?php  } } ?>
                                                </div>	

                                            </div>	    
                                            <div class='form-group form-md-line-input '>
                                                <label class="col-md-2 control-label"><span style='color:red'>*</span>其可以查看的监控视频</label>
                                                <div class="col-sm-10">
                                                    <?php  if($ac=='edit') { ?>
                                                    <?php  $result['video_arr']=unserialize($result['video_ids']);?>
                                                    <?php  } ?>
                                                    <?php  if(is_array($video_list)) { foreach($video_list as $row) { ?>
                                                    <?php  $i++;?>
                                                    <input type='checkbox' value='<?php  echo $row['video_id'];?>' name='video_s[<?php  echo $i;?>]' <?php  if(@in_array($row['video_id'],$result['video_arr'])) echo 'checked' ;?>>&nbsp;<?php  echo $row['video_name'];?>
                                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                                    <?php  } } ?>
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
                                                <div class="form-group">
                                                    <label class="col-md-2 control-label"><span class="required" aria-required="true"> * </span>班级圈页首图【980*400】</label>
                                                    <div class="col-sm-10">
                                                        <?php  echo tpl_form_field_image('line_img',$result['line_img']);?>
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
                <?php  if($ac=='list') { ?>
                          <div class="portlet light bordered">
                                            <div class="portlet-title">
                                                <div class="caption">
                                                    <i class="icon-equalizer font-red-sunglo"></i>
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
                                                <td>  <?php  echo $item['teacher_realname'];?>  </td>
                                                <td>  <?php  echo $this->classStudentNum($item['class_id']);?> </td>
                                                <?php  $class_student->_set('class_id',$item['class_id']);?>
                                                <?php  $info = $class_student->getGradeClassStudent();?>
                                                <td> <?php  echo $info['bangding_count'];?></td>
                                                <td> <a href="<?php  echo $this->createWebUrl('class',array('grade_id'=>$item['grade_id'],'aw'=>1 ))?>"><?php  echo $item['grade_name'];?></a> </td>
                                                <td>	<?php  if($item['status'] ==1) { ?>正常<?php  } else { ?><span class='red'>关闭</span><?php  } ?></td>
                                                <td><a  href="<?php  echo $this->createWebUrl('class', array('ac' => 'edit','id'=>$item['class_id'],'aw'=>1))?>" class="btn btn-outline btn-circle btn-sm purple">
                                                            <i class="fa fa-edit"></i> 编辑 </a>
                                                <a href="<?php  echo $this->createWebUrl('class', array('ac' => 'delete','id'=>$item['class_id'] ,'aw'=>1 ))?>" 
                                                    onclick="return confirm('此操作不可恢复，确认删除？');"
                                                    class="btn btn-outline btn-circle dark btn-sm black" title="删除"><i class="fa fa-trash-o"></i>
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
         </body>
    </html>