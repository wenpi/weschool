<?php
global $_W;
$nowtime=time();
$school_id=pdo_fetchcolumn("select school_id from {$table_pe}lianhu_school where   1=1  limit 1 ");
$this->update('lianhu_student',array('school_id'=>$school_id),array('status'=>1));
pdo_run($sql);