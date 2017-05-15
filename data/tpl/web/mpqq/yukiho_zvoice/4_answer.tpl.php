<?php defined('IN_IA') or exit('Access Denied');?><?php  if(empty($_W['isajax'])) { ?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('navs', TEMPLATE_INCLUDEPATH)) : (include template('navs', TEMPLATE_INCLUDEPATH));?>
<?php  } ?>
<div id="app">
    <div class="panel panel-default">
        <div class="panel-heading">
            回答列表
        </div>
        <div class="panel-body">
            <table st-table="items" class="table table-striped table-condensed" style="display:auto;">
                <thead>
                <tr>
                    <th style="width:3em;">
                        <input type="checkbox" id="checkall"/>
                    </th>
                    <th style="width:4em;">类型</th>
                    <th style="width:16em;">内容</th>
                    <th style="width:7em;">用户</th>
                    <th style="width:10em;">日期</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                <?php  if(is_array($list['list'])) { foreach($list['list'] as $li) { ?>
                <tr>
                    <td><input type="checkbox" name="ids[]" value="<?php  echo $li['id'];?>"/></td>
                    <td>
                        <label class="label label-<?php  if($li['mode']==0) { ?>info<?php  } else if($li['mode']==1) { ?>warning<?php  } ?>">
                            <?php  if($li['mode']==0) { ?>语音<?php  } else if($li['mode']==1) { ?>图文<?php  } ?>
                        </label>
                    </td>
                    <td><?php  echo $li['contents'];?></td>
                    <?php  $member = M('member')->getInfo($li['openid'])?>
                    <td><?php  echo $member['nickname'];?></td>
					<td>
						<label class="label label-success"><?php  echo date('Y-m-d H:i',$li['create_time'])?></label>
					</td>
                    <td>
                        <a href="<?php  echo $this->createWebUrl('answer',array('act'=>'edit','id'=>$li['id']))?>" class="btn btn-success btn-sm">编辑</a>
                        <a href="<?php  echo $this->createWebUrl('question',array('act'=>'edit','id'=>$li['question_id']))?>" class="btn btn-warning btn-sm">问题</a>
                        <a href="<?php  echo $this->createWebUrl('answer',array('act'=>'delete','id'=>$li['id']))?>" class="btn btn-danger btn-sm">删除</a>
                    </td>
                </tr>
                <?php  } } ?>
                </tbody>
            </table>
            <?php  echo $list['pager']?>
        </div>

        <div class="panel-footer">
            <a href="<?php  echo $this->createWebUrl('answer',array('act'=>'edit'))?>" class="btn btn-success">新增回答</a>
            <a data-href="<?php  echo $this->createWebUrl('answer',array('act'=>'mutdelete'))?>" href="javascript:;" class="btn btn-danger mutdelete">删除选中</a>
        </div>
    </div>
</div>

<?php  if(empty($_W['isajax'])) { ?>
<script>
    require(['util'],function(util){
        $('.mutdelete').click(function(){
            var url = $(this).data('href');
            var ids = [];
            var idss = [];
            $('input:checkbox[name="ids[]"]').each(function() {
                var _that = $(this)[0];
                if(_that.checked){
                    ids = ids.concat($(this).val());
                }else{
                    idss = idss.concat($(this).val());
                }
            });
            console.log(ids);
            if(confirm("您确定要删除么？")){
                $.post(url,{ids:ids},function(data){
                    util.message("删除成功","<?php  echo $_W['siteurl']?>",'success');
                },'json');
            }
        });
        $('.unmutdelete').click(function(){
            var ids = [];
            var idss = [];
            $('input:checkbox[name="ids[]"]').each(function() {
                var _that = $(this)[0];
                if(_that.checked){
                    ids = ids.concat($(this).val());
                }else{
                    idss = idss.concat($(this).val());
                }
            });
            console.log(idss);
            if(confirm("您确定要删除么？")){
                $.post(url,{ids:idss},function(data){
                    util.message("删除成功","<?php  echo $_W['siteurl']?>",'success');
                },'json');
            }
        })
        $("#checkall").click(function(){
            console.log('checkall');
            $('input[name="ids[]"').each(function(){
                var _that = $(this)[0];
                if(_that.checked){
                    _that.checked = false;
                }else{
                    _that.checked = true;
                }
            });
        });
        $('body').on('click','.open_modal',function(){
            var title = '';
            var url = $(this).data('href');
            var name = $(this).data('name');
            console.log(url);
            $.get(url,function(data){
                var content = data;
                var footer = '<button class="btn btn-danger close2">关闭</button>';
                var options = {containerName:''+name};
                var model = name+'_modal';
                eval(model+'=util.dialog(title, content, footer,options);');
                eval(model+'.show();');
                eval(model+'.removeClass("fade");');
                eval(model+'.find(".close2").click(function(){'+model+'.hide();})');
            },'html');
        });
    });
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>
<?php  } ?>