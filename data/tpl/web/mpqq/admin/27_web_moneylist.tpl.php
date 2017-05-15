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
                     <div class="row">
                        <div class="col-md-12">
                             <div class="portlet light ">
                                <div class="portlet-title">
                                    <div class="caption font-green-haze">
                                        <i class="icon-settings font-green-haze"></i>
                                        <span class="caption-subject bold uppercase">筛选</span>
                                    </div>
                                    <div class="actions">
                                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;" data-original-title="" title=""> </a>
                                    </div>
                                </div>
                                  <div class="portlet-body form">
                                    <form action="./index.php" method="get" class="form-horizontal" role="form">
                                        <input type="hidden" name="c" value="site" />
                                        <input type="hidden" name="a" value="entry" />
                                        <input type="hidden" name="m" value="lianhu_school" />
                                        <input type="hidden" name="do" value="moneylist" />
                                        <input type="hidden" name="ac" value="list" />
                                        <input type="hidden" name="aw" value="1" />
                                        <input type="hidden" name="limit_id" value="<?php  echo $_GPC['limit_id'];?>" />
                                            <div class="form-group form-md-line-input">
                                                <label class=" col-md-2  control-label">年级</label>
                                                <div class="col-sm-10">
                                                    <select name='grade_id' class="form-control">
                                                        <option value='0'>全部</option>
                                                        <?php  if(is_array($grade_list)) { foreach($grade_list as $row) { ?>
                                                            <option value='<?php  echo $row['grade_id'];?>' <?php  if($_GPC['grade_id'] ==$row['grade_id']) { ?> selected <?php  } ?>><?php  echo $row['grade_name'];?></option>
                                                        <?php  } } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group form-md-line-input">
                                                <label class=" col-md-2  control-label">班级</label>
                                                <div class="col-sm-10">
                                                    <select name='class_id'  class="form-control">
                                                        <option value='0'>全部</option>
                                                        <?php  if(is_array($class_list)) { foreach($class_list as $row) { ?>
                                                            <option value='<?php  echo $row['class_id'];?>' <?php  if($_GPC['class_id'] ==$row['class_id']) { ?> selected <?php  } ?>><?php  echo $row['class_name'];?></option>
                                                        <?php  } } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group form-md-line-input">
                                                <label class=" col-md-2 control-label">姓名</label>
                                                <div class=" col-sm-10">
                                                    <input name='student_name' id='student_name'  class='form-control' value="<?php  echo $_GPC['student_name'];?>">
                                                </div>
                                            </div>
                                            <div class='form-group form-md-line-input'>
                                            <label class="   col-md-2 control-label"><span style='color:red'>*</span>状态</label>
                                            <div class="col-sm-10">
                                            <select name='status' class="form-control">
                                                    <option value='1' <?php  if($result['status']==1) { ?> selected <?php  } ?>>生效</option>
                                                    <option value='0' <?php  if($result['status']==0) { ?> selected <?php  } ?>>关闭</option>
                                            </select>
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

                 <div class="row">
                        <div class="col-md-12">
                            <div class="note note-success">
                                <p>  收费管理列表 </p>
                            </div>
                            <!-- BEGIN SAMPLE TABLE PORTLET-->
                            <div class="portlet box green">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-cogs"></i> 收费管理列表 </div>
                                    <div class="tools">
                                        <a href="javascript:;" class="collapse"> </a>
                                    </div>
                                </div>
                                <div class="portlet-body flip-scroll">
                                    <table class="table table-bordered table-striped table-condensed flip-content">
                                        <thead class="flip-content">
                                            <tr>
                                                <th >名称</th>
                                                <th >金额</th>
                                                <th >支付时间</th>
                                                <th >年级名</th>
                                                <th >班级名</th>
                                                <th >学生名</th>
                                                <th >支付人</th>
                                                <th >状态</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php  if(is_array($list)) { foreach($list as $row) { ?>
                                                <tr>
                                                    <td><?php  echo $row['limit_name'];?></td>
                                                    <td><?php  echo $row['limit_much'];?></td>
                                                    <td><?php  echo date("Y-m-d H:i:s",$row['addtime'])?></td>
                                                    <td><?php  echo $this->gradeName($row['grade_id']);?></td>
                                                    <td><?php  echo $this->className($row['class_id']);?></td>
                                                    <td><?php  echo $row['student_name'];?></td>
                                                    <td><?php  echo $row['nickname'];?></td>
                                                    <td><?php  if($row['status']==1) { ?>已支付<?php  } else { ?>未支付<?php  } ?></td>
                                                </tr>
                                            <?php  } } ?>                                     
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
        </div>
        </div>
         <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/right', TEMPLATE_INCLUDEPATH)) : (include template('../admin/right', TEMPLATE_INCLUDEPATH));?>
        </div>
     <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/footer', TEMPLATE_INCLUDEPATH)) : (include template('../admin/footer', TEMPLATE_INCLUDEPATH));?>
         </body>
    </html>