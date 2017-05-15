<?php defined('IN_IA') or exit('Access Denied');?><?php  if(empty($_W['isajax'])) { ?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('navs', TEMPLATE_INCLUDEPATH)) : (include template('navs', TEMPLATE_INCLUDEPATH));?>
<?php  } ?>
<div class="panel panel-default">
    <div class="panel-heading">问题信息</div>
    <div class="panel-body">
        <form action="" method="post"  class="form-horizontal" enctype="multipart/form-data">
            <div class="form-group">
                <label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">问题分类</label>
                <div class="col-sm-8 col-lg-9 col-xs-12">
                    <select name="class_id" id="" class="form-control">
                        <option value="0">请选择</option>
                        <?php  $options = M('category')->getall(array('fid'=>0))?>
                        <?php  if(is_array($options)) { foreach($options as $option) { ?>
                        <?php  $class = M('category')->getall(array('fid'=>$option['id']))?>
                        <option value="<?php  echo $option['id'];?>" <?php  if($item['category_id']==$option['id']) { ?>selected<?php  } ?>><?php  echo $option['title'];?></option>
                        <?php  if(is_array($class)) { foreach($class as $c) { ?>
                        <option value="<?php  echo $c['id'];?>" <?php  if($item['category_id']==$c['id']) { ?>selected<?php  } ?>>---|<?php  echo $c['title'];?></option>
                        <?php  } } ?>
                        <?php  } } ?>
                    </select>
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">问题</label>
                <div class="col-sm-8 col-lg-9 col-xs-12">
                    <textarea name="title"  class="form-control" id="" cols="30" rows="10"><?php  echo $item['title'];?></textarea>
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">提问粉丝</label>
                <div class="col-sm-8 col-lg-9 col-xs-12">
                    <input type="text" name="openid" data-name="member" data-href="<?php  echo $this->createWebUrl('member_select')?>"  readonly="readonly" placeholder="" value="<?php  echo $item['openid'];?>" class="form-control open_modal"/>
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">向谁提问</label>
                <div class="col-sm-8 col-lg-9 col-xs-12">
                    <input type="text" name="to_openid" data-name="member" data-href="<?php  echo $this->createWebUrl('member_select')?>"  readonly="readonly" placeholder="" value="<?php  echo $item['to_openid'];?>" class="form-control open_modal"/>
                    <span class="help-block"></span>
                </div>
            </div>
            <!--<div class="form-group">-->
                <!--<label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">费用</label>-->
                <!--<div class="col-sm-8 col-lg-9 col-xs-12">-->
                    <!--<input type="text" name="credit" placeholder="" value="<?php  echo $item['credit'];?>" class="form-control"/>-->
                    <!--<span class="help-block"></span>-->
                <!--</div>-->
            <!--</div>-->
            <div class="form-group">
                <label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">回答</label>
                <div class="col-sm-8 col-lg-9 col-xs-12">
                    <?php  echo tpl_form_field_audio('voice_id',$item['voice_id'])?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">公开</label>
                <div class="col-sm-8 col-lg-9 col-xs-12">
                    <label class="radio-inline">
                        <input type="radio" name="open" value="1" <?php  if($item['open']==1) { ?>checked="checked"<?php  } ?>> 开启
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="open" value="0" <?php  if($item['open']==0) { ?>checked="checked"<?php  } ?>> 关闭
                    </label>
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">限时免费</label>
                <div class="col-sm-8 col-lg-9 col-xs-12">
                    <label class="radio-inline">
                        <input type="radio" name="isfree" value="1" <?php  if($item['isfree']==1) { ?>checked="checked"<?php  } ?>> 开启
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="isfree" value="0" <?php  if($item['isfree']==0) { ?>checked="checked"<?php  } ?>> 关闭
                    </label>
                    <span class="help-block"></span>
                </div>
            </div>
            <div id="isfree" style="display:<?php  if($item['isfree'] == 1) { ?>block;<?php  } else { ?>none;<?php  } ?>">
                <div class="form-group">
                	<label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">免费结束时间</label>
                	<div class="col-sm-8 col-lg-9 col-xs-12">
                		<?php  echo _tpl_form_field_date('free_end_time',$item['free_end_time'],true)?>
                		<span class="help-block"></span>
                	</div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">状态</label>
                <div class="col-sm-8 col-lg-9 col-xs-12">
                    <label class="radio-inline">
                        <input type="radio" name="status" value="2" <?php  if($item['status']==2) { ?>checked="checked"<?php  } ?>> 已回答
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="status" value="1" <?php  if($item['status']==1) { ?>checked="checked"<?php  } ?>> 未回答
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="status" value="0" <?php  if($item['status']==0) { ?>checked="checked"<?php  } ?>> 未支付
                    </label>
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-md-offset-2 col-lg-offset-1 col-xs-12 col-sm-10 col-md-10 col-lg-11">
                    <input name="submit" type="submit" value="提交" class="btn btn-primary span3" />
                    <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
                </div>
            </div>
        </form>
    </div>
</div>
<?php  if(empty($_W['isajax'])) { ?>
<script>
    require(['util'],function(util){
        $('input[name="isfree"]').on('change keyup',function(){
            var _val = $(this).val();
            if(_val == 1){
                $('#isfree').show();
            }else{
                $('#isfree').hide();
            }
        });
        $('body').on('click','.open_modal',function(){
            var _that = $(this);
            var title = '';
            var url = $(this).data('href');
            var name = $(this).data('name');
            $.get(url,function(data){
                var content = data;
                var footer = '<button class="btn btn-danger close2">关闭</button>';
                var options = {containerName:''+name};
                var model = name+'_modal';
                eval(model+'=util.dialog(title, content, footer,options);');
                eval(model+'.show();');
                eval(model+'.removeClass("fade");');
                eval(model+'.find(".close2").click(function(){'+model+'.hide();})');
                eval(model+'.find(".select").click(function(){var openid = $(this).data("openid");select(openid)})');
                eval(model+'.find("#search").on("keyup change",function(){var key = $(this).val();search(key)})');
                function search(key){
                    $.post("<?php  echo $this->createWebUrl('member_select')?>",{key:key},function(html){
                        eval(model+'.find("tbody").html(html)');
                        eval(model+'.find(".select").click(function(){var openid = $(this).data("openid");select(openid)})');
                    },'html');
                }
                function select(openid){
                    _that.val(openid);
                    eval(model+'.hide();');
                }
            },'html');
        });
    });
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>
<?php  } ?>