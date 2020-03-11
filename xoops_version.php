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

$modversion = array();

//---模組基本資訊---//
$modversion['name'] = _MI_TADGPHOTOS_NAME;
$modversion['version'] = '1.1';
$modversion['description'] = _MI_TADGPHOTOS_DESC;
$modversion['author'] = _MI_TADGPHOTOS_AUTHOR;
$modversion['credits'] = _MI_TADGPHOTOS_CREDITS;
$modversion['help'] = 'page=help';
$modversion['license'] = 'GPL see LICENSE';
$modversion['image'] = "images/logo.png";
$modversion['dirname'] = basename(__DIR__);

//---模組狀態資訊---//
$modversion['release_date'] = '2019-10-05';
$modversion['module_website_url'] = 'https://www.tad0616.net';
$modversion['module_website_name'] = _MI_TADGPHOTOS_AUTHOR_WEB;
$modversion['module_status'] = 'release';
$modversion['author_website_url'] = 'https://www.tad0616.net';
$modversion['author_website_name'] = _MI_TADGPHOTOS_AUTHOR_WEB;
$modversion['min_php'] = '5.4';
$modversion['min_xoops'] = '2.5';

//---paypal資訊---//
$modversion['paypal'] = array();
$modversion['paypal']['business'] = 'tad0616@gmail.com';
$modversion['paypal']['item_name'] = 'Donation :' . _MI_TADGPHOTOS_AUTHOR;
$modversion['paypal']['amount'] = 0;
$modversion['paypal']['currency_code'] = 'USD';

//---安裝設定---//
$modversion['onInstall'] = "include/onInstall.php";
$modversion['onUpdate'] = "include/onUpdate.php";
$modversion['onUninstall'] = "include/onUninstall.php";

//---資料表架構---//
$modversion['sqlfile']['mysql'] = "sql/mysql.sql";
$modversion['tables'][] = "tad_gphotos";
$modversion['tables'][] = "tad_gphotos_images";
$modversion['tables'][] = "tad_gphotos_data_center";

//---後台使用系統選單---//
$modversion['system_menu'] = 1;

//---後台管理介面設定---//
$modversion['hasAdmin'] = 1;
$modversion['adminindex'] = 'admin/main.php';
$modversion['adminmenu'] = 'admin/menu.php';

//---前台主選單設定---//
$modversion['hasMain'] = 1;

//---樣板設定---//
$modversion['templates'][] = array('file' => 'tad_gphotos_adm_main.tpl', 'description' => 'tad_gphotos_adm_main.tpl');
$modversion['templates'][] = array('file' => 'tad_gphotos_adm_groupperm.tpl', 'description' => 'tad_gphotos_adm_groupperm.tpl');
$modversion['templates'][] = array('file' => 'tad_gphotos_index.tpl', 'description' => 'tad_gphotos_index.tpl');

//---區塊設定---//
$i = 0;
$i++;
$modversion['blocks'][$i] = [
    'file' => 'tad_gphotos_albums.php',
    'name' => _MI_TAD_GPHOTOS_ALBUMS_BLOCK_NAME,
    'description' => _MI_TAD_GPHOTOS_ALBUMS_BLOCK_DESC,
    'show_func' => 'tad_gphotos_albums',
    'template' => 'tad_gphotos_albums.tpl',
    'edit_func' => 'tad_gphotos_albums_edit',
    'options' => '5|album_sort||cover',
];

$i++;
$modversion['blocks'][$i] = [
    'file' => 'tad_gphotos_marquee.php',
    'name' => _MI_TAD_GPHOTOS_MARQUEE_BLOCK_NAME,
    'description' => _MI_TAD_GPHOTOS_MARQUEE_BLOCK_DESC,
    'show_func' => 'tad_gphotos_marquee',
    'template' => 'tad_gphotos_marquee.tpl',
    'edit_func' => 'tad_gphotos_marquee_edit',
    'options' => '|12|rand()||150|10',
];

$i++;
$modversion['blocks'][$i] = [
    'file' => 'tad_gphotos_thumbs.php',
    'name' => _MI_TAD_GPHOTOS_THUMBS_BLOCK_NAME,
    'description' => _MI_TAD_GPHOTOS_THUMBS_BLOCK_DESC,
    'show_func' => 'tad_gphotos_thumbs',
    'template' => 'tad_gphotos_thumbs.tpl',
    'edit_func' => 'tad_gphotos_thumbs_edit',
    'options' => '|20|image_sn||150|150',
];

//---偏好設定---//
$i = 0;
$i++;
$modversion['config'][$i] = [
    'name' => 'photos_number',
    'title' => '_MI_TADGPHOTOS_PHOTOS_NUMBER',
    'description' => '_MI_TADGPHOTOS_PHOTOS_NUMBER_DESC',
    'formtype' => 'textbox',
    'valuetype' => 'int',
    'default' => '48',
];

$i++;
$modversion['config'][$i] = [
    'name' => 'polaroid_width',
    'title' => '_MI_TADGPHOTOS_POLAROID_WIDTH',
    'description' => '_MI_TADGPHOTOS_POLAROID_WIDTH_DESC',
    'formtype' => 'textbox',
    'valuetype' => 'int',
    'default' => '220',
];

$i++;
$modversion['config'][$i] = [
    'name' => 'polaroid_height',
    'title' => '_MI_TADGPHOTOS_POLAROID_HEIGHT',
    'description' => '_MI_TADGPHOTOS_POLAROID_HEIGHT_DESC',
    'formtype' => 'textbox',
    'valuetype' => 'int',
    'default' => '190',
];

$i++;
$modversion['config'][$i] = [
    'name' => 'polaroid_margin_y',
    'title' => '_MI_TADGPHOTOS_POLAROID_MARGIN_Y',
    'description' => '_MI_TADGPHOTOS_POLAROID_MARGIN_Y_DESC',
    'formtype' => 'textbox',
    'valuetype' => 'int',
    'default' => '10',
];

$modversion['config'][] = [
    'name' => 'polaroid_margin_x',
    'title' => '_MI_TADGPHOTOS_POLAROID_MARGIN_X',
    'description' => '_MI_TADGPHOTOS_POLAROID_MARGIN_X_DESC',
    'formtype' => 'textbox',
    'valuetype' => 'int',
    'default' => '10',
];
