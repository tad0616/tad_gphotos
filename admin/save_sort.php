<?php
use XoopsModules\Tadtools\Utility;
/*-----------引入檔案區--------------*/
require dirname(dirname(dirname(__DIR__))) . '/include/cp_header.php';
// 關閉除錯訊息
$xoopsLogger->activated = false;
$csn = (int) $_POST['csn'];
$sort = (int) $_POST['sort'];
$sql = 'UPDATE `' . $xoopsDB->prefix('tad_gphotos_cate') . '` SET `sort`=? WHERE `csn`=?';
Utility::query($sql, 'ii', [$sort, $csn]) or die(_TAD_SORT_FAIL . ' (' . date('Y-m-d H:i:s') . ')');

echo _TAD_SORTED . "(" . date("Y-m-d H:i:s") . ")";
