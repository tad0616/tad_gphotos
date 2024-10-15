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

//區塊主函式 (tad_gphotos_albums)
function tad_gphotos_albums($options)
{
    global $xoopsDB, $xoTheme;
    if ($xoTheme) {
        $xoTheme->addStylesheet('modules/tad_gphotos/css/module.css');
    } else {
        $block['css'] = '<link rel="stylesheet" href="<{$xoops_url}>/modules/tad_gphotos/css/module.css" type="text/css">';
    }

    //{$options[0]} : 列出幾本項目
    $block['options0'] = isset($options[0]) ? (int) $options[0] : 5;
    //{$options[1]} : 排序依據
    $block['options1'] = isset($options[1]) ? $options[1] : 'rand()';
    //{$options[2]} : 排序方式
    $block['options2'] = isset($options[2]) ? $options[2] : 'desc';
    //{$options[3]} : 呈現模式
    $block['display'] = isset($options[3]) ? $options[3] : 'cover';
    //{$options[4]} : 縮圖寬度
    $block['width'] = isset($options[4]) ? (int) $options[4] : 150;
    //{$options[5]} : 縮圖高度
    $block['height'] = isset($options[5]) ? (int) $options[5] : 150;

    $block['img_height'] = $block['height'] - 30;

    $sql = 'SELECT * FROM `' . $xoopsDB->prefix('tad_gphotos') . '` ORDER BY ' . $block['options1'] . ' ' . $block['options2'] . ' LIMIT 0,?';
    $result = Utility::query($sql, 'i', [$block['options0']]) or Utility::web_error($sql, __FILE__, __LINE__);

    while ($all = $xoopsDB->fetchArray($result)) {
        $sql2 = 'SELECT * FROM `' . $xoopsDB->prefix('tad_gphotos_images') . '` WHERE `album_sn` =? ORDER BY RAND() LIMIT 0,1';
        $result2 = Utility::query($sql2, 'i', [$all['album_sn']]) or Utility::web_error($sql2, __FILE__, __LINE__);

        $all['cover'] = $xoopsDB->fetchArray($result2);

        $block['content'][] = $all;
    }

    // Utility::dd($block);
    return $block;
}

//區塊編輯函式 (tad_gphotos_albums_edit)
function tad_gphotos_albums_edit($options)
{

    //{$options[0]} : 列出幾本項目
    $options[0] = $options[0] ? (int) $options[0] : 5;
    //{$options[4]} : 縮圖寬度
    $options[4] = $options[4] ? (int) $options[4] : 150;
    //{$options[5]} : 縮圖高度
    $options[5] = $options[5] ? (int) $options[5] : 150;

    //"排序依據"預設值
    $selected_1_0 = ($options[1] == 'album_sort') ? 'selected' : '';
    $selected_1_1 = ($options[1] == 'create_date') ? 'selected' : '';
    $selected_1_2 = ($options[1] == 'rand()') ? 'selected' : '';

    //"排序方式"預設值
    $selected_2_0 = ($options[2] == 'desc') ? 'selected' : '';
    $selected_2_1 = ($options[2] == '') ? 'selected' : '';

    //"呈現模式"預設值
    $selected_3_0 = ($options[3] == 'cover') ? 'selected' : '';
    $selected_3_1 = ($options[3] == 'text') ? 'selected' : '';

    $form = "
    <ol class='my-form'>
        <!--列出幾本項目-->
        <li class='my-row'>
            <lable class='my-label'>" . _MB_TAD_GPHOTOS_ALBUMS_OPT0 . "</lable>
            <div class='my-content'>
                <input type='text' class='my-input' name='options[0]' value='{$options[0]}' size=6>
            </div>
        </li>
        <!--排序依據-->
        <li class='my-row'>
            <lable class='my-label'>" . _MB_TAD_GPHOTOS_ORDER_BY . "</lable>
            <div class='my-content'>
                <select name='options[1]' class='my-input'>
                    <option value='album_sort' $selected_1_0>" . _MB_TAD_GPHOTOS_ORDER_SORT . "</option>
                    <option value='create_date' $selected_1_1>" . _MB_TAD_GPHOTOS_ORDER_DATE . "</option>
                    <option value='rand()' $selected_1_2>" . _MB_TAD_GPHOTOS_ORDER_RAND . "</option>
                </select>
            </div>
        </li>
        <!--排序方式-->
        <li class='my-row'>
            <lable class='my-label'>" . _MB_TAD_GPHOTOS_SORT_TYPE . "</lable>
            <div class='my-content'>
                <select name='options[2]' class='my-input'>
                    <option value='desc' $selected_2_0>" . _MB_TAD_GPHOTOS_SORT_DESC . "</option>
                    <option value='' $selected_2_1>" . _MB_TAD_GPHOTOS_SORT_ASC . "</option>
                </select>
            </div>
        </li>
        <!--呈現模式-->
        <li class='my-row'>
            <lable class='my-label'>" . _MB_TAD_GPHOTOS_ALBUMS_OPT3 . "</lable>
            <div class='my-content'>
                <select name='options[3]' class='my-input'>
                    <option value='cover' $selected_3_0>" . _MB_TAD_GPHOTOS_ALBUMS_OPT3_VAL0 . "</option>
                    <option value='text' $selected_3_1>" . _MB_TAD_GPHOTOS_ALBUMS_OPT3_VAL1 . "</option>
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
