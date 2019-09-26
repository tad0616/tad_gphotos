<?php
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

xoops_loadLanguage('modinfo_common', 'tadtools');

define('_MI_TADGPHOTOS_NAME','Google 相簿');
define('_MI_TADGPHOTOS_AUTHOR','Google 相簿');
define('_MI_TADGPHOTOS_CREDITS','');
define('_MI_TADGPHOTOS_DESC','將Google Photes 的相簿放到網站中');
define('_MI_TADGPHOTOS_AUTHOR_WEB','Tad教材網');
define('_MI_TADGPHOTOS_ADMENU1', '主管理介面');
define('_MI_TADGPHOTOS_ADMENU1_DESC', '主管理介面');
define('_MI_TADGPHOTOS_ADMENU2', '權限管理');
define('_MI_TADGPHOTOS_ADMENU2_DESC', '權限管理');

define('_MI_TADGPHOTOS_PHOTOS_NUMBER' , '每頁顯示幾張相片');
define('_MI_TADGPHOTOS_PHOTOS_NUMBER_DESC' , '設定每一頁要出現的相簿數量，作為分頁依據');
define('_MI_TADGPHOTOS_POLAROID_WIDTH' , '圖片縮圖寬度');
define('_MI_TADGPHOTOS_POLAROID_WIDTH_DESC' , '設定每張縮圖的呈現寬度，單位為像素');
define('_MI_TADGPHOTOS_POLAROID_HEIGHT' , '圖片縮圖高度');
define('_MI_TADGPHOTOS_POLAROID_HEIGHT_DESC' , '設定每張縮圖的呈現高度（含下方標題），單位為像素');
define('_MI_TADGPHOTOS_POLAROID_MARGIN_Y' , '圖片縮圖上下間距');
define('_MI_TADGPHOTOS_POLAROID_MARGIN_Y_DESC' , '設定每張縮圖之間的上下間距，單位為像素');
define('_MI_TADGPHOTOS_POLAROID_MARGIN_X' , '圖片縮圖左右間距');
define('_MI_TADGPHOTOS_POLAROID_MARGIN_X_DESC' , '設定每張縮圖之間的左右間距，單位為像素');

define('_MI_TAD_GPHOTOS_ALBUMS_BLOCK_NAME', 'Google 相簿列表');
define('_MI_TAD_GPHOTOS_ALBUMS_BLOCK_DESC', 'Google 相簿列表區塊 (tad_gphotos_albums)');
define('_MI_TAD_GPHOTOS_MARQUEE_BLOCK_NAME', 'Google 相簿跑馬燈');
define('_MI_TAD_GPHOTOS_MARQUEE_BLOCK_DESC', 'Google 相簿跑馬燈區塊 (tad_gphotos_marquee)');
define('_MI_TAD_GPHOTOS_THUMBS_BLOCK_NAME', 'Google 相簿縮圖');
define('_MI_TAD_GPHOTOS_THUMBS_BLOCK_DESC', 'Google 相簿縮圖區塊 (tad_gphotos_list)');