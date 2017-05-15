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
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <span class="caption-subject font-red-sunglo bold uppercase"><?php  echo $result['limit_name'];?>&nbsp;&nbsp;金额：<?php  echo $result['limit_much'];?></span>
                        </div>
                    </div>
                </div>
            <?php  if($ac=='list') { ?>
                 <div class="row">
                        <div class="col-md-12">
                            <div class="portlet box green-turquoise">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-cogs"></i> 学生减免列表 </div>
                                    <div class="tools">
                                        <a href="<?php  echo $this->createWebUrl("moneyReduce",array("ac"=>"add","limit_id"=>$_GPC['limit_id']))?>" data-toggle="modal" style="color:#fff"><i class="fa fa-plus"></i>添加减免 </a>
                                    </div>
                                </div>
                                <div class="portlet-body flip-scroll">
                                    <table class="table table-bordered table-striped table-condensed flip-content">
                                        <thead class="flip-content">
                                            <tr>
                                                <th >学生</th>
                                                <th >学号</th>
                                                <th >添加时间</th>
                                                <th >减免金额</th>
                                                <!--<th >补交其他</th>-->
                                                <th >操作 </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php  if(is_array($list)) { foreach($list as $row) { ?>
                                                <tr>
                                                    <td><?php  echo $row['info']['student_name'];?></td>
                                                    <td><?php  echo $row['info']['xuehao'];?></td>
                                                    <td><?php  echo date("Y-m-d H:i:s",$row['add_time']);?></td>
                                                    <td><?php  echo $row['reduce_money'];?></td>
                                                    <!--<td></td>-->
                                                    <td style="text-align: center">
                                                        <a href="<?php  echo $this->createWebUrl('moneyReduce',array('id'=>$row['id'],'ac'=>'delete','limit_id'=>$_GPC['limit_id']) )?>" class="btn red" 
                                                            onclick=" if(!confirm('您确定删除吗')){return false;}"   > <i class="fa fa-close"></i>删除</a>
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
                <?php  if($ac=='add') { ?>
                                  <div class="portlet-body form">
                                    <form action="" method="post" class="form-horizontal form" enctype="multipart/form-data" id="form1"  >
                                            <div class="form-group  form-md-line-input">
                                                <label class="control-label col-md-2">选择学生</label>
                                                    <div class="col-md-10">
                                                        <select name="student_id[]" id='pre-selected-options'  multiple="multiple" class="multi-select"  >
                                                                <?php  if(is_array($student_list)) { foreach($student_list as $row) { ?>
                                                                <?php  if(!in_array($row['student_id'],$do_student_ids)) { ?>
                                                                    <option value='<?php  echo $row['student_id'];?>'> <?php  echo $row['student_name'];?>【学号:<?php  echo $row['xuehao'];?>】</option>
                                                                <?php  } ?>
                                                                <?php  } } ?>
                                                        </select>
                                                    </div>
                                            </div>  
                                        <div class='form-group  form-md-line-input'>
                                            <label class="  col-md-2 control-label"><span class="required" aria-required="true"> * </span>减免金额</label>
                                            <div class="col-sm-10">
                                                    <input type="text" name="reduce_money" id="reduce_money" class="form-control" value='<?php  echo $result['reduce_money'];?>' required  />
                                                    <div class="form-control-focus"> </div>
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
                <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/mutilSelect', TEMPLATE_INCLUDEPATH)) : (include template('../admin/mutilSelect', TEMPLATE_INCLUDEPATH));?>
        <?php  } ?>
        </div>
        </div>
         <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/right', TEMPLATE_INCLUDEPATH)) : (include template('../admin/right', TEMPLATE_INCLUDEPATH));?>
        </div>
         <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/footer', TEMPLATE_INCLUDEPATH)) : (include template('../admin/footer', TEMPLATE_INCLUDEPATH));?>
         </body>
    </html>