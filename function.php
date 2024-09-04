<?php
use XoopsModules\Tadtools\CkEditor;
use XoopsModules\Tadtools\FormValidator;
use XoopsModules\Tadtools\TadDataCenter;
use XoopsModules\Tadtools\Utility;
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
function vv($array = [])
{
    Utility::dd($array);
}

function get_tad_gphotos_sub_cate($csn = '0')
{
    global $xoopsDB;
    $sql = 'select csn,title from ' . $xoopsDB->prefix('tad_gphotos_cate') . " where of_csn='{$csn}'";
    $result = $xoopsDB->query($sql) or Utility::web_error($sql, __FILE__, __LINE__);
    $csn_arr = [];
    while (list($csn, $title) = $xoopsDB->fetchRow($result)) {
        $csn_arr[$csn] = $title;
    }

    return $csn_arr;
}

function get_tad_gphotos_cate_albums($csn = '0', $limit = 4)
{
    global $xoopsDB;

    $album_arr = [];
    $i = 1;
    $sql = 'select b.album_sn, b.album_name, c.image_url from ' . $xoopsDB->prefix('tad_gphotos_cate') . " as a
        join " . $xoopsDB->prefix('tad_gphotos') . " as b on a.csn = b.csn
        join " . $xoopsDB->prefix('tad_gphotos_images') . " as c on b.album_sn = c.album_sn
        where a.csn='{$csn}' or a.of_csn='{$csn}'
        group by b.album_sn
        order by rand()";

    $result = $xoopsDB->query($sql) or Utility::web_error($sql, __FILE__, __LINE__);
    while (list($album_sn, $album_name, $image_url) = $xoopsDB->fetchRow($result)) {

        $album_arr[$i]['album_sn'] = $album_sn;
        $album_arr[$i]['album_name'] = $album_name;
        $album_arr[$i]['image_url'] = $image_url;
        $i++;
    }

    return $album_arr;
}

//以流水號取得某筆tad_gphotos_cate資料
function get_tad_gphotos_cate($csn = '')
{
    global $xoopsDB;
    if (empty($csn)) {
        return;
    }
    $albums = tad_gphotos_cate_count();
    $sub_cate = get_tad_gphotos_sub_cate($csn);
    $sql = 'select * from ' . $xoopsDB->prefix('tad_gphotos_cate') . " where csn='$csn'";
    $result = $xoopsDB->query($sql) or Utility::web_error($sql, __FILE__, __LINE__);
    $data = $xoopsDB->fetchArray($result);
    $data['sub_cate'] = sizeof($sub_cate);
    $data['count'] = isset($albums[$csn]) ? $albums[$csn] : 0;

    return $data;
}

//分類底下的相簿數
function tad_gphotos_cate_count()
{
    global $xoopsDB;
    $all = [];
    $sql = 'SELECT csn, count(*) FROM ' . $xoopsDB->prefix('tad_gphotos') . ' GROUP BY csn';
    $result = $xoopsDB->query($sql) or Utility::web_error($sql, __FILE__, __LINE__);
    while (list($csn, $count) = $xoopsDB->fetchRow($result)) {
        $all[$csn] = (int) ($count);
    }

    return $all;
}

//取得路徑
function get_tad_gphotos_cate_path($the_csn = '', $include_self = true)
{
    global $xoopsDB;

    $arr[0]['csn'] = '0';
    $arr[0]['title'] = "&#xf015;";
    $arr[0]['sub'] = get_tad_gphotos_sub_cate(0);
    if (!empty($the_csn)) {
        $tbl = $xoopsDB->prefix('tad_gphotos_cate');
        $sql = "SELECT t1.csn AS lev1, t2.csn as lev2, t3.csn as lev3, t4.csn as lev4, t5.csn as lev5, t6.csn as lev6, t7.csn as lev7
            FROM `{$tbl}` t1
            LEFT JOIN `{$tbl}` t2 ON t2.of_csn = t1.csn
            LEFT JOIN `{$tbl}` t3 ON t3.of_csn = t2.csn
            LEFT JOIN `{$tbl}` t4 ON t4.of_csn = t3.csn
            LEFT JOIN `{$tbl}` t5 ON t5.of_csn = t4.csn
            LEFT JOIN `{$tbl}` t6 ON t6.of_csn = t5.csn
            LEFT JOIN `{$tbl}` t7 ON t7.of_csn = t6.csn
            WHERE t1.of_csn = '0'";
        $result = $xoopsDB->query($sql) or Utility::web_error($sql, __FILE__, __LINE__);
        while ($all = $xoopsDB->fetchArray($result)) {
            if (in_array($the_csn, $all)) {
                //$main.="-";
                foreach ($all as $csn) {
                    if (!empty($csn)) {
                        if (!$include_self and $csn == $the_csn) {
                            break;
                        }
                        $arr[$csn] = get_tad_gphotos_cate($csn);
                        $arr[$csn]['sub'] = get_tad_gphotos_sub_cate($csn);
                        if ($csn == $the_csn) {
                            break;
                        }
                    }
                }
                break;
            }
        }
    }

    return $arr;
}

function chk_permission($mode = '')
{
    global $xoopsTpl, $xoopsUser;
    $create_album = Utility::power_chk("tad_gphotos", 1);
    if ($mode == 'return') {
        $uid = $xoopsUser ? $xoopsUser->uid() : '';
        if ($xoopsTpl) {
            $xoopsTpl->assign('now_uid', $uid);
            $xoopsTpl->assign('create_album', $create_album);
        }
        return $create_album;
    }
    if (!$create_album) {
        redirect_header($_SERVER['PHP_SELF'], 3, _TAD_PERMISSION_DENIED);
    }
}

//取得所有tad_gphotos_cate分類選單的選項（模式 = edit or show,目前分類編號,目前分類的所屬編號）
function get_tad_gphotos_cate_options($page = '', $mode = 'edit', $default_csn = '0', $default_of_csn = '0', $unselect_level = '', $start_search_sn = '0', $level = 0)
{
    global $xoopsDB, $xoopsModule;

    $post_permission = chk_permission('return');

    $count = tad_gphotos_cate_count();

    $sql = 'select csn, title from ' . $xoopsDB->prefix('tad_gphotos_cate') . " where of_csn='{$start_search_sn}' order by `sort`";
    $result = $xoopsDB->query($sql) or Utility::web_error($sql, __FILE__, __LINE__);

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

//分類底下的相片數
function tad_gphotos_images_num($album_sn)
{
    global $xoopsDB;
    $sql = 'SELECT count(*) FROM ' . $xoopsDB->prefix('tad_gphotos_images') . " where album_sn = '{$album_sn}'";
    $result = $xoopsDB->query($sql) or Utility::web_error($sql, __FILE__, __LINE__);
    list($count) = $xoopsDB->fetchRow($result);

    return $count;
}

//tad_gphotos_cate 編輯表單
function tad_gphotos_cate_form($csn = '')
{
    global $xoopsDB, $xoopsUser, $xoopsTpl;
    $TadDataCenter = new TadDataCenter('tad_gphotos');
    $TadDataCenter->set_col('csn', $csn);
    $sort_form = $TadDataCenter->getForm('return', 'input', 'sort_kind', 'radio', 'custom', [_MD_TADGPHOTOS_SORT_BY_CUSTOM => 'custom', _MD_TADGPHOTOS_SORT_BY_TITLE => 'title']);
    $xoopsTpl->assign('sort_form', $sort_form);

    //抓取預設值
    $DBV = !empty($csn) ? get_tad_gphotos_cate($csn) : [];

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
    global $xoopsDB, $xoopsModule;
    $sql = 'SELECT max(sort) FROM ' . $xoopsDB->prefix('tad_gphotos_cate') . " WHERE of_csn=''";
    $result = $xoopsDB->query($sql) or Utility::web_error($sql, __FILE__, __LINE__);
    list($sort) = $xoopsDB->fetchRow($result);

    return ++$sort;
}

//新增資料到tad_gphotos_cate中
function insert_tad_gphotos_cate()
{
    global $xoopsDB;

    $title = $xoopsDB->escape($_POST['title']);
    $description = $xoopsDB->escape($_POST['description']);
    $of_csn = (int) $_POST['of_csn'];
    $sort = (int) $_POST['sort'];

    $sql = 'insert into ' . $xoopsDB->prefix('tad_gphotos_cate') . "
    (`of_csn` , `title` , `sort` , `description`)
    values('{$of_csn}' , '{$title}' , '{$sort}' , '{$description}')";
    $xoopsDB->query($sql) or Utility::web_error($sql, __FILE__, __LINE__);

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

    $title = $xoopsDB->escape($_POST['title']);
    $description = $xoopsDB->escape($_POST['description']);
    $of_csn = (int) $_POST['of_csn'];
    $sort = (int) $_POST['sort'];

    $sql = 'update ' . $xoopsDB->prefix('tad_gphotos_cate') . " set
    `of_csn` = '{$of_csn}' ,
    `title` = '{$title}' ,
    `sort` = '{$sort}' ,
    `description` = '{$description}'
    where csn='$csn'";
    $xoopsDB->queryF($sql) or Utility::web_error($sql, __FILE__, __LINE__);

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
    chk_permission();

    if (empty($album_sn)) {
        return;
    }

    delete_tad_gphotos_images($album_sn);

    $sql = "delete from `" . $xoopsDB->prefix("tad_gphotos") . "`
    where `album_sn` = '{$album_sn}'";
    $xoopsDB->queryF($sql) or Utility::web_error($sql, __FILE__, __LINE__);

}

//刪除tad_gphotos_images某筆資料資料
function delete_tad_gphotos_images($album_sn = '')
{
    global $xoopsDB;

    //判斷目前使用者是否有：建立相簿
    chk_permission();

    if (empty($album_sn)) {
        return;
    }

    $sql = "delete from `" . $xoopsDB->prefix("tad_gphotos_images") . "`
    where `album_sn` = '{$album_sn}'";
    $xoopsDB->queryF($sql) or Utility::web_error($sql, __FILE__, __LINE__);

}
