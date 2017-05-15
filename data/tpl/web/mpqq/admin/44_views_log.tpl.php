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
                                <div class="col-md-12 col-sm-12">
                                    <div class="portlet box green-turquoise">
                                        <div class="portlet-title">
                                            <div class="caption">
                                                <i class="fa fa-cogs"></i>搜索 
                                            </div>
                                        </div>
                                           <div class="portlet-body form">
                                               <br>
                                                <form  method="post" class="form-horizontal">
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">开始时间</label>
                                                            <div class="col-md-4">
                                                                <input name='begin_time' class="form-control"  id="mask_date"  value="<?php  echo $_GPC['begin_time'];?>">
                                                            </div>
                                                        </div>	
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">结束时间</label>
                                                            <div class="col-md-4">
                                                                <input name='end_time' class="form-control"  id="mask_date1" value="<?php  echo $_GPC['end_time'];?>">
                                                            </div>
                                                        </div>                                                      
                                                    <div class="form-actions">
                                                            <div class="row">
                                                                <div class="col-md-offset-2 col-md-10">
                                                                     <input type="submit" name="submit" class="btn blue" value="确认搜索">
                                                                     <button class="btn btn-default" type="button">总记录数：<?php  echo $result['count'];?></button>	
                                                                     <button class="btn btn-default" name='csv' value='1' >导出csv</button>	
                                                                </div>
                                                            </div>
                                                    </div>   
                                                </form>
                                              </div>   
                                       </div>   
                                 </div>   
                                <div class="col-md-12 col-sm-12">
                                    <div class="portlet box red">
                                        <div class="portlet-title">
                                            <div class="caption">
                                                <i class="fa fa-cogs"></i>查看记录 </div>
                                        </div>
                                        <div class="portlet-body">
                                            <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_3">
                                                <thead>
                                                    <tr>
                                                        <th> 年级 </th>
                                                        <th> 班级 </th>
                                                        <th> 学生 </th>
                                                        <th> 时间 </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php  if(is_array($list)) { foreach($list as $item) { ?>
                                                        <tr class="odd gradeX">
                                                            <td><?php  echo $item['grade_name'];?></td>
                                                            <td><?php  echo $item['class_name'];?></td>
                                                            <td><?php  echo $item['student_name'];?></td>
                                                            <td><?php  echo $item['add_time'];?></td>
                                                        </tr>                                           
                                                    <?php  } } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <!-- END EXAMPLE TABLE PORTLET-->
                                </div>                       
                            </div>
                        </div>
                    </div>
                    </div>
                <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/right', TEMPLATE_INCLUDEPATH)) : (include template('../admin/right', TEMPLATE_INCLUDEPATH));?>
                </div>
            <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/footer', TEMPLATE_INCLUDEPATH)) : (include template('../admin/footer', TEMPLATE_INCLUDEPATH));?>
          <?php  if($ac=='list') { ?>
                <!--筛选表格-->
                <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/table_script', TEMPLATE_INCLUDEPATH)) : (include template('../admin/table_script', TEMPLATE_INCLUDEPATH));?>        
            <?php  } ?>
    </html>