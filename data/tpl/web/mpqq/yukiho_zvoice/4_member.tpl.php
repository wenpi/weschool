<?php defined('IN_IA') or exit('Access Denied');?><?php  if(empty($_W['isajax'])) { ?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('navs', TEMPLATE_INCLUDEPATH)) : (include template('navs', TEMPLATE_INCLUDEPATH));?>
<?php  } ?>
<?php  if(empty($_W['isajax'])) { ?>
<div class="panel panel-default">
    <div class="panel-body">
        <form action="./index.php" method="get"  class="form-horizontal">
            <input type="hidden" name="c" value="<?php  echo $_GPC['c']?>"/>
            <input type="hidden" name="a" value="<?php  echo $_GPC['a']?>"/>
            <input type="hidden" name="m" value="<?php  echo $_GPC['m']?>"/>
            <input type="hidden" name="do" value="<?php  echo $_GPC['do']?>"/>
            <input type="hidden" name="act" value="<?php  echo $_GPC['act']?>"/>
            <div class="form-group">
                <label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">会员状态</label>
                <div class="col-sm-8 col-lg-9 col-xs-12">
					<select name="status" value="<?php  echo $_GPC['status'];?>" class="form-control">
                        <option value="-1">全部会员</option>
						<option value="0">普通会员</option>
						<option value="1">等待审核</option>
						<option value="2">审核未通过</option>
						<option value="3">认证会员</option>
					</select>
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">昵称</label>
                <div class="col-sm-8 col-lg-9 col-xs-12">
                    <input type="text" name="nickname" placeholder="" value="<?php  echo $_GPC['nickname'];?>" class="form-control"/>
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
<?php  } ?>
<style>
    .table>thead>tr>td, .table>tbody>tr>td, .table>tfoot>tr>td {overflow: visible !important;}
    .dropdown-menu{min-width:4em;}
    .table>thead>tr>td, .table>tbody>tr>td, .table>tfoot>tr>td {white-space: normal !important;overflow: visible !important;}
    .dropdown{display:inline-block !important;}
    .account-stat-num > div {width: 25%;float: left;font-size: 16px;text-align: center;}
    .account-stat-num > div span {display: block;font-size: 30px;font-weight: bold;}
</style>
<?php  if(empty($_W['isajax'])) { ?>
<div class="panel panel-default" style="padding:1em">
    <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin: -1em -1em 1em -1em;">
        <div class="navbar-header">
            <a class="navbar-brand" href="javascript:;">数据统计</a>
        </div>
    </nav>
    <div class="panel-body">
        <div class="account-stat-num row">
            <?php  $total = M('member')->totalid()?>
            <div>会员总数<span><?php  echo $total['all']['sum'];?></span></div>
            <div>今日新增<span><?php  echo $total['day']['sum'];?></span></div>
            <div>本周新增<span><?php  echo $total['week']['sum'];?></span></div>
            <div>本月新增<span><?php  echo $total['month']['sum'];?></span></div>
        </div>
    </div>
</div>
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
                <th style="width:9em;">加入时间</th>
                <th style="width:6em;">费用</th>
                <th style="width:6em;">名人</th>
                <th style="width:6em;">推荐</th>
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
                <td><?php  echo $li['credit'];?></td>
                <td>
                    <label class="label label-danger"><?php  if($li['ishot']==1) { ?>名人<?php  } ?></label>
                </td>
                <td>
                    <label class="label label-danger"><?php  if($li['isrecommend']==1) { ?>推荐<?php  } else { ?><?php  } ?></label>
                </td>
                <td>
                    <?php  $category = M('category')->getInfo($li['category_id'])?>
                    <label class="label label-info"><?php  echo $category['title'];?></label>
                </td>
                <td>
                    <a href="<?php  echo $this->createWebUrl('member',array('act'=>'edit','id'=>$li['id']))?>" class="btn btn-success">编辑</a>
                    <a href="<?php  echo $this->createWebUrl('follow',array('to_openid'=>$li['openid']))?>" class="btn btn-warning">收听</a>
                    <a href="<?php  echo $this->createWebUrl('member',array('act'=>'delete','id'=>$li['id']))?>" class="btn btn-danger">删除</a>
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