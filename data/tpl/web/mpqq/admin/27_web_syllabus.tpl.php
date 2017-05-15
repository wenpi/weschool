<?php defined('IN_IA') or exit('Access Denied');?>    <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/head', TEMPLATE_INCLUDEPATH)) : (include template('../admin/head', TEMPLATE_INCLUDEPATH));?>
        <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/header', TEMPLATE_INCLUDEPATH)) : (include template('../admin/header', TEMPLATE_INCLUDEPATH));?>
        <div class="page-container">
        <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/left', TEMPLATE_INCLUDEPATH)) : (include template('../admin/left', TEMPLATE_INCLUDEPATH));?>
            <div class="page-content-wrapper">
                <div class="page-content">
                <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/sidebar', TEMPLATE_INCLUDEPATH)) : (include template('../admin/sidebar', TEMPLATE_INCLUDEPATH));?>
                    <h1 class="page-title"> <?php  echo $_SESSION['school_name'];?>
                            <small> <?php  echo $title;?> </small>
                    </h1>
                  <div class="row">
                    <?php  if($ac=='list') { ?>
                            <!-- 年级下班级-->
                            <?php  if(is_array($list)) { foreach($list as $key => $row) { ?>
                                    <div class="col-md-6">
                                        <!-- BEGIN SAMPLE TABLE PORTLET-->
                                        <div class="portlet box green">
                                            <div class="portlet-title">
                                                <div class="caption">
                                                    <i class="fa fa-comments"></i><?php  echo $this->gradeName($key);?> </div>
                                                <div class="tools">
                                                    <a href="javascript:;" class="collapse"> </a>
                                                </div>
                                            </div>
                                            <div class="portlet-body">
                                                <div class="table-scrollable">
                                                    <table class="table table-striped table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th> 班级</th>
                                                                <th> 有无设置 </th>
                                                                <th>  </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php  if(is_array($row)) { foreach($row as $v) { ?>
                                                            <tr>
                                                                    <td> <?php  echo $v['class_name'];?> </td>
                                                                    <td> <?php  if($v['syllabus_id']>0) { ?><span class='label label-sm label-success'>已经设置</span><?php  } else { ?> <span class='label label-sm label-danger'>暂未设置</span><?php  } ?> </td>
                                                                    <td><a href="<?php  echo $this->createWebUrl('syllabus',array('cid'=>$v['class_id'],'ac'=>'new','aw'=>1))?>" class="btn btn-outline  btn-sm purple">
                                                                            <i class="fa fa-edit"></i> 编辑 </a>
                                                                    </td>
                                                                </tr> 
                                                            <?php  } } ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- END SAMPLE TABLE PORTLET-->
                                    </div>
                            <?php  } } ?>
                    <?php  } ?>
                    <?php  if($ac=='new') { ?>
                         <div class="col-md-12">
                             <div class="portlet light ">
                                <div class="portlet-title">
                                    <div class="caption font-green-haze">
                                        <i class="icon-settings font-green-haze"></i>
                                        <span class="caption-subject bold uppercase"> 班级课程表</span>
                                    </div>
                                    <div class="actions">
                                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;" data-original-title="" title=""> </a>
                                    </div>
                                </div>
                               <div class="portlet-body form">
                                <form action="" method="post" class="form-horizontal form" enctype="multipart/form-data" id="form1"  >
                                 <div class="form-body">     
                                		<input type="hidden" name="cid"  class="form-control" value='<?php  echo $class_result['class_id'];?>' />
                                        <input type="hidden" name="ac"  class="form-control" value='save' />
                                        <div class="form-group form-md-line-input">
                                        <label class="col-md-2 control-label">是否用链接代替课表</label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control"  placeholder="http://baidu.com" value="<?php  echo $old_result['url'];?>" name='url' id='url'  >
                                                <div class="form-control-focus"> </div>
                                                <span class="help-block">链接地址[填写则会替代]</span>
                                            </div>
                                        </div>
                                       <div class="note note-success">
                                            <p> 编辑班级课程表 【<?php  echo $this->gradeName($class_result['grade_id'])?>】【<?php  echo $class_result['class_name'];?>】【改变课程后-授课老师无法及时更新，请保存后再编辑授课老师】 </p>
                                        </div>
                                                <?php  $g=1;?>
                                                <?php  if(is_array($loop)) { foreach($loop as $value) { ?>
                                                    <?php  if($g> $on_school) { ?><?php  break;?><?php  } ?>
                                                    <?php  if($begin_course ) { ?>
                                                    <?php  $begin_week=$begin_course+$g-1;?>
                                                    <?php  } else { ?>
                                                    <?php  $begin_week=$g;?>
                                                    <?php  } ?>
                                    <div class="col-md-6">
                                        <!-- BEGIN SAMPLE TABLE PORTLET-->
                                        <div class="portlet box green">
                                            <div class="portlet-title">
                                                <div class="caption">
                                                    <i class="fa fa-comments"></i>星期<?php  echo $begin_week;?></div>
                                                <div class="tools">
                                                    <a href="javascript:;" class="collapse"> </a>
                                                </div>
                                            </div>
                                            <div class="portlet-body">
                                                <div class="table-scrollable">
                                                    <table class="table table-striped table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th> 时间</th>
                                                                <th> 节数 </th>
                                                                <th> 课程 </th>
                                                                <th> 教师 </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                                <?php  if($am_much>0) { ?>
                                                                    <?php  $time='上午';?>
                                                                    <?php  $i=1;?>
                                                                    <?php  if(is_array($loop)) { foreach($loop as $row) { ?>
                                                                        <?php  if($i> $am_much) { ?><?php  break;?><?php  } ?>
                                                                        <tr>
                                                                            <td><?php  echo $time;?></td>
                                                                            <td>第<?php  echo $i;?>节课</td>
                                                                            <td>
                                                                                    <select name='am[<?php  echo $g;?>][<?php  echo $i;?>]' class='form-control'>
                                                                                        <?php  if(is_array($courses)) { foreach($courses as $v) { ?>
                                                                                            <option value='<?php  echo $v['name'];?>' <?php  if($data['am'][$g][$i]==$v['name'] ) { ?> selected <?php  } ?>><?php  echo $v['name'];?></option>
                                                                                        <?php  } } ?>
                                                                                        <option value='自习' <?php  if($data['am'][$g][$i]=='自习' ) { ?> selected <?php  } ?>>自习</option>
                                                                                        <option value='休息' <?php  if($data['am'][$g][$i]=='休息' ) { ?> selected <?php  } ?>>休息</option>
                                                                                        <option value='放学' <?php  if($data['am'][$g][$i]=='放学' ) { ?> selected <?php  } ?>>放学</option>
                                                                                    </select>
                                                                                                                                                           
                                                                            </td>
                                                                            <td> 
                                                                                <?php  if($data['am'][$g][$i] && $data['am'][$g][$i]!='自习' && $data['am'][$g][$i]!='休息' && $data['am'][$g][$i]!='放学') { ?>
                                                                                    <?php  $teacher_list=$this->classCouldCourse($class_result['class_id'],$data['am'][$g][$i])?>            
                                                                                    <select name='teacher_am[<?php  echo $g;?>][<?php  echo $i;?>]' class='form-control'>
                                                                                        <?php  if(is_array($teacher_list)) { foreach($teacher_list as $vs) { ?>
                                                                                            <option value='<?php  echo $vs['teacher_id'];?>'  <?php  if($data['teacher_am'][$g][$i] ==$vs['teacher_id']) { ?> selected <?php  } ?> ><?php  echo $vs['teacher_realname'];?></option>
                                                                                        <?php  } } ?>
                                                                                    </select>
                                                                            </td>
                                                                        </tr>
                                                                            <?php  } ?>
                                                                        <?php  $i++;?>
                                                                    <?php  } } ?>
                                                               <?php  } ?>  
                                                                <tr>
                                                                    <td> </td>
                                                                    <td> </td>
                                                                    <td> </td>
                                                                    <td> </td>
                                                                </tr>
                                                               <?php  if($pm_much>0) { ?>
                                                                    <?php  $time='下午';?>
                                                                    <?php  $i=1;?>
                                                                    <?php  if(is_array($loop)) { foreach($loop as $row) { ?>
                                                                        <?php  if($i> $pm_much) { ?><?php  break;?><?php  } ?>
                                                                        <tr>
                                                                            <td><?php  echo $time;?></td>
                                                                            <td>第<?php  echo $i;?>节课</td>
                                                                            <td>
                                                                                    <select name='pm[<?php  echo $g;?>][<?php  echo $i;?>]' class='form-control'>
                                                                                        <?php  if(is_array($courses)) { foreach($courses as $v) { ?>
                                                                                            <option value='<?php  echo $v['name'];?>' <?php  if($data['pm'][$g][$i]==$v['name'] ) { ?> selected <?php  } ?>><?php  echo $v['name'];?></option>
                                                                                        <?php  } } ?>
                                                                                        <option value='自习' <?php  if($data['pm'][$g][$i]=='自习' ) { ?> selected <?php  } ?>>自习</option>
                                                                                        <option value='休息' <?php  if($data['pm'][$g][$i]=='休息' ) { ?> selected <?php  } ?>>休息</option>
                                                                                        <option value='放学' <?php  if($data['pm'][$g][$i]=='放学' ) { ?> selected <?php  } ?>>放学</option>
                                                                                    </select>
                                                                                                                                                           
                                                                            </td>
                                                                            <td> 
                                                                                <?php  if($data['pm'][$g][$i] && $data['pm'][$g][$i]!='自习' && $data['pm'][$g][$i]!='休息' && $data['pm'][$g][$i]!='放学') { ?>
                                                                                    <?php  $teacher_list=$this->classCouldCourse($class_result['class_id'],$data['pm'][$g][$i])?>            
                                                                                    <select name='teacher_pm[<?php  echo $g;?>][<?php  echo $i;?>]' class='form-control'>
                                                                                        <?php  if(is_array($teacher_list)) { foreach($teacher_list as $vs) { ?>
                                                                                            <option value='<?php  echo $vs['teacher_id'];?>'  <?php  if($data['teacher_pm'][$g][$i] ==$vs['teacher_id']) { ?> selected <?php  } ?> ><?php  echo $vs['teacher_realname'];?></option>
                                                                                        <?php  } } ?>
                                                                                    </select>
                                                                            </td>
                                                                        </tr>
                                                                            <?php  } ?>
                                                                        <?php  $i++;?>
                                                                    <?php  } } ?>
                                                               <?php  } ?> 
                                                                   <tr>
                                                                    <td> </td>
                                                                    <td> </td>
                                                                    <td> </td>
                                                                    <td> </td>
                                                                </tr>                                                            
                                                                   <?php  if($ye_much>0) { ?>
                                                                    <?php  $time='晚上';?>
                                                                    <?php  $i=1;?>
                                                                    <?php  if(is_array($loop)) { foreach($loop as $row) { ?>
                                                                        <?php  if($i> $ye_much) { ?><?php  break;?><?php  } ?>
                                                                        <tr>
                                                                            <td><?php  echo $time;?></td>
                                                                            <td>第<?php  echo $i;?>节课</td>
                                                                            <td>
                                                                                    <select name='ye[<?php  echo $g;?>][<?php  echo $i;?>]' class='form-control'>
                                                                                        <?php  if(is_array($courses)) { foreach($courses as $v) { ?>
                                                                                            <option value='<?php  echo $v['name'];?>' <?php  if($data['ye'][$g][$i]==$v['name'] ) { ?> selected <?php  } ?>><?php  echo $v['name'];?></option>
                                                                                        <?php  } } ?>
                                                                                        <option value='自习' <?php  if($data['ye'][$g][$i]=='自习' ) { ?> selected <?php  } ?>>自习</option>
                                                                                        <option value='休息' <?php  if($data['ye'][$g][$i]=='休息' ) { ?> selected <?php  } ?>>休息</option>
                                                                                        <option value='放学' <?php  if($data['ye'][$g][$i]=='放学' ) { ?> selected <?php  } ?>>放学</option>
                                                                                    </select>
                                                                                                                                                           
                                                                            </td>
                                                                            <td> 
                                                                                <?php  if($data['ye'][$g][$i] && $data['ye'][$g][$i]!='自习' && $data['ye'][$g][$i]!='休息' && $data['ye'][$g][$i]!='放学') { ?>
                                                                                    <?php  $teacher_list=$this->classCouldCourse($class_result['class_id'],$data['ye'][$g][$i])?>            
                                                                                    <select name='teacher_ye[<?php  echo $g;?>][<?php  echo $i;?>]' class='form-control'>
                                                                                        <?php  if(is_array($teacher_list)) { foreach($teacher_list as $vs) { ?>
                                                                                            <option value='<?php  echo $vs['teacher_id'];?>'  <?php  if($data['teacher_ye'][$g][$i] ==$vs['teacher_id']) { ?> selected <?php  } ?> ><?php  echo $vs['teacher_realname'];?></option>
                                                                                        <?php  } } ?>
                                                                                    </select>
                                                                            </td>
                                                                        </tr>
                                                                            <?php  } ?>
                                                                        <?php  $i++;?>
                                                                    <?php  } } ?>
                                                               <?php  } ?>                                                                                                                          
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- END SAMPLE TABLE PORTLET-->
                                    </div>
                                          <?php  $g++;?>
                                       <?php  } } ?>
                                                <div class="form-actions">
                                                    <div class="row">
                                                        <div class="col-md-offset-2 col-md-10">
                                                            <input type="submit" name="submit" class="btn blue" value="确认"></button>
                                                        </div>
                                                    </div>
                                                </div>
                                   </div>
                                </form>
                                </div>
                                </div>                   
                         </div>
                    <?php  } ?>
                <?php  if($ac=='edit_course_time') { ?>
                     <div class="col-md-12">
                            <!-- BEGIN SAMPLE FORM PORTLET-->
                            <div class="portlet light ">
                                <div class="portlet-title">
                                    <div class="caption font-green-haze">
                                        <i class="icon-settings font-green-haze"></i>
                                        <span class="caption-subject bold uppercase">  编辑课程上课时间【24小时制】</span>
                                    </div>
                                    <div class="actions">
                                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;" data-original-title="" title=""> </a>
                                    </div>
                                </div>
                                <div class="portlet-body form">
                                   <form action="" method="post" class="form-horizontal form" enctype="multipart/form-data" id="form1">
								<?php  if($am_much>0) { ?>
							    <?php  $i=1;?>
									<?php  if(is_array($loop)) { foreach($loop as $row) { ?>
											<?php  if($i> $am_much) { ?><?php  break;?><?php  } ?>
                                            <div class="form-group form-md-line-input ">
                                                <label class="col-md-2 control-label">第<?php  echo $i;?>节课</label>
                                                    <div class="col-md-10 ">
                                                        <div class="col-md-5">
                                                            <div class="form-group form-md-line-input has-success">
                                                                <div class="input-icon col-md-4">
                                                                    <input type="text"  name="begin_time[<?php  echo $i;?>]" class="form-control" value="<?php  echo $result['begin_time'][$i];?>"  >
                                                                    <label for="am_much">课程开始时间</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-5">
                                                            <div class="form-group form-md-line-input has-warning">
                                                                <div class="input-icon col-md-4">
                                                                <input type="text" name="end_time[<?php  echo $i;?>]" class="form-control" value="<?php  echo $result['end_time'][$i];?>">
                                                                <label for="pm_much">课程结束时间</label>
                                                            </div>
                                                            </div>
                                                        </div>
                                                  </div>                                                          
                                              </div>   
										  <?php  $i++;?>
										  <?php  } } ?>
								<?php  } ?>
								<?php  if($pm_much>0) { ?>
									<?php  if(is_array($loop)) { foreach($loop as $row) { ?>
											<?php  if($i> $pm_much+$am_much) { ?><?php  break;?><?php  } ?>
                                            <div class="form-group form-md-line-input ">
                                                <label class="col-md-2 control-label">第<?php  echo $i;?>节课</label>
                                                    <div class="col-md-10 ">
                                                        <div class="col-md-5">
                                                            <div class="form-group form-md-line-input has-success">
                                                                <div class="input-icon col-md-4">
                                                                    <input type="text"  name="begin_time[<?php  echo $i;?>]" class="form-control" value="<?php  echo $result['begin_time'][$i];?>"  >
                                                                    <label for="am_much">课程开始时间</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-5">
                                                            <div class="form-group form-md-line-input has-warning">
                                                                <div class="input-icon col-md-4">
                                                                <input type="text" name="end_time[<?php  echo $i;?>]" class="form-control" value="<?php  echo $result['end_time'][$i];?>">
                                                                <label for="pm_much">课程结束时间</label>
                                                            </div>
                                                            </div>
                                                        </div>
                                                  </div>                                                          
                                              </div>                                            
										  <?php  $i++;?>
										  <?php  } } ?>
								<?php  } ?>
								<?php  if($ye_much>0) { ?>
									<?php  if(is_array($loop)) { foreach($loop as $row) { ?>
											<?php  if($i> $ye_much+$pm_much+$am_much) { ?><?php  break;?><?php  } ?>
                                                <div class="form-group form-md-line-input ">
                                                        <label class="col-md-2 control-label">第<?php  echo $i;?>节课</label>
                                                            <div class="col-md-10 ">
                                                                <div class="col-md-5">
                                                                    <div class="form-group form-md-line-input has-success">
                                                                        <div class="input-icon col-md-4">
                                                                            <input type="text"  name="begin_time[<?php  echo $i;?>]" class="form-control" value="<?php  echo $result['begin_time'][$i];?>"  >
                                                                            <label for="am_much">课程开始时间</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-5">
                                                                    <div class="form-group form-md-line-input has-warning">
                                                                        <div class="input-icon col-md-4">
                                                                        <input type="text" name="end_time[<?php  echo $i;?>]" class="form-control" value="<?php  echo $result['end_time'][$i];?>">
                                                                        <label for="pm_much">课程结束时间</label>
                                                                    </div>
                                                                    </div>
                                                                </div>
                                                        </div>                                                          
                                                    </div>                                                
										  <?php  $i++;?>
									<?php  } } ?>
					        <?php  } ?>
                                   <div class="form-actions">
                                            <div class="row">
                                                <div class="col-md-offset-2 col-md-10">
                                                    <input type="submit" name="submit" class="btn blue" value="提交"></button>
                                                </div>
                                            </div>
                                  </div>
                            </form>
            </div>	
            </div>	
            </div>	
            <?php  } ?>
                </div>
                <!--end row-->
                </div>
                </div>
                  <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/right', TEMPLATE_INCLUDEPATH)) : (include template('../admin/right', TEMPLATE_INCLUDEPATH));?>
            </div>
            <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/footer', TEMPLATE_INCLUDEPATH)) : (include template('../admin/footer', TEMPLATE_INCLUDEPATH));?>
           </body>
          </html>