<?php
use XoopsModules\Tadtools\CategoryHelper;
use XoopsModules\Tadtools\CkEditor;
use XoopsModules\Tadtools\FormValidator;
use XoopsModules\Tadtools\TadDataCenter;
use XoopsModules\Tadtools\Utility;
use XoopsModules\Tadtools\Wcag;
use XoopsModules\Tad_gphotos\Tools;

/**
 * Tad Gphotos module
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
 * @package    Tad Gphotos
 * @since      2.5
 * @author     tad
 * @version    $Id $
 **/

/********************* 自訂函數 *********************/

//取得所有tad_gphotos_cate分類選單的選項（模式 = edit or show,目前分類編號,目前分類的所屬編號）
function get_tad_gphotos_cate_options($page = '', $mode = 'edit', $default_csn = '0', $default_of_csn = '0', $unselect_level = '', $start_search_sn = '0', $level = 0)
{
    global $xoopsDB;

    $post_permission = Tools::chk_permission('return');

    $categoryHelper = new CategoryHelper('tad_gphotos_cate', 'csn', 'of_csn', 'title');
    $count = $categoryHelper->getCategoryCount();

    $sql = 'SELECT `csn`, `title` FROM `' . $xoopsDB->prefix('tad_gphotos_cate') . '` WHERE `of_csn`=? ORDER BY `sort`';
    $result = Utility::query($sql, 'i', [$start_search_sn]) or Utility::web_error($sql, __FILE__, __LINE__);

    $prefix = str_repeat('&nbsp;&nbsp;', $level);
    $level++;

    $unselect = explode(',', $unselect_level);

    $main = '';
    while (list($csn, $cate_title) = $xoopsDB->fetchRow($result)) {
        if (!$post_permission) {
            continue;
        }

        if ('edit' === $mode) {
            $selected = ($csn == $default_of_csn) ? 'selected=selected' : '';
            $selected .= ($csn == $default_csn) ? 'disabled=disabled' : '';
            $selected .= (in_array($level, $unselect)) ? 'disabled=disabled' : '';
        } else {
            if (is_array($default_csn)) {
                $selected = in_array($csn, $default_csn) ? 'selected=selected' : '';
            } else {
                $selected = ($csn == $default_csn) ? 'selected=selected' : '';
            }
            $selected .= (in_array($level, $unselect)) ? 'disabled=disabled' : '';
        }
        if ('none' === $page or empty($count[$csn])) {
            $counter = '';
        } else {
            $w = ('admin' === $page) ? _MA_TADGPHOTOS_CATE_COUNT : _MD_TADGPHOTOS_CATE_COUNT;
            $counter = ' (' . sprintf($w, $count[$csn]) . ') ';
        }
        $main .= "<option value='$csn' $selected>{$prefix}{$cate_title}{$counter}</option>";
        $main .= get_tad_gphotos_cate_options($page, $mode, $default_csn, $default_of_csn, $unselect_level, $csn, $level);
    }

    return $main;
}

//tad_gphotos_cate 編輯表單
function tad_gphotos_cate_form($csn = '')
{
    global $xoopsTpl;
    $TadDataCenter = new TadDataCenter('tad_gphotos');
    $TadDataCenter->set_col('csn', $csn);
    $sort_form = $TadDataCenter->getForm('return', 'input', 'sort_kind', 'radio', 'custom', [_MD_TADGPHOTOS_SORT_BY_CUSTOM => 'custom', _MD_TADGPHOTOS_SORT_BY_TITLE => 'title']);
    $xoopsTpl->assign('sort_form', $sort_form);

    //抓取預設值
    $categoryHelper = new CategoryHelper('tad_gphotos_cate', 'csn', 'of_csn', 'title');
    $DBV = !empty($csn) ? $categoryHelper->getCategory($csn) : [];

    //預設值設定

    //設定「csn」欄位預設值
    $csn = !empty($csn) ? $csn : $DBV['csn'];
    $xoopsTpl->assign('csn', $csn);

    //設定「of_csn」欄位預設值
    $of_csn = (!isset($DBV['of_csn'])) ? '' : $DBV['of_csn'];
    $xoopsTpl->assign('of_csn', $of_csn);

    //設定「title」欄位預設值
    $title = (!isset($DBV['title'])) ? '' : $DBV['title'];
    $xoopsTpl->assign('title', $title);

    //設定「sort」欄位預設值
    $sort = (!isset($DBV['sort'])) ? tad_gphotos_cate_max_sort() : $DBV['sort'];
    $xoopsTpl->assign('sort', $sort);

    //設定「description」欄位預設值
    $description = (!isset($DBV['description'])) ? '' : $DBV['description'];
    $xoopsTpl->assign('description', $description);

    $op = (empty($csn)) ? 'insert_tad_gphotos_cate' : 'update_tad_gphotos_cate';

    $FormValidator = new FormValidator('#myForm', true);
    $FormValidator->render();

    $xoopsTpl->assign('op', 'tad_gphotos_cate_form');
    $xoopsTpl->assign('next_op', $op);

    $cate_options = get_tad_gphotos_cate_options('none', 'edit', $csn, $of_csn);
    $xoopsTpl->assign('cate_options', $cate_options);

    $ck = new CkEditor('tad_gphotos', 'description', $description);
    $ck->setHeight(200);
    $editor = $ck->render();
    $xoopsTpl->assign('editor', $editor);
}

//自動取得新排序
function tad_gphotos_cate_max_sort()
{
    global $xoopsDB;
    $sql = 'SELECT MAX(`sort`) FROM `' . $xoopsDB->prefix('tad_gphotos_cate') . '` WHERE `of_csn`=?';
    $result = Utility::query($sql, 'i', [0]) or Utility::web_error($sql, __FILE__, __LINE__);

    list($sort) = $xoopsDB->fetchRow($result);

    return ++$sort;
}

//新增資料到tad_gphotos_cate中
function insert_tad_gphotos_cate()
{
    global $xoopsDB;

    $title = (string) $_POST['title'];
    $description = Wcag::amend($_POST['description']);
    $of_csn = (int) $_POST['of_csn'];
    $sort = (int) $_POST['sort'];

    $sql = 'INSERT INTO `' . $xoopsDB->prefix('tad_gphotos_cate') . '` (`of_csn`, `title`, `sort`, `description`) VALUES (?, ?, ?, ?)';
    Utility::query($sql, 'isis', [$of_csn, $title, $sort, $description]) or Utility::web_error($sql, __FILE__, __LINE__);

    //取得最後新增資料的流水編號
    $csn = $xoopsDB->getInsertId();

    $TadDataCenter = new TadDataCenter('tad_gphotos');
    $TadDataCenter->set_col('csn', $csn);
    $TadDataCenter->saveData();
    return $csn;
}

//更新tad_gphotos_cate某一筆資料
function update_tad_gphotos_cate($csn = '')
{
    global $xoopsDB;

    $title = (string) $_POST['title'];
    $description = Wcag::amend($_POST['description']);
    $of_csn = (int) $_POST['of_csn'];
    $sort = (int) $_POST['sort'];

    $sql = 'UPDATE `' . $xoopsDB->prefix('tad_gphotos_cate') . '` SET `of_csn` =?, `title` =?, `sort` =?, `description` =? WHERE `csn` =?';
    Utility::query($sql, 'isisi', [$of_csn, $title, $sort, $description, $csn]) or Utility::web_error($sql, __FILE__, __LINE__);

    $TadDataCenter = new TadDataCenter('tad_gphotos');
    $TadDataCenter->set_col('csn', $csn);
    $TadDataCenter->saveData();
    return $csn;
}

//刪除tad_gphotos某筆資料資料
function delete_tad_gphotos($album_sn = '')
{
    global $xoopsDB;

    //判斷目前使用者是否有：建立相簿
    Tools::chk_permission();

    if (empty($album_sn)) {
        return;
    }

    delete_tad_gphotos_images($album_sn);

    $sql = 'DELETE FROM `' . $xoopsDB->prefix('tad_gphotos') . '` WHERE `album_sn` = ?';
    Utility::query($sql, 'i', [$album_sn]) or Utility::web_error($sql, __FILE__, __LINE__);

}

//刪除tad_gphotos_images某筆資料資料
function delete_tad_gphotos_images($album_sn = '')
{
    global $xoopsDB;

    //判斷目前使用者是否有：建立相簿
    Tools::chk_permission();

    if (empty($album_sn)) {
        return;
    }

    $sql = 'DELETE FROM `' . $xoopsDB->prefix('tad_gphotos_images') . '` WHERE `album_sn` = ?';
    Utility::query($sql, 'i', [$album_sn]) or Utility::web_error($sql, __FILE__, __LINE__);

}
