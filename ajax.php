<?php
use Xmf\Request;
use XoopsModules\Tadtools\Utility;
use XoopsModules\Tad_gphotos\Tools;
/*-----------引入檔案區--------------*/
require_once __DIR__ . '/header.php';
//判斷目前使用者是否有：建立相簿
Tools::chk_permission();
// 關閉除錯訊息
header('HTTP/1.1 200 OK');
$xoopsLogger->activated = false;

/*-----------執行動作判斷區----------*/
$op = Request::getString('op');
$value = Request::getString('value');
$image_sn = Request::getInt('image_sn');
$album_sn_arr = Request::getArray('album_sn');

switch ($op) {

    case "save_title":
        $value = update_tad_gphotos_images($image_sn, 'image_description', $value);
        die($value);

    case "save_sort":
        $value = save_sort($album_sn_arr);
        die($value);

}

/*-----------秀出結果區--------------*/

/*-----------功能函數區--------------*/

//更新tad_gphotos_images某一筆資料
function update_tad_gphotos_images($image_sn = '', $col, $value)
{
    global $xoopsDB;

    $sql = 'UPDATE `' . $xoopsDB->prefix('tad_gphotos_images') . '` SET `' . $col . '` = ? WHERE `image_sn` = ?';
    Utility::query($sql, 'si', [$value, $image_sn]) or Utility::web_error($sql, __FILE__, __LINE__);

    return $value;
}

function save_sort($album_sn_arr = [])
{
    global $xoopsDB;
    $sort = 1;
    foreach ($album_sn_arr as $album_sn) {
        $sql = 'UPDATE `' . $xoopsDB->prefix('tad_gphotos') . '` SET `album_sort`=? WHERE `album_sn`=?';
        Utility::query($sql, 'ii', [$sort, $album_sn]) or die(_TAD_SORT_FAIL . " (" . date('Y-m-d H:i:s') . ")" . $sql);

        $sort++;
    }
    return _TAD_SORTED . "(" . date("Y-m-d H:i:s") . ")";
}
