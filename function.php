<?php
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
function ddd($array = [])
{
    Utility::dd($array);
}

function chk_permission($mode = '')
{
    global $xoopsTpl;
    $create_album = Utility::power_chk("create_album", $tad_gphotos_cate_sn);
    if ($mode == 'return') {
        $xoopsTpl->assign('create_album', $create_album);
        return $create_album;
    }
    if (!$create_album) {
        redirect_header($_SERVER['PHP_SELF'], 3, _TAD_PERMISSION_DENIED);
    }
}
