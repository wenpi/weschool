<?php defined('IN_IA') or exit('Access Denied');?>   <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/head', TEMPLATE_INCLUDEPATH)) : (include template('../admin/head', TEMPLATE_INCLUDEPATH));?>
        <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/header', TEMPLATE_INCLUDEPATH)) : (include template('../admin/header', TEMPLATE_INCLUDEPATH));?>
        <div class="page-container">
        <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/left', TEMPLATE_INCLUDEPATH)) : (include template('../admin/left', TEMPLATE_INCLUDEPATH));?>
            <div class="page-content-wrapper">
                <div class="page-content">
                    <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/sidebar', TEMPLATE_INCLUDEPATH)) : (include template('../admin/sidebar', TEMPLATE_INCLUDEPATH));?>
                    <h1 class="page-title"> 
                            <small> <?php  echo $title;?> </small>
                    </h1>
                 <div class="row">
                        <div class="col-md-12">
                            <div class="note note-success">
                                <p> 当前公众号下所有的学校 </p>
                            </div>
                            <div class="portlet box green">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-cogs"></i>学校列表 </div>
                                    <div class="tools">
                                        <a href="javascript:;" class="collapse"> </a>
                                    </div>
                                </div>
                                <div class="portlet-body flip-scroll">
                                    <table class="table table-bordered table-striped table-condensed flip-content">
                                        <thead class="flip-content">
                                        <tr>
                                            <th >学校ID</th>
                                            <th >学校</th>
                                            <th >学校类型</th>
                                            <th >状态</th>
                                            <th >模板</th>
                                            <th >班级圈</th>
                                            <th >班级公告</th>
                                            <th >渠道二维码</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                                    <?php  if(is_array($list)) { foreach($list as $item) { ?>
                                                    <tr>
                                                        <td><?php  echo $item['school_id'];?></td>
                                                        <td><?php  echo $item['school_name'];?><?php  if(getSchoolId()==$item['school_id']) { ?>【登陆状态】<?php  } ?></td>
                                                        <td><?php  if($item['school_type']==0) { ?>未设置<?php  } else { ?><?php  echo S('school','getSchoolTypeName',array($item['school_type']) );?> <?php  } ?></td>
                                                        <td><?php  if($item['status'] ==1) { ?>正常<?php  } else { ?>注销<?php  } ?></td>
                                                        <td><?php  if($item['mu_str']) { ?><?php  echo $item['mu_str'];?><?php  } else { ?>默认<?php  } ?></td>
                                                        <td><?php  if($item['line_status'] ==1) { ?><code>不审核</code><?php  } else { ?>审核<?php  } ?></td>
                                                        <td><?php  if($item['class_notice_status'] ==1) { ?><code>不审核</code><?php  } else { ?>审核<?php  } ?></td>
                                                        <?php  $qr_re = D('school')->createSchoolNoticeQr($item['school_id']);?>
                                                        <td><a href="<?php  echo $qr_re['url'];?>" target="_blank">二维码</a></td>
                                                        <td>
                                                                <a  href="<?php  echo $this->createWebUrl('school',array("sid"=>$item['school_id'],'back_url'=>'adminindex','op'=>'select' ) );?> " class="btn btn-outline btn-circle btn-sm purple">
                                                                <i class="fa fa-edit"></i> 登入 </a>
                                                        </td>
                                                    </tr>
                                                    <?php  } } ?>                                           
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                             <div class="portlet light ">
                                <div class="portlet-title">
                                    <div class="caption font-green-haze">
                                        <i class="icon-settings font-green-haze"></i>
                                        <span class="caption-subject bold uppercase"> 新增学校</span>
                                    </div>
                                    <div class="actions">
                                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;" data-original-title="" title=""> </a>
                                    </div>
                                </div>
                                  <div class="portlet-body form">
                                    <form action="" method="post" class="form-horizontal form" enctype="multipart/form-data" id="form1"  >
                                              <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label"><span class="required" aria-required="true"> * </span>学校名</label>
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control"  placeholder="学校名" name='school_name' required >
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