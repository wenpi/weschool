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
                 <div class="row">
                        <div class="col-md-12">
                            <div class="note note-success">
                                <p> 校园食谱 </p>
                            </div>
                               <div class="portlet light ">
                                <div class="portlet-title">
                                    <div class="caption font-green-haze">
                                        <i class="icon-settings font-green-haze"></i>
                                        <span class="caption-subject bold uppercase">一周食谱</span>
                                    </div>
                                    <div class="actions">
                                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;" data-original-title="" title=""> </a>
                                    </div>
                                </div>
                                  <div class="portlet-body form">
                                     <form action="" method="post" class="form-horizontal form" enctype="multipart/form-data" id="form1" >
                                    <?php  if($mu_str != 'xiaoye') { ?>
                                                <div class="form-group form-md-line-input">
                                                    <label class="col-md-1 control-label"></label>
                                                    <div class="col-md-10">
                                                        <?php  echo tpl_ueditor("cookBook",$result['cookbooK_breakfast'])?>
                                                    </div>
                                                </div>    
                                                                               
                                    <?php  } else { ?>
                                      <div class="portlet-body flip-scroll"   >
                                        <table class="table table-bordered table-striped table-condensed flip-content" style="text-align: center">
                                            <thead class="flip-content">
                                                <tr>
                                                    <th width='10%'> 日期</th>
                                                    <?php  if(is_array($cookbook_class_arr)) { foreach($cookbook_class_arr as $row) { ?>
                                                    <th><?php  echo $row;?></th>
                                                    <?php  } } ?>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php  if(is_array($out_times)) { foreach($out_times as $row) { ?>
                                                    <tr>
                                                        <td class="font-red" ><?php  echo $row['date'];?></td>
                                                        <?php  if(is_array($cookbook_class_arr)) { foreach($cookbook_class_arr as $val) { ?>
                                                            <td>
                                                                <input type="text" class="form-control" name = "cookbook[<?php  echo $val;?>][<?php  echo $row['unix'];?>]" value="<?php  echo C('cookbook')->getCookbook($val,$row['unix']);?>"  >
                                                            </td>
                                                        <?php  } } ?>
                                                    </tr>
                                                <?php  } } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>                                   
                                    <?php  } ?>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-offset-2 col-md-10">
                                        <input type="submit" name="submit" class="btn blue" value="确认提交">
                                    </div>
                                </div>
                            </div>                                    
                            </form>
                                  </div>
                        </div>
                    </div>                   
                </div>
            <!--开始公共尾部-->
              </div>
            </div>
         <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/right', TEMPLATE_INCLUDEPATH)) : (include template('../admin/right', TEMPLATE_INCLUDEPATH));?>
        </div>
     <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/footer', TEMPLATE_INCLUDEPATH)) : (include template('../admin/footer', TEMPLATE_INCLUDEPATH));?>
    </body>
    </html>