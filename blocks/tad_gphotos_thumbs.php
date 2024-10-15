<?php
use XoopsModules\Tadtools\Utility;
if (!class_exists('XoopsModules\Tadtools\Utility')) {
    require XOOPS_ROOT_PATH . '/modules/tadtools/preloads/autoloader.php';
}

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

//區塊主函式 (tad_gphotos_thumbs)
function tad_gphotos_thumbs($options)
{
    global $xoopsDB, $xoTheme;
    if ($xoTheme) {
        $xoTheme->addStylesheet('modules/tad_gphotos/css/module.css');
    } else {
        $block['css'] = '<link rel="stylesheet" href="' . XOOPS_URL . '/modules/tad_gphotos/css/module.css" type="text/css">';
    }
    //{$options[0]} : 選擇相簿
    $album_sn = $options[0] ? (int) $options[0] : '';
    //{$options[1]} : 相片數
    $block['options1'] = $options[1] ? (int) $options[1] : 20;
    //{$options[2]} : 排序依據
    $block['options2'] = $options[2] ? $options[2] : 'rand()';
    //{$options[3]} : 排序方式
    $block['options3'] = $options[3];
    //{$options[4]} : 縮圖寬度
    $block['width'] = $options[4] ? (int) $options[4] : 150;
    //{$options[5]} : 縮圖高度
    $block['height'] = $options[5] ? (int) $options[5] : 150;

    $params = [];
    $where = "";

    if (!empty($album_sn)) {
        $where = "WHERE `album_sn` = ?";
        $params[] = $album_sn;
    } else {
        $where = "ORDER BY `create_date` DESC LIMIT 0, 1";
    }

    $sql = "SELECT `album_sn`, `album_url`, `album_name` FROM `" . $xoopsDB->prefix("tad_gphotos") . "` $where";
    $result = Utility::query($sql, str_repeat('i', count($params)), $params) or Utility::web_error($sql, __FILE__, __LINE__);

    list($album_sn, $album_url, $album_name) = $xoopsDB->fetchRow($result);
    list($url, $key) = explode('?key=', $album_url);

    $sql = 'SELECT * FROM `' . $xoopsDB->prefix('tad_gphotos_images') . '` WHERE `album_sn` = ? ORDER BY ' . $block['options2'] . ' ' . $block['options3'] . ' LIMIT 0, ' . $block['options1'];
    $result = Utility::query($sql, 'i', [$album_sn]) or Utility::web_error($sql, __FILE__, __LINE__);

    $content = [];
    while ($all = $xoopsDB->fetchArray($result)) {
        $all['image_link'] = "{$url}/photo/{$all['image_id']}?key={$key}";
        $content[] = $all;
    }
    $block['content'] = $content;
    $block['album_sn'] = $album_sn;
    $block['album_name'] = $album_name;
    $block['album_url'] = $album_url;
    return $block;
}

//區塊編輯函式 (tad_gphotos_thumbs_edit)
function tad_gphotos_thumbs_edit($options)
{
    global $xoopsDB;

    //{$options[1]} : 相片數
    $options[1] = $options[1] ? (int) $options[1] : 20;
    //{$options[4]} : 縮圖寬度
    $options[4] = $options[4] ? (int) $options[4] : 150;
    //{$options[5]} : 縮圖高度
    $options[5] = $options[5] ? (int) $options[5] : 150;

    //"排序依據"預設值
    $selected_2_0 = ($options[2] == 'image_sn') ? 'selected' : '';
    $selected_2_1 = ($options[2] == 'rand()') ? 'selected' : '';

    //"排序方式"預設值
    $selected_3_0 = ($options[3] == 'desc') ? 'selected' : '';
    $selected_3_1 = ($options[3] == '') ? 'selected' : '';

    //"選擇相簿"預設值
    $sql = 'SELECT * FROM `' . $xoopsDB->prefix('tad_gphotos') . '` ORDER BY `create_date` DESC';
    $result = Utility::query($sql) or Utility::web_error($sql, __FILE__, __LINE__);

    $opt = '<option value="">' . _MB_TAD_GPHOTOS_LATEST_ALBUM . '</option>';
    while ($album = $xoopsDB->fetchArray($result)) {
        $selected = ($options[0] == $album['album_sn']) ? 'selected' : '';
        $opt .= "<option value='{$album['album_sn']}' $selected>{$album['album_name']}</option>";
    }

    $form = "
    <ol class='my-form'>
        <!--選擇相簿-->
        <li class='my-row'>
            <lable class='my-label'>" . _MB_TAD_GPHOTOS_CHOOSE_ALBUM . "</lable>
            <div class='my-content'>
                <select name='options[0]' class='my-input'>
                    {$opt}
                </select>
            </div>
        </li>
        <!--相片數-->
        <li class='my-row'>
            <lable class='my-label'>" . _MB_TAD_GPHOTOS_THUMBS_NUM . "</lable>
            <div class='my-content'>
                <input type='text' name='options[1]' value='{$options[1]}' class='my-input'>
            </div>
        </li>
        <!--排序依據-->
        <li class='my-row'>
            <lable class='my-label'>" . _MB_TAD_GPHOTOS_ORDER_BY . "</lable>
            <div class='my-content'>
                <select name='options[2]' class='my-input'>
                    <option value='image_sn' $selected_2_0>" . _MB_TAD_GPHOTOS_ORDER_SN . "</option>
                    <option value='rand()' $selected_2_1>" . _MB_TAD_GPHOTOS_ORDER_RAND . "</option>
                </select>
            </div>
        </li>
        <!--排序方式-->
        <li class='my-row'>
            <lable class='my-label'>" . _MB_TAD_GPHOTOS_SORT_TYPE . "</lable>
            <div class='my-content'>
                <select name='options[3]' class='my-input'>
                    <option value='desc' $selected_3_0>" . _MB_TAD_GPHOTOS_SORT_DESC . "</option>
                    <option value='' $selected_3_1>" . _MB_TAD_GPHOTOS_SORT_ASC . "</option>
                </select>
            </div>
        </li>
        <!--縮圖寬度-->
        <li class='my-row'>
            <lable class='my-label'>" . _MB_TAD_GPHOTOS_THUMBS_OWIDTH . "</lable>
            <div class='my-content'>
                <input type='text' name='options[4]' value='{$options[4]}' class='my-input'>
            </div>
        </li>
        <!--縮圖高度-->
        <li class='my-row'>
            <lable class='my-label'>" . _MB_TAD_GPHOTOS_THUMBS_OHEIGHT . "</lable>
            <div class='my-content'>
                <input type='text' name='options[5]' value='{$options[5]}' class='my-input'>
            </div>
        </li>
    </ol>
    ";
    return $form;
}
