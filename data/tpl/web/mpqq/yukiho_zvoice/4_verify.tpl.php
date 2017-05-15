<?php defined('IN_IA') or exit('Access Denied');?><?php  if(empty($_W['isajax'])) { ?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('navs', TEMPLATE_INCLUDEPATH)) : (include template('navs', TEMPLATE_INCLUDEPATH));?>
<?php  } ?>
<div class="panel panel-default">
    <div class="panel-heading">
        会员列表
    </div>
    <div class="panel-body">
        <table st-table="items" class="table table-striped table-condensed" style="display:auto;">
            <thead>
            <tr>
                <th style="width:8em;">昵称</th>
                <th style="width:5em;">头像</th>
                <th style="width:10em;">加入时间</th>
                <th style="width:6em;">头衔</th>
                <th style="width:6em;">分类</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            <?php  if(is_array($list['list'])) { foreach($list['list'] as $li) { ?>
            <tr>
                <td><?php  echo $li['nickname'];?></td>
                <td>
                    <img src="<?php  echo tomedia($li['avatar'])?>" style="width:2em;height:2em;" class="img-rounded"/>
                </td>
                <td>
                    <label class="label label-success"><?php  echo date('Y-m-d H:i',$li['create_time'])?></label>
                </td>
                <td><?php  echo $li['tags'];?></td>
                <td>
                    <?php  $category = M('category')->getInfo($li['category_id'])?>
                    <label class="label label-info"><?php  echo $category['title'];?></label>
                </td>
                <td>
                    <a href="<?php  echo $this->createWebUrl('verify',array('act'=>'pass','id'=>$li['id']))?>" class="btn btn-success">通过</a>
                    <a href="<?php  echo $this->createWebUrl('verify',array('act'=>'status','id'=>$li['id']))?>" class="btn btn-default">查看介绍</a>
                </td>
            </tr>
            <?php  } } ?>
            </tbody>
        </table>
        <?php  echo $list['pager']?>
    </div>
</div>

<?php  if(empty($_W['isajax'])) { ?>
<script>
    require(['util'],function(util){
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