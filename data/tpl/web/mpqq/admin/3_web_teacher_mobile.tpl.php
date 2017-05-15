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
                     <div class="col-md-12">
                         <?php  if($op=='list') { ?>
                            <div class="portlet box green">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-cogs"></i>教师端底部导航列表 </div>
                                    <div class="tools">
                                        <a href="javascript:;" class="collapse"> </a>
                                    </div>
                                </div>
                                <div class="portlet-body flip-scroll">
                                    <table class="table table-bordered table-striped table-condensed flip-content">
                                        <thead class="flip-content">
                                            <tr>
                                                <th> 名称</th>
                                                <th> 图标 </th>
                                                <th> 排序 </th>
                                                <th> 功能识别 </th>
                                                <th> 链接 </th>
                                                <th> 添加时间 </th>
                                                <th> 状态 </th>
                                                <th >  </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                         <?php  if(is_array($button_list)) { foreach($button_list as $item) { ?>
                                            <tr >
                                                <td><?php  echo $item['name'];?></td>
                                                <td><img src="<?php  if($mu_str =='xiaoye') { ?><?php  echo $item['xiaoyeimg'];?><?php  } else { ?><?php  echo $item['img'];?><?php  } ?>" width="70"></td>
                                                <td><?php  echo $item['sort'];?></td>
                                                <td><?php  echo $item['keyword'];?></td>
                                                <td><?php  echo $item['url'];?></td>
                                                <td><?php  echo date("Y-m-d H:i:s",$item['add_time']);?></td>
                                                <td><?php  if($item['status']== 1) { ?>正常<?php  } else { ?>隐藏<?php  } ?></td>
                                                <td>
                                                    <a  href="<?php  echo $this->createWebUrl('teacher_mobile', array('id' => $item['display_id'], 'op' => 'edit','ac'=>'button' ))?> " class="btn btn-outline btn-circle btn-sm purple">
                                                                <i class="fa fa-edit"></i> 编辑
                                                    </a>
                                                </td>         
                                            </tr>
                                        	<?php  } } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>  
                                <div class="portlet box green">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-cogs"></i>教师端首页控制 </div>
                                        <div class="tools">
                                            <a href="javascript:;" class="collapse"> </a>
                                        </div>
                                    </div>
                                    <div class="portlet-body flip-scroll">
                                        <table class="table table-bordered table-striped table-condensed flip-content">
                                            <thead class="flip-content">
                                                <tr>
                                                    <th> 名称</th>
                                                    <th> 级别</th>
                                                    <th> 字体图标 </th>
                                                    <th> 排序 </th>
                                                    <th> 功能识别 </th>
                                                    <th> 链接 </th>
                                                    <th> 添加时间 </th>
                                                    <th> 状态 </th>
                                                    <th >  </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php  if(is_array($index_list)) { foreach($index_list as $item) { ?>
                                                <tr class="success">
                                                    <td><?php  echo $item['top']['name'];?></td>
                                                    <td>父级</td>
                                                    <td>颜色：<?php  echo $item['top']['dis_one'];?>;css:<?php  echo $item['top']['dis_two'];?></td>
                                                    <td><?php  echo $item['sort'];?></td>
                                                    <td> </td>
                                                    <td> </td>
                                                    <td><?php  echo date("Y-m-d H:i:s",$item['top']['add_time']);?></td>
                                                    <td><?php  if($item['top']['status']== 1) { ?>正常<?php  } else { ?>隐藏<?php  } ?></td>
                                                    <td>
                                                        <a  href="<?php  echo $this->createWebUrl('teacher_mobile', array('id' => $item['top']['display_id'], 'op' => 'edit','ac'=>'index_top' ))?> " class="btn yellow">
                                                                    <i class="fa fa-edit"></i> 编辑
                                                        </a>
                                                        <a  href="<?php  echo $this->createWebUrl('teacher_mobile', array('id' => $item['top']['display_id'], 'op' => 'new','ac'=>'index_button' ))?> " class="btn red">
                                                                    <i class="fa fa-plus-square-o"></i> 新增
                                                        </a>
                                                    </td>         
                                                </tr>
                                                <?php  if(is_array($item['list'])) { foreach($item['list'] as $val) { ?>
                                                <tr>
                                                    <td><?php  echo $val['name'];?></td>
                                                    <td>子</td>
                                                    <td><i class="<?php  echo $val['dis_two'];?> " style="font-size:20px;"></i></td>
                                                    <td><?php  echo $val['sort'];?></td>
                                                    <td><?php  echo $val['keyword'];?></td>
                                                    <td><?php  echo $val['url'];?></td>
                                                    <td><?php  echo date("Y-m-d H:i:s",$val['add_time']);?></td>
                                                    <td><?php  if($val['status']== 1) { ?>正常<?php  } else { ?>隐藏<?php  } ?></td>
                                                    <td>
                                                        <a  href="<?php  echo $this->createWebUrl('teacher_mobile', array('id' => $val['display_id'], 'op' => 'edit','ac'=>'index_button' ))?> " class="btn btn-outline btn-circle btn-sm purple">
                                                                    <i class="fa fa-edit"></i> 编辑
                                                        </a>
                                                    </td>         
                                                </tr>
                                                <?php  } } ?>
                                                <?php  } } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>                             
                            <?php  } ?>         
                            <?php  if($op=='edit' && $ac=='button') { ?>
                              <div class="portlet light ">
                                <div class="portlet-title">
                                    <div class="caption font-green-haze">
                                        <i class="icon-settings font-green-haze"></i>
                                        <span class="caption-subject bold uppercase"> 修改底部导航栏 </span>
                                    </div>
                                    <div class="actions">
                                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;" data-original-title="" title=""> </a>
                                    </div>
                                </div>
                                  <div class="portlet-body form">
                                    <form action="" method="post" class="form-horizontal form" enctype="multipart/form-data" id="form1"  >
                                        <div class="form-group  form-md-line-input">
                                            <label class="col-md-2 control-label"><span class="required" aria-required="true"> * </span> 名称</label>
                                            <div class="col-sm-10 ">
                                                <input type="text" name="name" id="name" class="form-control" value='<?php  echo $result['name'];?>' />
                                                <div class="form-control-focus"> </div>
                                            </div>
                                        </div>
                                        <div class="form-group  form-md-line-input">
                                            <label class="col-md-2 control-label"> 调用家校通关键词</label>
                                            <div class="col-sm-10 ">
                                                <input type="text" name="keyword" id="keyword" class="form-control" value='<?php  echo $result['keyword'];?>' />
                                                <div class="form-control-focus"> </div>
                                            </div>
                                        </div>
                                        <div class="form-group  form-md-line-input">
                                            <label class="col-md-2 control-label"> 网址（设置此，关键词无效）</label>
                                            <div class="col-sm-10 ">
                                                <input type="text" name="url" id="url" class="form-control" value='<?php  echo $result['url'];?>' />
                                                <div class="form-control-focus"> </div>
                                            </div>
                                        </div>
                                        <div class="form-group  form-md-line-input">
                                            <label class="col-md-2 control-label">排序</label>
                                            <div class="col-sm-10 ">
                                                <input type="text" name="sort" id="sort" class="form-control" value='<?php  echo $result['sort'];?>' />
                                                <div class="form-control-focus"> </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">导航按钮（75*75）</label>
                                            <div class="col-sm-10">
                                                <?php  if($mu_str=='xiaoye') { ?>
                                                    <?php  if(!$result['xiaoyeimg'] ||  $result['xiaoyeimg']== $_W['attachurl'] ) { ?>
                                                        <?php  $result['xiaoyeimg'] = C('mobile')->teacherButtonImg($result['keyword']); ?>
                                                    <?php  } ?>
                                                    <?php  echo tpl_form_field_image('xiaoyeimg',$result['xiaoyeimg']);?>
                                                <?php  } else { ?>
                                                    <?php  echo tpl_form_field_image('img',$result['img']);?>
                                                <?php  } ?>
                                            </div>
                                        </div>				
                                           <div class="form-group form-md-radios form-md-line-input  ">
                                            <label class="col-md-2 control-label"  >状态</label>
                                            <div class="md-radio-inline">
                                                <div class="md-radio">
                                                    <input type="radio"  id="radiol" class="md-radiobtn"  name="status"   value='1' <?php  if($result['status']==1) { ?> checked <?php  } ?>  />
                                                    <label for="radiol">
                                                        <span></span>
                                                        <span class="check"></span>
                                                        <span class="box"></span>显示</label>
                                                </div>
                                                <div class="md-radio">
                                                  <input type="radio"   id='radiol1' class="md-radiobtn" name="status"   value='0' <?php  if($result['status']==0) { ?> checked <?php  } ?> />
                                                    <label for="radiol1">
                                                        <span></span>
                                                        <span class="check"></span>
                                                        <span class="box"></span>隐藏</label>
                                                </div>
                                            </div>
                                        </div>                                              
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
                            <?php  } ?>          
                             <?php  if($op=='edit' && $ac=='index_top') { ?>
                              <div class="portlet light ">
                                <div class="portlet-title">
                                    <div class="caption font-green-haze">
                                        <i class="icon-settings font-green-haze"></i>
                                        <span class="caption-subject bold uppercase"> 修改首页父级导航 </span>
                                    </div>
                                    <div class="actions">
                                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;" data-original-title="" title=""> </a>
                                    </div>
                                </div>
                                  <div class="portlet-body form">
                                    <form action="" method="post" class="form-horizontal form" enctype="multipart/form-data" id="form1"  >
                                        <div class="form-group  form-md-line-input">
                                            <label class="col-md-2 control-label"><span class="required" aria-required="true"> * </span> 名称</label>
                                            <div class="col-sm-10 ">
                                                <input type="text" name="name" id="name" class="form-control" value='<?php  echo $result['name'];?>' />
                                                <div class="form-control-focus"> </div>
                                            </div>
                                        </div>
                                        <div class="form-group  form-md-line-input">
                                            <label class="col-md-2 control-label"> 字体颜色（css）</label>
                                            <div class="col-sm-10 ">
                                                <input type="text" name="dis_one" id="dis_one" class="form-control" value='<?php  echo $result['dis_one'];?>' />
                                                <div class="form-control-focus"> </div>
                                            </div>
                                        </div>
                                        <div class="form-group  form-md-line-input">
                                            <label class="col-md-2 control-label"> 字体颜色（style）</label>
                                            <div class="col-sm-10 ">
                                                <input type="text" name="dis_two" id="dis_two" class="form-control" value='<?php  echo $result['dis_two'];?>' />
                                                <div class="form-control-focus"> </div>
                                            </div>
                                        </div>
                                        <div class="form-group  form-md-line-input">
                                            <label class="col-md-2 control-label">排序</label>
                                            <div class="col-sm-10 ">
                                                <input type="text" name="sort" id="sort" class="form-control" value='<?php  echo $result['sort'];?>' />
                                                <div class="form-control-focus"> </div>
                                            </div>
                                        </div>                                   				
                                           <div class="form-group form-md-radios form-md-line-input  ">
                                            <label class="col-md-2 control-label"  >状态</label>
                                            <div class="md-radio-inline">
                                                <div class="md-radio">
                                                    <input type="radio"  id="radiol" class="md-radiobtn"  name="status"   value='1' <?php  if($result['status']==1) { ?> checked <?php  } ?>  />
                                                    <label for="radiol">
                                                        <span></span>
                                                        <span class="check"></span>
                                                        <span class="box"></span>显示</label>
                                                </div>
                                                <div class="md-radio">
                                                  <input type="radio"   id='radiol1' class="md-radiobtn" name="status"   value='0' <?php  if($result['status']==0) { ?> checked <?php  } ?> />
                                                    <label for="radiol1">
                                                        <span></span>
                                                        <span class="check"></span>
                                                        <span class="box"></span>隐藏</label>
                                                </div>
                                            </div>
                                        </div>                                              
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
                            <?php  } ?>     
                            <?php  if(($op=='edit' || $op=='new') &&  $ac=='index_button') { ?>
                              <div class="portlet light ">
                                <div class="portlet-title">
                                    <div class="caption font-green-haze">
                                        <i class="icon-settings font-green-haze"></i>
                                        <span class="caption-subject bold uppercase"> 修改首页按钮 </span>
                                    </div>
                                    <div class="actions">
                                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;" data-original-title="" title=""> </a>
                                    </div>
                                </div>
                                  <div class="portlet-body form">
                                    <form action="" method="post" class="form-horizontal form" enctype="multipart/form-data" id="form1"  >
                                        <div class="form-group  form-md-line-input">
                                            <label class="col-md-2 control-label"><span class="required" aria-required="true"> * </span> 名称</label>
                                            <div class="col-sm-10 ">
                                                <input type="text" name="name" id="name" class="form-control" value='<?php  echo $result['name'];?>' />
                                                <div class="form-control-focus"> </div>
                                            </div>
                                        </div>
                                        <div class="form-group  form-md-line-input">
                                            <label class="col-md-2 control-label"> 调用家校通关键词</label>
                                            <div class="col-sm-10 ">
                                                <input type="text" name="keyword" id="keyword" class="form-control" value='<?php  echo $result['keyword'];?>' />
                                                <div class="form-control-focus"> </div>
                                            </div>
                                        </div>
                                     <?php  if($mu_str == 'xiaoye') { ?>
                                        <div class="form-group form-md-line-input">
                                            <label class="col-md-2 control-label">导航按钮（75*75）</label>
                                            <div class="col-sm-10">
                                                    <?php  if(!$result['img'] || $result['img']==$_W['attachurl'] ) { ?>
                                                        <?php  $result['img'] = C('mobile')->studentIndexImg($result['keyword']); ?>
                                                    <?php  } ?>
                                                    <?php  echo tpl_form_field_image('img',$result['img']);?>
                                            </div>
                                        </div>       
                                    <?php  } ?>                                         
                                        <div class="form-group  form-md-line-input">
                                            <label class="col-md-2 control-label"> 网址（设置此，关键词无效）</label>
                                            <div class="col-sm-10 ">
                                                <input type="text" name="url" id="url" class="form-control" value='<?php  echo $result['url'];?>' />
                                                <div class="form-control-focus"> </div>
                                            </div>
                                        </div>
                                        <div class="form-group  form-md-line-input">
                                            <label class="col-md-2 control-label">排序</label>
                                            <div class="col-sm-10 ">
                                                <input type="text" name="sort" id="sort" class="form-control" value='<?php  echo $result['sort'];?>' />
                                                <div class="form-control-focus"> </div>
                                            </div>
                                        </div>
                                        <div class="form-group  form-md-line-input">
                                            <label class="col-md-2 control-label">导航按钮字体</label>
                                            <div class="col-sm-10">
                                                  <input type="text" name="dis_two" id="dis_two" class="form-control" value='<?php  echo $result['dis_two'];?>' />
                                                  <div class="form-control-focus"> </div>                                             
                                                  <span class="">[填写格式：fa fa-*]<a target="_blank" href='http://fontawesome.io/icons/'>(http://fontawesome.io/icons/)</a>[不要使用最新的图标]</span>

                                            </div>
                                        </div>			
                                           <div class="form-group form-md-radios form-md-line-input  ">
                                            <label class="col-md-2 control-label"  >状态</label>
                                            <div class="md-radio-inline">
                                                <div class="md-radio">
                                                    <input type="radio"  id="radiol" class="md-radiobtn"  name="status"   value='1' <?php  if($result['status']==1) { ?> checked <?php  } ?>  />
                                                    <label for="radiol">
                                                        <span></span>
                                                        <span class="check"></span>
                                                        <span class="box"></span>显示</label>
                                                </div>
                                                <div class="md-radio">
                                                  <input type="radio"   id='radiol1' class="md-radiobtn" name="status"   value='0' <?php  if($result['status']==0) { ?> checked <?php  } ?> />
                                                    <label for="radiol1">
                                                        <span></span>
                                                        <span class="check"></span>
                                                        <span class="box"></span>隐藏</label>
                                                </div>
                                            </div>
                                        </div>                                              
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
                            <?php  } ?>                                                       
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