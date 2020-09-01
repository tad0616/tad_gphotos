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

define('_MA_TADGPHOTOS_ALBUM_ID', '相簿ID');
define('_MA_TADGPHOTOS_ALBUM_URL', '相簿網址');
define('_MA_TADGPHOTOS_UID', '發布者');
define('_MA_TADGPHOTOS_CREATE_DATE', '建立日期');
define('_MA_TADGPHOTOS_SHOW_ALBUM_SN_FILES', '');
define('_MD_TADGPHOTOS_ALBUM_NAME', '相簿名稱');
define('_MD_TADGPHOTOS_ALBUM_NAME_HELP', '（可不填，會自動抓取）');
define('_MD_TADGPHOTOS_ALBUM_URL', '相簿網址');
define('_MD_TADGPHOTOS_ALBUM_URL_DEMO', 'https://photos.google.com/share/相簿ID?key=相簿金鑰');
define('_MD_TADGPHOTOS_ALBUM_URL_HEPL', '<ol><li>請先連到<a href="https://photos.google.com/albums" target="_blank">Google 相簿</a></li><li>若裡面沒有任何相簿，請直接按上方「+建立」，選擇「共享相簿」建立之即可。</li><li>若是已有相簿，但非「共享相簿」，那就請先進入該相簿，點擊右上角圖示：<br><img src="images/setup0.png" class="img-fluid img-responsive" style="margin-bottom:10px;"></li><li>點擊「選項」，然後開啟分享：<br><img src="images/setup.png" class="img-fluid img-responsive" style="margin-bottom:10px;"></li><li>此時，網址格式應為 <strong style="background: #fcffe5;padding:4px 8px;border:1px solid gray;">https://photos.google.com/<span style="color:red;">share</span>/相簿ID<span style="color:red;">?key=</span>相簿金鑰</strong> 才正確（即網址列上的網址，不是縮短後的分享網址）</li><li>每次擷取最多 500 張照片，故相簿中照片若超過500張建議分成第二本相簿。</li></ol>');
define('_MD_TADGPHOTOS_UID', '發布者');
define('_MD_TADGPHOTOS_CREATE_DATE', '建立日期');
define('_MD_TADGPHOTOS_ALBUM_SN', '相簿編號');
define('_MD_TADGPHOTOS_ALBUM_ID', '相簿ID');
define('_MD_TADGPHOTOS_IMAGE_SN', '流水號');
define('_MD_TADGPHOTOS_IMAGE_ID', '相片ID');
define('_MD_TADGPHOTOS_IMAGE_WIDTH', '相片寬度');
define('_MD_TADGPHOTOS_IMAGE_HEIGHT', '相片高度');
define('_MD_TADGPHOTOS_IMAGE_URL', '相片網址');
define('_MD_TADGPHOTOS_IMAGE_DESCRIPTION', '相片說明');
define('_MA_TADGPHOTOS_ALBUM_SN', '相簿編號');
define('_MA_TADGPHOTOS_IMAGE_ID', '相片ID');
define('_MA_TADGPHOTOS_IMAGE_WIDTH', '相片寬度');
define('_MA_TADGPHOTOS_IMAGE_HEIGHT', '相片高度');
define('_MA_TADGPHOTOS_IMAGE_URL', '相片網址');
define('_MA_TADGPHOTOS_IMAGE_DESCRIPTION', '相片說明');
define('_MA_TADGPHOTOS_IMAGE_TOTAL', '（共 %s 張相片）');
define('_MD_TADGPHOTOS_ADD', '新增Google相簿');
define('_MD_TADGPHOTOS_RE_GET', '重新擷取相片');
define('_MD_TADGPHOTOS_CSN', '所屬分類');
define('_MD_TADGPHOTOS_CATE_COUNT', '有 %s 個相簿');
define('_MD_TADGPHOTOS_UNCATEGORIZED', '未分類');
define('_MD_TADGPHOTOS_NUMBER_OF_PHOTOS', '相片數');
define('_MD_TADGPHOTOS_HOME', '相簿列表');
define('_MD_TADGPHOTOS_NO_ALBUM_YET', '尚無相簿');
define('_MD_TADGPHOTOS_ADD_CATE', '建立新分類');
define('_MD_TADGPHOTOS_CATE_FORM', '編輯分類');
define('_MD_TADGPHOTOS_CATE_TITLE', '分類標題');
define('_MD_TADGPHOTOS_OF_CSN', '所屬分類');
define('_MD_TADGPHOTOS_CATE_DESCRIPTION', '分類說明');
