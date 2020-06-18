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

xoops_loadLanguage('main', 'tadtools');
define('_MA_TADGPHOTOS_ALBUM_ID', 'Album ID');
define('_MA_TADGPHOTOS_ALBUM_URL', 'Photo Album URL');
define('_MA_TADGPHOTOS_UID', 'Publisher');
define('_MA_TADGPHOTOS_CREATE_DATE', 'Create Date');
define('_MA_TADGPHOTOS_SHOW_ALBUM_SN_FILES', '');
define('_MD_TADGPHOTOS_ALBUM_NAME', 'Album Name');
define('_MD_TADGPHOTOS_ALBUM_NAME_HELP', '(Do not fill, will automatically crawl)');
define('_MD_TADGPHOTOS_ALBUM_URL', 'Photo Album URL');
define('_MD_TADGPHOTOS_ALBUM_URL_DEMO', 'https://photos.google.com/share/xxxx?key=xxxx');
define('_MD_TADGPHOTOS_ALBUM_URL_HEPL', '<ol><li>Please connect to <a href="https://photos.google.com/albums" target="_blank">Google Photos</a></li> ><li>If there is no album in it, please click “+Create” above and select “Shared Album” to create it.</li><li>If there is already an album, but not “Shared Album” Please enter the album first, click on the icon in the upper right corner: <br><img src="images/setup0.png" class="img-fluid img-responsive" style="margin-bottom:10px;"></li><li>Click "Options", then turn on sharing:<br><img src="images/setup.png" class="img-fluid img-responsive" style="margin-bottom:10px;"></li><li>At this point, the URL should be in the format  <strong style="background: #fcffe5;padding:4px 8px;border:1px solid gray;">https: //photos.google.com/<span style="color:red;">share</span>/photo album ID<span style="color:red;">?key=</span>photobook key </strong> It\'s correct</li><li>Up to 500 photos at a time, so if more than 500 photos in the album are split into the second album.</li></ol>');
define('_MD_TADGPHOTOS_UID', 'Publisher');
define('_MD_TADGPHOTOS_CREATE_DATE', 'Create Date');
define('_MD_TADGPHOTOS_ALBUM_SN', 'Photo Album Number');
define('_MD_TADGPHOTOS_ALBUM_ID', 'Album ID');
define('_MD_TADGPHOTOS_IMAGE_SN', 'Running Number');
define('_MD_TADGPHOTOS_IMAGE_ID', 'Photo ID');
define('_MD_TADGPHOTOS_IMAGE_WIDTH', 'Photo Width');
define('_MD_TADGPHOTOS_IMAGE_HEIGHT', 'Photo Height');
define('_MD_TADGPHOTOS_IMAGE_URL', 'Photo URL');
define('_MD_TADGPHOTOS_IMAGE_DESCRIPTION', 'Photo description');
define('_MA_TADGPHOTOS_ALBUM_SN', 'Photo Album Number');
define('_MA_TADGPHOTOS_IMAGE_ID', 'Photo ID');
define('_MA_TADGPHOTOS_IMAGE_WIDTH', 'Photo Width');
define('_MA_TADGPHOTOS_IMAGE_HEIGHT', 'Photo Height');
define('_MA_TADGPHOTOS_IMAGE_URL', 'Photo URL');
define('_MA_TADGPHOTOS_IMAGE_DESCRIPTION', 'Photo description');
define('_MA_TADGPHOTOS_IMAGE_TOTAL', '(Total %s photos)');
define('_MD_TADGPHOTOS_ADD', 'Add Google Album');
define('_MD_TADGPHOTOS_RE_GET', 're-capture photo');
