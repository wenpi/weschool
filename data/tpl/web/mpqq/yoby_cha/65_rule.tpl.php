<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>

<div class='container' style='padding:0 5px 10px;margin:0;width:100%'>

    <ul class="nav nav-tabs">
        <li <?php  if($op=='display') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('user',array('op'=>'display', 'projectid'=>$projectid));?>">管理权限</a></li>
    </ul>
    <?php  if($op =='display') { ?>

    <div style="padding:15px;">
        <form id="form2" class="form-horizontal" method="post">

            <table class="table table-hover">
                <thead class="navbar-inner">
                <tr>
                    <th style="width:50px;"></th>
                    <th style="width:100px;">名称</th>
                    <th style="width:100px;">权限</th>
                </tr>
                </thead>
                <tbody>
                <?php  if(is_array($list)) { foreach($list as $item) { ?>
                <td><input type="hidden" value="<?php  echo $item['uid'];?>" name="uid[]"></td>
                <td><?php  echo $item['title'];?></td>
                <td>
                    <?php  if(is_array($table)) { foreach($table as $tb) { ?>
                    <div class="form-group">
                        <div class="col-sm-8">
                            <input type="checkbox" name="rule[]" class="form-control"
                                   value="<?php  echo $item['uid'];?>.<?php  echo $tb['id'];?>" <?php  if($item['rule'] == "*" || $item['rule'][$tb['id']] == TRUE) { ?>checked<?php  } ?>/><?php  echo $tb['title'];?>
                        </div>
                    </div>
                    <?php  } } ?>
                </td>
                </tr>

                <?php  } } ?>
                <tr>
                    <td>
                        <!--<input type="checkbox"-->
                               <!--onclick="var ck = this.checked;$(':checkbox').each(function(){this.checked = ck});"-->
                               <!--name=''>-->
                        <input name="submit" type="submit" value="提交" class="btn btn-primary span3 btn-sm"/>
                    <td></td>
                    <td></td>
                </tr>
                </tbody>
            </table>
            <input type="hidden" value="post" name="op">
            <input type="hidden" name="token" value="<?php  echo $_W['token'];?>"/>

        </form>
        <?php  echo $pager;?>
    </div>
    <?php  } else if($op == 'post') { ?>


    <div class="main">
        <form action="" method="post" class="form-horizontal form">
            <div class="panel panel-default">


                <div class="panel-body">

                    <div class="form-group">
                        <label class="col-sm-2 control-label">用户名<span style="color:red;font-size:18px">*</span></label>
                        <div class="col-sm-8">
                            <input type="text" name="user" class="form-control" value="<?php  echo $item['user'];?>"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">密码<span style="color:red;font-size:18px">*</span></label>
                        <div class="col-sm-8">
                            <input type="password" name="passwd" class="form-control" value="<?php  echo $item['passwd'];?>"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">名称</label>
                        <div class="col-sm-8">
                            <input type="text" name="title" class="form-control" value="<?php  echo $item['title'];?>"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">名称</label>
                        <div class="col-sm-8">
                            <input type="radio" name="character" class="form-control" value="ADMIN"/>管理员
                            <input type="radio" name="character" class="form-control" value="USER"/>用户
                        </div>
                    </div>
                    <!--<div class="form-group">-->
                    <!--<label class="col-sm-2 control-label">角色<span style="color:red;font-size:18px">*</span></label>-->
                    <!--<div class="col-sm-8">-->
                    <!--<input type="text" name="character" class="form-control" value="<?php  echo $item['character'];?>"/>-->
                    <!--</div>-->
                    <!--</div>-->
                    <!--<div class="form-group">-->
                    <!--<label class="col-sm-2 control-label">权限</label>-->
                    <!--<div class="col-sm-8">-->
                    <!--<input type="text" name="rule" class="form-control" value="<?php  echo $item['rule'];?>"/>-->
                    <!--</div>-->
                    <!--</div>-->

                    <div class="form-group">
                        <label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label"></label>
                        <div class="col-sm-4">
                            <input type="hidden" name="id" value="<?php  echo $item['uid'];?>">
                            <input type="hidden" name="token" value="<?php  echo $_W['token'];?>"/>
                            <input name="submit" type="submit" value="提交" class="btn btn-primary span3 btn-sm"/>
                        </div>
                    </div>

                </div>
            </div>
        </form>
    </div>
    <script type="text/javascript">
        $(function () {
            $(document).on("click", 'a.del', function () {


                $(this).parent().parent().remove();

            });
            $(document).on("click", '.checkbox', function () {

                if ($(this)[0].checked) {
                    $(this)[0].value = '1';
                } else {
                    $(this)[0].value = '0';
                }
            });
            $("#add").click(function () {
                var index = $('#zd>tr').length;
                var newRow = '<tr><td><input type="hidden" value="' + index + '" name="s[' + index + '][id]">' +
                    '<input type="text" maxlength="40" placeholder="字段名称" class="form-control" name="s[' + index + '][title]">' +
                    '</td><td><input type="text" maxlength="40" placeholder="必须是字母开头英文" class="form-control" name="s[' + index + '][var]"><td class="hidden"><input type="text" maxlength="30" value="0" class="form-control" name="s[' + index + '][orderby]"></td><td><input class="checkbox" type="checkbox"  value="0" name="s[' + index + '][isok]" ></td><td><a href="javaScript:void(0);" data-id="-1" title="删除" class="del btn btn-sm btn-danger"><span class="glyphicon glyphicon-remove" ></span></a></td></tr>';
                $("#zd").append(newRow);
            });
        });</script>
    <?php  } ?>
</div>

<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>