<?php
use Xmf\Request;
use XoopsModules\Tadtools\CategoryHelper;
use XoopsModules\Tadtools\FormValidator;
use XoopsModules\Tadtools\Jeditable;
use XoopsModules\Tadtools\SweetAlert;
use XoopsModules\Tadtools\TadDataCenter;
use XoopsModules\Tadtools\Utility;
use XoopsModules\Tadtools\Wcag;
use XoopsModules\Tad_gphotos\Crawler;

/**
 *  module
 *
 * You may not change or alter any portion of this comment or credits
 * of supporting developers from this source code or any supporting source code
 * which is considered copyrighted (c) material of the original comment or credit authors.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * @copyright  The XOOPS Project http://sourceforge.net/projects/xoops/
 * @license    http://www.fsf.org/copyleft/gpl.html GNU public license
 * @package
 * @since
 * @author
 * @version    $Id $
 **/

/*-----------引入檔案區--------------*/
require_once __DIR__ . '/header.php';
$GLOBALS['xoopsOption']['template_main'] = 'tad_gphotos_index.tpl';
require_once XOOPS_ROOT_PATH . '/header.php';

/*-----------功能函數區--------------*/

//以流水號秀出某筆tad_gphotos資料內容
function tad_gphotos_show_one($album_sn = '')
{
    global $xoopsDB, $xoopsTpl;

    if (empty($album_sn)) {
        return;
    } else {
        $album_sn = (int) $album_sn;
        add_tad_gphotos_counter($album_sn);
    }

    $myts = \MyTextSanitizer::getInstance();

    $sql = 'SELECT * FROM `' . $xoopsDB->prefix('tad_gphotos') . '` WHERE `album_sn` =?';
    $result = Utility::query($sql, 'i', [$album_sn]) or Utility::web_error($sql, __FILE__, __LINE__);

    $all = $xoopsDB->fetchArray($result);

    //以下會產生這些變數： $album_sn, $album_id, $album_name, $album_url, $album_sort, $uid, $create_date
    foreach ($all as $k => $v) {
        $$k = $v;
    }

    //將 uid 編號轉換成使用者姓名（或帳號）
    $uid_name = XoopsUser::getUnameFromId($uid, 1);
    if (empty($uid_name)) {
        $uid_name = XoopsUser::getUnameFromId($uid, 0);
    }

    //過濾讀出的變數值
    $album_name = $myts->htmlSpecialChars($album_name);
    $album_url = $myts->htmlSpecialChars($album_url);

    $xoopsTpl->assign('album_sn', $album_sn);
    $xoopsTpl->assign('album_id', $album_id);
    $xoopsTpl->assign('album_name', $album_name);
    $xoopsTpl->assign('album_name_link', "<a href='{$_SERVER['PHP_SELF']}?album_sn={$album_sn}'>{$album_name}</a>");
    $xoopsTpl->assign('album_url', $album_url);
    $xoopsTpl->assign('album_sort', $album_sort);
    $xoopsTpl->assign('uid', $uid);
    $xoopsTpl->assign('uid_name', $uid_name);
    $xoopsTpl->assign('csn', $csn);
    $xoopsTpl->assign('create_date', $create_date);

    $SweetAlert = new SweetAlert();
    $SweetAlert->render('delete_tad_gphotos_func', "{$_SERVER['PHP_SELF']}?op=delete_tad_gphotos&album_sn=", "album_sn");

    $xoopsTpl->assign('action', $_SERVER['PHP_SELF']);

    list($url, $key) = explode('?key=', $album_url);
    tad_gphotos_images_list($album_sn, $url, $key);

    if (chk_permission('return')) {
        Utility::get_jquery(true);
    }

    return $csn;
}

//列出所有tad_gphotos資料
function tad_gphotos_list($csn = 0)
{
    global $xoopsDB, $xoopsTpl, $xoopsModuleConfig;

    if (chk_permission('return')) {
        Utility::get_jquery(true);
    }

    $myts = \MyTextSanitizer::getInstance();

    // 取得分類
    $all_cate = [];
    $sql = 'SELECT * FROM `' . $xoopsDB->prefix('tad_gphotos_cate') . '` WHERE `of_csn`=? ORDER BY `sort`';
    $result = Utility::query($sql, 'i', [$csn]) or Utility::web_error($sql, __FILE__, __LINE__);

    while ($all = $xoopsDB->fetchArray($result)) {
        $albums = get_tad_gphotos_cate_albums($all['csn']);
        $all['albums'] = $albums;
        $all['albums_num'] = sizeof($albums);
        $all_cate[] = $all;
    }
    $xoopsTpl->assign('all_cate', $all_cate);

    $TadDataCenter = new TadDataCenter('tad_gphotos');
    $TadDataCenter->set_col('csn', $csn);
    $sort_kind = $TadDataCenter->getData('sort_kind', 0);
    // if ($_GET['test'] == 1) {
    //     Utility::dd($data);
    // }
    // $xoopsTpl->assign('sort_kind', $sort_kind);

    $order = $sort_kind == 'title' ? 'order by album_name' : 'order by album_sort, create_date desc';

    $sql = "select * from `" . $xoopsDB->prefix("tad_gphotos") . "` where csn='{$csn}' $order ";

    //Utility::getPageBar($原sql語法, 每頁顯示幾筆資料, 最多顯示幾個頁數選項);
    $PageBar = Utility::getPageBar($sql, 20, 10);
    $bar = $PageBar['bar'];
    $sql = $PageBar['sql'];
    $total = $PageBar['total'];

    $result = $xoopsDB->query($sql) or Utility::web_error($sql, __FILE__, __LINE__);

    $all_tad_gphotos = array();
    $i = 0;
    while ($all = $xoopsDB->fetchArray($result)) {
        $all_tad_gphotos[$i] = $all;
        //以下會產生這些變數： $album_sn, $album_id, $album_name, $album_url, $uid, $create_date
        foreach ($all as $k => $v) {
            $$k = $v;
        }

        //將 uid 編號轉換成使用者姓名（或帳號）
        $uid_name = XoopsUser::getUnameFromId($uid, 1);
        if (empty($uid_name)) {
            $uid_name = XoopsUser::getUnameFromId($uid, 0);
        }

        //過濾讀出的變數值
        $album_name = $myts->htmlSpecialChars($album_name);
        $album_url = $myts->htmlSpecialChars($album_url);
        $all_tad_gphotos[$i]['album_sn'] = $album_sn;
        $all_tad_gphotos[$i]['album_id'] = $album_id;
        $all_tad_gphotos[$i]['album_name'] = $album_name;
        $all_tad_gphotos[$i]['album_url'] = $album_url;
        $all_tad_gphotos[$i]['uid'] = $uid;
        $all_tad_gphotos[$i]['uid_name'] = $uid_name;
        $all_tad_gphotos[$i]['create_date'] = $create_date;
        $all_tad_gphotos[$i]['cover'] = get_tad_gphotos_rand_image($album_sn);
        $i++;
    }

    //刪除確認的JS
    $SweetAlert = new SweetAlert();
    $SweetAlert->render('delete_tad_gphotos_func',
        "{$_SERVER['PHP_SELF']}?op=delete_tad_gphotos&album_sn=", "album_sn");

    $xoopsTpl->assign('bar', $bar);
    $xoopsTpl->assign('action', $_SERVER['PHP_SELF']);
    $xoopsTpl->assign('all_tad_gphotos', $all_tad_gphotos);

    $xoopsTpl->assign('img_height', $xoopsModuleConfig['polaroid_height'] - 30);
    $xoopsTpl->assign('config', $xoopsModuleConfig);
}

//tad_gphotos編輯表單
function tad_gphotos_form($album_sn = 0, $csn = 0)
{
    global $xoopsTpl, $xoopsUser;

    //判斷目前使用者是否有：建立相簿
    chk_permission();

    //抓取預設值
    if (!empty($album_sn)) {
        $DBV = get_tad_gphotos($album_sn);
    } else {
        $DBV = array();
    }

    //預設值設定

    //設定 album_sn 欄位的預設值
    $album_sn = !isset($DBV['album_sn']) ? $album_sn : $DBV['album_sn'];
    $xoopsTpl->assign('album_sn', $album_sn);
    //設定 album_id 欄位的預設值
    $album_id = !isset($DBV['album_id']) ? '' : $DBV['album_id'];
    $xoopsTpl->assign('album_id', $album_id);
    //設定 album_name 欄位的預設值
    $album_name = !isset($DBV['album_name']) ? '' : $DBV['album_name'];
    $xoopsTpl->assign('album_name', $album_name);
    //設定 album_url 欄位的預設值
    $album_url = !isset($DBV['album_url']) ? '' : $DBV['album_url'];
    $xoopsTpl->assign('album_url', $album_url);
    //設定 uid 欄位的預設值
    $user_uid = $xoopsUser ? $xoopsUser->uid() : "";
    $uid = !isset($DBV['uid']) ? $user_uid : $DBV['uid'];
    $xoopsTpl->assign('uid', $uid);
    //設定 create_date 欄位的預設值
    $create_date = !isset($DBV['create_date']) ? date("Y-m-d H:i:s") : $DBV['create_date'];
    $xoopsTpl->assign('create_date', $create_date);
    //設定 csn 欄位的預設值
    $csn = !isset($DBV['csn']) ? $csn : $DBV['csn'];
    $xoopsTpl->assign('csn', $csn);

    $op = empty($album_sn) ? "insert_tad_gphotos" : "update_tad_gphotos";
    //$op = "replace_tad_gphotos";

    $cate_options = get_tad_gphotos_cate_options('none', 'show', $csn, $of_csn);
    $xoopsTpl->assign('cate_options', $cate_options);

    //套用formValidator驗證機制
    $formValidator = new FormValidator("#myForm", true);
    $formValidator->render();

    //加入Token安全機制
    include_once XOOPS_ROOT_PATH . "/class/xoopsformloader.php";
    $token = new \XoopsFormHiddenToken();
    $token_form = $token->render();
    $xoopsTpl->assign("token_form", $token_form);
    $xoopsTpl->assign('action', $_SERVER["PHP_SELF"]);
    $xoopsTpl->assign('next_op', $op);
}

//以流水號取得某筆tad_gphotos資料
function get_tad_gphotos($album_sn = '')
{
    global $xoopsDB;

    if (empty($album_sn)) {
        return;
    }

    $sql = 'SELECT * FROM `' . $xoopsDB->prefix('tad_gphotos') . '` WHERE `album_sn` = ?';
    $result = Utility::query($sql, 'i', [$album_sn]) or Utility::web_error($sql, __FILE__, __LINE__);

    $data = $xoopsDB->fetchArray($result);
    return $data;
}

//新增資料到tad_gphotos中
function insert_tad_gphotos()
{
    global $xoopsDB, $xoopsUser;

    //判斷目前使用者是否有：建立相簿
    chk_permission();

    //XOOPS表單安全檢查
    if ($_SERVER['SERVER_ADDR'] != '127.0.0.1' && !$GLOBALS['xoopsSecurity']->check()) {
        $error = implode("<br />", $GLOBALS['xoopsSecurity']->getErrors());
        redirect_header($_SERVER['PHP_SELF'], 3, $error);
    }

    $album_sn = (int) $_POST['album_sn'];
    $csn = (int) $_POST['csn'];
    $album_url = $_POST['album_url'];
    $album_name = $_POST['album_name'];
    $album_sort = $album_counter = 0;

    //取得使用者編號
    $uid = ($xoopsUser) ? $xoopsUser->uid() : "";
    $uid = !empty($_POST['uid']) ? (int) $_POST['uid'] : $uid;
    $create_date = date("Y-m-d H:i:s", xoops_getUserTimestamp(time()));

    require 'vendor/autoload.php';
    require 'class/Crawler.php';
    $crawler = new Crawler();
    $album = $crawler->getAlbum($album_url);

    $album_name = !empty($album_name) ? $album_name : $album['name'];
    $album_id = $album['id'];

    $sql = 'INSERT INTO `' . $xoopsDB->prefix('tad_gphotos') . '` (`album_id`, `album_name`, `album_url`, `album_sort`, `album_counter`, `uid`, `create_date`, `csn`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)';
    Utility::query($sql, 'issiiisi', [$album_id, $album_name, $album_url, $album_sort, $album_counter, $uid, $create_date, $csn]) or Utility::web_error($sql, __FILE__, __LINE__);

    //取得最後新增資料的流水編號
    $album_sn = $xoopsDB->getInsertId();

    foreach ($album['images'] as $photo) {
        $photo['album_sn'] = $album_sn;
        insert_tad_gphotos_images($photo);
    }
    return $album_sn;
}

//新增tad_gphotos計數器
function add_tad_gphotos_counter($album_sn = '')
{
    global $xoopsDB;

    if (empty($album_sn)) {
        return;
    }

    $sql = 'UPDATE `' . $xoopsDB->prefix('tad_gphotos') . '`
    SET `album_counter` = `album_counter` + 1
    WHERE `album_sn` = ?';
    Utility::query($sql, 'i', [$album_sn]) or Utility::web_error($sql, __FILE__, __LINE__);

}

//更新tad_gphotos某一筆資料
function update_tad_gphotos($album_sn = '')
{
    global $xoopsDB, $xoopsUser;

    //判斷目前使用者是否有：建立相簿
    chk_permission();

    //XOOPS表單安全檢查
    if (!$GLOBALS['xoopsSecurity']->check()) {
        $error = implode("<br />", $GLOBALS['xoopsSecurity']->getErrors());
        redirect_header($_SERVER['PHP_SELF'], 3, $error);
    }

    $album_name = $_POST['album_name'];
    $album_url = $_POST['album_url'];
    $csn = (int) $_POST['csn'];

    //取得使用者編號
    $uid = ($xoopsUser) ? $xoopsUser->uid() : "";
    $uid = !empty($_POST['uid']) ? (int) $_POST['uid'] : $uid;

    $sql = 'UPDATE `' . $xoopsDB->prefix('tad_gphotos') . '` SET `album_name` = ?, `album_url` = ?, `csn` = ?, `uid` = ? WHERE `album_sn` = ?';
    Utility::query($sql, 'ssiii', [$album_name, $album_url, $csn, $uid, $album_sn]) or Utility::web_error($sql, __FILE__, __LINE__);

    return $album_sn;
}

//隨機取得某相簿照片
function get_tad_gphotos_rand_image($album_sn = '')
{
    global $xoopsDB;

    $sql = 'SELECT * FROM `' . $xoopsDB->prefix('tad_gphotos_images') . '` WHERE `album_sn` = ? ORDER BY RAND() LIMIT 0,1';
    $result = Utility::query($sql, 'i', [$album_sn]) or Utility::web_error($sql, __FILE__, __LINE__);

    $data = $xoopsDB->fetchArray($result);
    return $data;
}

//新增資料到tad_gphotos_images中
function insert_tad_gphotos_images($photo = [])
{
    global $xoopsDB;

    //判斷目前使用者是否有：建立相簿
    chk_permission();

    $album_sn = (int) $photo['album_sn'];
    $image_id = $photo['id'];
    $image_width = (int) $photo['width'];
    $image_height = (int) $photo['height'];
    $image_url = $photo['url'];
    $image_description = Wcag::amend($photo['description']);

    $sql = 'REPLACE INTO `' . $xoopsDB->prefix('tad_gphotos_images') . '` (`album_sn`, `image_id`, `image_width`, `image_height`, `image_url`, `image_description`) VALUES (?, ?, ?, ?, ?, ?)';
    Utility::query($sql, 'isiiss', [$album_sn, $image_id, $image_width, $image_height, $image_url, $image_description]) or Utility::web_error($sql, __FILE__, __LINE__);

    //取得最後新增資料的流水編號
    $image_sn = $xoopsDB->getInsertId();

    return $image_sn;
}

//列出所有tad_gphotos_images資料
function tad_gphotos_images_list($album_sn = '', $url = "", $key = "")
{
    global $xoopsDB, $xoopsTpl, $xoopsModuleConfig;

    $myts = \MyTextSanitizer::getInstance();

    $sql = "select * from `" . $xoopsDB->prefix("tad_gphotos_images") . "` where `album_sn`='$album_sn'";

    //Utility::getPageBar($原sql語法, 每頁顯示幾筆資料, 最多顯示幾個頁數選項);
    $PageBar = Utility::getPageBar($sql, 48, 10);
    $bar = $PageBar['bar'];
    $sql = $PageBar['sql'];
    $total = $PageBar['total'];

    $result = $xoopsDB->query($sql) or Utility::web_error($sql, __FILE__, __LINE__);

    //取得分類所有資料陣列
    $tad_gphotos_arr = get_tad_gphotos_all();
    $all_tad_gphotos_images = array();
    $i = 0;

    $jeditable = new Jeditable();
    while ($all = $xoopsDB->fetchArray($result)) {
        $all_tad_gphotos_images[$i] = $all;
        //以下會產生這些變數： $image_sn, $album_sn, $image_id, $image_width, $image_height, $image_url, $image_description
        foreach ($all as $k => $v) {
            $$k = $v;
        }

        //過濾讀出的變數值
        $image_description = $myts->displayTarea($image_description, 0, 1, 0, 1, 1);

        $all_tad_gphotos_images[$i]['image_sn'] = $image_sn;
        $all_tad_gphotos_images[$i]['album_sn'] = $tad_gphotos_arr[$album_sn]['album_name'];
        $all_tad_gphotos_images[$i]['image_id'] = $image_id;
        $all_tad_gphotos_images[$i]['image_width'] = $image_width;
        $all_tad_gphotos_images[$i]['image_height'] = $image_height;
        $all_tad_gphotos_images[$i]['image_url'] = $image_url;
        $all_tad_gphotos_images[$i]['image_link'] = "{$url}/photo/{$image_id}?key={$key}";
        $all_tad_gphotos_images[$i]['image_description'] = $image_description;

        if (chk_permission('return')) {
            $jeditable->setTextCol("#gphoto" . $image_sn, 'ajax.php', '100%', '24px', "{'image_sn': $image_sn, 'op' : 'save_title'}", '');
        }

        $i++;
    }
    $jeditable->render();

    //刪除確認的JS
    $SweetAlert = new SweetAlert();
    $SweetAlert->render('delete_tad_gphotos_images_func',
        "{$_SERVER['PHP_SELF']}?op=delete_tad_gphotos_images&image_sn=", "image_sn");

    $xoopsTpl->assign('bar', $bar);
    $xoopsTpl->assign('total', $total);
    $xoopsTpl->assign('action', $_SERVER['PHP_SELF']);
    $xoopsTpl->assign('all_tad_gphotos_images', $all_tad_gphotos_images);
    $xoopsTpl->assign('config', $xoopsModuleConfig);
    $xoopsTpl->assign('img_height', $xoopsModuleConfig['polaroid_height'] - 30);
}

//取得tad_gphotos所有資料陣列
function get_tad_gphotos_all()
{
    global $xoopsDB;
    $sql = 'SELECT * FROM `' . $xoopsDB->prefix('tad_gphotos') . '`';
    $result = Utility::query($sql) or Utility::web_error($sql, __FILE__, __LINE__);

    $data_arr = array();
    while ($data = $xoopsDB->fetchArray($result)) {
        $album_sn = $data['album_sn'];
        $data_arr[$album_sn] = $data;
    }
    return $data_arr;
}

function re_get_tad_gphotos($album_sn)
{

    global $xoopsDB;

    //判斷目前使用者是否有：建立相簿
    chk_permission();

    if (empty($album_sn)) {
        return;
    }

    $sql = 'SELECT `image_id`, `image_description` FROM `' . $xoopsDB->prefix('tad_gphotos_images') . '` WHERE `album_sn`=?';
    $result = Utility::query($sql, 'i', [$album_sn]) or Utility::web_error($sql, __FILE__, __LINE__);

    //取得分類所有資料陣列
    $image_description_arr = [];
    // 記住說明
    while (list($image_id, $image_description) = $xoopsDB->fetchRow($result)) {
        $image_description_arr[$image_id] = $image_description;
    }

    delete_tad_gphotos_images($album_sn);

    $sql = 'SELECT `album_url` FROM `' . $xoopsDB->prefix('tad_gphotos') . '` WHERE `album_sn` =?';
    $result = Utility::query($sql, 'i', [$album_sn]) or Utility::web_error($sql, __FILE__, __LINE__);

    list($album_url) = $xoopsDB->fetchRow($result);

    require 'vendor/autoload.php';
    require 'class/Crawler.php';
    $crawler = new Crawler();
    $album = $crawler->getAlbum($album_url);

    foreach ($album['images'] as $photo) {
        $photo['album_sn'] = $album_sn;
        $image_id = $photo['id'];
        $photo['description'] = Wcag::amend($image_description_arr[$image_id]);
        insert_tad_gphotos_images($photo);
    }

    $sql = 'UPDATE `' . $xoopsDB->prefix('tad_gphotos') . '` SET `create_date` = NOW() WHERE `album_sn` =?';
    Utility::query($sql, 'i', [$album_sn]) or Utility::web_error($sql, __FILE__, __LINE__);

}

/*-----------執行動作判斷區----------*/
$op = Request::getString('op');
$album_sn = Request::getInt('album_sn');
$image_sn = Request::getInt('image_sn');
$csn = Request::getInt('csn');

switch ($op) {
    /*---判斷動作請貼在下方---*/

    //輸入表格
    case 'tad_gphotos_form':
        tad_gphotos_form($album_sn, $csn);
        break;

    //刪除資料
    case 'delete_tad_gphotos':
        delete_tad_gphotos($album_sn);
        header("location: {$_SERVER['PHP_SELF']}");
        exit;

    case 'tad_gphotos_list':
        tad_gphotos_list();
        break;

    case 'tad_gphotos_show_one':
        tad_gphotos_show_one($album_sn);
        break;

    //新增資料
    case 'insert_tad_gphotos':
        $album_sn = insert_tad_gphotos();
        header("location: {$_SERVER['PHP_SELF']}?album_sn=$album_sn");
        exit;

    //更新資料
    case 'update_tad_gphotos':
        update_tad_gphotos($album_sn);
        header("location: {$_SERVER['PHP_SELF']}?album_sn=$album_sn");
        exit;

    //重新抓取
    case 're_get_tad_gphotos':
        re_get_tad_gphotos($album_sn);
        header("location: {$_SERVER['PHP_SELF']}?album_sn=$album_sn");
        exit;

    //輸入表格
    case 'tad_gphotos_cate_form':
        tad_gphotos_cate_form($csn);
        break;

    //新增資料
    case 'insert_tad_gphotos_cate':
        $csn = insert_tad_gphotos_cate();
        header("location: {$_SERVER['PHP_SELF']}?csn=$csn");
        exit;

    //更新資料
    case 'update_tad_gphotos_cate':
        update_tad_gphotos_cate($csn);
        header("location: {$_SERVER['PHP_SELF']}?csn=$csn");
        exit;

    default:
        if (empty($album_sn)) {
            tad_gphotos_list($csn);
            $op = 'tad_gphotos_list';
        } else {
            $csn = tad_gphotos_show_one($album_sn);
            $op = 'tad_gphotos_show_one';
        }

        $categoryHelper = new CategoryHelper('tad_gphotos_cate', 'csn', 'of_csn', 'title');
        $arr = $categoryHelper->getCategoryPath($csn);
        $path = Utility::tad_breadcrumb($csn, $arr, 'index.php', 'csn', 'title');
        $xoopsTpl->assign('path', $path);

        break;

        /*---判斷動作請貼在上方---*/
}

/*-----------秀出結果區--------------*/
$xoopsTpl->assign('toolbar', Utility::toolbar_bootstrap($interface_menu));
$xoopsTpl->assign('now_op', $op);
$xoTheme->addStylesheet(XOOPS_URL . '/modules/tad_gphotos/css/module.css');
require_once XOOPS_ROOT_PATH . '/footer.php';
