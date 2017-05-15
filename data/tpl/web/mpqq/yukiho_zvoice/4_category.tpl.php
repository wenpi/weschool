<?php defined('IN_IA') or exit('Access Denied');?><?php  if(empty($_W['isajax'])) { ?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('setting_nav', TEMPLATE_INCLUDEPATH)) : (include template('setting_nav', TEMPLATE_INCLUDEPATH));?>
<?php  } ?>
<style>
    .table>thead>tr>td, .table>tbody>tr>td, .table>tfoot>tr>td {overflow: visible !important;}
    .dropdown-menu{min-width:4em;}
    .table>thead>tr>td, .table>tbody>tr>td, .table>tfoot>tr>td {white-space: normal !important;overflow: visible !important;}
    .dropdown{display:inline-block !important;}
    .account-stat-num > div {width: 25%;float: left;font-size: 16px;text-align: center;}
    .account-stat-num > div span {display: block;font-size: 30px;font-weight: bold;}
</style>
<div class="panel panel-default">
    <div class="panel-heading">
        分类列表
    </div>
    <div class="panel-body">
        <table st-table="items" class="table table-striped table-condensed" style="display:auto;">
            <thead>
            <tr>
                <th style="width:12em;">分类名</th>
                <th style="width:8em;">顺序</th><!--
                <th style="width:6em;">图标</th>-->
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            <?php  if(is_array($list['list'])) { foreach($list['list'] as $li) { ?>
            <tr>
                <td><?php  echo $li['title'];?></td>
                <td>
                    <label class="label label-info"><?php  echo $li['displayorder'];?></label>
                </td><!--
                <td>
                    <img src="<?php  echo tomedia($li['image'])?>" style="width:4em;height:4em;" class="img-rounded"/>
                </td>-->
                <td>
                    <!--<a href="<?php  echo $this->createWebUrl('category',array('act'=>'edit','fid'=>$li['id']))?>" class="btn btn-default">+添加子分类</a>-->
                    <a href="<?php  echo $this->createWebUrl('category',array('act'=>'edit','id'=>$li['id']))?>" class="btn btn-default">编辑</a>
                    <a href="<?php  echo $this->createWebUrl('category',array('act'=>'delete','id'=>$li['id']))?>" class="btn btn-danger">删除</a>
                </td>
            </tr>
            <?php  $class = M('category')->getall(array('fid'=>$li['id']))?>
            <?php  if(is_array($class)) { foreach($class as $c) { ?>
            <tr>
                <td>---|<?php  echo $c['title'];?></td>
                <td>
                    <label class="label label-info"><?php  echo $c['displayorder'];?></label>
                </td><!--
                <td>
                    <img src="<?php  echo tomedia($c['image'])?>" style="width:4em;height:4em;" class="img-rounded"/>
                </td>-->
                <td>
                    <a href="<?php  echo $this->createWebUrl('category',array('act'=>'edit','id'=>$c['id']))?>" class="btn btn-default">编辑</a>
                    <a href="<?php  echo $this->createWebUrl('category',array('act'=>'delete','id'=>$c['id']))?>" class="btn btn-danger">删除</a>
                </td>
            </tr>
            <?php  } } ?>
            <?php  } } ?>
            </tbody>
        </table>
        <?php  echo $list['pager']?>
    </div>

    <div class="panel-footer">
        <a href="<?php  echo $this->createWebUrl('category',array('act'=>'edit'))?>" class="btn btn-default">新增</a>
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