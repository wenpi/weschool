<?php defined('IN_IA') or exit('Access Denied');?><?php  if(empty($_W['isajax'])) { ?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('navs', TEMPLATE_INCLUDEPATH)) : (include template('navs', TEMPLATE_INCLUDEPATH));?>
<?php  } ?>
<style>
    .table>thead>tr>td, .table>tbody>tr>td, .table>tfoot>tr>td {overflow: visible !important;}
    .dropdown-menu{min-width:4em;}
    .table>thead>tr>td, .table>tbody>tr>td, .table>tfoot>tr>td {white-space: normal !important;overflow: visible !important;}
    .dropdown{display:inline-block !important;}
    .account-stat-num > div {width: 25%;float: left;font-size: 16px;text-align: center;}
    .account-stat-num > div span {display: block;font-size: 30px;font-weight: bold;}
</style>
<div class="panel panel-default" style="padding:1em">
    <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin: -1em -1em 1em -1em;">
        <div class="navbar-header">
            <a class="navbar-brand" href="javascript:;">数据统计</a>
        </div>
    </nav>
    <div class="panel-body">
        <div class="account-stat-num row">
            <?php  $total = M('follow')->totalid()?>
            <div>收听总数<span><?php  echo $total['all']['sum'];?></span></div>
            <div>今日收听<span><?php  echo $total['day']['sum'];?></span></div>
            <div>本周收听<span><?php  echo $total['week']['sum'];?></span></div>
            <div>本月收听<span><?php  echo $total['month']['sum'];?></span></div>
        </div>
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-heading">
        订阅列表
    </div>
    <div class="panel-body">
        <table st-table="items" class="table table-striped table-condensed" style="display:auto;">
            <thead>
            <tr>
                <th style="width:8em;">昵称</th>
                <th style="width:6em;">头像</th>
                <th style="width:12em;">收听时间</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            <?php  if(is_array($list['list'])) { foreach($list['list'] as $li) { ?>
            <?php  $member = M('member')->getInfo($li['openid'])?>
            <tr>
                <td><?php  echo $member['nickname'];?></td>
                <td>
                    <img src="<?php  echo tomedia($member['avatar'])?>" style="width:4em;height:4em;" class="img-rounded"/>
                </td>
                <td>
                    <label class="label label-success"><?php  echo date('Y-m-d H:i',$li['create_time'])?></label>
                </td>
                <td>
                    <a href="<?php  echo $this->createWebUrl('follow',array('act'=>'edit','to_openid'=>$to_openid,'id'=>$li['id']))?>" class="btn btn-default">编辑</a>
                    <a href="<?php  echo $this->createWebUrl('follow',array('act'=>'delete','to_openid'=>$to_openid,'id'=>$li['id']))?>" class="btn btn-danger">删除</a>
                </td>
            </tr>
            <?php  } } ?>
            </tbody>
        </table>
        <?php  echo $list['pager']?>
    </div>

    <div class="panel-footer">
        <a href="<?php  echo $this->createWebUrl('follow',array('act'=>'edit','to_openid'=>$to_openid))?>" class="btn btn-default">新增</a>
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