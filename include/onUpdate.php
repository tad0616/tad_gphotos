<?php
use XoopsModules\Tad_gphotos\Update;

if (!class_exists(Utility::class)) {
    require XOOPS_ROOT_PATH . '/modules/tadtools/preloads/autoloader.php';
}
if (!class_exists(Update::class)) {
    require dirname(__DIR__) . '/preloads/autoloader.php';
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

function xoops_module_update_tad_gphotos($module, $old_version)
{
    global $xoopsDB;

    if (Update::chk_1()) {
        Update::go_1();
    }

    if (Update::chk_2()) {
        Update::go_2();
    }

    // data_center 加入 sort
    if (Update::chk_dc_sort()) {
        Update::go_dc_sort();
    }
    return true;
}
