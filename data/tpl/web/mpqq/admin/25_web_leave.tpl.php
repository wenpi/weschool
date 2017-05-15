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
                <?php  if($ac =='edit' ) { ?>
                     <div class="row">
                        <div class="col-md-12">
                             <div class="portlet light ">
                                <div class="portlet-title">
                                    <div class="caption font-green-haze">
                                        <i class="icon-settings font-green-haze"></i>
                                        <span class="caption-subject bold uppercase">处理请假申请 </span>
                                    </div>
                                    <div class="actions">
                                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;" data-original-title="" title=""> </a>
                                    </div>
                                </div>
                                  <div class="portlet-body form">
                                    <form action="" method="post" class="form-horizontal form" enctype="multipart/form-data" id="form1"  >
                                                <div class='form-group form-md-line-input'>
                                                        <label class=" col-md-2 control-label"> 请假人：</label>
                                                        <?php  echo $this->studentName($result['student_id']);?> </div>
                                                <div class='form-group form-md-line-input'>
                                                        <label class=" col-md-2 control-label">时间</label>
                                                        <?php  echo date("Y-m-d",$result['time_date_begin'])?>--<?php  echo date("Y-m-d",$result['time_date_end'])?> 
                                                        </div>
                                                <div class='form-group form-md-line-input'>
                                                        <label class="  col-md-2 control-label">理由：</label>
                                                        <?php  echo $result['leave_reason'];?>
                                                </div>

                                            <div class='form-group form-md-line-input'>
                                                <label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span>处理备注</label>
                                                <div class="col-sm-9 col-xs-12">
                                                    <textarea name='teacher_text'  class='form-control' required><?php  echo $result['teacher_text'];?></textarea>
                                                </div>	
                                            </div>		  

                                            <div class="form-actions">
                                                <div class="row">
                                                    <div class="col-md-offset-2 col-md-10">
                                                        	    <input type="submit" name="submit" value="准许" class="btn btn-primary col-lg-1" />
			                                                	<input type="submit" name="submit" value="不允" class="btn  col-lg-1" style='margin-left:10px;'/>
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
                                                    <span class="caption-helper">给出条件，筛选</span>
                                                </div>
                                            </div>
                                            <div class="portlet-body form">
                                                <form action="./index.php" method="GET" class="form-horizontal">
                                                    	<input type="hidden" name="c"  value="site" />
                                                        <input type="hidden" name="a"  value="entry" />
                                                        <input type="hidden" name="m"  value="lianhu_school" />
                                                        <input type="hidden" name="do" value="leave" />
                                                        <input type="hidden" name="ac" value="list" />
                                                        <?php  if($admin !='teacher') { ?>
                                                            <?php  $result = schoolGradeClass(); ?>                                                     
                                                        <div class="form-group ">
                                                          <label class="control-label col-md-3">班级</label>
                                                             <div class="col-md-4">
                                                                        <select name="class_id" class="form-control" id="school_grade_list"  >
                                                                            <option value='0'>全部</option>
                                                                            <?php  if(is_array($class_list)) { foreach($class_list as $row) { ?>
                                                                                    <?php  $grade_info = D('grade')->getGradeInfo($row['grade_id']);?>
                                                                                    <option value='<?php  echo $row['class_id'];?>' <?php  if($_GPC['class_id'] ==$row['class_id']) { ?> selected <?php  } ?>><?php  echo $grade_info['grade_name'];?>~<?php  echo $row['class_name'];?></option>
                                                                                <?php  } } ?>
                                                                         </select>
                                                             </div>
                                                        </div>
                                                        <?php  } ?>
                                                        <div class="form-group">
                                                            <label class=" col-md-3 control-label">姓名</label>
                                                            <div class="col-md-4">
                                                                <input name='student_name' id='student_name' class="form-control" value="<?php  echo $_GPC['student_name'];?>">
                                                            </div>
                                                        </div>						
                                                        <div class="form-group last">
                                                            <label class= " col-md-3  control-label">状态</label>
                                                            <div class="col-md-4">
                                                                <select name="status" class='form-control'>
                                                                    <option value='0'>全部</option>
                                                                    <option value="1" <?php  if($_GPC['status'] == '1') { ?> selected<?php  } ?>>申请中</option>
                                                                    <option value="2" <?php  if($_GPC['status'] == '2') { ?> selected<?php  } ?>>允许</option>
                                                                    <option value="3" <?php  if($_GPC['status'] == '3') { ?> selected<?php  } ?>>不允</option>
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
                                        <i class="fa fa-cogs"></i>请假记录列表 </div>
                                    <div class="tools">
                                        <a href="javascript:;" class="collapse"> </a>
                                    </div>
                                </div>
                                <div class="portlet-body flip-scroll">
                                    <table class="table table-bordered table-striped table-condensed flip-content">
                                        <thead class="flip-content">
                                            <tr>
                                                <th >ID</th>
                                                <th >学生姓名</th>
                                                <th >家长</th>
                                                <th >班级</th>
                                                <th >请假开始时间</th>
                                                <th >请假结束时间</th>
                                                <th >班主任</th>
                                                <th >理由</th>
                                                <th >状态</th>
                                                <th >时间</th>
                                                <th ></th>                                             
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php  if(is_array($list)) { foreach($list as $item) { ?>
                                                <?php  $grade_id   = $class_classes->getClassGradeId($item['class_id']); ?>
                                                <?php  $grade_info = $class_grade->getGradeInfo($grade_id);?>
                                            <tr>
                                                <td><?php  echo $item['leave_id'];?></td>
                                                <td><?php  echo $this->studentName($item['student_id']);?></td>
                                                <td><?php  echo $this->memberNickName($item['member_uid'])?></td>
                                                <td><?php  echo $grade_info['grade_name'];?>~<?php  echo $this->className($item['class_id'])?></td>
                                                <td><?php  echo date("Y-m-d",$item['time_date_begin'])?></td>
                                                <td><?php  echo date("Y-m-d",$item['time_date_end'])?></td>
                                                <td><?php  echo $this->teacherName($item['teacher_id'])?></td>
                                                <td><?php  echo $item['leave_reason'];?></td>
                                                <td>
                                                    <?php  if($item['leave_status'] ==1) { ?>申请中<?php  } else if($item['leave_status'] ==2) { ?><span class="font-green-meadow">允许</span><?php  } else { ?> <span class="font-red">不允许</span><?php  } ?>
                                                </td>
                                                <td><?php  echo date("Y-m-d H:i:s",$item['add_time']);?></td>
                                                <td>
                                                    <a href="<?php  echo $this->createWebUrl('leave', array('id' => $item['leave_id'],'ac'=>'edit','aw'=>1 ))?>" class="btn btn-outline   dark btn-sm black" title="编辑"><i class="fa fa-pencil"></i>编辑</a>
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
        </div>
        </div>
         <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/right', TEMPLATE_INCLUDEPATH)) : (include template('../admin/right', TEMPLATE_INCLUDEPATH));?>
        </div>
     <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/footer', TEMPLATE_INCLUDEPATH)) : (include template('../admin/footer', TEMPLATE_INCLUDEPATH));?>
         </body>
    </html>