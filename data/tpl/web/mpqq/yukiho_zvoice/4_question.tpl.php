<?php defined('IN_IA') or exit('Access Denied');?><?php  if(empty($_W['isajax'])) { ?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('navs', TEMPLATE_INCLUDEPATH)) : (include template('navs', TEMPLATE_INCLUDEPATH));?>
<?php  } ?>
<div id="app">
    <div class="panel panel-default">
        <div class="panel-body">
            <form action="./index.php" method="get"  class="form-horizontal">
                <input type="hidden" name="c" value="<?php  echo $_GPC['c']?>"/>
                <input type="hidden" name="a" value="<?php  echo $_GPC['a']?>"/>
                <input type="hidden" name="m" value="<?php  echo $_GPC['m']?>"/>
                <input type="hidden" name="do" value="<?php  echo $_GPC['do']?>"/>
                <input type="hidden" name="act" value="<?php  echo $_GPC['act']?>"/>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">问题分类</label>
                    <div class="col-sm-8 col-lg-9 col-xs-12">
                        <select name="category_id" id="" class="form-control">
                            <option value="0">请选择</option>
                            <?php  $options = M('category')->getall(array('fid'=>0))?>
                            <?php  if(is_array($options)) { foreach($options as $option) { ?>
                            <?php  $class = M('category')->getall(array('fid'=>$option['id']))?>
                            <option value="<?php  echo $option['id'];?>" disabled="disabled" <?php  if($_GPC['category_id']==$option['id']) { ?>selected<?php  } ?>><?php  echo $option['title'];?></option>
                            <?php  if(is_array($class)) { foreach($class as $c) { ?>
                            <option value="<?php  echo $c['id'];?>" <?php  if($_GPC['category_id']==$c['id']) { ?>selected<?php  } ?>>---|<?php  echo $c['title'];?></option>
                            <?php  } } ?>
                            <?php  } } ?>
                        </select>
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
                <?php  $total = M('question')->totalcredit()?>
                <div>总数<span><?php  echo $total['all']['sum'];?></span></div>
                <div>本日总数<span><?php  echo $total['day']['sum'];?></span></div>
                <div>本周总数<span><?php  echo $total['week']['sum'];?></span></div>
                <div>本月总数<span><?php  echo $total['month']['sum'];?></span></div>
            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            问题列表
        </div>
        <div class="panel-body">
            <table st-table="items" class="table table-striped table-condensed" style="display:auto;">
                <thead>
                <tr>
                    <th style="width:3em;">
                        <input type="checkbox" id="checkall"/>
                    </th>
                    <th style="width:16em;">问题</th>
                    <th style="width:5em;">分类</th>
                    <th style="width:7em;">用户</th>
                    <th style="width:5em;">价格</th>
                    <th style="width:4em;">听过</th>
                    <th style="width:4em;">赞</th>
                    <th style="width:4em;">状态</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                <?php  if(is_array($list['list'])) { foreach($list['list'] as $li) { ?>
                <tr>
                    <td><input type="checkbox" name="ids[]" value="<?php  echo $li['id'];?>"/></td>
                    <td><?php  echo $li['title'];?></td>
                    <td>
                        <?php  $category = M('category')->getInfo($li['category_id'])?>
                        <label class="label label-info"><?php  echo $category['title'];?></label>
                    </td>
                    <?php  $member = M('member')->getInfo($li['openid'])?>
                    <td><?php  echo $member['nickname'];?></td>
                    <td>
                        <label class="label label-info"><?php  echo $li['credit'];?></label>
                    </td>
                    <td><?php  echo $li['listen_num'];?></td>
                    <td><?php  echo $li['good_num'];?></td>
                    <td>
                        <label class="label label-<?php  if($li['status']==1) { ?>info<?php  } else { ?>success<?php  } ?>">
                            <?php  if($li['status']==1) { ?>未回答<?php  } else if($li['status']==2) { ?>已回答<?php  } else { ?>未支付<?php  } ?>
                        </label>
                    </td>
                    <td>
                        <a href="<?php  echo $this->createWebUrl('question',array('act'=>'edit','id'=>$li['id']))?>" class="btn btn-success btn-sm">编辑</a>
                        <a href="<?php  echo $this->createWebUrl('listen_log',array('question_id'=>$li['id']))?>" class="btn btn-warning btn-sm">偷听</a>
                        <a href="<?php  echo $this->createWebUrl('question',array('act'=>'delete','id'=>$li['id']))?>" class="btn btn-danger btn-sm">删除</a>
                    </td>
                </tr>
                <?php  } } ?>
                </tbody>
            </table>
            <?php  echo $list['pager']?>
        </div>

        <div class="panel-footer">
            <a href="<?php  echo $this->createWebUrl('question',array('act'=>'edit'))?>" class="btn btn-success">新增问题</a>
            <a data-href="<?php  echo $this->createWebUrl('question',array('act'=>'mutdelete'))?>" href="javascript:;" class="btn btn-danger mutdelete">删除选中</a>
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