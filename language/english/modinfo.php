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

define('_MI_TADGPHOTOS_NAME', 'Google Albums');
define('_MI_TADGPHOTOS_AUTHOR', 'Google Albums');
define('_MI_TADGPHOTOS_CREDITS','');
define('_MI_TADGPHOTOS_DESC', 'Put Google Photes\' albums on the website');
define('_MI_TADGPHOTOS_AUTHOR_WEB', 'Tad Textbook Network');
define('_MI_TADGPHOTOS_ADMENU1', 'Master Management Interface');
define('_MI_TADGPHOTOS_ADMENU1_DESC', 'Master Management Interface');
define('_MI_TADGPHOTOS_ADMENU2', 'Permission Management');
define('_MI_TADGPHOTOS_ADMENU2_DESC', 'Permission Management');

define('_MI_TADGPHOTOS_PHOTOS_NUMBER' , 'Show a few photos per page');
define('_MI_TADGPHOTOS_PHOTOS_NUMBER_DESC' , 'Set the number of albums to appear on each page, as a basis for pagination');
define('_MI_TADGPHOTOS_POLAROID_WIDTH' , 'picture thumbnail width');
define('_MI_TADGPHOTOS_POLAROID_WIDTH_DESC' , 'Set the rendering width of each thumbnail in pixels');
define('_MI_TADGPHOTOS_POLAROID_HEIGHT' , 'picture thumbnail height');
define('_MI_TADGPHOTOS_POLAROID_HEIGHT_DESC' , 'Set the height of each thumbnail (including the title below) in pixels ');
define('_MI_TADGPHOTOS_POLAROID_MARGIN_Y' , 'picture thumbnail up and down spacing');
define('_MI_TADGPHOTOS_POLAROID_MARGIN_Y_DESC' , 'Set the up and down spacing between each thumbnail, in pixels');
define('_MI_TADGPHOTOS_POLAROID_MARGIN_X' , 'Picture thumbnail left and right spacing');
define('_MI_TADGPHOTOS_POLAROID_MARGIN_X_DESC' , 'Set the left and right spacing between each thumbnail, in pixels');

define('_MI_TAD_GPHOTOS_ALBUMS_BLOCK_NAME', 'Google Album List');
define('_MI_TAD_GPHOTOS_ALBUMS_BLOCK_DESC', 'Google album list block (tad_gphotos_albums)');
define('_MI_TAD_GPHOTOS_MARQUEE_BLOCK_NAME', 'Google Album Runner');
define('_MI_TAD_GPHOTOS_MARQUEE_BLOCK_DESC', 'Google Albums Marquee Block (tad_gphotos_marquee)');
define('_MI_TAD_GPHOTOS_THUMBS_BLOCK_NAME', 'Google Album Thumbnail');
define('_MI_TAD_GPHOTOS_THUMBS_BLOCK_DESC', 'Google album thumbnail block (tad_gphotos_list)');