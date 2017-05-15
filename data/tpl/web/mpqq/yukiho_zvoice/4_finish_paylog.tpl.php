<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('navs', TEMPLATE_INCLUDEPATH)) : (include template('navs', TEMPLATE_INCLUDEPATH));?>
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
        打款操作
    </div>
    <div class="panel-body">
        <table st-table="items" class="table table-striped table-condensed" style="display:auto;">
            <thead>
            <tr>
                <th style="width:6em;">金额</th>
                <th style="width:8em;">昵称</th>
                <th style="width:6em;">头像</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            <?php  if(is_array($list)) { foreach($list as $li) { ?>
            <tr>
                <td><?php  echo $li['credit'];?></td>
                <?php  $member = M('member')->getInfo($li['to_openid'])?>
                <td>
                    <label class="label label-info"><?php  echo $member['nickname'];?></label>
                </td>
                <td>
                    <img src="<?php  echo tomedia($member['avatar'])?>" style="width:2em;height:2em;" class="img-rounded"/>
                </td>
                <td>
                    <a href="<?php  echo $this->createWebUrl('finish_paylog',array('act'=>'finish','credit'=>$li['credit'],'type'=>'wechat','to_openid'=>$li['to_openid']))?>" class="btn btn-danger btn-sm">打款到微信钱包</a>
                    <a href="<?php  echo $this->createWebUrl('finish_paylog',array('act'=>'finish','credit'=>$li['credit'],'type'=>'credit2','to_openid'=>$li['to_openid']))?>" class="btn btn-success btn-sm">打款到会员余额</a>
                </td>
            </tr>
            <?php  } } ?>
            </tbody>
        </table>
    </div>
</div>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>