<?php defined('IN_IA') or exit('Access Denied');?><?php  if(empty($_W['isajax'])) { ?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('navs', TEMPLATE_INCLUDEPATH)) : (include template('navs', TEMPLATE_INCLUDEPATH));?>
<?php  } ?>
<div class="panel panel-default">
    <div class="panel-body">
        <form action="./index.php" method="get"  class="form-horizontal">
            <input type="hidden" name="c" value="<?php  echo $_GPC['c']?>"/>
            <input type="hidden" name="a" value="<?php  echo $_GPC['a']?>"/>
            <input type="hidden" name="m" value="zhida"/>
            <input type="hidden" name="do" value="<?php  echo $_GPC['do']?>"/>
            <input type="hidden" name="act" value="<?php  echo $_GPC['act']?>"/>
            <div class="form-group">
                <label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">状态</label>
                <div class="col-sm-8 col-lg-9 col-xs-12">
                    <label class="radio-inline">
                        <input type="radio" name="status" value="2" <?php  if($_GPC['status']==2) { ?>checked="checked"<?php  } ?>> 已提现
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="status" value="1" <?php  if($_GPC['status']==1) { ?>checked="checked"<?php  } ?>> 待提现
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="status" value="0" <?php  if($_GPC['status']==0) { ?>checked="checked"<?php  } ?>> 未支付
                    </label>
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-md-offset-2 col-lg-offset-1 col-xs-12 col-sm-10 col-md-10 col-lg-11">
                    <input name="submit" type="submit" value="搜索" class="btn btn-primary span3" />
                    <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
                </div>
            </div>
        </form>
    </div>
</div>
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
            <?php  $total = M('paylog')->totalcredit()?>
            <div>总金额<span><?php  echo $total['all']['fee'];?></span></div>
            <div>本日金额<span><?php  echo $total['day']['fee'];?></span></div>
            <div>本周金额<span><?php  echo $total['week']['fee'];?></span></div>
            <div>本月金额<span><?php  echo $total['month']['fee'];?></span></div>
        </div>
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-heading">
        支付列表
        <a href="<?php  echo $this->createWebUrl('finish_paylog')?>" class="btn btn-default">一键发放</a>
    </div>
    <div class="panel-body">
        <table st-table="items" class="table table-striped table-condensed" style="display:auto;">
            <thead>
            <tr>
                <th style="width:22em;">订单码</th>
                <th style="width:6em;">订单金额</th>
                <th style="width:8em;">付款昵称</th>
                <th style="width:6em;">付款头像</th>
                <th style="width:8em;">收款昵称</th>
                <th style="width:6em;">收款头像</th>
                <th style="width:12em;">操作时间</th>
                <th style="width:5em;">状态</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            <?php  if(is_array($list['list'])) { foreach($list['list'] as $li) { ?>
            <tr>
                <td><?php  echo $li['sn'];?></td>
                <td><?php  echo $li['credit'];?></td>
                <?php  $member = M('member')->getInfo($li['openid'])?>
                <td><?php  echo $member['nickname'];?></td>
                <td>
                    <img src="<?php  echo tomedia($member['avatar'])?>" style="width:2em;height:2em;" class="img-rounded"/>
                </td>
                <?php  $to_member = M('member')->getInfo($li['to_openid'])?>
                <td><?php  echo $to_member['nickname'];?></td>
                <td>
                    <img src="<?php  echo tomedia($to_member['avatar'])?>" style="width:2em;height:2em;" class="img-rounded"/>
                </td>
                <td>
                    <label class="label label-success"><?php  echo date('Y-m-d H:i',$li['create_time'])?></label>
                </td>
                <td>
                    <label class="label label-<?php  if($li['status']==1) { ?>danger<?php  } else if($li['status']==0) { ?>info<?php  } else { ?>success<?php  } ?>"><?php  if($li['status']==1) { ?>待提现<?php  } else if($li['status']==0) { ?>未支付<?php  } else { ?>已提现<?php  } ?></label>
                </td>
                <td>
                    <a href="<?php  echo $this->createWebUrl('paylog',array('act'=>'delete','id'=>$li['id']))?>" class="btn btn-danger">删除</a>
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