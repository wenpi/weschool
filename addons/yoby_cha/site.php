<?php
/**
 * 微查询模块微站定义
 *
 * @author Yoby
 * @url http://bbs.we7.cc/
 */
defined('IN_IA') or exit('Access Denied');
function is_weixin()
{
    $agent = $_SERVER ['HTTP_USER_AGENT'];
    if (!strpos($agent, "icroMessenger")) {
        return false;
    }
    return true;
}

function hidetel($phone)
{
    $IsWhat = preg_match('/(0[0-9]{2,3}[-]?[2-9][0-9]{6,7}[-]?[0-9]?)/i', $phone);
    if ($IsWhat == 1) {
        return preg_replace('/(0[0-9]{2,3}[-]?[2-9])[0-9]{3,4}([0-9]{3}[-]?[0-9]?)/i', '$1****$2', $phone);
    } else {
        return preg_replace('/(1[3587]{1}[0-9])[0-9]{4}([0-9]{4})/i', '$1****$2', $phone);
    }
}

function pager($tcount, $pindex, $psize = 15, $url = '', $context = array('before' => 5, 'after' => 4, 'ajaxcallback' => ''))
{
    global $_W;
    $pdata = array(
        'tcount' => 0,
        'tpage' => 0,
        'cindex' => 0,
        'findex' => 0,
        'pindex' => 0,
        'nindex' => 0,
        'lindex' => 0,
        'options' => ''
    );
    if ($context['ajaxcallback']) {
        $context['isajax'] = true;
    }

    $pdata['tcount'] = $tcount;
    $pdata['tpage'] = ceil($tcount / $psize);
    if ($pdata['tpage'] <= 1) {
        return '';
    }
    $cindex = $pindex;
    $cindex = min($cindex, $pdata['tpage']);
    $cindex = max($cindex, 1);
    $pdata['cindex'] = $cindex;
    $pdata['findex'] = 1;
    $pdata['pindex'] = $cindex > 1 ? $cindex - 1 : 1;
    $pdata['nindex'] = $cindex < $pdata['tpage'] ? $cindex + 1 : $pdata['tpage'];
    $pdata['lindex'] = $pdata['tpage'];

    if ($context['isajax']) {
        if (!$url) {
            $url = $_W['script_name'] . '?' . http_build_query($_GET);
        }
        $pdata['faa'] = 'href="javascript:;" onclick="p(\'' . $_W['script_name'] . $url . '\', \'' . $pdata['findex'] . '\', ' . $context['ajaxcallback'] . ')"';
        $pdata['paa'] = 'href="javascript:;" onclick="p(\'' . $_W['script_name'] . $url . '\', \'' . $pdata['pindex'] . '\', ' . $context['ajaxcallback'] . ')"';
        $pdata['naa'] = 'href="javascript:;" onclick="p(\'' . $_W['script_name'] . $url . '\', \'' . $pdata['nindex'] . '\', ' . $context['ajaxcallback'] . ')"';
        $pdata['laa'] = 'href="javascript:;" onclick="p(\'' . $_W['script_name'] . $url . '\', \'' . $pdata['lindex'] . '\', ' . $context['ajaxcallback'] . ')"';
    } else {
        if ($url) {
            $pdata['faa'] = 'href="?' . str_replace('*', $pdata['findex'], $url) . '"';
            $pdata['paa'] = 'href="?' . str_replace('*', $pdata['pindex'], $url) . '"';
            $pdata['naa'] = 'href="?' . str_replace('*', $pdata['nindex'], $url) . '"';
            $pdata['laa'] = 'href="?' . str_replace('*', $pdata['lindex'], $url) . '"';
        } else {
            $_GET['page'] = $pdata['findex'];
            $pdata['faa'] = 'href="' . $_W['script_name'] . '?' . http_build_query($_GET) . '"';
            $_GET['page'] = $pdata['pindex'];
            $pdata['paa'] = 'href="' . $_W['script_name'] . '?' . http_build_query($_GET) . '"';
            $_GET['page'] = $pdata['nindex'];
            $pdata['naa'] = 'href="' . $_W['script_name'] . '?' . http_build_query($_GET) . '"';
            $_GET['page'] = $pdata['lindex'];
            $pdata['laa'] = 'href="' . $_W['script_name'] . '?' . http_build_query($_GET) . '"';
        }
    }

    $html = '<div class="pager-left">';

    $html .= "<div class=\"pager-first\"><a {$pdata['faa']} class=\"pager-nav\">首页</a></div>";
    $html .= "<div class=\"pager-pre\"><a {$pdata['paa']} class=\"pager-nav\">上一页</a></div>";
    $html .= '</div><div class="pager-cen">
					' . $pindex . '/' . $pdata['tpage'] . '
				</div><div class="pager-right">';

    $html .= "<div class=\"pager-next\"><a {$pdata['naa']} class=\"pager-nav\">下一页</a></div>";
    $html .= "<div class=\"pager-end\"><a {$pdata['laa']} class=\"pager-nav\">尾页</a></div>";

    $html .= '</div>';
    return $html;
}

function isWxBinded($openid, $weid)
{
    $sql = "select usr.uid from ims_users as usr inner join ims_yoby_cha_user as yusr on usr.uid=yusr.uid
                    where yusr.openid ='$openid' and yusr.weid=$weid";
    $uid = pdo_fetchcolumn($sql);
    return !empty($uid);
}

class Yoby_chaModuleSite extends WeModuleSite
{

    public function doMobileIndex()
    {
        global $_GPC, $_W;
        $openid = $_W['openid'];
        $id = intval($_GPC['id']);
        $weid = $_W['uniacid'];
        $shareurl = $this->module['config']['guanzhu'];

        $pg = intval($this->module['config']['pg']);
        $yobyurl = $_W['siteroot'] . "addons/yoby_cha/template/mobile/";
        if (!empty($shareurl)) {
            $follow = pdo_fetchcolumn('SELECT follow FROM ' . tablename('mc_mapping_fans') . "  where uniacid=" . $_W['uniacid'] . " and openid='$openid' ");


            if (empty($follow)) {
                header('Location:' . $shareurl);
            }
        }

        $row = pdo_fetch("SELECT * FROM " . tablename('yoby_cha_reply') . " WHERE rid = :rid ORDER BY `id` DESC", array(':rid' => $id));
        $cid = intval($row['tb']);
        $info = json_decode(pdo_fetchcolumn('SELECT s FROM ' . tablename('yoby_cha_table') . "  where id=$cid "), 1);

        $pindex = max(1, intval($_GPC['page']));
        $psize = (empty($pg)) ? 15 : $pg;//每页面10条
        $condition = '';
        if (!empty($_GPC['keyword'])) {
            if (empty($row['is_show'])) {
                $condition .= " AND title LIKE '%" . $_GPC['keyword'] . "%'";
            } else {
                $condition .= " AND title = '" . $_GPC['keyword'] . "'";
            }


            $list = pdo_fetchall("SELECT *  FROM " . tablename('yoby_cha_data') . " WHERE cid = $cid $condition ORDER BY id DESC LIMIT " . ($pindex - 1) * $psize . ',' . $psize);//分页
            $total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('yoby_cha_data') . " WHERE cid = $cid $condition ");
            $pager = pager($total, $pindex, $psize);
        }/*else{
			$list = pdo_fetchall("SELECT *  FROM ".tablename('yoby_cha_data')." WHERE cid = $cid $condition ORDER BY id DESC LIMIT ".($pindex - 1) * $psize.','.$psize);//分页
			$total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('yoby_cha_data') . " WHERE cid = $cid $condition ");
			$pager = pager($total, $pindex, $psize);
			
			}*/
        if (!is_weixin()) {
            die('<script type="text/javascript">alert("调皮,怎么在电脑上打开呢!");</script>');
        }
        include $this->template('index');

    }

    public function doMobileLogin(){
        global $_W, $_GPC;
        $weid = $_W['uniacid'];
        $op = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
        $shareurl = $this->module['config']['guanzhu'];
        $yobyurl = $_W['siteroot'] . "addons/yoby_cha/template/mobile/";

        if ('post' == $op) {//添加或修改
            $user = $_GPC['user'];
            $passwd = $_GPC['passwd'];

            if (checksubmit('submit')) {
                $sql = "select usr.uid, usr.password from ims_users as usr inner join ims_yoby_cha_user as yusr on usr.uid=yusr.uid
                    where usr.username='$user' and yusr.weid=$weid";
                $userObj = pdo_fetch($sql);

                if( empty($userObj) ){
                    message('用户名密码错误！', '', 'error');
                    include $this->template('login');
                }
                else{
                    var_dump(user_hash($passwd, ''), $userObj['password']);
                    if(user_hash($passwd, '') == $userObj['password']) {
                        pdo_update('yoby_cha_user', array('openid' => $_W['openid'], ), array('uid' => $userObj['uid']));
//                        include $this->template('login');
                        message('绑定成功！', $this->createWebUrl('login', array('op' => 'bindok')), 'success');
                    }
                    else{
                        include $this->template('login');
                        $_GPC['op'] = "display";
                        message('绑定失败！', $this->createWebUrl('login', array('op' => 'display')), 'success');
                    }
                }
            }
        } else if ('display' == $op) {//显示
            $item = [];
            include $this->template('login');
        }
    }

    public function doMobileLine(){
        global $_W, $_GPC;
        $weid = $_W['uniacid'];
        $op = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
        $shareurl = $this->module['config']['guanzhu'];
        $yobyurl = $_W['siteroot'] . "addons/yoby_cha/template/mobile/";
        $redirect = '';
        $instance = NULL;

        if( !isWxBinded($_W['openid'], $weid) ){
            $op = 'redirect';
            $redirect = "http://www.9kpu.com/app/index.php?i=$weid&c=entry&op=display&do=login&m=yoby_cha";
        }
        else{

            if($op == 'check_once'){
                $timecreate = time();
                pdo_insert('yoby_cha_check', array('uid'=>$_GPC['uid'], 'weid' => $weid, 'checkid' => $_GPC['id'], 'type' => $_GPC['type'], 'timecreate' => $timecreate));//添加数据
            }
            else {
                $key = $_GPC['keyword'];
                if (!empty($_GPC['keyword'])) {
                    $queryRule = "select usr.uid, rule.value, usr.projectid from " . tablename('yoby_cha_user') . " as usr 
                    inner join " . tablename('yoby_cha_rule') . " as rule on usr.uid=rule.uid 
                     where usr.openid='" . $_W['openid'] . "' and rule.type='DB'";
                    $result = pdo_fetch($queryRule);
                    if (!count($result['value'])) {
                        $op = 'failed';
                    } else {
                        //find
                        $projectid = $result['projectid'];
                        $rule = $result['value'];
                        $queryIns = "select tb.s, dt.bl, tb.type from " . tablename('yoby_cha_data') . " as dt 
                            inner join " . tablename('yoby_cha_table') . " as tb on dt.cid=tb.id where dt.title='$key' and dt.weid=$weid and dt.projectid=$projectid";
                        if ($rule != '*') {
                            $queryIns .= " and cid in($rule)";
                        }
                        $ins = pdo_fetch($queryIns);
                        if (empty($ins)) {
                            $op = 'failed';
                        } else {
                            $op = 'ok';
                            $mapping = [];
                            $s = json_decode($ins['s'], 1);
                            $bl = json_decode($ins['bl'], 1);
                            for ($i = 0; $i < count($s); $i++) {
                                $mapping[$s[$i]['var']] = $bl[$i];
                            }
                            $instance = $mapping;
                            $type = $ins['type'];
                            $id = $mapping['productlot'] || $mapping['orderno'] || $mapping['localmac'];
                            $uid = $result['uid'];
                        }
                    }
                }
            }
        }

        include $this->template('line');
    }

    public function doWebTable()
    {//管理字段
        global $_W, $_GPC;
        $weid = $_W['uniacid'];
        $op = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
        $projectid = !empty($_GPC['projectid']) ? $_GPC['projectid'] : $projectid;
        load()->func('tpl');
        if ('post' == $op) {//添加或修改
            $id = intval($_GPC['id']);
            if (!empty($id)) {
                $item = pdo_fetch("SELECT * FROM " . tablename('yoby_cha_table') . " where id=$id and projectid='$projectid'");
                empty($item) ? message('数据不存在！', '', 'error') : "";
            }

            if (checksubmit('submit')) {
                empty ($_GPC['title']) ? message('名称不能为空') : $title = $_GPC['title'];
                $desc = $_GPC['desc'];
                $createtime = time();
                if (!empty($_GPC['s'])) {
                    $s = $_GPC['s'];
                    foreach ($s as $k) {
                        if (empty($k['title'])) {
                            message('亲,自定义字段名不能为空');
                        }
                        if (empty($k['var'])) {
                            message('亲,自定义变量名不能为空');
                        }
                    }
                }

                $s = json_encode($_GPC['s']);//自定义字段数组
                if (empty($id)) {
                    pdo_insert('yoby_cha_table', array('projectid'=>$projectid, 'weid' => $weid, 'title' => $title, 'desc' => $desc, 'createtime' => $createtime, 's' => $s));//添加数据
                    message('添加成功！', $this->createWebUrl('table', array('op' => 'display', 'projectid'=>$projectid, )), 'success');
                } else {
                    //dump($_GPC);
                    pdo_update('yoby_cha_table', array('title' => $title, 'desc' => $desc, 'createtime' => $createtime, 's' => $s), array('id' => $id));
                    message('更新成功！', $this->createWebUrl('table', array('op' => 'display', 'projectid'=>$projectid, )), 'success');
                }


            } else {
                include $this->template('table');
            }

        } else if ('del' == $op) {//删除


            if (isset($_GPC['delete'])) {
                $ids = implode(",", $_GPC['delete']);
                $sqls = "delete from  " . tablename('yoby_cha_table') . "  where id in(" . $ids . ")";
                pdo_query($sqls);
                message('删除成功！', referer(), 'success');
            }
            $id = intval($_GPC['id']);
            $row = pdo_fetch("SELECT id FROM " . tablename('yoby_cha_table') . " WHERE id = :id and projectid='$projectid'", array(':id' => $id));
            if (empty($row)) {
                //dump($_GPC);
                message('抱歉，数据已经被删除！', $this->createWebUrl('table', array('op' => 'display')), 'error');
            }
            pdo_delete('yoby_cha_table', array('id' => $id, 'projectid'=>$projectid));
            message('删除成功！', referer(), 'success');

        } else if ('display' == $op) {//显示
            $pindex = max(1, intval($_GPC['page']));
            $psize = 20;//每页显示

            $list = pdo_fetchall("SELECT *  FROM " . tablename('yoby_cha_table') . " where weid=$weid and projectid='$projectid'  ORDER BY id DESC LIMIT " . ($pindex - 1) * $psize . ',' . $psize);//分页
            $total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('yoby_cha_table') . "  where weid=$weid and projectid='$projectid'");
            $pager = pagination($total, $pindex, $psize);
            include $this->template('table');
        }

    }

    public function doWebProject()
    {//管理字段
        global $_W, $_GPC;
        $weid = $_W['uniacid'];
        $op = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
        load()->func('tpl');

        if ('post' == $op) {//添加或修改
            $id = intval($_GPC['id']);
            if (!empty($id)) {
                $item = pdo_fetch("SELECT * FROM " . tablename('yoby_cha_project') . " where projectid=$id");
                empty($item) ? message('亲,数据不存在！', '', 'error') : "";
            }


            if (checksubmit('submit')) {
                empty ($_GPC['title']) ? message('亲,名称不能为空') : $title = $_GPC['title'];
                $desc = $_GPC['desc'];
                $timecreate = time();
                if (!empty($_GPC['s'])) {
                    $s = $_GPC['s'];
                    foreach ($s as $k) {
                        if (empty($k['title'])) {
                            message('亲,自定义字段名不能为空');
                        }
                        if (empty($k['var'])) {
                            message('亲,自定义变量名不能为空');
                        }
                    }
                }

//                $lineTable = "CREATE TABLE `ims_yoby_cha_line%NAME%` (
//                          `localmac` varchar(64) NOT NULL DEFAULT '' COMMENT '本端物理端口',
//                          `remotemac` varchar(64) NOT NULL DEFAULT '' COMMENT '对端物理端口',
//                          `info` varchar(64) NOT NULL DEFAULT '' COMMENT '解读信息',
//                          `link` varchar(64) NOT NULL DEFAULT '' COMMENT '线缆',
//                          `len` decimal(8, 2) NOT NULL DEFAULT 0.0 COMMENT '长度',
//                          `material` varchar(8) NOT NULL DEFAULT '' COMMMENT '材质',
//                          `module` varchar(16) NOT NULL DEFAULT '' COMMENT '型号',
//                          `supply` varchar(16) NOT NULL DEFAULT '' COMMENT '供应端',
//                          `timedeploy` int(10)  NOT NULL DEFAULT 0 COMMENT '布放时间',
//                          PRIMARY KEY (`localmac`)
//                        ) ENGINE=MyISAM DEFAULT CHARSET=utf8;";
                $lineTable = "[{\"id\":\"0\", \"var\":\"localmac\", \"orderby\":\"0\", \"title\":\"本端物理端口\",\"isok\":\"1\"},{\"id\":\"1\", \"var\":\"remotemac\", \"orderby\":\"0\", \"title\":\"对端物理端口\"},{\"id\":\"2\", \"var\":\"info\", \"orderby\":\"0\", \"title\":\"解读信息\"},{\"id\":\"3\", \"var\":\"link\", \"orderby\":\"0\", \"title\":\"线缆\"},{\"id\":\"4\", \"var\":\"len\", \"orderby\":\"0\", \"title\":\"长度\"},{\"id\":\"5\", \"var\":\"material\", \"orderby\":\"0\", \"title\": \"材质\"},{\"id\":\"6\", \"var\":\"module\", \"orderby\":\"0\", \"title\":\"型号\"},{\"id\":\"7\", \"var\":\"supply\", \"orderby\":\"0\", \"title\":\"供应端\"},{\"id\":\"8\", \"var\":\"timedeploy\", \"orderby\":\"0\", \"title\":\"布放时间\"}]";
//                $packTable = "CREATE TABLE `ims_yoby_cha_pack%NAME%` (
//                          `orderno` varchar(64) NOT NULL DEFAULT '' COMMENT '订单号',
//                          `deliverydate` varchar(64) NOT NULL DEFAULT '' COMMENT '发货日期',
//                          `amount` varchar(64) NOT NULL DEFAULT '' COMMENT '数量',
//                          `packno` varchar(64) NOT NULL DEFAULT '' COMMENT '装箱单号',
//                          `len` decimal(8, 2) NOT NULL DEFAULT 0.0 COMMENT '长度',
//                          `module` varchar(16) NOT NULL DEFAULT '' COMMENT '型号',
//                          `linecategory` varchar(8) NOT NULL DEFAULT '' COMMMENT '线材类型',
//                          `jointcategory`  varchar(16) NOT NULL DEFAULT '' COMMMENT '接口类型',
//                          `productarea`  varchar(16) NOT NULL DEFAULT '' COMMMENT '产品产地',
//                          `productstand` varchar(16) NOT NULL DEFAULT '' COMMENT '产品规格',
//                          `productsupplier` varchar(16)  NOT NULL DEFAULT 0 COMMENT '供应商',
//                          `timedeploy` int(10)  NOT NULL DEFAULT 0 COMMENT '布放时间',
//                          `constructteam` varchar(32) NOT NULL DEFAULT 0 COMMENT '施工队',
//                          PRIMARY KEY (`orderno`)
//                        ) ENGINE=MyISAM DEFAULT CHARSET=utf8;";
                $packTable = "[{\"id\":\"0\", \"var\": \"orderno\", \"title\": \"订单号\",\"isok\":\"1\"},{\"id\":\"1\", \"var\": \"deliverydate\", \"title\": \"发货日期\"},{\"id\":\"2\", \"var\": \"amount\", \"title\": \"数量\"},{\"id\":\"3\", \"var\": \"packno\", \"title\": \"装箱单号\"},{\"id\":\"4\", \"var\": \"len\", \"title\": \"长度\"},{\"id\":\"5\", \"var\": \"module\", \"title\": \"型号\"},{\"id\":\"6\", \"var\": \"linecategory\", \"title\": \"线材类型\"},{\"id\":\"7\", \"var\": \"jointcategory\", \"title\": \"接口类型\"},{\"id\":\"8\", \"var\": \"productarea\", \"title\": \"产品产地\"},{\"id\":\"9\", \"var\": \"productstand\", \"title\": \"产品规格\"},{\"id\":\"10\", \"var\": \"productsupplier\", \"title\": \"供应商\"},{\"id\":\"11\", \"var\": \"timedeploy\", \"title\": \"布放时间\"},{\"id\":\"12\", \"var\": \"constructteam\", \"title\": \"施工队\"}]";
//                $devTable = "CREATE TABLE `ims_yoby_cha_device%NAME%` (
//                          `department` varchar(64) NOT NULL DEFAULT '' COMMENT '设备隶属部门',
//                          `maintain` varchar(64) NOT NULL DEFAULT '' COMMENT '设备维护人',
//                          `contact` varchar(64) NOT NULL DEFAULT '' COMMENT '维护人联系方式',
//                          `agent` varchar(64) NOT NULL DEFAULT '' COMMENT '经办人',
//                          `productlot` varchar(64) NOT NULL DEFAULT '' COMMENT '设备产生批号',
//                          `purchasedate` int(10) NOT NULL DEFAULT 0 COMMENT '设备采购日期',
//                          `productarea`  varchar(16) NOT NULL DEFAULT '' COMMMENT '产品产地',
//                          `purchaseamount` decimal(18,2) NOT NULL DEFAULT 0 COMMMENT '采购金额',
//                          `inqualityguard`  tinyint NOT NULL DEFAULT 0 COMMMENT '质保期内',
//                          `depreciable` int(10) NOT NULL DEFAULT 0 COMMENT '折旧年限',
//                          `depreciableamount` decimal(18,2) NOT NULL DEFAULT 0.0 COMMENT '折旧金额',
//                          `netsalvage` decimal(18,2) NOT NULL DEFAULT 0.0 COMMENT '净残值',
//                          `memory` varchar(32)  NOT NULL DEFAULT 0 COMMENT '内存',
//                          `harddisk` varchar(32)  NOT NULL DEFAULT 0 COMMENT '硬盘',
//                          `network` varchar(32)  NOT NULL DEFAULT 0 COMMENT '网卡',
//                          `CPU` varchar(32) NOT NULL DEFAULT 0 COMMENT 'CPU',
//                          PRIMARY KEY (`productlot`)
//                        ) ENGINE=MyISAM DEFAULT CHARSET=utf8;";
                $devTable = "[{\"id\": \"0\", \"var\": \"productlot\", \"title\": \"设备产生批号\",\"isok\":\"1\"}{\"id\": \"1\", \"var\": \"department\", \"title\": \"设备隶属部门\"},{\"id\": \"2\", \"var\": \"maintain\", \"title\": \"设备维护人\"},{\"id\": \"3\", \"var\": \"contact\", \"title\": \"维护人联系方式\"},{\"id\": \"4\", \"var\": \"agent\", \"title\": \"经办人\"},{\"id\": \"5\", \"var\": \"purchasedate\", \"title\": \"设备采购日期\"},{\"id\": \"6\", \"var\": \"productarea\", \"title\": \"产品产地\"},{\"id\": \"7\", \"var\": \"purchaseamount\", \"title\": \"采购金额\"},{\"id\": \"8\", \"var\": \"inqualityguard\", \"title\": \"质保期内\"},{\"id\": \"9\", \"var\": \"depreciable\", \"title\": \"折旧年限\"},{\"id\": \"10\", \"var\": \"depreciableamount\", \"title\": \"折旧金额\"},{\"id\": \"11\", \"var\": \"netsalvage\", \"title\": \"净残值\"},{\"id\": \"12\", \"var\": \"memory\", \"title\": \"内存\"},{\"id\": \"13\", \"var\": \"harddisk\", \"title\": \"硬盘\"},{\"id\": \"14\", \"var\": \"network\", \"title\": \"网卡\"},{\"id\": \"15\", \"var\": \"CPU\", \"title\": \"CPU\"}]";

                $s = json_encode($_GPC['s']);//自定义字段数组
                if (empty($id)) {
                    $result = pdo_insert('yoby_cha_project', array('weid' => $weid, 'title' => $title, 'desc' => $desc, 'timecreate' => $timecreate));//添加数据

                    if (!empty($result)) {
                        $projectid = pdo_insertid();
                        pdo_insert('yoby_cha_table', array('type'=>'LINE', 'weid' => $weid, 'title' => '线材', 'projectid' => $projectid, 'createtime' => $timecreate, 's'=>$lineTable));
                        pdo_insert('yoby_cha_table', array('type'=>'PACK', 'weid' => $weid, 'title' => '装箱单', 'projectid' => $projectid, 'createtime' => $timecreate, 's'=>$packTable));
                        pdo_insert('yoby_cha_table', array('type'=>'DEV', 'weid' => $weid, 'title' => '设备', 'projectid' => $projectid, 'createtime' => $timecreate, 's'=>$devTable));
                    }
                    message('添加成功！', $this->createWebUrl('project', array('op' => 'display')), 'success');
                } else {
                    //dump($_GPC);
                    pdo_update('yoby_cha_table', array('title' => $title, 'desc' => $desc, 'timecreate' => $timecreate), array('projectid' => $id));
                    message('更新成功！', $this->createWebUrl('project', array('op' => 'display')), 'success');
                }


            } else {
                include $this->template('project');
            }

        } else if ('del' == $op) {//删除


            if (isset($_GPC['delete'])) {
                $ids = implode(",", $_GPC['delete']);
                $sqls = "delete from  " . tablename('yoby_cha_project') . "  where projectid in(" . $ids . ")";
                pdo_query($sqls);
                message('删除成功！', referer(), 'success');
            }
            $id = intval($_GPC['id']);
            $row = pdo_fetch("SELECT projectid FROM " . tablename('yoby_cha_project') . " WHERE projectid = :id", array(':id' => $id));
            if (empty($row)) {
                //dump($_GPC);
                message('抱歉，数据已经被删除！', $this->createWebUrl('project', array('op' => 'display')), 'error');
            }
            pdo_delete('yoby_cha_project', array('projectid' => $id));
            pdo_delete('yoby_cha_project', array('projectid' => $id));
            message('删除成功！', referer(), 'success');

        } else if ('display' == $op) {//显示
            global $isRoot;
            $isRoot = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('yoby_cha_rule')." where weid=$weid");
            if(!$isRoot){
                pdo_insert('yoby_cha_rule',  array('uid'=>$_W['uid'], 'weid'=>$weid, 'type'=>'PRJ', 'value'=>"*"));
            }

            $sql = "select `value` from ".tablename('yoby_cha_rule')." where weid=$weid and uid=".$_W["uid"]." and type='PRJ'";
            $ruleList = pdo_fetchall($sql);

            $projectRules = [];
            $isRoot = FALSE;
            for($i=0; $i<count($ruleList); $i++){
                $v = $ruleList[$i];
                if($v['value'] == '*'){
                    $projectRules = '*';
                    $isRoot = TRUE;
                    break;
                }
                else{
                    $isRoot = FALSE;
                    array_push($projectRules, $v['value']);
                }
            }

            $pindex = max(1, intval($_GPC['page']));
            $psize = 20;//每页显示

            if($isRoot == FALSE and !count($projectRules) ){
                $list = [];
                $total = 0;
                $pager = pagination($total, $pindex, $psize);
                include $this->template('project');
            }
            else {
                $query = '';
                $count = '';
                if ($projectRules == '*') {
                    $query = "SELECT *  FROM " . tablename('yoby_cha_project') . " where weid=$weid  ORDER BY projectid DESC LIMIT " . ($pindex - 1) * $psize . ',' . $psize;
                    $count = 'SELECT COUNT(*) FROM ' . tablename('yoby_cha_project') . "  where weid=$weid";
                } else {
                    $query = "SELECT *  FROM " . tablename('yoby_cha_project') . " where weid=$weid and projectid in(" . implode("','", $projectRules) . ")  ORDER BY projectid DESC LIMIT " . ($pindex - 1) * $psize . ',' . $psize;
                    $count = 'SELECT COUNT(*) FROM ' . tablename('yoby_cha_project') . "  where weid=$weid and projectid in(" . implode("','", $projectRules) . ")";
                }

                $list = pdo_fetchall($query);//分页
                $total = pdo_fetchcolumn($count);
                $pager = pagination($total, $pindex, $psize);
                include $this->template('project');
            }
        }
    }

    public function doWebUser()
    {//管理字段
        global $_W, $_GPC;
        global $projectid;
        $weid = $_W['uniacid'];
        $op = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
        $projectid = !empty($_GPC['projectid']) ? $_GPC['projectid'] : $projectid;
        load()->func('tpl');

        if ('post' == $op) {//添加或修改
            $id = intval($_GPC['id']);
            if (!empty($id)) {
                $sql = "select usr.uid, usr.username as `user`, yusr.title, yusr.timecreate from ims_users as usr inner join ims_yoby_cha_user as yusr on usr.uid=yusr.uid 
                    where usr.uid=$id";
                $item = pdo_fetch($sql);
                empty($item) ? message('亲,数据不存在！', '', 'error') : "";
            }

            if (checksubmit('submit')) {
                empty ($_GPC['user']) ? message('亲,用户名不能为空') : $user = $_GPC['user'];
                $title = $_GPC['title'];
                $user = $_GPC['user'];
                $character = $_GPC['character'];
                $passwd = user_hash($_GPC['passwd'],'');
                $timecreate = time();

                $isUser = ($character == 'USER');

                if (empty($id)) {
                    $result = pdo_insert('users', array('groupid'=>3, 'status'=>2, 'password' => $passwd, 'username' => $user));//添加数据
                    if (!empty($result)) {
                        $uid = pdo_insertid();
                        pdo_insert('yoby_cha_user', array('character'=>$character, 'uid' => $uid, 'projectid'=>$projectid, 'title'=>$title, 'weid'=>$weid, 'timecreate'=>$timecreate));//添加数据
                        pdo_insert('yoby_cha_rule', array('uid'=>$uid, 'type'=>'PRJ', 'value'=>$projectid, 'weid'=>$weid));
                        pdo_insert('yoby_cha_rule', array('uid'=>$uid, 'type'=>'DB', 'value'=>'*', 'weid'=>$weid));
                        message('添加成功', $this->createWebUrl('user', array('op' => 'display', 'projectid'=>$projectid)), 'success');
                    }
                    else{
                        message('添加失败！', $this->createWebUrl('user', array('op' => 'display', 'projectid'=>$projectid)), 'failed');
                    }
                } else {
                    //dump($_GPC);
                    pdo_update('users', array('password' => $passwd, 'username' => $user, ), array('uid' => $id));
                    pdo_update('yoby_cha_user', array('title' => $title, ), array('uid' => $id));
                    message('更新成功！', $this->createWebUrl('user', array('op' => 'display', 'projectid'=>$projectid)), 'success');
                }


            } else {
                include $this->template('user');
            }
        } else if ('del' == $op) {//删除


            if (isset($_GPC['delete'])) {
                $ids = implode(",", $_GPC['delete']);
                $sqls = "delete from  " . tablename('yoby_cha_user') . "  where uid in(" . $ids . ")";
                pdo_query($sqls);
                $sqls = "delete from  " . tablename('user') . "  where id in(" . $ids . ")";
                pdo_query($sqls);
                message('删除成功！', referer(), 'success');
            }
            $id = intval($_GPC['id']);
            $row = pdo_fetch("SELECT uid FROM " . tablename('yoby_cha_user') . " WHERE uid = :id", array(':id' => $id));
            if (empty($row)) {
                //dump($_GPC);
                message('抱歉，数据已经被删除！', $this->createWebUrl('user', array('op' => 'display', 'projectid'=>$projectid)), 'error');
            }
            pdo_delete('yoby_cha_user', array('uid' => $id));
            pdo_delete('users', array('uid' => $id));
            message('删除成功！', referer(), 'success');

        } else if ('display' == $op) {//显示
            $pindex = max(1, intval($_GPC['page']));
            $psize = 20;//每页显示

            $sql = "select usr.uid, usr.username as `user`, yusr.title, yusr.timecreate from ims_users as usr inner join ims_yoby_cha_user as yusr on usr.uid=yusr.uid
              where yusr.weid=$weid and projectid=$projectid ORDER BY uid DESC LIMIT " . ($pindex - 1) * $psize . ',' . $psize;
            $count = "SELECT COUNT(uid) FROM " . tablename('yoby_cha_user')." where weid=$weid and projectid=$projectid";

            $list = pdo_fetchall($sql);
            $total = pdo_fetchcolumn($count);
            $pager = pagination($total, $pindex, $psize);
            include $this->template('user');
        }
    }

    public function doWebRule()
    {//管理字段
        global $_W, $_GPC;
        global $projectid;
        $weid = $_W['uniacid'];
        $op = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
        $projectid = !empty($_GPC['projectid']) ? $_GPC['projectid'] : $projectid;
        load()->func('tpl');

        if ('post' == $op) {//添加或修改
            $uids = $_GPC['uid'];
            $rules = [];

            foreach ($_GPC['rule'] as &$v) {
                $ary = explode(".", $v);
                $key = $ary[0];
                if(empty($rules[$key])){
                    $rules[$key] = [];
                }

                array_push($rules[$key], $ary[1]);
            }

            for($i=0; $i<count($uids); $i++){
                $uid = $uids[$i];
                $rule = '';
                if(count($rules[$uid])) {
                    $rule = implode(",", $rules[$uid]);
                }

                pdo_update('yoby_cha_rule', array('value' => $rule, ), array('uid' => $uid, 'type'=>'DB', 'weid'=>$weid));
            }
            message('更新成功！', $this->createWebUrl('rule', array('op' => 'display', 'projectid'=>$projectid)), 'success');
        }
        else if ('display' == $op) {//显示
            $pindex = max(1, intval($_GPC['page']));
            $psize = 20;//每页显示

            $queryTable = "select id,title from ".tablename('yoby_cha_table')." where weid=$weid and projectid=$projectid";
            $queryUser = "select usr.uid, usr.title, rule.value from ".tablename('yoby_cha_user')." as usr left join ".tablename('yoby_cha_rule')." as rule on usr.uid=rule.uid where type='DB' and rule.weid=$weid and projectid=$projectid";

            $count = "select count(usr.uid) from ".tablename('yoby_cha_user')." as usr left join ".tablename('yoby_cha_rule')." as rule on usr.uid=rule.uid where rule.weid=$weid and projectid=$projectid";

            $table = pdo_fetchall($queryTable);
            $list = pdo_fetchall($queryUser);
            $total = pdo_fetchcolumn($count);

            for($i=0;$i<count($list); $i++){
                $v = &$list[$i];
                if($v['value'] == '*'){
                    $v['rule'] = '*';
                }
                else{
                    $ary = explode(",", $v['value']);
                    $v['rule'] = [];
                    foreach ($ary as &$arr) {
                        $v['rule'][$arr] = TRUE;
                    }
                }
            }

            $pager = pagination($total, $pindex, $psize);
            include $this->template('rule');
        }
    }

    public function doWebGl()
    {//管理被查询数据
        global $_W, $_GPC;
        $weid = $_W['uniacid'];
        $cid = intval($_GPC['cid']);
        $projectid = !empty($_GPC['projectid']) ? $_GPC['projectid'] : $projectid;
        var_dump('SELECT s FROM ' . tablename('yoby_cha_table') . "  where id=$cid  and projectid='$projectid'");
        $fields = pdo_fetchcolumn('SELECT s FROM ' . tablename('yoby_cha_table') . "  where id=$cid  and projectid='$projectid'");
        $info = json_decode($fields, 1);
        $op = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
        load()->func('tpl');
        if ('post' == $op) {//添加或修改
            $id = intval($_GPC['id']);

            if (!empty($id)) {
                $item = pdo_fetch("SELECT * FROM " . tablename('yoby_cha_data') . " where id=$id and projectid='$projectid'");
                empty($item) ? message('亲,数据不存在！', '', 'error') : "";
            }


            if (checksubmit('submit')) {
                $title = $_GPC['title'];
                $title0 = '';
                foreach ($info as $k4 => $v4) {
                    if ($v4['isok'] == 1) {
                        $title0 .= $title[$k4] . "";
                    }

                }
                $createtime = time();

                if (empty($id)) {
                    pdo_insert('yoby_cha_data', array('projectid'=>$projectid, 'cid' => $cid, 'title' => $title0, 'bl' => json_encode($title)));//添加数据
                    message('添加成功！', $this->createWebUrl('gl', array('op' => 'display', 'cid' => $cid, 'projectid'=>$projectid)), 'success');
                } else {
                    //
                    pdo_update('yoby_cha_data', array('projectid'=>$projectid, 'cid' => $cid, 'title' => $title0, 'bl' => json_encode($title)), array('id' => $id));
                    message('更新成功！', $this->createWebUrl('gl', array('op' => 'display', 'cid' => $cid, 'projectid'=>$projectid)), 'success');
                }


            } else {
                include $this->template('gl');
            }

        } else if ('del' == $op) {//删除


            if (isset($_GPC['delete'])) {
                $ids = implode(",", $_GPC['delete']);
                $sqls = "delete from  " . tablename('yoby_cha_data') . "  where id in(" . $ids . ")";
                pdo_query($sqls);
                message('删除成功！', referer(), 'success');
            }
            $id = intval($_GPC['id']);
            $row = pdo_fetch("SELECT id FROM " . tablename('yoby_cha_data') . " WHERE id = :id", array(':id' => $id));
            if (empty($row)) {
                //dump($_GPC);
                message('抱歉，数据已经被删除！', $this->createWebUrl('gl', array('op' => 'display', 'cid' => $cid, 'projectid'=>$projectid)), 'error');
            }
            pdo_delete('yoby_cha_data', array('id' => $id));
            message('删除成功！', referer(), 'success');

        } else if ('display' == $op) {//显示
            $condition = ' ';
            if (!empty($_GPC['keyword'])) {

                $condition .= "  and  title   LIKE '%" . $_GPC['keyword'] . "%' ";

            }
            $pindex = max(1, intval($_GPC['page']));
            $psize = 20;//每页显示

            $list = pdo_fetchall("SELECT *  FROM " . tablename('yoby_cha_data') . " where cid=$cid $condition and projectid='$projectid' ORDER BY id DESC LIMIT " . ($pindex - 1) * $psize . ',' . $psize);//分页
            $total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('yoby_cha_data') . "  where cid=$cid $condition and projectid='$projectid'");
            $pager = pagination($total, $pindex, $psize);
            include $this->template('gl');
        }

    }

    public function doWebQ()
    {//清空数据
        global $_W, $_GPC;
        $weid = $_W['uniacid'];
        $cid = $_GPC['cid'];
        pdo_delete('yoby_cha_data', array('cid' => $cid));
        message('清空数据成功！', referer(), 'success');
    }

    public function doWebDao()
    {//导入模板
        global $_W, $_GPC;
        $weid = $_W['uniacid'];
        $projectid = !empty($_GPC['projectid']) ? $_GPC['projectid'] : $projectid;
        $cid = intval($_GPC['cid']);
        $op = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
        $data = pdo_fetch("SELECT *  FROM " . tablename('yoby_cha_table') . " WHERE id =" . $cid);
        $s = json_decode($data['s'], 1);
        if ('exe' == $op) {

            require IA_ROOT . '/framework/library/phpexcel/PHPExcel.php';
            require IA_ROOT . '/framework/library/phpexcel/PHPExcel/IOFactory.php';
            require IA_ROOT . '/framework/library/phpexcel/PHPExcel/Reader/Excel5.php';


            if (checksubmit('submit')) {
                $filename = $_FILES['teacherx']['name'];
                if (empty($filename)) {
                    message('请上传excel文件', '', 'error');
                }
                $tmp_name = $_FILES['teacherx']['tmp_name'];
                $ext = strtolower(pathinfo($filename, 4));
                if ($ext != 'xls') {
                    message('不是excel文件,请上传正确格式', '', 'error');
                }
                $temp = (defined('SAE_TMP_PATH')) ? SAE_TMP_PATH : ATTACHMENT_ROOT;//判断是否sae,是的话就上传到临时目录
                $new = $temp . "/" . time() . "." . $ext;
                if (is_uploaded_file($tmp_name)) {
                    move_uploaded_file($tmp_name, $new);

                    $objReader = PHPExcel_IOFactory::createReader('Excel5');
                    $objPHPExcel = $objReader->load($new);
                    $sheet = $objPHPExcel->getSheet(0);
                    $highestRow = $sheet->getHighestRow();           //取得总行数
                    $highestColumn = $sheet->getHighestColumn(); //取得总列数

                    for ($j = 2; $j <= $highestRow; $j++) {
                        for ($k = 'A'; $k <= $highestColumn; $k++) {
                            //$str .= iconv('utf-8','gbk',$objPHPExcel->getActiveSheet()->getCell("$k$j")->getValue()).'\\';
                            $str .= mb_convert_encoding($objPHPExcel->getActiveSheet()->getCell("$k$j")->getValue(), "utf-8", 'auto') . '\\';
                        }
                        $strs = explode("\\", $str);
                        array_pop($strs);

                        $title0 = '';
                        foreach ($s as $k4 => $v4) {
                            if ($v4['isok'] == 1) {
                                $title0 .= $strs[$k4] . "";
                            }

                        }


                        $data = array(
                            'cid' => $cid,
                            'weid' => $weid,
                            'title' => $title0,
                            'projectid' => $projectid,
                            'bl' => json_encode($strs)
                        );
                        pdo_insert('yoby_cha_data', $data);
                        $str = "";
                    }
                    unlink($new);
                    message('导入成功！', $this->createWebUrl('gl', array('op' => 'display', 'cid' => $cid, 'projectid'=>$projectid)), 'success');
                }
            } else {
                message('没有上传excel！', '', 'error');
            }


        } else {
            include $this->template('dao');
        }
    }

    public function doWebDaochu()
    {//导出模板
        global $_W, $_GPC;
        require IA_ROOT . '/framework/library/phpexcel/PHPExcel.php';
        require IA_ROOT . '/framework/library/phpexcel/PHPExcel/IOFactory.php';
        require IA_ROOT . '/framework/library/phpexcel/PHPExcel/Reader/Excel5.php';
        $weid = $_W['uniacid'];
        $cid = intval($_GPC['cid']);

        $data = pdo_fetch("SELECT *  FROM " . tablename('yoby_cha_table') . " WHERE id =" . $cid);
        $s = json_decode($data['s'], 1);
        $resultPHPExcel = new PHPExcel();
        $i = 1;
        $arr = range('A', 'Z');

        foreach ($s as $k => $v) {
            $resultPHPExcel->getActiveSheet()->setCellValue($arr[$k] . $i, $v['title']);

        }


        $obj_Writer = PHPExcel_IOFactory::createWriter($resultPHPExcel, 'Excel5');
        $filename = date('Y-m-d', time()) . $data['title'] . ".xls";

        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header('Content-Disposition:inline;filename="' . $filename . '"');
        header("Content-Transfer-Encoding: binary");
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Pragma: no-cache");

        $objProps = $resultPHPExcel->getProperties();
        $objProps->setCreator("by-yoby");
        $obj_Writer->save('php://output');


    }

    public function doWebChu()
    {//导出模板
        global $_W, $_GPC;
        require IA_ROOT . '/framework/library/phpexcel/PHPExcel.php';
        require IA_ROOT . '/framework/library/phpexcel/PHPExcel/IOFactory.php';
        require IA_ROOT . '/framework/library/phpexcel/PHPExcel/Reader/Excel5.php';
        $weid = $_W['uniacid'];
        $cid = intval($_GPC['cid']);

        $data = pdo_fetch("SELECT *  FROM " . tablename('yoby_cha_table') . " WHERE id =" . $cid);
        $s = json_decode($data['s'], 1);
        $resultPHPExcel = new PHPExcel();
        $ii = 1;
        $arr = range('A', 'Z');

        foreach ($s as $k => $v) {
            $resultPHPExcel->getActiveSheet()->setCellValue($arr[$k] . $ii, $v['title']);

        }
        $data1 = pdo_fetchall("SELECT bl  FROM " . tablename('yoby_cha_data') . " WHERE cid =" . $cid);

        $i = 2;
        foreach ($data1 as $ks => $item) {
            $bl = json_decode($item['bl'], 1);
            foreach ($bl as $k2 => $a2) {
                $resultPHPExcel->getActiveSheet()->setCellValue($arr[$k2] . $i, $a2);

            }
            $i++;
        }


        $obj_Writer = PHPExcel_IOFactory::createWriter($resultPHPExcel, 'Excel5');
        $filename = date('Y-m-d', time()) . $data['title'] . ".xls";

        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header('Content-Disposition:inline;filename="' . $filename . '"');
        header("Content-Transfer-Encoding: binary");
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Pragma: no-cache");

        $objProps = $resultPHPExcel->getProperties();
        $objProps->setCreator("by-yoby");
        $obj_Writer->save('php://output');


    }

}