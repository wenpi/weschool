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
                    <script>
                        function templateDevice(obj){
                            val = $(obj).val();
                            if(val==1){
                                $("#template_device_mac").show();
                            }else{
                                $("#template_device_mac").hide();
                            }
                        }
                        function deviceChange(obj){
                            arr        = new Array();
                            device_val = $(obj).val();
                            $(".other_input").hide();
                            <?php  if(is_array(D('device')->display_type)) { foreach(D('device')->display_type as $key => $row) { ?>
                                arr[<?php  echo $key;?>] = new Array();
                                <?php  if(is_array($row)) { foreach($row as $k => $val) { ?>
                                    arr[<?php  echo $key;?>][<?php  echo $k;?>] = '<?php  echo $val;?>'; 
                                <?php  } } ?>
                            <?php  } } ?>
                            new_display = arr[device_val];
                            $.each(new_display,function(i,e){
                                $("#"+e+"").show();
                            });
                        }
                        $(function(){
                            deviceChange("#device_type");
                        });
                    </script> 
                     <div class="row">
                        <div class="col-md-12">
                             <div class="portlet light ">
                                <div class="portlet-title">
                                    <div class="caption font-green-haze">
                                        <i class="icon-settings font-green-haze"></i>
                                        <span class="caption-subject bold uppercase"><?php  if($ac=='new') { ?>新增设备<?php  } else { ?>修改<?php  } ?> </span>
                                    </div>
                                    <div class="actions">
                                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;" data-original-title="" title=""> </a>
                                    </div>
                                </div>
                                  <div class="portlet-body form">
                                    <form action="" method="post" class="form-horizontal form" enctype="multipart/form-data" id="form1"  >
                                                <div class="form-group form-md-line-input">
                                                    <label class="col-md-2 control-label"><span style='color:red'>*</span>设备备注名</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" name="device_name" id="device_name" class="form-control" value='<?php  echo $result['device_name'];?>' />
                                                        <?php  if($ac=='edit') { ?>
                                                        <input type="hidden" name="id"  class="form-control" value='<?php  echo $result['device_id'];?>' />
                                                        <?php  } ?>
                                                    </div>
                                                </div>
                                                 <div class="form-group form-md-line-input">
                                                    <label class=" col-md-2 control-label">设备类别</label>
                                                    <div class="col-sm-10">
                                                        <select name='device_type' id='device_type' class="form-control" onchange="deviceChange(this)"  >
                                                            <?php  if(is_array($device_types)) { foreach($device_types as $key => $rows) { ?>
                                                               <option value='<?php  echo $key;?>' <?php  if($key == $result['device_type']) { ?> selected <?php  } ?> ><?php  echo $rows;?></option>
                                                            <?php  } } ?>
                                                        </select>                                                         
                                                    </div>
                                                </div>                                                
                                                
                                                <div class="form-group form-md-line-input ">
                                                    <label class=" col-md-2 control-label"><span style='color:red'>*</span>设备识别</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" name="device_openid"  class="form-control" value='<?php  echo $result['device_openid'];?>' />
                                                    </div>
                                                </div>

                                                 <div class="form-group form-md-line-input other_input" id='template_device'>
                                                    <label class=" col-md-2 control-label">有无体温枪</label>
                                                    <div class="col-sm-10">
                                                        <select name='template_device'  class="form-control"  onchange="templateDevice(this)">
                                                            <option value='1' <?php  if(1 == $result['template_device']) { ?> selected <?php  } ?>>有</option>
                                                            <option value='2' <?php  if(2 == $result['template_device'] || !$result['template_device'] ) { ?> selected <?php  } ?>>无</option>
                                                        </select>                                                         
                                                    </div>
                                                </div>

                                                <div class="form-group form-md-line-input" id="template_device_mac" <?php  if(1 != $result['template_device'] ) { ?> style="display:none;" <?php  } ?> >
                                                    <label class=" col-md-2 control-label"><span style='color:red'>*</span>体温枪蓝牙MAC</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" name="template_device_mac" id="template_device_mac" class="form-control" value='<?php  echo $result['template_device_mac'];?>' />
                                                    </div>
                                                </div>

                                                <div class="form-group form-md-line-input other_input" id="img_ad_name">
                                                    <label class=" col-md-2 control-label">标题</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" name="img_ad_name"  class="form-control" value='<?php  echo $result['img_ad_name'];?>' />
                                                    </div>
                                                 </div>

                                                 <div class="form-group form-md-line-input other_input" id='img_ads'>
                                                    <label class=" col-md-2 control-label">图片组</label>
                                                    <div class="col-sm-10">
                                                        <?php  echo tpl_form_field_multi_image('img_ads', $result['img_ads']);?>
                                                    </div>
                                                 </div>

                                                <div class="form-group form-md-line-input other_input" id="video_name">
                                                    <label class=" col-md-2 control-label">标题[或者学校公告]：</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" name="video_name"  class="form-control" value='<?php  echo $result['video_name'];?>' />
                                                    </div>
                                               </div>

                                                <div class="form-group form-md-line-input other_input" id="video_url">					
                                                    <label class=" col-md-2 control-label">视频地址（mp4）(需：http://)：</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" name="video_url"  class="form-control" value='<?php  echo $result['video_url'];?>' />
                                                    </div>
                                                </div>				
                                               
                                                <div class="form-group form-md-line-input">
                                                    <label class=" col-md-2 control-label"><span style='color:red'>*</span>状态</label>
                                                    <div class="col-sm-10">
                                                        <select name='device_status'  class="form-control" >
                                                            <option value='1' <?php  if(1 ==$result['device_status']) { ?> selected <?php  } ?>>正常</option>
                                                            <option value='0' <?php  if(0 ==$result['device_status']) { ?> selected <?php  } ?>>关闭</option>
                                                        </select>                       
                                                    </div>
                                                </div>                
                                                
                                                <?php  if($room_re) { ?>
                                                    <div class="form-group form-md-line-input ">
                                                        <label class=" col-md-2 control-label">是否宿舍控制</label>
                                                        <div class="col-sm-10">
                                                            <select name='room_controller' id='roomController' class="form-control" onchange="roomControllers()" >
                                                                <option value='1' <?php  if(1 == $result['room_controller']) { ?> selected <?php  } ?>>宿舍控制</option>
                                                                <option value='0' <?php  if(0 == $result['room_controller']) { ?> selected <?php  } ?>>否</option>
                                                            </select>                       
                                                        </div>
                                                    </div>
                                                    <div class="form-group form-md-line-input " id='buildingNum'>
                                                        <label class=" col-md-2 control-label">楼栋号</label>
                                                        <div class="col-sm-10">
                                                            <select name='building_id' class="form-control"  >
                                                                <?php  if(is_array($building_list)) { foreach($building_list as $row) { ?>
                                                                    <option value="<?php  echo $row['building_id'];?>" <?php  if($row['building_id']==$result['building_id'] ) { ?>selected <?php  } ?>><?php  echo $row['building_num'];?></option>
                                                                <?php  } } ?>
                                                            </select>                       
                                                        </div>
                                                    </div>
                                                    <script>
                                                            function roomControllers(){
                                                                val = $("#roomController").val();
                                                                if(val==1){
                                                                    $("#buildingNum").show();
                                                                }else{
                                                                    $("#buildingNum").hide();
                                                                }
                                                            }
                                                            roomControllers();
                                                    </script>
                                                <?php  } ?>

                                                <div class="form-group form-md-line-input other_input" id='on_school_gate'>
                                                    <label class=" col-md-2 control-label"><span style='color:red'>*</span>是否校门口</label>
                                                    <div class="col-sm-10">
                                                        <select name='on_school_gate'  class="form-control" >
                                                            <option value='1' <?php  if(1 == $result['on_school_gate']) { ?> selected <?php  } ?>>位于校门口</option>
                                                            <option value='0' <?php  if(0 == $result['on_school_gate']) { ?> selected <?php  } ?>>否</option>
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
                <?php  } ?>
                <?php  if($ac=='list') { ?>
                 <div class="row">
                        <div class="col-md-12">
                            <div class="note note-success">
                                <p> 设备列表 </p>
                            </div>
                            <div class="portlet box green-turquoise">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-cogs"></i>设备列表 </div>
                                    <div class="tools">
                                        <a href="javascript:;" class="collapse"> </a>
                                    </div>
                                </div>
                                <div class="portlet-body flip-scroll">
                                    <table class="table table-bordered table-striped table-condensed flip-content">
                                        <thead class="flip-content">
                                            <tr>
                                                <th>ID</th>
                                                <th>设备识别</th>
                                                <th>设备名</th>
                                                <th>状态</th>
                                                <th>类别</th>
                                                <th>添加时间</th>
                                                <?php  if($room_re) { ?>
                                                <th>宿舍控制 </th>
                                                <?php  } ?>
                                                <th > </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                             <?php  if(is_array($list)) { foreach($list as $item) { ?>
                                                <tr>
                                                    <td><?php  echo $item['device_id'];?>        </td>
                                                    <td><?php  echo $item['device_openid'];?>    </td>
                                                    <td><?php  echo $item['device_name'];?>      </td>
                                                    <td><?php  if($item['device_status']==1) { ?>可用<?php  } else { ?><b class="font-red">注销</b><?php  } ?></td>
                                                    <td><?php  echo $device_types[$item['device_type']]?></td>
                                                    <td><?php  echo date("Y-m-d H:i:s",$item['add_time']);?></td>
                                                    <?php  if($room_re) { ?>
                                                        <?php  if($item['room_controller']) { ?>
                                                            <td><?php  echo Au("room/building")->getBuildNum($item['building_id']); ?></td>
                                                        <?php  } else { ?>
                                                            <td>无</td>
                                                        <?php  } ?>
                                                    <?php  } ?>
                                                    <td style="text-align:  left">
                                                            <a href="<?php  echo $this->createWebUrl('device', array('ac' => 'edit','id'=>$item['device_id'],'aw'=>1))?>"  class="btn blue"> <i class="fa fa-edit"></i>编辑</a>
                                                            <a href="<?php  echo $this->createWebUrl('device', array('ac' => 'delete','id'=>$item['device_id'],'aw'=>1))?>"  class="btn red"> <i class="fa fa-trash"></i>删除</a>
                                                            <?php  if($item['device_type']==5) { ?>
                                                                <a target="_blank" href="<?php  echo $this->createWebUrl('schoolBus', array('id'=>$item['device_id']))?>"  class="btn yellow"> <i class="fa fa-road"></i>校车路径</a>
                                                            <?php  } ?>
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