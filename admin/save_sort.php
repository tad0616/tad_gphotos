<?php
use XoopsModules\Tadtools\Utility;
/*-----------引入檔案區--------------*/
require dirname(dirname(dirname(__DIR__))) . '/include/cp_header.php';

$csn = (int) $_POST['csn'];
$sort = (int) $_POST['sort'];
$sql = 'UPDATE `' . $xoopsDB->prefix('tad_gphotos_cate') . '` SET `sort`=? WHERE `csn`=?';
Utility::query($sql, 'ii', [$sort, $csn]) or die('Save Sort Fail! (' . date('Y-m-d H:i:s') . ')');

echo 'Save Sort OK! (' . date('Y-m-d H:i:s') . ') ';
