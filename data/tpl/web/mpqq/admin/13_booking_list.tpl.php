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
            <!--结束公共头部-->
                <div class='row'>
                    <?php  if($ac == 'list' ) { ?>
                        <form action="" method="post" class="form-horizontal form" id="form1" >
                          <div class="col-md-12 col-sm-12">
                            <!-- BEGIN EXAMPLE TABLE PORTLET-->
                            <div class="portlet box red">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-cogs"></i>【<?php  echo $booking_re['booking_title'];?>】报名列表 </div>
                                </div> 
                                <div class="portlet-body">
                                    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_3">
                                        <thead>
                                            <tr>
                                                <th class="table-checkbox">
                                                <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                                        <input type="checkbox" class="group-checkable" data-set="#sample_3 .checkboxes" onclick="checkBox()"/>
                                                            <span></span>
                                                    </label>
                                                </th>    
                                                <th> 微信昵称 </th>
                                                <th> 报名时间 </th>
                                                <th> 内容     </th>
                                                <th> 报名人   </th>
                                                <th> 孩子姓名  </th>
                                                <th> 电话      </th>
                                                <th> 身份证    </th>
                                                <th> 回复时间  </th>
                                                <th> 回复内容  </th>
                                                <th> 执行时间  </th>
                                                <th> 执行内容  </th>
                                                <th> 执行人    </th>
                                                <th>          </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php  if(is_array($list)) { foreach($list as $item) { ?>
                                                <tr class="odd gradeX">
                                                    <td>
                                                        <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                                          <input type='checkbox' class='teacher_checkbox' value='<?php  echo $item['list_id'];?>' name='have[]'>
                                                            <span></span>
                                                        </label>
                                                    </td>
                                                    <td><?php  echo $item['nickname'];?> </td>
                                                    <td><?php  echo date("Y-m-d H:i:s",$item['add_time']);?></td>
                                                    <td><?php  echo $item['list_content'];?></td>
                                                    <td><?php  echo $item['my_name'];?></td>
                                                    <td><?php  echo $item['list_name'];?></td>
                                                    <td><?php  echo $item['list_phone'];?></td>
                                                    <td><?php  echo $item['list_people_id'];?></td>
                                                    <td><?php  if($item['re_time']) { ?><?php  echo date("Y-m-d H:i:s",$item['re_time']);?><?php  } ?></td>
                                                    <td><?php  echo $item['re_content'];?></td>
                                                    <td><?php  if($item['do_time']) { ?><?php  echo date("Y-m-d H:i:s",$item['do_time']);?><?php  } ?></td>
                                                    <td><?php  echo $item['do_content'];?></td>
                                                    <td><?php  echo $item['do_admin_name'];?></td>
                                                    <td> 
                                                        <a href="<?php  echo $this->createWebUrl('booking_list', array('id' => $item['list_id'],'ac'=>'delete'))?>" 
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
                     <div class="col-md-12 col-sm-12">
                                <div class="portlet box green ">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-gift"></i> 批处理 
                                        </div>
                                    </div>
                                    <div class="portlet-body form">
                                            <div class="form-body">
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label"><span style='color:red'>*</span>内容说明</label>
                                                    <div class="col-sm-9 ">
                                                        <textarea name='content' class='form-control' rows="3" required ></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-actions form-group">
                                                	<input type="submit" name="submit_weixin" value="提交" class="btn green" />
                                            </div>
                                    </div>
                                </div>
                            </div>                          
                            </form>
                    <?php  } ?>
                    </div>
                </div>
            <!--开始公共尾部-->
              </div>
            </div>
            <script>
                function checkBox(){
                    $(".teacher_checkbox").prop("checked",true);
                }
            </script>
         <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/right', TEMPLATE_INCLUDEPATH)) : (include template('../admin/right', TEMPLATE_INCLUDEPATH));?>
        </div>
     <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/footer', TEMPLATE_INCLUDEPATH)) : (include template('../admin/footer', TEMPLATE_INCLUDEPATH));?>
     <?php  if($ac=='list') { ?>
         <!--筛选表格-->
         <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/table_script', TEMPLATE_INCLUDEPATH)) : (include template('../admin/table_script', TEMPLATE_INCLUDEPATH));?>
     <?php  } ?>
    </body>
    </html>